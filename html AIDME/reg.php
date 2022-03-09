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
/*
	$data=$_POST["nome"];
	$cognome=$_POST["nome"];

	$data = "11settembre2001"
	$cognome = "rossi"*/

	echo "<h1>email passata:".$nome."</h1>";	
	echo "<h1>email passata:".$email."</h1>";	
	echo "<h1>email passata:".$tel."</h1>";
	echo "<h1>email passata:".$pass."</h1>";

    // selezione database
    mysqli_select_db($connect, $database)
        or die ("Impossibile selezionare il db");

    $t1 = "Utenti"; 
    $t2 = "DatiAnagrafici"; 

   	$query = "INSERT INTO ".$t1." (id, Username, Email, Password, idCitta) VALUES (
		'".rand(10,10000)."',". "'" . $nome . "',". "'" . $email . "',". "'" . $pass . "',". "'1')"; 
	
	$result = mysqli_query($connect, $query)
		or die ("Errore nella query" . mysqli_error($connect));

/*
	$query = "INSERT INTO ".$t2." (id, Nome, Cognome, DataNascita, CodiceFiscale, Telefono) VALUES (
		'".rand(10,10000)."',". "'" . $nome . "',". "'" . $cognome . "',". "'" . $data . "',". "'bruh',"."'".$tel."')"; 
	

	/*	
$query = "INSERT INTO ".$t1." (id, Username, Email, Password, idCitta) VALUES (
	'".rand(10,10000)."',". "'" . "dios" . "',". "'" . $email . "',". "'" . $pass . "',". "'1')"; 

	$result = mysqli_query($connect, $query)
        or die ("Errore nella query" . mysqli_error($connect));*/
	mysqli_close($connect); 
?>
</body>
</html>
