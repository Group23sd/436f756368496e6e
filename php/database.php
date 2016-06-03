<?php

    function connectDatabase() {
        try {
            $db = new PDO("mysql:host=localhost;dbname=couchinndb","laureano","lanatta", array(PDO::ATTR_PERSISTENT=>true));
            $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
        catch (PDOException $e) {
            //Placeholder
            echo "<script type='text/javascript'>alert('".$e->getMessage()."');";
            echo "window.location='index.php'</script>";
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
