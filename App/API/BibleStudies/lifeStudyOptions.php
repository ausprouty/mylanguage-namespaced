<?php
use App\Controller\BibleStudy\LifeStudyController as LifeStudyController;

$lessons = new LifeStudyController();
if (!isset ($languageCodeHL1)){
    $data = $lessons->formatWithEnglishTitle();
}
else{
    $data = $lessons->formatWithEthnicTitle($languageCodeHL1);
}
ReturnDataController::returnData($data);