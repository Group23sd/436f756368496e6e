<?php
  require_once 'feedback.php';
  require_once 'userSession.php';

  if(isset($_POST['question-text'])){
    require_once 'comentarioDeCouch.php';
    try{
    $newAnswer = $_POST['question-text'];
    $idcouch = $_POST['idcouch'];
    $iduser = $_SESSION['user'] -> getId();

    $newComment = new Comentario();
    if(!empty($newAnswer)){
      $newComment -> insert($newAnswer, $idcouch, $iduser);
    }
    else{
      preguntaEnBlanco();
    }

  }
  catch(Exception $e ){
    databaseError();
  }

  }
  else{
    genericError();
  }

?>
