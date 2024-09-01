<?php

class Department
{
    public function __construct()
    {
        global $conn;
    }
    public static function ListDepartment()
    {
        $sql = "SELECT * FROM usr_department WHERE 1=1";
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
