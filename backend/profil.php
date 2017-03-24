<?php 
	session_start();
	require "config.php";

	//Skicka ut användarinfon till profilen. Kräver att användaren är inloggad!
	
	$id = $_SESSION['id'];
	$user = $_SESSION['anvandarnamn']; 
	
	$sql = "SELECT anvandarnamn, fornamn, efternamn, email, tel, klass FROM inlogg WHERE anvandarnamn = :useruo";
	$stm = $pdo->prepare($sql);
	$stm->execute (array(':useruo' => $user)); 
	$result = $stm->fetch(PDO::FETCH_ASSOC);
	
	//Session:en för dokumentet är stängd. Fix för JSON.
	session_write_close();
	header("Content-Type:application/json:charset=utf-8");
	
	$data = $result;
	echo json_encode($data);

?>