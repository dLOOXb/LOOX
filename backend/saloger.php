<?php 
	require "config.php";

	//Loopar igenom alla salongnamn som finns i DB och skriver ut dem som json.
	
	header('Access-Control-Allow-Origin: *');

    $sql = "SELECT `salongnamn` FROM `salong`";
    $statement = $pdo->query($sql);
    foreach( $statement as $row ) {
        $namn = $row['salongnamn'];
		
		//Lägg in salogen i json
		$data = $row;
    } 
	
	echo json_encode($data);

?>