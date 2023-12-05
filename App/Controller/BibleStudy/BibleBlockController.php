<?php

/* each verse is marked with  <sup class="versenum">18 </sup>
where the gap after the  18 is a non-breaking space

*/
namespace App\Controller\BibleStudy;

use stdClass as stdClass;


class BibleBlockController{

    private $bibleBlock;
    private $textLanguage1;
    private $textLanguage2;
    private $verseRange;
    private $paragraphs1;
    private $paragraphs2;
    private $template;

    public function __construct($textLanguage1, $textLanguage2, $verseRange)
    {
        $this->textLanguage1 = $textLanguage1;
        $this->textLanguage2 = $textLanguage2;
        $this->verseRange = $verseRange;
        $this->setTemplate();
        writeLogDebug('BibleBlockController-25', $this->textLanguage1);
        writeLogDebug('BibleBlockController-26', $this->textLanguage2);
        $this->paragraphs1 = $this->findParagraphs($this->textLanguage1);
        $this->paragraphs2 = $this->findParagraphs($this->textLanguage2);
        $message = count($this->paragraphs1) . '--' .  count($this->paragraphs2) . '('. $verseRange . ')';
        writeLogDebug('BibleBlockController-29', $message);
        if (count($this->paragraphs1) != count($this->paragraphs2)){
            $this->readjustParagraphs();
        }
        $this->fillBibleBlock();
    }

    public function getBlock(){
        return $this->bibleBlock;
    }
    private function fillBibleBlock(){
        $passageRows = '';
        foreach ($this->paragraphs1 as $key => $paragraphLanguage1){
            $paragraphLanguage2 = $this->paragraphs2[$key];
            $column1 = '<td class="{{dir_language1}} dbs" style="font-family:{{font_language1}}" dir ="{{dir_language1}}" >' ;
            $column2 = '<td class="||dir_language2|| dbs" style="font-family:||font_language2||"  dir ="||dir_language2||" >' ;
            if ($key == 1){
                $column1 .=  '<span class="biblereference">{{Bible Reference}}</span>';
                $column2 .=  '<span class="biblereference">||Bible Reference||</span>';
            }
            $column1 .=  $paragraphLanguage1->text . '</td>';
            $column2 .=  $paragraphLanguage2->text . '</td>';
            $passageRows .= '<tr class="{{dir_language1}} dbs"  dir ="{{dir_language1}}" >' . "\n";
            $passageRows  .= "$column1\n";
            $passageRows  .= "$column2\n";
            $passageRows  .= "</tr>\n";
        }
        writeLogDebug('bibleBlock-52',  $passageRows );
        $this->bibleBlock = str_replace('{{passage_rows}}', $passageRows, $this->template);
        writeLogDebug('bibleBlock-54',  $this->bibleBlock );
    }

    private function setTemplate(){
        $file = ROOT_TEMPLATES . 'bibleBlockTable.template.html';
        if (!file_exists($file)){
            $this->template = NULL;
        }
        $this->template = file_get_contents($file);
    } 
    private function findParagraphs($text){
        $lines = explode('<p', $text);
        $rows = array();
        foreach ($lines as $index=> $line){
            $startingVerse = $this->firstVerse($line);
            if ($startingVerse){
                $obj = new stdClass();
                $obj->startingVerseNumber = $this->firstVerse($line);
                $obj->text = '<p' . $line;
                $rows[$index] = $obj;
            }
        }
        writeLogDebug('bibleBlock-73', $rows);
        return $rows;
    }

    private function firstVerse($line){
        $posEnd = strpos($line, '</sup');
        if (!$posEnd){
            return null;
        }
        $short = substr($line, 0, $posEnd);
        $posStart = strrpos($short, '>') +1;
        $firstVerse = substr($short, $posStart);
        $bad = array('&nbsp;', ' ');
        $firstVerse = str_replace($bad, '', $firstVerse);
        return intval($firstVerse);
    }

    private function readjustParagraphs(){
        if (count($this->paragraphs1) != 1 && count($this->paragraphs1) < $this->verseRange){
            $this->readjustUsingLanguage1();
        }
        else{
            $this->readjustUsingLanguage2();
        }
    }
    private function readjustUsingLanguage1(){
        $language1Paragraphs = $this->findParagraphs($this->textLanguage1);
        $language2Text = $this->removeParagraphsAndDivs($this->textLanguage2);
        $language2Paragraphs = $this->createEqualParagraphs($language1Paragraphs, $language2Text);
        $this->paragraphs2 = $this->findParagraphs($language2Paragraphs);
    }
    private function readjustUsingLanguage2(){
        $language2Paragraphs = $this->findParagraphs($this->textLanguage2);
        $language1Text = $this->removeParagraphsAndDivs($this->textLanguage1);
        $language2Paragraphs = $this->createEqualParagraphs($language2Paragraphs, $language1Text);
        $this->paragraphs1 = $this->findParagraphs($language1Paragraphs);
    }
    private function createEqualParagraphs($paragraphs, $text){
         foreach ($paragraphs as $paragraph){
            $pattern = '/<sup class="versenum">' . $paragraph->startingVerseNumber .'\s*<\/sup>/';
            $replacement = '</p><p><sup class="versenum">' . $paragraph->startingVerseNumber .'&nbsp;</sup>';
            $newText = preg_replace($pattern, $replacement, $text, 1 );
            $text = $newText;
        }
        $text = trim(substr($text, 4 ) ). '</p>';
        writeLogDebug('bibleBlock-100', $text);
        return $text;
    }

    private function findVerses($text){
        $output = array();
        $text = $this->removeParagraphsAndDivs($text);
        $pattern = '<sup class="versenum">';
        $verses = explode($pattern, $text);
        foreach ($verses as $verse){
            $posSup = strpos($verse, '</sup>');
            if ($posSup !== FALSE){
                $posSupEnd = $posSup + 6;
                $verseNumber = substr($verse, 0, $posSup);
                $verseNumber = preg_replace("/[^0-9]/", "", $verseNumber);
                $verseText = substr($verse, $posSupEnd);
                $output[$verseNumber] = $verseText;
            }
        }
        writeLogDebug('bibleBlock-105', $output);
        return $output;
    }
    private function removeParagraphsAndDivs($text){
        $pattern = '/<p\b[^>]*>(.*?)<\/p>/s';
        $replacement = '$1';
        $text = preg_replace($pattern, $replacement, $text);
        $pattern = '/<div\b[^>]*>(.*?)<\/div>/s';
        $text = preg_replace($pattern, $replacement, $text);
        //alsi remove non-breaking space
        $text = preg_replace('/\xC2\xA0/', ' ', $text);
        writeLogDebug('bibleBlock-89', $text);
        return $text;
    }
}