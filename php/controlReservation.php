<!DOCTYPE html>
<?php
require_once 'userSession.php';
require_once 'database.php';
?>

<html>
<head>
  <title>CouchInn - Hacer reserva</title>
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
</head>
<body>
  <!-- NAVBAR -->
  <?php require_once "navbar.php" ?>
  <!-- CONTENT -->
  <div class="container-fluid inner-body">
    <!-- MAIN -->
    <main class="row">
      <div class="col-md-12 content-wrapper">
        <span class="anchor" id="mainContent"></span>
        <div class="row main-content">

          <div class="col-md-6">
            <h2><strong>Reserva para:</strong></h2>

              <h3><strong>Fecha de inicio:</strong></h3>
              <h3><strong>Fecha de fin:</strong></h3>
              <h3><strong>Cantidad de huspedes:</strong></h3>
              <a class="btn btn-sm btn-success " href="index.php" role="button">Aceptar</a>
              <a class="btn btn-sm btn-danger" href="index.php" role="button">Rechazar</a>

          </div>
        </div>
      </div>
    </main>
    <!-- FOOTER -->
    <?php require_once 'footer.php' ?>
  </div>
</body>
</html>
