<?php
use App\Controller\ReturnDataController as ReturnDataController;


$segments = new JesusVideoSegmentController();
if ($languageCodeHL =='eng00'){
    $data = $segments->formatWithEnglishTitle();
}
else{
    $data = $segments->formatWithEthnicTitle($languageCodeHL);
}
ReturnDataController::returnData($data);
