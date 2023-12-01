<?php


// get rid of /https://api.arclight.org/videoPlayerUrl?refId=

$dbConnection = new DatabaseConnection();
$query = "SELECT * FROM jesus_video_segments";
$statement = $dbConnection->executeQuery($query);
$results = $statement->fetchAll(PDO::FETCH_OBJ);
foreach ($results as $data){
    $videoSegment = str_replace('jf', '', $data->videoSegment);
    $query = "UPDATE  jesus_video_segments SET videoSegment = :videoSegment WHERE id = :id";
    $params = array(':videoSegment'=> $videoSegment, ':id' => $data->id);
    $statement = $dbConnection->executeQuery($query, $params);
}