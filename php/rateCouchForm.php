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
  <?php
  $idReserva = $_GET['id'];
  $query = "SELECT idcouch FROM reserva WHERE idreserva=$idReserva";
  $result = queryByAssoc($query);
  $idCouch = $result['idcouch'];
  $query2 = "SELECT * FROM couch WHERE idcouch=$idCouch";
  $result2 = queryByAssoc($query2);
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
            <h3>Puntuar al Couch: <?php echo "<a class='stdLink'href='detallesCouch.php?idcouch=".$result2['idcouch']."'><strong>".$result2['titulo']."</strong></a>"?> <strong></strong></h3>
            <h5>Selecciona un puntaje y deja un comentario si quieres:</h5>

            <form name="puntajeUser"  method="post" role="form" class="form-block" action="rateCouch.php?idReserva=<?php echo $idReserva ?>">
              <p>
                <strong>Puntúa al Couch:</strong>
                <span class="starRating">
                  <input id="rating5" type="radio" name="rating" value="5">
                  <label for="rating5">5</label>
                  <input id="rating4" type="radio" name="rating" value="4">
                  <label for="rating4">4</label>
                  <input id="rating3" type="radio" name="rating" value="3" >
                  <label for="rating3">3</label>
                  <input id="rating2" type="radio" name="rating" value="2">
                  <label for="rating2">2</label>
                  <input id="rating1" type="radio" name="rating" value="1" checked>
                  <label for="rating1">1</label>
                </span>
              </p>
              <div class="form-group has-feedback">
                <label for="comentario">Deja un comentario:</label>
                <textarea class="form-control" rows="3" name="comentario" id="comentario"></textarea>
              </div>
              <button type="submit" class="btn btn-xm btn-success ">Puntuar</button>

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
