<?php

	require_once 'couch.php';

	$result = $statement -> fetchAll(PDO::FETCH_ASSOC);
	$couchs = array();

	foreach ($result as $value) {

		$c = new Couch();
		$c -> loadData($value);
		$punt = rand(1,10);
		$c -> addPuntaje($punt);

		$idc=$c -> getId();
		$query="SELECT * FROM couch INNER JOIN foto ON (couch.idcouch=foto.idcouch) WHERE couch.idcouch='$idc' AND portada=1";
		$resultFoto= queryByAssoc($query);

		if(empty($resultFoto)){
			$c -> setFotoPortada('../images/resources/CouchInnLogoCouch.png');

		} else{
			$c -> setFotoPortada ($resultFoto['path']);
		}

		array_push($couchs,$c);

	}

	if (!$result) {
		echo "<div class='jumbotron'>";
		echo "<h3>Cero couches encontrados :(</h3>";
		echo "</div>";
	} else {
		//Echo Table

?>
<div id="couchSearchResult">
<div class="table-responsive">
	<table class="table table-condensed">
			<?php
				foreach ($couchs as $value) {

					echo '<tr>';

					echo '<td class="col-md-2">';
					$portada=$value -> getFotoPortada();
					$portada = "'" . $portada . "'";
					echo '<a href=# class=thumbnail> <img src=' .$portada. 'alt=IMAGEN DEL COUCH /> </a>';
					echo '</td>';

					echo "<td style='font-size:16px' class='col-md-2'>";
					echo "<h3>" .'Nombre: '. "</h3>";
					echo "<p class='text-center' class='text-primary'>" .$value -> getTitulo(). "</p>";
					echo "<br />";
					echo "<h3>" .'Precio: '. "</h3>";
					echo "<p class='text-center' class='text-primary'>" .'$' .$value -> getPrecio(). "</p>";
					echo "</td>";

					echo "<td class='col-md-2'>";
					echo "<h3 style='text-align:center' class='text-success'>" .'Puntaje:'.  "</h3>";
					$estrella="'../images/resources/estrella.png'";

					echo "<img id=puntaje src=" . $estrella. "alt=PUNTAJE PROMEDIO DEL COUCH />";
					echo "<h2 style='text-align:center' id='puntos'>".$value -> puntajePromedio(). "</h2>";
					echo '</td>';

					echo '<td class="col-md-2">';
					//echo '<div class="row">';
					if($_SESSION['user'] -> isLogged()){
						echo '<div class="col-md-12">';
						$id = $value -> getId();
						echo '<a href="reserva.php?idcouch='.$id.'" role="button" class="btn btn-primary btn-block">' ."RESERVAR". '</a>';
						echo '</div>';
					} else{
						echo '<div class="col-md-12">';
						echo '<a href="#" role="button" class="btn btn-primary btn-block disabled">' ."RESERVAR". '</a>';
						echo '</div>';
					}
					//echo '</div>';

//					echo '<div class="row">';
					echo '<div class="col-md-12">';
					echo "<p> </p>";
					echo '</div>';
//					echo '</div>';

//					echo '<div class="row">';
					if($_SESSION['user'] -> isLogged()){
						echo '<div class="col-md-12">';
						echo '<a href="detallesCouch.php?idcouch='.$id.'" role="button" type="submit" class="btn btn-info btn-block">' ."VER DETALLES". '</a>';
						echo '</div>';
					} else{
						echo '<div class="col-md-12">';
						echo '<a href="#" role="button" class="btn btn-info btn-block disabled">' ."VER DETALLES". '</a>';
						echo '</div>';
					}
//					echo '</div>';

					echo "</td>";

					echo '</tr>';

				}
			?>
	</table>
</div>
</div>
<?php } ?>
