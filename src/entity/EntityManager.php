<?php
namespace App\Entity;

use App\Exception\AuthenticationException;

class EntityManager 
{   
    // Constants
    // Database access
    const DRIVER = "mysql";
    const HOST = "localhost";
    const PORT = "3306";
    const BASE = "site_hinode";
    const LOGIN = "hinode";
    const PASSWORD = "kJMg7uBfg6ZZ2QPx";
    // Class attributes
    private static $instance = null;
    // Attributes
    private $config;
    private $PDO;

    // Class methods :
    private function __construct()
    {   // Tries to establish a connection with the database 
        $this->config = require "src/Config/Database.conf.php";
        try {
            $this->PDO = new \PDO($this->config["driver"]
                                        . ':host=' . $this->config["host"]
                                        . ';port=' . $this->config["port"]
                                        . ';dbname=' . $this->config["name"]
                                        . ';charset=UTF8'
                                        , $this->config["login"]
                                        , $this->config["password"]);
        } catch(PDOException $error) {
            //TODO: Redirect to error page
            echo "Connexion echouée : " . $error->getMessage();
            exit;
        }
    }

    public static function getInstance() : self
    {   // Avoiding 2 simultaneous connection to the DB
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance; 
    }

    public function getPDO() : \PDO
    {
        return $this->PDO;
    }
}
