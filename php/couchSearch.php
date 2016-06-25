<?php

    function basicSearch() {
        return ("SELECT * FROM couch WHERE habilitado = true");
    }

    function geoSearch($cityId) {
        return (" AND idciudad = $cityId");
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

    $couchQuery = basicSearch();

    $couchQuery .= isset($_POST['formCity']) ? geoSearch($_POST['formCity']) : "";
    $couchQuery .= isset($_POST['couchType']) ? typeSearch($_POST['couchType']) : "";
    $couchQuery .= isset($_POST['couchCapacity']) ? capacitySearch($_POST['couchCapacity']) : "";
    $couchQuery .= isset($_POST['couchTitle']) ? titleSearch($_POST['couchTitle']) : "";
    $couchQuery .= isset($_POST['couchDescription']) ? descriptionSearch($_POST['couchDescription']) : "";

?>
