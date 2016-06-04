<?php
    require_once 'userSession.php';
    require_once 'accountConfirmationEmail.php';

    if ( (isset($_POST['userEmail'])) && ($_SESSION['user']->isStandard()) ) {
        require_once 'database.php';
        $email = $_POST['userEmail'];
        $id = $_SESSION['user'] -> getId();
        $query = "SELECT email FROM usuario WHERE idusuario = '$id'";
        if ($result = queryByAssoc($query)) {
            if ($result['email'] != $email) {
                $query = "SELECT * FROM usuario WHERE email = '$email'";
                if ($result = queryByAssoc($query)) {
                    echo "<script type='text/javascript'>alert('El email ya existe');";
                    echo "window.location='userProfile.php'</script>";
                }
            }
        }
        try {
            $nombre = $_POST['userFirstName'];
            $apellido = $_POST['userLastName'];
            $password = password_hash($_POST['userPassword'],PASSWORD_DEFAULT);
            $idciudad = $_POST['userCity'];
            $sexo = $_POST['userGender'];
            $telefono = $_POST['userPhone'];
            $calle = $_POST['userStreetName'];
            $numero = $_POST['userStreetNumber'];
            $nacimiento = $_POST['userBirthday'];
            $sql = "UPDATE usuario SET nombre = :nombre, apellido = :apellido, email = :email, password = :password, idciudad = :idciudad, sexo = :sexo, telefono = :telefono, calle = :calle, numero = :numero, nacimiento = :nacimiento WHERE idusuario = $id";
            $database = connectDatabase();
            $statement = $database -> prepare($sql);
            $statement -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement -> bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $statement -> bindParam(':email', $email, PDO::PARAM_STR);
            $statement -> bindParam(':password', $password, PDO::PARAM_STR);
            $statement -> bindParam(':idciudad', $idciudad, PDO::PARAM_INT);
            $statement -> bindParam(':sexo', $sexo, PDO::PARAM_STR);
            $statement -> bindParam(':telefono', $telefono, PDO::PARAM_INT);
            $statement -> bindParam(':calle', $calle, PDO::PARAM_STR);
            $statement -> bindParam(':numero', $numero, PDO::PARAM_INT);
            $statement -> bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
            $statement -> execute();
            echo "<script type='text/javascript'>alert('Datos actualizados');";
            echo "window.location='index.php'</script>";
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Error en la base de datos');";
            echo "window.location='index.php'</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Invalido');";
        echo "window.location='index.php'</script>";
    }

?>
