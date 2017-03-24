<?php
	session_start();
	require "config.php";
	
	//Har någon tryckt på kanppen
	if (isset($_POST['username'])){
		
		//Sätter variabler för datan från registeringen.
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$epost = $_POST['email'];
		$fornamn = $_POST['fornamn'];
		$efternamn = $_POST['efternamn'];
		$titel = $_POST['titel'];
		$alias = $_POST['alias'];
		$salong = $_POST['salongname'];
		$fb = $_POST['facebook'];
		$tw = $_POST['twitter'];
		$insta = $_POST['instagram'];
		$pin = $_POST['pintrest'];
		$text = $_POST['info'];
		$poop = "frisor"; 
		
		
		//Kolla efter tomma fält(endast hos obligatoriska). Om tomma: stopa koden.
		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['fornamn']) || empty($_POST['efternamn']) || empty($_POST['salongname'])) {
			die("Vänligen fyll i alla de obligatoriska fälten");
		} 
		
		// Kolla om användarnamnet är upptaget
		$sql = "SELECT anvandarnamn FROM inlogg WHERE anvandarnamn = :useruo";
		$kollaUser = $pdo->prepare($sql);
		$kollaUser->execute (array(':useruo' => $user)); 
		$CheckTwoUser = $kollaUser->fetch(PDO::FETCH_ASSOC);
		
		
		// Kolla om mejlen är upptagen
		$sql2 = "SELECT email FROM salong WHERE email = :mailuo";
		$kollaMail = $pdo->prepare($sql2);
		$kollaMail->execute (array(':mailuo' => $epost)); 
		$CheckTwoMail = $kollaMail->fetch(PDO::FETCH_ASSOC);
		
		
		//Om användarnamnet är upptaget: stopa koden.
		if ($CheckTwoUser != NULL) {
			die("Den här användarnamnet redan upptaget.");
		}
		
		//Om mejlen är upptagen: stopa koden.
		if ($CheckTwoMail != NULL) {
			die("E-posten är redan upptagen.");
		}
		
		//Inga fel?!? Let's goooooooooooo!!!!!!
		
		//Skapar hashed lössenord med default inställnigar.
		$hashpass = password_hash($pass, PASSWORD_DEFAULT);
		
		//släng in inlogginfo i db
		$sql3 = "INSERT INTO inlogg (anvandarnamn, salongnamn, fornamn, efternamn, email, lossenord, klass)
            VALUES(:useruo, :salonguo, :foruo, :efteruo, :mailuo, :lossuo, :friuo)";
		$inlogg_intoDb = $pdo->prepare($sql3);
		$inlogg_intoDb->execute (array(':useruo' => $user, ':salonguo' => $salong, ':foruo' => $fornamn, ':efteruo' => $efternamn, ':mailuo' => $epost, ':lossuo' => $hashpass, ':friuo' => $poop)); 
		
		//Släng in behandlarinfo i db.
		$sql4 = "INSERT INTO behandlare (fornamn, efternamn, alias, titel, salongnamn, info, instagram, facebook, twitter, pintrest)
            VALUES(:foruo, :efteruo, :aliuo, :tit, :salonguo, :infouo, :instauo, :fbuo, :twuo, :pinuo)";
		$salong_intoDb = $pdo->prepare($sql4);
		$salong_intoDb->execute (array(':foruo' => $fornamn, ':efteruo' => $efternamn, ':aliuo' => $alias, ':tit' => $titel, ':salonguo' => $salong, ':infouo' => $text, ':instauo' => $insta, ':fbuo' => $fb, ':twuo' => $tw, ':pinuo' => $pin)); 
		
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
		
		//Session:en för dokumentet är stängd. Fix för JSON.
			session_write_close();
			header("Content-Type:application/json:charset=utf-8");
		
		//Skicka tillbaka JSON till front-end
		$data = ["username" => $user, "email" => $epost, "fornamn" => $fornamn, "efternamn" => $efternamn, "alias" => $alias, "salongname" => $salong, "titel" => $titel, "facebook" => $fb, "twitter" => $tw, "instagram" => $insta, "pintrest" => $pin, "info" => $text];
		echo json_encode($data);
		
	}