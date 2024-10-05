<?php
include("../include/include.php");
$PROC = $_POST['PROC'];
if ($PROC == 'add') {
    $target = "";
    unset($fields);
    $fields['usr_id'] = $_SESSION['usr_id'];
    $fields['dep_id'] = $_SESSION['dep_id'];
    $number = Letter::RunNumber();
    $fields['letter_number'] = $number['letter_number'];
    $fields['letter_count'] = $number['letter_count'];
    $fields['letter_year'] = date('Y');
    $fields['letter_write_address'] = $_POST['letter_write_address'];
    $fields['letter_date'] = $_POST['letter_date'];
    $fields['letter_name'] = $_POST['letter_name'];
    $fields['letter_detail'] = $_POST['letter_detail'];
    $fields['letter_status'] = 1;
    $fields['letter_type'] = $_POST['letter_type'];
    $fields['img_create'] = $_POST['img_create'];
    $letter_type_name = db_getData("SELECT letter_type_name FROM m_letter_type WHERE lt_id='" . $_POST['letter_type'] . "'", 'letter_type_name');
    $fields['letter_type_name'] = $letter_type_name;
    $letterId = Letter::SaveData($fields);
    FileAttach::Save2Master($letterId, $_POST['TEMP_FILE']);
    $cond['letter_id'] = $letterId;
    db_delete('frm_target', $cond);
    foreach ($_POST['letter_target'] as $key => $value) {
        unset($fields);
        $fields['usr_id'] =  $value;
        $perProfile = User::getDataUser($value);
        $fields['usr_fname'] =  $perProfile['usr_fname'];
        $fields['usr_lname'] =  $perProfile['usr_lname'];
        $fields['prefix_name'] = $perProfile['prefix_name'];
        $posData = Position::getDataPostion($perProfile['usr_position']);
        $fields['usr_pos_name'] =   $posData['pos_name'];
        $depData = Department::getDataDepartment($perProfile['dep_id']);
        $fields['usr_dep_name'] =   $depData['dep_name'];
        $fields['letter_id'] = $letterId;
        $fields['f_status'] = 2;
        db_insert('frm_target', $fields);
        $prefixData = user::getPrefix($perProfile['prefix_id']);
        $target .= $prefixData['prefix_name'] . $perProfile['usr_fname'] . ' ' . $perProfile['usr_lname'] . " (" . $posData['pos_name'] . ")" . " (" . $depData['dep_name'] . ")" . ",";
    }
    $tureTarget = substr($target, 0, -1);
    unset($fields);
    $fields['letter_target'] = $tureTarget;
    Letter::UpdateData($fields, $letterId);
    db_delete('frm_witness', $cond);
    foreach ($_POST['witness'] as $key => $value) {
        unset($fields);
        $fields['usr_id'] =  $value;
        $perProfile = User::getDataUser($value);
        $fields['usr_fname'] =  $perProfile['usr_fname'];
        $fields['usr_lname'] =  $perProfile['usr_lname'];
        $fields['prefix_name'] = $perProfile['prefix_name'];
        $posData = Position::getDataPostion($perProfile['usr_position']);
        $fields['usr_pos_name'] =   $posData['pos_name'];
        $depData = Department::getDataDepartment($perProfile['dep_id']);
        $fields['usr_dep_name'] =   $depData['dep_name'];
        $fields['letter_id'] = $letterId;
        $fields['f_status'] = 2;
        db_insert('frm_witness', $fields);
    }
    $return['status'] = 200;
    $return['url'] = '../form/frmSend.php?menu_id=2';
} else if ($PROC == 'edit') {
    $letterId = $_POST['LETTER_ID'];
    unset($fields);
    $fields['letter_write_address'] = $_POST['letter_write_address'];
    $fields['letter_date'] = $_POST['letter_date'];
    $fields['letter_name'] = $_POST['letter_name'];
    $fields['letter_detail'] = $_POST['letter_detail'];
    $fields['letter_status'] = 1;
    $fields['letter_type'] = $_POST['letter_type'];
    $fields['img_create'] = $_POST['img_create'];
    $letter_type_name = db_getData("SELECT letter_type_name FROM m_letter_type WHERE lt_id='" . $_POST['letter_type'] . "'", 'letter_type_name');
    $fields['letter_type_name'] = $letter_type_name;
    Letter::UpdateData($fields, $letterId);
    FileAttach::Save2Master($letterId, $_POST['TEMP_FILE']);
    $cond['letter_id'] = $letterId;
    db_delete('frm_target', $cond);
    foreach ($_POST['letter_target'] as $key => $value) {
        unset($fields);
        $fields['usr_id'] =  $value;
        $perProfile = User::getDataUser($value);
        $fields['usr_fname'] =  $perProfile['usr_fname'];
        $fields['usr_lname'] =  $perProfile['usr_lname'];
        $fields['prefix_name'] = $perProfile['prefix_name'];
        $posData = Position::getDataPostion($perProfile['usr_position']);
        $fields['usr_pos_name'] =   $posData['pos_name'];
        $depData = Department::getDataDepartment($perProfile['dep_id']);
        $fields['usr_dep_name'] =   $depData['dep_name'];
        $fields['letter_id'] = $letterId;
        $fields['f_status'] = 2;
        db_insert('frm_target', $fields);
        $prefixData = user::getPrefix($perProfile['prefix_id']);
        $target .= $prefixData['prefix_name'] . $perProfile['usr_fname'] . ' ' . $perProfile['usr_lname'] . " (" . $posData['pos_name'] . ")" . " (" . $depData['dep_name'] . ")" . ",";
    }
    $tureTarget = substr($target, 0, -1);
    unset($fields);
    $fields['letter_target'] = $tureTarget;
    Letter::UpdateData($fields, $letterId);
    db_delete('frm_witness', $cond);
    foreach ($_POST['witness'] as $key => $value) {
        unset($fields);
        $fields['usr_id'] =  $value;
        $perProfile = User::getDataUser($value);
        $fields['usr_fname'] =  $perProfile['usr_fname'];
        $fields['usr_lname'] =  $perProfile['usr_lname'];
        $fields['prefix_name'] = $perProfile['prefix_name'];
        $posData = Position::getDataPostion($perProfile['usr_position']);
        $fields['usr_pos_name'] =   $posData['pos_name'];
        $depData = Department::getDataDepartment($perProfile['dep_id']);
        $fields['usr_dep_name'] =   $depData['dep_name'];
        $fields['letter_id'] = $letterId;
        $fields['f_status'] = 2;
        db_insert('frm_witness', $fields);
    }
    $return['status'] = 200;
    $return['url'] = '../form/frmSend.php?menu_id=2';
} else if ($PROC == 'delete') {
    $letterId = $_POST['LETTER_ID'];
    $cond['letter_id'] = $letterId;
    db_delete('m_letter', $cond);
    db_delete('frm_target', $cond);
    db_delete('frm_witness', $cond);
    FileAttach::DeleteFile($letterId);
    $return['status'] = 200;
    $return['url'] = '../form/frmSend.php?menu_id=2';
} else if ($PROC == 'deleteFile') {
    $fileId = $_POST['fileId'];
    FileAttach::DeleteFileOne($fileId);
    $return['status'] = 200;
} else if ($PROC == 'HrApprove') {
    $letterId = $_POST['LETTER_ID'];
    unset($fields);
    if ($_POST['rdoStatus'] == 'Y') {
        $status = 2;
        $fields['hr_name'] = $_SESSION['full_name'];
        $fields['hr_id'] = $_SESSION['usr_id'];
        $fields['hr_apporve_date'] = date('Y-m-d');
        $fields['hr_appove_time'] = date('H:i:s');
        $fields['hr_position'] = $_SESSION['pos_name'];
        $fields['img_hr'] = $_POST['img_create'];
        $fields['hr_appove_status'] = 'Y';
    } else  if ($_POST['rdoStatus'] == 'B') {
        $status = 5;
    } else  if ($_POST['rdoStatus'] == 'N') {
        $status = 3;
    }
    $fields['letter_reason'] = $_POST['hr_reson'];
    $fields['letter_status'] = $status;
    Letter::UpdateData($fields, $letterId);
    FileAttach::Save2Master($letterId, $_POST['TEMP_FILE']);
    $return['status'] = 200;
    $return['url'] = '../form/approved_list.php?menu_id=5';
} else if ($PROC == 'Receive') {
    foreach ($_POST['img_create_traget'] as $key => $value) {
        unset($fields);
        $fields['date_sign'] = date('Y-m-d');
        $fields['f_image'] = $value;
        $fields['f_status'] = 1;
        unset($cond);
        $cond['f_id'] = $key;
        db_update('frm_target', $fields, $cond);
    }
    foreach ($_POST['img_create_winess'] as $key => $value) {
        unset($fields);
        $fields['date_sign'] = date('Y-m-d');
        $fields['f_image'] = $value;
        $fields['f_status'] = 1;
        unset($cond);
        $cond['f_id'] = $key;
        db_update('frm_witness', $fields, $cond);
    }
    unset($fields);
    $fields['letter_status'] = 4;
    $letterId = $_POST['LETTER_ID'];
    Letter::UpdateData($fields, $letterId);
    $return['status'] = 200;
    FileAttach::Save2Master($letterId, $_POST['TEMP_FILE']);
    $return['status'] = 200;
    $return['url'] = '../form/frmSend.php?menu_id=2';
}

echo json_encode($return);

