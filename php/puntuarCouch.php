<!DOCTYPE HTML>
<?php

  require_once 'userSession.php';
  require_once 'feedback.php';

  /*if(isset($_GET['id'])){
    $idcouch = $_GET['id'];
    require_once 'database.php';

    $sql  = "SELECT * FROM couch WHERE idcouch = '$idcouch'";
    $result = queryByAssoc($sql);
  }
  else{
    genericError();
  }*/
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <script src="../js/validator.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/ajax.js"></script>
    <script src="../js/bootstrap-filestyle.min.js"></script>
  </head>

  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- LOGO -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">
                    <img id="logo-navbar" src="../images/resources/CouchInnLogoFull.png" />
                </a>
            </div>
        </div>
    </nav>
    <!-- CONTENT -->
    <div class="container-fluid inner-body">
        <!-- MAIN -->
        <main class="row">
            <div class="col-md-10 content-wrapper">
                <div class="row main-content">
                  <div class="col-md-10">
                    <h1>Puntuar Couch<small>  Su opinión es muy importante para nosotros</small></h1>
                    <br />
                    <h5> Que le pareció el servicio del dueño , el estado del Couch, el precio, etc?</h5>
                    <form class="form-block" enctype="multipart/form-data" role="form" data-toggle="validator" action="sumarPuntosAlCouch.php" method="post" name="puntosACouch" id="puntosACouch">

                      <input type="hidden" name="idcouch" id="idcouch" <?php echo 'value='.$idcouch ?> class="form-control" required> </input>
                      <div class="form-group has-feedback" class="col-sm-5">
                      <!--  <img src="../images/resources/estrella.png" id="estrellaPuntos"/> -->
                        <input type="number" min="1" max="5" step="1" class="form-control" id="puntosDelCouch" name="puntosDelCouch" placeholder="" required>  </input>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      </div>

                      <button type="submit" class="btn btn-success">Aceptar</button>
                      <a class="btn btn-success" href="index.php" role="button">Cancelar</a>

                    </form>
                  </div>
                </div>
            </div>
        </main>
    </div>

  </body>
</html>
