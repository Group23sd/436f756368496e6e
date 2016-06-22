<?php

    function geoSearch($cityId) {
        return (" WHERE idciudad = $cityId");
    }

    function typeSearch($typeId) {
        return ($typeId != "") ? (" AND idtipo = $typeId") : "";
    }

    function capacitySearch($aNumber) {
        return ($aNumber != "") ? (" AND capacidad = $aNumber") : "";
    }

    function titleSearch($aString) {
        return ($aString != "") ? (" AND titulo = '$aString'") : "";
    }

    function descriptionSearch($aString) {
        return ($aString != "") ? (" AND descripcion = '$aString'") : "";
    }

    $couchQuery = "SELECT * FROM couch";

    $couchQuery .= isset($_POST['formCity']) ? geoSearch($_POST['formCity']) : "";
    $couchQuery .= isset($_POST['couchType']) ? typeSearch($_POST['couchType']) : "";
    $couchQuery .= isset($_POST['couchCapacity']) ? capacitySearch($_POST['couchCapacity']) : "";
    $couchQuery .= isset($_POST['couchTitle']) ? titleSearch($_POST['couchTitle']) : "";
    $couchQuery .= isset($_POST['couchDescription']) ? descriptionSearch($_POST['couchDescription']) : "";

?>
