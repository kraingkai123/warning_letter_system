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
    public static function getDataType($lt_id)
    {
        $sql = "SELECT * FROM m_letter_type WHERE 1=1 AND lt_id = '" . $lt_id . "'";
        $response = db_queryFirst($sql);
        for ($i = 1; $i < 4; $i++) {
            $response['detail_' . $i] = str_replace("&nbsp;", ' ', $response['detail_' . $i]);
        }
        return $response;
    }
}
