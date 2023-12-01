<?php

namespace App\Controller\BiblePassage\BibleBrain;

class BibleBrainTextFormatController extends BibleBrainPassageController
{
 
    public function getPassageText()
    {
        return $this->passageText;
    }
    
}