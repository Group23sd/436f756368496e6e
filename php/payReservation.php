<?php

    require_once 'userSession.php';
    require_once 'database.php';
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    //Solo si el usuario es 'Standard'
    if (!$_SESSION['user']->isStandard() || !isset($_GET['idR'])) {
        unauthorizedAccess();
        exit();
    }
    //Solo si la reserva es de este usuario
    $reservationId = $_GET['idR'];
    $query = "SELECT * FROM reserva WHERE idreserva = $reservationId";
    $reservation = queryByAssoc($query);
    if (!$reservation || $reservation['idusuario'] != $_SESSION['user']->getId() ) {
        unauthorizedAccess();
        exit();
    }
    //Solo si la reserva está 'Confirmado'
    $query = "SELECT nombre FROM estado WHERE fecha = (SELECT max(fecha) FROM estado WHERE idreserva = $reservationId)";
    $reservationStatus = queryByAssoc($query)['nombre'];
    if ($reservationStatus != 'Confirmado') {
        genericError();
        exit();
    }

    //Datos del couch
    $idCouch = $reservation['idcouch'];
    $query = "SELECT titulo, idusuario FROM couch WHERE idcouch = $idCouch";
    $result = queryByAssoc($query);
    $couchTitle = $result['titulo'];
    //Datos del dueño
    $userId = $result['idusuario'];
    $query = "SELECT * FROM usuario WHERE idusuario = $userId";
    $owner = queryByAssoc($query);

    //Computa el pago
    if (isset($_GET['p'])) {
        try {
            $status = 'Pagado';
            $now = date("Y-m-d H:i:s");
            $data = Array($status, $now, $reservationId);
            $sql = "INSERT INTO estado (nombre, fecha, idreserva) VALUES (?, ?, ?)";
            $database = connectDatabase();
            $statement = $database -> prepare($sql);
            $statement -> execute($data);
            require_once 'successfulPaymentEmail.php';
            sendSuccessfulPaymentEmail($owner['idusuario'], $owner['email'], $owner['nombre']);
            exit();
        } catch (Exception $e) {
            databaseError();
            exit();
        }
    }

?>

<html>
<head>
    <title>Pagar Reserva</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <script src="/js/validator.js"></script>
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
                    <div class="page-header">
                        <h1>Pagar Reserva</h1>
                    </div>
                    <div class="col-md-5">
                        <form data-toggle="validator" name="pagar"  method="post" onsubmit="return validar()" action="payReservation.php?<?php echo "idR=".$reservationId."&p=1" ?>" role="form" class="form-block" >

                            <p> <input type="radio" name="card" id="2" checked> <img src="http://i.imgur.com/VnMJQ8k.png" alt="" class="img-rounded" /> </p>
                            <div class="form-group has-feedback">
                                <label for="name" class="control-label">Nombre: </label>
                                <input type="text" class="form-control" maxlength="20" pattern="^[A-z\s]+$" name="names" placeholder="Nombre" id="name" data-error-pattern="askdsadsa"   required>
                                <span class="glyphicon form-control-feedback " aria-hidden="true"></span>
                                <div class="help-block with-errors">El nombre que aparece en la tarjeta</div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="card" class="control-label">Numero de tarjeta: </label>
                                <input type="text" class="form-control" maxlength="19" name="num" pattern="^4\d{3}([\ \-]?)\d{4}\1\d{4}\1\d{4}$"  data-minlength="19"  placeholder="xxxx-xxxx-xxxx-xxxx" id="card"  data-minlength-error="Numero de tarjeta incompleto, faltan numeros (20)"  required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors">El numero de su tarjeta, separado por "-"</div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="pass" class="control-label">Codigo de seguridad: </label>
                                <input type="password" class="form-control" size="3" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="3" name="pass" placeholder="***" id="pass" data-minlength-error="El cod. de seguridad debe tener 3 numeros"   required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors">Codido del reverso de su tarjeta </div>
                            </div>
                            <div class="form-group">
                                <label for="date" class="control-label">Fecha de vencimiento: </label>
                                <select name="month" class="btn btn-sm btn-success " id="month">
                                    <option>01</option> <option>02</option> <option>03</option> <option>04</option>
                                    <option>05</option> <option>06</option> <option>07</option> <option>08</option>
                                    <option>09</option> <option>10</option> <option>11</option> <option>12</option>
                                </select>
                                <select name="year" class="btn btn-sm btn-success " id="year">
                                    <option selected>2016</option> <option>2017</option> <option>2018</option>
                                    <option>2019</option> <option>2020</option> </select>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="terms" data-error="Debe estar seguro de pagar!" required>
                                        Acepto los terminos y condiciones de "CouchInn"
                                    </label>
                                    <div class="help-block with-errors">
                                    </div>
                                </div>

                                <div class="alert alert-info form-group ">
                                    Si tienes alguna duda puedes leer el <a href="#" class="alert-link">acuerdo legal</a> del sitio
                                </div>

                                <button type="submit" class="btn btn-sm btn-success " >Pagar</button> <button type="reset" class="btn btn-sm btn-success ">Borrar</button>
                            </form>
                        </div>
                        <div class="col-md-6 col-md-push-1">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>COUCH</th>
                                        <th>INICIO</th>
                                        <th>FIN</th>
                                        <th>MONTO</th>
                                    </tr>
                                    <?php
                                        echo "<tr>";
                                        echo "<td>".$couchTitle."</td>";
                                        echo "<td>".$reservation['inicio']."</td>";
                                        echo "<td>".$reservation['fin']."</td>";
                                        echo "<td>$".$reservation['monto']."</td>";
                                        echo "</tr>";
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- FOOTER -->
            <?php require_once 'footer.php' ?>
        </div>
    </body>
    </html>
