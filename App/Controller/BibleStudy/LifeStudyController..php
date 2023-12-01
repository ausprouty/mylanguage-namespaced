<?php
namespace App\Controller\BibleStudy;
class LifeStudyController{
    private $data;

    public function __construct(){
        $dbConnection = new DatabaseConnection();
        $query = "SELECT * FROM life_principle_references
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
        $translation = new Translation($languageCodeHL, 'life');
        foreach ($this->data as $lesson){
            $translated = $translation->translateText ($lesson['description']);
            $title = $lesson ['lesson'] . '. ' . $translated ;
            $obj =  new stdClass();
            $obj->title = $title;
            $obj->lesson = $lesson['lesson'];
            $obj->testament = $lesson['testament'];
            $formatted[] = $obj;
        }
        return $formatted;
    }
    static function getTitle($lesson, $languageCodeHL){
        $dbConnection = new DatabaseConnection();
        if ($languageCodeHL != 'eng00'){
            $translation = new Translation($languageCodeHL, 'life');
        }
        $query = "SELECT description FROM life_principle_references
        WHERE lesson = :lesson";
        $params = array(':lesson'=> $lesson);
        try {
            $statement = $dbConnection->executeQuery($query, $params);
            $title = $statement->fetch(PDO::FETCH_COLUMN);
            if ($languageCodeHL != 'eng00'){
                $title = $translation->translateText ($title);
            }
            return  $title;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}