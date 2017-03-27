<?php

	/* Lösning på "die" är för tillfället att skapa en variabel "$formIsOk = true" som under dokumentets gång ändras till "$formIsOk = false"
	om något inte stämmer. "$formIsOk = false" skrivs in där "die()" nu står. Värdet på variablen skickas sedan till front-end. Dock har front-end
	ingen som helst suport för detta, så jag kommer inte implementera det tillsvidare. */

	session_start();
	require "config.php";
	
	//Har någon tryckt på kanppen
	if (isset($_POST['username'])){
		
		//Sätter variabler för datan från registeringen.
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$email = $_POST['email'];
		$firstname = $_POST['fornamn'];
		$lastname = $_POST['efternamn'];
		$title = $_POST['titel'];
		$avatar = $_POST['alias'];
		$saloon = $_POST['salongname'];
		$fb = $_POST['facebook'];
		$tw = $_POST['twitter'];
		$insta = $_POST['instagram'];
		$pin = $_POST['pintrest'];
		$text = $_POST['info'];
		$poop = "frisor"; 
		
		//$formIsOk = true;
		
		
		//Kolla efter tomma fält(endast hos obligatoriska). Om tomma: stopa koden.
		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['fornamn']) || empty($_POST['efternamn']) || empty($_POST['salongname'])) {
			die("Vänligen fyll i alla de obligatoriska fälten"); //$formIsOk = false;
		} 
		
		// Kolla om användarnamnet är upptaget
		$sql = "SELECT anvandarnamn FROM inlogg WHERE anvandarnamn = :useruo";
		$checkUser = $pdo->prepare($sql);
		$checkUser->execute (array(':useruo' => $user)); 
		$CheckTwoUser = $checkUser->fetch(PDO::FETCH_ASSOC);
		
		
		// Kolla om mejlen är upptagen
		$sql2 = "SELECT email FROM salong WHERE email = :mailuo";
		$checkMail = $pdo->prepare($sql2);
		$checkMail->execute (array(':mailuo' => $email)); 
		$CheckTwoMail = $checkMail->fetch(PDO::FETCH_ASSOC);
		
		
		//Om användarnamnet är upptaget: stopa koden.
		if ($CheckTwoUser != NULL) {
			die("Den här användarnamnet redan upptaget."); //$formIsOk = false;
		}
		
		//Om mejlen är upptagen: stopa koden.
		if ($CheckTwoMail != NULL) {
			die("E-posten är redan upptagen."); //$formIsOk = false;
		}
		
		//Inga fel?!? Let's goooooooooooo!!!!!!
		
		//Skapar hashed lössenord med default inställnigar.
		$hashpass = password_hash($pass, PASSWORD_DEFAULT);
		
		//släng in inlogginfo i db
		$sql3 = "INSERT INTO inlogg (anvandarnamn, salongnamn, fornamn, efternamn, email, lossenord, klass)
            VALUES(:useruo, :salonguo, :foruo, :efteruo, :mailuo, :lossuo, :friuo)";
		$inlogg_intoDb = $pdo->prepare($sql3);
		$inlogg_intoDb->execute (array(':useruo' => $user, ':salonguo' => $saloon, ':foruo' => $firstname, ':efteruo' => $lastname, ':mailuo' => $email, ':lossuo' => $hashpass, ':friuo' => $poop)); 
		
		//Släng in behandlarinfo i db.
		$sql4 = "INSERT INTO behandlare (fornamn, efternamn, alias, titel, salongnamn, info, instagram, facebook, twitter, pintrest)
            VALUES(:foruo, :efteruo, :aliuo, :tit, :salonguo, :infouo, :instauo, :fbuo, :twuo, :pinuo)";
		$saloon_intoDb = $pdo->prepare($sql4);
		$saloon_intoDb->execute (array(':foruo' => $firstname, ':efteruo' => $lastname, ':aliuo' => $avatar, ':tit' => $title, ':salonguo' => $saloon, ':infouo' => $text, ':instauo' => $insta, ':fbuo' => $fb, ':twuo' => $tw, ':pinuo' => $pin)); 
		
		//starta session och logga in.
		$sql5 = "SELECT id FROM inlogg WHERE anvandarnamn = :useruo";
		$loggin = $pdo->prepare($sql5);
		$loggin->execute (array(':useruo' => $user)); 
		$id = $loggin->fetch(PDO::FETCH_ASSOC);
		
		//Om inloggnig misslyckas
		if ($loggin == NULL) {
			die("Oops, något gick fel! Vänligen kontakta suport."); //$formIsOk = false;
		}
		
		//Startar session koplat till användarnas id och anvndarnamn från DB!
		
		$_SESSION['id'] = $id['id'];
		$_SESSION['anvandarnamn'] = $user;
		$_SESSION['salong'] = $saloon;
		
		//Session:en för dokumentet är stängd. Fix för JSON.
		session_write_close();
		header("Content-Type:application/json:charset=utf-8");
		
		//Skicka tillbaka JSON till front-end
		/* if($formIsOk === true;) { */
		$data = ["username" => $user, "email" => $email, "fornamn" => $firstname, "efternamn" => $lastname, "alias" => $avatar, "salongname" => $saloon, "titel" => $title, "facebook" => $fb, "twitter" => $tw, "instagram" => $insta, "pintrest" => $pin, "info" => $text];
		echo json_encode($data);
		/*} else {
			// $data = ["problem" => $formIsOk];
		}*/
		
	}