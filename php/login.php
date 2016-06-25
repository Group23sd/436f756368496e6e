<?php

    require_once 'feedback.php';

    if (isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
        require_once 'userSession.php';
        try {
            $_SESSION['user'] -> login($_POST['userEmail'],$_POST['userPassword']);
            if ($_SESSION['user'] -> isConfirmed()) {
                echo "<script type='text/javascript'>window.location='index.php'</script>";
            } else {
                confirmationReminder();
            }
        } catch (Exception $e) {
            wrongCredentials();
        }
    } else {
        echo "<script type='text/javascript'>window.location='index.php'</script>";
    }

?>
