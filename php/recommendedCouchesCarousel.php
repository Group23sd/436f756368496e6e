<?php

    require_once 'database.php';

    define('minCouchAmount', 3);

    $recommendationQuery = "SELECT c.*, t.descripcion as nombreTipo, cd.nombre as ciudad, cd.region as region, p.nombre as pais FROM couch c INNER JOIN tipo t ON (c.idtipo=t.idtipo) INNER JOIN ciudad cd ON (c.idciudad=cd.idciudad) INNER JOIN pais p ON (cd.idpais=p.idpais)";
    $recommendationResult = queryAllByAssoc($recommendationQuery);
    $fullCouches = array();

    foreach ($recommendationResult as $couch) {
        $idCouch = $couch['idcouch'];
        $query = "SELECT avg(puntaje_couch) as puntaje FROM reserva WHERE idcouch=$idCouch";
        $resultPuntaje = queryByAssoc($query);
        $puntajePromedio = $resultPuntaje['puntaje'];
        $couch['puntajePromedio'] = $puntajePromedio;
        array_push($fullCouches, $couch);
    }

    function cmp($a, $b) {
        if ($a['puntajePromedio'] == $b['puntajePromedio']) {
            return 0;
        }
        return ($a['puntajePromedio'] > $b['puntajePromedio']) ? -1 : 1;
    }

    uasort($fullCouches, 'cmp');

    $couchAmount = (count($fullCouches) < minCouchAmount) ? count($fullCouches) : minCouchAmount;

?>
<div class="col-md-8 recommendedCouchesCarousel-container">
    <h2>Recomendados por la comunidad</h2>
    <div class="row recommendedCouchesCarousel">
        <div id="recommended-couches-carousel" class="carousel slide" data-ride="carousel" style="width: 100%; height:400px">
            <!-- Indicators -->
            <ol class="carousel-indicators">

                <?php
                    for ($i=0; $i < $couchAmount; $i++) {
                        $act = $i ? "" : "class='active'";
                        echo "<li data-target='#recommended-couches-carousel' data-slide-to=$i $act></li>";
                    }
                ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <?php
                    for ($i=0; $i < $couchAmount; $i++) {
                        $couch = $fullCouches[$i];
                        $idcouch = $couch['idcouch'];
                        $query = "SELECT * FROM foto WHERE idcouch = $idcouch AND portada = true";
                        $portada = queryByAssoc($query)['path'] ? queryByAssoc($query)['path'] : "../images/resources/noCouchPicture.jpg";
                        echo $i ? "<div class='item'>" : "<div class='item active'>";
                        echo "<img style='width: 100%; height:400px' src=$portada>";
                        echo "<div class='carousel-caption'>";
                        echo "<h1>"."<a class='stdLink' href='detallesCouch.php?idcouch=".$couch['idcouch']."'>".$couch['titulo']."</a>"."</h1>";
                        echo "<p>".$couch['descripcion']."</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#recommended-couches-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#recommended-couches-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
