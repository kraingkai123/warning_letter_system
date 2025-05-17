<?php
include("../include/include.php");

$proc = $_POST['proc'];
if ($proc == "updateStatus") {
    $dep_id = $_POST['department_id'];
    $status = $_POST['status'];
    unset($fields);
    $fields['dep_status'] = $status == 1 ? 0 : 1;
    
    unset($cond);
    $cond['dep_id'] = $dep_id;
    Department::EditData('usr_department', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'add') {
    unset($fields);
    $fields['dep_name'] = $_POST['department_name'];
    $fields['dep_status'] = 1;
    $fields['org_status'] = $_POST['org_status'] == '' ? 'N' : $_POST['org_status'];
    Department::SaveData('usr_department', $fields);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'edit') {
    unset($fields);
    $fields['dep_name'] = $_POST['department_name'];
    $fields['org_status'] = $_POST['org_status'] == '' ? 'N' : $_POST['org_status'];
    unset($cond);
    $cond['dep_id'] = $_POST['department_id'];
    Department::EditData('usr_department', $fields, $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
} else if ($proc == 'delete') {
    unset($cond);
    $cond['dep_id'] = $_POST['department_id'];
    Department::DeleteData('usr_department', $cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
}
$res = array(
    "Message" => $message,
    "Status" => $status
);
echo json_encode($res);
exit;
