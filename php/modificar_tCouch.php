<!DOCTYPE html>
<?php
require_once 'userSession.php';
require_once 'database.php';
$c = connectDatabase();
if ( ! $_SESSION['user'] -> isAdmin() ) {
  header("Location: index.php");

}

?>
<html>
<head>
  <title>CouchInn - Modificar tipo de hospedaje</title>
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
          <?php
          $id = $_GET['e'];
          $query = "SELECT descripcion FROM tipo WHERE idtipo='$id'";
          $result = queryByAssoc($query);
          $couch = $result["descripcion"];
          ?>
          <div class="col-md-6">
            <h3>Usted va a modificar el Couch: <b><?php echo $couch ?></b></h3>
          <form method="post" class="form-block" data-toggle="validator" role="form" action="m_tCouch.php?idparam=<?php echo $_GET['e'] ?>">
            <div class="form group has-feedback">
              <label for="n_Couch" class="control-label">Modifique el tipo de Couch: </label>
              <input type="text" class="form-control" id="m_Couch" name="m_Couch" placeholder="Modifique Couch" data-error="Debe ingresar un couch" pattern="^[A-z\s]+$" value="<?php echo $couch ?>" required>
              <span class="glyphicon form-control-feedback " aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
            <button type="submit" class="btn btn-sm btn-success " >ENVIAR</button>
            <a role="button" href="listar_tCouch.php" class="btn btn-sm btn-danger " >Atras</a>
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
