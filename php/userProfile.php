<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';

    if ( !$_SESSION['user']->isStandard() ) {
        echo "<script type='text/javascript'>alert('No es usuario');";
        echo "window.location='index.php'</script>";
    } else {
        $id = $_SESSION['user']->getId();
        $sql = "SELECT * FROM usuario WHERE idusuario = $id";
        $result = queryByAssoc($sql);
        var_dump($result);
    }

 ?>
<html>
<head>
    <title>User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <script src="../js/validator.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/bootstrap-filestyle.min.js"></script>
    <script src="../js/ajax.js"></script>
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
                    <div class="col-md-6 col-md-offset-3">
                        <form class="form-block" role="form" data-toggle="validator" action="updateUserProfile.php" method="post" name="updateUserProfileForm" id="updateUserProfileForm">

                            <div class="form-group has-feedback">
                                <label for="userFirstName">Nombre</label>
                                <input type="text" <?php echo 'value='.$result["nombre"] ?> class="form-control" name="userFirstName" id="userFirstName" placeholder="Nombre" data-error="Ingrese un nombre!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userLastName">Apellido</label>
                                <input type="text" <?php echo 'value='.$result["apellido"] ?> class="form-control" name="userLastName" id="userLastName" placeholder="Apellido" data-error="Ingrese un apellido!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userEmail">Email</label>
                                <input type="email" <?php echo 'value='.$result["email"] ?> class="form-control" name="userEmail" id="userEmail" placeholder="Email" data-error="Ingrese un email valido!" required></input>
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
                                    <option hidden></option>
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
                                <label for="userCity">Ciudad</label>
                                <select class="form-control" name="userCity" id="userCity" data-error="Seleccione una ciudad!" required>
                                    <option hidden></option>
                                </select>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userGender">Sexo</label>
                                <select class="form-control" <?php echo 'value='.$result["sexo"] ?> name="userGender" id="userGender">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="O">Otro</option>
                                </select>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userPhone">Telefono</label>
                                <input type="tel" <?php echo 'value='.$result["telefono"] ?> pattern="^[0-9\s]+$" class="form-control" name="userPhone" id="userPhone" placeholder="Telefono" data-error="Ingrese un numero de telefono correcto!"></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userStreetName">Calle</label>
                                <input type="text" class="form-control" name="userStreetName" id="userStreetName" placeholder="Calle"></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userStreetNumber">Numero Calle</label>
                                <input type="text" pattern="^[0-9\s]+$" class="form-control" name="userStreetNumber" id="userFirstNumber" placeholder="Numero" data-error="Ingrese un numero!"></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userBirthday">Nacimiento</label>
                                <input type="date" class="form-control" name="userBirthday" id="userBirthday"></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <button type="submit" class="btn btn-success">Aceptar</button>
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
