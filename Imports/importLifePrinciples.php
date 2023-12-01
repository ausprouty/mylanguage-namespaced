<?php


$file = ROOT_IMPORT_DATA . 'LifePrinciples.json';
$text = file_get_contents($file);
$results = json_decode($text);
$dbConnection = new DatabaseConnection();
foreach ($results as $data){
    $title =  strtolower($data->title);
    $question = 'What does this passage say about '.  $title ; 
    $title = ucfirst($title);
    $query = "INSERT INTO life_principles (lesson, reference, testament, description, question)  
        VALUES (:lesson, :reference, :testament, :description, :question)";
    $params = array(
        ':lesson' => $data->id, 
        ':reference' =>  $data->verses , 
        ':testament' => 'NT', 
        ':description' => $title,
        ':question'=> $question,

    );
    $statement = $dbConnection->executeQuery($query, $params);
  
}

