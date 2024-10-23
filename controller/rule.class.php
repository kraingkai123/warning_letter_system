<?php

class Rule
{
    public function __construct()
    {
        global $conn;
    }
    public static function ListRule($flags = '') // flag = Y ดึงมาใช้งาน
    {
        if ($flags == 'Y') {
            $filter = " AND RULE_STATUS='Y'";
        }
        $reponse = db_query("SELECT * FROM m_rule WHERE 1=1 $filter  order by rule_id ASC");
        return $reponse;
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
    public static function getruleLetter($letterId) // flag = Y ดึงมาใช้งาน
    {
        $reponse = db_query("SELECT * FROM frm_letter_rule where letter_id='" . $letterId . "' ORDER BY f_id ASC");
        return $reponse;
    }
    public static function GetDataRule($ruleId)
    {
        $sql = "SELECT * FROM m_rule WHERE 1=1  AND rule_id='$ruleId'";
        $response = db_queryFirst($sql);
        return $response;
    }
}
