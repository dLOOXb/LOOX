<?php	
	//config-filen med PDO. Använd för att kalla på loox databasen!

    $host = 'localhost'; //Eller datorns ip adress
    $db = 'loox'; 
    $user = 'root'; 
    $password = 'root';
    $charset = 'utf8';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false  ];
    $pdo = new PDO($dsn, $user, $password, $options);
	
	//Lägg till require "config.php"; i de filer som ska komma åt databasen.

?>