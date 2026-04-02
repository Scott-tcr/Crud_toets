<?php
    // functie: update voor toets
    //scott hameeteman

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateRecord($_POST) == true){
            echo "<script>alert('Bestemming is gewijzigd')</script>";
        } else {
            echo '<script>alert("Bestemming is niet gewijzigd")</script>';
        }
    }

    // Test of id is meegegeven in de URL
    if(isset($_GET['id'])){  
        // Haal alle info van de betreffende id $_GET['id']
        $id = $_GET['id'];
        $row = getRecord($id);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Fiets</title>
</head>
<body>
  <h2>Wijzig Fiets</h2>
  <form method="post">
    <label for="plaats">Plaats:</label>
    <input type="text" id="plaats" name="plaats" required value="<?php echo $row['plaats']; ?>"><br>

    <label for="land">Land:</label>
    <input type="text" id="land" name="land" required value="<?php echo $row['land']; ?>"><br>

    <label for="werelddeel">Werelddeel:</label>
    <input type="text" id="werelddeel" name="werelddeel" required value="<?php echo $row['werelddeel']; ?>"><br>

    
    <?php
?>

<label for="idbestemming">idbestemming:</label>
<select name="idbestemming" required>

    <?php foreach($idbestemming as $code): ?>
        <option value="<?= $code['idbestemming']; ?>"
            <?php if($code['idbestemming'] == $row['idbestemming']) echo "selected"; ?>>
            
            <?= $code['brouwcode']; ?>
        
        </option>
    <?php endforeach; ?>

</select><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>
<?php
    } else {
        echo "Geen id opgegeven<br>";
    }
?>