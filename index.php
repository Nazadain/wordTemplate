<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$_doc = new \PhpOffice\PhpWord\TemplateProcessor('local-template.docx');

$_doc->setValue('course', "2"); 
$_doc->setValue('group', "1121б"); 
$_doc->setValue('fullName', "Пономаренко Егор Андреевич"); 

$img_Dir = $_SERVER['DOCUMENT_ROOT']."/"; 
@mkdir($img_Dir, 0777);
$file = str_replace("/","-", "Договор №".date("d-m-Y")).".docx";
$_doc->saveAs($img_Dir.$file);