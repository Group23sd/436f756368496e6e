<?php

    function genericError() {
        $title = "Unknown Error";
        $h1 = "Ha ocurrido un error!";
        $msg = "<p>Por favor, intenta más tarde.</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function confirmationReminder() {
        $title = "Confirmation Reminder";
        $h1 = "Usuario no confirmado!";
        $msg = "<p>No hemos recibido la confirmación de tu cuenta!</p><br/>
                <p>Dirigete al enlace que aparece en el email de verificación que enviamos a tu cuenta.</p><br/>
                <p>Si no encuentras el email, puedes reenviarlo haciendo click aquí abajo.</p>";
        $linkTxt = "Reenviar Email";
        $linkHref = "accountConfirmationEmail.php?rs=1";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function databaseError() {
        $title = "Unserviceable Database";
        $h1 = "Servicio no disponible";
        $msg = "<p>Estamos trabajando para mejorar tu experiencia.</p><br/>
                <p>En este momento no podemos atender tu solicitud.</p><br/>
                <p>Por favor, intenta más tarde.</p>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function wrongCredentials() {
        $title = "Wrong Credentials";
        $h1 = "Usuario o Password Incorrectos";
        $msg = "<p>Tu nombre de usuario o password no son correctos!</p><br/>
                <p>Puedes volver a intentarlo o hacer click en el boton</p><br/>
                <p>'Olvide mi password' en la ventana de acceso.</p>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function nonexistentAccount() {
        $title = "Nonexistent Account";
        $h1 = "La cuenta no existe";
        $msg = "<p>La dirección de email que ingresaste no existe.</p><br/>
                <p>Por favor, vuelve a intentarlo.</p><br/>";
        $linkTxt = "Volver a intentar";
        $linkHref = "passwordResetHelper.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function accountConfirmed() {
        $title = "Account Confirmed";
        $h1 = "Bienvenido!";
        $msg = "<p>Tu cuenta ha sido confirmada.</p><br/>
                <p>Ya puedes comenzar a utilizar nuestros servicios!</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function accountAlreadyConfirmed() {
        $title = "Account Already Confirmed";
        $h1 = "Error";
        $msg = "<p>Tu cuenta ya ha sido confirmada!</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function wrongConfirmationCredentials() {
        $title = "Wrong Confirmation Credentials";
        $h1 = "Error en la confirmacion";
        $msg = "<p>Ha ocurrido un error con el intento de confirmacion de tu cuenta!</p><br/>
                <p>Has click en el link para reenviar el mail y volver a intentarlo.</p><br/>";
        $linkTxt = "Reenviar Email";
        $linkHref = "accountConfirmationEmail.php?rs=1";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function confirmationEmailSent() {
        $title = "Confirmation Email Sent";
        $h1 = "Email enviado";
        $msg = "<p>Tu email de confirmacion ha sido enviado!</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function updatedUserProfile() {
        $title = "Updated User Profile";
        $h1 = "Perfil actualizado";
        $msg = "<p>Tus datos de perfil han sido actualizados!</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function wrongPasswordResetCredentials() {
        $title = "Wrong Password Reset Confirmation Credentials";
        $h1 = "Error en la operacion";
        $msg = "<p>Ha ocurrido un error con el intento de resetear tu password!</p><br/>
                <p>Has click en el link para volver a intentarlo.</p><br/>";
        $linkTxt = "Volver a intentar";
        $linkHref = "passwordResetHelper.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function resetEmailSent() {
        $title = "Reset Email Sent";
        $h1 = "Email enviado";
        $msg = "<p>Tu email para resetar tu password ha sido enviado!</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function successfulPasswordReset() {
        $title = "Successful Password Reset";
        $h1 = "Password reseteado";
        $msg = "<p>Tu password ha cambiado con exito!</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function unavailableEmail() {
        $title = "Unavailable Email";
        $h1 = "Error";
        $msg = "<p>El email que has seleccionado ya existe!</p><br/>
                <p>Por favor, vuelve a intentarlo con otra direccion.</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function unauthorizedAccess() {
        $title = "Unauthorized Access";
        $h1 = "Permiso denegado";
        $msg = "<p>Usted no tiene los permisos necesarios para acceder!</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function successPremium() {
      $title = "Successful Operation";
      $h1 = "¡Felicidades!";
      $msg = "<p> Su solicitud se ha procesado con exito. Es usted ahora un usuario PREMIUM</p>";
      $optLink = '';
      require_once 'feedbackTemplate.php';
    }

    
?>
