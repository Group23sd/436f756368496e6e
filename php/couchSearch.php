<?php

    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    function basicSearch() {
        return ("SELECT * FROM couch c WHERE habilitado = true");
    }

    function countrySearch($idpais) {
        return ($idpais != "") ? (" AND c.idciudad IN (SELECT ciudad.idciudad FROM ciudad WHERE idpais = $idpais)") : "";
    }

    function citySearch($idciudad) {
        return ($idciudad != "") ? (" AND c.idciudad = $idciudad") : "";
    }

    function typeSearch($idtipo) {
        return ($idtipo != "") ? (" AND c.idtipo = $idtipo") : "";
    }

    function capacitySearch($capacidad) {
        return ($capacidad != "") ? (" AND c.capacidad = $capacidad") : "";
    }

    function titleSearch($aString) {
        return ($aString != "") ? (" AND c.titulo = :titulo") : "";
    }

    function descriptionSearch($aString) {
        return ($aString != "") ? (" AND c.descripcion = :descripcion") : "";
    }

    function characteristicSearch($caracteristicas) {
        $subQuery = "";
        foreach ($caracteristicas as $value) {
            $subQuery .= " AND $value IN (SELECT cc.idcaracteristica FROM caracteristica_couch cc WHERE cc.idcouch=c.idcouch)";
        }
        return $subQuery;
    }

    $couchQuery = basicSearch();
    $couchQuery .= isset($_POST['formCountry']) ? countrySearch($_POST['formCountry']) : "";
    $couchQuery .= isset($_POST['formCity']) ? citySearch($_POST['formCity']) : "";
    $couchQuery .= isset($_POST['couchType']) ? typeSearch($_POST['couchType']) : "";
    $couchQuery .= isset($_POST['couchCapacity']) ? capacitySearch($_POST['couchCapacity']) : "";
//    $couchQuery .= isset($_POST['couchTitle']) ? titleSearch($_POST['couchTitle']) : "";
//    $couchQuery .= isset($_POST['couchDescription']) ? descriptionSearch($_POST['couchDescription']) : "";
    $couchQuery .= isset($_POST['caracteristicas']) ? characteristicSearch($_POST['caracteristicas']) : "";
    
    $database = connectDatabase();

    if (isset($_POST['couchTitle']) && $_POST['couchTitle']) {
        $couchQuery .= " AND c.titulo LIKE concat('%', :titulo, '%')";
    }

    if (isset($_POST['couchDescription']) && $_POST['couchDescription']) {
        $couchQuery .= " AND c.descripcion LIKE concat('%', :descripcion, '%')";
    }

    $statement = $database -> prepare($couchQuery);

    if (isset($_POST['couchTitle']) && $_POST['couchTitle']) {
        $titulo = $_POST['couchTitle'];
        $statement -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
    }

    if (isset($_POST['couchDescription']) && $_POST['couchDescription']) {
        $descripcion = $_POST['couchDescription'];
        $statement -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    }

    $statement -> execute();

    require_once 'listarCouch.php';

?>
