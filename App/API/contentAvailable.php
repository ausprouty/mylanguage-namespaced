<?php

// what learning opportunities are there?
// returns options
use  App\Controller\ReturnDataController as ReturnDataController;

$content = new ContentAvailableController ($languageCodeHL1, $languageCodeHL2);
ReturnDataController::returnData($content->getAllOptions());

