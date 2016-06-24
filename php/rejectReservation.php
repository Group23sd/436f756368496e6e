<?php

require_once 'database.php';
require_once 'feedback.php';
/* Habilitar una de las dos opciones para recibir el parametro
  $idReserva = $_GET['idreserva'];
  $idReserva = $_POST['idreserva']; */

try {
    $sql = "UPDATE estado SET nombre='Rechazado' WHERE idreserva=40";
    $connect = connectDatabase();
    $statement = $connect -> prepare($sql);
    $statement -> execute ();
    successRejection();
} catch (Exception $e) {
  wrongRejection();
}








 ?>
