<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #ff0000;
        }

    </style>
</head>
<body>
    <?php
    session_start();
    // connessione al database AidMe
    // inserisci Nome, Cognome e telefono nel database
    // crea id numerico per il contatto
    // visualizza il contatto appena inserito

    include("parametri.php");
        $emailUtente = $_SESSION['emailUtente'];
        $nomeUtente = $_SESSION['nomeUtente'];

    $connect = mysqli_connect($server, $username, $password)
        or die("Connessione non riuscita: " . mysqli_error($connect));
    mysqli_select_db($connect, $database)
        or die("Impossibile selezionare il db");

	//fase per incrementare l'id al massimo+1
	$id = "SELECT id FROM NumeriEmergenze;";
	$result = mysqli_query($connect, $id)
		or die ("Errore nella query" . mysqli_error($connect));
	
	// Visualizzo il risultato della query
	while ($search = mysqli_fetch_array($result))
		$i = $search['id'];

	$i = $i+1;
    //estrai idCitta dalla tabella Citta
    $query = "SELECT id FROM Citta WHERE NomeCitta = '".$_POST['Citta']."'";
    $result = mysqli_query($connect, $query)
        or die("Errore nella query" . mysqli_error($connect));
    while ($search = mysqli_fetch_array($result)) {
        $idCitta = $search['id'];
    }

    //estrai idUtente dalla tabella Utenti
    $query = "SELECT id FROM Utenti WHERE Email = '".$emailUtente."'";
    $result = mysqli_query($connect, $query)
        or die("Errore nella query" . mysqli_error($connect));
    while ($search = mysqli_fetch_array($result)) {
        $idUtente = $search['id'];
    }

    $query = "INSERT INTO NumeriEmergenze (id, Nome, Cognome, DataNascita, Telefono, idCitta, idUtente) 
        VALUES ('".$i."','$_POST[nome]', '$_POST[cognome]','$_POST[datanascita]', '$_POST[telefono]', '".$idCitta ."', '".$idUtente."')";
    $result = mysqli_query($connect, $query)
        or die("Errore nella query" . mysqli_error($connect));

    print("<h1> Contatto inserito correttamente <br /></h1>");
	
    mysqli_close($connect); 


    ?>
    <h1>Contatti salvati</h1>
    <?php
    // connessione al database AidMe
    // estrai Nome, Cognome e telefono dalla tabella NumeriEmergenze
    // e li visualizza
    include("parametri.php");
    $connect = mysqli_connect($server, $username, $password)
        or die("Connessione non riuscita: " . mysqli_error($connect));
    mysqli_select_db($connect, $database)
        or die("Impossibile selezionare il db");
    $query = "SELECT Nome, Cognome, Telefono FROM NumeriEmergenze";
    $result = mysqli_query($connect, $query)
        or die("Errore nella query" . mysqli_error($connect));
    while ($search = mysqli_fetch_array($result)) {
        //stampa i risultati in una tabella
        print("<table border='1'>");
        print("<tr>");
        print("<td>Nome:</td>");
        print("<td>".$search['Nome']."</td>");
        print("</tr>");
        print("<tr>");
        print("<td>Cognome:</td>");
        print("<td>".$search['Cognome']."</td>");
        print("</tr>");
        print("<tr>");
        print("<td>Telefono:</td>");
        print("<td>".$search['Telefono']."</td>");
        print("</tr>");
        print("<tr>");
        print("<td><button><a href=\"Modifica.php\"></a>Modifica</button></td>");
        print("<td><button><a href=\"Elimina.php\"></a>Elimina</button></td>");
        print("</tr>");
        print("</table>");
    }
    // libero la memoria occupata dall'istruzione SELECT
    mysqli_free_result($result);
    // chiudo la connessione
    mysqli_close($connect);
    ?>

</body>
</html>