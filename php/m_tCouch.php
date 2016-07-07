<?php
require_once 'feedback.php';
require_once 'database.php';
  $id = $_GET['idparam'];
  $couch = $_POST['m_Couch'];
  $query = "SELECT * FROM tipo WHERE descripcion='$couch'";
  $result = queryAllByAssoc($query);

if (empty($result)) {
  try {
    $sql = "UPDATE tipo SET descripcion='$couch' WHERE idtipo=$id";
    $connect = connectDatabase();
    $statement = $connect -> prepare($sql);
    $statement -> execute();
    header("Location: listar_tCouch.php");
  } catch (Exception $e) {
    existingCouch();
  }


}
else {
  existingNameCouch();
}









?>
