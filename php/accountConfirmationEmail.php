<?php

    require_once 'userSession.php';
    require_once 'feedback.php';

    if ( (isset($_GET['rs'])) && ($_SESSION['user']->islogged()) && (!$_SESSION['user']->isConfirmed()) ) {
        $id = $_SESSION['user'] -> getId();
        $email = $_SESSION['user'] -> getEmail();
        $name = ($_SESSION['user'] -> getFirstName())." ".($_SESSION['user'] -> getLastName());
        sendConfirmationEmail($id, $email, $name);
    }

    function sendConfirmationEmail($id, $email, $name) {

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

        $mail->Subject = "Confirmation Email";
        $mail->Body = mailBody($id);
        $mail->AltBody = confirmationLink($id);

        try {
            ob_start();
            $mail->send();
            ob_end_clean();
            confirmationEmailSent();
        } catch (Exception $e) {
            genericError();
        }

    }

    function confirmationLink($id) {
        $hashedId = password_hash($id.'g23sd', PASSWORD_DEFAULT);
        return ("http://localhost/php/accountConfirmation.php?id=".$id."&code=".$hashedId);
    }

    function mailBody($id) {
        return "<p>Haga click </p><a href=".confirmationLink($id).">AQUI</a><p> para confirmar su cuenta.</p>";
    }

?>