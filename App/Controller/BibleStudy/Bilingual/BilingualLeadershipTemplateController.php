<?php
namespace App\Controller\BibleStudy\Bilingual;

class BilingualLeadershipTemplateController extends BilingualStudyTemplateController
{
    protected function createQrCode($url, $languageCodeHL){
        $size = 240;
        $fileName = 'Leadership'. $this->lesson .'-' .$languageCodeHL . '.png';
        $qrCodeGenerator = new QrCodeGenerator($url, $size, $fileName);
        $qrCodeGenerator->generateQrCode();
        return $qrCodeGenerator->getQrCodeUrl();
    }
    static function findFileName($lesson, $languageCodeHL1, $languageCodeHL2){
        $lang1 = Language::getEnglishNameFromCodeHL($languageCodeHL1);
        $lang2 = Language::getEnglishNameFromCodeHL($languageCodeHL2);
        $fileName =  'Leadership'. $lesson .'('. $lang1 . '-' . $lang2 .')';
        $fileName = str_replace( ' ', '_', $fileName);

        return trim($fileName);
    }
    static function findFileNamePdf($lesson, $languageCodeHL1, $languageCodeHL2){
        $fileName =  BilingualLeadershipTemplateController::findFileName($lesson, $languageCodeHL1, $languageCodeHL2);
        return $fileName . '.pdf';
    }
    protected function findTitle($lesson, $languageCodeHL1){
        return LeadershipStudyController::getTitle($lesson,$languageCodeHL1);
    }
    protected function getBilingualTemplateName(){
        return 'bilingualLeadership.template.html';
    }
    static function getPathPdf(){
        return ROOT_RESOURCES .'pdf/leadership/';
    }
    static function getUrlPdf(){
        return WEBADDRESS_RESOURCES .'pdf/leadership/';
    }
    static function getPathView(){
        return ROOT_RESOURCES .'view/leadership/';
    }
    protected function getStudyReferenceInfo($lesson){
        $studyReferenceInfo = new LeadershipReference();
        $studyReferenceInfo->setLesson($lesson);
        return $studyReferenceInfo;  
    }
    protected function getTranslationSource(){
        return 'leadership';
    }
    protected function setFileName(){
        $this->fileName = 'Leadership' . $this->lesson .'('. $this->language1->getName()  .'-'. $this->language2->getName() . ')';
    }
    protected function setUniqueTemplateValues(){
        return;
    }
}