<?php
$videoCode = VideoController::getVideoCodeFromTitle($title, $languageCodeHL);
ReturnDataController::returnData($videoCode);
