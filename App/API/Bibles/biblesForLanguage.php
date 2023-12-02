<?php
use  App\Controller\ReturnDataController as ReturnDataController;


$data = Bible::getAllBiblesByLanguageCodeHL($languageCodeHL);
ReturnDataController::returnData($data);
die;