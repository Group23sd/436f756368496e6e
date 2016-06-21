<!DOCTYPE html>
<?php
require_once 'userSession.php';
require_once 'database.php';
?>

<html>
<head>
  <title>CouchInn</title>
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
  <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      dateFormat: "yy-mm-dd",
      dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
      dayNamesMin: [ "D", "L", "M", "X", "J", "V", "S" ],
      monthNamesShort: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      dateFormat: "yy-mm-dd",
      dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
      dayNamesMin: [ "D", "L", "M", "X", "J", "V", "S" ],
      monthNamesShort: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
  <?php
  $idCouch = $_GET['idcouch'];
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

          <div class="col-md-6">
            <h3><strong>Hacer reserva:</strong></h3>
            <h4>Selecciona cuándo quieres hospedarte:</h4>
            <form name="RESERVAS"  method="post" role="form" class="form-block" action="makeReserva.php" data-toggle="validator" >
              <p><label for="from">Fecha de inicio:</label>
                <input type="text" id="from" name="from" class="form-control" readonly required></p>
                <p><label for="to">Fecha de fin:</label>
                  <input type="text" id="to" name="to" class="form-control" readonly required></p>
                  <input type="hidden"  value="<?php echo $idCouch ?>" id="aux" name="aux" class="form-control" required>
                  <button type="submit" class="btn btn-sm btn-success ">Reservar</button>
                  <a class="btn btn-sm btn-success " href="index.php" role="button">Cancelar</a>
                </form>
              </div>
            </div>
          </div>
        </main>
        <!-- FOOTER -->
        <?php require_once 'footer.php' ?>
      </div>
    </body>
    </html>
