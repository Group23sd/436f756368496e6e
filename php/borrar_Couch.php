<?php

  require_once 'feedback.php';

  if(isset($_POST['idcouch'])){
    require_once 'database.php';
    $idcouch = $_POST['idcouch']   //  CAMBIAR NOMBRE PARAMETRO!!!!!!!!!!!
    try{

      $sql = "DELETE FROM couch WHERE idcouch = :idcouch";
      $database = connectDatabase();
      $statement = $database -> prepare($sql);
      $statement -> bindParam(': idcouch' , $idcouch , PDO::PARAM_INT);
      $statement -> execute();

    }
    catch(Exception $e){
      databaseError();
    }
  }
  else{
    genericError();
  }

?>
