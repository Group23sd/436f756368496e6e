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

    function wrongCurrentPassword() {
        $title = "Wrong Current Password";
        $h1 = "Password Actual Incorrecto";
        $msg = "<p>La contraseña actual que ha ingresado no es correcta!</p><br/>
                <p>Has click en el link para volver a intentarlo.</p><br/>";
        $linkTxt = "Volver a intentar";
        $linkHref = "userProfile.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }


    function successfulPasswordUpdate() {
        $title = "Successful Password Update";
        $h1 = "Password Actualizado";
        $msg = "<p>Tu contraseña ha sido actualizada!</p><br/>
                <p>Has click en el link para volver a tu perfil.</p><br/>";
        $linkTxt = "Volver a mi perfil";
        $linkHref = "userProfile.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function tituloCouchExistente(){
      $title="Titulo Couch Existente";
      $h1 = "Error";
      $msg = "<p>El titulo que has seleccionado ya existe!</p><br/>
              <p>Por favor, vuelve a intentarlo con otro titulo.</p><br/>";
      $linkTxt = "Volver a intentar";
      $linkHref = "registrar_Couch.php";
      $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
      require_once 'feedbackTemplate.php';
    }


    function successfulReservation() {
        $title = "Successful Reservation";
        $h1 = "Reserva exitosa";
        $msg = "<p>Su solicitud fue procesada. Aguarde la confirmacion del dueño.</p>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function failedReservation() {
        $title = "Failed Reservation";
        $h1 = "¡Error!";
        $msg = "<p>Hubo un problema al procesar la reserva, intente más tarde.</p>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }

    function wrongDays() {
        $title = "Wrong Days";
        $h1 = "¡Fechas Incorrectas!";
        $msg = "<p>Debes hacer la reserva con tiempo, mínimo cinco dias de diferencia</p>";
        $linkTxt = "Volver pagina anterior";
        $linkHref = "index.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function wrongDaysBetween() {
        $title = "Wrong Days Between";
        $h1 = "¡Fechas Incorrectas!";
        $msg = "<p>La cantidad de dias para hospedarse debe ser al menos 4</p>";
        $linkTxt = "Volver pagina anterior";
        $linkHref = "index.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function wrongCapacity() {
        $title = "Wrong Capacity";
        $h1 = "¡Sin espacio!";
        $msg = "<p>¡El Couch no cuenta con tantos lugares!</p>";
        $linkTxt = "Volver pagina anterior";
        $linkHref = "index.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function wrongInitialDate() {
        $title = "Wrong Initial Date";
        $h1 = "¡Fecha de Inicio Incorrecta!";
        $msg = "<p>¡Debe ingresar una fecha de inicio mayor a cinco dias de la fecha actual!</p>";
        $linkTxt = "Volver pagina anterior";
        $linkHref = "index.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }
    function ownCouchFail() {
        $title = "Fail Own Couch";
        $h1 = "¡Error!";
        $msg = "<p>No puedes reservar tu propio Couch!</p><br/>";
        $optLink = '';
        require_once 'feedbackTemplate.php';
    }
    function datosCouchActualizados(){
      $title = "Datos Couch Actualizados";
      $h1 = "Informacion actualizada!";
      $msg = "<p>Los datos de su Couch han sido modificados correctamente.</p>";
      $optLink = '';
      require_once 'feedbackTemplate.php';
    }

    function couchEliminadoCorrectamente(){
      $title = "Couch Eliminado Correctamente";
      $h1 = "Couch eliminado!";
      $msg = "<p>Desde el equipo de CouchInn sentimos mucho que haya borrado su Couch :( . </p>";
      $optLink = '';
      require_once 'feedbackTemplate.php';
    }

    function successRejection() {
        $title = "Successful Rejection";
        $h1 = "¡Se ha rechazado la reserva!";
        $msg = "<p>Se ha informado al usuario de dicha acción. ¡Gracias!</p>";
        $linkTxt = "Volver a controlar reservas";
        $linkHref = "index.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function wrongRejection() {
        $title = "Wrong Rejection";
        $h1 = "¡Ha ocurrido un error!";
        $msg = "<p>Algo ha fallado al rechazar la reserva, intente de nuevo o espere unos minutos.</p>";
        $linkTxt = "Volver a controlar reservas";
        $linkHref = "index.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function noSePudoEliminarSuCouch(){
      $title = "No Se Pudo Eliminar Su Couch";
      $h1 = "¡Error!";
      $msg = "<p>No hemos podido eliminar su Couch debido a que tiene reservas pactadas.</p><br />
              <p>En consecuencia hemos marcado su couch como deshabilitado!</p>";
      $optLink = '';
      require_once 'feedbackTemplate.php';
    }

    function puntajeGuardado(){
      $title = "Puntaje Guardado";
      $h1 = "¡Felicidades!";
      $msg = "<p>Su puntaje ha sido valorado correctamente.</p>";
      $optLink = '';
      require_once 'feedbackTemplate.php';
    }

    function couchCargadoExitosamente(){
      $title="Couch Cargado Exitosaamente";
      $h1= "¡Felicidades!";
      $msg = "<p>Su couch ha sido cargado de manera exitosa.</p><br />";
      $optLink = '';
      require_once 'feedbackTemplate.php';
    }

    function existingCouch() {
      $title = "Existing Couch";
      $h1 = "¡Cuidado!";
      $msg = "<p>¡Ya hay Couches cargado para ese tipo!</p>";
      $linkTxt = "Volver a administrar Couches";
      $linkHref = "index.php";
      $optLink = '<a class="btn btn-success btn-lg" href="listar_tCouch.php" role="button">'.$linkTxt.'</a>';
      require_once 'feedbackTemplate.php';
    }

    function existingNameCouch() {
      $title = "Existing Name Couch";
      $h1 = "¡Cuidado!";
      $msg = "<p>¡Ya hay Couches con ese nombre!</p>";
      $linkTxt = "Volver a administrar Couches";
      $linkHref = "index.php";
      $optLink = '<a class="btn btn-success btn-lg" href="listar_tCouch.php" role="button">'.$linkTxt.'</a>';
      require_once 'feedbackTemplate.php';
    }

    function successRateUser($idreserva) {
      $title = "Sucess Rate User";
      $h1 = "¡Se ha puntuado al usuario!";
      $msg = "<p>Se puntuó correctamente al usuario ¡Gracias!.</p>";
      $linkTxt = "Volver a controlar reservas";
      $linkHref = "index.php";
      $optLink = '<a class="btn btn-success btn-lg" href="couchReservations.php?id='.$idreserva.'" role="button">'.$linkTxt.'</a>';
      require_once 'feedbackTemplate.php';
    }

    function successRateCouch() {
      $title = "Sucess Rate Couch";
      $h1 = "¡Se ha puntuado al Couch!";
      $msg = "<p>Se puntuó correctamente al Couch ¡Gracias!.</p>";
      $linkTxt = "Volver a controlar Mis Reservas";
      $linkHref = "index.php";
      $optLink = '<a class="btn btn-success btn-lg" href="myReservation.php" role="button">'.$linkTxt.'</a>';
      require_once 'feedbackTemplate.php';
    }
    function successAccept() {
      $title = "Successful Accept";
      $h1 = "¡Se ha aceptado la reserva!";
      $msg = "<p>Se ha informado al usuario de dicha acción. ¡Gracias!</p>";
      $linkTxt = "Volver a controlar reservas";
      $linkHref = "index.php";
      $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
      require_once 'feedbackTemplate.php';
    }

    function premiumCostUpdated() {
        $title = "Premium Cost Updated";
        $h1 = "Precio Premium Actualizado";
        $msg = "<p>El costo para ser usuario premium ha sido actualizado con exito!</p>";
        $linkTxt = "Volver";
        $linkHref = "changePremiumPrice.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function commissionPercentageUpdated() {
        $title = "Commission Percentage Updated";
        $h1 = "Porcentaje de comision Actualizado";
        $msg = "<p>El porcentaje de comision que CouchInn cobra a sus usuarios ha sido actualizado con exito!</p>";
        $linkTxt = "Volver";
        $linkHref = "changeCommissionPercentage.php";
        $optLink = '<a class="btn btn-success btn-lg" href="'.$linkHref.'" role="button">'.$linkTxt.'</a>';
        require_once 'feedbackTemplate.php';
    }

    function comentarioPublicado(){
      $title = "Comentario Publicado";
      $h1 = "Comentario publicado correctamente";
      $msg = "<p>Su inquietud ser&aacute respondida en cualquier momento por el due&ntildeo del Couch.</p>";
      $optLink = '';
      require_once 'feedbackTemplate.php';

    }

    function respuestaPublicada(){
      $title = "Comentario Publicada";
      $h1 = "Respuesta publicada correctamente";
      $msg = "<p>Su respuesta a la inquietud del usuario ya puede ser visualizada.</p> <br />
            <p>Esto hara que los usuarios tomen una mejor decici&oacute al momento de elegir su Couch. Muchas gracias!";
      $optLink = '';
      require_once 'feedbackTemplate.php';

    }

?>
