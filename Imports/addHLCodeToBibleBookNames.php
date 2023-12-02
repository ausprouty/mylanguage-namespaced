<?php

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;

$isoCodes = getIso();
foreach ($isoCodes as $isoCode){
    $hlCode = getHL($isoCode['languageCodeIso']);
    if ($hlCode){
        echo ("$hlCode<br>");
        updateBibleBookNames($hlCode, $isoCode['languageCodeIso']) ;
    }
}

function getIso(){
    $dbConnection = new DatabaseConnectionModel();
    $query = "SELECT distinct languageCodeIso FROM bible_book_names
        WHERE languageCodeHL = :blank";
    $params = array(':blank' => '' );
    $statement = $dbConnection->executeQuery($query, $params);
    $isoCodes= $statement->fetchAll(PDO::FETCH_ASSOC);
    return $isoCodes;
}
function getHL($isoCode){
    $dbConnection = new DatabaseConnectionModel();
    $query = "SELECT languageCodeHL FROM hl_languages
        WHERE languageCodeIso = :languageCodeIso
        LIMIT 1";
    $params = array(':languageCodeIso' => $isoCode );
    $statement = $dbConnection->executeQuery($query, $params);
    $hl= $statement->fetch(PDO::FETCH_COLUMN);
    return $hl;
}
function updateBibleBookNames($hlCode, $isoCode){
    $dbConnection = new DatabaseConnectionModel();
    $query = "UPDATE bible_book_names  SET languageCodeHL = :languageCodeHL
        WHERE languageCodeIso = :languageCodeIso";
    $params = array(
        ':languageCodeIso' => $isoCode ,
        ':languageCodeHL' => $hlCode
    );
    $dbConnection->executeQuery($query, $params);

}
     