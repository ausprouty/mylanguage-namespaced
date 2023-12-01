<?php
echo ('YOu should see a Bilingual Bible study for English and French Lesson 3<hr>');
$lang1 ='eng00';
$lang2= 'frn00';
$lesson = 3;


$dbs = new BilingualDbsTemplateController($lang1, $lang2, $lesson);
$dbsReference= new DbsReference();
$dbsReference->setLesson($lesson);

$bibleReferenceInfo= new  BibleReferenceInfo();
$bibleReferenceInfo->setFromEntry($dbsReference->getEntry());
$testament = $bibleReferenceInfo->getTestament();

$bible1 = new Bible();
$bible1->setBestDbsBibleByLanguageCodeHL($lang1, $testament);
$dbs->setBibleOne($bible1);

$bible2 = new Bible();
$bible2->setBestDbsBibleByLanguageCodeHL($lang2, $testament);
$dbs->setBibleTwo($bible2);

$dbs->setPassage($bibleReferenceInfo);
$dbs->setBilingualTemplate();

echo ($dbs->getTemplate());
