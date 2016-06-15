<?php
  class Comentario{
    private $fecha;
    private $comentario;
    private $respuesta;
    public function __construct($coment){
      $this -> comentario = $coment;
      $dia = getdate();
      $this -> fecha = ($dia['mday'] . '/' . $dia['mon'] . '/' . $dia['year'] . '  ' .$dia['hours'].':'.$dia['minutes'] );
    }
    public function setRespuesta($unaCadena){
      $this -> respuesta = $unaCadena;
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
  }
?>
