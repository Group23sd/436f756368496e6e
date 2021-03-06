<!DOCTYPE html>
<?php
require_once 'userSession.php';
require_once 'database.php';
$c = connectDatabase();
if ( ! $_SESSION['user'] -> isAdmin() ) {
  header("Location: index.php");

}
?>

<script>

function modificar(id) {
  window.location = 'modificar_tCouch.php?e='.concat(id);

}







</script>
<html>
<head>
  <title>CouchInn - Listado de tipo de Couch</title>
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
  <?php
  $query = "SELECT * FROM tipo";
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
          <div class="col-md-12">
            <table class="table table-bordered" class="container">
              <thead>
                <tr>

                  <th>Nombre</th>
                  <th>Borrar</th>
                  <th>Modificar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($result as $value) {
                  echo '<tr>';
                  echo '<td>'.$value["descripcion"].'</td>';
                  echo "<td><a class='btn btn-sm btn-danger ' onclick='return confirm(\"¿Esta seguro que desea borrar este Couch?\")' href='borrar_tCouch.php?e=".$value["idtipo"]."' role='button'>BORRAR</a></td>";
                  echo '<td>'.'<a onclick="return modificar('.$value["idtipo"].')"  role="button" class="btn btn-sm btn-success">MODIFICAR</a>'.'</td>';
                  echo '</tr>';
                }

                ?>

              </tbody>

            </table>

            <a href="altaTipoCouch.php" role="button" class="btn btn-sm btn-success">NUEVO TIPO DE COUCH</a>
          </div>

        </div>
      </div>
    </main>
    <!-- FOOTER -->
    <footer class="row footer">
      <p>Soy el footer</P>
      </footer>
    </div>
  </body>
  </html>
