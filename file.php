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
use PhpOffice\PhpWord\Element\Table;

$sqlStudFullName = DbParse($mysql->query("SELECT `full_name` FROM `$roleSearch` WHERE `user_id` = '$loginId'"));
$studFullName = $sqlStudFullName[0]["full_name"];

$sqlStudentId = DbParse($mysql->query("SELECT `id` FROM `$roleSearch` WHERE `user_id` = '$loginId'"));
$studentId = $sqlStudentId[0]["id"];

$m = explode(' ', $studFullName);
$studentInitials = $m[0] . ' ' . substr($m[1],0,2) . '.' . substr($m[2],0,2) . '.' ;

$practiceArrId = DbParse($mysql->query("SELECT `practice_id` FROM `student_practice` WHERE `student_id` = '$userId'"));
$practiceId = $practiceArrId[0]["practice_id"];

$sqlPracticePlaceName = DbParse($mysql->query("SELECT `name` FROM `practice_place` WHERE `practice_id` = '$practiceId'"));
$practicePlaceName = $sqlPracticePlaceName[0]["name"];

$sqlPracticeName = DbParse($mysql->query("SELECT `name` FROM `practice` WHERE `id` = '$practiceId'"));
$practiceName = $sqlPracticeName[0]["name"];

$sqlPracticeTerm = DbParse($mysql->query("SELECT `term` FROM `practice` WHERE `id` = '$practiceId'"));
$practiceTerm = $sqlPracticeTerm[0]["term"];
$m = explode(' - ', $practiceTerm);
$firstDate = $m[0];
$secondDate = $m[1];

$sqlPracticeType = DbParse($mysql->query("SELECT `practice_type` FROM `practice` WHERE `id` = '$practiceId'"));
$practiceType = $sqlPracticeType[0]["practice_type"];

$sqlPracticeVid = DbParse($mysql->query("SELECT `practice_vid` FROM `practice` WHERE `id` = '$practiceId'"));
$practiceVid = $sqlPracticeVid[0]["practice_vid"];

$sqlPracticeYear = DbParse($mysql->query("SELECT `year` FROM `practice` WHERE `id` = '$practiceId'"));
$practiceYear = $sqlPracticeYear[0]["year"];


$sqlTasksId = DbParse($mysql->query("SELECT `tasks_id` FROM `student_practice` WHERE `student_id` = '$studentId'"));
$tasksId = $sqlTasksId[0]["tasks_id"];
$sqlTasks = DbParse($mysql->query("SELECT `name` FROM `tasks` WHERE `id` = '$tasksId'"));
$tasks = $sqlTasks[0]["name"];
$m = preg_split('/[:;]/', $tasks);
$tasksName = [];
$j = 0;
for($i = 0; $i<count($m); $i += 2) {
    $tasksName[$j] = $m[$i];
    $j++;
}
$tasksName = preg_replace('/[\n]/','', $tasksName);
$tasks = '';

for($i = 1; $i < count($tasksName); $i++) {
    $tasks = $tasks . "$i)" . $tasksName[$i - 1] . "\n";
}
$tasks = str_replace("\n", "<w:br/>", $tasks);

$sqlQualities = DbParse($mysql->query("SELECT `qualities` FROM `student_practice` WHERE `student_id` = '$studentId'"));
$qualities = $sqlQualities[0]["qualities"];

$sqlComments = DbParse($mysql->query("SELECT `comments` FROM `student_practice` WHERE `student_id` = '$studentId'"));
$comments = $sqlComments[0]["comments"];

$sqlWorkload = DbParse($mysql->query("SELECT `workload` FROM `student_practice` WHERE `student_id` = '$studentId'"));
$workload = $sqlWorkload[0]["workload"];

$sqlMark = DbParse($mysql->query("SELECT `mark` FROM `student_practice` WHERE `student_id` = '$studentId'"));
$mark = $sqlMark[0]["mark"];

$sqlDifficults = DbParse($mysql->query("SELECT `difficults` FROM `student_practice` WHERE `student_id` = '$studentId'"));
$difficults = $sqlDifficults[0]["difficults"];

$sqlGroupId = DbParse($mysql->query("SELECT `group_id` FROM `student` WHERE `user_id` = '$loginId'"));
$groupId = $sqlGroupId[0]["group_id"];
$sqlGroupNum = DbParse($mysql->query("SELECT `num` FROM `group` WHERE `id` = '$groupId'"));
$groupNum = $sqlGroupNum[0]["num"];

$sqlCourseNum = DbParse($mysql->query("SELECT `course_num` FROM `group` WHERE `id` = '$groupId'"));
$courseNum = $sqlCourseNum[0]["course_num"];

$sqlDirectionId = DbParse($mysql->query("SELECT `direction_id` FROM `group` WHERE `id` = '$groupId'"));
$directionId = $sqlDirectionId[0]["direction_id"];
$sqlDirectionName = DbParse($mysql->query("SELECT `name` FROM `direction` WHERE `id` = '$directionId'"));
$directionName = $sqlDirectionName[0]["name"];

$sqlInstituteId = DbParse($mysql->query("SELECT `institute_id` FROM `direction` WHERE `id` = '$directionId'"));
$instituteId = $sqlInstituteId[0]["institute_id"];
$sqlInstituteName = DbParse($mysql->query("SELECT `name` FROM `institute` WHERE `id` = '$instituteId'"));
$instituteName = $sqlInstituteName[0]["name"];

$sqlCompanyLeaderId = DbParse($mysql->query("SELECT `company_leader_id` FROM `practice` WHERE `id` = '$practiceId'"));
$companyLeaderId = $sqlCompanyLeaderId[0]["company_leader_id"];

$sqlPracticeAddress = DbParse($mysql->query("SELECT `address` FROM `practice_place` WHERE `practice_id` = '$practiceId'"));
$practiceAddress = $sqlPracticeAddress[0]["address"];

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
$_doc->setValue('usuTitle', "$usuTitle");
$_doc->setValue('practiceType', "$practiceType");
$_doc->setValue('practiceVid', "$practiceVid");
$_doc->setValue('practiceTerm', "$practiceTerm");
$_doc->setValue('instituteName', "$instituteName");
$_doc->setValue('practiceAddress', "$practiceAddress");
$_doc->setValue('directionName', "$directionName");
$_doc->setValue('studentInitials', "$studentInitials");
$_doc->setValue('firstDate', "$firstDate");
$_doc->setValue('secondDate', "$secondDate");
$_doc->setValue('tasks', "$tasks");
$_doc->setValue('mark', "$mark");
$_doc->setValue('qualities', "$qualities");
$_doc->setValue('workload', "$workload");
$_doc->setValue('comments', "$comments");
$_doc->setValue('difficults', "$difficults");

$img_Dir = $_SERVER['DOCUMENT_ROOT']."/";
@mkdir($img_Dir, 0777);
$file = str_replace("/","-", "Отчёт №".date("d-m-Y")).".docx";
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
