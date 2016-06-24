<!DOCTYPE html>
<?php
require_once 'userSession.php';
if(!$_SESSION['user'] -> isLogged()) || (!$_SESSION['user'] -> isAdmin()){

		echo "<script type='text/javascript'>window.location='permisoDenegado.php'</script>";
		die();
	}
	else{
		echo "<script type='text/javascript'> alert ('Bienvenido ".$_SESSION['user']->screenName()."');";
		echo "window.location='backend.php' </script>";
	}
?>
<html>
<head>
    <title>CouchInn Backend</title>
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
    <?php
    require_once 'navbackend.php';
    ?>

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
            </div>
        </main>
        <!-- FOOTER -->
        <footer class="row footer">
            <p>Soy el footer</P>
        </footer>
    </div>
</body>
</html>
