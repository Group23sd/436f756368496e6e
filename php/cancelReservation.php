<?php

require_once 'database.php';
require_once 'feedback.php';
/* Habilitar una de las dos opciones para recibir el parametro

  $idReserva = $_POST['idreserva']; */

try {
  $estado = "Cancelado";
  $idReserva = $_GET['id'];
  date_default_timezone_set('America/Argentina/Buenos_Aires');
 $today = getdate();
 $fecha = date("$today[year]-$today[mon]-$today[mday] $today[hours]:$today[minutes]:$today[seconds]");
  $data = Array($estado,$fecha,$idReserva);
  $sql = "INSERT INTO estado (nombre,fecha,idreserva) VALUES (?,?,?)";
  $connect = connectDatabase();
  $statement = $connect-> prepare($sql);
  $statement -> execute($data);
  successRejection();
} catch (Exception $e) {
  wrongRejection();
  exit();
}








 ?>
