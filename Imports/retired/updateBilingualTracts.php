<?php
use App\Model\Data\DatabaseConnectionModel as DatabaseConnectionModel;

echo ('I m inporting tracts');
$dbConnection = new DatabaseConnectionModel();

$query = "SELECT * FROM hl_bilingual_tracts";
try {
    $statement = $dbConnection->executeQuery($query);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    return null;
}
foreach ($results as $data){
    //$num = array('0', '3', '4', '5', '6', '7','8','9');
    //$webpage = str_replace('http://www.hereslife.com/downloads/tracts/', '', $data['webpage']);
   //$webpage = str_replace('.pdf', '.html', $webpage);
    //$webpage = str_replace('WBw', '', $webpage);
    //$webpage = str_replace($num, '', $webpage);
    //$webpage = str_replace('p.html', '.html', $webpage);
    $webpage = str_replace('Eng.', 'Eng4.', $data['webpage']);

    echo ($webpage . '<br>');
    $query = "UPDATE hl_bilingual_tracts
        SET webpage = :webpage WHERE id = :id
        LIMIT 1";
    $params = array(':webpage'=>$webpage, ':id'=>$data['id']);
    $statement = $dbConnection->executeQuery($query, $params);
}
echo ('check database');