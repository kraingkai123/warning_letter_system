<?php
include("../include/include.php");

$proc = $_POST['proc'];

if ($proc == "updateStatus") {
    $lt_id = $_POST['lt_id'];
    $status = $_POST['status'];
    unset($fields);
    $fields['letter_type_status'] = $status == 1 ? 0 : 1;
    unset($cond);
    $cond['lt_id'] = $lt_id;
    LetterType::EditData('m_letter_type', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'add') {
    unset($fields);
    $fields['letter_type_name'] = $_POST['letter_type_name'];
    $fields['letter_type_status'] = 1;
    LetterType::SaveData('m_letter_type', $fields);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'edit') {
    unset($fields);
    $fields['letter_type_name'] = $_POST['letter_type_name'];
    unset($cond);
    $cond['lt_id'] = $_POST['lt_id'];
    LetterType::EditData('m_letter_type', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'delete') {
    unset($cond);
    $cond['lt_id'] = $_POST['lt_id'];
    LetterType::DeleteData('m_letter_type',$cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
}
$res = array(
    "Message" => $message,
    "Status" => $status
);
echo json_encode($res);
exit;
