<?php
require_once 'userSession.php';
require_once 'database.php';
require_once 'feedback.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
//* Me guardo los datos de POST *//
$dateInicio = $_POST['from'];
$dateFin = $_POST['to'];
$lugares = $_POST['cantH'];
$idCouch = $_POST['aux'];
$idUsuario = $_SESSION['user'] -> getId();
//* Me guardo la fecha hoy para poder controlar los dias *//
$tod = getdate();
$fech = date("$tod[year]-$tod[mon]-$tod[mday]");
//* Aca nada mas convierte las fechas a algo que pueda reconoer para sacar la cantidad de dias *//
$fecha = strtotime($fech);
$inicio = strtotime($dateInicio);
$fin = strtotime($dateFin);
$fecha = strtotime($fech);
//* Calculo la diferencia de la fecha de inicio con la del dia de hoy, debe ser de al menos 5 dias *//
if ($fecha > $inicio) {
  wrongInitialDate($idCouch);
  exit();
}
$cantDiaswithHoy= ceil(abs($inicio - $fecha) / 86400);
if ($cantDiaswithHoy < 5) {
  wrongDays($idCouch);
  exit();
}
//* Calculo que entre la fecha de inicio y fin haya al menos 4 dias *//
$cantDias= ceil(abs($fin - $inicio) / 86400);
if ($cantDias < 4) {
  wrongDaysBetween($idCouch);
  exit();
}
$query = "SELECT * FROM couch WHERE idcouch=$idCouch";
$result = queryByAssoc($query);
$capacidad = $result["capacidad"];
if ($capacidad < $lugares) {
  wrongCapacity($idCouch);
  exit();
}
$precio = $result["precio"];
$monto = $precio * $cantDias;

try {
  $data = Array($dateInicio,$dateFin,$monto,$idUsuario,$idCouch);
  $sql = "INSERT INTO reserva (inicio,fin,monto,idusuario,idcouch) VALUES (?,?,?,?,?)";
  $connect = connectDatabase();
  $statement = $connect-> prepare($sql);
  $statement -> execute($data);
  $idReserva = $connect -> lastInsertid();
  $nombre = "Reservado";
  $today = getdate();
  $fecha = date("$today[year]-$today[mon]-$today[mday] $today[hours]:$today[minutes]:$today[seconds]");
  $data2 = Array($nombre,$fecha,$idReserva);
  $sql2 = "INSERT INTO estado (nombre,fecha,idreserva) VALUES (?,?,?)";
  $connect2 = connectDatabase();
  $statement2 = $connect2 -> prepare($sql2);
  $statement2 -> execute($data2);
  //* Le mando el mail del dueño del Couch *//
  $query = "SELECT idusuario FROM couch WHERE idcouch = $idCouch";
  $id = queryByAssoc($query);
  $idDueño = $id['idusuario'];
  $query2 = "SELECT * FROM usuario where idusuario=$idDueño";
  $dueño = queryByAssoc($query2);
  require_once 'successfulReservation.php';
  sendSuccessfulReservationEmail($dueño['idusuario'], $dueño['email'], $dueño['nombre']);
  successfulReservation();
} catch (Exception $e) {
  failedReservation();
  exit();

}
























?>
