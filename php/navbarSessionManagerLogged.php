<div class="col-md-8">
    <p style="color:#96AC3C"><?php echo $_SESSION['user'] -> screenName() ?></p>
    <a class="btn btn-xs btn-primary btn-block" href="logout.php" role="button">Cerrar sesion</a>
</div>
<div class="col-md-4">
    <a href="userProfile.php"><img src=<?php echo $_SESSION['user'] -> getPicture() ?> class="img-circle" /></a>
</div>
