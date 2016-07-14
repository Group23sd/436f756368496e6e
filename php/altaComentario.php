<?php
  require_once 'feedback.php';
  require_once 'userSession.php';

  if(isset($_POST['question-text'])){
    require_once 'comentarioDeCouch.php';

    $newAnswer = $_POST['question-text'];
    $idcouch = $_POST['idcouch'];
    $iduser = $_SESSION['user'] -> getId();

    $newComment = new Comentario();
    $newComment -> insert($newAnswer, $idcouch, $iduser);

  }
  else{
    genericError();
  }

?>
