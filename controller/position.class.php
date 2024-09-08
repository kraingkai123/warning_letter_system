<?php

class Position
{
    public function __construct()
    {
        global $conn;
    }
    public static function ListPostion()
    {
        $sql = "SELECT * FROM usr_position WHERE 1=1  AND pos_status='1'";
        $response = db_query($sql);
        return $response;
    }
    public static function SaveData($table, $fields)
    {
        db_insert($table, $fields);
    }
    public static function EditData($table, $fields, $cond)
    {
        db_update($table, $fields, $cond);
    }
    public static function DeleteData($table, $cond)
    {
        db_delete($table, $cond);
    }
}
