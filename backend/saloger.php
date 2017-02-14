<?php 
	session_start();
	require "config.php";

	//Loopar igenom alla salongnamn som finns i DB och skriver ut dem som json.
	header('Access-Control-Allow-Origin: *');

    $sql = "SELECT salongnamn, info, tel, gata, postnummer, ort FROM salong"; 
    $statement = $pdo->query($sql);
    foreach( $statement as $row ) {
		$salong = $row['salongnamn']; 
		$info = $row['info'];
		$tel = $row['tel'];
		$gata = $row['gata'];
		$postnum = $row['postnummer'];
		$ort = $row['ort'];
	
	
		$data[] = array(
			'salong' => $salong,
			'info' => $info,
			'tel' => $tel,
			'gata' => $gata,
			'postnummer' => $postnum,
			'ort' => $ort,
		);
		
    } 
	
	echo json_encode($data);

?>