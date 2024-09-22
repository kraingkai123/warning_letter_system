<?php
include("../include/include.php");
$TEMP_ID = $_POST['TEMP_FILE'];
$folderName = FileAttach::createFolder();
$str = $_FILES['file']['name'];
$arrDir = explode(".", $str);
$fileName = date('YmdHis') . rand(0, 9999) . "." . end($arrDir);
unset($fields);
$fields['letter_id'] = $TEMP_ID;
$fields['file_name'] = $_FILES['file']['name'];
$fields['file_tempname'] = $fileName;
$fields['create_user'] = $_SESSION['usr_id'];
$fields['full_url'] = $folderName . $fileName;
$fields['create_date'] = date('Y-m-d');
FileAttach::AddFile($_FILES['file']['tmp_name'],$fields);

/*  */