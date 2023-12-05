<?php
use App\Model\Bible\BibleModel as BibleModel;
use App\Model\Bible\BibleReferenceInfoModel as BibleReferenceInfoModel;
use App\Model\BibleStudy\DbsReferenceModel as DbsReferenceModel;
use App\Controller\BibleStudy\Bilingual\BilingualDbsTemplateController as BilingualDbsTemplateController;


echo ('YOu should see a Bilingual Bible study for English and French Lesson 3<hr>');
$lang1 ='eng00';
$lang2= 'frn00';
$lesson = 3;


$dbs = new BilingualDbsTemplateController($lang1, $lang2, $lesson);
$dbsReference= new DbsReferenceModel();
$dbsReference->setLesson($lesson);

$bibleReferenceInfo=new BibleReferenceInfoModel();
$bibleReferenceInfo->setFromEntry($dbsReference->getEntry());
$testament = $bibleReferenceInfo->getTestament();

$bible1 = new BibleModel();
$bible1->setBestDbsBibleByLanguageCodeHL($lang1, $testament);
$dbs->setBibleOne($bible1);

$bible2 = new BibleModel();
$bible2->setBestDbsBibleByLanguageCodeHL($lang2, $testament);
$dbs->setBibleTwo($bible2);

$dbs->setPassage($bibleReferenceInfo);
$dbs->setBilingualTemplate();

echo ($dbs->getTemplate());
