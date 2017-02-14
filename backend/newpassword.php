<?php 
	session_start();
	require "config.php";
	
	//Fil för att kunna uppdatera sitt lösenord.
	
	header('Access-Control-Allow-Origin: *');
	
	//Om något skrivs i fältet
	if (isset($_POST['submitNew'])) {
		//Det gammla lösenordet
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$newpass = $_POST['newpass'];
		
		//Stämmer användarnamnet överens med db
			$sql = "SELECT lossenord, count(anvandarnamn) AS antalrader FROM inlogg WHERE anvandarnamn = :useruo"; 
			$statement = $pdo->prepare($sql);
			$statement->execute (array(':useruo' => $user)); 
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$hass = $result['lossenord'];
			
			
		
		//Om anvndarnamnet och det gammla lösenordet stämmer med db
		if (($result['antalrader'] == 1) && (password_verify($pass, $hass) == true)) {
		
			//Det nya lösenordet hashat
			$newhash = password_hash($newpass, PASSWORD_DEFAULT);
			
			//Uppdatera lösenordet i db
			$sql2 = "UPDATE inlogg SET lossenord = :passuo WHERE anvandarnamn = :useruo";
			$uppdate = $pdo->prepare($sql2);
			$uppdate->execute (array(':passuo' => $newhash, ':useruo' => $user)); 
			
			
			//Skicka klartecken till front-end
			$data = ["changedpass" => 1];
			echo json_encode($data);
			
		} else {
			echo "Användarnamnet eller lösenordet stämmer inte.";
		}
	
	}
	
?>