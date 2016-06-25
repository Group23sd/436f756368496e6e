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
    $query = "SELECT c.*, t.descripcion as nombreTipo, cd.nombre as ciudad, cd.region as region, p.nombre as pais FROM couch c INNER JOIN tipo t ON (c.idtipo=t.idtipo) INNER JOIN ciudad cd ON (c.idciudad=cd.idciudad) INNER JOIN pais p ON (cd.idpais=p.idpais) WHERE c.idusuario=$iduser";
    $resultCouch = queryAllByAssoc($query);
?>
<html>
<head>
    <title>Mis couches</title>
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
                    <h2>Mis Couches</h2>
                    <div class="table-responsive">
                        <table class="table table-hover couchTable">
                            <tr>
                                <th>COUCH</th>
                                <th>TIPO</th>
                                <th>CIUDAD</th>
                                <th>PUNTAJE PROMEDIO</th>
                                <th>HABILITACION</th>
                                <th>OPCIONES</th>
                            </tr>
                            <?php
                                foreach ($resultCouch as $couch) {
                                    if ($couch['habilitado']) {
                                        $okBanIcon = "<span class='glyphicon glyphicon-ban-circle' alt='Deshabilitar' title='Deshabilitar'></span>";
                                        echo "<tr class='success'>";
                                    } else {
                                        $okBanIcon = "<span class='glyphicon glyphicon-ok' alt='Habilitar' title='Habilitar'></span>";
                                        echo "<tr class='danger'>";
                                    }
                                    $idCouch = $couch['idcouch'];
                                    $query = "SELECT avg(puntaje_couch) as puntaje FROM reserva WHERE idcouch=$idCouch";
                                    $resultPuntaje = queryByAssoc($query);
                                    $puntajePromedio = $resultPuntaje['puntaje'];
                                    //var_dump($couch);
                                //    echo "<tr>";
                                //    echo "<td>".$couch['idcouch']."</td>";
                                    echo "<td><a href='detallesCouch.php?idcouch=".$couch['idcouch']."'><strong>".$couch['titulo']."</strong></a></td>";
                                    echo "<td>".$couch['nombreTipo']."</td>";
                                //    echo "<td>".$couch['precio']."</td>";
                                    echo "<td>".$couch['ciudad'].", ".$couch['region'].", ".$couch['pais']."</td>";
                                    echo "<td>".round($puntajePromedio,1)."</td>";
                                    echo "<td>"."<a class='btn btn-xs btn-default couchTable' onclick='return confirm(\"Esta seguro que desea cambiar el estado de este couch?\")' href='changeCouchAvailability.php?id=".$couch['idcouch']."' role='button'>".$okBanIcon."</a>"."</td>";
                                //    echo "<td>".$couch['pais']."</td>";
                                //    echo $couch['habilitado'] ? "<td><span class='glyphicon glyphicon-ok'></span></td>" : "<td><span class='glyphicon glyphicon-remove'></span></td>";
                                //    $okBanIcon = $couch['habilitado'] ? "<span class='glyphicon glyphicon-ban-circle' alt='Deshabilitar' title='Deshabilitar'></span>" : "<span class='glyphicon glyphicon-ok' alt='Habilitar' title='Habilitar'></span>";
                                //    echo "<td class='couchTable'><a class='btn btn-xs btn-success couchTable' href='fullCouchDetails.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-plus' alt='Detalles' title='Detalles'></a>";
                                    echo "<td class='couchTable'><a class='btn btn-xs btn-primary couchTable' href='couchReservations.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-bookmark' alt='Reservas' title='Reservas'></a>";
                                    echo "<a class='btn btn-xs btn-success couchTable' href='couchComments.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-envelope' alt='Comentarios' title='Comentarios'></a>";
                                    echo "<a class='btn btn-xs btn-warning couchTable' href='couchScores.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-star' alt='Puntajes' title='Puntajes'></a>";
                                //    echo "<a class='btn btn-xs btn-warning couchTable' onclick='return confirm(\"Esta seguro que desea cambiar el estado de este couch?\")' href='changeCouchAvailability.php?id=".$couch['idcouch']."' role='button'>".$okBanIcon."</a>";
                                    echo "<a class='btn btn-xs btn-info couchTable' href='modificarCouch.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-pencil' alt='Modificar' title='Modificar'></a>";
                                    echo "<a class='btn btn-xs btn-danger couchTable' onclick='return confirm(\"Esta seguro que desea eliminar este couch?\")' href='eliminarCouch.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-trash' alt='Eliminar' title='Eliminar'></a></td>";
                                    echo "</tr>";
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
