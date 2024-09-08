<?php
include("../include/include.php");
$proc =$_POST['proc'];
if($proc=='add'){
    unset($fields);
    $fields['prefix_id'] = $_POST['prefix_id'];
    $fields['usr_fname'] = $_POST['usr_fname'];
    $fields['usr_lname'] = $_POST['usr_lname'];
    $fields['usr_gender'] = $_POST['usr_gender'];
    $fields['usr_tel'] = $_POST['usr_tel'];
    $fields['usr_email'] = $_POST['usr_email'];
    $fields['usr_idcard'] = $_POST['usr_idcard'];
    $fields['dep_id'] = $_POST['dep_id'];
    $fields['usr_position'] = $_POST['usr_position'];
    $response = User::CreateUsername();
    $fields['usr_username'] =  $response['username'];
    $fields['usr_year'] = date("Y");
    $fields['usr_count'] = $response['count'];
    $fields['usr_type'] = $_POST['usr_type'] =='on' ? 1 : 0 ;
    $fields['usr_password'] = base64_encode($_POST['usr_idcard']);
    db_insert('m_user',$fields);
}else if($proc=='edit'){
    unset($fields);
    $fields['prefix_id'] = $_POST['prefix_id'];
    $fields['usr_fname'] = $_POST['usr_fname'];
    $fields['usr_lname'] = $_POST['usr_lname'];
    $fields['usr_gender'] = $_POST['usr_gender'];
    $fields['usr_tel'] = $_POST['usr_tel'];
    $fields['usr_email'] = $_POST['usr_email'];
    $fields['usr_idcard'] = $_POST['usr_idcard'];
    $fields['dep_id'] = $_POST['dep_id'];
    $fields['usr_position'] = $_POST['usr_position'];
    $fields['usr_type'] = $_POST['usr_type'] =='on' ? 1 : 0 ;
    unset($cond);
    $cond['usr_id']= $_POST['usr_id'];
    db_update('m_user',$fields,$cond);
}else if($proc=='updateStatus'){
    $usr_id = $_POST['usr_id'];
    $status = $_POST['status'];
    unset($fields);
    $fields['usr_status'] = $status == 'Y' ? 'N' : 'Y';
    unset($cond);
    $cond['usr_id'] = $usr_id;
    db_update('m_user',$fields,$cond);
    $status = true;
    $message = "บันทึกข้อมูลเสร็จสิ้น";
}
?>