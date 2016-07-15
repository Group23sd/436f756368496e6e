<?php
  require_once 'feedback.php';
  require_once 'database.php';

  if(isset($_POST['answer-text'])){

    try{
    $id = $_POST['idComment'];
    $answer = $_POST['answer-text'];

    $sql = "UPDATE comentario SET respuesta = :respuesta WHERE idcomentario = $id";
    $database = connectDatabase();
    $statement = $database -> prepare($sql);
    $statement -> bindParam(':respuesta', $answer, PDO::PARAM_STR);
    $statement -> execute();

    respuestaPublicada();
  }
  catch(Exception $e ){
    databaseError();
  }

  }
  else{
    genericError();
  }


?>
