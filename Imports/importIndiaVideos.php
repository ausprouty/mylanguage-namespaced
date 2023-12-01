<?php
$dbConnection = new DatabaseConnection();
$titles = array(
    '1-0-0' => 'Following Jesus (India), 1. Who Is God?',
    '2-0-0' => 'Following Jesus (India), 2. Who Is Jesus?',
    '3-0-0' => 'Following Jesus (India), 3. Prayer, Talking to God',
    '4-0-0' => 'Following Jesus (India), 4. Living as a Disciple of Jesus',
    '5-0-0' => 'Following Jesus (India), 5. Sharing Your Faith With Others'
);
$file = ROOT_IMPORT_DATA . 'India.json';
$text = file_get_contents($file);
$results = json_decode($text);
foreach ($results as $data){
    foreach ($titles as $segment => $title){
        $filmCode = $data->FilmCode . $segment;
        $query = "INSERT INTO jesus_video_languages (title, language, languageCodeHL, videoCode)  
        VALUES (:title, :language, :languageCodeHL, :videoCode)";
        $params = array(
            ':title' => $title , 
            ':language' => $data->LanguageName, 
            ':languageCodeHL' => $data->LanguageCodeHL , 
            ':videoCode' => $filmCode
        );
        $statement = $dbConnection->executeQuery($query, $params);
    }
}

