<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
include("parametri.php");

$connect = mysqli_connect($server, $username, $password)
    or die("Connessione non riuscita: " . mysqli_error($connect));
mysqli_select_db($connect, $database)
    or die("Impossibile selezionare il db");
//debug: aidme.tk/registrazioneApi.php?username=test&password=test&email=test&&telefono=test&&nome=test&&cognome=test&&data=2001-09-11&&citta=Mississipy&&cf=test
// aidme.tk/registrazioneApi.php?username=Rod&&password=Rod123!&&email=rodl@gmail.com&&telefono=12345&&nome=Rod&&cognome=Orosa&&data=2001-03-01&&citta=Vicenza&&cf=12345667324
$username = $_REQUEST['username'];
$nome = $_REQUEST["nome"];
$email = $_REQUEST["email"];
$tel = $_REQUEST["telefono"];
$pass = $_REQUEST["password"];
$data = $_REQUEST["data"];
$cognome = $_REQUEST["cognome"];
$cf = $_REQUEST["cf"];
$citta = $_REQUEST["citta"];

//controllo se i paramentri inseriti tramite _REQUEST esistono
if (isset($username) && isset($nome) && isset($email) && isset($tel) && isset($pass) && isset($data) && isset($cognome) && isset($cf) && isset($citta)) {

    //fase per incrementare l'id al massimo+1
    $queryid = "SELECT MAX(id) FROM Utenti;";
    $result = mysqli_query($connect, $queryid)
        or die("Errore nella query" . mysqli_error($connect));

    while ($search = mysqli_fetch_array($result))
        $i = $search['MAX(id)'];

    $i = $i + 1;

    mysqli_free_result($result);
    //controlla se citta è presente nella tabella Citta
    //se è presente ne ricava l'id
    //se non è presente lo inserisce e ricava l'id
    $query = "SELECT id FROM Citta WHERE NomeCitta = '$citta'";
    $result = mysqli_query($connect, $query)
        or die("Errore nella query" . mysqli_error($connect));
    while ($search = mysqli_fetch_array($result))
        if (isset($search['id']))
            $idCitta = $search['id'];
        else {//da fixare
            $queryidCitta = "SELECT MAX(id) FROM Citta;";
            $res = mysqli_query($connect, $queryidCitta);
            $idCitta = $search['MAX(id)'];
            $idCitta = $idCitta + 1;
            echo "<h1>$idCitta</h1>";
            $queryInsertCitta = "INSERT INTO Citta ('id', 'NomeCitta') VALUES ('$idCitta', '$citta');";
            $res1 = mysqli_query($connect, $queryInsertCitta)
                or die("Errore nella query" . mysqli_error($connect));
        }
    
    //echo "<h1>$idCitta</h1>";
    
    $q1 = "INSERT INTO Utenti (id, Username, Email, Password, idCitta) VALUES 
            ('$i','$username','$email',' $pass','$idCitta');";

    $q2 = "INSERT INTO DatiAnagrafici (id, Nome, Cognome, DataNascita, CodiceFiscale, Telefono) VALUES 
            ('$i',' $nome ',' $cognome','$data','$cf','$tel')";


    $result = mysqli_query($connect, $q1)
        or die("Errore nella query" . mysqli_error($connect));
    mysqli_free_result($result);

    $result = mysqli_query($connect, $q2)
        or die("Errore nella query" . mysqli_error($connect));

    mysqli_close($connect);
    echo json_encode(array("stato" => 1, "messaggio" => "registrazione effettuata"));
} else {
    echo json_encode(array("stato" => 0, "messaggio" => "registrazione non riuscita"));
}

mysqli_close($connect);

?>
