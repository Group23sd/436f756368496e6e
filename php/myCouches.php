<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';
/*
    if (!$_SESSION['user']->isStandard()) {
        unauthorizedAccess();
        exit();
    }
*/
    $query = "SELECT * FROM couch";
    $result = queryAllByAssoc($query);
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
                    <div class="table-responsive">
                        <table class="table table-hover couchTable">
                            <tr>
                                <th>ID</th>
                                <th>TITULO</th>
                                <th>IDTIPO</th>
                                <th>PRECIO</th>
                                <th>IDCIUDAD</th>
                            </tr>
                            <?php
                                foreach ($result as $couch) {
                                    if ($couch['habilitado']) {
                                        $okBanIcon = "<span class='glyphicon glyphicon-ban-circle' alt='Deshabilitar' title='Deshabilitar'></span>";
                                        echo "<tr class='success'>";
                                    } else {
                                        $okBanIcon = "<span class='glyphicon glyphicon-ok' alt='Habilitar' title='Habilitar'></span>";
                                        echo "<tr class='danger'>";
                                    }
                                //    echo "<tr>";
                                    echo "<td>".$couch['idcouch']."</td>";
                                    echo "<td>".$couch['titulo']."</td>";
                                    echo "<td>".$couch['idtipo']."</td>";
                                    echo "<td>".$couch['precio']."</td>";
                                    echo "<td>".$couch['idciudad']."</td>";
                                //    echo $couch['habilitado'] ? "<td><span class='glyphicon glyphicon-ok'></span></td>" : "<td><span class='glyphicon glyphicon-remove'></span></td>";
                                //    $okBanIcon = $couch['habilitado'] ? "<span class='glyphicon glyphicon-ban-circle' alt='Deshabilitar' title='Deshabilitar'></span>" : "<span class='glyphicon glyphicon-ok' alt='Habilitar' title='Habilitar'></span>";
                                    echo "<td class='couchTable'><a class='btn btn-xs btn-success couchTable' href='fullCouchDetails.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-plus' alt='Detalles' title='Detalles'></a>";
                                    echo "<a class='btn btn-xs btn-success couchTable' href='couchReservations.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-bookmark' alt='Reservas' title='Reservas'></a>";
                                    echo "<a class='btn btn-xs btn-success couchTable' href='couchComments.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-envelope' alt='Comentarios' title='Comentarios'></a>";
                                    echo "<a class='btn btn-xs btn-success couchTable' href='couchScores.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-star' alt='Puntajes' title='Puntajes'></a>";
                                    echo "<a class='btn btn-xs btn-success couchTable' id='changeCouchState' data-href='changeCouchAvailability.php?id=".$couch['idcouch']."' role='button'>".$okBanIcon."</a>";
                                    echo "<a class='btn btn-xs btn-success couchTable' href='modificarCouch.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-cog' alt='Modificar' title='Modificar'></a>";
                                    echo "<a class='btn btn-xs btn-success couchTable' id='deleteCouch' data-href='eliminarCouch.php?id=".$couch['idcouch']."' role='button'><span class='glyphicon glyphicon-trash' alt='Eliminar' title='Eliminar'></a></td>";
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
