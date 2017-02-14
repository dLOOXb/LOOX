<?php 

	session_start();
	require "config.php";
	
	//Tar bort ett användarkonto
	
	header('Access-Control-Allow-Origin: *');
	
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
		
		//Skicka klartecken till front-end
		$data = ["borttagen" => 1];
		echo json_encode($data);
	}
	
	}

?>

<html>
<head></head>
<body>
	<form action="deleteuser.php" method="post">
	<label>Namn</label>
	<input type="text" name="username">
	<label>Lössenord</label>
	<input type="password" name="password">
	<input type="submit" name="submitDel" value="Ta bort användare">
</body>
</html>