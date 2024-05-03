<?php
session_start();
$title = 'Логин';
$fname = __FILE__;

function redirect($location) {
    header("Location: $location");
    exit;
}

if($_SESSION['user'] != '') {
    redirect('/main.php');
}

require_once "blocks/header.php";
?>

<h1>Логин</h1>
<form action="checks/check-login.php" method="post">
    <input type="text" name="username" placeholder="Логин" value="<?=$_SESSION['username']?>" class="form-control">
    <input type="password" name="password" placeholder="Пароль" class="form-control mt-1">
    <span class="text-danger"><?=$_SESSION['error_login']?></span><br>
    <input type="submit" value="Отправить" class="btn btn-success mt-1 mb-2">
</form>

<?php
require_once "blocks/footer.php";
?>