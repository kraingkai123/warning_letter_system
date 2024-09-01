<?php
include("../include/include.php");

$proc = $_POST['proc'];

if ($proc == "updateStatus") {
    $pos_id = $_POST['pos_id'];
    $status = $_POST['status'];
    unset($fields);
    $fields['pos_status'] = $status == 1 ? 0 : 1;
    unset($cond);
    $cond['pos_id'] = $pos_id;
    Position::EditData('usr_position', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if($proc=="updateStatusManager"){
    $pos_id = $_POST['pos_id'];
    $status = $_POST['status'];
    unset($fields);
    $fields['is_manager'] = $status == 'Y' ? 'N': 'Y';
    unset($cond);
    $cond['pos_id'] = $pos_id;
    Position::EditData('usr_position', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
}else if ($proc == 'add') {
    unset($fields);
    $fields['pos_name'] = $_POST['pos_name'];
    $fields['pos_status'] = 1;
    Position::SaveData('usr_position', $fields);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'edit') {
    unset($fields);
    $fields['pos_name'] = $_POST['pos_name'];
    $fields['is_manager'] = $_POST['is_manager'];
    unset($cond);
    $cond['pos_id'] = $_POST['pos_id'];
    Position::EditData('usr_position', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'delete') {
    unset($cond);
    $cond['pos_id'] = $_POST['pos_id'];
    Position::DeleteData('usr_position',$cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
}
$res = array(
    "Message" => $message,
    "Status" => $status
);
echo json_encode($res);
exit;
