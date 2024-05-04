<?php
session_start();
$title = 'Главная';
$fname = $__FILE__;

require_once "blocks/header.php";
?>

<h1 class="mt-5">Главная</h1>
<a href="file.php" class="btn btn-success mt-1 mb-2">Сгенерировать</a>

<?php
require_once "blocks/footer.php";
?>