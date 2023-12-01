<?php
// Require composer autoload
// see https://mpdf.github.io/ 
// https://mpdf.github.io/fonts-languages/fonts-in-mpdf-7-x.html
// fonts available:  https://mpdf.github.io/fonts-languages/available-fonts-v6.html
namespace App\Controller;

class PdfController {

    private $mpdf;

    public function __construct($languageCodeHL1 = null, $languageCodeHL2 = null){
        require_once ROOT_VENDOR .'autoload.php';
        $this->mpdf = new \Mpdf\Mpdf();
        // Set the default font configuration to use a Bengali Unicode font
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        writeLogDebug('pdf-fonts-20',  $fontData);
        $fontDataForLanguages = $this->getFontData($languageCodeHL1, $languageCodeHL2);
        writeLogDebug('pdf-fonts-22',  $fontDataForLanguages);
        // Set the default configuration
        $fontDataToUse = array_merge ($fontData, $fontDataForLanguages);
     
        $this->mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                ROOT_FONTS
            ]),
            'fontdata' => $fontDataToUse,
            'default_font' => 'arial',
            'mode' => 'utf-8',
            'orientation' => 'P'
        ]);
        $this->mpdf->SetDisplayMode('fullpage');
        
    }

    private function getFontData($languageCodeHL1, $languageCodeHL2){
        //Sample fontData: {"dejavusans": {"B": "DejaVuSans-Bold.ttf", "I": "DejaVuSans-Oblique.ttf", "R": "DejaVuSans.ttf", "BI": "DejaVuSans-BoldOblique.ttf", "useOTL": 255, "useKashida": 75}, "dejavusanscondensed": {"B": "DejaVuSansCondensed-Bold.ttf", "I": "DejaVuSansCondensed-Oblique.ttf", "R": "DejaVuSansCondensed.ttf", "BI": "DejaVuSansCondensed-BoldOblique.ttf", "useOTL": 255, "useKashida": 75}}
        $fontData = array();
        if ($languageCodeHL1){
            $data = Language::getFontDataFromCodeHL($languageCodeHL1);
            if ($data){
                foreach ($data as $key=>$value){
                    $fontData[$key] =  $value;
                }
            }
        }
        if ($languageCodeHL2){
            $data = Language::getFontDataFromCodeHL($languageCodeHL2);
            if ($data){
                foreach ($data as $key=>$value){
                    $fontData[$key] =  $value;
                }
            }
        }
        return $fontData;
    }

    public function writeToBrowser($html, $stylesheet){
        $stylesheet = file_get_contents(ROOT_STYLES . $stylesheet);
        $this->mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $this->mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output();
    }
    public function writePdfToComputer($html, $stylesheet, $filename){
        if (strpos ($filename, '.pdf') == FALSE){
            $filename .= '.pdf';
        }
        writeLogDebug('pdf-72', $html);
        $stylesheet = file_get_contents(ROOT_STYLES . $stylesheet);
        $this->mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $this->mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output($filename, 'F');
    }
          
}

    
