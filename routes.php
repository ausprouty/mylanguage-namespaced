<?php
$dir = __DIR__ ;
require_once __DIR__ .'/router.php';
if ( $dir == '/home/mylanguagenet/api.mylanguage.net.au'){
    require_once $dir .'/configuration/.env.remote.php';
}
else{
    require_once $dir .'/configuration/.env.local.php';
}
require_once  __DIR__.'/configuration/class-autoload.inc.php';
##################################################
require_once __DIR__.'/includes/writeLog.php';

//API
get(WEB_ROOT . 'api/ask/$languageCodeHL', 'api/askQuestions.php');
get(WEB_ROOT . 'api/bibles/$languageCodeHL', 'api/biblesForLanguage.php');
get(WEB_ROOT . 'api/bibles/dbs/next/$languageCodeHL','api/bibleForDbsNext.php');
get(WEB_ROOT . 'api/bibles/text/$languageCodeHL', 'api/biblesForLanguageTextOnly.php');

get(WEB_ROOT . 'api/content/available/$languageCodeHL1/$languageCodeHL2', 'api/contentAvailable.php');
get(WEB_ROOT . 'api/createQrCode', 'api/createQrCode.php');

get(WEB_ROOT . 'api/dbs/drupal/view/$lesson/$languageCodeHL1/$languageCodeHL2', 'api/dbsBilingualViewDrupal.php');
get(WEB_ROOT . 'api/dbs/languages', 'api/dbsLanguageOptions.php');
get(WEB_ROOT . 'api/dbs/pdf/$lesson/$languageCodeHL1/$languageCodeHL2', 'api/dbsBilingualPdf.php');
get(WEB_ROOT . 'api/dbs/studies', 'api/dbsStudyOptions.php');
get(WEB_ROOT . 'api/dbs/studies/$languageCodeHL1', 'api/dbsStudyOptions.php');
get(WEB_ROOT . 'api/dbs/view/$lesson/$languageCodeHL1', 'api/dbsMonolingualView.php');
get(WEB_ROOT . 'api/dbs/view/$lesson/$languageCodeHL1/$languageCodeHL2', 'api/dbsBilingualView.php');
get(WEB_ROOT . 'api/dbs/$lesson/$languageCodeHL', 'api/dbs.php');
get(WEB_ROOT . 'api/followingjesus/segments/$languageCodeHL', 'api/followingJesusOptions.php');

get(WEB_ROOT . 'api/gospel/languages', 'api/gospelLanguageOptions.php');
get(WEB_ROOT . 'api/gospel/view/$page', 'api/gospelPage.php');

get(WEB_ROOT . 'api/hindi/languages', 'api/hindiLanguageOptions.php');

get(WEB_ROOT . 'api/jvideo/questions/$languageCodeHL', 'api/jVideoQuestionsMonolingual.php');
get(WEB_ROOT . 'api/jvideo/questions/$languageCodeHL1/$languageCodeHL2', 'api/jVideoQuestionsBilingual.php');
get(WEB_ROOT . 'api/jvideo/segments/$languageCodeHL', 'api/jVideoSegments.php');

get(WEB_ROOT . 'api/language/$languageCodeHL', 'api/languageDetails.php');
get(WEB_ROOT . 'api/language/languageCodeJF/$languageCodeHL', 'api/languageCodeJF.php');
get(WEB_ROOT . 'api/language/languageCodeJFFollowingJesus/$languageCodeHL', 'api/languageCodeJFFollowingJesus.php');
get(WEB_ROOT . 'api/languages/country/$countryCode', 'api/languagesForCountry.php');

get(WEB_ROOT . 'api/leadership/studies', 'api/leadershipStudyOptions.php');
get(WEB_ROOT . 'api/leadership/studies/$languageCodeHL1', 'api/leadershipStudyOptions.php');
get(WEB_ROOT . 'api/leadership/view/$lesson/$languageCodeHL1', 'api/leadershipMonolingualView.php');
get(WEB_ROOT . 'api/leadership/view/$lesson/$languageCodeHL1/$languageCodeHL2', 'api/leadershipBilingualView.php');
get(WEB_ROOT . 'api/leadership/pdf/$lesson/$languageCodeHL1/$languageCodeHL2', 'api/leadershipBilingualPdf.php');

get(WEB_ROOT . 'api/life_principles/studies', 'api/lifeStudyOptions.php');
get(WEB_ROOT . 'api/life_principles/studies/$languageCodeHL1', 'api/lifeStudyOptions.php');
get(WEB_ROOT . 'api/life_principles/view/$lesson/$languageCodeHL1', 'api/lifeMonolingualView.php');
get(WEB_ROOT . 'api/life_principles/view/$lesson/$languageCodeHL1/$languageCodeHL2', 'api/lifeBilingualView.php');
get(WEB_ROOT . 'api/life_principles/pdf/$lesson/$languageCodeHL1/$languageCodeHL2', 'api/lifeBilingualPdf.php');

get(WEB_ROOT . 'api/video/code/$title/$languageCodeHL', 'api/videoCodeFromTitle.php');
get(WEB_ROOT . 'api/videocode/followingjesus/$languageCodeHL' , 'api/videoCodeForFollowingJesus.php');

post(WEB_ROOT .'api/passage/text', 'api/passageForBible.php');

post(WEB_ROOT . 'api/secure/bibles/weight/change', 'api/secure/bibleWeightChange.php');

// Index

get(WEB_ROOT . 'remote', 'views/indexRemote.php');


if (WEB_ROOT == '/mylanguage-api/'){
    get(WEB_ROOT , 'views/index.php');
    get(WEB_ROOT , 'views/indexLocal.php');
    get(WEB_ROOT . 'local', 'views/indexLocal.php');
    // Imports

    get(WEB_ROOT . 'import/bible/externalId', 'imports/updateBibleExternalId.php');
    get(WEB_ROOT . 'import/bible/languages', 'imports/addHLCodeToBible.php');
    get(WEB_ROOT . 'import/bibleBookNames/languages', 'imports/addHLCodeToBibleBookNames.php');
    get(WEB_ROOT . 'import/biblebrain/setup', 'imports/clearBibleBrainCheckDate.php');
    get(WEB_ROOT . 'import/biblebrain/bibles', 'imports/addBibleBrainBibles.php');
    get(WEB_ROOT . 'import/biblebrain/languages','imports/addBibleBrainLanguages.php');
    get(WEB_ROOT . 'import/biblebrain/language/details','imports/updateBibleBrainLanguageDetails.php');
    get(WEB_ROOT . 'import/biblegateway/bibles', 'imports/addBibleGatewayBibles.php');

    get(WEB_ROOT . 'import/country/languages/africa', 'imports/importLanguagesAfrica.php');
    get(WEB_ROOT . 'import/country/names', 'imports/checkCountryNames.php');
    get(WEB_ROOT . 'import/country/names/language', 'imports/addCountryNamesToLanguage.php');
    get(WEB_ROOT . 'import/country/names/language2', 'imports/addCountryNamesToLanguage2.php');
 
    get(WEB_ROOT . 'import/dbs/database', 'imports/UpdateDbsLanguages.php');
    get(WEB_ROOT . 'import/india', 'imports/importIndiaVideos.php');
    get(WEB_ROOT . 'import/leadership/database', 'imports/importLeadershipStudies.php');

    get(WEB_ROOT . 'import/life', 'imports/importLifePrinciples.php');
    get(WEB_ROOT . 'import/lumo', 'imports/importLumoVideos.php');
    get(WEB_ROOT . 'import/lumo/clean', 'imports/LumoClean.php');
    get(WEB_ROOT . 'import/lumo/segments', 'imports/LumoSegmentsAdd.php');
    get(WEB_ROOT . 'import/tracts', 'imports/bilingualTractsVerify.php');
    get(WEB_ROOT . 'import/video/segments', 'imports/importJesusVideoSegments.php');
    get(WEB_ROOT . 'import/video/segments/clean', 'imports/JFSegmentsClean.php');
    get(WEB_ROOT . 'import/video/languages', 'imports/videoLanguageCodesForJF.php');
    get(WEB_ROOT . 'import/video/jvideo/endTime', 'imports/addJVideoSegmentEndTime.php');

    get(WEB_ROOT . 'translate/dbs/words', 'translations/importRoutines/importDbsTranslationFromGoogle.php');
    get(WEB_ROOT . 'translate/leadership/words', 'translations/importRoutines/importLeadershipTranslationFromGoogle.php');
    get(WEB_ROOT . 'translate/life/words', 'translations/importRoutines/importLifePrincipleTranslationFromGoogle.php');
    get(WEB_ROOT . 'translate/video/words', 'translations/importRoutines/importVideoSegmentTranslationFromGoogle.php');


    // TESTS
    get(WEB_ROOT . 'tests/createQrCode', 'tests/createQrCode.php');
    get(WEB_ROOT . 'test', 'tests/test.php');
    get(WEB_ROOT . 'test/bengali', 'tests/bengaliTest.php');
    //  Web Access
    get(WEB_ROOT . 'webpage', 'tests/webpage.php');

    // word
    get(WEB_ROOT . 'test/word/passage/$externalId','tests/canGetBibleWordPassageFromExternalId.php');

    // Bible Brain
    get(WEB_ROOT . 'test/biblebrain/language', 'tests/canGetBibleBrainLanguageDetails.php');
    get(WEB_ROOT . 'test/biblebrain/bible/default', 'tests/canGetBestBibleFromBibleBrain.php');
    get(WEB_ROOT . 'test/biblebrain/bible/formats', 'tests/canGetBibleBrainBibleFormatTypes.php');
    get(WEB_ROOT . 'test/biblebrain/passage/json', 'tests/canGetBibleBrainPassageTextJson.php');

    get(WEB_ROOT . 'test/biblebrain/passage/formatted','tests/canGetBibleBrainPassageTextFormatted.php');
    get(WEB_ROOT . 'test/biblebrain/passage/usx','tests/canGetBibleBrainPassageTextUsx.php');
    get(WEB_ROOT . 'test/biblebrain/languages/country', 'tests/canGetLanguagesForCountryCode.php');

    // Bible Gateway
    get(WEB_ROOT . 'test/biblegateway', 'tests/canGetBibleGatewayPassage.php');

    //YouVersion
    get(WEB_ROOT . 'test/youversion/link', 'tests/canGetBibleYouVersionLink.php');

    // DBS
    get(WEB_ROOT . 'test/dbs/translation', 'tests/canGetDBSTranslation.php');
    get(WEB_ROOT . 'test/dbs/bilingual', 'tests/canMakeStandardBilingualDBS.php');
    get(WEB_ROOT . 'test/dbs/pdf', 'tests/canPrintDbsPdf.php');


    //Bibles
    get (WEB_ROOT. 'test/bibles/best', 'tests/canGetBestBibleByLanguageCodeHL.php');
    get (WEB_ROOT. 'test/passage/select', 'tests/passageSelectControllerTest.php');
    get(WEB_ROOT . 'test/bible', 'tests/biblePassageControllerTest.php');

    //Database
    get(WEB_ROOT . 'test/language/hl', 'tests/canGetLanguageFromHL.php');





    get(WEB_ROOT . 'test/bible/reference/info', 'tests/CanCreateBibleReferenceInfo.php');
    get(WEB_ROOT . 'test/passage/select', 'tests/canSelectBiblePassageFromDatabaseOrExternal.php');

    get(WEB_ROOT . 'test/passage/stored', 'tests/canSeePassageStored.php');

}
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the tests folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/404.php');
