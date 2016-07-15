<!DOCTYPE HTML>
<?php

  require_once 'userSession.php';
  require_once 'feedback.php';
  require_once 'comentarioDeCouch.php';

  if(isset($_GET['idComment'])){
    $idComment = $_GET['idComment'];
    require_once 'database.php';

    $sql  = "SELECT * FROM comentario WHERE idcomentario = '$idComment'";
    $coment = queryByAssoc($sql);

    $comentario = new Comentario();
    $comentario -> loadData($coment);
    $userName = $comentario -> getNombreUsuario();
    $couchName = $comentario -> getNombreCouch();
    $pregunta = $comentario -> getComentario();
    $rta = $comentario -> getRespuesta();
    $idcouch = $coment['idcouch'];
  }
  else{
    genericError();
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <script src="../js/validator.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/ajax.js"></script>
    <script src="../js/bootstrap-filestyle.min.js"></script>
  </head>

  <body>

    <!-- NAVBAR -->
    <?php
      require_once "navbar.php";
    ?>
    <!-- CONTENT -->
      <div class="container-fluid inner-body">
        <!-- MAIN -->
          <main class="row">
            <div class="col-md-10 content-wrapper">
              <div class="row main-content">
                  <div class="col-md-6">
                    <?php

                    echo "<h5 class=text-success> El usuario <strong>$userName</strong> pregunt&oacute lo siguiente:</h5>";
                    echo "<div id=questionCouch>";
                      echo "<p class=well>$pregunta</p>";

                      echo '<form class="form-block" role="form" data-toggle="validator" id="newAnswer" name="newAnswer" action="altaRespuestaComentario.php" method="post">';
                        ?>
                        <input type="hidden" name="idComment" id="idComment" <?php echo 'value='.$idComment ?> class="form-control" required> </input>
                        <?php
                        echo '<div class="form-group has-feedback">';
                          echo '<label for="message-text" class="control-label">Escribe aqu&iacute tu respuesta a la pregunta que te hicieron:</label>';
                          echo '<textarea class="form-control" id="answer-text" name="answer-text" data-error="No puede dejar el campo vacio!" required></textarea>';
                          echo '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>';
                          echo '<div class="help-block with-errors"></div>';
                        echo '</div>';

                        echo '<a class="btn btn-default" href="couchComments.php?idcouch='.$idcouch.'" role="button">Cancelar</a>';
                        echo "  ";
                        echo '<button type="submit" class="btn btn-primary">Enviar</button>';

                      echo '</form>';

                    echo "</div>";

                    ?>
                  </div>
              </div>
            </div>
          </main>
      </div>
  </body>
</html>
