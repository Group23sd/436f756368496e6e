<!DOCTYPE HTML>
<<?php require_once 'database.php'; ?>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../js/jquery.js"></script>
		<script src="../js/validator.js"></script>
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
												      <li><?php echo '<a href="detallesCouch.php?idcouch='.$idcouch.'">Info</a>'?></li>
												      <li class="active"><a href="couchScores.php">Puntajes al Couch</a></li>
												      <li><a href="comentariosCouch.php">Comentarios</a></li>
												    </ul>
												  </div>
												</div>

                        <?php
                          $sql = "SELECT * FROM reserva WHERE idcouch=$idcouch";
                          $result = queryAllByAssoc($sql);

                        ?>


                    </div>
                  </div>
                </div>
            </div>
        </main>
    </div>

  </body>
</html>
