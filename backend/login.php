<?php

	//Loggin sida
	
	session_start(); //Session så att inloggnigen sparas mellan de olika sidorna
	require "config.php";
	
	//Om någon trycker på knappen
	if (isset($_POST['submitLogin'])) {
		
		$user = $_POST['username'];
		$pass = $_POST['password'];
	
		//Om det inte står något i användarnamn och lösenord
		if (empty($user) && empty($pass)) {
			
			//Om fälten är tomma
			die("<p>Vänligen fyll i fälten</p>");	
			
		} 
		
			
			//Stämmer användarnamnet överens med db
			$sql = "SELECT id, lossenord, count(anvandarnamn) AS antalrader FROM inlogg WHERE anvandarnamn = :useruo"; // AND lossenord = :seruo
			$statement = $pdo->prepare($sql);
			$statement->execute (array(':useruo' => $user)); //, ':seruo' => $pass
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$hass = $result['lossenord'];
			
			
			//Om värdet från databasen stämmer överäns med värdet från input  
			if (($result['antalrader'] == 1) && (password_verify($pass, $hass) == true)) {
				$_SESSION['id'] = $result['id'];
				$_SESSION['anvandarnamn'] = $user;
			
				echo "<p>Du är inloggad!</p>";
				
			} else {
				//Om värdet från databasen inte stämmer med värdet från input
				die("Anvädarnamnet eller lösenordet stämmer inte överäns.");
			}
			
		
		}
	//}
	
?>

<html>
<head></head>
<body>
	<form action="login.php" method="post">
	<label>Namn</label>
	<input type="text" name="username">
	<label>Lössenord</label>
	<input type="password" name="password">
	<input type="submit" name="submitLogin" value="Logga in">
</body>
</html>