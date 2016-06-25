<!DOCTYPE html>
<?php
require_once 'userSession.php';
require_once 'database.php';

?>
<html>
<head>
  <title>Mis Reservas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../js/jquery.js"></script>
  <script src="../js/validator.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/ajax.js"></script>
  <script src="../js/slowScroll.js"></script>
</head>
<body>
  <?php
  $idUsuario = $_SESSION['user'] -> getId();
  $query = "SELECT * from reserva WHERE idusuario='$idUsuario'";
  $result = queryAllByAssoc($query);


  ?>
  <!-- NAVBAR -->
  <?php require_once "navbar.php" ?>
  <!-- CONTENT -->
  <div class="container-fluid inner-body">
    <!-- MAIN -->
    <main class="row">
      <div class="col-md-12 content-wrapper">

        <span class="anchor" id="mainContent"></span>
        <div class="row main-content">
          <div class="col-md-12">
            <div class="row">
              <table class="table table-bordered table-condensed" class="container">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de fin</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($result as $value) {


                    date_default_timezone_set('America/Argentina/Buenos_Aires');
                    $today = getdate();
                    $fecha = date("$today[year]-$today[mon]-$today[mday]");
                    $idReserva = $value['idreserva'];
                    $query2 = "SELECT nombre, fecha, idreserva FROM estado WHERE idreserva=$idReserva AND fecha=(SELECT MAX(fecha) FROM estado WHERE idreserva=$idReserva)";
                    $resultado = queryByAssoc($query2);

                    $idCouch = $value['idcouch'];
                    $query3 = "SELECT titulo FROM couch WHERE idcouch=$idCouch";

                    $resultado2 = queryByAssoc($query3);

                    echo '<tr>';
                    echo '<td>'.$resultado2['titulo'].'</td>';
                    echo '<td>'.$value['inicio'].'</td>';
                    echo '<td>'.$value['fin'].'</td>';
                    if (strtotime($fecha) > strtotime($value['fin'])) {
                      echo '<td>'.'<a type="button" class="btn btn-sm btn-success disabled">LIBERADO</a>'.'</td>';

                    }
                    elseif ($resultado['nombre'] == 'Reservado') {
                      echo '<td>'.'<a type="button" class="btn btn-sm btn-warning">EN ESPERA</a>'.'</td>';
                    }
                    elseif ($resultado['nombre'] == 'Rechazado') {
                      echo '<td>'.'<a type="button" class="btn btn-sm btn-danger disabled">RECHAZADA</a>'.'</td>';
                    }
                    elseif ($resultado['nombre'] == 'Confirmado') {
                      echo '<td>'.'<a href="payReservation.php?idR='.$value['idreserva'].'" type="button" class="btn btn-sm btn-success">ACEPTADA</a>'.' '.'<span class="glyphicon  glyphicon-exclamation-sign" style="color:red" aria-hidden="true"></span>'.'<font color="red"> Debes proceder al pago!</font>'.'</td>';

                    }
                    elseif ($resultado['nombre'] == 'Pagado') {
                      echo '<td>'.'<a href="#" type="button" class="btn btn-sm btn-success">PAGADO</a>'.'</td>';

                    }
                    elseif ($resultado['nombre'] == 'Cancelado') {
                      echo '<td>'.'<a type="button" class="btn btn-sm btn-danger disabled">CANCELADO</a>'.'</td>';
                    }


                    else {
                      require_once "feedback.php";
                      echo '<td>'.$resultado['nombre'].'</td>';
                      #genericError();
                      #exit();
                    }
                    echo '<td>'.$resultado['fecha'].'</td>';
                    if (strtotime($fecha) > strtotime($value['fin'])) {
                      echo '<td>'.'<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>'.'<a href="#" type="button" class="btn btn-link">Puntuar hospedaje</a>'.'</td>';

                    }
                    elseif ($resultado['nombre'] == 'Confirmado') {
                      echo '<td>'.'<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>'.'<a href="payReservation.php?idR='.$value['idreserva'].'" type="button" class="btn btn-link">Pagar reserva</a>'.'</td>';
                    }
                    else {
                      echo '<td>'.'<span class="glyphicon  glyphicon-remove"  aria-hidden="true"></span>'.'</td>';
                    }

                    echo '</tr>';
                  }

                  ?>

                </tbody>

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
