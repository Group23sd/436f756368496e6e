<!DOCTYPE HTML>
<?php
  require_once 'database.php';
  require_once 'userSession.php';
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
                  <div class="col-md-6">
                    <h1>Registrar un nuevo Couch</h1>
                      <form class="form-block" enctype="multipart/form-data" role="form" data-toggle="validator" action="altaCouch.php" method="post" name="cargarNuevoCouch" id="cargarNuevoCouch">
                        <div class="form-group has-feedback">
                            <label for="tituloDelCouch">Titulo</label>
                            <input type="text" pattern="^[A-z\s]+$" class="form-control" name="tituloDelCouch" id="tituloDelCouch" placeholder="Ingrese un titulo de sea representativo que su couch" data-error="Ingrese un titulo valido!" required></input>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group has-feedback">
                          <label for="precioDelCouch">Precio</label>
                          <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="number" step="any" class="form-control" id="precioDelCouch" name="precioDelCouch" placeholder="Ingrese el precio de alquiler" data-error="Ingrese un valor valido!" required></input>
                        <!--    <div class="input-group-addon">.00</div>  -->
                          </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="capacidadDelCouch">Capacidad</label><br />
                        <select name="capacidadDelCouch" id="capacidadDelCouch" class="form-control">
                          <option selected>01</option> <option>02</option> <option>03</option> <option>04</option>
                          <option>05</option> <option>06</option> <option>07</option> <option>08</option>
                          <option>09</option> <option>10</option> <option>10+</option>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="descripcionDelCouch">Descripcion</label>
                        <textarea class="form-control" pattern="^[A-z\s]+$" rows="8" name="descripcionDelCouch" id="descripcionDelCouch"></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <?php
                        $sql = "SELECT * FROM tipo";
                        $result = queryAllByAssoc($sql);
                      ?>

                      <div class="form-group has-feedback">
                        <label for="tipoDeCouch">Tipo</label>
                        <select name="tipoDeCouch" id= "tipoDeCouch" class="form-control">
                          <?php
                            foreach ($result as $tipo) {
                              $desT = $tipo['descripcion'];
                              echo '<option>'.$desT.'</option>';
                            }
                          ?>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <?php
                        $sql="SELECT * FROM caracteristica";
                        $result= queryAllByAssoc($sql);
                      ?>

                      <div class="form-group has-feedback">
                        <?php
                          echo '<label for="descripcionDelCouch">Caracteristicas</label>';
                          foreach ($result as $caract) {
                            $cD=$caract['descripcion'];
                            $idC = $caract['idcaracteristica'];
                            echo '<div id="caracteristicabox" class="checkbox">';
                              echo '<input type=checkbox value='.$cD.' name='.$idC.'>'.$cD.'</input>';
                              echo '<br />';
                            echo '</div>';
                          }
                        ?>
                      </div>

                      <div class="form-group has-feedback">
                          <label for="formCountry">Pais</label>
                          <select class="form-control" name="formCountry" id="formCountry" data-error="Seleccione un pais!" required onchange="showCities()">
                              <option hidden>Pais</option>
                              <option selected hidden value>Pais</option>
                              <?php
                                  $query = "SELECT p.idpais, p.nombre FROM pais p";
                                  $result = queryAllByAssoc($query);
                                  foreach ($result as $row) {
                                      echo "<option value=".$row['idpais'].">".$row['nombre']."</option>";
                                  }
                              ?>
                          </select>
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group has-feedback">
                          <label for="formCity">Ciudad</label>
                          <select class="form-control" name="formCity" id="formCity" data-error="Seleccione una ciudad!" required>
                              <option hidden>Ciudad</option>
                              <option selected hidden value>Ciudad</option>
                          </select>
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="fotosDelCouch">Fotos</label>
                        <span class="help-block">Por favor ingrese imagenes con formato .jpg para una mejor visualizacion.</span>

                        <?php


                          if(($_SESSION['user'] -> isPremium()) || ($_SESSION['user'] -> isAdmin())){
                            echo '<span class="help-block">IMPORTANTE: Se tomara la primera foto que ingrese como portada de este Couch.</span>';
                            echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto1Couch" id="foto1Couch"> </input>';
                            echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto2Couch" id="foto2Couch"> </input>';
                            echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto3Couch" id="foto3Couch"> </input>';
                            echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto4Couch" id="foto4Couch"> </input>';
                            echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto5Couch" id="foto5Couch"> </input>';
                            echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto6Couch" id="foto6Couch"> </input>';
                          }
                          elseif($_SESSION['user'] -> isStandard()){
                            echo '<input type="file" disabled accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto1Couch" id="foto1Couch"> </input>';
                            echo '<input type="file" disabled accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto2Couch" id="foto2Couch"> </input>';
                            echo '<input type="file" disabled accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto3Couch" id="foto3Couch"> </input>';
                            echo '<input type="file" disabled accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto4Couch" id="foto4Couch"> </input>';
                            echo '<input type="file" disabled accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto5Couch" id="foto5Couch"> </input>';
                            echo '<input type="file" disabled accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto6Couch" id="foto6Couch"> </input>';
                            echo "<br />";
                            echo '<div class="alert alert-info">';
                              echo 'Si quieres agregar mas fotos de tu Couch debes ser <a href="premium.php" class="alert-link">usuario premium.</a>';
                              echo '</div>';
                          }

                        ?>
                        
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
