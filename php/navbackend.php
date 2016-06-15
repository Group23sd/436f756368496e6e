<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- LOGO -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                <img id="logo-navbar" src="../images/resources/CouchInnLogoFull.png" />
            </a>
        </div>
        <!-- ITEMS -->
        <div class="navbar-items">
            <ul class="nav navbar-nav" id="backendStyle">
                <li><a href="#">VER TIPOS DE COUCH</a></li>
                <li><a href="#">VER LISTADO DE GANANCIAS</a></li>
                <li><a href="#">CAMBIAR PORCENTAJE DE COMISION</a></li>
                <li><a href="#">VER LISTADO DE SOLICITUDES ACEPTADAS</a></li>
                
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
