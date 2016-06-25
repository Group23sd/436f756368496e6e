<?php

//AGREGAR FOTOS NUEVAS DEL COUCH
for ($i=1; $i < 7 ; $i++) {
    $idFoto='foto' .$i.'Couch';
    if((isset($_FILES[$idFoto])) && ($_FILES[$idFoto]['name'] != '')){


      $nombre = 'Foto del Couch -'.$idcouch.'-' ;
      $path = $_FILES[$idFoto]['name'];
      $ph = pathinfo($path);
      $extension = $ph['extension'];
      $portada = false;
      if(($i == 1) && ($_SESSION['user'] -> isPremium())){  //TOMA COMO FOTO DE PORTADA LA PRIMERA SI EL USUARIO ES premium
        $portada=true;
      }

      $sql = "INSERT INTO foto (nombre, path, extension, portada, idcouch) VALUES (:nombre, :path , :extension, :portada, :idcouch)";  //PATH ??? CAMBIAR NOMBRE EN LA BD?
      $database = connectDatabase();
      $statement = $database -> prepare($sql);
      $statement -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $statement -> bindParam(':path', $path, PDO::PARAM_STR);
      $statement -> bindParam(':extension', $extension, PDO::PARAM_STR);
      $statement -> bindParam(':portada', $portada, PDO::PARAM_BOOL);
      $statement -> bindParam(':idcouch', $idcouch, PDO::PARAM_INT);
      $statement -> execute();
      $idFotoCargada = $database -> lastInsertId();


      // LA idea ES QUE EL PATH CONTENGA EL IDFOTO ASIGNADO EN EL INSERT
     $uploaddir = '../images/couches/'.$idFotoCargada.'.'.$extension;
      move_uploaded_file($_FILES[$idFoto]['tmp_name'], $uploaddir);

      $sql = "UPDATE foto SET path = :fotopath WHERE idfoto=$idFotoCargada";
      $database = connectDatabase();
      $statement = $database -> prepare($sql);
      $statement -> bindParam(':fotopath', $uploaddir, PDO::PARAM_STR);
      $statement -> execute();

    }
}

?>
