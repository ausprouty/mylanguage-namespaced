<?php
namespace App\Controller\Video;

use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;

class JesusVideoSegmentController{
    private $data;

    public function __construct(){
        $dbConnection = new DatabaseConnectionModel();
        $query = "SELECT * FROM jesus_video_segments
        ORDER BY id";
        try {
            $statement = $dbConnection->executeQuery($query);
            $this->data = $statement->fetchAll(PDO::FETCH_ASSOC);
            writeLogDebug('video-13', $this->data);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    public function formatWithEnglishTitle(){
        $formated = [];
        foreach ($this->data as $segment){
            $title = $segment ['id'] . '. ' . $segment['title']  . ' (' . $segment['verses'] . ')';
            $obj =  new stdClass();
            $obj->title = $title;
            $obj->videoSegment = $segment['videoSegment'];
            $obj->endTime = $segment['endTime'];
            $formatted[] = $obj;
        }
        return $formatted;
    }
    public function formatWithEthnicTitle($languageCodeHL){
        $formated = [];
        $translation = new Translation($languageCodeHL, 'video');
        foreach ($this->data as $segment){
            $translated = $translation->translateText ($segment['title']);
            $title = $segment ['id'] . '. ' . $translated ;
            $obj =  new stdClass();
            $obj->title = $title;
            $obj->videoSegment = $segment['videoSegment'];
            $obj->endTime = $segment['endTime'];
            $formatted[] = $obj;
        }
        return $formatted;
    }
    
}