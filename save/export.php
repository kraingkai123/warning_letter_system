<?php


include("../include/include.php");
if ($_POST['typeExport'] == 'pdf') {
    require_once '../mpdf/vendor/autoload.php';
} else {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=export.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
}
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

unset($req);
if (!empty($_POST['startDate'])) {
    $req['startDate'] = $_POST['startDate'];
}
if (!empty($_POST['endDate'])) {
    $req['endDate'] = $_POST['endDate'];
}

$req['dep_id'] = $_SESSION['dep_id'];
$respone = Report::ListRule($req);
if ($_POST['typeExport'] == 'pdf') {
    $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'margin_left' => $margin_left, 'margin_right' => $margin_right, 'margin_top' => $margin_top, 'margin_bottom' => $margin_bottom, 'margin_header' => $margin_header, 'margin_footer' => $margin_footer]);
} else {
}
$header = "การลงโทษทางวินัย";
if ($_POST['startDate'] != "" && $_POST['endDate'] != "") {
    $header = "การลงโทษทางวินัยวันที่ " . db2Date($_POST['startDate']) . " ถึง " . db2Date($_POST['endDate']);
} else if ($_POST['startDate']  != "") {
    $header = "การลงโทษทางวินัยวันที่ " . db2Date($_POST['startDate']);
} else if ($req['endDate']  != "") {
    $header = "การลงโทษทางวินัยวันที่ " . db2Date($_POST['endDate']);
}
ob_start();
?>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>



 <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center" width="10%">รายละเอียด</th>
                                            <th class="text-center" width="10%">สถานะ</th>
                                            <th class="text-center" width="10%">เลขที่เอกสาร</th>
                                             <th class="text-center" width="10%">โทษทางวินัย</th>
                                            <th class="text-center" width="10%">วันที่</th>
                                            <th class="text-center" width="10%">รหัสพนักงาน</th>
                                            <th class="text-center" width="20%">ชื่อ-นามสกุล</th>
                                            <th class="text-center" width="20%">ตำแหน่ง</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $index = 1;
                                        if (count($respone) > 0) {
                                            foreach ($respone as $key => $value) {
                                                $color = "";
                                                $textStatus = "";
                                                if ($value['letter_status'] == 1) {
                                                    $color = "#F7CAAC";
                                                    $textStatus = "รออนุมัติ";
                                                } else if ($value['letter_status'] == 5) {
                                                    $color = "#F7CAAC";
                                                    $textStatus = "ส่งกลับแก้ไข";
                                                } else if ($value['letter_status'] == 3) {
                                                    $color = "#FFAFAF";
                                                    $textStatus = "ไม่อนุมัติ";
                                                } else if ($value['letter_status'] == 2) {
                                                    $color = "#B3C6E7";
                                                    $textStatus = "อนุมัติ";
                                                } else if ($value['letter_status'] == 4) {
                                                    $color = "#C4E0B2";
                                                    $textStatus = "ดำเนินการเสร็จสิ้น";
                                                }else if ($value['letter_status'] == 6) {
                                                     $color = "#FFAFAF";
                                                    $textStatus = "พนักงานไม่ยินยอมรับทราบ";
                                                }

                                        ?>
                                                <tr>
                                                    <td></td>
                                                    <td align="center"><span style="color:<?php echo $color; ?>"><?php echo $textStatus; ?></span></td>
                                                    <td><?php echo $value['letter_number']; ?></td>
                                                           <td><?php echo db_getData("SELECT letter_type_name FROM m_letter_type WHERE lt_id ='".$value['letter_type']."'","letter_type_name"); ?></td>
                                                    <td><?php echo db2Date($value['letter_date'])." ".$value['letter_time']; ?></td>
                                                    <td><?php echo db_getData("SELECT usr_username FROM view_user WHERE usr_id =" . $value['usr_id'] . "", 'usr_username'); ?></td>
                                                    <td><?php echo $value['fullname']; ?></td>
                                                    <td><?php echo $value['usr_pos_name']; ?></td>
                                                </tr>
                                            <?php
                                                $index++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">ไม่พบข้อมูล</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
<?php
$htmlBody = ob_get_clean();
if ($_POST['typeExport'] == 'pdf') {
    $mpdf->SetFooter('{PAGENO}');
    $mpdf->SetHeader($_SESSION['full_name'] . " [" . db2Date(date('Y-m-d')) . " เวลา " . date('H:i') . "]");
    $mpdf->WriteHTML($htmlBody);
    // Output to browser
    $mpdf->Output();;
} else {
    echo $htmlBody;
}
?>