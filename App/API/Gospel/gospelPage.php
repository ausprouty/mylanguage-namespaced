<?php

$gospel= new GospelPageController();
$text = $gospel->getBilingualPage($page);
ReturnDataController::returnData($text);