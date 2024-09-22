<?php

class LetterType
{
    public function __construct()
    {
        global $conn;
    }
    public static function listLetterType()
    {
        $sql = "SELECT * FROM m_letter_type WHERE 1=1";
        $response = db_query($sql);
        return $response;
    }
    public static function listLetterTypeActive()
    {
        $sql = "SELECT * FROM m_letter_type WHERE 1=1 AND letter_type_status='1'";
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
