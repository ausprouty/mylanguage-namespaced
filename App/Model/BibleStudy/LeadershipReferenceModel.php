<?php
namespace App\Model\BibleStudy;

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;
//todo  I think this needs a rewrite
class LeadershipReferenceModel {
    private $dbConnection;
    private $lesson;
    public $reference;
    public $description;

    public function __construct($lesson = null, $reference= null, $description= null) {
        $this->dbConnection = new DatabaseConnectionModel();
        $this->lesson = $lesson;
        $this->reference = $reference;
        $this->description = $description;
    }

    public function setLesson($lesson)
    {
        $query = "SELECT * FROM leadership_references WHERE lesson = :lesson";
        $params = array('lesson'=>$lesson);
        try {
            $statement = $this->dbConnection->executeQuery($query, $params);
            $data = $statement->fetch(PDO::FETCH_OBJ);
            if($data){
                $this->lesson =$data->lesson;
                $this->reference= $data->reference;
                $this->description =$data->description;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    public function getEntry(){
        return $this->reference;
    }
    public function getDescription(){
        return $this->description;
    }




}
?>
