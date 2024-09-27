<?php
namespace App\Backend\Model;

use App\Backend\Database\Database;
use PDO;

class Logs {
        private $log_id;
        private $acao;
        private $data_hora;
        private $produto_id;
        private $userInsert;
    
        public function __construct($acao, $data_hora, $produto_id, $userInsert) {
            $this->acao = $acao;
            $this->data_hora = $data_hora;
            $this->produto_id = $produto_id;
            $this->userInsert = $userInsert;
        }

        public function getId() {
            return $this->log_id;
        }
        public function setId($log_id): self{ 
            $this->log_id = $log_id;
            return $this;
        }
        public function getAcao() {
            return $this->acao;
        }
        public function setAcao($acao): self{
            $this->acao= $acao;
            return $this;
        }
        public function getData_hora() {
            return $this->data_hora;
        }
        public function setData_hora($data_hora): self{
            $this->data_hora= $data_hora;
            return $this;
        }
        public function getProduto() {
            return $this->produto_id;
        }
        public function setProduto($produto_id): self{
            $this->produto_id= $produto_id;
            return $this;
        }
        public function getUserInsert() {
            return $this->userInsert;
        }
        public function setUserInsert($userInsert): self{
            $this->userInsert= $userInsert;
            return $this;
        }
        
        }
    
    
    
    