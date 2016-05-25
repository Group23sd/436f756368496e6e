<?php
  class Connection {
      function recoverData($tableName) {
        $host = "127.0.0.1";
        $user = "root";
        $pass = "1234";
        $db_name = "CouchInnDB";
        $con = mysql_connect($host,$user,$pass) or die("Cannot connect to the db!");
        mysql_select_db($db_name,$con) or die("Database not found!");
        $query= "SELECT * FROM $tableName";
        $allData = mysql_query($query);
        while ($fila = mysql_fetch_array($allData)) {
          echo "$fila[descripcion] </br>";
        }
      }
  }
 ?>
