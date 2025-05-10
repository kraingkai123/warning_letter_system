<?php

class User
{
    public function __construct()
    {
        global $conn;
    }
    public static function getListUser($depId, $loginType)
    {
        if ($loginType == "0") {
            $filter = " AND dep_id = '" . $depId . "'";
        }
        $sql = "SELECT * FROM m_user WHERE 1=1 $filter";
        $response = db_query($sql);
        return $response;
    }
    public static function getPrefix(int $prefixId = 0)
    {
        if ($prefixId != "0") {
            $filter = " AND prefix_id = '" . $prefixId . "'";
        }
        $sql = "SELECT * FROM m_prefix WHERE 1=1 and prefix_status='1' $filter";
        if ($prefixId != "0") {
            $response = db_queryFirst($sql);
        } else {
            $response = db_query($sql);
        }
        return $response;
    }
    public static function CreateUsername()
    {
        $max = db_getData("SELECT  MAX(usr_count)+1 as max FROM m_user WHERE usr_year='" . date('Y') . "'", 'max');
        if ($max == "") {
            $max = 1;
        }
        $username = date("y", strtotime(date('Y-m-d') . ' + 543 years')) . sprintf("%04d", $max);
        return array(
            "username" => $username,
            "count" => $max
        );
    }
    public static function getDataUser($usrId)
    {
        $sql = "SELECT * FROM view_user WHERE 1=1  AND usr_id='$usrId'";
        $response = db_queryFirst($sql);
        return $response;
    }
    public static function getUserAll($depId, $loginType)
    {
        if ($loginType == "0") {
            $filter = " AND m_user.dep_id = '" . $depId . "'";
        }
        $sql = "select usr_username,usr_fname,usr_lname,usr_id,usr_type,dep_name,pos_name,is_manager,prefix_name,m_user.dep_id,dep_name,usr_status,usr_username FROM m_user
                            INNER JOIN usr_position ON usr_position.pos_id = m_user.usr_position
                            INNER JOIN usr_department ON usr_department.dep_id=m_user.dep_id 
							INNER JOIN m_prefix ON m_prefix.prefix_id=m_user.prefix_id
                            WHERE 1=1 $filter";
        $response = db_query($sql);
        return $response;
    }
    public static function getManager($depId){
        $response =db_query("SELECT * FROM view_user WHERE dep_id='$depId' AND is_manager='Y'");
        return $response;
    }
}
