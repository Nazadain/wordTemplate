<?php
session_start();
$title = 'Генерация';
$fname = $__FILE__;
require_once "blocks/header.php";

include $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$_doc = new \PhpOffice\PhpWord\TemplateProcessor('templates/student.docx');


// $_doc->setValue('companyLeader', 'Иванов.И.И'); 
// $_doc->setValue('companyTitle', 'Преподаватель'); 

// $img_Dir = $_SERVER['DOCUMENT_ROOT']."/"; 
// @mkdir($img_Dir, 0777);
// $file = str_replace("/","-", "Договор №".date("s-d-m-Y")).".docx";
// $_doc->saveAs($img_Dir.$file);



