<?php
require_once "feedback.php";

function conectar(){
  $link = mysqli_connect('127.0.0.1' , 'root' , '1234' , 'CouchInnDB') or die("Error ".mysqli_error($link));
  return $link;
}
  require_once 'database.php';
  $id = $_GET['idparam'];
  $couch = $_POST['m_Couch'];
  $link = conectar();
  mysqli_select_db($link,'CouchInnDB');
  $query = "SELECT * FROM tipo WHERE descripcion='$couch'";
  $result = queryAllByAssoc($query);
  if (!empty($result)) {
    existingNameCouch();
  }
  $total = mysqli_num_rows(mysqli_query($link,"SELECT idtipo FROM couch WHERE idtipo=$id"));
  if ($total == 0) {
      try {
        mysqli_query($link,"UPDATE tipo SET descripcion='$couch' WHERE idtipo=$id");
        header("Location: listar_tCouch.php");
      } catch (Exception $e) {
        genericError();
      }


  } else {
    existingCouch();




  }



?>
