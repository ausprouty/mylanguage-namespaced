<?php

use  App\Controller\ReturnDataController as ReturnDataController;

$data = AskQuestions::gettBestSiteByLanguageCodeHL($languageCodeHL);
ReturnDataController::returnData($data);
die;