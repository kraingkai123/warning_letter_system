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
    for ($i = 1; $i < 4; $i++) {
        $fields['detail_' . $i] = $_POST['detail_' . $i];
    }
    LetterType::SaveData('m_letter_type', $fields);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'edit') {
    unset($fields);
    $fields['letter_type_name'] = $_POST['letter_type_name'];
    for ($i = 1; $i < 4; $i++) {
        $fields['detail_' . $i] = $_POST['detail_' . $i];
    }
    unset($cond);
    $cond['lt_id'] = $_POST['lt_id'];
    LetterType::EditData('m_letter_type', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'delete') {
    unset($cond);
    $cond['lt_id'] = $_POST['lt_id'];
    LetterType::DeleteData('m_letter_type', $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == "getData") {
    $resspone = LetterType::getDataType($_POST['lt_id']);
    $status = true;
} else if($proc=="getDataTemplate"){
    $ressponeData = LetterType::getDataType($_POST['lt_id']);
    $date = convDateThai($_POST['date']);
    $resspone['detail_1'] = str_replace("XXXX",$date ,$ressponeData['detail_1']);

}
$res = array(
    "Message" => $message,
    "Status" => $status,
    "data" => $resspone
);
echo json_encode($res);
exit;
