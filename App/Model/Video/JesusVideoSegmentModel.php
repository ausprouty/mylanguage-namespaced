<?php

namespace App\Model\Video;

class JesusVideoSegmentModel
 {
    private $dbConnection;
    private $id;
    private $title;
    private $verses;
    private $videoSegment;
    private $stopTime;
   

    public function __construct() {
        $this->dbConnection = new DatabaseConnection();
        $this->id = '';
        $this->title = '';
        $this->verses = '';
        $this->videoSegment= '';
        $this->stopTime= '';
    }

}

