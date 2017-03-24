<?php 

	session_start();
	require "config.php";
	
	//Tar bort ett användarkonto
	
	//Om något skrivs i fältet
	if (isset($_POST['submitDel'])) {
		//Användarnamn och lösenord
		$user = $_SESSION['anvandarnamn'];
		$pass = $_POST['password'];

		//Hämta hash:at lösenord
		$sql = "SELECT lossenord, anvandarnamn FROM inlogg WHERE anvandarnamn = :useruo"; 
		$statement = $pdo->prepare($sql);
		$statement->execute (array(':useruo' => $user)); 	
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		$hashpass = $result['lossenord'];

		//Om lösenordet stämmer
		if (password_verify($pass, $hashpass) == true) {

			//Tar bort användaren från db!
			$sql2 = "DELETE FROM inlogg WHERE (lossenord=:passuo) AND (anvandarnamn = :useruo)";
			$bort = $pdo->prepare($sql2);
			$bort->execute (array(':passuo' => $hashpass, ':useruo' => $user)); 
			echo "Kontot är borttaget!";

			//Session:en för dokumentet är stängd. Fix för JSON.
			session_write_close();
			header("Content-Type:application/json:charset=utf-8");
			
			//Skicka klartecken till front-end
			$data = ["borttagen" => 1];
			echo json_encode($data);
		}
	
	}