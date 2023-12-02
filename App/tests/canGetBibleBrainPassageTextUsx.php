<?php

use  App\Controller\BiblePassage\BibleBrain\BibleBrainTextJsonController;
use App\Model\Bible\BibleModel as BibleModel;
use App\Model\Bible\BibleReferenceInfoModel as BibleReferenceInfoModel;

echo ("You may be able to modify this so that you can download an entire book (in nice format) and then parse it.  
Look for the URL ion the BibleBrainJson Controller <hr>");
$bible = new BibleModel();
$bible->selectBibleByBid(6282);
$bibleReferenceInfo = new BibleReferenceInfoModel();
$bibleReferenceInfo->setFromPassage('Luke 1:1-6');
$passage = new BibleBrainTextJsonController($bibleReferenceInfo, $bible);
$passage->getExternal();
echo ($passage->getPassageText());