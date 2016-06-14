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
                    echo '<li>'.'<a href="registrar_Couch.php">AGREGAR COUCH</a>'.'</li>';
                    echo '<li>'.'<a href="#">MIS COUCH</a>'.'</li>';
                    echo '<li>'.'<a href="#">MIS RESERVAS</a>'.'</li>';
                  }
                  if (! $_SESSION['user'] -> isPremium() &&  $_SESSION['user'] -> isLogged() )    {
                    echo '<li>'.'<a href="premium.php">CONVERTIRSE EN PREMIUM</a>'.'</li>';
                  }
                  if ( $_SESSION['user'] -> isAdmin() &&  $_SESSION['user'] -> isLogged() )    {
                    echo '<li>'.'<a href="listar_tCouch.php">ADMINISTRAR TIPO DE COUCH</a>'.'</li>';
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
