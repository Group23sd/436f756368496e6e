<?php
  require_once 'feedback.php';

  if(isset($_POST['tituloDelCouch'])){
    require_once 'connectdb.php';
    require_once 'userSession.php';

    $tituloC=$_POST['tituloDelCouch'];
    $sql="SELECT * FROM couch WHERE titulo='$tituloC'";
    $result= queryAllByAssoc($sql);

    if(!$_SESSION['user'] -> islogged()){
      genericError();
    }
    else{
    if(empty($result)){
      try{
        $usuarioDuenio = $_SESSION['user'] -> getId();
        $precio = $_POST['precioDelCouch'];
        $precio = $precio + 0.00;
        $capacidad = $_POST['capacidadDelCouch'];
        $descripcion = $_POST['descripcionDelCouch'];
        $pais = $_POST['formCountry'];
        $ciudad = $_POST['formCity'];
        $habilitado = 1;

        $tipo = $_POST['tipoDeCouch'];
        $sql = "SELECT * FROM tipo WHERE descripcion='$tipo'";
        $result = queryByAssoc($sql);
        $tipo = $result['idtipo'];


        $sql = "SELECT * FROM caracteristica";
        $result = queryAllByAssoc($sql);
        $caracteristicas;
        foreach ($result as $caract) {
          $desc = $caract['descripcion'];
          $idC = $caract['idcaracteristica'];
          if($_POST['$desc']){
            array_push($caracteristicas , $idc);
          }
        }

        $data = Array($tituloC, $descripcion, $precio, $capacidad, $habilitado, $ciudad, $tipo, $usuarioDuenio);
        $sql ="INSERT INTO couch (titulo , descripcion , precio, capacidad, habilitado, idciudad, idtipo, idusuario) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> execute($data);
        $idCouch = $database -> lastInsertId();

        //AGREGAR CARACTERISTICAS DEL COUCH
        foreach ($caracteristicas as $idCaract) {
          $data = Array($idCaract, $idCouch);
          $sql = "INSERT INTO caracteristica_couch(idcaracteristica, idcouch) VALUES (?, ?)";
          $database = connectDatabase();
          $statement = $database -> prepare($sql);
          $statement -> execute($data);
        }

        //AGREGAR FOTOS DEL COUCH
          $fotosDelCouch;
          for ($i=1; $i < 6 ; $i++) {
            $idFoto='foto' .$i.'Couch';
            if($_FILES['$idFoto']['$tmp_name']){

              $extensionFoto = pathinfo($_FILES['$idFoto']['name'])['extension'];
              $nombreFoto = pathinfo($_FILES['$idFoto']['name']['basename']);
              $pathFoto = $_FILES['$idFoto']['name'];
              $portada = 0;
              if(($i == 1) && ($_SESSION['user'] -> isPremium())){  //TOMA COMO FOTO DE PORTADA LA PRIMERA SI EL USUARIO ES premium
                $portada=1;
              }
              $data = Array($nombreFoto, $pathFoto, $extensionFoto, $portada, $idCouch);
              $sql = "INSERT INTO foto (nombre, path, extension, portada, idcouch) VALUES (?, ?, ?, ?, ?)";  //PATH ??? CAMBIAR NOMBRE EN LA BD?
              $database = connectDatabase();
              $statement = $database -> prepare($sql);
              $statement -> execute($data);
              $idFotoCargada = $database -> lastInsertId();

              // LA idea ES QUE EL PATH CONTENGA EL IDFOTO ASIGNADO EN EL INSERT
              $uploaddir = '../images/couches/'.$idFotoCargada.'.'.$extension;
              move_uploaded_file($_FILES['$idFoto']['tmp_name'], $uploaddir);

              $sql = "UPDATE foto SET nombre = :nombreFoto, path = :uploaddir, extension = :extensionFoto, portada = :portada, idcouch = :idCouch WHERE idfoto=$idFotoCargada";
              $database = connectDatabase();
              $statement = $database -> prepare($sql);
              $statement -> bindParam(':nombre', $nombreFoto, PDO::PARAM_STR);
              $statement -> bindParam(':path', $uploaddir, PDO::PARAM_STR);
              $statement -> bindParam(':extension', $extensionFoto, PDO::PARAM_STR);
              $statement -> bindParam(':portada', $portada, PDO::PARAM_INT); //PARAM_INT? PORTADA ESTA DEFINIDO DE TIPO BIT!
              $statement -> bindParam(':idcouch', $idCouch, PDO::PARAM_INT);
              $statement -> execute();

            }
          }
      }
      catch(Exception $e){
        databaseError();
      }


    }
    else{
      tituloCouchExistente();
    }


  }

?>
