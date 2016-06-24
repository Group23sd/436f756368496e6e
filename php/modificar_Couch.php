<!DOCTYPE HTML>
<?php

  require_once 'userSession.php';
  require_once 'feedback.php';

  //if(isset($_GET['idcouch'])){
  //  $idcouch = $_GET['idcouch'];
    require_once 'database.php';

    $idcouch = 21;
    $sql  = "SELECT * FROM couch WHERE idcouch = '$idcouch'";
    $result = queryByAssoc($sql);
  //}
/*  else{
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
                  <div class="col-md-6">
                    <h1>Registrar un nuevo Couch</h1>
                      <form class="form-block" enctype="multipart/form-data" role="form" data-toggle="validator" action="modificarDatosCouch.php" method="post" name="modificarInfoCouch" id="modificarInfoCouch">
                        <input type="hidden" name="idcouch" id="idcouch" <?php echo 'value='.$idcouch ?> class="form-control" required> </input>

                        <div class="form-group has-feedback">
                            <label for="tituloDelCouch">Titulo</label>
                            <input type="text" <?php echo 'value='.$result['titulo'] ?> pattern="^[A-z\s]+$" class="form-control" name="tituloDelCouch" id="tituloDelCouch" placeholder="Ingrese un titulo de sea representativo que su couch" data-error="Ingrese un titulo! valido" required></input>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group has-feedback">
                          <label for="precioDelCouch">Precio</label>
                          <div class="input-group">
                            <div class="input-group-addon">$</div>

                            <input type="number" step="any" <?php echo 'value='.$result['precio'] ?> class="form-control" id="precioDelCouch" name="precioDelCouch" placeholder="Ingrese el precio de alquiler" data-error="Ingrese un valor valido" required>  </input>
                        <!--    <div class="input-group-addon">.00</div>  -->
                          </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="capacidadDelCouch">Capacidad</label><br />
                        <select name="capacidadDelCouch" class="form-control">
                          <<?php
                            $cap = $result['capacidad'];
                            for ($i=1; $i <12 ; $i++) {
                              if($i ==  11){
                                $number = "10+";
                              }else{
                                $number = "0" . $i;
                              }

                              if($i == $cap){
                                echo "<option selected>".$number."</option>";
                              }
                              else{
                                echo "<option>".$number."</option>";
                              }
                            }

                          ?>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="descripcionDelCouch">Descripcion</label>
                        <textarea class="form-control" rows="8" name="descripcionDelCouch"><?php echo $result['descripcion'] ?></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <?php
                        $sql = "SELECT * FROM tipo";
                        $tipos = queryAllByAssoc($sql);
                      ?>

                      <div class="form-group has-feedback">
                        <label for="tipoDeCouch">Tipo</label>
                        <select name="tipoDeCouch" class="form-control">
                          <?php
                            $idTipoCouch = $result['idtipo'];
                            foreach ($tipos as $tipo) {
                              $desT = $tipo['descripcion'];
                              $idTipo = $tipo['id'];
                              if($idTipo == $idTipoCouch){
                                echo '<option selected>'.$desT.'</option>';
                              }
                              else{
                                echo '<option>'.$desT.'</option>';
                              }

                            }
                          ?>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>

                      <?php
                        $sql="SELECT * FROM caracteristica";
                        $caracteristicas= queryAllByAssoc($sql);

                        $sql = "SELECT * FROM caracteristica_couch WHERE idcouch = '$idcouch'";
                        $caracteristicasDelCouch = queryAllByAssoc($sql);
                      ?>

                      <div class="form-group has-feedback">
                        <?php
                          echo '<label for="descripcionDelCouch">Caracteristicas</label>';
                          foreach ($caracteristicas as $caract) {
                            $cD=$caract['descripcion'];
                            $cId = $caract['idcaracteristica'];

                            $check = false;
                            foreach ($caracteristicasDelCouch as $caractCouch) {
                              if(in_array($cId,$caractCouch)){
                                $check = true;
                              }
                            }

                            if($check){
                              echo '<div id="caracteristicabox" class="checkbox">';
                                echo '<input type=checkbox checked value='.$cD.' name='.$cId.'>'.$cD.'</input>';
                                echo "<br />";
                              echo '</div>';
                            }
                            else{
                              echo '<div id="caracteristicabox" class="checkbox">';
                                echo '<input type=checkbox value='.$cD.' name='.$cId.'>'.$cD.'</input>';
                                echo '<br />';
                              echo '</div>';
                            }
                          }
                        ?>
                      </div>

                      <div class="form-group has-feedback">
                          <label for="formCountry">Pais</label>
                          <select class="form-control" name="formCountry" id="formCountry" data-error="Seleccione un pais!" required onchange="showCities()">
                              <option hidden></option>
                              <?php
                                  $idciudad = $result['idciudad'];
                                  $sql = "SELECT idpais FROM ciudad c WHERE c.idciudad = $idciudad";
                                  $resultpais = queryByAssoc($sql);
                                  $idpaisr = $resultpais['idpais'];
                                  $query = "SELECT p.idpais, p.nombre FROM pais p";
                                  $result = queryAllByAssoc($query);
                                  foreach ($result as $row) {
                                      $sel = ' ';
                                      if ($row['idpais'] == $idpaisr) {
                                          $sel = 'selected';
                                      }
                                      echo "<option ".$sel." value=".$row['idpais'].">".$row['nombre']."</option>";
                                  }
                              ?>
                          </select>
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group has-feedback">
                          <label for="formCity">Ciudad</label>
                          <select class="form-control" name="formCity" id="formCity" data-error="Seleccione una ciudad!" required>

                              <?php
                                  $query = "SELECT c.idciudad, c.nombre, c.region FROM ciudad c WHERE c.idciudad = $idciudad";
                                  $row = queryByAssoc($query);
                                  echo "<option selecter value=".$row['idciudad'].">".$row['nombre'].", ".$row['region']."</option>";
                              ?>
                              </select>
                          </select>
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="fotosDelCouch">Fotos</label>
                        <span class="help-block">Por favor ingrese imagenes con formato .jpg para una mejor visualizacion.</span>

                  <!--      <div class='container'>
                          <div class="row">
                            '<div class="col-md-5">'  -->

                              <?php
                                $sql = "SELECT * FROM  foto WHERE idcouch = $idcouch";
                                $fotosCouch = queryAllByAssoc($sql);
                                $cantFotos = count($fotosCouch);
                                if(!empty($fotosCouch)){

                                  foreach ($fotosCouch as $foto) {
                                      $pathFoto = $foto['path'];
                                      $pathFoto = "'" . $pathFoto ."'";
                                      $idFoto = $foto['idfoto'];

                                      echo '<a href=# class=thumbnail> <img src=' .$pathFoto. 'alt=IMAGEN DEL COUCH /> </a>';
                                      echo '<input type=file accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Cambiar foto" id='.$idFoto.' name='.$idFoto. '> </input>';
                                      echo '<br />';

                                  }
                                  if(($_SESSION['user'] -> isPremium()) || ($_SESSION['user'] -> isAdmin())){
                                    if($cantFotos == 6) {$disponibles = 0;}
                                    elseif($cantFotos == 5) { $disponibles = 1;}
                                    elseif($cantFotos == 4) { $disponibles = 2;}
                                    elseif($cantFotos == 3) { $disponibles = 3;}
                                    elseif($cantFotos == 2) { $disponibles = 4;}
                                    elseif($cantFotos == 1) { $disponibles = 5;}
                                    else {$disponibles = 6; }

                                    if($disponibles != 0){
                                      for($i = $disponibles; $i > 0; $i--){
                                        $idF = "foto".$i."Couch";
                                        echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" id='.$idF. ' name='.$idF. '> </input>';
                                      }
                                    }
                                  }

                                }
                                else{
                                    if(($_SESSION['user'] -> isPremium()) || ($_SESSION['user'] -> isAdmin())){
                                      echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto1Couch" id="foto1Couch"> </input>';
                                      echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto2Couch" id="foto2Couch"> </input>';
                                      echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto3Couch" id="foto3Couch"> </input>';
                                      echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto4Couch" id="foto4Couch"> </input>';
                                      echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto5Couch" id="foto5Couch"> </input>';
                                      echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto6Couch" id="foto6Couch"> </input>';
                                    }
                                    elseif($_SESSION['user'] -> isStandard()){
                                      echo '<input type="file" accept="image/jpg" class="form-control filestyle" data-buttonBefore="true" data-placeholder="Sin imagen" data-buttonText="Agregar nueva foto" name="foto1Couch" id="foto1Couch"> </input>';
                                    }

                                }

                              ?>

                    <!--        </div>
                          </div>
                        </div> -->

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
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
