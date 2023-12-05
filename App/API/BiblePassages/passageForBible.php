<?php

use  App\Controller\ReturnDataController as ReturnDataController;
use App\Model\Bible\ibleReferenceInfoModel as BibleReferenceInfoModel;

$bid =intval($_POST['bid']);
$entry =strip_tags($_POST['entry']);
$bible = new BibleModel();
$bible->selectBibleByBid($bid);
$bibleReferenceInfo =new BibleReferenceInfoModel();
$bibleReferenceInfo->setFromPassage($entry);

$passage = new PassageSelectController($bibleReferenceInfo, $bible);

$response = new stdClass();
$response->url = $passage->getPassageUrl();
$response->text = $passage->getPassageText();
ReturnDataController::returnData($response);


