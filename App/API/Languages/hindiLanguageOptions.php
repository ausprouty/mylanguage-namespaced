<?php

use App\Controller\ReturnDataController as ReturnDataController;

$languages = new HindiLanguageController();
$options = $languages->getLanguageOptions();
ReturnDataController::returnData($options);