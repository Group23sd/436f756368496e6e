<script src="../js/validator.js"></script>

    <a class="btn btn-xs btn-success btn-block" href="signup.php" role="button">Crear cuenta</a>
    <button class="btn btn-xs btn-success btn-block" type="button" data-toggle="modal" data-target="#loginModal">Acceder</button>
</div>
</div>
</nav>
    <div class="modal fade" id="loginModal" aria-labelledby="loginModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Iniciar sesion</h3>
                </div>
                <div class="modal-body">
                    <form class="form-block" role="form" data-toggle="validator" action="login.php" method="post" name="loginForm" id="loginForm">
                        <div class="form-group has-feedback">
                            <label class="sr-only" for="userEmail">Email</label>
                            <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="Email" data-error="Ingrese un email valido!" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="sr-only" for="userPassword">Password</label>
                            <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" data-minlength="1" data-error="Ingrese una contraseña!" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success btn-block">Ingresar</button>
                        <a class="btn btn-sm btn-success btn-block" href="passwordReset.php" role="button">Olvide mi contraseña</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div>
<div>
<nav>
