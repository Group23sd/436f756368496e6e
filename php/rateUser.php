<?php
  require_once "database.php";
  require_once "feedback.php";

$idreserva =;
if (isset($_POST['comentario']) && isset($_POST['puntaje'])) {
  try {
    $comentario = $_POST['comentario'];
    $puntaje = $_POST['puntaje'];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $today = getdate();
    $fecha = date("$today[year]-$today[mon]-$today[mday]");
    $sql = "UPDATE reserva SET puntaje_usuario='$puntaje', puntaje_usuario_comentario='$comentario', puntaje_usuario_fecha='$fecha' WHERE idreserva=50";
    $connect = connectDatabase();
    $statement = $connect-> prepare($sql);
    $statement -> execute();
  } catch (Exception $e) {
    genericError();
  }
}
  elseif (!isset($_POST['comentario']) && isset($_POST['puntaje'])) {
    try {
      $comentario = $_POST['comentario'];
      date_default_timezone_set('America/Argentina/Buenos_Aires');
      $today = getdate();
      $fecha = date("$today[year]-$today[mon]-$today[mday]");
      $sql = "UPDATE reserva SET puntaje_usuario='$puntaje', puntaje_usuario_fecha='$fecha' WHERE idreserva=$idreserva";
      $connect = connectDatabase();
      $statement = $connect-> prepare($sql);
      $statement -> execute();
    } catch (Exception $e) {
      genericError();
    }

  }











  ?>
