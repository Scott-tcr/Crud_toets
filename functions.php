<?php
// auteur: Vul hier je naam in
// functie: algemene functies tbv hergebruik

include_once "config.php";

 function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //echo "Connected successfully";
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

 }
function getidbestemming(){
    $conn = connectDb();

    $sql = "SELECT bestemming FROM reizen"; 
    $query = $conn->prepare($sql);


    return $query->fetchAll();
}

 function crudMain(){

    // Menu-item   insert
    $txt = "
    <h1>Crud toets
    </h1>
    <nav>
		<a href='insert.php'>Toevoegen nieuwe bestemming</a>
    </nav><br>";
    echo $txt;

    // Haal alle fietsen record uit de tabel 
    $result = getData(CRUD_TABLE);

    //print table
    printCrudTabel($result);

 }

 // selecteer de data uit de opgeven table
 function getData($table){
    // Connect database
    $conn = connectDb();

    // Select data uit de opgegeven table methode query
    // query: is een prepare en execute in 1 zonder placeholders
    // $result = $conn->query("SELECT * FROM $table")->fetchAll();

    // Select data uit de opgegeven table methode prepare
    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
 }

 // selecteer de rij van de opgeven id uit de table fietsen
 function getRecord($bestemmingen){
    // Connect database
    $conn = connectDb();

    // Select data uit de opgegeven table methode prepare
    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE idbestemming = :idbestemming";
    $query = $conn->prepare($sql);
    $query->execute([':idbestemming'=>$bestemmingen]);
    $result = $query->fetch();

    return $result;
 }


// Function 'printCrudTabel' print een HTML-table met data uit $result 
// en een wzg- en -verwijder-knop.
function printCrudTabel($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table>";

    // Print header table

    // haal de kolommen uit de eerste rij [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    // Voeg actie kopregel toe
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</th>";

    // print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        
        // Wijzig knopje
$table .= "<td>
    <form method='post' action='update.php?id=".$row['idbestemming']."' >       
        <button>Wzg</button>	 
    </form></td>";

// Delete knopje
$table .= "<td>
    <form method='post' action='delete.php?id=".$row['idbestemming']."' >       
        <button>Verwijder</button>	 
    </form></td>";
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function updateRecord($row){
    $conn = connectDb();
    $sql = "UPDATE " . CRUD_TABLE . "
            SET idbestemming = :idbestemming, plaats = :plaats, land = :land, werelddeel = :werelddeel
            WHERE idbestemming = :idbestemming";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':idbestemming' => isset($row['idbestemming']) ? $row['idbestemming'] : '',
        ':plaats'      => isset($row['plaats']) ? $row['plaats'] : '',
        ':land'     => isset($row['land']) ? $row['land'] : '',
        ':werelddeel'     => isset($row['werelddeel']) ? $row['werelddeel'] : ''
    ]);
}


function InsertRecord($row){
    $conn = connectDb();
    $sql = "INSERT INTO " . CRUD_TABLE . " (idbestemming, plaats, land, werelddeel) VALUES (:idbestemming, :plaats, :land, :werelddeel)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':idbestemming' => isset($row['idbestemming']) ? $row['idbestemming'] : '',
        ':plaats'      => isset($row['plaats']) ? $row['plaats'] : '',
        ':land'     => isset($row['land']) ? $row['land'] : '',
        ':werelddeel'     => isset($row['werelddeel']) ? $row['werelddeel'] : ''
    ]);
}

function deleteRecord($id){

    // Connect database
    $conn = connectDb();
    
    // Maak een query 
    $sql = "
    DELETE FROM " . CRUD_TABLE . 
    " WHERE idbestemming = :idbestemming";

    // Prepare query
    $stmt = $conn->prepare($sql);

    // Uitvoeren
    $stmt->execute([
    ':idbestemming'=>$_GET['id']
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

?>
