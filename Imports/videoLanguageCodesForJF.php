<?php

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
use PDO as PDO;

$dbConnection = new DatabaseConnectionModel();

$query = "SELECT * FROM jesus_video_languages";
$statement = $dbConnection->executeQuery($query);
$result = $statement->fetchAll(PDO::FETCH_OBJ);
foreach($result as $data){
    $languageCodeJF = substr($data->videoCode, 2);
    $end = strpos($languageCodeJF, '-');
    $languageCodeJF = substr($languageCodeJF, 0, $end);
    $query = "UPDATE jesus_video_languages SET languageCodeJF = :languageCodeJF
        WHERE id = :id LIMIT 1";
    $params = array(':languageCodeJF' => $languageCodeJF, ':id' => $data->id);
    $statement = $dbConnection->executeQuery($query, $params);
}
echo ('done');