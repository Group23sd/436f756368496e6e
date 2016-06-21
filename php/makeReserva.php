<?php
require_once 'userSession.php';
require_once 'database.php';
require_once 'feedback.php';

$dateInicio = $_POST['from'];
$dateFin = $_POST['to'];
$idCouch = $_POST['aux'];
$idUsuario = $_SESSION['user'] -> getId();
$inicio = strtotime($dateInicio);
$fin = strtotime($dateFin);
$cantDias= ceil(abs($fin - $inicio) / 86400);
$query = "SELECT precio FROM couch WHERE idcouch=1";
$result = queryByAssoc($query);
$precio = $result["precio"];
$monto = $precio * $cantDias;

try {
  $data = Array($dateInicio,$dateFin,$monto,$idUsuario,$idCouch);
  $sql = "INSERT INTO reserva (inicio,fin,monto,idusuario,idcouch) VALUES (?,?,?,?,?)";
  $connect = connectDatabase();
  $statement = $connect-> prepare($sql);
  $statement -> execute($data);
  successfulReservation();
} catch (Exception $e) {
  failedReservation();

}



















?>
