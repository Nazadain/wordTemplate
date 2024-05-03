<?php
session_start();
    
unset($_SESSION['error_login']);
unset($_SESSION['user']);
unset($_SESSION['role']);
    

$mysql = new mysqli("localhost", "root", "", "wordTemplateDb");
$mysql->query("SET NAMES 'utf8'");
    
$dbUsers = $mysql->query("SELECT * FROM `user`");
$dbArr = [];

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
function redirect($location) {
    header("Location: $location");
    exit;
}

$dbArr = DbParse($dbUsers);

$username = trim(strtolower($_POST['username']));
$password = trim(md5($_POST['password']));
$_SESSION['username'] = $username;

if(IsInArray($username, $dbArr)) {
    $user = DbParse($mysql->query("SELECT `username`, `password`, `role_id` FROM `user` WHERE `username` = '$username'"));
    if(IsInArray($password, $user)) {
        unset($_SESSION['username']);
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $user[0]['role_id'];
        redirect('/index.php');
    } else {
        $_SESSION['error_login'] = 'Неправильный логин или пароль';
        redirect('/index.php');
    }
} else {
        $_SESSION['error_login'] = 'Неправильный логин или пароль';
        redirect('/index.php');
}