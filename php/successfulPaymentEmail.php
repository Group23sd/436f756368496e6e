<?php

    require_once 'userSession.php';
    require_once 'feedback.php';
    require_once 'emailBodyTemplate.php';

    if (!$_SESSION['user']->isStandard() || !isset($_GET['idR']) || !isset($_GET['p'])) {
        echo "<script type='text/javascript'>window.location='index.php'</script>";
    }

    function sendSuccessfulPaymentEmail($id, $email, $name) {

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

        $mail->Subject = "Successful Payment Email";
        $mail->Body = emailBody($id, $email);
        $mail->AltBody = successfulPaymentLink();

        try {
            ob_start();
            $mail->send();
            ob_end_clean();
            successfulPayment();
        } catch (Exception $e) {
            genericError();
        }

    }

    function successfulPaymentLink() {
        return ("http://localhost/php/index.php");
    }

    function emailBody($id, $email) {

        $emailPreHeader = "Te han realizado un pago!";
        $emailTitle = "Te han realizado un pago!";
        $emailMsg = "Has recibido el pago de una reserva en uno de tus couches.";
        $emailButtonUrl = successfulPaymentLink($id, $email);
        $emailButtonName = "CouchInn";

        return body($emailPreHeader, $emailTitle, $emailMsg, $emailButtonUrl, $emailButtonName);

    }

?>
