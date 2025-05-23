<?php
include("../include/include.php");

$proc = $_POST['proc'];
if ($proc == "updateStatus") {
    $mistake_id = $_POST['mistake_id'];
    $status = $_POST['status'];
    unset($fields);
    $fields['mistake_status'] = $status == 1 ? 0 : 1;
    unset($cond);
    $cond['mistake_id'] = $mistake_id;
    MisTake::EditData('mistake', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'add') {
    unset($fields);
    $fields['mistake_name'] = $_POST['mistake_name'];
    $fields['mistake_status'] = 1;
    MisTake::SaveData('mistake', $fields);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'edit') {
    unset($fields);
    $fields['mistake_name'] = $_POST['mistake_name'];
    unset($cond);
    $cond['mistake_id'] = $_POST['mistake_id'];
    MisTake::EditData('mistake', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'delete') {
    unset($cond);
    $cond['mistake_id'] = $_POST['mistake_id'];
    MisTake::DeleteData('mistake', $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
}else if($proc=="getData"){
    $resspone = MisTake::getDataMistake($_POST['mistakeId']);
    $status = true;

}
$res = array(
    "Message" => $message,
    "Status" => $status,
    "data" => $resspone
);
echo json_encode($res);
exit;
