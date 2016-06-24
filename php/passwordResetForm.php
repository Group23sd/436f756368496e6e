<?php

    require_once 'userSession.php';
    require_once 'feedback.php';

    if ( (isset($_GET['id'])) && (isset($_GET['idcode'])) && (isset($_GET['account'])) && (isset($_GET['accountcode'])) && (!$_SESSION['user']->islogged()) ) {
        $id = $_GET['id'];
        $hashedId = $_GET['idcode'];
        $email = $_GET['account'];
        $hashedEmail = $_GET['accountcode'];
        $idChecked = password_verify($id."g23sd",$hashedId);
        $emailChecked = password_verify($email."g23sd",$hashedEmail);
        if ($idChecked && $emailChecked) {
            ?>
            <!DOCTYPE html>
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
                <div class="container-fluid inner-body">
                    <!-- MAIN -->
                    <main class="row">
                        <div class="col-md-12 content-wrapper">
                            <div class="row main-content">
                                <div class="feedback-container">
                                    <div class="jumbotron">
                                      <h1>Cambia tu password!</h1>
                                      <p>Ingresa tu nuevo password.</p><br/>
                                      <form role="form" data-toggle="validator" action="passwordReset.php" method="post" name="passwordResetForm" id="passwordResetForm">
                                          <div class="form-group">
                                              <input type="hidden" class="form-control" name="userId" id="userId" value=<?php echo "$id" ?>></input>
                                          </div>
                                          <div class="form-group">
                                              <label for="userEmail">Email</label>
                                              <input type="email" class="form-control" name="userEmail" id="userEmail" readonly value=<?php echo "$email" ?>></input>
                                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                          <div class="form-group has-feedback">
                                              <label for="userPassword">Nuevo pasword</label>
                                              <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" data-error="Ingrese un password valido!" required></input>
                                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                          <div class="form-group has-feedback">
                                              <label for="userPassword">Confirmar password</label>
                                              <input type="password" class="form-control" data-match="#userPassword" name="userPasswordConfirm" id="userPasswordConfirm" placeholder="Confirmar" data-error="El password no coincide!" required></input>
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
            <?php
        } else {
            wrongPasswordResetCredentials();
        }
    } else {
        echo "<script type='text/javascript'>window.location='index.php'</script>";
    }

?>
