<?php

use App\Controller\ReturnDataController as ReturnDataController;

$videoCode = VideoController::getVideoCodeFromTitle($title, $languageCodeHL);
ReturnDataController::returnData($videoCode);
