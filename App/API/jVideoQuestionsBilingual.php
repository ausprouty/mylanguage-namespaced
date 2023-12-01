<?php

$questions = new BilingualTemplateTranslationController(
    $templateName = 'bilingualJesusVideoQuestions', 
    $translationFile ='video' , 
    $languageCodeHL1, 
    $languageCodeHL2);
ReturnDataController::returnData($questions->getTemplate());