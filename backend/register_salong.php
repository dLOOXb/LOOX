<?php
	session_start();
	require "config.php";
	
	header('Access-Control-Allow-Origin: *');
	
	//Har någon tryckt på kanppen
	if (isset($_POST['salongname'])){
		
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
		$poop = "agare";
		
		/*var_dump($_POST);
		exit(); */
		//Kolla efter tomma fält(endast hos obligatoriska). Om tomma: stopa koden.
		if (empty($_POST['salongname']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['gata']) || empty($_POST['postnummer']) || empty($_POST['ort'])) {
			die("Vänligen fyll i alla de obligatoriska fälten");
		} 
		
		// Kolla om salongen redan är registerad
		$sql = "SELECT salongnamn FROM salong WHERE salongnamn = :salonguo";
		$kollaSalong = $pdo->prepare($sql);
		$kollaSalong->execute (array(':salonguo' => $salong)); 
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
            VALUES(:useruo, :salonguo, :mailuo, :lossuo, :teluo, :aguo)";
		$inlogg_intoDb = $pdo->prepare($sql3);
		$inlogg_intoDb->execute (array(':useruo' => $user, ':salonguo' => $salong, ':mailuo' => $epost, ':lossuo' => $hashpass, ':teluo' => $tel, ':aguo' => $poop)); 
		
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
		
		$data = ["salongname" => $salong, "email" => $epost, "tel" => $tel, "hemsida" => $url, "facebook" => $fb, "twitter" => $tw, "instagram" => $insta, "pintrest" => $pin, "info" => $text, "gata" => $gata, "postnummer" => $postnummer, "ort" => $ort];
		
		echo json_encode($data);
		
	}
?>

<!--<html>
<head></head>
<body>
	<form action="register_salong.php" method="post">
	<label>Namn</label>
	<input type="text" name="salongname">
	<label>Lössenord</label>
	<input type="password" name="password">
	<label>E-mail</label>
	<input type="text" name="email">
	<label>Tel</label>
	<input type="text" name="tel">
	<label>Hemsida</label>
	<input type="text" name="hemsida">
	<label>Gata</label>
	<input type="text" name="gata">
	<label>Postnummer</label>
	<input type="text" name="postnummer">
	<label>Ort</label>
	<input type="text" name="ort">
	<label>facebook</label>
	<input type="text" name="facebook">
	<label>twitter</label>
	<input type="text" name="twitter">
	<label>instagram</label>
	<input type="text" name="instagram">
	<label>pintrest</label>
	<input type="text" name="pintrest">
	<label>info</label>
	<input type="text" name="info">
	<input type="submit" name="submitLogin" value="Registera">
</body>
</html> --> 