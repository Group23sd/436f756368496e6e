<?php


require_once 'database.php';
require_once 'feedback.php';
/* Habilitar una de las dos opciones para recibir el parametro
  $idReserva = $_GET['idreserva'];
  $idReserva = $_POST['idreserva']; */

  try {
      $sql = "UPDATE estado SET nombre='Confirmado' WHERE idreserva=$idReserva";
      $connect = connectDatabase();
      $statement = $connect -> prepare($sql);
      $statement -> execute ();
      $sql2 = "UPDATE estado SET nombre='Rechazado' WHERE idreserva!=$idReserva";
      $connect = connectDatabase();
      $statement2 = $connect -> prepare($sql2);
      $statement2 -> execute ();

      successRejection();
  } catch (Exception $e) {
    #wrongRejection();
  }














?>
