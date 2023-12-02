<?php

use  App\Controller\ReturnDataController as ReturnDataController;

$languages = new DbsLanguageController();
$options = $languages->getOptions();
ReturnDataController::returnData($options);