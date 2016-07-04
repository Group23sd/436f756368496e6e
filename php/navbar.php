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
            <ul class="nav navbar-nav">
                <?php
                require_once 'userSession.php';
                if ($_SESSION['user'] -> isStandard()) {
                    echo '<li class="dropdown">';
                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OPCIONES DE USUARIO <span class="caret"></span></a>';
                    echo '<ul class="dropdown-menu inverse-dropdown">';
                    echo '<li>'.'<a href="registrar_Couch.php">AGREGAR COUCH</a>'.'</li>';
                    echo '<li>'.'<a href="myCouches.php">MIS COUCHES</a>'.'</li>';
                    echo '<li>'.'<a href="myReservation.php">MIS RESERVAS</a>'.'</li>';
                    echo '<li>'.'<a href="visitedCouches.php">COUCHES VISITADOS</a>'.'</li>';
                    echo '</ul>';
                }
                if ($_SESSION['user'] -> isAdmin()) {
                    echo '<li class="dropdown">';
                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OPCIONES DE ADMINISTRADOR <span class="caret"></span></a>';
                    echo '<ul class="dropdown-menu inverse-dropdown">';
                    echo '<li>'.'<a href="listar_tCouch.php">TIPOS DE COUCH</a>'.'</li>';
                    echo '<li>'.'<a href="#">LISTADO DE GANANCIAS</a>'.'</li>';
                    echo '<li>'.'<a href="#">PORCENTAJE DE COMISION</a>'.'</li>';
                    echo '<li>'.'<a href="#">SOLICITUDES ACEPTADAS</a>'.'</li>';
                    echo '</ul>';
                }
                if (!$_SESSION['user'] -> isPremium() && $_SESSION['user'] -> isLogged()) {
                    echo '<li>'.'<a href="premium.php">SER PREMIUM</a>'.'</li>';
                }
                if (!$_SESSION['user'] -> isAdmin()) {
                    echo '<li>'.'<a href="#">CONTACTO</a>'.'</li>';
                }
                ?>
            </ul>
            <!-- USER -->
            <div class="navbar-user navbar-right">
                <?php
                $_SESSION['user'] -> isLogged() ?
                require_once 'navbarSessionManagerLogged.php' :
                require_once 'navbarSessionManagerNotLogged.php' ;
                ?>
            </div>
        </div>
    </div>
</nav>
