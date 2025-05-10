<?php

class Report
{
    public function __construct()
    {
        global $conn;
    }
    public static function ListRule(array $req) // flag = Y ดึงมาใช้งาน
    {
        $filter = "dep_id='" . $req['dep_id'] . "'";
        if ($req['startDate'] != "" && $req['endDate'] != "") {
            $filter .= "  AND (letter_date >= '" . $req['startDate'] . "' AND letter_date <= '" . $req['endDate'] . "')";
        } else if ($req['startDate']  != "") {
            $filter .= " AND letter_date='" . $req['startDate'] . "'";
        } else if ($req['endDate']  != "") {
            $filter .= " AND letter_date='" . $req['endDate'] . "'";
        }
        $reponse = db_query("SELECT CONCAT(prefix_name,usr_fname,' ',usr_lname) as fullname,frm_target.usr_id,m_letter.letter_id,usr_dep_name,usr_pos_name,m_letter.* FROM m_letter
        INNER JOIN frm_target ON frm_target.letter_id =  m_letter.letter_id WHERE $filter ORDER BY letter_date desc");
        return $reponse;
    }
    public static function  getruleList(array $req)
    {
        $filter = " AND dep_id='" . $req['dep_id'] . "'";
        if ($req['startDate'] != "" && $req['endDate'] != "") {
            $filter .= "  AND (letter_date >= '" . $req['startDate'] . "' AND letter_date <= '" . $req['endDate'] . "')";
        } else if ($req['startDate']  != "") {
            $filter .= " AND letter_date='" . $req['startDate'] . "'";
        } else if ($req['endDate']  != "") {
            $filter .= " AND letter_date='" . $req['endDate'] . "'";
        }
        $reponse = db_query("SELECT rule_name,count(1) as countrule FROM frm_target
                            INNER JOIN  frm_letter_rule ON frm_letter_rule.letter_id=frm_target.letter_id
                            INNER JOIN  m_letter ON m_letter.letter_id=frm_letter_rule.letter_id
                            WHERE  frm_target.usr_id='" . $req['usrId'] . "' $filter
                            GROUP BY rule_id");
        return $reponse;
    }
}
