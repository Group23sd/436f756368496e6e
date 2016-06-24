<?php

  require_once 'feedback.php';
  var_dump($_FILES);

  if(isset($_POST['idcouch'])){

    $idcouch = $_POST['idcouch'];
    require_once 'database.php';
    require_once 'userSession.php';

    $sql="SELECT * FROM couch WHERE idcouch='$idcouch'";
    $result= queryAllByAssoc($sql);

    if(!$_SESSION['user'] -> islogged()){
      genericError();
    }
    else{
      if(!empty($result)){
      //  try{
          $idusuario = $_SESSION['user'] -> getId();
          $titulo=$_POST['tituloDelCouch'];
          $precio = $_POST['precioDelCouch'];
          $capacidad = $_POST['capacidadDelCouch'];
          $descripcion = $_POST['descripcionDelCouch'];
          $idpais = $_POST['formCountry'];
          $idciudad = $_POST['formCity'];
          $habilitado = true;

          $tipo = $_POST['tipoDeCouch'];
          $sql = "SELECT * FROM tipo WHERE descripcion='$tipo'";
          $result = queryByAssoc($sql);
          $idtipo = $result['idtipo'];

          $sql = "UPDATE couch SET titulo = :titulo, descripcion = :descripcion, precio = :precio, capacidad = :capacidad, habilitado = :habilitado, idciudad = :idciudad, idtipo = :idtipo, idusuario = :idusuario WHERE idcouch = $idcouch";
          $database = connectDatabase();
          $statement = $database -> prepare($sql);
          $statement -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
          $statement -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
          $statement -> bindParam(':precio', $precio , PDO::PARAM_STR);
          $statement -> bindParam(':capacidad', $capacidad, PDO::PARAM_INT);
          $statement -> bindParam(':habilitado', $habilitado , PDO::PARAM_BOOL);
          $statement -> bindParam(':idciudad', $idciudad, PDO::PARAM_INT);
          $statement -> bindParam(':idtipo', $idtipo, PDO::PARAM_INT);
          $statement -> bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
          $statement -> execute();


          $sql = "SELECT * FROM caracteristica";
          $result = queryAllByAssoc($sql);

          $sql = "SELECT * FROM caracteristica_couch WHERE idcouch =$idcouch";
          $caractCouch = queryAllByAssoc($sql);

          $caracteristicasNuevas=array();

          foreach ($result as $caract) {
            $idC = $caract['idcaracteristica'];
            $esta = false;
            if(isset($_POST[$idC])){
              foreach ($caractCouch as $caractC){
                //checkea si ya estaba marcada la caracteristica con  con id '$idC'
                if($caractC['idcaracteristica'] == $idC){
                  $esta = true;
                }
              }
              if(!$esta){
                array_push($caracteristicasNuevas , $idC);
              }
            }
            else{
              foreach ($caractCouch as $caractC) {
                //checkea si la caracteristica estaba marcada y la desmarco
                if($caractC['idcaracteristica'] == $idC){
                  $esta = true;
                }
                if($esta){
                  $sql = "DELETE FROM caracteristica_couch WHERE idcouch=$idcouch AND idcaracteristica=$idC";
                  $database = connectDatabase();
                  $statement = $database -> prepare($sql);
                  $statement -> execute();
              }

              }
            }
          }

          //AGREGAR CARACTERISTICAS NUEVAS DEL COUCH
          foreach ($caracteristicasNuevas as $idcaracteristica) {
            $data = array($idcaracteristica, $idcouch);
            $sql = "INSERT INTO caracteristica_couch(idcaracteristica, idcouch) VALUES (:idcaracteristica, :idcouch)";
            $database = connectDatabase();
            $statement = $database -> prepare($sql);
            $statement -> bindParam(':idcaracteristica', $idcaracteristica, PDO::PARAM_INT);
            $statement -> bindParam(':idcouch', $idcouch, PDO::PARAM_INT);
            $statement -> execute();
          }

          //fotos
          $sql = "SELECT * FROM  foto WHERE idcouch = $idcouch";
          $fotosCouch = queryAllByAssoc($sql);

          foreach ($fotosCouch as $foto) {
            $idFoto = $foto['idfoto'];


            if((isset($_FILES[$idFoto])) && ($_FILES[$idFoto]['name'] != '')){
              //cambia una foto que tenia por otra
              $path = $_FILES[$idFoto]['name'];
              $ph = pathinfo($path);
              $extension = $ph['extension'];
              $portada = false;
      /*        if(($i == 1) && ($_SESSION['user'] -> isPremium())){  //TOMA COMO FOTO DE PORTADA LA PRIMERA SI EL USUARIO ES premium
                $portada=true;
              }
*/
             $uploaddir = '../images/couches/'.$idFoto.'.'.$extension;

              $sql = "UPDATE foto SET path = :fotopath, extension = :extension WHERE idcouch = $idcouch AND idfoto = $idFoto";
              $database = connectDatabase();
              $statement = $database -> prepare($sql);
              $statement -> bindParam(':fotopath', $uploaddir, PDO::PARAM_STR);
              $statement -> bindParam(':extension', $extension, PDO::PARAM_STR);
              $statement -> execute();

              move_uploaded_file($_FILES[$idFoto]['tmp_name'], $uploaddir);
          }

        }
        //AGREGA FOTOS NUEVAS QUE NO HABIA CARGADO
        require_once 'agregarFotoNuevaCouch.php';

        datosCouchActualizados();

  //  } aca va el catch!!!!!!!

    }
    else{

    }
  }
  }
  else{
    genericError();
  }

?>
