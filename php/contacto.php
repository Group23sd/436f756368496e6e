<!DOCTYPE html>

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

		<title> Informacion del Sitio </title>
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
										 <div class='container'>

                     <strong><h1 class="text-success"> Quienes somos ?</h1></strong>
                     <h5> Esa es la pregunta que te debes estar haciendo en este mismo momento. Nosotros , somos una empresa argentina de viajes, que estamos trabajando hace más</h5>
                     <h5> de cinco años para que puedas viajar de forma más cómoda a cualquier parte del mundo.</h5>
                     <br />
                     <strong><h1 class="text-success"> Nuestro objetivo</h1></strong>
                     <h5> Nuestro principal objetivo es que puedas buscar un hospedaje en el país al que deseas ir, en el momento que sea. A través de CouchInn vas a poder buscar</h5>
                     <h5> Couchs según tus necesidades y gustos ; encontrarás alojamientos de todo tipo: hostels  , hoteles , casas para alquilar y muchos más; podrás saber de antemano </h5>
                     <h5> como es el lugar en el que te vas a hospedar , el precio de alquiler , la capacidad y hasta fotos del Couch!! </h5>
                     <h5> Con CouchInn puedes organizar tu viaje de familia o con amigos de manera sencilla y rápida , como  ninguna otra empresa de viajes lo hace.</h5>
                     <br />
                     <br />
                     <strong><h1 class="text-success"> Regístrate ahora mismo  .. </h1></strong>

                     <div class="row">
      									 <div class="col-md-12 col-sm-offset-4">
                           <a href="newAccount.php"<h1 class="splash-page-slogan">Tu viaje comienza aquí</h1></a>
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
