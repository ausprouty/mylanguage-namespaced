<?php
use App\Controller\ReturnDataController as ReturnDataController;

$result = Video::getLanguageCodeJFFollowingJesus($languageCodeHL);
ReturnDataController::returnData($result);