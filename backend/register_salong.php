<?php

	/* Lösning på "die" är för tillfället att skapa en variabel "$formIsOk = true" som under dokumentets gång ändras till "$formIsOk = false"
	om något inte stämmer. "$formIsOk = false" skrivs in där "die()" nu står. Värdet på variablen skickas sedan till front-end. Dock har front-end
	ingen som helst suport för detta, så jag kommer inte implementera det tillsvidare. */

	session_start();
	require "config.php";
	
	//Har någon tryckt på kanppen
	if (isset($_POST['salongname'])){
		
		//Sätter variabler för datan från registeringen.
		$saloon = $_POST['salongname'];
		$user = $saloon;
		$pass = $_POST['password'];
		$epost = $_POST['email'];
		$tel = $_POST['tel'];
		$url = $_POST['hemsida'];
		$fb = $_POST['facebook'];
		$tw = $_POST['twitter'];
		$insta = $_POST['instagram'];
		$pin = $_POST['pintrest'];
		$text = $_POST['info'];
		$street = $_POST['gata'];
		$postCode = $_POST['postnummer'];
		$city = $_POST['ort'];
		$poop = "agare";
		
		//$formIsOk = true;
		
		//Kolla efter tomma fält(endast hos obligatoriska). Om tomma: stopa koden.
		if (empty($_POST['salongname']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['gata']) || empty($_POST['postnummer']) || empty($_POST['ort'])) {
			die("Vänligen fyll i alla de obligatoriska fälten"); //$formIsOk = false;
		} 
		
		// Kolla om salongen redan är registerad
		$sql = "SELECT salongnamn FROM salong WHERE salongnamn = :salonguo";
		$checkSaloon = $pdo->prepare($sql);
		$checkSaloon->execute (array(':salonguo' => $saloon)); 
		$CheckTwoSalong = $checkSaloon->fetch(PDO::FETCH_ASSOC);
		
		// Kolla om mejlen är upptagen
		$sql2 = "SELECT email FROM salong WHERE email = :mailuo";
		$checkMail = $pdo->prepare($sql2);
		$checkMail->execute (array(':mailuo' => $epost)); 
		$CheckTwoMail = $checkMail->fetch(PDO::FETCH_ASSOC);
		
		
		//Om användarnamnet är upptaget: stopa koden.
		if ($CheckTwoSalong != NULL) {
			die("Den här salongen finns redan registerad."); //$formIsOk = false;
		}
		
		//Om mejlen är upptagen: stopa koden.
		if ($CheckTwoMail != NULL) {
			die("E-posten är redan upptagen."); //$formIsOk = false;
		} 
		
		//Inga fel?!? Let's goooooooooooo!!!!!!
		/* if($formIsOk === true) { */
		
		//Skapar hashed lössenord med default inställnigar.
		$hashpass = password_hash($pass, PASSWORD_DEFAULT);
		
		//släng in inlogginfo i db
		$sql3 = "INSERT INTO inlogg (anvandarnamn, salongnamn, email, lossenord, tel, klass)
            VALUES(:useruo, :salonguo, :mailuo, :lossuo, :teluo, :aguo)";
		$inlogg_intoDb = $pdo->prepare($sql3);
		$inlogg_intoDb->execute (array(':useruo' => $user, ':salonguo' => $saloon, ':mailuo' => $epost, ':lossuo' => $hashpass, ':teluo' => $tel, ':aguo' => $poop)); 
		
		//Släng in salong info i db.
		$sql4 = "INSERT INTO salong (salongnamn, info, url, email, tel, gata, postnummer, ort, instagram, facebook, twitter, pintrest)
            VALUES(:salonguo, :infouo, :urluo, :mailuo, :teluo, :gatauo, :postuo, :ortuo, :instauo, :fbuo, :twuo, :pinuo)";
		$saloon_intoDb = $pdo->prepare($sql4);
		$saloon_intoDb->execute (array(':salonguo' => $saloon, ':infouo' => $text, ':urluo' => $url, ':mailuo' => $epost, ':teluo' => $tel, ':gatauo' => $street, ':postuo' => $postCode, ':ortuo' => $city, ':instauo' => $insta, ':fbuo' => $fb, ':twuo' => $tw, ':pinuo' => $pin)); 
		
		//starta session och logga in.
		$sql5 = "SELECT id FROM inlogg WHERE anvandarnamn = :useruo";
		$loggin = $pdo->prepare($sql5);
		$loggin->execute (array(':useruo' => $user)); 
		$id = $loggin->fetch(PDO::FETCH_ASSOC);
		
		//}
		
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
		
		/* if($formIsOk === true) { */
		$data = ["salongname" => $saloon, "email" => $epost, "tel" => $tel, "hemsida" => $url, "facebook" => $fb, "twitter" => $tw, "instagram" => $insta, "pintrest" => $pin, "info" => $text, "gata" => $street, "postnummer" => $postCode, "ort" => $city];
		
		echo json_encode($data);
		/*} else {
			// $data = ["problem" => $formIsOk];
		}*/
		
	}
