<?php

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;

$file = ROOT_IMPORT_DATA . 'Lumo.json';
$text = file_get_contents($file);
$results = json_decode($text);
$dbConnection = new DatabaseConnectionModel();
foreach ($results as $lumo){
    $jfCode = '1_' . $lumo->JFCpde . '-jf%';
    writeLogAppend('lumo-9', $jfCode);
    $query = "SELECT * FROM jesus_video_languages WHERE filmCode LIKE :filmCode LIMIT 1";
    $params = array(':filmCode' => $jfCode );
    $statement = $dbConnection->executeQuery($query, $params);
    $data = $statement->fetch(PDO::FETCH_OBJ);
    if ($data){
        if ($lumo->Matthew == 'x'){
            $filmCode = '6_' . $lumo->JFCpde . '-GOMatt';
            $filmTitle = 'Matthew';
            insertIntoDatabase($filmCode, $filmTitle, $data);
        }
        if ($lumo->Mark == 'x'){
            $filmCode = '6_' . $lumo->JFCpde . '-GOMark';
            $filmTitle = 'Mark';
            insertIntoDatabase($filmCode, $filmTitle, $data);
        }
        if ($lumo->Luke == 'x'){
            $filmCode = '6_' . $lumo->JFCpde . '-GOLuke';
            $filmTitle = 'Luke';
            insertIntoDatabase($filmCode, $filmTitle, $data);
        }
        if ($lumo->John == 'x'){
            $filmCode = '6_' . $lumo->JFCpde . '-GOJohn';
            $filmTitle = 'John';
            insertIntoDatabase($filmCode, $filmTitle, $data);
        }
    }
    else{
        writeLogAppend('ERROR-ImportLumo', $jfCode);
    }
}

function insertIntoDatabase($filmCode, $filmTitle, $data){
    $dbConnection = new DatabaseConnectionModel();
    $query = "INSERT INTO jesus_video_languages (title, language, languageEthnic, languageCodeIso, languageCodeHL, filmCode)  
        VALUES (:title, :language, :languageEthnic, :languageCodeIso, :langugeCodeHL, :filmCode)";
    $params = array(
        ':title' => $filmTitle , 
        ':language' => $data->language, 
        ':languageEthnic' => $data->languageEthnic, 
        ':languageCodeIso' =>  $data->languageCodeIso , 
        ':langugeCodeHL' => $data->languageCodeHL  , 
        ':filmCode' => $filmCode
    );
    $statement = $dbConnection->executeQuery($query, $params);

}

