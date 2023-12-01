<?php
$dbConnection = new DatabaseConnection();
$filename = ROOT_IMPORT_DATA . 'JesusClipEndings.txt';
$datafile = file_get_contents($filename);
$count = 0;
$records = explode("\n", $datafile);
foreach ($records as $record){
    $items = explode ("\t", $record);
    if (!isset($items[1])){
        echo ("finished importing ending times");
        return;
    }
    $id = $items[0];
    $minSec = $items[1];
    $times  = explode(':', $minSec);
    $stopTime = $times[0] * 60 + $times[1];
    $query = "UPDATE jesus_video_segments  SET stopTime = :stopTime
    WHERE id = :id
    LIMIT 1";
    $params = array(
        ':stopTime' => $stopTime,
        ':id' => $id
    );
    $dbConnection->executeQuery($query, $params);
}