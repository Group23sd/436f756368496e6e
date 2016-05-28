<?php

    if (isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
        require_once 'userSession.php';
        try {
            $_SESSION['user'] -> login($_POST['userEmail'],$_POST['userPassword']);
            if ($_SESSION['user'] -> isConfirmed()) {
                echo "<script type='text/javascript'> alert ('Bienvenido ".$_SESSION['user']->screenName()."');";
                echo "window.location='index.php' </script>";
            } else {
                echo "<script type='text/javascript'>window.location='confirmationReminder.php'</script>";
            }
        } catch (Exception $e) {
            echo "<script type='text/javascript'> alert ('".$e->getMessage()."');";
            echo "window.location='index.php' </script>";
        }
    } else {
        echo "<script type='text/javascript'>window.location='index.php'</script>";
    }

?>
