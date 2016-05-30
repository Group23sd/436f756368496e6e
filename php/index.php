<!DOCTYPE html>
<?php
    require_once 'userSession.php';
 ?>
<html>
<head>
    <title>CouchInn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- NAVBAR -->
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
    <div class="container-fluid content-wrapper">
        <!-- CONTENT -->
        <main class="row">
            <p>Soy el content</p>
        </main>
        <!-- FOOTER -->
        <footer class="row footer">
            <p>Soy el footer</P>
        </footer>
    </div>
</body>
</html>
