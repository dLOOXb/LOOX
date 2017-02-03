<?php
	require "config.php";
//Test utav config.php och databas, använd vid behov
    $sql = "SELECT `salongnamn`, `email` FROM `salong`";
    $statement = $pdo->query($sql);
    foreach( $statement as $row ) {
        $namn = $row['salongnamn'];
        $mail = $row['email'];
        echo "<p>$namn har mejlen $mail.</p>";
    } 
	//Skriver ut alla Salonger och derras e-post
?>