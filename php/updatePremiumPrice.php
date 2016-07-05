<?php

    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    if (!$_SESSION['user']->isAdmin() || !isset($_POST['newPriceFull'])) {
        unauthorizedAccess();
        exit();
    }

    $newPrice = $_POST['newPriceFull'] + $_POST['newPriceCents'] / 100;

    $sql = "UPDATE valor_negocio SET valor = :nuevoValor WHERE valor_nombre = 'precioPremium'";
    $database = connectDatabase();
    $statement = $database -> prepare($sql);
    $statement -> bindParam(':nuevoValor', $newPrice, PDO::PARAM_STR);
    $statement -> execute();
    premiumCostUpdated();

?>
