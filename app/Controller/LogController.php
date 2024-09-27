<?php
namespace App\Backend\Controller;

use App\Backend\Repository\LogRepository;

class LogController {

    private $logRepository;

    public function __construct(LogRepository $logRepository) {
        $this->logRepository = $logRepository;
    }

    public function getAllLog()  {
        $result = $this->logRepository->getAllLog();  

        http_response_code(200);

        echo json_encode([
            "status" => true,
            "message" => "todos os logs",
            "data" => $result
        ]);
    }
    
}
