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
  <title>Solicitudes Aceptadas</title>
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
  $inicio=$_POST['from'];
  $fin=$_POST['to'];
  $query = "SELECT * FROM reserva WHERE '$inicio' < fin AND '$fin' > inicio";
  $result = queryAllByAssoc($query);

  ?>
  <!-- NAVBAR -->
  <?php require_once "navbar.php" ?>
  <!-- CONTENT -->
  <div class="container-fluid inner-body">
    <!-- MAIN -->
    <main class="row">
      <div class="col-md-12 content-wrapper">
        <div class="row main-content">
          <h2>Solicitudes Aceptadas:</h2>
          <div class="col-md-6 col-md-offset-2">
            <table class="table table-bordered table-condensed" class="container">
              <thead>
                <tr>
                  <th>Couch</th>
                  <th>Dueño del Couch</th>
                  <th>Usuario que se hospedo</th>
                  <th>Fecha cuando fue aceptada</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($result as $value) {
                  echo '<tr>';
                  $idreserva=$value['idreserva'];
                  $idcouch=$value['idcouch'];
                  $idusuario=$value['idusuario'];
                  $query2 = "SELECT * FROM estado WHERE idreserva=$idreserva AND nombre='Confirmado'";
                  $result2= queryByAssoc($query2);
                  if ($result2['nombre'] == 'Confirmado') {
                    $query3 = "SELECT titulo, idusuario FROM couch WHERE idcouch=$idcouch";
                    $result3 = queryByAssoc($query3);
                    $idusuarioDueño=$result3['idusuario'];
                    $query4 = "SELECT * FROM usuario WHERE idusuario=$idusuarioDueño";
                    $result4 = queryByAssoc($query4);
                    $query5 = "SELECT * FROM usuario WHERE idusuario=$idusuario";
                    $result5= queryByAssoc($query5);


                    echo '<td>'.$result3['titulo'].'</td>';
                    echo '<td>'.$result4['nombre'].'</td>';
                    echo '<td>'.$result5['nombre'].'</td>';
                    echo '<td>'.$result2['fecha'].'</td>';
                  }

                echo '</tr>';
                }
                ?>
                </tbody>

              </table>
              <div class="row">
                <div class="col-sm-8 5">

                  <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
                </div>
              </div>  
            </div>
          </div>
        </div>
      </main>
      <!-- FOOTER -->
      <?php require_once 'footer.php' ?>
    </div>
  </html>
