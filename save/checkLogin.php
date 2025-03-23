<?php
include("../include/include.php");

$userName = $_POST['username'];
$passWord = base64_encode($_POST['password']);
if (empty($userName)) {
    $message = "กรุณากรอก Username";
    $status = false;
} else if (empty($passWord)) {
    $message = "กรุณากรอก Password";
    $status = false;
} else {
    
    $response = db_queryFirst("select usr_fname,usr_lname,usr_id,usr_type,dep_name,pos_name,is_manager,prefix_name,m_user.dep_id FROM m_user
                            INNER JOIN usr_position ON usr_position.pos_id = m_user.usr_position
                            INNER JOIN usr_department ON usr_department.dep_id=m_user.dep_id 
							INNER JOIN m_prefix ON m_prefix.prefix_id=m_user.prefix_id
                            WHERE usr_username='$userName' AND usr_password='$passWord' AND usr_status='Y'");
                           
    if ($response['usr_id'] != "") {
        $_SESSION['usr_id'] = $response['usr_id'];
        $_SESSION['usr_fname'] = $response['usr_fname'];
        $_SESSION['usr_lname'] = $response['usr_lname'];
        $_SESSION['usr_type'] = $response['usr_type'];
        $_SESSION['dep_name'] = $response['dep_name'];
        $_SESSION['pos_name'] = $response['pos_name'];
        $_SESSION['prefix_name'] = $response['prefix_name'];
        $_SESSION['dep_id'] = $response['dep_id'];
        $_SESSION['full_name'] = $response['prefix_name'].$response['usr_fname']." ".$response['usr_lname'];
        $message = "";
        $status = true;
        if ($response['usr_type'] == 0) {
            if($response['is_manager']=='Y'){
                $filter.=" AND (manager_status is null OR manager_status ='Y')";
            }else{
                $filter.=" AND manager_status is null";
            }
            $filter .= " AND menu_type='2' ";
        }else{
            $filter = " AND menu_type='1'";
        }
        $responseMenu = db_query("SELECT * FROM m_menu WHERE  1=1 $filter ORDER BY order_menu ASC");

        $i = 0;
        foreach ($responseMenu as $key => $value) {
            $_SESSION["menu"][$i] = array(
                "menu_name" => $value['menu_name'],
                "menu_url" => $value['menu_url'],
                "menu_image" => $value['menu_image'],
                "menu_id" => $value['menu_id']
            );
            $i++;
        }
        $status = true;
        $message = "Success";
    } else {
        $message = "ชื่อผู้ใช้งานไม่ถูกต้อง";
        $status = false;
    }
}
$res = array(
    "Message" => $message,
    "Status" => $status
);
echo json_encode($res);
exit;
