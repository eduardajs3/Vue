<?php
namespace App\Backend\Database;
use PDOException;
use Exception;
use PDO;
class Database {

    private static $instance = null;
    private $conn;

    private $host= 'localhost:3306';
    private $db= 'produtos';
    private $user='root';
    private $pass= 'root';
    private $charset = 'utf8mb4';
   
    public function __construct() {
        
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset$this->charset";
        try{
            $this->conn = new PDO($dsn, $this->user, $this->pass);
        }catch (PDOException $e){
            echo $e->getMessage();
        }

    }

     public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }
}