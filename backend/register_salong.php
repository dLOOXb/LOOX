<?php
	session_start();
	require "config.php";
	
	//Har någon tryckt på kanppen
	if (isset($_POST['submitReg'])){
		
		//Sätter variabler för datan från registeringen.
		$salong = $_POST['salongname'];
		$user = $salong;
		$pass = $_POST['password'];
		$epost = $_POST['email'];
		$tel = $_POST['tel'];
		$url = $_POST['hemsida'];
		$fb = $_POST['facebook'];
		$tw = $_POST['twitter'];
		$insta = $_POST['instagram'];
		$pin = $_POST['pintrest'];
		$text = $_POST['info'];
		$gata = $_POST['gata'];
		$postnummer = $_POST['postnummer'];
		$ort = $_POST['ort'];
		
		
		//Tar bort blackspace
		foreach($_POST as $key => $val){
			$_POST[$key] = trim($val);
		}
		
		//Kolla efter tomma fält(endast hos obligatoriska). Om tomma: stopa koden.
		if (empty($_POST['salongnamn']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['gata']) || empty($_POST['postnummer']) || empty($_POST['ort'])) {
			die("Vänligen fyll i alla de obligatoriska fälten");
		} 
		
		// Kolla om salongen redan är registerad
		$sql = "SELECT salongnamn FROM salong WHERE salongnamn = :salonguo";
		$kollaSalong = $pdo->prepare($sql);
		$kollaSalong->execute (array(':useruo' => $user)); 
		$CheckTwoSalong = $kollaSalong->fetch(PDO::FETCH_ASSOC);
		
		// Kolla om mejlen är upptagen
		$sql2 = "SELECT email FROM salong WHERE email = :mailuo";
		$kollaMail = $pdo->prepare($sql2);
		$kollaMail->execute (array(':mailuo' => $epost)); 
		$CheckTwoMail = $kollaMail->fetch(PDO::FETCH_ASSOC);
		
		
		//Om användarnamnet är upptaget: stopa koden.
		if ($CheckTwoSalong != NULL) {
			die("Den här salongen finns redan registerad.");
		}
		
		//Om mejlen är upptagen: stopa koden.
		if ($CheckTwoMail != NULL) {
			die("E-posten är redan upptagen.");
		}
		
		//Inga fel?!? Let's goooooooooooo!!!!!!
		
		//Skapar hashed lössenord med default inställnigar.
		$hashpass = password_hash($pass, PASSWORD_DEFAULT);
		
		//släng in inlogginfo i db
		$sql3 = "INSERT INTO inlogg (anvandarnamn, salongnamn, email, lossenord, tel, klass)
            VALUES(:useruo, :salonguo, :mailuo, :lossuo, :teluo, agare)";
		$inlogg_intoDb = $pdo->prepare($sql3);
		$inlogg_intoDb->execute (array(':useruo' => $user, ':salonguo' => $salong, ':mailuo' => $epost), ':lossuo' => $hashpass, ':teluo' => $tel)); 
		
		//Släng in salong info i db.
		$sql4 = "INSERT INTO salong (salongnamn, info, url, email, tel, gata, postnummer, ort, instagram, facebook, twitter, pintrest)
            VALUES(:salonguo, :infouo, :urluo, :mailuo, :teluo, :gatauo, :postuo, :ortuo, :instauo, :fbuo, :twuo, :pinuo)";
		$salong_intoDb = $pdo->prepare($sql4);
		$salong_intoDb->execute (array(':salonguo' => $salong, ':infouo' => $text, ':urluo' => $url, ':mailuo' => $epost, ':teluo' => $tel, ':gatauo' => $gata, ':postuo' => $postnummer, ':ortuo' => $ort, ':instauo' => $insta, ':fbuo' => $fb, ':twuo' => $tw, ':pinuo' => $pin)); 
		
		//starta session och logga in.
		$sql5 = "SELECT id FROM inlogg WHERE anvandarnamn = :useruo";
		$loggin = $pdo->prepare($sql5);
		$loggin->execute (array(':useruo' => $user)); 
		$id = $loggin->fetch(PDO::FETCH_ASSOC);
		
		//Om inloggnig misslyckas
		if ($loggin == NULL) {
			die("Oops, något gick fel! Vänligen kontakta suport.");
		}
		
		//Startar session koplat till användarnas id och anvndarnamn från DB!
		
		$_SESSION['id'] = $id['id'];
		$_SESSION['anvandarnamn'] = $user;
		$_SESSION['salong'] = $salong;
		
	}
?>