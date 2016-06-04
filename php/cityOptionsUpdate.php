<?php
    require_once "database.php";
    require_once "userSession.php";
    $idusuario = $_SESSION['user']->getId();
    $id = $_GET['id'];
    $sql = "SELECT idciudad FROM usuario WHERE idusuario = $idusuario";
    $resultciudad = queryByAssoc($sql);
    $idciudadr = $resultciudad['idciudad'];
    $query = "SELECT c.idciudad, c.nombre, c.region FROM ciudad c WHERE c.idpais = $id ORDER BY c.nombre";
    $result = queryAllByAssoc($query);
    echo "<option hidden>Ciudad</option>";
    foreach ($result as $row) {
        $sel = ' ';
        if ($row['idciudad'] == $idciudadr) {
            $sel = 'selected';
        }
        echo "<option ".$sel." value=".$row['idciudad'].">".$row['nombre'].", ".$row['region']."</option>";
    }
?>
