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

    function queryByAssoc($query) {
        $database = connectDatabase();
        $statement = $database -> prepare($query);
        $statement -> execute();
        return $statement -> fetch(PDO::FETCH_ASSOC);
    }

?>
