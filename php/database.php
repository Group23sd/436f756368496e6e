<?php

    function connectDatabase() {
        try {
            $db = new PDO("mysql:host=localhost;dbname=couchinndb","laureano","lanatta", array(PDO::ATTR_PERSISTENT=>true));
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

    function insertRow($sql) {
        $database = connectDatabase();
        $statement = $database -> prepare($sql);
        $statement -> execute();
    }

?>
