<html>
<head>
<title>form</title>
</head>
<body>
<?php
	session_start();
	//nella tabella Utenti manca il numero di telefono dell'utente stesso
	include("parametri.php");

	//salvataggio dei parametri
		$email=$_POST["email"];
		$pass=$_POST["password"];

	//gestione della sessione, salvataggio in sessione del nome e email dell'utente

	$_SESSION['emailUtente'] = $email;
	$_SESSION['nomeUtente'] = "default";
	echo "<h1>Sessione:".$_SESSION['emailUtente']."</h1>";
	// Connessione al server dbms
	$connect = mysqli_connect($server, $username, $password)
		or die("Connessione non riuscita: " . mysqli_error($connect));
	print ("Connesso con successo <br />");


/*
	$data=$_POST["nome"];
	$cognome=$_POST["nome"];
*/
/*
	echo "<h1>email passata:".$email."</h1>";
	echo "<h1>email passata:".$pass."</h1>";
*/
    // selezione database
    mysqli_select_db($connect, $database)
        or die ("Impossibile selezionare il db");

    $t1 = "Utenti"; 

	$q1 = "SELECT Email, Password FROM ". $t1.";";
	$result = mysqli_query($connect, $q1)
		or die ("Errore nella query" . mysqli_error($connect));
	
	// Visualizzo il risultato della query
	while ($search = mysqli_fetch_array($result)){
        /*print "$search[Email]". " $search[Password]";
        print $email . $pass. "<br>";*/
		if($email == $search['Email'] && $pass == $search['Password'] && $pass =! ""){
            $b=true;
        }
    }

    if($b)print "login esguito correttamente";
	echo "<a href='index.php'>Torna alla home</a>";
	echo "<a href='logout.php'>Logout</a>";
	echo "<a href='Contatti.php'>Contatti</a>";
	mysqli_free_result($result);

	mysqli_close($connect); 
?>
</body>
</html>
