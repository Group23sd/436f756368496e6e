<?php
        require_once 'userSession.php';
        require_once 'feedback.php';
        $_SESSION['user'] -> setPremium();
        premiumSuccess();
        #echo "<script> window.location.href='index.php';</script>";
        #header("Refresh:0");


?>
