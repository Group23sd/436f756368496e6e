<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    if (!$_SESSION['user']->isStandard()) {
        unauthorizedAccess();
        exit();
    }

    $iduser = $_SESSION['user']->getId();
    $query = "SELECT r.*, count(r.idcouch) as cantHospedajes, sum(r.monto) as gastoTotal, avg(r.fin-r.inicio) as estadiaPromedio, avg(puntaje_couch) as miExperiencia, couches.* FROM reserva r INNER JOIN (SELECT c.*, t.descripcion as nombreTipo, cd.nombre as ciudad, cd.region as region, p.nombre as pais FROM couch c INNER JOIN tipo t ON (c.idtipo=t.idtipo) INNER JOIN ciudad cd ON (c.idciudad=cd.idciudad) INNER JOIN pais p ON (cd.idpais=p.idpais)) couches ON (r.idcouch=couches.idcouch) INNER JOIN estado e ON (r.idreserva=e.idreserva) WHERE r.idusuario = $iduser AND e.fecha = (SELECT max(fecha) FROM estado WHERE e.idreserva=estado.idreserva) AND e.nombre = 'Liberado' GROUP BY r.idcouch";
    $resultCouch = queryAllByAssoc($query);

?>
<html>
<head>
    <title>Couches Visitados</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/bootbox.js"></script>
    <script src="../js/confirmation.js"></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once "navbar.php" ?>
    <!-- CONTENT -->
    <div class="container-fluid inner-body">
        <!-- MAIN -->
        <main class="row">
            <div class="col-md-12 content-wrapper">
                <div class="row main-content">
                    <h2>Couches Visitados</h2>
                    <div class="table-responsive">
                        <table class="table table-hover couchTable">
                            <tr>
                                <th>COUCH</th>
                                <th>TIPO</th>
                                <th>CIUDAD</th>
                                <th>VISITAS</th>
                                <th>MI EXPERIENCIA</th>
                                <th>GASTO TOTAL</th>
                                <th>ESTADIA PROMEDIO</th>
                            </tr>
                            <?php
                                foreach ($resultCouch as $couch) {
                                //    if ($couch['habilitado']) {
                                //        $status = $couch['habilitado'] ? " disabled alt='Por el momento el couch no puede recibir reservas' title='Por el momento el couch no puede recibir reservas' "
                                        $puntajePromedio = $couch['miExperiencia'] ? round($couch['miExperiencia'],1)." <span class='glyphicon glyphicon-star scoreStar'></span>" : "-";
                                        echo "<tr>";
                                        echo "<td><a class='stdLink'href='detallesCouch.php?idcouch=".$couch['idcouch']."'><strong>".$couch['titulo']."</strong></a></td>";
                                        echo "<td>".$couch['nombreTipo']."</td>";
                                        echo "<td>".$couch['ciudad'].", ".$couch['region'].", ".$couch['pais']."</td>";
                                        echo "<td>".$couch['cantHospedajes']."</td>";
                                        echo "<td>".$puntajePromedio."</td>";
                                        echo "<td>$".$couch['gastoTotal']."</td>";
                                        echo "<td>".round($couch['estadiaPromedio'],0)." dias</td>";
                                        if ($couch['habilitado']) {
                                            echo "<td><a class='btn btn-xs btn-primary couchTable' href='reserva.php?idcouch=".$couch['idcouch']."' role='button'>Reservar</a>";
                                        } else {
                                            echo "<td><a class='btn btn-xs btn-primary couchTable' role='button' disabled alt='Por el momento el couch no puede recibir reservas' title='Por el momento el couch no puede recibir reservas'>Reservar</a>";
                                        }
                                        echo "</tr>";
                                //    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <!-- FOOTER -->
        <?php require_once 'footer.php' ?>
    </div>
</body>
</html>
