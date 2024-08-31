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
}
