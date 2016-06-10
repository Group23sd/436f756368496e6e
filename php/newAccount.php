<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';
 ?>
<html>
<head>
    <title>New Account</title>
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
                    <div class="col-md-6">
                        <h1>Perfil de usuario</h1>
                        <form class="form-block" role="form" data-toggle="validator" action="signup.php" method="post" name="signupForm" id="signupForm">
                            <div class="form-group has-feedback">
                                <label for="userFirstName">Nombre</label>
                                <input type="text" pattern="^[A-z\s]+$" class="form-control" name="userFirstName" id="userFirstName" placeholder="Nombre" data-error="Ingrese un nombre!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="userLastName">Apellido</label>
                                <input type="text" pattern="^[A-z\s]+$" class="form-control" name="userLastName" id="userLastName" placeholder="Apellido" data-error="Ingrese un apellido!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="userEmail">Email</label>
                                <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="Email" data-error="Ingrese un email valido!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="userPassword">Pasword</label>
                                <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" data-error="Ingrese un password valido!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="userPassword">Confirmar password</label>
                                <input type="password" class="form-control" data-match="#userPassword" name="userPasswordConfirm" id="userPasswordConfirm" placeholder="Confirmar Password" data-error="El password no coincide!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="userCountry">Pais</label>
                                <select class="form-control" name="userCountry" id="userCountry" data-error="Seleccione un pais!" required onchange="showCities()">
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
                                <label for="userCity">Ciudad</label>
                                <select class="form-control" name="userCity" id="userCity" data-error="Seleccione una ciudad!" required>
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
        <!-- FOOTER -->
        <?php require_once 'footer.php' ?>
    </div>
</body>
</html>
