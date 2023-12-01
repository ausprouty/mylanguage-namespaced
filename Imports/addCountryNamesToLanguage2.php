<?php

/*
working with Data supplied by VAnce Nordman
Save in /imports/data as json

This will see if we haved all countries
*/
$filename = ROOT_IMPORT_DATA . 'LanguageCountries4.txt';

if (!file_exists($filename)){
    echo ($filename . '
    <ul>
    <li> Get filename so you can check to see that all countries are in our database</li>
    </ul>');
    return;

}
$dbConnection = new DatabaseConnectionUtf8();
$fileContents = file_get_contents($filename);
$results = explode("\n", $fileContents);
foreach ($results as $line){
    $item = explode ("\t", $line);
    $language = trim ($item[0]);
    if (!isset($item[1])){
        writeLogAppend('MissingCountry-27', $item[0]);
        continue;
    }
    $country =  rtrim ($item[1]);
    if (strlen ($country) == 2){
        writeLogAppend('UpdateLangauge-27', $item[0]);
        $query = 'UPDATE hl_languages 
        SET countryCodeIso = :countryCodeIso
        WHERE  name = :name';
        $params = array(':countryCodeIso'=>  $country, 
            ':name'=> $language);
        $statement = $dbConnection->executeQuery($query, $params);
    }
}
echo ('finished');


