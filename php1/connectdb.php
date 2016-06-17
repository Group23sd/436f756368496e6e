<?php
function connectDatabase() {
  try {
      $db = new PDO("mysql:host=localhost;dbname=CouchInnDB","laureano","lanatta", array(PDO::ATTR_PERSISTENT=>true));
      return $db;
  }
  catch (PDOException $e) {
    try{
      $db = new PDO("mysql:host=localhost;dbname=CouchInnDB","root","1234", array(PDO::ATTR_PERSISTENT=>true));
      return $db;
    }
    catch (PDOException $e) {
      try{
        $db = new PDO("mysql:host=localhost;dbname=CouchInnDB","root","nico943", array(PDO::ATTR_PERSISTENT=>true));
        return $db;
      }
      catch(PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        die('Intente más tarde!');
      }
    }
  }
}
function queryByAssoc($query) {
    $database = connectDatabase();
    $statement = $database -> prepare($query);
    $statement -> execute();
    return $statement -> fetch(PDO::FETCH_ASSOC);
}
function queryAllByAssoc($query) {
    $database = connectDatabase();
    $statement = $database -> prepare($query);
    $statement -> execute();
    return $statement -> fetchAll(PDO::FETCH_ASSOC);
}
?>
