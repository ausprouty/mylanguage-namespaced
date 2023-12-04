<?php

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
use PDO as PDO;
// get rid of /https://api.arclight.org/videoPlayerUrl?refId=

$dbConnection = new DatabaseConnectionModel();
$query = "SELECT * FROM life_principles";
$statement = $dbConnection->executeQuery($query);
$results = $statement->fetchAll(PDO::FETCH_OBJ);
foreach ($results as $data){
    $videoSegment = substr($data->videoCode, -4);
    $len = strlen($data->videoCode) -4;
    $videoCode  = substr($data->videoCode, 0, $len);
    echo ("$videoCode - $videoSegment <br>" );
    $query = "UPDATE  life_principles SET videoCode = :videoCode, videoSegment = :videoSegment  WHERE lesson = :lesson";
    $params = array(':videoCode'=> $videoCode, ':videoSegment'=> $videoSegment, ':lesson' => $data->lesson);
    $statement = $dbConnection->executeQuery($query, $params);
}