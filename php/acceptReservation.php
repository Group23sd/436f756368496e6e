<?php


require_once 'database.php';
require_once 'feedback.php';
/* Habilitar una de las dos opciones para recibir el parametro
$idReserva = $_GET['idreserva'];
$idReserva = $_POST['idreserva']; */
#$idReserva = 55;
$query = "SELECT * FROM reserva WHERE idreserva=$idReserva";
$result = queryByAssoc($query);
$inicio = $result['inicio'];
$fin = $result['fin'];
$idcouch = $result['idcouch'];



try {
  $estado = "Confirmado";
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  $today = getdate();
  $fecha = date("$today[year]-$today[mon]-$today[mday] $today[hours]:$today[minutes]:$today[seconds]");
  $data = Array($estado,$fecha,$idReserva);
  $sql = "INSERT INTO estado (nombre,fecha,idreserva) VALUES (?,?,?)";
  $connect = connectDatabase();
  $statement = $connect-> prepare($sql);
  $statement -> execute($data);
  $query2 = "SELECT * FROM reserva WHERE idreserva!=$idReserva AND '$inicio' < fin AND '$fin' > inicio AND idcouch=$idcouch";
  $result2 = queryAllByAssoc($query2);
  foreach ($result2 as $value) {
    $idReserva = $value['idreserva'];
    $estado = "Rechazado";
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $today = getdate();
    $fecha = date("$today[year]-$today[mon]-$today[mday] $today[hours]:$today[minutes]:$today[seconds]");
    $data = Array($estado,$fecha,$idReserva);
    $sql = "INSERT INTO estado (nombre,fecha,idreserva) VALUES (?,?,?)";
    $connect = connectDatabase();
    $statement = $connect-> prepare($sql);
    $statement -> execute($data);
    successAccept();
  }
} catch (Exception $e) {
  wrongAccept();
}














?>
