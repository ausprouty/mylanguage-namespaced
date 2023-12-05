<?php
require_once ROOT_VENDOR .'autoload.php';
// Create an instance of the class:

use App\Model\Bible\BibleModel as BibleModel;
use App\Model\Bible\BibleReferenceInfoModel as BibleReferenceInfoModel;
use App\Model\BibleStudy\DbsReferenceModel as DbsReferenceModel;


$lang1 ='eng00';
$lang2= 'frn00';
$lesson = 3;


$dbs = new DbsBilingualTemplateController($lang1, $lang2, $lesson);
$dbsReference= new DbsReferenceModel();
$dbsReference->setLesson($lesson);

$bibleReferenceInfo=new BibleReferenceInfoModel();
$bibleReferenceInfo->setFromEntry($dbsReference->getEntry());
$testament = $bibleReferenceInfo->getTestament();

$bible1 = new BibleModel();
$bible1->setBestDbsBibleByLanguageCodeHL($lang1, $testament);
$dbs->findBibleOne($bible1);

$bible2 = new BibleModel();
$bible2->setBestDbsBibleByLanguageCodeHL($lang2, $testament);
$dbs->findBibleTwo($bible2);

$dbs->setPassage($bibleReferenceInfo);
$dbs->setBilingualTemplate();
$html = $dbs->getTemplate();


$filename = $dbs->getPdfName();
writeLogDebug('filename', $filename);

try{
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'orientation' => 'P'
    ]);
    $mpdf->SetDisplayMode('fullpage');
// Write some HTML code:
    $mpdf->WriteHTML($html);
    // Output a PDF file directly to the browser
    $mpdf->Output($filename, 'D');

} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}



