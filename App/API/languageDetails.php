<?php

$languageCodeHL = strip_tags($languageCodeHL);
$language = new Language();
$data = $language->findOneByLanguageCodeHL( $languageCodeHL);
ReturnDataController::returnData($data);


