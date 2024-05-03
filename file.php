<?php
session_start();
$fname = $__FILE__;
require_once "blocks/header.php";

//***Обработка данных из бд***//
$mysql = new mysqli("localhost", "root", "", "wordTemplateDb");
$mysql->query("SET NAMES 'utf8'");

$roleSearch = '';
$sqlUser = DbParse($mysql->query("SELECT `id`, `role_name` FROM `user` WHERE `username` = '$_SESSION[user]'"));
$roleName = $sqlUser[0]['role_name'];
$loginId = $sqlUser[0]['id'];

if($roleName == 'student') $roleSearch = 'student';
else if($roleName == 'bpep_leader') $roleSearch = 'program_leader';
else if($roleName == 'usu_leader') $roleSearch = 'USU_practice_leader';
else if($roleName == 'company_leader') $roleSearch = 'company_practice_leader';

$idArr = DbParse($mysql->query("SELECT * FROM `$roleSearch` WHERE `user_id` = '$loginId'"));
$userId = $idArr[0]["id"];


//***Генерация файла***//
include $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$_doc = new \PhpOffice\PhpWord\TemplateProcessor('templates/student.docx');

$sqlStudFullName = DbParse($mysql->query("SELECT `full_name` FROM `$roleSearch` WHERE `user_id` = '$loginId'"));
$studFullName = $sqlStudFullName[0]["full_name"];

$practiceArrId = DbParse($mysql->query("SELECT `practice_id` FROM `student_practice` WHERE `student_id` = '$userId'"));
$practiceId = $practiceArrId[0]["practice_id"];

$sqlPracticePlaceName = DbParse($mysql->query("SELECT `name` FROM `practice_place` WHERE `practice_id` = '$practiceId'"));
$practicePlaceName = $sqlPracticePlaceName[0]["name"];

$sqlPracticeName = DbParse($mysql->query("SELECT `name` FROM `practice` WHERE `id` = '$practiceId'"));
$practiceName = $sqlPracticeName[0]["name"];

$sqlPracticeYear = DbParse($mysql->query("SELECT `year` FROM `practice` WHERE `id` = '$practiceId'"));
$practiceYear = $sqlPracticeYear[0]["year"];

$sqlGroupId = DbParse($mysql->query("SELECT `group_id` FROM `student` WHERE `user_id` = '$loginId'"));
$groupId = $sqlGroupId[0]["group_id"];
$sqlGroupNum = DbParse($mysql->query("SELECT `num` FROM `group` WHERE `id` = '$groupId'"));
$groupNum = $sqlGroupNum[0]["num"];

$sqlCourseNum = DbParse($mysql->query("SELECT `course_num` FROM `group` WHERE `id` = '$groupId'"));
$courseNum = $sqlCourseNum[0]["course_num"];

$sqlCourseNum = DbParse($mysql->query("SELECT `course_num` FROM `group` WHERE `id` = '$groupId'"));
$courseNum = $sqlCourseNum[0]["course_num"];

$sqlCompanyLeaderId = DbParse($mysql->query("SELECT `company_leader_id` FROM `practice` WHERE `id` = '$practiceId'"));
$companyLeaderId = $sqlCompanyLeaderId[0]["company_leader_id"];

$sqlCompanyLeaderFullName = DbParse($mysql->query("SELECT `full_name` FROM `company_practice_leader` WHERE `id` = '$companyLeaderId'"));
$companyLeaderFullName = $sqlCompanyLeaderFullName[0]["full_name"];

$m = explode(' ', $companyLeaderFullName);
$companyLeaderInitials = $m[0] . ' ' . substr($m[1],0,2) . '.' . substr($m[2],0,2) . '.' ;

$sqlUsuLeaderId = DbParse($mysql->query("SELECT `usu_leader_id` FROM `practice` WHERE `id` = '$practiceId'"));
$usuLeaderId = $sqlUsuLeaderId[0]["usu_leader_id"];

$sqlUsuLeaderFullName = DbParse($mysql->query("SELECT `full_name` FROM `usu_practice_leader` WHERE `id` = '$usuLeaderId'"));
$usuLeaderFullName = $sqlUsuLeaderFullName[0]["full_name"];

$m = explode(' ', $usuLeaderFullName);
$usuLeaderInitials = $m[0] . ' ' . substr($m[1],0,2) . '.' . substr($m[2],0,2) . '.' ;

$sqlCompanyTitle = DbParse($mysql->query("SELECT `job_title` FROM `company_practice_leader` WHERE `id` = '$companyLeaderId'"));
$companyTitle = $sqlCompanyTitle[0]["job_title"];

$sqlUsuTitle = DbParse($mysql->query("SELECT `job_title` FROM `usu_practice_leader` WHERE `id` = '$usuLeaderId'"));
$usuTitle = $sqlUsuTitle[0]["job_title"];


$_doc->setValue('practicePlace', "$practicePlaceName");
$_doc->setValue('practiceName', "$practiceName"); 
$_doc->setValue('year', "$practiceYear"); 
$_doc->setValue('studFullName', "$studFullName");
$_doc->setValue('course', "$courseNum"); 
$_doc->setValue('group', "$groupNum");  
$_doc->setValue('companyLeader', "$companyLeaderInitials");  
$_doc->setValue('companyTitle', "$companyTitle"); 
$_doc->setValue('usuLeader', "$usuLeaderInitials");  
$_doc->setValue('usuTitle', "$usuTitle"); 

$img_Dir = $_SERVER['DOCUMENT_ROOT']."/";
@mkdir($img_Dir, 0777);
$file = str_replace("/","-", "Договор №".date("d-m-Y")).".docx";
$_doc->saveAs($img_Dir.$file);

$contentType = 'Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document;';

header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
header ( $contentType );
header ( "Content-Disposition: attachment; filename=" . "$file");
readfile($file);
unlink($file);
