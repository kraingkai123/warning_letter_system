<?php
session_start();

include("../include/include.php");
require_once '../mpdf/vendor/autoload.php';
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



<table id="example" class="table" style="width:100%">
    <tr>
        <th colspan="6"><?php echo $header; ?></th>
    </tr>
    <tr class="text-center">
        <th class="text-center" width="10%">ลำดับ</th>
        <th class="text-center" width="10%">ชื่อ-สกุล</th>
        <th class="text-center" width="30%">หน่วยงาน</th>
        <th class="text-center" width="20%">ตำแหน่ง</th>
        <th class="text-center" width="20%">ข้อบังคับ</th>
        <th class="text-center" width="10%">จำนวน</th>
    </tr>


    <?php
    $index = 1;
    if (count($respone) > 0) {
        foreach ($respone as $key => $value) {
            $ltterId = $value['letter_id'];
            $usrId =  $value['usr_id'];
            unset($req);
            $req['usrId'] = $usrId;
            $req['letterId'] = $ltterId;
            if (!empty($_POST['startDate'])) {
                $req['startDate'] = $_POST['startDate'];
            }
            if (!empty($_POST['endDate'])) {
                $req['endDate'] = $_POST['endDate'];
            }

            $req['dep_id'] = $_SESSION['dep_id'];
            $responseRule = Report::getruleList($req);
            $contRule = count($responseRule);
            if ($contRule == 0) {
                $contRule = 1;
            } else {

                $contRule++;
            }

    ?>
            <tr>
                <td rowspan="<?php echo $contRule; ?>" align="center"><?php echo $index; ?></td>
                <td rowspan="<?php echo $contRule; ?>"><?php echo  $value['fullname']; ?></td>
                <td rowspan="<?php echo $contRule; ?>"><?php echo  $value['usr_dep_name']; ?></td>
                <td rowspan="<?php echo $contRule; ?>"><?php echo  $value['usr_pos_name']; ?></td>

                <?php
                if ($contRule  > 1) {
                    foreach ($responseRule as $key2 => $valuerule) {
                ?>
            <tr>
                <td><?php echo  $valuerule['rule_name']; ?></td>
                <td align="center"><?php echo  $valuerule['countrule']; ?></td>
            </tr>
        <?php
                    }
                } else {
        ?>

        <td align="center">-</td>
        <td align="center">0</td>

    <?php
                }
    ?>
    </tr>
<?php
            $index++;
        }
    } else {
?>
<tr>
    <td colspan="6" align="center">ไม่พบข้อมูล</td>
</tr>
<?php
    }
?>

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
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=export.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
}
