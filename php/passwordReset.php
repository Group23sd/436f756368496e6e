<?php

    require_once 'userSession.php';
    require_once 'database.php';
    if (isset($_POST['userId']) && isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
        $id = $_POST['userId'];
        $email = $_POST['userEmail'];
        $newPassword = password_hash($_POST['userPassword'],PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET password = :password WHERE idusuario = $id";
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> bindParam(':password', $newPassword, PDO::PARAM_STR, 255);
        $statement -> execute();
        //Placeholder
        echo "<script type='text/javascript'>alert('Su Password se ha cambiado con exito!');";
        echo "window.location='index.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('Sin parametros');";
        echo "window.location='index.php'</script>";
    }

?>
