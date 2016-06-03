<?php
    require_once 'userSession.php';
    require_once 'accountConfirmationEmail.php';

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
            $id = $database -> lastInsertId();
            sendConfirmationEmail($id, $email, $nombre." ".$apellido);
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('".$e->getMessage()."');";
            echo "window.location='index.php'</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('SignUp sin usr o pass');";
        echo "window.location='index.php'</script>";
    }

?>
