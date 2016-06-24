<!DOCTYPE HTML>
<?php
  require_once 'connectdb.php';
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
                  <div class="col-md-6">
                    <h1>Registrar un nuevo Couch</h1>
                      <form class="form-block" role="form" data-toggle="validator" action="altaCouch.php" method="post" name="cargarNuevoCouch" id="cargarNuevoCouch">
                        <div class="form-group has-feedback">
                            <label for="tituloDelCouch">Titulo</label>
                            <input type="text" pattern="^[A-z\s]+$" class="form-control" name="tituloDelCouch" id="tituloDelCouch" placeholder="Ingrese un titulo de sea representativo que su couch" data-error="Ingrese un titulo!" required></input>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group has-feedback">
                          <label for="precioDelCouch">Precio</label>
                          <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="number" class="form-control" id="precioDelCouch" name="precioDelCouch" placeholder="Ingrese el precio de alquiler" data-error="Ingrese un valor entero(sin especificar centavos)" required></input>
                        <!--    <div class="input-group-addon">.00</div>  -->
                          </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="capacidadDelCouch">Capacidad</label><br />
                        <select name="capacidadDelCouch"class="form-control">
                          <option selected>01</option> <option>02</option> <option>03</option> <option>04</option>
                          <option>05</option> <option>06</option> <option>07</option> <option>08</option>
                          <option>09</option> <option>10</option> <option>10+</option>
                        </select>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="descripcionDelCouch">Descripcion</label>
                        <textarea class="form-control" rows="5" name="descripcionDelCouch"></textarea>
                      </div>

                      <?php
                        $sql="SELECT * FROM caracteristica";
                        $result= queryAllByAssoc($sql);
                      ?>

                      <div class="form-group has-feedback">
                        <?php
                          echo '<label for="descripcionDelCouch">Caracteristicas</label>';
                          foreach ($result as $caract) {
                            $c=$caract['descripcion'];
                            echo '<div id="caracteristicabox" class="checkbox">';
                              echo '<input type=checkbox name=' .$c . '>'; echo $c;
                              echo '<br />';
                            echo '</div>';
                          }
                        ?>
                      </div>

                      <div class="form-group has-feedback">
                          <label for="formCountry">Pais</label>
                          <select class="form-control" name="formCountry" id="formCountry" data-error="Seleccione un pais!" required onchange="showCities()">
                              <option hidden>Pais</option>
                              <?php
                                  $query = "SELECT p.idpais, p.nombre FROM pais p";
                                  $result = queryAllByAssoc($query);
                                  foreach ($result as $row) {
                                      echo "<option value=".$row['idpais'].">".$row['nombre']."</option>";
                                  }
                              ?>
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group has-feedback">
                          <label for="formCity">Ciudad</label>
                          <select class="form-control" name="formCity" id="formCity" data-error="Seleccione una ciudad!" required>
                              <option hidden>Ciudad</option>
                          </select>
                          <div class="help-block with-errors"></div>
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
