<script src="../js/dataValidation.js"></script>

<a class="btn btn-xs btn-primary btn-block" href="signup.php" role="button">Crear cuenta</a>
<button id="btnAcceso" class="btn btn-xs btn-primary btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acceder</button>
<div class="dropdown-menu">
    <form class="form-block" role="form" aria-labelledby="btnAcceso" action="login.php" method="post" name="loginForm" id="loginForm" onsubmit="return validar()">
        <div class="form-group">
            <label class="sr-only" for="userEmail">Email</label>
            <input type="text" class="form-control" name="userEmail" id="userEmail" placeholder="user@domain.com">
        </div>
        <div class="form-group">
            <label class="sr-only" for="userPassword">Password</label>
            <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-sm btn-primary btn-block">Ingresar</button>
        <a class="btn btn-sm btn-primary btn-block" href="passwordReset.php" role="button">Olvide mi contraseña</a>
    </form>
</div>
