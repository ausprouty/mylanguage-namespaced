<?php
namespace App\Controller\BibleStudy\Monolingual;

class MonolingualLifeTemplateController extends MonolingualStudyTemplateController
{
    protected function createQrCode($url, $languageCodeHL){
        $size = 240;
        $fileName = 'Life'. $this->lesson .'-' .$languageCodeHL . '.png';
        $qrCodeGenerator = new QrCodeGenerator($url, $size, $fileName);
        $qrCodeGenerator->generateQrCode();
        return $qrCodeGenerator->getQrCodeUrl();
    }
    static function findFileName($lesson, $languageCodeHL1){
        $lang1 = Language::getEnglishNameFromCodeHL($languageCodeHL1);
        $fileName =  'LifePrinciple'. $lesson .'('. $lang1 .')';
        $fileName = str_replace( ' ', '_', $fileName);

        return trim($fileName);
    }
    static function findFileNamePdf($lesson, $languageCodeHL1){
        $fileName =  MonolingualLifeTemplateController::findFileName($lesson, $languageCodeHL1);
        return $fileName . '.pdf';
    }
    static function findFileNameView($lesson, $languageCodeHL1){
        $fileName =  MonolingualLifeTemplateController::findFileName($lesson, $languageCodeHL1);
        return $fileName . '.html';
    }
    protected function findTitle($lesson, $languageCodeHL1){
        return LifeStudyController::getTitle($lesson, $languageCodeHL1 );
    }
    protected function getMonolingualTemplateName(){
        return 'monolingualLifePrinciples.template.html';
    }
    static function getPathPdf(){
        return ROOT_RESOURCES .'pdf/principle/';
    }
    static function getUrlPdf(){
        return WEBADDRESS_RESOURCES .'pdf/principle/';
    }
    static function getPathView(){
        return ROOT_RESOURCES .'view/principle/';
    }
    protected function getStudyReferenceInfo($lesson){
        $studyReferenceInfo = new LifePrincipleReference();
        $studyReferenceInfo->setLesson($lesson);
        return $studyReferenceInfo;  
    }
    protected function getTranslationSource(){
        return 'life';
    }
    protected function setFileName(){
        $this->fileName = 'LifePrinciple' . $this->lesson .'('. $this->language1->getName() . ')';
        $this->fileName = str_replace( ' ', '_', $this->fileName);
    }
    protected function setUniqueTemplateValues(){
        $question = $this->studyReferenceInfo->getQuestion();
        $translation1 = $this->getTranslation1();
        foreach ( $translation1 as $key => $value){
            if ($key == $question){
                $this->template= str_replace ('{{Topic Sentence}}', $value, $this->getTemplate());
            }
        }
   }
}