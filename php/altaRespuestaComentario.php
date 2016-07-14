<?php
  require_once 'feedback.php';

  if(isset($_POST['answer-text'])){
    require_once 'comentarioDeCouch.php';
    echo var_dump($_POST);
    $i = $_POST['index'];
    $answer = $_POST['answer-text'];

    $sql = "UPDATE comentario SET respuesta = :respuesta WHERE idcomentario = $id";
    $database = connectDatabase();
    $statement = $database -> prepare($sql);
    $statement -> bindParam(':respuesta', $answer, PDO::PARAM_STR);
    $statement -> execute();

    //respuestaPublicada();

  }
  else{
    genericError();
  }


?>
