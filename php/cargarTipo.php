<?php
  require_once 'feedback.php';
    if(isset($_POST['nombreDelTipo'])){
      require_once 'database.php';
      $nuevoTipo= $_POST['nombreDelTipo'];
      $query="SELECT * FROM tipo WHERE descripcion='$nuevoTipo'";
      $result=queryAllByAssoc($query);

      if(empty($result)){
        try{

          $data = array($nuevoTipo);
          $sql = "INSERT INTO tipo (descripcion) VALUES (?)";
          $database = connectDatabase();
          $statement = $database -> prepare($sql);
          $statement -> execute($data);

          tipoDeCouchCargadoExitosamente();

      }
      catch (Exception $e) {
          databaseError();
      }
      }
      else{
        tipoDeCouchExistente();
      }
  }

?>
