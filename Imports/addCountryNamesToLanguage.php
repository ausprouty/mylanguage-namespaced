<?php

/*
working with Data supplied by VAnce Nordman
Save in /imports/data as json

This will see if we haved all countries
*/
$filename = ROOT_IMPORT_DATA . 'LanguageCountry.json';

if (!file_exists($filename)){
    echo ($filename . '
    <ul>
    <li> Get filename so you can check to see that all countries are in our database</li>
    </ul>');
    return;

}
$results = json_decode (file_get_contents($filename));
foreach ($results as $data){
    //$countryCodeIso = getCountryCodeIso($data);
    $languageCodeHL = getLanguageCodeHL($data);
    //updateLanguageCountryCode($countryCodeIso, $languageCodeHL);
    //updateLanguageEthnicName($data->LanguageNameNativeScript, $languageCodeHL);
}
function getCountryCodeIso($data){
    $dbConnection = new DatabaseConnection();
    $query = 'SELECT countryCodeIso 
    FROM country_locations
    WHERE countryNameEnglish = :countryNameEnglish';
    $params = array(':countryNameEnglish'=> $data->Country);
    $statement = $dbConnection->executeQuery($query, $params);
    $countryCodeIso = $statement->fetch(PDO::FETCH_COLUMN);
    if (!$countryCodeIso){
        $countryCodeIso = $data->Country;
    }
    return $countryCodeIso;
}
function  getLanguageCodeHL($data){
    $find = 'mylanguage.net.au/watch_online/';
    if (strpos( $data->hyperlinks, $find ) !== FALSE){
        $languageCodeHL = getLanguageCodeHLFromVideoLink($data);
    }
    else{
        $languageCodeHL =  getLanguageCodeHLFromLanguage($data);
    }
    if (!$languageCodeHL){
        writeLogAppend('getLanguageCodeHL',$data->LanguageName  );

    }
    
    return $languageCodeHL;

}
// "https://mylanguage.net.au/watch_online/wlx00/JESUS/1_5276-jf6112-0-0",
function getLanguageCodeHLFromVideoLink($data){
    $languageCodeHL = null;
    $find = 'mylanguage.net.au/watch_online/';
    $hyperlink = $data->hyperlinks;
    $pos_start = strpos($hyperlink, $find) + strlen($find);
    $pos_end = strpos($hyperlink, '/', $pos_start);
    $length = $pos_end - $pos_start;
    $languageCodeHL = substr($hyperlink, $pos_start, $length);
    return $languageCodeHL;
}
function getLanguageCodeHLFromLanguage($data){
    $dbConnection = new DatabaseConnection();
    $query = 'SELECT languageCodeHL
    FROM hl_languages
    WHERE name = :name';
    $params = array(':name'=> $data->LanguageName);
    $statement = $dbConnection->executeQuery($query, $params);
    $languageCodeHL = $statement->fetch(PDO::FETCH_COLUMN);
    return $languageCodeHL;
}
function updateLanguageCountryCode($countryCodeIso, $languageCodeHL){
    $dbConnection = new DatabaseConnection();
    $query = 'UPDATE hl_languages 
    SET countryCodeIso = :countryCodeIso
    WHERE  languageCodeHL = :languageCodeHL';
    $params = array(':countryCodeIso'=>  $countryCodeIso, 
        ':languageCodeHL'=> $languageCodeHL);
    $statement = $dbConnection->executeQuery($query, $params);
}
function updateLanguageEthnicName($LanguageNameNativeScript, $languageCodeHL){
    $dbConnection = new DatabaseConnection();
    $query = 'SELECT  ethnicName FROM  hl_languages 
    WHERE  languageCodeHL = :languageCodeHL';
    $params = array(':languageCodeHL'=> $languageCodeHL);
    $statement = $dbConnection->executeQuery($query, $params);
    $ethnicName = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$ethnicName ){
        $query = 'UPDATE hl_languages 
            SET ethnicName = :ethnicName
                WHERE  languageCodeHL = :languageCodeHL';
        $params = array(':ethnicName'=>  $LanguageNameNativeScript, 
        ':languageCodeHL'=> $languageCodeHL);
        $statement = $dbConnection->executeQuery($query, $params);
    }
}
