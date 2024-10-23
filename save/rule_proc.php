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
    $fields['rule_name'] = $_POST['rule_name'];
    $fields['rule_detail'] = $_POST['rule_detail'];
    $fields['rule_status'] = $_POST['rule_status'];
    Rule::SaveData('m_rule', $fields);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'edit') {
    unset($fields);
    $fields['rule_name'] = $_POST['rule_name'];
    $fields['rule_detail'] = $_POST['rule_detail'];
    $fields['rule_status'] = $_POST['rule_status'];
    unset($cond);
    $cond['rule_id'] = $_POST['rule_id'];
    Rule::EditData('m_rule', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'delete') {
    unset($cond);
    $cond['rule_id'] = $_POST['rule_id'];
    Rule::DeleteData('m_rule',$cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
}
$res = array(
    "Message" => $message,
    "Status" => $status
);
echo json_encode($res);
exit;
