<?php

namespace App\Controller\Language;

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
use App\Model\Video\VideoModel as VideoModel;
use PDO as PDO;
use StdClass as StClass;


class HindiLanguageController{

    public function getLanguageOptions(){
        $result = $this->getLanguageData();
        $output = $this->addLanguageCodeJF($result);
        return $output;
    }

    public function getLanguageData(){
        $dbConnection = new DatabaseConnectionModel();
        $query = "SELECT *
                  FROM hl_languages
                  WHERE isHindu  = 'Y'
                  ORDER BY name";
        try {
            $statement = $dbConnection->executeQuery($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    private function getLanguageCodeJF($result){
        $data = [];
        foreach ($result as $language){
            $obj = new StdClass;
            $obj = $language;
            $obj['languageCodeJF'] = VideoModel::getLanguageCodeJF($language['languageCodeHL']);
            $data[] = $obj;
        }
        return $data;
    }
}
