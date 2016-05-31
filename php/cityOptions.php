<?php
    require_once "database.php";
    $id = $_GET['id'];
    $query = "SELECT c.idciudad, c.nombre, c.region FROM ciudad c WHERE c.idpais = $id ORDER BY c.nombre";
    $result = queryAllByAssoc($query);
    echo "<option hidden>Ciudad</option>";
    foreach ($result as $row) {
        echo "<option value=".$row['idciudad'].">".$row['nombre'].", ".$row['region']."</option>";
    }
?>
