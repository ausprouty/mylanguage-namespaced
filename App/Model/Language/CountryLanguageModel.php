<?php

namespace App\Model\Language;

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
use PDO as PDO;

class CountryLanguageModel
{
    private $id;
    private $countryCode;
    private $languageCodeIso;
    private $languageCodeHL;
    private $languageNameEnglish;
   

    public function __construct(){
        $this->countryCode= '';
        $this->langaugeCodeHL = '';
        $this->languageNameEnglish= '';
    }
    static function getLanguagesWithContentForCountry($countryCode){
       $dbConnection = new DatabaseConnectionModel();
       $query = "SELECT *
                  FROM country_languages 
                  WHERE countryCode = :countryCode
                  AND languageCodeHL != :blank
                  ORDER BY languageNameEnglish";
                  $params = array(':countryCode'=> $countryCode,
                    ':blank'=> '');
        try {
            $statement = $dbConnection->executeQuery($query, $params);
            $data = $statement->fetchAll(PDO::FETCH_OBJ);
            return $data;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}