<?php
namespace App\Controller\BibleStudy;

class DbsStudyController{
    private $data;

    public function __construct(){
        $dbConnection = new DatabaseConnection();
        $query = "SELECT * FROM dbs_references
        ORDER BY lesson";
        try {
            $statement = $dbConnection->executeQuery($query);
            $this->data = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    public function formatWithEnglishTitle(){
        $formated = [];
        foreach ($this->data as $lesson){
            $title = $lesson ['lesson'] . '. ' . $lesson['description']  . ' (' . $lesson['reference'] . ')';
            $obj =  new stdClass();
            $obj->title = $title;
            $obj->lesson = $lesson['lesson'];
            $obj->testament = $lesson['testament'];
            $formatted[] = $obj;
        }
        return $formatted;
    }
    public function formatWithEthnicTitle($languageCodeHL){
        $formated = [];
        $otAvailable = Bible::oldTestamentAvailable($languageCodeHL);
        $translation = new Translation($languageCodeHL, 'dbs');
        writeLogDebug('dbs-33', $this->data);
        foreach ($this->data as $lesson){
            if ($lesson['testament'] == 'NT' || ($lesson['testament'] == 'OT' && $otAvailable)){
                $translated = $translation->translateText ($lesson['description']);
                $title = $lesson ['lesson'] . '. ' . $translated ;
                $obj =  new stdClass();
                $obj->title = $title;
                $obj->lesson = $lesson['lesson'];
                $obj->testament = $lesson['testament'];
                $formatted[] = $obj;
            }
        }
        return $formatted;
    }
    static function getTitle($lesson, $languageCodeHL){
        writeLogDebug('title-48', $languageCodeHL);
        $dbConnection = new DatabaseConnection();
        if ($languageCodeHL != 'eng00'){
            $translation = new Translation($languageCodeHL, 'dbs');
        }
        $query = "SELECT description FROM dbs_references
        WHERE lesson = :lesson";
        $params = array(':lesson'=> $lesson);
        try {
            $statement = $dbConnection->executeQuery($query, $params);
            $title = $statement->fetch(PDO::FETCH_COLUMN);
            writeLogDebug('title-59', $title);
            if ($languageCodeHL != 'eng00'){
                $title = $translation->translateText($title);
            }
            return $lesson . '. '. $title;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}