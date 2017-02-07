<?php
	//Log out
	
	//Sesson kopplad till användarnas id för tabell.
	session_start();
	require "config.php";
	
	//Om knapptryck...
	if (isset($_POST['loggout'])) {
		echo "Du är utloggad";
		//Avslutar sessionen och tar bort id värdet från $_SESSION
		session_unset(); 
		session_destroy();
	}

?>

<html>
<head>
</head>
<body>
	<form action="logut.php" method="post">
	<input type="submit" name="loggout" value="Logga ut">
</body>
</html>