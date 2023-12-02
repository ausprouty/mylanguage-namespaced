<?php
/* First we will see if we have the pdf of the study you want.
   If not, we will create it
   Then store it
   Then send you the address of the file you can download
*/
$fileName =  BilingualDbsTemplateController::findFileNamePdf($lesson, $languageCodeHL1, $languageCodeHL2);
$path = BilingualDbsTemplateController::getPathPdf();
$filePath = $path . $fileName;
//TODO: eliminate commented
//if (!file_exists($filePath)){
    $study= new BilingualDbsTemplateController($languageCodeHL1, $languageCodeHL2, $lesson);
    $html =  $study->getTemplate();
    $styleSheet = 'dbs.css';
    $mpdf = new PdfController($languageCodeHL1, $languageCodeHL);
    $mpdf->writePdfToComputer($html, $styleSheet, $filePath);
//}
$url = BilingualDbsTemplateController::getUrlPdf();
$response['url'] = $url . $fileName;
$response['name'] = $fileName;
ReturnDataController::returnData($response);
