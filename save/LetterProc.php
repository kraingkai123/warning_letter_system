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
    $fields['mistake_id'] = $_POST['mistake_id'];
    $fields['img_create'] = FileAttach::MakeSignature($_POST['img_create']);
    $letter_type_name = db_getData("SELECT letter_type_name FROM m_letter_type WHERE lt_id='" . $_POST['letter_type'] . "'", 'letter_type_name');
    $fields['letter_type_name'] = $letter_type_name;
    $fields['letter_time'] = $_POST['letter_time'];
    for ($i = 1; $i < 4; $i++) {
        if (!empty($_POST['type_detail_' . $i])) {
            $fields['type_detail_' . $i] = str_replace(" ", '&nbsp;', $_POST['type_detail_' . $i]);
        }
    }
    $fields['letter_date_do'] = $_POST['letter_date_do'];
    $fields['manager_id'] = $_POST['manager_id'];
    $perProfile = User::getDataUser($_POST['manager_id']);
    $fields['manager_name'] = $perProfile['fullname'];
    $fields['manager_pos'] = $perProfile['pos_name'];
    //สาขา
    $orgName = db_getData("SELECT dep_name FROM usr_department where dep_id ='" . $_POST['org_id'] . "'", 'dep_name');
    $fields['org_id'] = $_POST['org_id'];
    $fields['org_name'] = $orgName;
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
        $target .= $prefixData['prefix_name'] . $perProfile['usr_fname'] . ' ' . $perProfile['usr_lname'];
        $target .= " รหัสพนักงาน " . $perProfile['usr_username'];
        $target .= " ตำแหน่ง " . $posData['pos_name'];
        $target .= " ฝ่าย " . $depData['dep_name'] . ",";
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
    db_delete('frm_letter_rule', $cond);
    foreach ($_POST['rule_id'] as $key => $value) {
        unset($fields);
        $fields['rule_id'] =  $value;
        $dataRule = Rule::GetDataRule($value);
        $fields['rule_name'] = $dataRule['rule_name'];
        $fields['rule_detail'] = $dataRule['rule_detail'];
        $fields['letter_id'] = $letterId;
        db_insert('frm_letter_rule', $fields);
    }
    //เส้นทางเอกสาร
    unset($fieldsProcess);
    $fieldsProcess['letter_id'] = $letterId;
    $fieldsProcess['sender_id'] = $_SESSION['usr_id'];
    $fieldsProcess['sender_name'] = $_SESSION['full_name'];
    $fieldsProcess['sender_date'] = date('Y-m-d');
    $fieldsProcess['sender_time'] = date("H:i:s");
    $fieldsProcess['letter_step'] = 0;
    Process::SaveProcess("letter_process", $fieldsProcess);
    //
    $return['status'] = 200;
    if ($_SESSION['usr_type'] == 1) {
        $return['url'] = '../form/frmSend.php?menu_id=10';
    } else {
        $return['url'] = '../form/frmSend.php?menu_id=0';
    }
} else if ($PROC == 'edit') {
    $letterId = $_POST['LETTER_ID'];
    unset($fields);
    $fields['letter_write_address'] = $_POST['letter_write_address'];
    $fields['letter_date'] = $_POST['letter_date'];
    $fields['letter_name'] = $_POST['letter_name'];
    $fields['letter_detail'] = $_POST['letter_detail'];
    $fields['mistake_id'] = $_POST['mistake_id'];
    $fields['letter_status'] = 1;
    $fields['letter_type'] = $_POST['letter_type'];
    $fields['img_create'] = FileAttach::MakeSignature($_POST['img_create']);
    $letter_type_name = db_getData("SELECT letter_type_name FROM m_letter_type WHERE lt_id='" . $_POST['letter_type'] . "'", 'letter_type_name');
    $fields['letter_type_name'] = $letter_type_name;
    $fields['letter_time'] = $_POST['letter_time'];
    for ($i = 1; $i < 4; $i++) {
        if (!empty($_POST['type_detail_' . $i])) {
            $fields['type_detail_' . $i] = str_replace(" ", '&nbsp;', $_POST['type_detail_' . $i]);
        }
    }
    $fields['letter_date_do'] = $_POST['letter_date_do'];
    $fields['manager_id'] = $_POST['manager_id'];
    $perProfile = User::getDataUser($_POST['manager_id']);
    $fields['manager_name'] = $perProfile['fullname'];
    $fields['manager_pos'] = $perProfile['pos_name'];
    //สาขา
    $orgName = db_getData("SELECT dep_name FROM usr_department where dep_id ='" . $_POST['org_id'] . "'", 'dep_name');
    $fields['org_id'] = $_POST['org_id'];
    $fields['org_name'] = $orgName;
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
        $target .= $prefixData['prefix_name'] . $perProfile['usr_fname'] . ' ' . $perProfile['usr_lname'];
        $target .= " รหัสพนักงาน " . $perProfile['usr_username'];
        $target .= " ตำแหน่ง " . $posData['pos_name'];
        $target .= " ฝ่าย " . $perProfile['dep_name'] . ",";;
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
    db_delete('frm_letter_rule', $cond);
    foreach ($_POST['rule_id'] as $key => $value) {
        unset($fields);
        $fields['rule_id'] =  $value;
        $dataRule = Rule::GetDataRule($value);
        $fields['rule_name'] = $dataRule['rule_name'];
        $fields['rule_detail'] = $dataRule['rule_detail'];
        $fields['letter_id'] = $letterId;
        db_insert('frm_letter_rule', $fields);
    }
    //เส้นทางเอสการ
    unset($fieldsProcess);
    $fieldsProcess['letter_id'] = $letterId;
    $fieldsProcess['sender_id'] = $_SESSION['usr_id'];
    $fieldsProcess['sender_name'] = $_SESSION['full_name'];
    $fieldsProcess['sender_date'] = date('Y-m-d');
    $fieldsProcess['sender_time'] = date("H:i:s");
    $fieldsProcess['letter_step'] = 0;
    Process::SaveProcess("letter_process", $fieldsProcess);
    //
    $return['status'] = 200;
    if ($_SESSION['usr_type'] == 1) {
        $return['url'] = '../form/frmSend.php?menu_id=10';
    } else {
        $return['url'] = '../form/frmSend.php?menu_id=0';
    }
} else if ($PROC == 'delete') {
    $letterId = $_POST['LETTER_ID'];
    $cond['letter_id'] = $letterId;
    db_delete('m_letter', $cond);
    db_delete('frm_target', $cond);
    db_delete('frm_witness', $cond);
    db_delete('frm_letter_rule', $cond);
    FileAttach::DeleteFile($letterId);
    $return['status'] = 200;
    $return['url'] = '../form/frmSend.php?menu_id=2';
} else if ($PROC == 'deleteFile') {
    $fileId = $_POST['fileId'];
    FileAttach::DeleteFileOne($fileId);
    $return['status'] = 200;
} else if ($PROC == 'Approve') {
    $letterId = $_POST['LETTER_ID'];
    unset($fields);
    if ($_POST['rdoStatus'] == 'Y') {
        $status = 2;
        $fields['hr_name'] = $_SESSION['full_name'];
        $fields['hr_id'] = $_SESSION['usr_id'];
        $fields['hr_apporve_date'] = date('Y-m-d');
        $fields['hr_appove_time'] = date('H:i:s');
        $fields['hr_position'] = $_SESSION['pos_name'];
        $fields['img_hr'] = FileAttach::MakeSignature($_POST['img_create']);
        $fields['hr_appove_status'] = 'Y';
        //เส้นทางเอสการ
        $resWiness = Letter::getDataWiness($letterId);
        foreach ($resWiness as $key => $value) {
            unset($fieldsProcess);
            $fieldsProcess['letter_id'] = $letterId;
            $fieldsProcess['sender_id'] = $_SESSION['usr_id'];
            $fieldsProcess['sender_name'] = $_SESSION['full_name'];
            $fieldsProcess['sender_date'] = date('Y-m-d');
            $fieldsProcess['sender_time'] = date("H:i:s");
            $fieldsProcess['letter_step'] = 4;
            $fieldsProcess['receive_user'] = $value['usr_id'];
            $fieldsProcess['receive_name'] = $value['prefix_name'] . $value['usr_fname'] . " " . $value['usr_lname'];
            $fieldsProcess['receive_status'] = 'W';
            Process::SaveProcess("letter_process", $fieldsProcess);
        }
        $resWiness = Letter::getDataTarget($letterId);
        foreach ($resWiness as $key => $value) {
            unset($fieldsProcess);
            $fieldsProcess['letter_id'] = $letterId;
            $fieldsProcess['sender_id'] = $_SESSION['usr_id'];
            $fieldsProcess['sender_name'] = $_SESSION['full_name'];
            $fieldsProcess['sender_date'] = date('Y-m-d');
            $fieldsProcess['sender_time'] = date("H:i:s");
            $fieldsProcess['letter_step'] = 3;
            $fieldsProcess['receive_user'] = $value['usr_id'];
            $fieldsProcess['receive_name'] = $value['prefix_name'] . $value['usr_fname'] . " " . $value['usr_lname'];
            $fieldsProcess['receive_status'] = 'W';
            Process::SaveProcess("letter_process", $fieldsProcess);
        }
        $resData = Letter::getDataLetter($letterId);
        unset($fieldsProcess);
        $fieldsProcess['letter_id'] = $letterId;
        $fieldsProcess['sender_id'] = $_SESSION['usr_id'];
        $fieldsProcess['sender_name'] = $_SESSION['full_name'];
        $fieldsProcess['sender_date'] = date('Y-m-d');
        $fieldsProcess['sender_time'] = date("H:i:s");
        $fieldsProcess['letter_step'] = 2;
        $fieldsProcess['receive_user'] = $resData['manager_id'];
        $fieldsProcess['receive_name'] = $resData['manager_name'];
        $fieldsProcess['receive_status'] = 'W';
        Process::SaveProcess("letter_process", $fieldsProcess);
        //
    } else  if ($_POST['rdoStatus'] == 'B') {
        $status = 5;
    } else  if ($_POST['rdoStatus'] == 'N') {
        $status = 3;
    }
    $fields['letter_reason'] = $_POST['hr_reson'];
    $fields['letter_status'] = $status;
    Letter::UpdateData($fields, $letterId);
    FileAttach::Save2Master($letterId, $_POST['TEMP_FILE']);
    //เส้นทางเอสการ
    unset($fieldsProcess);
    $fieldsProcess['letter_id'] = $letterId;
    $fieldsProcess['receive_user'] = $_SESSION['usr_id'];
    $fieldsProcess['receive_name'] = $_SESSION['full_name'];
    $fieldsProcess['receive_date'] = date('Y-m-d');
    $fieldsProcess['receive_time'] = date("H:i:s");
    $fieldsProcess['receive_status'] = $_POST['rdoStatus'];
    $fieldsProcess['comment'] = $_POST['hr_reson'];
    unset($cond);
    $cond['bp_id'] = $_POST['bp_id'];
    Process::UpdateProcess('letter_process', $fieldsProcess, $cond);
    //
    $return['status'] = 200;
    $return['url'] = '../form/approved_list.php?menu_id=6';
} else if ($PROC == 'Receive') {
    $status = 4;
    foreach ($_POST['img_create_traget'] as $key => $value) {
        if (!empty($value)) {
            unset($fields);
            $fields['date_sign'] = date('Y-m-d');
            $fields['f_image'] = FileAttach::MakeSignature($value);
            $fields['f_status'] = 1;
            unset($cond);
            $cond['f_id'] = $key;
            db_update('frm_target', $fields, $cond);
        } else {
            $status = 6;
        }
    }
    foreach ($_POST['img_create_winess'] as $key => $value) {
        unset($fields);
        $fields['date_sign'] = date('Y-m-d');
        $fields['f_image'] = FileAttach::MakeSignature($value);
        $fields['f_status'] = 1;
        unset($cond);
        $cond['f_id'] = $key;
        db_update('frm_witness', $fields, $cond);
    }
    if ($_POST['step'] == 2) {
        unset($fields);
        $fields['manager_sign_date'] = date('Y-m-d');
        $fields['letter_status'] = $status;
        $fields['manager_image'] = FileAttach::MakeSignature($_POST['img_create_managerxxx']);
        $letterId = $_POST['LETTER_ID'];
        Letter::UpdateData($fields, $letterId);
    }
    unset($fieldsProcess);
    $fieldsProcess['receive_date'] = date('Y-m-d');
    $fieldsProcess['receive_time'] = date("H:i:s");
    $fieldsProcess['receive_status'] = 'Y';
    unset($cond);
    $cond['bp_id'] = $_POST['bp_id'];
    Process::UpdateProcess('letter_process', $fieldsProcess, $cond);
    $return['status'] = 200;
    FileAttach::Save2Master($letterId, $_POST['TEMP_FILE']);
    $return['status'] = 200;
    if ($_SESSION['usr_type'] == 1) {
        $return['url'] = '../form/signBook.php?menu_id=11';
    } else {
        $return['url'] = '../form/signBook.php?menu_id=2';
    }
}

echo json_encode($return);
