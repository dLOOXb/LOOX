<?php

	/* Lösning på "die" är för tillfället att skapa en variabel "$formIsOk = true" som under dokumentets gång ändras till "$formIsOk = false"
	om något inte stämmer. "$formIsOk = false" skrivs in där "die()" nu står. Värdet på variablen skickas sedan till front-end. Dock har front-end
	ingen som helst suport för detta, så jag kommer inte implementera det tillsvidare. */

	session_start();
	require "config.php";
	
	//Finns 
	if (isset($_POST['username'])){
		
		//Sätter variabler för datan från registeringen.
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$firstname = $_POST['fornamn'];
		$aftername = $_POST['efternamn'];
		$poop = "kund";
		
		//$formIsOk = true;
		
		//Kolla efter tomma fält. Om tomma: stopa koden.
		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['fornamn']) || empty($_POST['efternamn'])) {
			die("Vänligen fyll i alla fälten"); //$formIsOk = false;
		} 
		
		// Kolla om användarnamnet är upptaget
		$sql = "SELECT anvandarnamn FROM inlogg WHERE anvandarnamn = :useruo";
		$checkUser = $pdo->prepare($sql);
		$checkUser->execute (array(':useruo' => $user)); 
		$CheckTwoUser = $checkUser->fetch(PDO::FETCH_ASSOC);
		
		
		// Kolla om mejlen är upptagen
		$sql2 = "SELECT email FROM inlogg WHERE email = :mailuo";
		$checkMail = $pdo->prepare($sql2);
		$checkMail->execute (array(':mailuo' => $email)); 
		$CheckTwoMail = $checkMail->fetch(PDO::FETCH_ASSOC); 
		
		
		//Om användarnamnet är upptaget: stopa koden.
		if ($CheckTwoUser != NULL) {
			die("Användarnamnet är redan upptaget."); //$formIsOk = false;
		}
		
		//Om mejlen är upptagen: stopa koden.
		if ($CheckTwoMail != NULL) {
			die("E-posten är redan upptagen."); //$formIsOk = false;
		}
		
		//Inga fel?!? Let's goooooooooooo!!!!!!
		
		//Skapar hashed lössenord med default inställnigar.
		$hashpass = password_hash($pass, PASSWORD_DEFAULT);
		
		//släng in inlogginfo i db
		$sql3 = "INSERT INTO inlogg (anvandarnamn, fornamn, efternamn, email, lossenord, tel, klass)
            VALUES(:useruo, :foruo, :efteruo, :mailuo, :lossuo, :teluo, :poopuo)";
		$inlogg_intoDb = $pdo->prepare($sql3);
		$inlogg_intoDb->execute (array(':useruo' => $user, ':foruo' => $firstname, ':efteruo' => $aftername, ':mailuo' => $email, ':lossuo' => $hashpass, ':teluo' => $tel, ':poopuo' => $poop)); 
		
		//Släng in annan info i db.
		
		//starta session och logga in.
		$sql4 = "SELECT id FROM inlogg WHERE anvandarnamn = :useruo";
		$loggin = $pdo->prepare($sql4);
		$loggin->execute (array(':useruo' => $user)); 
		$id = $loggin->fetch(PDO::FETCH_ASSOC);
		
		//Om inloggnig misslyckas
		if ($loggin == NULL) {
			die("Oops, något gick fel! Vänligen kontakta suport."); //$formIsOk = false;
		}
		
		//Startar session koplat till användarnas id och anvndarnamn från DB!
		
		$_SESSION['id'] = $id['id'];
		$_SESSION['anvandarnamn'] = $user;
		
		//Session:en för dokumentet är stängd. Fix för JSON.
		session_write_close();
		header("Content-Type:application/json:charset=utf-8");
		
		//Skicka tillbaka JSON till front-end
		/*if(//$formIsOk === true;) { */
		$data = ["username" => $user, "email" => $email, "tel" => $tel, "fornamn" => $firstname, "efternamn" => $aftername];
		echo json_encode($data);
		/*} else {
			// $data = ["problem" => $formIsOk];
		}*/
	} 