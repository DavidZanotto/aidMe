<html>
<head>
<title>form</title>
</head>
<body>
<?php
	//nella tabella Utenti manca il numero di telefono dell'utente stesso
	include("parametri.php");
	
	// Connessione al server dbms
	$connect = mysqli_connect($server, $username, $password)
		or die("Connessione non riuscita: " . mysqli_error($connect));
	print ("Connesso con successo <br />");

	//salvataggio dei parametri
	$nome=$_POST["nome"];
	$email=$_POST["email"];
	$tel=$_POST["telefono"];
	$pass=$_POST["password"];

	echo "<h1>email passata:".$nome."</h1>";	
	echo "<h1>email passata:".$email."</h1>";	
	echo "<h1>email passata:".$tel."</h1>";
	echo "<h1>email passata:".$pass."</h1>";

    // selezione database
    mysqli_select_db($connect, $database)
        or die ("Impossibile selezionare il db");

    $table = "Utenti"; 
    $query = "INSERT INTO utenti (Username, Email, password) VALUES ("
	. "'" . $nome . "',"
	. "'" . $email . "',"
	. "'" . $password . "')"
    $result = mysqli_query($connect, $query)
        or die ("Errore nella query" . mysqli_error($connect));

	mysqli_close($connect); 
?>
</body>
</html>
