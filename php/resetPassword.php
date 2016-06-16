<?php

    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    if (!$_SESSION['user']->isStandard()) {
        unauthorizedAccess();
        exit();
    }
    try {
        $userId = $_SESSION['user'] -> getId();
        $currentPassword = $_POST['userCurrentPassword'];
        $query = "SELECT password FROM usuario WHERE idusuario = '$userId'";
        $result = queryByAssoc($query);
        if (!password_verify($currentPassword, $result['password'])) {
            wrongCurrentPassword();
            exit();
        }
        $newPassword = password_hash($_POST['userNewPassword'],PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET password = :password WHERE idusuario = $userId";
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> bindParam(':password', $newPassword, PDO::PARAM_STR);
        $statement -> execute();
        successfulPasswordUpdate();
    } catch (Exception $e) {
        databaseError();
    }

?>
