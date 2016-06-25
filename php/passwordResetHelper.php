<!DOCTYPE html>
<?php
    require_once 'userSession.php';
 ?>
<html>
<head>
    <title>Password Reset</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <script src="../js/validator.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/ajax.js"></script>
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
    <div class="container-fluid content-wrapper">
        <!-- MAIN -->
        <main class="row">
            <div class="col-md-12 content-wrapper">
                <div class="row main-content">
                    <div class="feedback-container">
                        <div class="jumbotron">
                          <h1>Olvide mi password!</h1>
                          <p>CouchInn no guarda ni conoce tu password.</p><br/>
                          <p>Te enviaremos un email para que puedas cambiarla.</p><br/>
                          <form role="form" data-toggle="validator" action="passwordResetEmail.php" method="post" name="passwordResetForm" id="passwordResetForm">
                              <div class="form-group has-feedback">
                                  <label for="userEmail">Email con el que estás tratando de acceder</label>
                                  <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="Email" data-error="Ingrese un email valido!" required>
                                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                  <div class="help-block with-errors"></div>
                              </div>
                              <button type="submit" class="btn btn-sm btn-success">Enviar email</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- FOOTER -->
        <?php require_once 'footer.php' ?>
    </div>
</body>
</html>
