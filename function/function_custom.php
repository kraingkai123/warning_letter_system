<?php
function print_pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function db2Date($date)
{;
    $exDate = explode("-", $date);
    return $exDate[2] . "/" . $exDate[1] . "/" . ($exDate[0] + 543);
}
function date2db($date)
{
    $exDate = explode("/", $date);
    return ($exDate[2] - 543) . "-" . $exDate[1] . "-" . $exDate[0];
}
function convDateThai($date)
{
    $exDate = explode("-", $date);
    $thaiMonths = [
        1 => "มกราคม",    // January
        2 => "กุมภาพันธ์",  // February
        3 => "มีนาคม",      // March
        4 => "เมษายน",     // April
        5 => "พฤษภาคม",   // May
        6 => "มิถุนายน",    // June
        7 => "กรกฎาคม",    // July
        8 => "สิงหาคม",     // August
        9 => "กันยายน",     // September
        10 => "ตุลาคม",     // October
        11 => "พฤศจิกายน",  // November
        12 => "ธันวาคม"     // December
    ];
    return $exDate[2] . " เดือน " . $thaiMonths[intval($exDate[1])] . " พ.ศ. " . ($exDate[0] + 543);
}
