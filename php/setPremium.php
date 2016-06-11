<?php
        require_once 'userSession.php';
        $_SESSION['user'] -> setPremium();
        echo "<script>alert('Su solicitud ha sido procesda. ¡Felicidades!'); window.location.href='index.php';</script>";
        header("Refresh:0");


?>
