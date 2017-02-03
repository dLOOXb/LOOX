<?php

		///////O.B.S.////////
	//Loggin sida, "ropar" på samma testtabell som register.php
	
	//session_start(); //Session så att inloggnigen sparas mellan de olika sidorna
	require "config.php";
	

	
	//Om någon trycker på knappen
	if (isset($_POST['submitLogin'])) {
		
		$user = $_POST['username'];
		$pass = $_POST['password'];
	
		//Om det inte står något i användarnamn och lösenord
		if (empty($user) && empty($pass)) {
			
			//Om fälten är tomma
			echo "<p>Vänligen fyll i fälten</p>";	
			
		} 
		else {
			
			//Stämmer användarnamnet överens med db
			//$sql = "SELECT anvandarnamn FROM users WHERE anvandarnamn = :useruo";
			
			$sql = "SELECT count(anvandarnamn) AS antalrader FROM inlogg WHERE anvandarnamn = :useruo AND lossenord = :seruo";
			$statement = $pdo->prepare($sql);
			$statement->execute (array(':useruo' => $user, ':seruo' => $pass));
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			echo $result['antalrader'];
			
			/*$sqli = "SELECT lossenord FROM inlogg WHERE lossenord = :seruo";
			$statemente = $pdo->prepare($sqli);
			$statemente->execute(['seruo' => $pass]);*/
			
			
			//Kontrollera lösenordet
			/*$hashedPasswordFromDB = "SELECT lossenord FROM users WHERE lossenord = $pass";

			if (password_verify($pass, $hashedPasswordFromDB)) {
				echo 'Password is valid!';
			}
			else {
				echo "Fel lösenord";
			}*/
			
			echo "<p>Du är inloggad!</p>";
			
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