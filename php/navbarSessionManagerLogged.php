<?php
    if ($_SESSION['user'] -> isAdmin()) {
        $usrStatus = " <span class='glyphicon glyphicon-wrench scoreStar' alt='Administrador' title='Administrador'></span>";
    } else if ($_SESSION['user'] -> isPremium()) {
        $usrStatus = " <span class='glyphicon glyphicon-star scoreStar' alt='Usuario Premium' title='Usuario Premium'></span>";
    } else {
        $usrStatus = "";
    }

?>
<div class="col-md-8">
    <p style="color:#96AC3C;text-align:right"><?php echo $_SESSION['user'] -> screenName(); echo $usrStatus ?> </p>
    <a class="btn btn-xs btn-success btn-block" href="logout.php" role="button">Cerrar sesion</a>
</div>
<div class="col-md-4">
    <a href="userProfile.php" alt="Editar Perfil" title="Editar Perfil"><img src=<?php echo $_SESSION['user'] -> getPicture() ?> class="img-circle navbar-user-img" /></a>
</div>
