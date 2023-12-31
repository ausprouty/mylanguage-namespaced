<?php
use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
use App\Model\Bible\BibleReferenceInfoModel as BibleReferenceInfoModel;
use PDO as PDO;

class  DBSReferenceDatabaseImport{
  private  $dbConnection;

 public function __construct(){
    $this->dbConnection = new DatabaseConnectionModel();
}

public function getLessons()
    {
        $query = "SELECT * FROM dbs_references";
        $params = array();
        try {
            $statement = $this->dbConnection->executeQuery($query, $params);
            $results = $statement->fetchALL(PDO::FETCH_OBJ);
            if($results){
                foreach ($results as $data){
                    $this->makeBibleReferenceInfo($data);
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    private function makeBibleReferenceInfo($data){
        $lesson = $data->lesson;
        $entry= $data->reference;
        $bibleReferenceInfo= new BibleReferenceInfoModel();
        $export =  $bibleReferenceInfo->setFromPassage($entry)->exportPublic();
        $info = json_encode($export);
        $query = "UPDATE  dbs_references SET bible_reference_info = :info
                  WHERE lesson = :lesson LIMIT 1";
        $params = array(':info'=> $info, ':lesson' => $lesson);
        $statement = $this->dbConnection->executeQuery($query, $params);
    }
}