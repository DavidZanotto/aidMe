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
	$_SESSION['emailUtente'] = $email;
	$_SESSION['nomeUtente'] = "nigga";


	// Connessione al server dbms
	$connect = mysqli_connect($server, $username, $password)
		or die("Connessione non riuscita: " . mysqli_error($connect));
	print ("Connesso con successo <br />");
    // selezione database
    mysqli_select_db($connect, $database)
        or die ("Impossibile selezionare il db");
	
	//gestione della sessione, salvataggio in sessione del nome e email dell'utente
	//ricerca nel database il Username e l'id in base all'Email
	$query="SELECT Username, id FROM Utenti WHERE Email = '".$email."'";
	$result=mysqli_query($connect, $query);
	$row=mysqli_fetch_array($result);
	$_SESSION['nomeUtente'] = $row['Username'];
	$_SESSION['idUtente'] = $row['id'];

	$q1 = "SELECT Email, Password FROM Utenti;";
	$result = mysqli_query($connect, $q1)
		or die ("Errore nella query" . mysqli_error($connect));
	
	// Visualizzo il risultato della query
	while ($search = mysqli_fetch_array($result)){
		if($email == $search['Email'] && $pass == $search['Password'] && $pass =! ""){
            $_SESSION['login']=true;
        }
    }

    if($_SESSION['login']){
		header("Location: home.php");
	}
	else{
		$_SESSION['login'] = false;
		header("Location: login.hmtl");
	}
	mysqli_free_result($result);

	mysqli_close($connect); 
?>


</body>
</html>
