<?php
namespace App\Backend\Model;

use App\Backend\Database\Database;
use PDO;

class Produto{
    private $produto_id;
    private $nome;
    private $descricao;
    private $preco;
    private $estoque;
    private $userInsert;
    private $data_hora;
    private $conn;

    public function __construct() {}
    
    public function getProdutoId() {
        return $this->produto_id;
    }
    public function setProdutoId($produto_id): self{ 
        $this->produto_id = $produto_id;
        return $this;
    }
    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome): self{
        $this->nome= $nome;
        return $this;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function setDescricao($descricao): self{
        $this->descricao = $descricao;
        return $this;
    }
    public function getPreco(){
        return $this->preco;
    }
    public function setPreco($preco): self{ 
        $this->preco = $preco;
        return $this;
    }
    public function getEstoque(){
        return $this->estoque;
    }
    public function setEstoque($estoque): self{
        $this->estoque = $estoque;
        return $this;
    }
    public function getUserInsert(){
        return $this->userInsert;
    }
    public function setUserInsert($userInsert): self{
        $this->userInsert = $userInsert;
        return $this;
    }
    public function getData_hora(){
        return $this->data_hora;
    }
    public function setData_hora($data_hora): self{
        $this->data_hora = $data_hora;
        return $this;
    }

}
