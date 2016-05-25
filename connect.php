<<?php
  class Connection {
      function recoverData($tableName) {
        $host = "localhost";
        $user = "root"
        $pass = "";
        $db_name = "couchinndb";
        $con = mysql_connect($host,$user,$pass) or die("Cannot connect to the db!");
        mysql_select_db($db,$con) or die("Database not found!");
        $query= "SELECT * FROM $tableName";
        $allData = mysqli_query($query);
        while ($fila = mysql_fetch_array(resultado)) {
          echo"$fila[descripcion]"; </br>

        }



      }




  }











 ?>
