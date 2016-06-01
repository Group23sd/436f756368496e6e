<?php
    header("Location: index.php");

    function sendConfirmationEmail($id, $email, $name) {

        require_once '../mail/PHPMailerAutoload.php';

        $mail = new PHPMailer;

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
        $mail->send();
/*
        if(!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            echo "Message has been sent successfully";
        }
*/
    }

    function confirmationLink($id) {
        $hashedId = password_hash($id.'g23sd', PASSWORD_DEFAULT);
        return ("http://localhost/php/confirmAccount.php?id=".$id."&code=".$hashedId);
    }

    function mailBody($id) {
        return "<a href=".confirmationLink($id).">Confirmar</a>";
    }

?>
