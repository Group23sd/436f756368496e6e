<?php

    require_once 'user.php';
    session_start();

    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = new User();
    }

?>