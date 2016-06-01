<?php

    require_once '../mail/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->SMTPDebug = 3;
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "topo90lp@gmail.com";
    $mail->Password = "vip19738246";
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->From = "topo90lp@gmail.com";
    $mail->FromName = "CouchInn";

    $mail->addAddress("topo90lp@gmail.com", "Topo");

    $mail->isHTML(true);

    $mail->Subject = "Hola";
    $mail->Body = "<i>Mail body in HTML</i>";
    $mail->AltBody = "This is the plain text version of the email content";

    if(!$mail->send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Message has been sent successfully";
    }
?>
