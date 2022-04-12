<?php
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	include("parametri.php");
   
	$connect = mysqli_connect($server, $username, $password)
		or die("Connessione non riuscita: " . mysqli_error($connect));
    mysqli_select_db($connect, $database)
        or die ("Impossibile selezionare il db");

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $query="SELECT Username,Email FROM Utenti WHERE email='$email' AND password='$password'";
	$result=mysqli_query($connect, $query)
		or die ("Errore nella query" . mysqli_error($connect));
    $ret[] = mysqli_fetch_array($result);
    if(isset($ret[0]['Username'])){
        echo json_encode(array("stato" => 1,"messaggio" => "login effettuato"));
        echo json_encode($ret);
    }else{
        echo json_encode(array("stato" => 0,"messaggio" =>"login non riuscito"));
    }
    mysqli_close($connect); 
?>