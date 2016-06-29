<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    if ((!$_SESSION['user']->isStandard()) || (!isset($_GET['id']))) {
        unauthorizedAccess();
        exit();
    }

    $database = connectDatabase();
    $query = "SELECT c.idusuario, c.titulo FROM couch c WHERE idcouch = :idcouch";
    $statement = $database -> prepare($query);
    $statement -> bindParam(':idcouch', $_GET['id'], PDO::PARAM_INT);
    $statement -> execute();
    $result = $statement -> fetch(PDO::FETCH_ASSOC);
    $couchOwner = $result['idusuario'];
    $couchTitle = $result['titulo'];

    if ($couchOwner != $_SESSION['user']->getId()) {
        unauthorizedAccess();
        exit();
    }

    $database = connectDatabase();
    $query = "SELECT r.*, c.titulo FROM reserva r INNER JOIN couch c ON (r.idcouch=c.idcouch) WHERE r.idcouch = :idcouch";
    $statement = $database -> prepare($query);
    $statement -> bindParam(':idcouch', $_GET['id'], PDO::PARAM_INT);
    $statement -> execute();
    $result = $statement -> fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <title>Reservas para mi Couch</title>
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
                    <h2>Reservas - <?php echo "<a class='stdLink' href='detallesCouch.php?idcouch=".$_GET['id']."'>".$couchTitle."</a>" ?></h2>
                    <div class="table-responsive">
                        <table class="table table-hover couchTable">
                            <tr>
                                <tr>
                                  <th>USUARIO</th>
                                  <th>DESDE</th>
                                  <th>HASTA</th>
                                  <th>MONTO</th>
                                  <th>ESTADO</th>
                                  <th>ACCION</th>
                                </tr>
                            </tr>
                            <?php
                                foreach ($result as $reservation) {
                                    $reservationId = $reservation['idreserva'];
                                    $query = "SELECT * FROM estado e WHERE e.fecha = (SELECT max(fecha) FROM estado WHERE e.idreserva=estado.idreserva) AND idreserva = :idreserva";
                                    $statement = $database -> prepare($query);
                                    $statement -> bindParam(':idreserva', $reservationId, PDO::PARAM_INT);
                                    $statement -> execute();
                                    $resultEstado = $statement -> fetch(PDO::FETCH_ASSOC);
                                    $userID = $reservation['idusuario'];
                                    $query = "SELECT * FROM usuario u WHERE idusuario = $userID";
                                    $userData = queryByAssoc($query);
                                    echo "<tr>";
                                    echo "<td>".$userData['nombre']." ".$userData['apellido']."</td>";
                                    echo "<td>".$reservation['inicio']."</td>";
                                    echo "<td>".$reservation['fin']."</td>";
                                    echo "<td>$".$reservation['monto']."</td>";
                                    echo "<td>".$resultEstado['nombre']."</td>";
                                    echo "<td>";
                                    switch ($resultEstado['nombre']) {
                                        case 'Reservado':
                                            echo "<a class='btn btn-xs btn-success couchTable' onclick='return confirm(\"Esta seguro que desea confirmar esta reserva?\")' href='acceptReservation.php?id=".$reservationId."' role='button'>Confirmar</a>";
                                            echo "<a class='btn btn-xs btn-warning couchTable' onclick='return confirm(\"Esta seguro que desea rechazar esta reserva?\")' href='rejectReservation.php?id=".$reservationId."' role='button'>Rechazar</a>";
                                        break;
                                        case 'Pagado':
                                            echo "<a class='btn btn-xs btn-danger couchTable' onclick='return confirm(\"Esta seguro que desea cancelar esta reserva?\")' href='cancelReservation.php?id=".$reservationId."' role='button'>Cancelar</a>";
                                        break;
                                        case 'Confirmado':
                                            echo "<a class='btn btn-xs btn-danger couchTable' onclick='return confirm(\"Esta seguro que desea cancelar esta reserva?\")' href='cancelReservation.php?id=".$reservationId."' role='button'>Cancelar</a>";
                                        break;
                                        case 'Liberado':
                                            echo "<a class='btn btn-xs btn-warning couchTable' href='rateUserForm.php?id=".$reservationId."' role='button'>Puntuar</a>";
                                        break;
                                    }
                                    echo "</td>";
                                //    echo "<td>".round($puntajePromedio,1)."</td>";
                                //    echo "<td>"."<a class='btn btn-xs btn-default couchTable' onclick='return confirm(\"Esta seguro que desea cambiar el estado de este couch?\")' href='changeCouchAvailability.php?id=".$couch['idcouch']."' role='button'>".$okBanIcon."</a>"."</td>";
                                //    echo "<td>".$couch['pais']."</td>";
                                //    echo $couch['habilitado'] ? "<td><span class='glyphicon glyphicon-ok'></span></td>" : "<td><span class='glyphicon glyphicon-remove'></span></td>";
                                //    $okBanIcon = $couch['habilitado'] ? "<span class='glyphicon glyphicon-ban-circle' alt='Deshabilitar' title='Deshabilitar'></span>" : "<span class='glyphicon glyphicon-ok' alt='Habilitar' title='Habilitar'></span>";
                                //    echo "<td class='couchTable'><a class='btn btn-xs btn-success couchTable' href='fullCouchDetails.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-plus' alt='Detalles' title='Detalles'></a>";
                                //    echo "<td class='couchTable'><a class='btn btn-xs btn-primary couchTable' href='couchReservations.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-bookmark' alt='Reservas' title='Reservas'></a>";
                                //    echo "<a class='btn btn-xs btn-success couchTable' href='couchComments.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-envelope' alt='Comentarios' title='Comentarios'></a>";
                                //    echo "<a class='btn btn-xs btn-warning couchTable' href='couchScores.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-star' alt='Puntajes' title='Puntajes'></a>";
                                //    echo "<a class='btn btn-xs btn-warning couchTable' onclick='return confirm(\"Esta seguro que desea cambiar el estado de este couch?\")' href='changeCouchAvailability.php?id=".$couch['idcouch']."' role='button'>".$okBanIcon."</a>";
                                //    echo "<a class='btn btn-xs btn-info couchTable' href='modificarCouch.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-pencil' alt='Modificar' title='Modificar'></a>";
                                //    echo "<a class='btn btn-xs btn-danger couchTable' onclick='return confirm(\"Esta seguro que desea eliminar este couch?\")' href='eliminarCouch.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-trash' alt='Eliminar' title='Eliminar'></a></td>";
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
