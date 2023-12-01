<?php

// what learning opportunities are there?
// returns options


$content = new ContentAvailableController ($languageCodeHL1, $languageCodeHL2);
ReturnDataController::returnData($content->getAllOptions());

