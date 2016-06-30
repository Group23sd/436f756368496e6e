  <?php

  require_once 'feedback.php';
  require_once 'database.php';

  if(isset($_GET['id'])){
    require_once 'database.php';
    $idcouch = $_GET['id'];

  //  try{

        $sql = "SELECT * FROM reserva WHERE idcouch = $idcouch";
        $result = queryAllByAssoc($sql);
        if(empty($result)){
          $cantReservas = 0;
        }
        else{
          $cantReservas  = count($result);
        }

        $sePuedenBorrar = 0;
          foreach ($result as $reserva) {
            $idR = $reserva['idreserva'];
            $sql = "SELECT * FROM estado WHERE idreserva = $idR";
            $estadosDeR = queryAllByAssoc($sql);

            foreach ($estadosDeR as $row) {
              if(($row['nombre'] == 'Rechazado') || ($row['nombre'] == 'Cancelado') || ($row['nombre'] == 'Liberado')){
                $sePuedenBorrar++;
              }
            }
          }

      if($cantReservas == $sePuedenBorrar){
        //el couch se puede borrar
        foreach ($result as $reserva) {
          $idR = $reserva['idreserva'];
          $sql = "DELETE FROM estado WHERE idreserva = $idR";
          $database = connectDatabase();
          $statement = $database -> prepare($sql);
          $statement -> bindParam(': idreserva' , $idR , PDO::PARAM_INT);
          $statement -> execute();
        }

        $sql = "DELETE FROM reserva WHERE idcouch = $idcouch";
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> bindParam(': idcouch' , $idcouch , PDO::PARAM_INT);
        $statement -> execute();

        $sql = "DELETE FROM foto WHERE idcouch = $idcouch";
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> bindParam(': idcouch' , $idcouch , PDO::PARAM_INT);
        $statement -> execute();

        $sql = "DELETE FROM caracteristica_couch WHERE idcouch = $idcouch";
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> bindParam(': idcouch' , $idcouch , PDO::PARAM_INT);
        $statement -> execute();

        $sql = "DELETE FROM couch WHERE idcouch = $idcouch";
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> bindParam(': idcouch' , $idcouch , PDO::PARAM_INT);
        $statement -> execute();

        couchEliminadoCorrectamente();
      }

      else{
        $sql = "SELECT * FROM couch WHERE idcouch = $idcouch";
        $result = queryByAssoc($sql);
        $habilitado = $result['habilitado'];

        if ($habilitado) {
          $nuevoEstado = false;
          $sql = "UPDATE couch SET habilitado = :habilitado WHERE idcouch = :idcouch";
          $database = connectDatabase();
          $statement = $database -> prepare($sql);
          $statement -> bindParam(':idcouch', $idcouch, PDO::PARAM_INT);
          $statement -> bindParam(':habilitado', $nuevoEstado, PDO::PARAM_BOOL);
          $statement -> execute();
        }
        noSePudoEliminarSuCouch();

      }

/*  }
    catch(Exception $e){
      databaseError();
    }*/
  }
  else{
    genericError();
  }

?>
