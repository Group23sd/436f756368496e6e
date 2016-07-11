<?php
  require_once 'database.php';

  class Comentario{
    private $idComent;
    private $fecha;
    private $nombreCouch;
    private $comentario;
    private $respuesta;
    private $nombreUsuario;

  /*  public function __construct($coment, $couchid, $userid){
      $this -> comentario = $coment;
      $today = getdate();
      $fecha = date("$today[year]-$today[mon]-$today[mday] $today[hours]:$today[minutes]:$today[seconds]");
      $this -> fecha = $fecha;//($dia['mday'] . '/' . $dia['mon'] . '/' . $dia['year'] . '  ' .$dia['hours'].':'.$dia['minutes'] );
      $this -> nombreCouch = $couchName;
      $this -> nombreUsuario = $userName;
    }*/

    public function insert($coment, $couchid, $userid){
      $today = getdate();
      $fecha = date("$today[year]-$today[mon]-$today[mday] $today[hours]:$today[minutes]:$today[seconds]");
      $date = array($coment, '', $fecha, $userid, $couchid );
      $sql = "INSERT INTO comentario (pregunta, respuesta, fecha, idusuario, idcouch) VALUES(?, ?, ?, ?, ?)";
      $connect = connectDatabase();
      $statement = $connect-> prepare($sql);
      $statement -> execute($data);


    }

    public function loadData($unArray){
      $this -> idComent = $unArray['idcomentario'];
      $this -> comentario = $unArray['pregunta'];
      $this -> respuesta = $unArray['respuesta'];
      $this -> fecha = $unArray['fecha'];
      $iduser = $unArray['idusuario'];
      $sql = "SELECT * FROM usuario WHERE idusuario = $iduser";
      $inquilino = queryByAssoc($sql);
      $nameuser = $inquilino['nombre'] ." ".$inquilino['apellido'];
      $this -> nombreUsuario = $nameuser;
      $idcouch = $unArray['idcouch'];
      $sql = "SELECT titulo FROM couch WHERE idcouch = $idcouch";
      $namecouch = queryByAssoc($sql);
      $this -> nombreCouch = $namecouch['titulo'];
    }

    public function setRespuesta($unaCadena){
      $id = $this -> getId();
      $sql = "UPDATE comentario SET respuesta = :respuesta WHERE idcomentario = $id";
      $database = connectDatabase();
      $statement = $database -> prepare($sql);
      $statement -> bindParam(':respuesta', $unaCadena, PDO::PARAM_STR);
      $statement -> execute();

      $this -> respuesta = $unaCadena;
    }

    public function getId(){
      return $this -> idComent;
    }

    public function getComentario(){
      return $this -> comentario;
    }
    public function getFecha(){
      return $this -> fecha;
    }
    public function getRespuesta(){
      return $this -> respuesta;
    }
    public function getNombreCouch(){
      return $this -> nombreCouch;
    }
    public function getNombreUsuario(){
      return $this -> nombreUsuario;
    }

  }
?>
