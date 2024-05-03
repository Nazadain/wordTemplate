<?php

function redirect($location) {
    header("Location: $location");
    exit;
}

function DbParse($database) {
    while($row = $database->fetch_assoc()){
        $arr[] = $row;
    }
    return $arr;
}

function IsInArray($value, $arr) {
    foreach ($arr as $key => $arr_value) {
        foreach ($arr_value as $k => $v) {
            if ($v == $value) {
                return true;
            }   
        }   
    }
    return false;
}