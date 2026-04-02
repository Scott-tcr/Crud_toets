<?php
// auteur: scott
include 'functions.php';

// Haal bier uit de database
if(isset($_GET['id'])){

    // test of insert gelukt is
    if(deleteRecord($_GET['id']) == true){
        echo '<script>alert("Bestemming: ' . $_GET['id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Bestemming is NIET verwijderd")</script>';
    }
}
?>
