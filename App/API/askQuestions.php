<?php
$data = AskQuestions::gettBestSiteByLanguageCodeHL($languageCodeHL);
ReturnDataController::returnData($data);
die;