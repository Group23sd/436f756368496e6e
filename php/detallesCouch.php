<!DOCTYPE html>
<?php
		require_once 'userSession.php';
		require_once 'database.php';
		require_once 'reserva.php';
	//	require_once 'puntajesCouch.php';
	//	require_once 'comentariosCouch.php'

	if(!$_SESSION['user'] -> isLogged()){
		echo "<script type='text/javascript'>window.location='permisoDenegado.php'</script>";
		die();
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
		<meta name="viewport" content="width=device-width, initial-scale=1"> <!--Con esto garantizamos que se vea bien en dispositivos móviles -->
<!--<link href="/436f756368496e6e-master/css/bootstrap.min.css" rel="stylesheet" media="screen">  Llamamos al archivo CSS -->

		<!-- Versión compilada y comprimida del CSS de Bootstrap -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

		<!-- Tema opcional -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
		<link type="text/css" rel="stylesheet" href="/436f756368496e6e-master/css/style.css">

		<title> Informacion del Couch </title>
	</head>

  <body>

	<?php
		session_start();
		$idcouch = $_GET['idcouch'];

	?>

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


										 <div class='container'>
												<div class="row">
													<div class="col-md-12">
														<a href="reserva.php?idcouch=<?php $idcouch ?>" role="button" class="btn btn-success" id="botonReservar"> RESERVAR COUCH! </a>

													</div>
													<br />
													<br />
													<br />
													<br />
													<br />
													<br />



												</div>

												<div class="row">
												  <div class="col-md-11 col-sm-offset-1">
												    <ul class="nav nav-tabs nav-justified">
												      <li class="active"><a href="detallesCouch">Info</a></li>
												      <li><a href="puntajesCouch.php">Puntajes al Couch</a></li>	<!--Como mandar parametro a puntajes -->
												      <li><a href="comentariosCouch.php">Comentarios</a></li>			<!--Como mandar parametro a comentarios -->
												    </ul>
												  </div>
												</div>

												<div class="row">
													<div class="col-md-9 col-sm-offset-2">

														<table class="table table-responsive table-striped table-bordered">
														  <tbody>



																<tr>
																	<?php
																		$query="SELECT * FROM couch WHERE idcouch = '$idcouch'";
																		$result=queryByAssoc($query);

																	?>

																	<td> <h4>TITULO:</h4></td>
															  	<td> <?php echo "<h5>" .$result['titulo']. "</h5>" ?> </td>
																</tr>

																<tr>
																	<td> <h4>PRECIO:</h4></td>
																	<td> <?php echo "<h5>" .'$' .$result['precio']. "</h5>" ?> </td>
																</tr>

																<tr>
																	<td> <h4>CAPACIDAD TOTAL:</h4></td>
																	<td> <?php echo "<h5>" .$result['capacidad'].' personas' . "</h5>" ?> </td>
																</tr>

																<tr>
																	<?php
																		$query="SELECT * FROM couch INNER JOIN ciudad ON (couch.idciudad = ciudad.idciudad) WHERE idcouch = '$idcouch'";
																		$result=queryByAssoc($query);
																	?>
																	<td> <h4>CIUDAD:</h4></td>
																	<td> <?php echo "<h5>" .$result['nombre']. "</h5>" ?>  </td>
																</tr>

																<tr>
																	<?php
																		$query="SELECT * FROM couch INNER JOIN tipo ON (couch.idtipo = tipo.idtipo) WHERE idcouch = '$idcouch'";
																		$result=queryByAssoc($query);
																	?>
																	<td> <h4>TIPO DE COUCH:</h4></td>
																	<td> <?php echo "<h5>" .$result['descripcion']. "</h5>" ?>  </td>
																</tr>

																<tr>
																	<?php
																		$query="SELECT * from caracteristica_couch inner join couch inner join caracteristica on (couch.idcouch='$idcouch' && couch.idcouch=caracteristica_couch.idcouch && caracteristica.idcaracteristica=caracteristica_couch.idcaracteristica)";
																		$result=queryAllByAssoc($query);
																	?>
																	<td> <h4>CARACTERISTICAS DEL LUGAR:</h4></td>
																	<td>
																			<?php
																					foreach ($result as $elem) {
																						echo "<h5>" .'- ' .$elem['descripcion']. "</h5>";
																						echo "<br /";
																					}
																			?>

																	</td>
																</tr>

																<tr>
																	<?php
																		$query="SELECT * FROM couch WHERE idcouch = '$idcouch'";
																		$result=queryByAssoc($query);
																	?>
																	<td> <h4>DESCRIPCION DEL LUGAR:</h4></td>
																	<td> <?php echo "<h5>" .$result['descripcion']. "</h5>" ?> </td>
																</tr>




																<tr colspan="2">
																	<!-- FOTOS DEL COUCH -->
																	<td> <h4> FOTOS DEL COUCH:</h4></td>
																	<?php


																		$query="SELECT * FROM couch INNER JOIN foto ON (foto.idcouch=couch.idcouch) WHERE couch.idcouch = '$idcouch'";
																		$result=queryAllByAssoc($query);
																		$fotosDelCouch=array();
																		if(!empty($result)){
																			foreach ($result as $foto) {
																				array_push($fotosDelCouch, $foto['path']);
																			}
																		}


																		echo '<td>';

																						echo'<div class="row">';
																						if (!empty($fotosDelCouch)){
																							foreach ($fotosDelCouch as $foto) {
																								echo '<div class="col-sm-5">';
																								$foto = "'" . $foto ."'";
																								echo '<a href=# class=thumbnail> <img src=' .$foto. 'alt=IMAGEN DEL COUCH /> </a>';
																								echo '</div>';
																							}
																						echo '</div>';
																						}
																						else{
																							echo '<h5>' ."  No se disponen de fotos para mostrar". '</h5>';
																						}


																		echo '</td>';
																	?>

																</tr>

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




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> <!--Importante llamar antes a jQuery para que funcione bootstrap.min.js -->

    		<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	</body>

</html>
