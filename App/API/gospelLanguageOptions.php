<?php

$languages = new GospelLanguageController();
$options = $languages->getBilingualOptions();
ReturnDataController::returnData($options);