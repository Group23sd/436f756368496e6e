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
                  if ($_SESSION['user'] -> isLogged() && ! $_SESSION['user'] -> isAdmin() )    {
                    echo '<li>'.'<a href="#">AGREGAR COUCH</a>'.'</li>';
                    echo '<li>'.'<a href="myCouches.php">MIS COUCH</a>'.'</li>';
                    echo '<li>'.'<a href="myReservation.php">MIS RESERVAS</a>'.'</li>';
                  }
                  if (! $_SESSION['user'] -> isPremium() &&  $_SESSION['user'] -> isLogged() )    {
                    echo '<li>'.'<a href="premium.php">CONVERTIRSE EN PREMIUM</a>'.'</li>';
                  }
                  if ( $_SESSION['user'] -> isAdmin() &&  $_SESSION['user'] -> isLogged() )    {
<<<<<<< HEAD
                    echo '<li>'.'<a href="listar_tCouch.php">ADMINISTRAR TIPOS DE COUCH</a>'.'</li>';
                    echo '<li>'.'<a href="listar_tCouch.php">VER LISTADO DE GANANCIAS</a>'.'</li>';
                    echo '<li>'.'<a href="listar_tCouch.php">CAMBIAR PORCENTAJE DE GANANCIA</a>'.'</li>';

=======
                    echo '<li>'.'<a href="listar_tCouch.php">ADMINISTRAR TIPO DE COUCH</a>'.'</li>';
                    /*echo '<li>'.'<a href="#">VER LISTADO DE GANANCIAS</a>'.'</li>';
                    echo '<li>'.'<a href="#">CAMBIAR PORCENTAJE DE COMISION</a>'.'</li>';
                    echo '<li>'.'<a href="#">VER LISTADO DE SOLICITUDES ACEPTADAS</a>'.'</li>';*/
>>>>>>> master
                  }
                  if ( ! $_SESSION['user'] -> isAdmin() )    {
                    echo '<li>'.'<a href="#">CONTACTO</a>'.'</li>';
                  }
                ?>
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
