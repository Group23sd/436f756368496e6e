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
            $confirmado = false;
            $data = Array($nombre, $apellido, $email, $password, $idciudad, $confirmado);
            $sql = "INSERT INTO usuario (nombre, apellido, email, password, idciudad, confirmado) VALUES (?, ?, ?, ?, ?, ?)";
            $database = connectDatabase();
            $statement = $database -> prepare($sql);
            $statement -> execute($data);
        } catch (Exception $e) {
            echo "<script type='text/javascript'> alert('El email ya existe!');";
            echo "window.location='index.php'</script>";
        }
    }

    echo "<script type='text/javascript'>window.location='index.php'</script>";

?>
