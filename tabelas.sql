CREATE DATABASE  IF NOT EXISTS `produtos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `produtos`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: produtos
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `acao` text NOT NULL,
  `data_hora` datetime DEFAULT CURRENT_TIMESTAMP,
  `produto_id` int DEFAULT NULL,
  `userInsert` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

-- LOCK TABLES `produtos` WRITE;
-- /*!40000 ALTER TABLE `produtos` DISABLE KEYS */;NSERT INTO `produtos` VALUES (1,'sandalias',NULL,124,34,0,'2024-09-22 22:03:01'),(2,'calca','calca jeans',140,20,1,'2024-09-22 22:04:42'),(3,'casaco','casaco de veludo',150,15,1,'2024-09-22 22:04:42'),(4,'blusa','blusa de frio',70,25,1,'2024-09-22 22:04:42'),(9,'camisa amarela','camisa preta',12,13,1,NULL),(11,'camisa rosas','camisa pretas',12,13,1,'2024-09-12 22:04:23'),(12,'calca rosas','camisa pretas',12,13,1,'2024-09-12 22:04:23'),(13,'calca azul','camisa pretas',12,13,1,'2024-09-12 22:04:23'),(14,'sapato azul','camisa pretas',12,13,1,'2024-09-12 22:04:23'),(15,'sapato amarelo','camisa pretas',12,13,1,'2024-09-12 22:04:23'),(16,'blusa amarela','camisa pretas',12,13,1,'2024-09-12 22:04:23'),(17,'colar amarela','camisa pretas',12,13,1,'2024-09-12 22:04:23'),(18,'meia amarela','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(19,'calca marela','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(20,'calca ','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(21,'calca preta ','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(23,'blusa vinho ','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(24,'meia vermelha ','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(25,'meias vermelha ','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(26,'meias vermelhas ','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(27,'meias vermelhas ','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(28,'meias vermelhas ','meias de algodao',12,13,1,'2024-09-12 22:04:23'),(29,' vermelhas ','meias de algodao',12,13,1,'2024-09-12 22:04:23');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
-- UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-24 10:10:21

I