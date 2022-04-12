<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Untente</title>
</head>

<body>
    <?php
    session_start();

    include("parametri.php");

    $connect = mysqli_connect($server, $username, $password)
        or die("Connessione non riuscita: " . mysqli_error($connect));
    print("Connesso con successo <br />");
    mysqli_select_db($connect, $database)
        or die("Impossibile selezionare il db");
    //query che stampa Nome, Cognome, DataNascita, CodiceFiscale, Telefono dell'utente dalla tabella DatiAnagrafici in base all'id
    $query = "SELECT Nome, Cognome, DataNascita, CodiceFiscale, Telefono FROM DatiAnagrafici WHERE id = '" . $_SESSION['idModifica'] . "'";
    $result = mysqli_query($connect, $query)
        or die("Errore nella query" . mysqli_error($connect));//da controllare la session
    while ($search = mysqli_fetch_array($result)) {
        print("<table border='1'>");
        print("<tr>");
        print("<td>Nome:</td>");
        print("<td>" . $search['Nome'] . "</td>");
        print("</tr>");
        print("<tr>");
        print("<td>Cognome:</td>");
        print("<td>" . $search['Cognome'] . "</td>");
        print("</tr>");
        print("<tr>");
        print("<td>Data di nascita:</td>");
        print("<td>" . $search['DataNascita'] . "</td>");
        print("</tr>");
        print("<tr>");
        print("<td>Codice fiscale:</td>");
        print("<td>" . $search['CodiceFiscale'] . "</td>");
        print("</tr>");
        print("<tr>");
        print("<td>Telefono:</td>");
        print("<td>" . $search['Telefono'] . "</td>");
        print("</tr>");
        print("</table>");
    }

    echo "<h1>Modifica contatto</h1>";
    echo "<form action='Modifica.php' method='post'>";
    echo "<br>Username: <br>";
    echo "<input type=\"text\" name=\"username\" placeholder=\"Username\">";
    echo "<br>Nome: <br>";
    echo "<input type=\"text\" name=\"nome\" placeholder=\"Nome\">";
    echo "<br>Cognome: <br>";
    echo "<input type=\"text\" name=\"cognome\" placeholder=\"Cognome\">";
    echo "<br>Numero di telefono: <br>";
    echo "<input type=\"text\" name=\"telefono\" placeholder=\"Telefono\">";
    echo "<br>Data di nascita: <br>";
    echo "<input type=\"data\" name=\"dataNascita\" placeholder=\"Data di nascita\">";
    echo "<br>Codice fiscale: <br>";
    echo "<input type=\"text\" name=\"codiceFiscale\" placeholder=\"Codice fiscale\">";
    echo "<br><input type=\"submit\" value=\"Modifica\">";

    if ($_POST['nome'] != "") {
        $nome = $_POST['nome'];
        $query = "UPDATE DatiAnagrafici SET Nome = '" . $nome . "' WHERE id = '" . $_SESSION['idModifica'] . "'";
        $result = mysqli_query($connect, $query)
            or die("Errore nella query" . mysqli_error($connect));
    } else if ($_POST['cognome'] != "") {
        $cognome = $_POST['cognome'];
        $query = "UPDATE DatiAnagrafici SET Cognome = '" . $cognome . "' WHERE id = '" . $_SESSION['idModifica'] . "'";
        $result = mysqli_query($connect, $query)
            or die("Errore nella query" . mysqli_error($connect));
    } else if ($_POST['telefono'] != "") {
        $telefono = $_POST['telefono'];
        $query = "UPDATE DatiAnagrafici SET Telefono = '" . $telefono . "' WHERE id = '" . $_SESSION['idModifica'] . "'";
        $result = mysqli_query($connect, $query)
            or die("Errore nella query" . mysqli_error($connect));
    } else if ($_POST['dataNascita'] != "") {
        $dataNascita = $_POST['dataNascita'];
        $query = "UPDATE DatiAnagrafici SET DataNascita = '" . $dataNascita . "' WHERE id = '" . $_SESSION['idModifica'] . "'";
        $result = mysqli_query($connect, $query)
            or die("Errore nella query" . mysqli_error($connect));
    } else if ($_POST['codiceFiscale'] != "") {
        $codiceFiscale = $_POST['codiceFiscale'];
        $query = "UPDATE DatiAnagrafici SET CodiceFiscale = '" . $codiceFiscale . "' WHERE id = '" . $_SESSION['idModifica'] . "'";
        $result = mysqli_query($connect, $query)
            or die("Errore nella query" . mysqli_error($connect));
    } else if ($_POST['username'] != "") {
        $username = $_POST['username'];
        $query = "UPDATE Utenti SET Username = '" . $username . "' WHERE id = '" . $_SESSION['idModifica'] . "'";
        $result = mysqli_query($connect, $query)
            or die("Errore nella query" . mysqli_error($connect));
    }

    mysqli_close($connect);

    ?>
</body>

</html>