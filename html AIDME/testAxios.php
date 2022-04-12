<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

	include("parametri.php");

	$connect = mysqli_connect($server, $username, $password)
		or die("Connessione non riuscita: " . mysqli_error($connect));
    mysqli_select_db($connect, $database)
        or die ("Impossibile selezionare il db");
    
	$query="SELECT * FROM Utenti";
	$result=mysqli_query($connect, $query)
		or die ("Errore nella query" . mysqli_error($connect));
    $ret[] = mysqli_fetch_array($result);

    //$prova = $_REQUEST['prova'];
    echo json_encode($ret);
    mysqli_close($connect); 
?>