<?php

use App\Controller\ReturnDataController as ReturnDataController;

$result = Video::getLanguageCodeJF($languageCodeHL);
ReturnDataController::returnData($result);