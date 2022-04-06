<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica contatto</title>
</head>
<body>
    <?php
    session_start();
    //cerca nel database il contatto in base all'id salvato in $_SESSION['idModifica']
    include("parametri.php");
    $connect = mysqli_connect($server, $username, $password)
        or die("Connessione non riuscita: " . mysqli_error($connect));
    mysqli_select_db($connect, $database)
        or die("Impossibile selezionare il db");
    if(isset($_GET['id']))
        $_SESSION['idModifica']=$_GET['id'];

    $query = "SELECT id, Nome, Cognome, Telefono FROM NumeriEmergenze WHERE id = '".$_SESSION['idModifica']."'";
    $result = mysqli_query($connect, $query)
        or die("Errore nella query" . mysqli_error($connect));
    while ($search = mysqli_fetch_array($result)) {
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
        print("</table>");
    }
        echo "<h1>Modifica contatto</h1>";
        echo "<form action='Modifica.php' method='post'>";
        echo "Nome: <br>";
        echo "<input type=\"text\" name=\"nome\" placeholder=\"Nome\">";
        echo "Cognome: <br>";
        echo "<input type=\"text\" name=\"cognome\" placeholder=\"Cognome\">";
        echo "Numero di telefono: <br>";
        echo "<input type=\"text\" name=\"telefono\" placeholder=\"Telefono\">";
        echo "<input type=\"submit\" value=\"Modifica\">";

        if($_POST['nome'] != ""){
            $nome = $_POST['nome'];
            $query = "UPDATE NumeriEmergenze SET Nome = '".$nome."' WHERE id = '".$_SESSION['idModifica']."'";
            $result = mysqli_query($connect, $query)
                or die("Errore nella query" . mysqli_error($connect));
        }else if($_POST['cognome'] != ""){
            $cognome = $_POST['cognome'];
            $query = "UPDATE NumeriEmergenze SET Cognome = '".$cognome."' WHERE id = '".$_SESSION['idModifica']."'";
            $result = mysqli_query($connect, $query)
                or die("Errore nella query" . mysqli_error($connect));
        }else if($_POST['telefono'] != ""){
            $telefono = $_POST['telefono'];
            $query = "UPDATE NumeriEmergenze SET Telefono = '".$telefono."' WHERE id = '".$_SESSION['idModifica']."'";
            $result = mysqli_query($connect, $query)
                or die("Errore nella query" . mysqli_error($connect));
        }
    ?>
</body>
</html>