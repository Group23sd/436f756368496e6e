<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- LOGO -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navbar" name="navbarToggle">
                <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img id="logo-navbar" src="../images/resources/CouchInnLogoFull.png" />
            </a>
        </div>
        <!-- ITEMS -->
        <div class="collapse navbar-collapse" id="header-navbar">
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
    </div>
</nav>
