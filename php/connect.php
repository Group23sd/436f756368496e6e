<?php
  class Connection {
      function connect() {
        $host = "127.0.0.1";
        $user = "root";
        $pass = "1234";
        $db_name = "CouchInnDB";
        $con = mysql_connect($host,$user,$pass) or die("Cannot connect to the db!");
        mysql_select_db($db_name,$con) or die("Database not found!");

      }
      function recoverData($tableName) {
        $query= "SELECT * FROM $tableName";
        $allData = mysql_query($query);
        $fila = mysql_fetch_array($allData);
        return ($fila);
      }

  }
 ?>
