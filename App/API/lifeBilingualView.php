<?php
/* First we will see if we have the view of the study you want.
   If not, we will create it
   Then store it
   Then send you the text you need
*/
$fileName = DbsLanguageController::bilingualDbsViewFilename( 
    $languageCodeHL1, $languageCodeHL2, $lesson , 'Principle');
$path = BilingualLifeTemplateController::getPathView();
$filePath = $path . $fileName;
//if (!file_exists($filePath)){
    $study = new BilingualLifeTemplateController($languageCodeHL1, $languageCodeHL2, $lesson);
    $html =  $study->getTemplate();
    $study->saveBilingualView();
//}
$response = file_get_contents($filePath);
ReturnDataController::returnData($response);