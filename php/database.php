<?php

    function connectDatabase() {
        try {
            $db = new PDO("mysql:host=127.0.0.1;dbname=CouchInnDB","root","1234", array(PDO::ATTR_PERSISTENT=>true));
            return $db;
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die('Intente más tarde!');
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
