<?php

require_once("lib/db_config.php");

class DBWrapper{

    private $connection;

    public function __construct(){

        try{

            $this->connection = new PDO("mysql:" . $GLOBALS["host"] . ";dbname=" . $GLOBALS["dbname"] . ";charset=utf8", $GLOBALS["username"], $GLOBALS["pwd"]);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        }catch(PDOException $pdoe){
    
            echo $pdoe->getMessage();
    
        }

    }

    public function get_connection(): PDO{

        return $this->connection;

    }

    public function __destruct(){

        $this->connection = NULL;

    }

}

?>