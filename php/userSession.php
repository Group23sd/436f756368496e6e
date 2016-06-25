<?php

    require_once 'user.php';
    session_start();

    define('logoutTimer', 900);

    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = new User();
    }

    if ($_SESSION['user']->isTimeout(logoutTimer)) {
		$_SESSION['user'] = new User();
	}

    $_SESSION['user']->resetTimer();

?>
