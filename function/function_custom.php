<?php
function print_pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function db2Date($date){
;
    $exDate = explode("-",$date);
    return $exDate[2]."/".$exDate[1]."/".($exDate[0]+543);
}