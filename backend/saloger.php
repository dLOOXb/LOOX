<?php 
	require "config.php";

	//Loopar igenom alla salongnamn som finns i DB och skriver ut dem som json.

    $sql = "SELECT salongnamn, url, info, tel, gata, postnummer, ort FROM salong"; 
    $statement = $pdo->query($sql);
    foreach( $statement as $row ) {
		$data[] = array(
			'salong' => $row['salongnamn'],
            'url' => $row['url'],
			'info' => $row['info'],
			'tel' => $row['tel'],
			'gata' => $row['gata'],
			'postnummer' => $row['postnummer'],
			'ort' => $row['ort'],
		);
		
    } 
	
	header("Content-Type:application/json:charset=utf-8");
	echo json_encode($data);