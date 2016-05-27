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
        private $city;
        private $confirmed;
        private $birthday;
        private $picture;
        private $logged;

        public function login($email, $password) {
            $query = "SELECT * FROM usuario WHERE email = '$email'";
            $result = queryByAssoc($query);
            if (password_verify($password, $result['password'])) {
            //    echo 'Correcto';
                $this -> materialize($result);
            } else {
                throw new Exception('Usuario o Password incorrecto');
            }
        }

        private function materialize($anArray) {
            $this -> logged = true;
            $this -> id = $anArray['idusuario'];
            $this -> email = $anArray['email'];
            $this -> firstName = $anArray['nombre'];
            $this -> lastName = $anArray['apellido'];
            $this -> gender = $anArray['sexo'];
            $this -> phoneNumber = $anArray['telefono'];
            $this -> streetName = $anArray['calle'];
            $this -> streetNumber = $anArray['numero'];
            $this -> city = $anArray['idciudad'];
            $this -> confirmed = $anArray['confirmado'];
            $this -> birthday = $anArray['nacimiento'];
            $this -> setPicture($anArray['foto_path']);
        }

        private function setPicture($aPath) {
            $aPath ? $this -> picture = $aPath : $this -> picture = "../images/users/noUserPicture.jpg";
        }

        public function getPicture() {
             return $this -> picture;
        }

        public function screenName() {
            return explode("@", $this -> email)[0];
        }

        public function logout() {
            $this -> logged = false;
        }

        public function isLogged() {
            return $this -> logged;
        }

        public function isConfirmed() {
            return $this -> confirmed;
        }

    }

?>
