<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.04.2017
 * Time: 1:04
 */

ini_set("memory_limit", "100M");

require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ilovepdf/init.php');

use Ilovepdf\Ilovepdf;



$ilovepdf = new Ilovepdf(WP_Ilovepdf_project_public, WP_Ilovepdf_secret_key);


// Create a new task
$myTaskConvertPDF = $ilovepdf->newTask('pdfjpg');
//$myTaskConvertPDF = $ilovepdf->PdfjpgTask();
//$myTask = new SplitTask("PUBLIC_KEY", "SECRET_KEY");

//$myTaskConvertPDF = $ilovepdf->newTask('merge');
// Add files to task for upload
$file1 = $myTaskConvertPDF->addFile($_SERVER['DOCUMENT_ROOT'].'/p01.pdf');
//$file2 = $myTaskConvertPDF->addFile($_SERVER['DOCUMENT_ROOT'].'/fff1_color_1.pdf');
// Choose your processing tool
//$myTaskConvertPDF->convertPDFtoJPG();
// Execute the task
$myTaskConvertPDF->execute();
// Download the package files
$myTaskConvertPDF->download();

//PdfjpgTask
/*
// Create a new task
$myTaskMerge = $ilovepdf->newTask('merge');
// Add files to task for upload
$file1 = $myTaskMerge->addFile($_SERVER['DOCUMENT_ROOT'].'/fff1_color.pdf');
$file2 = $myTaskMerge->addFile($_SERVER['DOCUMENT_ROOT'].'/fff1_color_1.pdf');
// Execute the task
$myTaskMerge->execute();
// Download the package files
$myTaskMerge->download();
*/

