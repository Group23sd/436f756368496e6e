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
    $newComment -> insert($newAnswer, $idcouch, $iduser);
  }
  catch(Exception $e ){
    databaseError();
  }

  }
  else{
    genericError();
  }

?>
