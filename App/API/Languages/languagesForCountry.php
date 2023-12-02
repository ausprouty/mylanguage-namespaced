<?php

$data = CountryLanguages::getLanguagesWithContentForCountry($countryCode);
ReturnDataController::returnData($data);