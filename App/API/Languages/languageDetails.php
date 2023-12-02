<?php

use App\Controller\ReturnDataController as ReturnDataController;

$languageCodeHL = strip_tags($languageCodeHL);
$language = new Language();
$data = $language->findOneByLanguageCodeHL( $languageCodeHL);
ReturnDataController::returnData($data);


