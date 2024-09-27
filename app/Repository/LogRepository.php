<?php
namespace App\Backend\Repository;

use App\Backend\Database\Database;
use PDO;
use DateTime;
use DateTimeZone;

class LogRepository {

    private $conn;
    private $table = "logs";
    private $datetime;
    private $data_hora;

    public function __construct(){
        $this->conn = Database::getInstance();
        $this->datetime = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
        $this->data_hora = $this->datetime->format('Y-m-d H:i:s');
    }

    public function createLog($log) {
        $acao = $log->getAcao();
        $produto_id = $log->getProduto();
        $userInsert = $log->getUserInsert();
        
        $query = "INSERT INTO $this->table (acao, data_hora, produto_id, userInsert) VALUES (:acao,  :data_hora, :produto_id, :userInsert)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":acao", $acao);
        $stmt->bindParam(":data_hora", $this->data_hora);
        $stmt->bindParam(":produto_id", $produto_id, PDO::PARAM_INT);
        $stmt->bindParam(":userInsert", $userInsert);

        return $stmt->execute();
    }

    public function getAllLog() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}