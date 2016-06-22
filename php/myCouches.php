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
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>TITULO</th>
                                <th>IDTIPO</th>
                                <th>PRECIO</th>
                                <th>IDCIUDAD</th>
                                <th>HABILITADO</th>
                                <th>RESERVAS</th>
                                <th>COMENTARIOS</th>
                                <th>HAB/DESHAB</th>
                                <th>MODIFICAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                            <?php
                                foreach ($result as $couch) {
                                    echo "<tr>";
                                    echo "<td>".$couch['idcouch']."</td>";
                                    echo "<td>".$couch['titulo']."</td>";
                                    echo "<td>".$couch['idtipo']."</td>";
                                    echo "<td>".$couch['precio']."</td>";
                                    echo "<td>".$couch['idciudad']."</td>";
                                    //echo "<td>".$couch['habilitado']."</td>";
                                    echo $couch['habilitado'] ? "<td><span class='glyphicon glyphicon-ok'></span></td>" : "<td><span class='glyphicon glyphicon-remove'></span></td>";
                                    echo "<td><a class='btn btn-xs btn-success' href='couchReservations?id=".$couch['idcouch'].".php' role='button'>Reservas</a></td>";
                                    echo "<td><a class='btn btn-xs btn-success' href='couchComments?id=".$couch['idcouch'].".php' role='button'>Comentarios</a></td>";
                                    echo "<td><a class='btn btn-xs btn-success' href='changeCouchAvailability?id=".$couch['idcouch'].".php' role='button'>Hab/Deshab</a></td>";
                                    echo "<td><a class='btn btn-xs btn-success' href='modificarCouch?id=".$couch['idcouch'].".php' role='button'>Modificar</a></td>";
                                    echo "<td><a class='btn btn-xs btn-success' href='eliminarCouch?id=".$couch['idcouch'].".php' role='button'>Eliminar</a></td>";
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
