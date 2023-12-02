<?php

use App\Model\Bible\BibleModel as BibleModel;
use App\Model\Bible\BibleReferenceInfoModel as BibleReferenceInfoModel;


echo ("You should see a nicely formatted text below with verse numbers.<hr>");
$bible = new BibleModel();
$bible->selectBibleByBid(1766);
$bibleReferenceInfo = new BibleReferenceInfoModel();
$bibleReferenceInfo->setFromEntry('Luke 1:1-6');

$passage = new BibleYouVersionPassageController($bibleReferenceInfo, $bible);
$passage->getLink();
echo ($passage->getLink());