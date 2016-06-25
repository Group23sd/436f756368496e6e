<?php
require_once "feedback.php";

function conectar(){
  $link = mysqli_connect('127.0.0.1' , 'root' , '1234' , 'CouchInnDB') or die("Error ".mysqli_error($link));
  return $link;
}
  require_once 'database.php';
  $id = $_GET['e'];
  $link = conectar();
  mysqli_select_db($link,'CouchInnDB');
  $total = mysqli_num_rows(mysqli_query($link,"SELECT idtipo FROM couch WHERE idtipo=$id"));
  if ($total == 0) {
      try {
        $connect = connectDatabase();
        $sql = "DELETE FROM tipo WHERE idtipo=$id";
        $statement = $connect-> prepare($sql);
        $statement -> execute();
        header("Location: listar_tCouch.php");
      } catch (Exception $e) {
        echo "<script type='text/javascript'> alert ('".$e->getMessage()."');";
        echo "window.location='index.php' </script>";
      }


  } else {
    existingCouch($id);
    exit();




    }



?>
