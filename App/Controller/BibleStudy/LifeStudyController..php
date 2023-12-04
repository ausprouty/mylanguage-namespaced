<?php
namespace App\Controller\BibleStudy;

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
use App\Model\Language\TranslationModel as TranslationModel;
use PDO as PDO;

class LifeStudyController{
    private $data;

    public function __construct(){
        $dbConnection = new DatabaseConnectionModel();
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
        $translation = new TranslationModel($languageCodeHL, 'life');
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
        $dbConnection = new DatabaseConnectionModel();
        if ($languageCodeHL != 'eng00'){
            $translation = new TranslationModel($languageCodeHL, 'life');
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