<?php


// get rid of /https://api.arclight.org/videoPlayerUrl?refId=

$dbConnection = new DatabaseConnection();
$query = "SELECT * FROM life_principles";
$statement = $dbConnection->executeQuery($query);
$results = $statement->fetchAll(PDO::FETCH_OBJ);
foreach ($results as $data){
    $search = 'https://api.arclight.org/videoPlayerUrl?refId=';
    $video_url = str_replace($search, '', $data->video_url);
    $query = "UPDATE  life_principles SET video_url = :video_url WHERE lesson = :lesson";
    $params = array(':video_url'=> $video_url, ':lesson' => $data->lesson);
    $statement = $dbConnection->executeQuery($query, $params);
}