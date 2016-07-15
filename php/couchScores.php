<!DOCTYPE HTML>
<?php require_once 'database.php'; ?>

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
												      <li><?php echo '<a href="detallesCouch.php?idcouch='.$idcouch.'">Info del Couch</a>'?></li>
												      <li class="active"><a href="couchScores.php">Puntajes del Couch</a></li>
												      <li><?php echo '<a href="couchComments.php?idcouch='.$idcouch.'">Preguntas de los usuarios</a>'?></li>
												    </ul>
												  </div>
												</div>

												<div class="row">
													<div class="col-md-9 col-sm-offset-1">

														<table class="table table-responsive table-striped table-bordered">
															<tbody>

																<?php
																	$sql = "SELECT titulo FROM couch WHERE idcouch = $idcouch";
																	$tituloCouch = queryByAssoc($sql);
																	$tituloCouch = $tituloCouch['titulo'];

																  $sql = "SELECT * FROM reserva WHERE idcouch=$idcouch";
																  $result = queryAllByAssoc($sql);

																	foreach ($result as $reserva) {
																		$iduser = $reserva['idusuario'];
																		$sql = "SELECT * FROM usuario WHERE idusuario = $iduser";
																		$inquilino = queryByAssoc($sql);
																		$nameuser = $inquilino['nombre'] ." ".$inquilino['apellido'];

																		$puntos = $reserva['puntaje_couch'];
																		$comentario = $reserva['puntaje_couch_comentario'];
																		$aux = false;
																		echo "<tr>";
																			if(!empty($puntos)){
																				echo "<h5 class='text-success'> El usuario <strong>$nameuser</strong> puntu&oacute a <strong>$tituloCouch </strong> con: $puntos  <span class='glyphicon glyphicon-star scoreStar'></span></h5>";
																		}else{
																			if(!empty($comentario)){
																				echo "<h5 class='text-success'>  El usuario <strong>$nameuser</strong> dej&oacute el siguiente comentario sobre su estadia:</h5>";
																				echo "<p class='text-left well'> $comentario </p>";
																				$aux = true;
																			}
																		}
																			if(!empty($comentario) && !$aux){
																				echo "<h5 class='text-success'> Y dej&oacute el siguiente comentario sobre su estadia:</h5>";
																				echo "<p class='text-left well'> $comentario </p>";
																			}
																		echo "</tr>";

																	}

																	if(empty($result)){
																		echo '<br />';
																		echo '<h1 class="text-center text-success"> Este Couch todavia no fue puntuado</h1>';
																	}

																?>

															</tbody>
														</table>
													</div>
												</div>

                    </div>
                  </div>
                </div>/
            </div>
        </main>

					<!-- FOOTER -->
						<?php require_once 'footer.php' ?>
    </div>

  </body>
</html>
