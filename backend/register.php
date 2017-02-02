<?php

		////////// O.B.S. //////////
	//Den här filen är inte klar och "ropar" för tillfället på fel tabell!


	session_start(); //Session så att inloggnigen sparas mellan de olika sidorna
	require "config.php";
	
	//Om någon trycker på "skicka"
	if (isset($_POST['submitReg'])){
 
	// Tag bort eventuella blanksteg i början eller slutet
	foreach($_POST as $key => $val){
    	$_POST[$key] = trim($val);
  	}
 
  	//Kolla efter tomma fält
  	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    	$reg_error[] = 0;
  	}
  
  	// Kolla om användarnamnet är upptaget

  	$STH = $pdo->prepare("SELECT anvandarnamn FROM users WHERE anvandarnamn = :user ");
	$STH->bindParam(":user", $_POST['username']);

	try {
		$STH->execute();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
			
	if ($STH->rowCount() > 0)
    	$reg_error[] = 1;

	$epost = $_POST['epost'];

	// Kolla om lösenordet är för kort
	if (strlen($_POST['password']) < 8)
		$reg_error[] = 2;
  
	$username = $_POST['username'];
 /*
	// Kolla så att lösenorden stämmer överrens
	if ($_POST['password'] != $_POST['passwd2']) {
	    $reg_error[] = 3;
	}
	else
		$password = $_POST['password']; 

	// Kolla så att lösenordet innehåller minst en VERSAL
	if(!preg_match('/[A-Z]/', $_POST['password'])) {
 		$reg_error[] = 4;
	} */

	function isValidEmail($email) {
	    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
	}

	if (!isValidEmail($_POST['email']))
  		$reg_error[] = 5;

	// Inga fel? Spara och logga in samt skicka till välkomstsida
	if (!isset($reg_error)) {

		// En funktion för att skapa ett bra salt.
		function mt_rand_str ($l, $c = 'abcdefghiJKkLmnopQRStuVwxyz1234567890') {
		    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
		    return $s;
		}

		$password = $_POST['password'];
		$salt = mt_rand_str(31); // Ger en 31 tkn lång slumpsträng.
		$hashed = hash("sha512", $password . $salt ); // Ger 128 tkn.

	    $STH = $pdo->prepare("INSERT INTO users (anvandarnamn, lossenord, Salt, email)
            VALUES('$username', '$hashed', '$salt', '$email')");

		try {
			$STH->execute();
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
    
	    $_SESSION['sess_id'] = $pdo->lastInsertId() . date("z");
	    $_SESSION['sess_user'] = $_POST['user'];
		$_SESSION['userid'] = $pdo->lastInsertId();

	    echo "<script type='text/javascript'>
	   	document.location.href = 'start.php';
		</script>";
	    exit;     
	}
 
} 
else {
 
	// Sätt variabler för tomt formulär
	for ($i = 0; $i < 2; $i++) {
	    $back[$i] = "";
	} 
}
 
$error_list[0] = "Alla obligatoriska fält är inte ifyllda.";
$error_list[1] = "Användarnamnet är upptaget.";
$error_list[2] = "Lösenordet måste vara minst 8 tecken.";
$error_list[3] = "Lösenorden stämmer inte överens.";
$error_list[4] = "Lösenordet måste innehålla minst en versal.";
$error_list[5] = "E-postadressen betraktas inte som giltig.";
	
?>
<html>
<head>
</head>
<body>
	
	<?php
	if (isset($reg_error)){
 
		echo "<p>Något blev fel:<br>\n";
		echo "<ul>\n";
  		for ($i = 0; $i < sizeof($reg_error); $i++) {
    		echo "<li>{$error_list[$reg_error[$i]]}</li>\n";
  		}
  		echo "</ul>\n";
  
		$back[0] = stripslashes($_POST['user']);
	  	$back[1] = stripslashes($_POST['namn']);
	  	$back[2] = stripslashes($_POST['epost']);

	}
	?>
	
	<form action = "register.php" method = "post" role = "form"> 
		<label>usernamne</label>
		<input type="text" name="username">
		<label>lösenord</label>
		<input type="password" name="password">
		<label>mejl</label>
		<input type="text" name="email">
		<input type="submit" name="submitReg" value="Skicka">
	</form>
 
</div>
</div>

</body>
</html>