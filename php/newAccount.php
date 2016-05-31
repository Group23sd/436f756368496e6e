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
    <script type="text/javascript">
        function showCity() {
            var idciudad = document.getElementById('userCountry').value;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("userCity").innerHTML = xmlhttp.responseText;
                }
            }
            var url = "cityOptions.php?id=" + idciudad;
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    </script>
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
        </div>
    </nav>
    <!-- CONTENT -->
    <div class="container-fluid content-wrapper">
        <!-- MAIN -->
        <main class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-block" role="form" data-toggle="validator" action="signup.php" method="post" name="signupForm" id="signupForm">
                    <div class="form-group has-feedback">
                        <label for="userFirstName">Nombre</label>
                        <input type="text" class="form-control" name="userFirstName" id="userFirstName" placeholder="Nombre" data-error="Ingrese un nombre!" required></input>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="userLastName">Apellido</label>
                        <input type="text" class="form-control" name="userLastName" id="userLastName" placeholder="Apellido" data-error="Ingrese un apellido!" required></input>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="Email" data-error="Ingrese email valido!" required></input>
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
                        <label for="userCountry">Pais</label>
                        <select class="form-control" name="userCountry" id="userCountry" data-error="Seleccione un pais!" required onchange="showCity()">
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
                            <?php
                                $query = "SELECT c.idciudad, c.nombre, c.region FROM ciudad c WHERE c.idciudad < 1000";
                                $result = queryAllByAssoc($query);
                                foreach ($result as $row) {
                                    echo "<option value=".$row['idciudad'].">".$row['nombre'].", ".$row['region']."</option>";
                                }
                            ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <button type="submit" class="btn btn-success">Aceptar</button>
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
