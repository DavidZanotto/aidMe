<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Aggiungi contatto</h1>
    <form action="AggiungiContatto.php" method="post">
        Nome
        <br>
        <input type="text" name="nome" placeholder="Nome">
        <br>
        Cognome
        <br>
        <input type="text" name="cognome" placeholder="Cognome">
        <br>
         Numero di telefono
        <br>
        <input type="text" name="telefono" placeholder="Numero di telefono">
        <br>
        Città
        <br>
        <input type="text" name="Citta" placeholder="Citta">
        <br>
        Data di Nascita 
        <br>
        <input type="date" name="datanascita" placeholder="Data di Nascita">
        <br> 
        <input type="submit" id="btnAggiungiContatto"></input>
    </form>
    <h1>Contatti salvati</h1>
    <?php
    session_start();
    // connessione al database AidMe
    // estrai Nome, Cognome e telefono dalla tabella NumeriEmergenze
    // e li visualizza
    include("parametri.php");
    $connect = mysqli_connect($server, $username, $password)
        or die("Connessione non riuscita: " . mysqli_error($connect));
    mysqli_select_db($connect, $database)
        or die("Impossibile selezionare il db");
    $query = "SELECT id, Nome, Cognome, Telefono FROM NumeriEmergenze";
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
        echo "<td><form action='Modifica.php' method='get'>";
        echo "<input type='hidden' name='id' value='".$search['id']."'>";
        echo "<input type='submit' value='Modifica'>";
        echo "</form></td>";
        /*
        print("<td><button><a href=\"Modifica.php\">Modifica</a></button></td>");
        $_SESSION['idModifica'] = $search['id'];*/
        print("<td><button><a href=\"Elimina.php\">Elimina</a></button></td>");
        print("</tr>");
        print("</table>");
    }
    // libero la memoria occupata dall'istruzione SELECT
    mysqli_free_result($result);
    // chiudo la connessione
    mysqli_close($connect);

    ?>
    <button onclick="salvaId()"></button>
    <script>
        salvaId = function() {
            var id = document.getElementById("id").value;
            document.cookie = "id=" + id;
        }
    </script>
</body>

</html>