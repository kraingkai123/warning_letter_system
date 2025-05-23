<?php

class MisTake
{
    public function __construct()
    {
        global $conn;
    }
    public static function ListMistake($status="")
    {
          if ($status == 'Y') {
            $filter = " AND mistake_status = '1'";
        }
        $sql = "SELECT * FROM mistake WHERE 1=1 $filter";
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
    public static function getDataMistake($mistake_id)
    {
        $sql = "SELECT * FROM mistake WHERE 1=1 AND mistake_status=1 AND mistake_id='".$mistake_id."'";
        $response = db_queryFirst($sql);
        return $response;
    }

}
