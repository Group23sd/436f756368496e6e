  <?php

  require_once 'feedback.php';
  require_once 'database.php';

  if(isset($_POST['idcouch'])){
    require_once 'database.php';
    $idcouch = $_POST['idcouch']   //  CAMBIAR NOMBRE PARAMETRO!!!!!!!!!!!
//    $idcouch = 20;
    try{

      $sql = "SELECT * FROM foto WHERE idcouch = $idcouch";
      $result = queryAllByAssoc($sql);

      if(!empty($result)){
        require_once 'deseaBorrarCouch.php';
      }
      else{
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

  }
    catch(Exception $e){
      databaseError();
    }
  }
  else{
    genericError();
  }

?>
