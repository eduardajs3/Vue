<?php
namespace App\Backend\Controller;

use App\Backend\Model\Produto;
use App\Backend\Repository\ProdutoRepository;
class ProdutoController{
    
    private $repository;

    public function __construct(ProdutoRepository $repository){
        $this->repository = $repository;
    }
    public function create($data) {
     
        if (!isset($data->nome,$data->descricao, $data->preco, $data->estoque,$data->userInsert)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos."]);
            return;
        }
    
        if (strlen($data->nome) <= 3) {
            http_response_code(400);
            echo json_encode(["error" => "O nome deve ter mais de 3 caracteres."]);
            return;
        }
    
        if ($data->preco <= 0) {
            http_response_code(400);
            echo json_encode(["error" => "O preço deve ser maior que 0."]);
            return;
        }

        if ($data->estoque < 0) {
            http_response_code(400);
            echo json_encode(["error" => "O estoque deve ser maior ou igual a 0."]);
            return;
        }
    
        $produtoExistente = $this->repository->getProdutoByNome($data->nome);
        if ($produtoExistente) {
            http_response_code(400);
            echo json_encode(["error" => "Um produto com esse nome já existe."]);
            return;
        }
         
        $produto = new Produto();
        $produto->setNome($data->nome)
                ->setDescricao($data->descricao)
                ->setPreco($data->preco)
                ->setEstoque($data->estoque)
                ->setUserInsert($data->userInsert);

        if ($this->repository->insertProduto($produto)) {
            http_response_code(200);
            echo json_encode(["message" => "Produto criado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar produto."]);
        }
    }

    public function add($data){
        if(!isset($data->nome,$data->preco)){
            http_response_code(400);
            echo json_encode(["error"=> "Nome e preço são necessários para adicionar produto"]);
            return;
        }
        
        $produto = $this->repository->getProdutoByPreco($data->preco);
        if($produto && $produto($data->preco,$produto['preco'])){
            unset($produto['preco']);
            http_response_code(200);
            echo json_encode(["message" => "Produto encontrado.", "produto" => $produto]);
        } else {
            http_response_code(400); 
            echo json_encode(["error" => "produto ou preço inválidos."]);
        }
    }

    public function read($id = null){
        if($id){
            $result =
            $this->repository->getProdutoById($id);
            unset($result['id']);
            $status = $result ? 200 : 404;
        }else{
            $result = $this->repository->getAllProduto();
            foreach ($result as $produto){
                unset($produto['id']);
            }
            unset ($produto);
            $status = !empty($result) ? 200:404;
        }
        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum produto encontrado."]);
    }

    public function update($id, $data) {
      
        if (!isset($data->nome,$data->descricao, $data->preco, $data->estoque,$data->userInsert)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do produto."]);
            return;
        }
    
        if (strlen($data->nome) <= 3) {
            http_response_code(400);
            echo json_encode(["error" => "O nome do produto deve ter mais de 3 caracteres."]);
            return;
        }
    
        if ($data->preco <= 0) {
            http_response_code(400);
            echo json_encode(["error" => "O preço do produto deve ser maior que 0."]);
            return;
        }
    
        if ($data->estoque < 0) {
            http_response_code(400);
            echo json_encode(["error" => "O estoque do produto deve ser maior ou igual a 0."]);
            return;
        }
    
        $produto = new Produto();
        $produto->setProdutoId($id)
                ->setNome($data->nome)
                ->setDescricao($data->descricao)
                ->setPreco($data->preco)
                ->setEstoque($data->estoque)
                ->setUserInsert($data->userInsert);

        if ($this->repository->updateProduto($produto)) {
            http_response_code(200);
            echo json_encode(["message" => "Produto atualizado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar produto."]);
        }
    }
    
    public function delete($id){
        if($this->repository->deleteProduto($id)){
            http_response_code(200);

            echo json_encode(["message"=> "Produto excluído com sucesso"]);
        }else{
            http_response_code(500);
            echo json_encode(["error"=> "Erro ao excluir produto"]);
        }
    }
}