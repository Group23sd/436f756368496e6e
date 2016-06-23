<?php

    require_once 'userSession.php';
    require_once 'feedback.php';
    require_once 'emailBodyTemplate.php';



    function sendSuccessfulReservationEmail($id,$email,$name) {

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

        $mail->addAddress("$email", "$name");

        $mail->isHTML(true);

        $mail->Subject = "Successful Reservation Email";
        $mail->Body = emailBody($id, $email);
        $mail->AltBody = successfulReservationLink();

        try {
            ob_start();
            $mail->send();
            ob_end_clean();
        } catch (Exception $e) {
            genericError();
        }

    }

    function successfulReservationLink() {
        return ("http://localhost/php/index.php");
    }

    function emailBody($id, $email) {

        $emailPreHeader = "¡Tienes una peticion de reserva!";
        $emailTitle = "¡Tienes una reserva pendiente!";
        $emailMsg = "Has recibido una peticion de reserva en uno de tus Couch";
        $emailButtonUrl = successfulReservationLink($id, $email);
        $emailButtonName = "CouchInn";

        return body($emailPreHeader, $emailTitle, $emailMsg, $emailButtonUrl, $emailButtonName);

    }

?>
