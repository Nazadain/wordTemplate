<?php
require_once "blocks/functions.php";

if(basename("$fname") != 'index.php' && $_SESSION['user'] == '') {
    header('Location: /index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <title><?=$title;?></title>
</head>
<body>
    <header>
        <?php 
        if($_SESSION['user'] != '') {
            echo '<a href="/main.php">Главная</a> ';
            echo '<a href="checks/delete-login.php">Выйти</a> ';
        }
        ?>
    </header>
    <div class="container">