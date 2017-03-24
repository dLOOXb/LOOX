<?php 
	require "config.php";

	//Loopar igenom alla behandlare som finns i DB och skriver ut dem som json.

    $sql = "SELECT fornamn, efternamn, salongnamn, alias, titel, info, facebook FROM behandlare"; 
    $statement = $pdo->query($sql);
    foreach( $statement as $row ) {	
		$data[] = array(
			'salong' => $row['salongnamn'],
			'info' => $row['info'],
			'fornamn' => $row['fornamn'],
			'efternamn' => $row['efternamn'],
			'alias' => $row['alias'],
			'titel' => $row['titel'],
			'facebook' => $row['facebook'],
		);
		
    } 
	
	echo json_encode($data);