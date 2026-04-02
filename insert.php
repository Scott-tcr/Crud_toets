<?php
   
    // auteur: scott

    echo "<h1>Insert Bestemmingen</h1>";

    require_once('functions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertRecord($_POST) == true){
            echo "<script>alert('bestemming is toegevoegd')</script>";
        } else {
            echo '<script>alert("bestemming is WEL toegevoegd")</script>';
        }
    }



    
?>
<html>
    <body>
        <form method="post">

        <label for="plaats">Plaats:</label>
        <input type="text" id="plaats" name="plaats" required><br>

        <label for="land">Land:</label>
        <input type="text" id="land" name="land" required><br>

        <label for="werelddeel">Werelddeel:</label>
        <input type="text" id="werelddeel" name="werelddeel" required><br>

        
       
        <?php

?>


</select><br>
        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href="index.php">Home</a>
    </body>
</html>