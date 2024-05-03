<?php
session_start();
$title = 'Генерация';
$fname = $__FILE__;
require_once "blocks/header.php";

include $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$_doc = new \PhpOffice\PhpWord\TemplateProcessor('templates/student.docx');


$_doc->setValue('companyLeader', 'Иванов.И.И'); 
$_doc->setValue('companyTitle', 'Преподаватель'); 

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
