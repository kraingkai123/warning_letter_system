<?php

class Letter
{
    public function __construct()
    {
        global $conn;
    }
    public static function RunNumber()
    {
        $number  = db_getData("SELECT MAX(letter_count)+1 as count FROM m_letter WHERE letter_year='" . date('Y') . "'", 'count');
        if ($number == "") {
            $number = 1;
        }
        $FullNumber = $number . "/" . (date('Y') + 543);
        $reponse['letter_number'] = $FullNumber;
        $reponse['letter_count'] = $number;
        return $reponse;
    }
    public static function SaveData($fields)
    {
        $letter_id = db_insert('m_letter', $fields);
        return $letter_id;
    }
    public static function UpdateData($fields, $letter_id)
    {
        $cond['letter_id'] = $letter_id;
        db_update('m_letter', $fields, $cond);
    }
    public static function ListLetter()
    {
        $reponse = db_query("SELECT * FROM m_letter WHERE dep_id ='" . $_SESSION['dep_id'] . "' order by letter_date DESC,letter_id DESC");
        return $reponse;
    }
    public static function getDataLetter(int $letter_id)
    {
        $reponse = db_queryFirst("SELECT * FROM m_letter WHERE letter_id='" . $letter_id . "'");
        return $reponse;
    }
    public static function getDataTarget(int $letter_id)
    {
        $reponse = db_query("SELECT * FROM frm_target WHERE letter_id='" . $letter_id . "'");
        return $reponse;
    }
    public static function getDataWiness(int $letter_id)
    {
        $reponse = db_query("SELECT * FROM frm_witness WHERE letter_id='" . $letter_id . "'");
        return $reponse;
    }
    public static function ListLetterHr()
    {
        $reponse = db_query("SELECT * FROM m_letter WHERE letter_status not in(5,0) order by letter_date DESC,letter_id DESC");
        return $reponse;
    }
}
