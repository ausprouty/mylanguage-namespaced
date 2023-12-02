<?php

$questions = new MonolingualTemplateTranslationController(
    $templateName = 'monolingualJesusVideoQuestions', 
    $translationFile ='video' , 
    $languageCodeHL, 
);
ReturnDataController::returnData($questions->getTemplate());