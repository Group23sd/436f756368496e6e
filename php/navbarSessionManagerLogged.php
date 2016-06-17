<div class="col-md-8">
    <p style="color:#96AC3C;text-align:right"><?php echo $_SESSION['user'] -> screenName() ?></p>
    <a class="btn btn-xs btn-success btn-block" href="logout.php" role="button">Cerrar sesion</a>
</div>
<div class="col-md-4">
    <a href="userProfile.php"><img src=<?php echo $_SESSION['user'] -> getPicture() ?> class="img-circle navbar-user-img" /></a>
</div>
