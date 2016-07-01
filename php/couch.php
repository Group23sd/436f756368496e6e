<?php

  class Couch{
    private $id;
    private $titulo;
    private $descripcion;
    private $precio;
    private $capacidad;
    private $habilitado;
    private $ciudad;
    private $tipo;
    private $duenio;
    private $caracteristicas;
    private $fotos;
    private $fotoPortada;
    private $comentarios;
    private $puntajes= array();


    public function loadData($unArray){
        $this -> id = $unArray['idcouch'];
        $this -> titulo = $unArray['titulo'];
        $this -> descripcion = $unArray['descripcion'];
        $this -> precio = $unArray['precio'];
        $this -> capacidad = $unArray['capacidad'];
        $this -> habilitado = $unArray['habilitado'];
        $this -> ciudad = $unArray['idciudad'];
        $this -> tipo = $unArray ['idtipo'];
        $this -> duenio = $unArray['idusuario'];
        $this -> setFotoPortada();
    }


    public function getId(){
      return $this -> id;
    }
    public function setTitulo($unTitulo){
      $this -> titulo=$unTitulo;
    }
    public function getTitulo(){
      return $this -> titulo;
    }
    public function setDescripcion($unaDesc){
      $this -> descripcion = $unaDesc;
    }
    public function getDescripcion(){
      return $this -> descripcion;
    }
      public function setPrecio($unPrecio){
        $this -> precio = $unPrecio;
      }
      public function getPrecio(){
        return $this -> precio;
      }
      public function setCapacidad($unaCapacidad){
        $this -> capacidad = $unaCapacidad;
      }
      public function getCapacidad(){
        return $this -> capacidad;
      }
      public function setHabilitado($unBoolean){
        $this -> habilitado = $unBoolean;
      }
      public function getHabilitado(){
        $this -> habilitado;
      }
      public function setCiudad($nombreCiudad){
        $this -> ciudad = $nombreCiudad;
      }
      public function getCiudad(){
        return $this -> ciudad;
      }
      public function setTipo($unTipo){
        $this -> tipo = $unTipo;
      }
      public function getTipo(){
        return $this -> tipo;
      }
      public function setDuenio($user){
        $this -> duenio = $user;
      }
      public function getDuenio(){
        return $this -> duenio;
      }
      public function setCaracteristica($clave , $valor){
        $this -> caracteristicas[$clave] = $valor;
      }
      public function getCaracteristica($clave){
        $aux = $this -> caracteristicas[$clave];
        if($aux != null){
          return $aux;
        }
      }
      public function unsetCaracteristica($clave){
        unset ($this -> caracteristicas[$clave]);
        }
      public function setFoto($path) {
        array_push($this -> fotos,$path);
      }
      public function unsetFoto($path){
        unset ($this -> fotos[$path]);
      }
      public function getFoto($path){
        $aux = $this -> fotos[$path];
        if($aux != null){
          return $aux;
        }
      }

      public function getFotoPortada(){
        return $this -> fotoPortada;

      }

      public function setFotoPortada(){
        $idc=$this -> getId();
        $query="SELECT * FROM couch INNER JOIN foto ON (couch.idcouch=foto.idcouch) WHERE couch.idcouch='$idc' AND portada=1";
        $resultFoto= queryByAssoc($query);

        if(empty($resultFoto)){
          $this -> fotoPortada='../images/resources/CouchInnLogoCouch.png';

        } else{
          $this -> fotoPortada = $resultFoto['path'];
        }
      }

      public function puntajePromedio(){
        $idCouch = $this -> getId();
        $query = "SELECT avg(puntaje_couch) as puntaje FROM reserva WHERE idcouch=$idCouch";
        $resultPuntaje = queryByAssoc($query);
        $puntajePromedio = $resultPuntaje['puntaje'];
        return round($puntajePromedio,1);
      }
      public function addPuntaje($puntos){
        array_push($this -> puntajes , $puntos);
      }
      public function getComentarios(){
        return $this -> comentarios;
      }
      public function addComentario($coment){
        array_push($this -> comentarios , $coment);
      }
  }
?>
