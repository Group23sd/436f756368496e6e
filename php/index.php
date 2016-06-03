<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';
    $c = connectDatabase();
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
    <?php require_once "navbar.php" ?>
    <!-- CONTENT -->
    <div class="container-fluid inner-body">
        <!-- MAIN -->
        <main class="row">
            <div class="col-md-12 content-wrapper">
                <div class="row splash-page">
                    <div class="col-md-12">
                        <div class="splash-page-content">

                        </div>
                    </div>
                </div>
                <div class="row main-content">
                    <?php

                        if ($_SESSION['user']->isLogged()) {
                            echo "SI LOGUEADO<BR/>";
                        } else {
                            echo "NO LOGUEADO<BR/>";
                        }
                        if ($_SESSION['user']->isConfirmed()) {
                            echo "SI CONFIRMADO<BR/>";
                        } else {
                            echo "NO CONFIRMADO<BR/>";
                        }
                        if ($_SESSION['user']->isStandard()) {
                            echo "SI STANDARD<BR/>";
                        } else {
                            echo "NO STANDARD<BR/>";
                        }
                        if ($_SESSION['user']->isPremium()) {
                            echo "SI PREMIUM<BR/>";
                        } else {
                            echo "NO PREMIUM<BR/>";
                        }
                        if ($_SESSION['user']->isAdmin()) {
                            echo "SI ADMIN<BR/>";
                        } else {
                            echo "NO ADMIN<BR/>";
                        }
                        var_dump ($_SESSION['user']->getPermissions());
                    ?>
                </div>
            </div>
        </main>
        <!-- FOOTER -->
        <footer class="row footer">
            <p>Soy el footer</P>
        </footer>
    </div>
</body>
</html>
