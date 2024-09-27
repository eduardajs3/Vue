CREATE DATABASE  IF NOT EXISTS `produtos`;
USE `produtos`;


CREATE TABLE `logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `acao` text NOT NULL,
  `data_hora` datetime DEFAULT CURRENT_TIMESTAMP,
  `produto_id` int DEFAULT NULL,
  `userInsert` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `produtos` (
  `produto_id` int NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `descricao` text,
  `preco` double NOT NULL,
  `estoque` int NOT NULL,
  `userInsert` int NOT NULL DEFAULT '0',
  `data_hora` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`produto_id`),
  CONSTRAINT `produtos_chk_1` CHECK ((char_length(`nome`) >= 3)),
  CONSTRAINT `produtos_chk_2` CHECK ((`preco` > 0)),
  CONSTRAINT `produtos_chk_3` CHECK ((`estoque` >= 0))
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;