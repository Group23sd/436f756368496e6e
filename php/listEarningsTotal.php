<!DOCTYPE html>
<?php
require_once 'userSession.php';
require_once 'database.php';
require_once 'feedback.php';

if (!$_SESSION['user']->isAdmin()) {
  unauthorizedAccess();
  exit();
}

$sql = "SELECT vn.valor FROM valor_negocio vn WHERE vn.valor_nombre = 'porcentajeComision'";
$porcentajeActual = queryByAssoc($sql)['valor'];
?>
<html>
<head>
  <title>Listar Ganancias</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../js/jquery.js"></script>
  <script src="../js/validator.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/ajax.js"></script>
  <script src="../js/slowScroll.js"></script>
  <script src="../js/confirmation.js"></script>
</head>
<body>
  <?php
  $acumulator = 0;
  $inicio=$_POST['from'];
  $fin=$_POST['to'];
  $query = "SELECT * FROM estado WHERE '$inicio' < fecha AND nombre='Liberado'";
  $result = queryAllByAssoc($query);
  $tiny_query = "SELECT * FROM valor_negocio WHERE valor_nombre='porcentajeComision'";
  $result_tiny_query = queryByAssoc($tiny_query);
  $valor_comision= $result_tiny_query['valor'];
  foreach ($result as $value) {
    $idreserva= $value['idreserva'];
    $mini_query = "SELECT * FROM reserva WHERE idreserva=$idreserva";
    $result_mini_query = queryByAssoc($mini_query);
    $acumulator = $acumulator + ($result_mini_query['monto'] * $valor_comision);
  }

  $tiny_query2 = "SELECT * FROM valor_negocio WHERE valor_nombre='precioPremium'";
  $result_tiny_query2 = queryByAssoc($tiny_query2);
  $big_query = "SELECT COUNT(*) AS total FROM permiso_usuario WHERE idpermiso=3 AND '$inicio' < fecha ";
  $result_big_query = queryByAssoc($big_query);
  $total_premium = ($result_tiny_query2['valor'] * $result_big_query['total']);
  $acumulator = $acumulator + $total_premium;


  ?>
  <!-- NAVBAR -->
  <?php require_once "navbar.php" ?>
  <!-- CONTENT -->
  <div class="container-fluid inner-body">
    <!-- MAIN -->
    <main class="row">
      <div class="col-md-12 content-wrapper">
        <div class="row main-content">
          <h2>Listar Ganancias</h2>
          <div class="col-md-6 col-md-offset-3">
            <table class="table table-bordered " class="container">
              <thead>
                <tr>
                  <th>Couch</th>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th>Monto recaudado</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($result as $value) {
                  echo '<tr>';
                    $idreserva= $value['idreserva'];
                    $mini_query = "SELECT * FROM reserva WHERE idreserva=$idreserva";
                    $result_mini_query = queryByAssoc($mini_query);

                    $aux = ($result_mini_query['monto'] * $valor_comision);
                    $idcouch= $result_mini_query['idcouch'];
                    $aux_query = "SELECT * from couch WHERE idcouch=$idcouch";
                    $result_aux_query= queryByAssoc($aux_query);
                    echo '<td>'.$result_aux_query['titulo'].'</td>';
                    echo '<td>'.$result_mini_query['inicio'].'</td>';
                    echo '<td>'.$result_mini_query['fin'].'</td>';
                    echo '<td>'.$aux.'</td>';

                  echo '</tr>';
                }
                ?>
                </tbody>

              </table>

              <table class="table table-bordered " class="container">
                <thead>
                  <tr>
                    <th>Usuarios registrados como premium durante el periodo</th>
                    <th>Monto recaudado</th>


                  </tr>
                </thead>
                <tbody>
                  <?php

                    echo '<tr>';
                    echo '<td>'.$result_big_query['total'].'</td>';
                    echo '<td>'.$total_premium.'</td>';


                    echo '</tr>';

                  ?>
                  </tbody>

                </table>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="currentPrice">Total ganado: </label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-addon">$</div>
                        <input type="text" disabled value="<?php echo $acumulator?>" name="currentPrice" id="currentPrice" class="form-control" readonly></input>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-8 5">

                    <a class="btn btn-danger" href="listEarnings.php" role="button">Atras</a>
                  </div>
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
