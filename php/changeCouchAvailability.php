<?php

    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';
    require_once 'canceledReservationEmail.php';

    if (!$_SESSION['user']->isStandard() || !isset($_GET['id'])) {
        unauthorizedAccess();
        exit();
    }

    //Estado actual
    $database = connectDatabase();
    $query = "SELECT c.titulo, c.habilitado, c.idusuario FROM couch c WHERE idcouch = :idcouch";
    $statement = $database -> prepare($query);
    $statement -> bindParam(':idcouch', $_GET['id'], PDO::PARAM_INT);
    $statement -> execute();
    $couchResult = $statement -> fetch(PDO::FETCH_ASSOC);
    $currentCouchStatus = $couchResult['habilitado'];

    if ($couchResult['idusuario'] != $_SESSION['user']->getId()) {
        unauthorizedAccess();
        exit();
    }

    //Estado actual == "Habilitado"
    /*
    if ($currentCouchStatus) {
        $query = "SELECT r.*, e.nombre FROM estado e INNER JOIN reserva r ON (e.idreserva=r.idreserva) WHERE e.fecha = (SELECT max(fecha) FROM estado WHERE (e.idreserva=estado.idreserva)) AND r.idcouch = :idcouch AND e.nombre IN ('Reservado', 'Confirmado', 'Pagado')";
        $statement = $database -> prepare($query);
        $statement -> bindParam(':idcouch', $_GET['id'], PDO::PARAM_INT);
        $statement -> execute();
        $result = $statement -> fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $reservation) {
                //Cancelar Reserva
                $status = 'Cancelado';
                $now = date("Y-m-d H:i:s");
                $reservationId = $reservation['idreserva'];
                $data = Array($status, $now, $reservationId);
                $sql = "INSERT INTO estado (nombre, fecha, idreserva) VALUES (?, ?, ?)";
                $statement = $database -> prepare($sql);
                $statement -> execute($data);
                //Informar usuario
                $reservationUser = $reservation['idusuario'];
                $query = "SELECT * FROM usuario WHERE idusuario = $reservationUser";
                $user = queryByAssoc($query);
                $userEmail = $user['email'];
                $userName = $user['nombre'];
                $couchTitle = $couchResult['titulo'];
                $reservationStart = $reservation['inicio'];
                $reservationEnd = $reservation['fin'];
                $reservationPrice =$reservation['monto'];
                canceledReservationEmail($userEmail, $userName, $couchTitle, $reservationStart, $reservationEnd, $reservationPrice);
            }
        }
    }
    */

    //Cambiar Estado
    $newCouchStatus = !$currentCouchStatus;
    $sql = "UPDATE couch SET habilitado = :newCouchStatus WHERE idcouch = :idcouch";
    $statement = $database -> prepare($sql);
    $statement -> bindParam(':idcouch', $_GET['id'], PDO::PARAM_INT);
    $statement -> bindParam(':newCouchStatus', $newCouchStatus, PDO::PARAM_BOOL);
    $statement -> execute();

    header('Location: myCouches.php');

?>
