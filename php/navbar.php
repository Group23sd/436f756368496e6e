<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <!-- LOGO -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                <img id="logo-navbar" src="../images/resources/CouchInnLogoFull.png" />
            </a>
        </div>
        <!-- ITEMS -->
        <div class="navbar-items">
            <ul class="nav navbar-nav">
                <li><a href="#">OPCION 1</a></li>
                <li><a href="#">OPCION 2</a></li>
                <li><a href="#">OPCION 3</a></li>
                <li><a href="#">OPCION 4</a></li>
                <li><a href="#">OPCION 5</a></li>
            </ul>
        </div>
        <!-- USER -->
        <div class="navbar-user navbar-right">
            <?php
                $_SESSION['user'] -> isLogged() ?
                    require_once 'navbarSessionManagerLogged.php' :
                    require_once 'navbarSessionManagerNotLogged.php' ;
            ?>
        </div>
    </div>
</nav>
