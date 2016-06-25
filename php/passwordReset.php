<?php

    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    if (isset($_POST['userId']) && isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
        $id = $_POST['userId'];
        $email = $_POST['userEmail'];
        $newPassword = password_hash($_POST['userPassword'],PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET password = :password WHERE idusuario = $id";
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> bindParam(':password', $newPassword, PDO::PARAM_STR, 255);
        $statement -> execute();
        successfulPasswordReset();
    } else {
        echo "<script type='text/javascript'>window.location='index.php'</script>";
    }

?>
