<?php

$file = ROOT_IMPORT_DATA . 'JesusVideoSegments.json';
$text = file_get_contents($file);
$results = json_decode($text);
$dbConnection = new DatabaseConnection();
foreach ($results as $data){
    $filmCode = $data->film_code;
    $filmCode = str_replace('1_529-', '', $filmCode);
    $query = "INSERT INTO jesus_video_segments (id, title, verses, filmCode)  
        VALUES (:id, :title, :verses, :filmCode)";
    $params = array(
        ':id' => $data->segment, 
        ':title' =>  $data->title , 
        ':verses' => $data->luke, 
        ':filmCode' => $filmCode,
    );
    $statement = $dbConnection->executeQuery($query, $params);

    echo ($data->title . '<br>');
  
}

