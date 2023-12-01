<?php
/* First we will see if we have the pdf of the study you want.
   If not, we will create it
   Then store it
   Then send you the address of the file you can download
*/
$fileName =  BilingualLifeTemplateController::findFileNamePdf($lesson, $languageCodeHL1, $languageCodeHL2);
$path = BilingualLifeTemplateController::getPathPdf();
$filePath = $path . $fileName;
//if (!file_exists($filePath)){
    writeLogDebug('life-11', $filePath);
    $study = new BilingualLifeTemplateController($languageCodeHL1, $languageCodeHL2, $lesson);
    $html =  $study->getTemplate();
    writeLogDebug('life-14', $html);
    $styleSheet = 'dbs.css';
    $mpdf = new PdfController($languageCodeHL1, $languageCodeHL2);
    $mpdf->writePdfToComputer($html, $styleSheet, $filePath);
//}
$url = BilingualLifeTemplateController::getUrlPdf();
$response['url'] = $url . $fileName;
$response['name'] = $fileName;
writeLogDebug('life-19', $response);
ReturnDataController::returnData($response);