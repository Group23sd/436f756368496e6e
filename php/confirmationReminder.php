<!DOCTYPE html>
<?php
    require_once 'userSession.php';
 ?>
<html>
<head>
    <title>Confirmation Reminder</title>
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
                          <h1>Usuario no confirmado!</h1>
                          <p>No hemos recibido la confirmación de tu cuenta!</p><br/>
                          <p>Dirigete al enlace que aparece en el email de verificación que enviamos a tu cuenta.</p><br/>
                          <p>Si no encuentras el email, puedes reenviarlo haciendo click aquí abajo.</p>
                          <p><a class="btn btn-success btn-lg" href="accountConfirmationEmail.php?rs=1" role="button">Reenviar Email</a></p>
                        </div>
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
