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
*/
	$data = "2001-09-11";
	$cognome = "rossi";
	
    // selezione database
    mysqli_select_db($connect, $database)
        or die ("Impossibile selezionare il db");

    $t1 = "Utenti"; 
    $t2 = "DatiAnagrafici"; 

	//fase per incrementare l'id al massimo+1
	$id = "SELECT id FROM ". $t1.";";
	$result = mysqli_query($connect, $id)
		or die ("Errore nella query" . mysqli_error($connect));
	
	// Visualizzo il risultato della query
	while ($search = mysqli_fetch_array($result))
		$i = $search[$id];

	$i = $i+1;

	// libero la memoria occupata dall'istruzione SELECT
	mysqli_free_result($result);


   	$q1 = "INSERT INTO ".$t1." (id, Username, Email, Password, idCitta) VALUES (
		'".$i."','" . $nome . "','" . $email . "','" . $pass . "','1')"; 

	$q2 = "INSERT INTO ".$t2." (id, Nome, Cognome, DataNascita, CodiceFiscale, Telefono) VALUES (
		'".$i."','" . $nome . "','" . $cognome . "','" . $data . "','bruh','".$tel."')"; 
		

	$result = mysqli_query($connect, $q1)
		or die ("Errore nella query" . mysqli_error($connect));

	$result = mysqli_query($connect, $q2)
        or die ("Errore nella query" . mysqli_error($connect));
	
	mysqli_close($connect); 

	echo "<meta http-equiv=\"refresh\" target=\"_blank\" content=\"0.1;URL=http://aidme.tk/login.html\">";

?>
</body>
</html>
