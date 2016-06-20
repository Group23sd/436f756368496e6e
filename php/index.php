<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';
 ?>
<html>
<head>
    <title>CouchInn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <script src="../js/validator.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/ajax.js"></script>
    <script src="../js/slowScroll.js"></script>
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
                            <div class="splash-page-items">
                                <p class="splash-page-slogan">Tu viaje comienza aquí</p>
                                <a class="splash-page-scroller" href="#mainContent">COUCHES</a>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="anchor" id="mainContent"></span>
                <div class="row main-content">
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                                require_once 'couchSearchForm.php';
                                require_once 'recommendedCouchesCarousel.php';
                            ?>
                        </div>
                        <div class="row">
                            <?php

                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- FOOTER -->
        <?php require_once 'footer.php' ?>
    </div>
</body>
</html>
