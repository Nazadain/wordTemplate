<?php
session_start();

require_once "../blocks/functions.php";
    
unset($_SESSION['error_login']);
unset($_SESSION['user']);
unset($_SESSION['role']);

$mysql = new mysqli("localhost", "root", "", "wordTemplateDb");
$mysql->query("SET NAMES 'utf8'");
    
$dbUsers = $mysql->query("SELECT * FROM `user`");
$dbArr = [];

$dbArr = DbParse($dbUsers);

$username = trim(strtolower($_POST['username']));
$password = trim(md5($_POST['password']));
$_SESSION['username'] = $username;

if(IsInArray($username, $dbArr)) {
    $user = DbParse($mysql->query("SELECT `username`, `password`, `role_name` FROM `user` WHERE `username` = '$username'"));
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