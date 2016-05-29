<!DOCTYPE html>
<?php
require_once 'userSession.php';
?>
<html>
<head>
  <title>CouchInn</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../js/jquery.js"></script>
  <script src="../js/validator.js"></script>
  <script src="../js/validar.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
      <!-- LOGO -->
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">
          <img id="logo-navbar" src="../images/resources/CouchInnLogoFull.png" />
        </a>
      </div>
      <!-- ITEMS -->
      <div class="navbar-items">
        <ul class="nav navbar-nav">
          <li><a href="#">OPCION 1</a></li>
          <li><a href="#">OPCION 2</a></li>
          <li><a href="#">OPCION 3</a></li>
          <li><a href="#">OPCION 4</a></li>
          <li><a href="#">OPCION 5</a></li>
        </ul>
      </div>
      <!-- USER -->
      <div class="navbar-user navbar-right">
        <?php
        $_SESSION['user'] -> isLogged() ?
        require_once 'navbarSessionManagerLogged.php' :
        require_once 'navbarSessionManagerNotLogged.php' ;
        ?>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <!-- CONTENT -->

    <main class="row">
      <div class="page-header">
  <h1>Conviertete en usuario premium <small>accede a mas beneficios</small></h1>
</div>

      <div class="span10">
        <form data-toggle="validator" name="pagar"  method="post" data-toggle="validator" role="form" class="form-block">
          <span class="help-block"><p>El pago premium de CouchInn tiene un coste de $200 ARS y se realiza una sola vez. Si eres usuario premium tendrás acceso a muchas más ventajas como: <p>• Podrás agregar más de una imagen a tu Couch.</p> <p> • Tu Couch aparecera entre los principales. </p> <p> • Mayor posibilidad de que te acepten una reserva por tu condicion. <p> • Y muchas mas! </p> </p></p></span>
        </br>
        <p> <input type="radio" name="card" id="1" checked > <img src="http://i.imgur.com/DZXCch1.png" alt="" />
          <input type="radio" name="card" id="2" > <img src="http://i.imgur.com/VnMJQ8k.png" alt="" />
          <input type="radio" name="card" id="3" > <img src="http://i.imgur.com/4Woa1vJ.png" alt="" /> </p>
          <div class="form-group">
            <label for="name" class="control-label">Nombre: </label>

            <input type="text" class="form-control "  maxlength="20" name="names" placeholder="Nombre" id="name" data-error="Debe ingresar un nombre" style="width: 300px;" required>
            <div class="help-block with-errors">
            </div>
          </div>
          <div class="form-group">
            <label for="card" class="control-label">Numero de tarjeta: </label>
            <input type="text" class="form-control" maxlength="19" name="num" placeholder="xxxx-xxxx-xxxx-xxxx" id="card" data-error="Debe ingresar un numero de tarjeta" style="width: 300px;" required>
            <div class="help-block with-errors">
            </div>
          </div>
          <div class="form-group">
            <label for="pass" class="control-label">Codigo de seguridad: </label>
            <input type="password" class="form-control" size="3" maxlength="3" data-minlength="3" name="pass" placeholder="***" id="pass" data-error="El cod. de seguridad debe tener 3 numeros" style="width: 300px;" required>
            <div class="help-block with-errors">
            </div>
          </div>
          <div class="form-group">
            <label for="date" class="control-label">Fecha de vencimiento: </label>
            <select name="month" class="btn btn-sm btn-primary" >
              <option>01</option> <option>02</option> <option>03</option> <option>04</option>
              <option>05</option> <option>06</option> <option>07</option> <option>08</option>
              <option>09</option> <option>10</option> <option>11</option> <option>12</option>
            </select>
            <select name="year" class="btn btn-sm btn-primary" >
              <option selected>2016</option> <option>2017</option> <option>2018</option>
              <option>2019</option> <option>2020</option> </select>
          </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" id="terms" data-error="Debe estar seguro de pagar!" required>
                Acepto los terminos y condiciones de "CouchInn"
              </label>
              <div class="help-block with-errors">
              </div>
            </div>

            <div class="alert alert-info form-group " style="width: 500px;">
              Si tienes alguna duda puedes leer el <a href="#" class="alert-link">acuerdo legal</a> del sitio
            </div>

            <button type="submit" class="btn btn-sm btn-primary" onclick="validar">Pagar</button> <button type="reset" class="btn btn-sm btn-primary">Borrar</button>
          </form>


        </div>
      </main>

      <!-- FOOTER -->
      <footer class="row footer">
        <p>Soy el footer</P>
        </footer>
      </div>
    </body>
    </html>
