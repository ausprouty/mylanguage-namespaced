<?php

use  App\Controller\ReturnDataController as ReturnDataController;

$data = Bible::getTextBiblesByLanguageCodeHL($languageCodeHL );
ReturnDataController::returnData($data);
die;