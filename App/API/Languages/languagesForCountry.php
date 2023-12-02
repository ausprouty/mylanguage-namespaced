<?php

use App\Controller\ReturnDataController as ReturnDataController;

$data = CountryLanguages::getLanguagesWithContentForCountry($countryCode);
ReturnDataController::returnData($data);