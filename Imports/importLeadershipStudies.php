<?php

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;

$file = ROOT_IMPORT_DATA . 'LeadershipStudies.json';
$text = file_get_contents($file);
$results = json_decode($text);
$dbConnection = new DatabaseConnectionModel();
foreach ($results as $data){
    $query = "INSERT INTO leadership_references (lesson, reference, testament, description)  
        VALUES (:lesson, :reference, :testament, :description)";
    $params = array(
        ':lesson' => $data->lesson, 
        ':reference' =>  $data->passage , 
        ':testament' => 'NT', 
        ':description' => $data->title,

    );
    $statement = $dbConnection->executeQuery($query, $params);
  
}

