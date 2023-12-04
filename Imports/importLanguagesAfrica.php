<?php
use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
use PDO as PDO;

$file = ROOT_IMPORT_DATA . 'AfricanLanguages.txt';
$text = file_get_contents($file);
$lines = explode("\n", $text);
foreach ($lines as $line){
    if (strpos($line, ':') !== FALSE){
        $countryCode = getCountryCode($line);
    }
    else{
        if (strpos($line, ' - ') !== FALSE){
            $items = explode(' - ', $line);
            $languageName = trim($items[0]);
            $languageCodeIso = trim(strtolower ($items[1]));
            addToDatabase($countryCode, $languageName,$languageCodeIso);
        }
    }

}
echo 'done';

function getCountryCode($line){
    //Somalia (SO):
    $posStart = strpos($line, '(') + 1;
    $countryCode = substr($line, $posStart, 2);
    return $countryCode;
}

function  addToDatabase($countryCode, $languageName,$languageCodeIso){
    $dbConnection = new DatabaseConnectionModel();
    $query = "SELECT languageCodeIso FROM country_languages
    WHERE countryCode = :countryCode
    AND languageCodeIso = :languageCodeIso";
    $params = array(
        ':countryCode' => $countryCode,
        ':languageCodeIso' => $languageCodeIso);
    $statement = $dbConnection->executeQuery($query, $params);
    $previous = $statement->fetch(PDO::FETCH_COLUMN);
    if (!$previous){
        $languageCodeHL = langaugeCodeHL($languageCodeIso, $languageName);
        $query = "INSERT INTO country_languages
            (countryCode, languageCodeIso, languageCodeHL, languageNameEnglish)
            VALUES
            (:countryCode, :languageCodeIso,  :languageCodeHL, :languageNameEnglish)";
        $params = array(
            ':countryCode' => $countryCode,
            ':languageCodeIso' => $languageCodeIso,
            ':languageCodeHL' => $languageCodeHL,
            ':languageNameEnglish' => $languageName);
        $dbConnection->executeQuery($query, $params);
    }
    
}

function langaugeCodeHL($languageCodeIso, $languageName){
    $dbConnection = new DatabaseConnectionModel();
    $query = "SELECT languageCodeHL FROM hl_languages
        WHERE languageCodeIso = :languageCodeIso
        LIMIT 1";
    $params = array(
        ':languageCodeIso' => $languageCodeIso);
    $statement = $dbConnection->executeQuery($query, $params);
    $languageCodeHL = $statement->fetch(PDO::FETCH_COLUMN);
    if (!$languageCodeHL){
        $query = "SELECT languageCodeHL FROM hl_languages
            WHERE name = :languageName
            LIMIT 1";
        $params = array(
            ':languageName' => $languageName);
        $statement = $dbConnection->executeQuery($query, $params);
        $languageCodeHL = $statement->fetch(PDO::FETCH_COLUMN);
    }
    return  $languageCodeHL;

}