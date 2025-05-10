<?php

class Process
{
    public function __construct()
    {
        global $conn;
    }
    public static function ProcessList($letterId)
    {
        $sql = "SELECT * FROM letter_process WHERE 1=1 AND letter_id ='".$letterId."'  ";
        $response = db_query($sql);
        return $response;
    }
    public static function SaveProcess($table, $fields)
    {
        db_insert($table, $fields);
    }
    public static function UpdateProcess($table, $fields, $cond)
    {
        db_update($table, $fields, $cond);
    }
    public static function DeleteData($table, $cond)
    {
        db_delete($table, $cond);
    }
    
}
