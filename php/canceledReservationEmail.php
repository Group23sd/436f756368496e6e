<?php

    require_once 'userSession.php';
    require_once 'feedback.php';
    require_once 'emailBodyTemplate.php';

    $urlDestination = "changeCouchAvailability.php";
    $currentUrl = explode("?", end(explode("/", $_SERVER['REQUEST_URI'])))[0];
    if ($currentUrl != $urlDestination) {
        header("Location: $urlDestination");
    }

    function canceledReservationEmail($userEmail, $userName, $couchTitle, $reservationStart, $reservationEnd, $reservationPrice) {

        require_once '../mail/PHPMailerAutoload.php';

        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "couchinn.international@gmail.com";
        $mail->Password = "group23sd";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->From = "couchinn.international@gmail.com";
        $mail->FromName = "CouchInn.com";

        $mail->addAddress("$userEmail", "$userName");

        $mail->isHTML(true);

        $mail->Subject = "Canceled Reservation Email";
        $mail->Body = emailBody($userEmail, $couchTitle, $reservationStart, $reservationEnd, $reservationPrice);
        $mail->AltBody = canceledReservationLink();

        try {
            ob_start();
            $mail->send();
            ob_end_clean();
            successfulPayment();
        } catch (Exception $e) {
            genericError();
        }

    }

    function canceledReservationLink() {
        return ("http://localhost/php/index.php");
    }

    function emailBody($userEmail, $couchTitle, $reservationStart, $reservationEnd, $reservationPrice) {

        $emailPreHeader = "Se ha cancelado una reserva!";
        $emailTitle = "Se ha cancelado una reserva!";
        $emailMsg = "La reserva para $couchTitle del $reservationStart al $reservationEnd ha sido cancelada y se han reintegrado $".$reservationPrice." a tu cuenta.";
        $emailButtonUrl = canceledReservationLink();
        $emailButtonName = "CouchInn";

        return body($emailPreHeader, $emailTitle, $emailMsg, $emailButtonUrl, $emailButtonName);

    }

?>
