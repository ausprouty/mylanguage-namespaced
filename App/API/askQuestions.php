<?php

use  App\Controller\ReturnDataController as ReturnDataController;
use App\Model\AskQuestionsModel as AskQuestionsModel;

$data = AskQuestionsModel::gettBestSiteByLanguageCodeHL($languageCodeHL);
ReturnDataController::returnData($data);
die;