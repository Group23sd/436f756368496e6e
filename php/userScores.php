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

		<title> Mis Puntajes </title>
	</head>

  <body>

	<?php
		$idusuario = $_GET['iduser'];

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
													<div class="col-md-9 col-sm-offset-1">
                                                        <h1>Mis Puntajes</h1>
														<table class="table table-responsive table-striped table-bordered">
															<tbody>

																<?php
																	$sql = "SELECT nombre, apellido FROM usuario WHERE idusuario = $idusuario";
																	$nombreUser = queryByAssoc($sql);
																	$nombreUser = $nombreUser['nombre']." ".$nombreUser['apellido'];

																  $sql = "SELECT * FROM reserva WHERE idusuario=$idusuario";
																  $result = queryAllByAssoc($sql);

                                                                  if (!$result) {
                                                                      echo "<h3>No has recibido ningun puntaje</h3>";
                                                                  }

																	foreach ($result as $reserva) {
																		$idcouch = $reserva['idcouch'];
																		$sql = "SELECT * FROM couch WHERE idcouch = $idcouch";
																		$couch = queryByAssoc($sql);
																		$namecouch = $couch['titulo'];

																		$puntos = $reserva['puntaje_usuario'];
																		$comentario = $reserva['puntaje_usuario_comentario'];
																		$aux = false;
																		echo "<tr>";
																			if(!empty($puntos)){
																				echo "<h5 class='text-success'> El couch <strong>$namecouch</strong> puntu&oacute a <strong>$nombreUser </strong> con: $puntos  <span class='glyphicon glyphicon-star scoreStar'></span></h5>";
																		}else{
																			if(!empty($comentario)){
																				echo "<h5 class='text-success'>  El couch <strong>$namecouch</strong> dej&oacute el siguiente comentario sobre su estadia:</h5>";
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
