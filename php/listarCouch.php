<!DOCTYPE html>
<?php
	require_once 'couch.php';
	require_once 'database.php';
	require_once 'userSession.php';

?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
		<meta name="viewport" content="width=device-width, initial-scale=1"> <!--Con esto garantizamos que se vea bien en dispositivos móviles -->
<!--		<link href="/436f756368496e6e-master/css/bootstrap.min.css" rel="stylesheet" media="screen">  Llamamos al archivo CSS -->

		<!-- Versión compilada y comprimida del CSS de Bootstrap -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		<!-- Tema opcional -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
		<link type="text/css" rel="stylesheet" href="/436f756368496e6e-master/css/style.css">
		<title>Lista de couch's</title>

</head>

 <body>
	<!-- NAVBAR -->

    <!-- CONTENT -->
		<div class="container-fluid inner-body">
			 <!-- MAIN -->
			 <main class="row">
					 <div class="col-md-12 content-wrapper">
							 <div class="row main-content">
									 <div class="col-md-12">
										 <?php

											//session_start();
									//		$coleccionCouchs = $_GET['resultadoDeBusqueda'];
											$query="SELECT * FROM couch" ;
											$result= queryAllByAssoc($query);
											$couchs=array();

											foreach ($result as $value) {
											    $c = new Couch();
											    $c -> loadData($value);
													$punt = rand(1,10);
													$c -> addPuntaje($punt);

													$idc=$c -> getId();
													$query="SELECT * FROM couch INNER JOIN foto ON (couch.idcouch=foto.idcouch) WHERE couch.idcouch='$idc' AND portada=1";
													$resultFoto= queryByAssoc($query);

													if(empty($resultFoto)){
														$c -> setFotoPortada('/436f756368496e6e-master/images/resources/CouchInnLogoCouch.png');

													}
													else{
														$c -> setFotoPortada ($resultFoto['path']);
													}

											    array_push($couchs,$c);
											}
										?>

										<div class="table-responsive">
										<table class="table table-condensed" class='container'>
											<tbody>
												<?php
													foreach ($couchs as $value) {

														echo '<tr class="row">';

														echo '<td class="col-sm-2 col-sm-offset-2">';
															$portada=$value -> getFotoPortada();
															$portada = "'" . $portada . "'";
															echo '<a href=# class=thumbnail> <img src=' .$portada. 'alt=IMAGEN DEL COUCH /> </a>';
														echo '</td>';

															echo "<td style='font-size:16px' class='col-sm-2'>";
																	echo "<h3>" .'Nombre: '. "</h3>";
																	echo "<p class='text-center' class='text-primary'>" .$value -> getTitulo(). "</p>";
																	echo "<br />";
																	echo "<h3>" .'Precio: '. "</h3>";
																	echo "<p class='text-center' class='text-primary'>" .'$' .$value -> getPrecio(). "</p>";
															echo "</td>";

															echo "<td class='col-sm-2'>";
																echo "<h3 style='text-align:center' class='text-success'>" .'Puntaje:'.  "</h3>";
																$estrella="'/436f756368496e6e-master/images/resources/estrella.png'";

																echo "<img id=puntaje src=" . $estrella. "alt=PUNTAJE PROMEDIO DEL COUCH />";
																echo "<h2 style='text-align:center' id='puntos'>".$value -> puntajePromedio(). "</h2>";
															echo '</td>';

															echo '<td class="col-sm-2">';
																echo '<div class="row">';
																if($_SESSION['user'] -> isLogged()){
																	echo '<div class="col-md-9">';
																		echo '<a href="#" role="button" class="btn btn-primary btn-block">' ."RESERVAR". '</a>';
																	echo '</div>';
																}
																else{
																	echo '<div class="col-md-9">';
																		echo '<a href="#" role="button" class="btn btn-primary btn-block disabled">' ."RESERVAR". '</a>';
																	echo '</div>';
																}
																echo '</div>';

																echo '<div class="row">';
																	echo '<div class="col-md-9">';
																			echo "<p> </p>";
																	echo '</div>';
																echo '</div>';

																echo '<div class="row">';
																if($_SESSION['user'] -> isLogged()){
																	echo '<div class="col-md-9">';
																		echo '<a href="detallesCouch.php?idcouch='.$value -> getId().' role="button" type="submit" class="btn btn-info btn-block">' ."VER DETALLES". '</a>';
																	echo '</div>';
																}
																else{
																	echo '<div class="col-md-9">';
																		echo '<a href="#" role="button" class="btn btn-info btn-block disabled">' ."VER DETALLES". '</a>';
																	echo '</div>';
																}
																echo '</div>';

															echo "</td>";

														echo '</tr>';

													}
												?>


												</tbody>
												</table>
										</div>


									 </div>
							</div>
					</div>
				</main>
	<!-- FOOTER -->
			<?php require_once 'footer.php' ?>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> <!--Importante llamar antes a jQuery para que funcione bootstrap.min.js -->

	<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</body>
</html>
