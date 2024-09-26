<?php
namespace App\Backend\Repository;

use App\Backend\Database\Database;
use App\Backend\Model\Logs;
use App\Backend\Model\Produto;
use App\Backend\Repository\LogRepository;
use PDO;
use DateTime;
use DateTimeZone;


class ProdutoRepository {
    
    private $conn;
    private $table = "produtos";
    // private $datetime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
    private $datetime;
    private $data_hora; 
    private function atualizarDataHora() {
        
        
$this->datetime = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
        
       
$this->data_hora = $this->datetime->format('Y-m-d H:i:s');
    }

    public function __construct(){
        $this->conn = Database::getInstance();
        // refatorar para chamar setar a data_hora nomomento em que chamar os métodos
        $this->datetime = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
        $this->data_hora = $this->datetime->format('Y-m-d H:i:s');
    }

    public function getProdutoByPreco($preco) {
        $query = "SELECT * FROM $this->table WHERE preco = :preco";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":preco", $preco);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getProdutoByNome($nome) {
        $query = "SELECT * FROM $this->table WHERE nome = :nome";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function insertProduto(Produto $produto){
        // $this->atualizarDataHora();
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $preco = $produto->getPreco();
        $estoque = $produto->getEstoque();
       
        $userInsert = $produto->getUserInsert();
        $data_hora= $this->data_hora;
        $query = "INSERT INTO $this->table(nome,descricao,preco,estoque,userInsert) VALUES (:nome,:descricao,:preco,:estoque,:userInsert)";

        $stmt = $this->conn->prepare($query);       
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":userInsert", $userInsert);

        $result = $stmt->execute();

        if ($result) {
            $this->registrarLog("Criar produto", $this->data_hora, $this->conn->lastInsertId(), $userInsert);
        }

        return $result;
    }

    public function getAllProduto(){
        $query = "SELECT * FROM $this->table";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutoById($produto_id){
        $query = "SELECT * FROM $this->table WHERE produto_id = :produto_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":produto_id", $produto_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduto(Produto $produto){
        // $this->atualizarDataHora();
        $produto_id = $produto->getProdutoId();
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $preco = $produto->getPreco();
        $estoque = $produto->getEstoque();
        $userInsert = $produto->getUserInsert();
        // refatorar para $this->data_hora
        $data_hora= $produto->getData_hora();

        $query = "UPDATE $this->table SET nome = :nome,descricao = :descricao, preco = :preco, estoque = :estoque,  userInsert = :userInsert, data_hora = :data_hora WHERE produto_id = :produto_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":userInsert", $userInsert);
        // refatorar para $this->data_hora no segundo parametro
        $stmt->bindParam(":data_hora", $this->data_hora);
        $stmt->bindParam(":produto_id", $produto_id);

        // refatorar igual ao método insertProduto testar o retorno de  $stmt->execute();
        
        
        $result = $stmt->execute();

        if ($result) {
            $this->registrarLog("Criar produto", $this->data_hora, $this->conn->lastInsertId(), $userInsert);
        }

        return $result;
    }

    public function deleteProduto($produto_id){
        $query = "DELETE FROM $this->table WHERE produto_id = :produto_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":produto_id", $produto_id, PDO::PARAM_INT);
        // $this->atualizarDataHora();
        // refatorar igual ao método insertProduto testar o retorno de  $stmt->execute();
        // return $stmt->execute();

        // $this->registrarLog("Deletar produto", $id, $userInsert);
        $result = $stmt->execute();

        if ($result) {
            $this->registrarLog("Criar produto", $this->data_hora, $this->conn->lastInsertId(), $userInsert);
        }

        return $result;
    }

    public function registrarLog($acao, $data_hora, $produto_id, $userInsert) {
        $log = new Logs($acao, $data_hora, $produto_id, $userInsert);

        $logRepository = new LogRepository();

        $logRepository->createLog($log);
    }
}