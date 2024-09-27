<?php
namespace App\Backend;

require_once "../vendor/autoload.php";

header("Content-Type: application/json; charset=UTF-8");

use App\Backend\Controller\LogController;
use App\Backend\Controller\ProdutoController;
use App\Backend\Model\Produto;
use App\Backend\Repository\ProdutoRepository;
use App\Backend\Repository\LogRepository;

$repositoryProduto = new ProdutoRepository();
$controller = new ProdutoController($repositoryProduto);
$logRepository = new LogRepository();
$logController = new LogController($logRepository);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
new LogController($logRepository);
$resposta = null;

switch($method){
    case 'GET':
            if(preg_match('/\/produtos\/(\d+)/', $uri, $match)){
                $id = $match[1];
                $data = json_decode(file_get_contents('php://input'));
                $controller->read($id);
                break;
            }
            
            if($uri == "/produtos"){
                $controller->read();
            }

            if($uri == "/logs"){
                $logController->getAllLog();
            }
            
    break;
    case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                $controller->create($data);
                
    break;
    case 'PUT':
            if(preg_match('/\/produtos\/(\d+)/', $uri, $match)){
                $id = $match[1];
                $data = json_decode(file_get_contents('php://input'));
                $controller->update($id, $data);
            }
    break;
    case 'DELETE':
            if(preg_match('/\/produtos\/(\d+)/', $uri, $match)){
                $id = $match[1];
                $controller->delete($id);
            }
    break;
    default:
    echo json_encode(["Método invalido"]);
}