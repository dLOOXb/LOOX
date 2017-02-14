<?php 
	session_start();
	require "config.php";
	header('Access-Control-Allow-Origin: *');
	//Skicka ut användarinfon till profilen. Kräver att användaren är inloggad!
	
	$id = $_SESSION['id'];
	$user = $_SESSION['anvandarnamn']; 
	
	$sql = "SELECT anvandarnamn, fornamn, efternamn, email, tel, klass FROM inlogg WHERE anvandarnamn = :useruo";
	$stm = $pdo->prepare($sql);
	$stm->execute (array(':useruo' => $user)); 
	$result = $stm->fetch(PDO::FETCH_ASSOC);
	
	$data = $result;
	echo json_encode($data);

?>