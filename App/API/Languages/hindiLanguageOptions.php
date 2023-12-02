<?php

$languages = new HindiLanguageController();
$options = $languages->getLanguageOptions();
ReturnDataController::returnData($options);