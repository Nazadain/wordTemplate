<?php
session_start();
$title = 'Главная';
$fname = $__FILE__;
require_once "blocks/header.php";

$mysql = new mysqli("localhost", "root", "", "wordTemplateDb");
$mysql->query("SET NAMES 'utf8'");

if($_SESSION['role'] == 'student') $roleSearch = 'student';
else if($_SESSION['role'] == 'bpep_leader') $roleSearch = 'program_leader';
else if($_SESSION['role'] == 'usu_leader') $roleSearch = 'USU_practice_leader';
else if($_SESSION['role'] == 'company_leader') $roleSearch = 'company_practice_leader';

$userId = $_SESSION['userId'];

$sqlFullName = DbParse($mysql->query("SELECT `full_name` FROM `$roleSearch` WHERE `user_id` = '$userId'"));
$fullName = $sqlFullName[0]['full_name'];
?>

<h1 class="mt-5">Главная</h1>
<?php echo("<p>$fullName</p>")?>
<a href="file.php" class="btn btn-success mt-1 mb-2">Сгенерировать</a>

<?php
require_once "blocks/footer.php";
?>