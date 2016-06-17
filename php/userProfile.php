<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    if ( !$_SESSION['user']->isStandard() ) {
        unauthorizedAccess();
        exit();
    } else {
        $id = $_SESSION['user']->getId();
        $sql = "SELECT * FROM usuario WHERE idusuario = $id";
        $result = queryByAssoc($sql);
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
    <script src="../js/imgPreview.js"></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once "navbar.php" ?>
    <!-- CONTENT -->
    <div class="container-fluid inner-body">
        <!-- MAIN -->
        <main class="row">
            <div class="col-md-10 content-wrapper">
                <div class="row main-content">
                    <div class="col-md-12">
                        <h1>Perfil de usuario</h1>
                        <form class="form-block" enctype="multipart/form-data" role="form" data-toggle="validator" action="updateUserProfile.php" method="post" name="updateUserProfileForm" id="updateUserProfileForm">
                        <div class="row">

                            <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="userFirstName">Nombre</label>
                                <input type="text" <?php echo 'value='.$result["nombre"] ?> pattern="^[A-z\s]+$" class="form-control" name="userFirstName" id="userFirstName" placeholder="Nombre" data-error="Ingrese un nombre!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userLastName">Apellido</label>
                                <input type="text" <?php echo 'value='.$result["apellido"] ?> pattern="^[A-z\s]+$" class="form-control" name="userLastName" id="userLastName" placeholder="Apellido" data-error="Ingrese un apellido!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userEmail">Email</label>
                                <input type="email" <?php echo 'value='.$result["email"] ?> class="form-control" name="userEmail" id="userEmail" placeholder="Email" data-error="Ingrese un email valido!" required></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <!--
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
                            -->
                            <?php $aux = $result ?>
                            <div class="form-group has-feedback">
                                <label for="formCountry">Pais</label>
                                <select class="form-control" name="formCountry" id="formCountry" data-error="Seleccione un pais!" required onchange="showCities2()">
                                    <option hidden></option>
                                    <?php
                                        $idciudad = $aux['idciudad'];
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
                                    $idusuario = $_SESSION['user']->getId();
                                    $query = "SELECT c.idciudad, c.nombre, c.region FROM ciudad c WHERE c.idciudad = $idciudad";
                                    $row = queryByAssoc($query);
                                    echo "<option selecter value=".$row['idciudad'].">".$row['nombre'].", ".$row['region']."</option>";
                                ?>
                                </select>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userGender">Sexo</label>
                                <select class="form-control" name="userGender" id="userGender">
                                    <option value="0" hidden>Sexo</option>
                                    <option value="M" <?php if ($aux["sexo"] == "M") {echo "selected";} ?>>Masculino</option>
                                    <option value="F" <?php if ($aux["sexo"] == "F") {echo "selected";} ?>>Femenino</option>
                                    <option value="O" <?php if ($aux["sexo"] == "O") {echo "selected";} ?>>Otro</option>
                                </select>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userPhone">Telefono</label>
                                <input type="tel" <?php if ($aux["telefono"]) {echo 'value='.$aux["telefono"];} ?> pattern="^[0-9\s]+$" class="form-control" name="userPhone" id="userPhone" placeholder="Telefono" data-error="Ingrese un numero de telefono correcto!" ></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userStreetName">Calle</label>
                                <input type="text" <?php if ($aux["calle"]) {echo 'value='.$aux["calle"];} ?> class="form-control" name="userStreetName" id="userStreetName" placeholder="Calle"></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userStreetNumber">Numero Calle</label>
                                <input type="text" <?php if ($aux["numero"]) {echo 'value='.$aux["numero"];} ?> pattern="^[0-9\s]+$" class="form-control" name="userStreetNumber" id="userFirstNumber" placeholder="Numero" data-error="Ingrese un numero!"></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="userBirthday">Nacimiento</label>
                                <input type="date" <?php if ($aux["nacimiento"]) {echo 'value='.$aux["nacimiento"];} ?> class="form-control" name="userBirthday" id="userBirthday"></input>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <button type="submit" class="btn btn-success">Aceptar</button>
                            <a class="btn btn-success" href="index.php" role="button">Cancelar</a>
                            </div>

                            <div class="col-md-5 col-md-push-2">
                                <img src=<?php echo $_SESSION['user'] -> getPicture() ?> class="img-circle img-form-preview center-block" id="imagePreview"/>
                                <div class="form-group has-feedback">
                                    <label for="userPicture" class="sr-only">Foto</label>
                                    <input type="file" value="" class="form-control filestyle" data-buttonBefore="true" data-buttonText="Imagen" data-buttonName="btn-success" data-placeholder="Sin imagen" name="userPicture" id="userPicture" onchange="imageDisplay(event)"></input>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <hr>
                                <button class="btn btn-success" type="button" name="button" data-toggle="modal" data-target="#passwordResetModal">Cambiar Password</button>
                            </div>

                        </form>
                            <div class="modal fade" id="passwordResetModal" aria-labelledby="passwordResetModal">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3>Cambiar Password</h3>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-block" role="form" data-toggle="validator" action="resetPassword.php" method="post" name="resetPasswordForm" id="resetPasswordForm">
                                                <div class="form-group has-feedback">
                                                    <label class="sr-only" for="userCurrentPassword">Password Actual</label>
                                                    <input type="password" class="form-control" name="userCurrentPassword" id="userCurrentPassword" placeholder="Password Actual" data-error="Ingrese una contraseña!" required>
                                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group has-feedback">
                                                    <label class="sr-only" for="userNewPassword">Password Nuevo</label>
                                                    <input type="password" class="form-control" name="userNewPassword" id="userNewPassword" placeholder="Password Nuevo" data-minlength="1" data-error="Ingrese una contraseña!" required>
                                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group has-feedback">
                                                    <label class="sr-only" for="userNewPasswordConfirm">Confirmar Password Nuevo</label>
                                                    <input type="password" class="form-control" data-match="#userNewPassword" name="userNewPasswordConfirm" id="userNewPasswordConfirm" placeholder="Confirmar Password Nuevo" data-minlength="1" data-error="El password no coincide!" required>
                                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success btn-block">Aceptar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
