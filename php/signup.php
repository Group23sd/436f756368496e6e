<?php
    require_once 'userSession.php';

    if (isset($_POST['userEmail']) && (!$_SESSION['user']->islogged())) {
        require_once 'database.php';
        try {
            $nombre = $_POST['userFirstName'];
            $apellido = $_POST['userLastName'];
            $email = $_POST['userEmail'];
            $password = password_hash($_POST['userPassword'],PASSWORD_DEFAULT);
            $idciudad = $_POST['userCity'];
            $sql = "INSERT INTO usuario (nombre, apellido, email, password, idciudad)
            VALUES ('$nombre','$apellido','$email','$password','$idciudad')";
            insertRow($sql);

        } catch (Exception $e) {
            echo "<script type='text/javascript'> alert ('".$e->getMessage()."');";
            echo "window.location='index.php' </script>";
        }
    } else {
        echo "<script type='text/javascript'>window.location='index.php'</script>";
    }

?>
