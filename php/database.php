<?php
    require_once 'feedback.php';
    function connectDatabase() {
        try {
            $db = new PDO("mysql:host=127.0.0.1;dbname=CouchInnDB","root","1234", array(PDO::ATTR_PERSISTENT=>true));
            $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
        catch (PDOException $e) {
            databaseError();
            exit();
        }
    }
    function queryByAssoc($sql) {
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> execute();
        return $statement -> fetch(PDO::FETCH_ASSOC);
    }
    function queryAllByAssoc($sql) {
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> execute();
        return $statement -> fetchAll(PDO::FETCH_ASSOC);
    }
?>
