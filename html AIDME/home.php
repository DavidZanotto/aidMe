<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AidMe</title>
</head>
<body>
    <?php
        session_start();

        if(isset($_SESSION['nomeUtente'])){
            echo "Welcome ".$_SESSION['nomeUtente']." - ".$_SESSION['emailUtente']." - ".$_SESSION['idUtente'];
        }
        else{
            header("Location: index.html");
        }
    ?>
	<a href='home.php'>Torna alla home</a><br>
	<a href='logout.php'>Logout</a><br>
	<a href='Contatti.php'>Contatti</a><br>
	<a href='ModificaUtente.php'>Modifica Account</a><br>
</body>
</html>