<?php

$segments = new JesusVideoSegmentController();
if ($languageCodeHL =='eng00'){
    $data = $segments->formatWithEnglishTitle();
}
else{
    $data = $segments->formatWithEthnicTitle($languageCodeHL);
}
ReturnDataController::returnData($data);
