<!DOCTYPE html>
<?php
		require_once 'userSession.php';
		require_once 'database.php';
		require_once 'feedback.php';
	if(!$_SESSION['user'] -> isLogged()){
		unauthorizedAccess();
		die();
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

		<title> Informacion del Couch </title>
	</head>

  <body>

	<?php
		$idcouch = $_GET['idcouch'];

	?>

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
                    <div class='container'>

                       <div class="row">
                         <div class="col-md-10 col-sm-offset-1">
                           <ul class="nav nav-tabs nav-justified">
                             <li><?php echo '<a href=detallesCouch.php?idcouch='.$idcouch.'>Info del Couch</a>'?></li>
                             <li><?php echo '<a href=couchScores.php?idcouch='.$idcouch.'>Puntajes del Couch</a>'?></li>
                             <li class="active"><a href=couchComments.php>Preguntas de los usuarios</a></li>
                           </ul>
                         </div>
                       </div>

                       <div class="row">
                         <div class="col-md-9 col-sm-offset-1">

													 <table class="table table-responsive table-striped table-bordered">
														 <tbody>
															 	<?php
																	require_once 'comentarioDeCouch.php';

																	$userLoggued = $_SESSION['user'] -> getId();
																	$sql = "SELECT idusuario FROM couch WHERE idcouch = $idcouch";
																	$result = queryByAssoc($sql);

																	$couchOwn = $result['idusuario'];
																	$userIsCouchOwn = true;

																	if($userLoggued != $couchOwn){
																		$userIsCouchOwn = false;
																		echo "<br />";

																		echo '<div class="row">';
																			echo '<div class="col-md-12 col-sm-offset-11">';
																				echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#botonPreguntarModal" >Preguntar</button>';
																			echo "</div>";
																		echo '</div>';

																		echo '<div class="modal fade" id="botonPreguntarModal" aria-labelledby="botonPreguntarModal" tabindex="-1" role="dialog" >';
																		echo '<div class="modal-dialog" role="document">';
    																	echo '<div class="modal-content">';
      																	echo '<div class="modal-header">';
        																	echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        																	echo '<h4 class="modal-title" id="exampleModalLabel">Nueva Pregunta</h4>';
      																	echo '</div>';
      																	echo '<div class="modal-body">';
        																	echo '<form class="form-block" role="form" data-toggle="validator" id="newComment" name="newComment" action="altaComentario.php" method="post">';
																						?>
																						<input type="hidden" name="idcouch" id="idcouch" <?php echo 'value='.$idcouch ?> class="form-control" required> </input>
																						<?php
																						echo '<div class="form-group has-feedback">';
																							echo '<label for="message-text" class="control-label">Escribe aqu&iacute tu pregunta sobre este Couch:</label>';
            																	echo '<textarea class="form-control" id="answer-text" name="question-text" data-error="No puede dejar el campo vacio!" required></textarea>';
																							echo '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>';
																							echo '<div class="help-block with-errors"></div>';
																						echo '</div>';

        																		echo '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
        																		echo '<button type="submit" class="btn btn-primary">Enviar</button>';
																					echo '</form>';
      																	echo '</div>';
    																	echo '</div>';
  																	echo '</div>';
																		echo '</div>';

																		echo "<br />";

																	}

																	$sql = "SELECT * FROM comentario WHERE idcouch = $idcouch ORDER BY fecha DESC";
																	$result = queryAllByAssoc($sql);
																	$i = 0;
																	foreach($result as $coment){
																		$comentario = new Comentario();
																		$comentario -> loadData($coment);
																		$userName = $comentario -> getNombreUsuario();
																		$couchName = $comentario -> getNombreCouch();
																		$pregunta = $comentario -> getComentario();
																		$rta = $comentario -> getRespuesta();


																		echo "<br />";
																		echo "<tr>";
																			echo "<h5 class=text-success> El usuario <strong>$userName</strong> pregunt&oacute lo siguiente:</h5>";
																			echo "<div id=questionCouch>";
																				echo "<p class=well>$pregunta</p>";
																				if(!empty($rta)){
																					echo "<h5 class=text-success> <strong>$couchName</strong> respondi&oacute lo siguiente:</h5>";
																					echo "<div id=answerCouchOwner>";
																						echo "<p class=well>$rta</p>";
																					echo "</div>";
																				}
																				else{
																					if($userIsCouchOwn){
																						echo '<div class="row">';
																							echo '<div class="col-md-12 col-sm-offset-10">';
																								echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#botonResponderModal" >Responder</button>';
																							echo "</div>";
																						echo '</div>';

																						echo '<div class="modal fade" id="botonResponderModal" aria-labelledby="botonResponderModal" tabindex="-1" role="dialog" >';
																						echo '<div class="modal-dialog" role="document">';
				    																	echo '<div class="modal-content">';
				      																	echo '<div class="modal-header">';
				        																	echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				        																echo '</div>';

																								echo '<div class="modal-body">';

																									echo "<p>$pregunta</p>";

				        																	echo '<form class="form-block" role="form" data-toggle="validator" id="newAnswer" name="newAnswer" action="altaRespuestaComentario.php" method="post">';
																										?>
																										<input type="hidden" name="index" id="index" <?php echo 'value='.$i ?> class="form-control" required> </input>
																										<?php
																										echo '<div class="form-group has-feedback">';
																											echo '<label for="message-text" class="control-label">Escribe aqu&iacute tu respuesta a la pregunta que te hicieron:</label>';
				            																	echo '<textarea class="form-control" id="answer-text" name="answer-text" data-error="No puede dejar el campo vacio!" required></textarea>';
																											echo '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>';
																											echo '<div class="help-block with-errors"></div>';
																										echo '</div>';

				        																		echo '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
				        																		echo '<button type="submit" class="btn btn-primary">Enviar</button>';
																									echo '</form>';
				      																	echo '</div>';

																							echo '</div>';
																						echo '</div>';
																						echo '</div>';

																					}
																				}
																			echo "</div>";
																		echo "</tr>";
																	$i = $i + 1;
																}

																?>

														 </tbody>
													</table>

                         </div>
                      </div>

                  </div>
                </div>
              </div>
          </div>
      </main>

    <!-- FOOTER -->
    	<?php require_once 'footer.php' ?>
    </div>


 </body>
</html>
