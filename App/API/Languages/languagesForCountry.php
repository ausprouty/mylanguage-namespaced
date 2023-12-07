<?php

use App\Controller\ReturnDataController as ReturnDataController;
use  App\Model\Language\CountryLanguageModel as  CountryLanguageModel;

$data = CountryLanguageModel::getLanguagesWithContentForCountry($countryCode);
ReturnDataController::returnData($data);