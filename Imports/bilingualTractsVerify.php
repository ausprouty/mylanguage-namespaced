<?PHP
echo ('I m verifying bi-lingual tracts');
verify_database();
verify_files();




function verify_database(){
    $dbConnection = new DatabaseConnection();
    $query = "SELECT * FROM hl_bilingual_tracts";
    try {
        $statement = $dbConnection->executeQuery($query);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
    $time = time();
    foreach ($results as $data){
        $file = ROOT_RESOURCES . 'bilingualTracts/'. $data['webpage'];
        if (file_exists($file)){
            $query = "UPDATE hl_bilingual_tracts
            SET valid = :valid WHERE id = :id
            LIMIT 1";
                $params = array(':valid'=>$time, ':id'=>$data['id']);
                $statement = $dbConnection->executeQuery($query, $params);
        }
    }
    echo ('check database');
}

function verify_files(){
    $time = time();
    $dbConnection = new DatabaseConnection();
    $files = scandir( ROOT_RESOURCES . 'bilingualTracts/');
    foreach ($files as $file){
        if (strpos($file, '.html') !== false){
            $query = "SELECT id FROM hl_bilingual_tracts
                WHERE webpage = :webpage";
            $params = array(':webpage' => $file);
            try {
                $statement = $dbConnection->executeQuery($query, $params);
                $id = $statement->fetch(PDO::FETCH_COLUMN);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }
            if (!$id){
                $query = "INSERT into hl_bilingual_tracts (name, webpage, valid)
                    VALUES (:name, :webpage, :valid)";
                $params = array(':name'=> '', ':webpage'=> $file, ':valid'=>$time );
                $statement = $dbConnection->executeQuery($query, $params);
            }
        }
    }
}