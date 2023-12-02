<?php

use App\Controller\ReturnDataController as ReturnDataController;
use App\Model\Language\LanguageModel as LanguageModel;

$languageCodeHL = strip_tags($languageCodeHL);
$language = new LanguageModel();
$data = $language->findOneByLanguageCodeHL( $languageCodeHL);
ReturnDataController::returnData($data);


