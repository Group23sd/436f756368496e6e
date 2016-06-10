<?php

    require_once 'database.php';

    class User {

        private $id;
        private $email;
        private $firstName;
        private $lastName;
        private $gender;
        private $phoneNumber;
        private $streetName;
        private $streetNumber;
        private $cityId;
        private $confirmed;
        private $birthday;
        private $picture;
        private $permissions;
        private $timer;
        private $logged;

        public function login($email, $password) {
            $query = "SELECT * FROM usuario WHERE email = '$email'";
            $result = queryByAssoc($query);
            if (password_verify($password, $result['password'])) {
            //    echo 'Correcto';
                $this -> loadData($result);
            } else {
                throw new Exception('Usuario o Password incorrecto');
            }
        }

        public function loadData($anArray) {
            $this -> id = $anArray['idusuario'];
            $this -> email = $anArray['email'];
            $this -> firstName = $anArray['nombre'];
            $this -> lastName = $anArray['apellido'];
            $this -> gender = $anArray['sexo'];
            $this -> phoneNumber = $anArray['telefono'];
            $this -> streetName = $anArray['calle'];
            $this -> streetNumber = $anArray['numero'];
            $this -> cityId = $anArray['idciudad'];
            $this -> confirmed = $anArray['confirmado'];
            $this -> birthday = $anArray['nacimiento'];
            $this -> setPicture($anArray['foto_path']);
            $this -> setPermissions();
            $this -> resetTimer();
            $this -> logged = true;
        }

        public function screenName() {
            return explode("@", $this -> firstName)[0];
        }

        public function getId() {
            return $this -> id;
        }

        public function getEmail() {
            return $this -> email;
        }

        public function setEmail($anEmail) {
            $this -> email = $anEmail;
        }

        public function getFirstName() {
            return $this -> firstName;
        }

        public function setFirstName($aFirstName) {
            $this -> firstName = $aFirstName;
        }

        public function getLastName() {
            return $this -> lastName;
        }

        public function setLastName($aLastName) {
            $this -> lastname = $aLastName;
        }

        public function getGender() {
            return $this -> gender;
        }

        public function setGender($aGender) {
            $this -> gender = $aGender;
        }

        public function getPhoneNumber() {
            return $this -> phoneNumber;
        }

        public function setPhoneNumber($aPhoneNumber) {
            $this -> phoneNumber = $aPhoneNumber;
        }

        public function getStreetName() {
            return $this -> streetName;
        }

        public function setStreetName($aStreetName) {
            $this -> streetName = $aStreetName;
        }

        public function getStreetNumber() {
            return $this -> setStreetNumber;
        }

        public function setStreetNumber($aStreetNumber) {
            $this -> phoneNumber = $aPhoneNumber;
        }

        public function getCityId() {
            return $this -> cityId;
        }

        public function setCityId($aCityId) {
            $this -> cityId = $aCityId;
        }

        public function getCity() {
            $query = "SELECT nombre FROM city WHERE idciudad = '$cityId'";
            $result = queryByAssoc($query);
            return $result['nombre'];
        }

        public function setConfirmed($aBoolean) {
            $this -> confirmed = $aBoolean;
        }

        public function isConfirmed() {
            return $this -> confirmed;
        }

        public function getBirthday() {
            return $this -> birthday;
        }

        public function setBirthday($aDate) {
            $this -> birthday = $aDate;
        }

        public function setPicture($aPath) {
            $aPath ? $this -> picture = $aPath : $this -> picture = "../images/users/noUserPicture.jpg";
        }

        public function getPicture() {
             return $this -> picture;
        }

        public function getPermissions() {
             return $this -> permissions;
        }

        public function setPermissions() {
            $id = $this -> getId();
            $query = "SELECT permiso.nombre FROM usuario INNER JOIN permiso_usuario ON (usuario.idusuario = permiso_usuario.idusuario)
            INNER JOIN permiso ON (permiso_usuario.idpermiso = permiso.idpermiso) WHERE usuario.idusuario = $id";
            $result = queryAllByAssoc($query);
            foreach ($result as $row) {
                $this -> permissions[] = $row['nombre'];
            }

        }

        public function isStandard() {
            if ($this->getPermissions()) {
                return (in_array('standard',$this->getPermissions()) || $this->isPremium() || $this->isAdmin());
            }
        }

        public function isPremium() {
            if ($this->getPermissions()) {
                return (in_array('premium',$this->getPermissions()) || $this->isAdmin());
            }
        }

        public function isAdmin() {
            if ($this->getPermissions()) {
                return in_array('admin',$this->getPermissions());
            }
        }

        public function resetTimer() {
            $this -> timer = time();
        }

        public function isTimeout($aTime) {
            return (time() - $this -> timer) > $aTime;
        }

        public function isLogged() {
            return $this -> logged;
        }

        public function setPremium() {
              $id = $this -> getId();
              $query = "SELECT idpermiso FROM permiso WHERE nombre='premium'";
              $result = queryByAssoc($query);
              $idPermiso = $result["idpermiso"];
               date_default_timezone_set('America/Argentina/Buenos_Aires');
              $today = getdate();
              $fecha = date("$today[year]-$today[mon]-$today[mday] $today[hours]:$today[minutes]:$today[seconds]");
              $data = Array($id,$idPermiso,$fecha);
              $sql = "INSERT INTO permiso_usuario (idusuario,idpermiso,fecha) VALUES (?,?,?)";
              $connect = connectDatabase();
              $statement = $connect-> prepare($sql);
              $statement -> execute($data);
              $this -> setPermissions();
        }

    }

?>
