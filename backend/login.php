<?php

		///////O.B.S.////////
	//Loggin sida, "ropar" på samma testtabell som register.php
	
	session_start(); //Session så att inloggnigen sparas mellan de olika sidorna
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
			
			//Kontrollera lösenordet med det hashade
			/*function get_password() {
				$hashedPasswordFromDB = "SELECT lossenord FROM users WHERE lossenord = ";
				$yeypass ="";
				if (password_verify($pass, $hashedPasswordFromDB)) {
					echo 'Password is valid!';
					
					return '';
				}
				else {
					echo "Fel lösenord";
				}
			} */
		
			
			//Stämmer användarnamnet överens med db
			$sql = "SELECT id, count(anvandarnamn) AS antalrader FROM inlogg WHERE anvandarnamn = :useruo"; // AND lossenord = :seruo
			$statement = $pdo->prepare($sql);
			$statement->execute (array(':useruo' => $user)); //, ':seruo' => $pass
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			echo $result['antalrader'];
			
			
			//Om värdet från databasen stämmer överäns med värdet från input  
			if ($result['antalrader'] == 1 && password_verify($pass, $hass) === true) {
			$_SESSION['id'] = $result['id'];
			echo "<p>Du är inloggad!</p>";
			} else {
				//Om värdet från databasen inte stämmer med värdet från input
				echo "<p>användarnamn eller lösenord stämmer inte.</p>";
			}
			
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