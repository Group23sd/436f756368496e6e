<?php
    require_once 'userSession.php';
    require_once 'accountConfirmationEmail.php';
    require_once 'feedback.php';
    if ( (isset($_POST['userEmail'])) && ($_SESSION['user']->isStandard()) ) {
        require_once 'database.php';
        $email = $_POST['userEmail'];
        $id = $_SESSION['user'] -> getId();
        $query = "SELECT email FROM usuario WHERE idusuario = '$id'";
        if ($result = queryByAssoc($query)) {
            if ($result['email'] != $email) {
                $query = "SELECT * FROM usuario WHERE email = '$email'";
                if ($result = queryByAssoc($query)) {
                    unavailableEmail();
                }
            }
        }
        try {
            $nombre = $_POST['userFirstName'];
            $apellido = $_POST['userLastName'];
            //$password = password_hash($_POST['userPassword'],PASSWORD_DEFAULT);
            $idciudad = $_POST['formCity'];
            $sexo = $_POST['userGender'];
            $telefono = $_POST['userPhone'];
            $calle = $_POST['userStreetName'];
            $numero = $_POST['userStreetNumber'];
            $nacimiento = $_POST['userBirthday'];
            $sql = "UPDATE usuario SET nombre = :nombre, apellido = :apellido, email = :email, idciudad = :idciudad, sexo = :sexo, telefono = :telefono, calle = :calle, numero = :numero, nacimiento = :nacimiento WHERE idusuario = $id";
            $database = connectDatabase();
            $statement = $database -> prepare($sql);
            $statement -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement -> bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $statement -> bindParam(':email', $email, PDO::PARAM_STR);
            $statement -> bindParam(':idciudad', $idciudad, PDO::PARAM_INT);
            $sexo ? $statement -> bindParam(':sexo', $sexo, PDO::PARAM_STR) : $statement -> bindValue(':sexo', NULL, PDO::PARAM_NULL);
            $telefono ? $statement -> bindParam(':telefono', $telefono, PDO::PARAM_INT) : $statement -> bindValue(':telefono', NULL, PDO::PARAM_NULL);
            $calle ? $statement -> bindParam(':calle', $calle, PDO::PARAM_STR) : $statement -> bindValue(':calle', NULL, PDO::PARAM_NULL);
            $numero ? $statement -> bindParam(':numero', $numero, PDO::PARAM_INT) : $statement -> bindValue(':numero', NULL, PDO::PARAM_NULL);
            $nacimiento ? $statement -> bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR) : $statement -> bindValue(':nacimiento', NULL, PDO::PARAM_NULL);
            $statement -> execute();
/*
            //Eliminar este bloque y que el 'reingreso' del pass sea obligatorio (?)
            if ($_POST['userPassword'] != "******") {
                $password = password_hash($_POST['userPassword'],PASSWORD_DEFAULT);
                $sql = "UPDATE usuario SET password = :password WHERE idusuario = $id";
                $database = connectDatabase();
                $statement = $database -> prepare($sql);
                $statement -> bindParam(':password', $password, PDO::PARAM_STR);
                $statement -> execute();
            }
*/
            if ($_FILES['userPicture']['tmp_name']) {
                $idusuario = $_SESSION['user']->getId();
                $extension = pathinfo($_FILES['userPicture']['name'])['extension'];
                $uploaddir = '../images/users/'.$idusuario.'.'.$extension;
                echo exec('sudo'); move_uploaded_file($_FILES['userPicture']['tmp_name'], $uploaddir);
                $sql = "UPDATE usuario SET foto_path = :fotopath WHERE idusuario = $idusuario";
                $database = connectDatabase();
                $statement = $database -> prepare($sql);
                $statement -> bindParam(':fotopath', $uploaddir, PDO::PARAM_STR);
                $statement -> execute();
            }
            $id = $_SESSION['user']->getId();
            $query = "SELECT * FROM usuario WHERE idusuario = '$id'";
            $result = queryByAssoc($query);
            $_SESSION['user']->loadData($result);
            updatedUserProfile();
        } catch (Exception $e) {
            databaseError();
        }
    } else {
        echo "<script type='text/javascript'>window.location='index.php'</script>";
    }
?>
