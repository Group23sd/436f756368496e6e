<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';

    $c = connectDatabase();

    if ( ! $_SESSION['user'] -> isStandard() ) {
      header("Location: index.php");
    }

    $sql = "SELECT vn.valor FROM valor_negocio vn WHERE vn.valor_nombre = 'precioPremium'";
    $precioPremium = queryByAssoc($sql)['valor'];
?>
<html>
<head>
  <title>CouchInn - Convertirse en premium</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../js/jquery.js"></script>
  <script src="/js/validator.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <!-- NAVBAR -->
  <?php require_once "navbar.php" ?>
  <!-- CONTENT -->
  <div class="container-fluid inner-body">
    <!-- MAIN -->
    <main class="row">
      <div class="col-md-12 content-wrapper">
        <div class="row main-content">
          <div class="page-header">
            <h1>Conviertete en usuario premium<small> accede a mas beneficios</small></h1>
          </div>
          <p>El pago premium de CouchInn tiene un coste de <strong>$<?php echo $precioPremium ?></strong> y se realiza una sola vez. Si eres usuario premium tendrás acceso a muchas más ventajas como: <p>• Podrás agregar más de una imagen a tu Couch.</p> <p> • Tu Couch aparecera entre los principales. </p> <p> • Mayor posibilidad de que te acepten una reserva por tu condicion. <p> • Y muchas mas! </p> </p></p>
          <div class="col-md-5">
          <form data-toggle="validator" name="pagar"  method="post" onsubmit="return validar()" action="setPremium.php" role="form" class="form-block" >

            <p> <input type="radio" name="card" id="2" checked> <img src="http://i.imgur.com/VnMJQ8k.png" alt="" class="img-rounded" /> </p>
            <div class="form-group has-feedback">
              <label for="name" class="control-label">Nombre: </label>
              <input type="text" class="form-control" maxlength="20" pattern="^[A-z\s]+$" name="names" placeholder="Nombre" id="name" data-error-pattern="askdsadsa"   required>
              <span class="glyphicon form-control-feedback " aria-hidden="true"></span>
              <div class="help-block with-errors">El nombre que aparece en la tarjeta</div>
            </div>

            <div class="form-group has-feedback">
              <label for="card" class="control-label">Numero de tarjeta: </label>
              <input type="text" class="form-control" maxlength="19" name="num" pattern="^4\d{3}([\ \-]?)\d{4}\1\d{4}\1\d{4}$"  data-minlength="19"  placeholder="xxxx-xxxx-xxxx-xxxx" id="card"  data-minlength-error="Numero de tarjeta incompleto, faltan numeros (20)"  required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors">El numero de su tarjeta, separado por "-"</div>
            </div>
            <div class="form-group has-feedback">
              <label for="pass" class="control-label">Codigo de seguridad: </label>
              <input type="password" class="form-control" size="3" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="3" name="pass" placeholder="***" id="pass" data-minlength-error="El cod. de seguridad debe tener 3 numeros"   required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors">Codido del reverso de su tarjeta </div>
            </div>
            <div class="form-group">
              <label for="date" class="control-label">Fecha de vencimiento: </label>
              <select name="month" class="btn btn-sm btn-success " id="month">
                <option>01</option> <option>02</option> <option>03</option> <option>04</option>
                <option>05</option> <option>06</option> <option>07</option> <option>08</option>
                <option>09</option> <option>10</option> <option>11</option> <option>12</option>
              </select>
              <select name="year" class="btn btn-sm btn-success " id="year">
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

              <button type="submit" class="btn btn-sm btn-success " >Pagar</button> <button type="reset" class="btn btn-sm btn-success ">Borrar</button>
            </form>
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
