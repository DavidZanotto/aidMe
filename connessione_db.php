<?php
  //ini_set( "display_errors", 0);

  include("parametri.php");
  
  // Connessione al server dbms
  $connect = mysqli_connect($server, $username, $password)
        or die("Connessione non riuscita: " . mysqli_error($connect));
  print ("Connesso con successo <br />");
  
  // selezione database
  mysqli_select_db($connect, $database) 
    or die ("Impossibile selezionare il db");
  // Esecuzione della query
  $table = "Utenti"; // nome della tabella contenuta nel db
  $query = "select * from $database.$table"; // query da eseguire
  $result = mysqli_query($connect, $query)
    or die ("Errore nella query" . mysqli_error($connect));
  
  // Visualizzo il risultato della query
  while ($search = mysqli_fetch_array($result))
    /* $search è un vettore associativo, per accedere all'elemento
       si usa come indice il nome del campo della tabella */
    {
      print "<br>";
      print "$search[id] " . "$search[Username] <br>";
    }
  // libero la memoria occupata dall'istruzione SELECT
  mysqli_free_result($result);
  mysqli_close($connect); // chiusura della connessione al server Mysql
?>
