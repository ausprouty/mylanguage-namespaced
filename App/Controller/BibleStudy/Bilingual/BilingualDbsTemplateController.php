<?php
namespace App\Controller\BibleStudy\Bilingual;

use App\Controller\BibleStudy\Bilingual\BilingualStudyTemplateController as BilingualStudyTemplateController;
use App\Controller\BibleStudy\DbsStudyController as  DbsStudyController;
use App\Model\Language\LanguageModel as LanguageModel;


class BilingualDbsTemplateController extends BilingualStudyTemplateController


{
    protected function createQrCode($url, $languageCodeHL){
        $size = 240;
        $fileName = 'Dbs'. $this->lesson .'-' .$languageCodeHL . '.png';
        $qrCodeGenerator = new QrCodeGenerator($url, $size, $fileName);
        $qrCodeGenerator->generateQrCode();
        return $qrCodeGenerator->getQrCodeUrl();
    }
    static function findFileName($lesson, $languageCodeHL1, $languageCodeHL2){
        $lang1 = LanguageModel::getEnglishNameFromCodeHL($languageCodeHL1);
        $lang2 = LanguageModel::getEnglishNameFromCodeHL($languageCodeHL2);
        $fileName =  'DBS'. $lesson .'('. $lang1 . '-' . $lang2 .')';
        $fileName = str_replace( ' ', '_', $fileName);
        return trim($fileName);
    }
    static function findFileNamePdf($lesson, $languageCodeHL1, $languageCodeHL2){
        $fileName =  BilingualDbsTemplateController::findFileName($lesson, $languageCodeHL1, $languageCodeHL2);
        return $fileName . '.pdf';
    }
    protected function findTitle($lesson, $languageCodeHL1){
        return DbsStudyController::getTitle($lesson, $languageCodeHL1);
    }
    protected function getBilingualTemplateName(){
        return 'bilingualDbs.template.html';
    }
    static function getPathPdf(){
        return ROOT_RESOURCES .'pdf/dbs/';
    }
    static function getUrlPdf(){
        return WEBADDRESS_RESOURCES .'pdf/dbs/';
    }
    static function getPathView(){
        return ROOT_RESOURCES .'view/dbs/';
    }
    protected function getStudyReferenceInfo($lesson){
        $studyReferenceInfo = new DbsReference();
        $studyReferenceInfo->setLesson($lesson);
        return $studyReferenceInfo;  
    }
    protected function getTranslationSource(){
        return 'dbs';
    }
    protected function setFileName(){
        $this->fileName = 'DBS' . $this->lesson .'('. $this->language1->getName()  .'-'. $this->language2->getName() . ')';
    }
    protected function setUniqueTemplateValues(){
        return;
    }
}

    
