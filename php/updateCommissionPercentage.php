<?php

    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    if (!$_SESSION['user']->isAdmin() || !isset($_POST['newPercentageFull'])) {
        unauthorizedAccess();
        exit();
    }

    $newPercentage = $_POST['newPercentageFull'] / 100 + $_POST['newPercentageDecimal'] / 1000;

    $sql = "UPDATE valor_negocio SET valor = :nuevoValor WHERE valor_nombre = 'porcentajeComision'";
    $database = connectDatabase();
    $statement = $database -> prepare($sql);
    $statement -> bindParam(':nuevoValor', $newPercentage, PDO::PARAM_STR);
    $statement -> execute();
    commissionPercentageUpdated();

?>
