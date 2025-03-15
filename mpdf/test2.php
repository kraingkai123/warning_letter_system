<?php
require_once __DIR__ . '/vendor/autoload.php';

// เปิด Error Reporting เพื่อ Debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$HIDE_HEADER = "P";
require_once '../include/include.php';
$path = "../";

use ESV\controller\Book;
use ESV\controller\Deparment;
use ESV\controller\PerProfile;
use ESV\controller\FileAttach;

$W = conText($_GET['W']);
$WFR = conText($_GET['WFR_ID']);

$tableData = "M_BOOK";
$qMain = db::query("SELECT * FROM {$tableData} WHERE BOOK_ID = '{$WFR}'");
$rData = db::fetch_array($qMain);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if (!$rData) {
    die("ไม่พบข้อมูลในฐานข้อมูล");
}
?>
<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40' style="padding: 1.5cm 1.8cm 2cm 2.5cm;">
<link rel="stylesheet" href="../assets/fonts/fontawesome.css">
<?php

// สร้าง PDF พร้อมป้องกันค่า 0 ที่อาจทำให้เกิด DivisionByZeroError
try {
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_left' => 25,
        'margin_right' => 18,
        'margin_top' => 15,
        'margin_bottom' => 20,
        
    ]);

    $std_css = "
    <style>
        body {
            font-family: 'TH SarabunIT๙';
            font-size: 16pt;
            line-height: 6.5mm;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16pt;
            
        }
        td, th {
            padding: 5px;
        }
        .ALIGN_CENTER {
            text-align: center;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 14pt;
        }
    </style>";

    $mpdf->WriteHTML($std_css);

    // สร้างเนื้อหา HTML
    $html = '<table border="0">
        <tr>
            <td align="center" style="font-size:20pt" colspan="2"><strong>สำนักงานบริหารหนี้สาธารณะ</strong></td>
        </tr>
        <tr>
            <td width="10%">วันที่</td>
            <td width="90%">' . ($rData['SIGN_STATUS_PAPER'] == 'Y' ? convert::date(date("Y-m-d"))->getFullDate('', '', 'Y', 'Y') : '') . '</td>
        </tr>
        <tr>
            <td width="10%">เรื่อง</td>
            <td width="90%">' . htmlspecialchars($rData['BOOK_TITLE_PAPER'] ?? '') . '</td>
        </tr>
        <tr>
            <td width="10%" style="vertical-align:top">เรียน</td>
            <td width="90%">' . htmlspecialchars($rData['PAPER_TARGET'] ?? '') ;
            $responsePaper = Book::getListTargetPaper($_GET['WFR_ID']);
                        foreach ($responsePaper as $key => $value) {
                        
                            $html .= '(ผ่าน '. htmlspecialchars($value['TARGET_NAME']).' )';
                            
                            if ($value['TARGET_STATUS'] == 'Y') {
                                $PerIdSign = getFieldData("SELECT PER_ID FROM M_SIGNATURE WHERE SIGN_ID='" . $value['SIGN_ID'] . "'");
                                $FileName =  FileAttach::GetFileSignature($PerIdSign);
                            
                              $html .='<img alt="" src="'. htmlspecialchars($FileName).'" style="height: 20px;width: auto;">';
                            
                            }

                           
                        }
        $html .='  </td>
        </tr>
    </table>';
    $qCheckBox = db::query("SELECT * FROM M_OBJECTIVE WHERE OBJECTIVE_STATUS ='Y'");
    $arrayCH = [];
    $index = 0;
    $key = 1;
    while ($rCheckBook = db::fetch_array($qCheckBox)) {
        $arrayCH[$index] = $rCheckBook;
        $index++;
    }
    $qCheckBoxSelect  = db::query("SELECT CHECKBOX_VALUE FROM WF_CHECKBOX WHERE WFR_ID='" . $WFR . "' AND W_ID=6 ");
    $arraySelected = [];
    while ($r = db::fetch_array($qCheckBoxSelect)) {
        $arraySelected[] = $r['CHECKBOX_VALUE'];
    }
    $html .= ' <br>
    <table border="1" cellpadding="5" cellspacing="0" width="80%">';
    for ($i = 0; $i < count($arrayCH); $i += 1) {
        $html .= '<tr style ="height: 28;">';
        $j = 0;
        if (isset($arrayCH[$i + $j])) {
        
        if (in_array($arrayCH[$i + $j]['OBJ_ID'], $arraySelected)) {
            $html .= '<td align="center" ><img width=20 src="iconmonstr.png"></td>';
        }else{
            $html .= '<td align="center" width="10%">';
            $html .='</td>';
        }
        $html .='
        <td width="70%">'.   htmlspecialchars($arrayCH[$i + $j]['OBJECTIVE_NAME']) ;
        $html .='</td>';
        } else {
            $html .'<td width="10%"></td>
            <td width="70%"></td>';
        }
        $html .'</tr>';    
    }
    $html .=' </table>';

    $html .=' <table border="0" width="70%">
                <tr>
                    <td colspan="4"><br></td>
                </tr>
                <tr>
                    <td width="10%"></td>
                    <td width="10%">จาก</td>
                    <td colspan="2" align="center" width="40%">';
                        if ($rData['SIGN_STATUS_PAPER'] == 'Y') {
                            if ($rData['PAPER_SIGN_IMAGE'] != "") {
                                $FileName = $rData['PAPER_SIGN_IMAGE'];
                            } else {
                                $PerIdSign = getFieldData("SELECT PER_ID FROM M_SIGNATURE WHERE SIGN_ID='" . $rData['SIGN_ID_PAPER'] . "'");
                                $FileName =  FileAttach::GetFileSignature($PerIdSign);
                            }
                        
                           $html .=' <img src="'. htmlspecialchars( $FileName).'" alt="" style="width: 100px;height: 50px;"> ';
                        } 


                        $html .=' </td>
                </tr>
                <tr>
                    <td width="10%"></td>
                    <td width="10%"></td>';
                    $html .='<td colspan="2" align="center" width="40%">('. htmlspecialchars( $rData['PAPER_SIGN_NAME']).' )</td>
                </tr>
                <tr>
                    <td width="10%"></td>
                    <td width="10%"></td>';
                    $html .='  <td colspan="2" align="center" width="40%">' . htmlspecialchars($rData['SIGN_POSITION_PAPER']).'</td>
                </tr>
            </table>';
            $html .='  <table border="0" width="100%">
                <tr>
                    <td><u>หมายเหตุ</u></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td>';
                        
                        if (!empty($rData['DEPARTMENT_ID_PAPER'])) {


                            $depData = Deparment::getDeaprtmentData($rData['DEPARTMENT_ID_PAPER']);
                            $crateDepartment = $depData['DEP_NAME'];
                            $createTel = $rData['TELEPHONE_PAPER'];
                            $perData = PerProfile::getPerprofileData($rData['PER_ID_CREATE']);
                            $createName = $perData['REF_NAME'];
                        }
                        
                        $html .=' ชื่อเจ้าของเรื่อง '. htmlspecialchars($createName).' โทร '. htmlspecialchars($createTel) ."  ".  htmlspecialchars($crateDepartment); 
                        $html .=  '</td>
                </tr>
            </table>';


    // echo $html;
    $mpdf->WriteHTML($html);
    $mpdf->Output();
} catch (\Mpdf\MpdfException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}
