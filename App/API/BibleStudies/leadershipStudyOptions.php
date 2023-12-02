<?php

use App\Controller\BibleStudy\LeadershipStudyController as LeadershipStudyController;

$lessons = new LeadershipStudyController();
if (!isset ($languageCodeHL1)){
    $data = $lessons->formatWithEnglishTitle();
}
else{
    $data = $lessons->formatWithEthnicTitle($languageCodeHL1);
}
ReturnDataController::returnData($data);
