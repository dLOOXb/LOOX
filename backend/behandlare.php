<?php 
	session_start();
	require "config.php";

	//Loopar igenom alla behandlare som finns i DB och skriver ut dem som json.
	header('Access-Control-Allow-Origin: *');

    $sql = "SELECT fornamn, efternamn, salongnamn, alias, titel, info, facebook FROM behandlare"; 
    $statement = $pdo->query($sql);
    foreach( $statement as $row ) {
		$salong = $row['salongnamn']; 
		$info = $row['info'];
		$forn = $row['fornamn'];
		$eftern = $row['efternamn'];
		$alias = $row['alias'];
		$tit = $row['titel'];
		$fb = $row['facebook'];
	
	
		$data[] = array(
			'salong' => $salong,
			'info' => $info,
			'fornamn' => $forn,
			'efternamn' => $eftern,
			'alias' => $alias,
			'titel' => $tit,
			'facebook' => $fb,
		);
		
    } 
	
	echo json_encode($data);

?>