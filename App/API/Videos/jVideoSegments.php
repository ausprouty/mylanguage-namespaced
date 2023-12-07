<?php
use App\Controller\ReturnDataController as ReturnDataController;
use App\Controller\Video\JesusVideoSegmentController as JesusVideoSegmentController;


$segments = new JesusVideoSegmentController();
if ($languageCodeHL =='eng00'){
    $data = $segments->formatWithEnglishTitle();
}
else{
    $data = $segments->formatWithEthnicTitle($languageCodeHL);
}
ReturnDataController::returnData($data);
