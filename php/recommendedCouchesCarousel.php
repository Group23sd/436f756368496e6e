<?php

    require_once 'database.php';

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

?>
<div class="col-md-8 recommendedCouchesCarousel-container">
    <h2>Recomendados por la comunidad</h2>
    <div class="row recommendedCouchesCarousel">
        <div id="recommended-couches-carousel" class="carousel slide" data-ride="carousel" style="width: 100%; height:400px">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#recommended-couches-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#recommended-couches-carousel" data-slide-to="1"></li>
                <!--
                <li data-target="#recommended-couches-carousel" data-slide-to="2"></li>

                <li data-target="#recommended-couches-carousel" data-slide-to="3"></li>
                <li data-target="#recommended-couches-carousel" data-slide-to="4"></li>
                -->
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <?php
                    for ($i=0; $i < 2; $i++) {
                        $couch = $fullCouches[$i];
                        echo $i ? "<div class='item active'>" : "<div class='item'>";
                        echo "<img style='width: 100%; height:400px' src='../images/resources/splash1.jpg'>";
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
