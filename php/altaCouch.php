<?php
  require_once 'feedback.php';

  if(isset($_POST['tituloDelCouch'])){
    require_once 'database.php';
    require_once 'userSession.php';

    $titulo=$_POST['tituloDelCouch'];
    $sql="SELECT * FROM couch WHERE titulo='$titulo'";
    $result= queryAllByAssoc($sql);

    if(!$_SESSION['user'] -> islogged()){
      genericError();
    }
    else{
    if(empty($result)){
      try{
        $idusuario = $_SESSION['user'] -> getId();
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


        $sql = "SELECT * FROM caracteristica";
        $result = queryAllByAssoc($sql);
        $caracteristicas=array();

        foreach ($result as $caract) {
          $idC = $caract['idcaracteristica'];
          if(isset($_POST[$idC])){
              array_push($caracteristicas , $idC);
          }

        }

        $sql ="INSERT INTO couch (titulo , descripcion , precio, capacidad, habilitado, idciudad, idtipo, idusuario) VALUES (:titulo , :descripcion, :precio, :capacidad, :habilitado, :idciudad, :idtipo, :idusuario)";
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
        $idcouch = $database -> lastInsertId();


        //AGREGAR CARACTERISTICAS DEL COUCH
        foreach ($caracteristicas as $idcaracteristica) {
          $data = Array($idcaracteristica, $idcouch);
          $sql = "INSERT INTO caracteristica_couch(idcaracteristica, idcouch) VALUES (?, ?)";
          $database = connectDatabase();
          $statement = $database -> prepare($sql);
          $statement -> execute($data);
        }

        require_once 'agregarFotoNuevaCouch.php';

        couchCargadoExitiosamente();

      }
      catch(Exception $e){
        databaseError();
      }

    }
    else{
      tituloCouchExistente();
    }
  }
  }else{
    genericError();
  }

?>
