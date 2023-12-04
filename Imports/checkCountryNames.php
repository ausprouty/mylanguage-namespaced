<?php

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
use PDO as PDO;
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
$dbConnection = new DatabaseConnectionModel();
$results = json_decode (file_get_contents($filename));
foreach ($results as $data){
    $query = 'SELECT countryCodeIso FROM country_locations WHERE countryNameEnglish = :countryNameEnglish';
    $params = array(':countryNameEnglish'=> $data->Country);
    try {
        $statement = $dbConnection->executeQuery($query, $params);
        $countryCodeIso = $statement->fetch(PDO::FETCH_COLUMN);
        if (!$countryCodeIso){
            echo ($data->Country . '<br>');
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }

}