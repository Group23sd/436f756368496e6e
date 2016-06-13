<!DOCTYPE html>
<?php

    require_once 'userSession.php';
    require_once 'database.php';
 ?>
<html>
<head>
    <title>Agregar tipo de couch</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <script src="../js/validator.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- LOGO -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">
                    <img id="logo-navbar" src="../images/resources/CouchInnLogoFull.png" />
                </a>
            </div>
        </div>
    </nav>
    <!-- CONTENT -->
		<div class="container-fluid inner-body">
			 <!-- MAIN -->
			 <main class="row">
					 <div class="col-md-12 content-wrapper">
							 <div class="row main-content">
									 <div class="col-md-6">
										 	<h1> Agregar tipo de couch</h1>
 												<form class="form-block" role="form" data-toggle="validator" action="cargarTipo.php" method="post" name="altaTipoCouch" id="altaTipoCouch">
													<div class="form-group has-feedback">
                                <label for="userFirstName">Nombre del nuevo tipo de Couch</label>
                                <input type="text" pattern="^[A-z\s]+$" class="form-control" name="nombreDelTipo" id="nombreDelTipo" placeholder="Nombre" data-error="Ingrese un nombre!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

														<button type="submit" class="btn btn-success">Aceptar</button>
                            <a class="btn btn-success" href="index.php" role="button">Cancelar</a>

												</form>
									 </div>
							</div>
					</div>
				</main>
				<!-- FOOTER -->
         <?php require_once 'footer.php' ?>
		</div>


  </body>
</html>
