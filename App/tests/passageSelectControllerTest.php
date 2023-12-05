<?php
use App\Model\Bible\BibleModel as BibleModel;
use App\Model\Bible\BibleReferenceInfoModel as BibleReferenceInfoModel;

$code = 'eng00';
$entry = 'John 3:16-18';
$bibleInfo = new BibleModel();
$bibleInfo->getBestBibleByLanguageCodeHL($code);
$referenceInfo =new BibleReferenceInfoModel();
$referenceInfo->setFromPassage($entry);
$passage = new PassageSelectController($referenceInfo, $bibleInfo);
echo ('YOu should see the URL and text of John 3:16-18 below<hr>');
print_r($passage->getPassageUrl());
print_r($passage->getPassageText());
