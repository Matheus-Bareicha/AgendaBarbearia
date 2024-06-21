CREATE DATABASE  IF NOT EXISTS `leal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `leal`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: leal
-- ------------------------------------------------------
-- Server version	8.4.0

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
-- Table structure for table `agendamento`
--

DROP TABLE IF EXISTS `agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agendamento` (
  `Id_Agendamento` int NOT NULL AUTO_INCREMENT,
  `B_Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `C_Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Estado` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `Horario` datetime NOT NULL,
  PRIMARY KEY (`Id_Agendamento`),
  KEY `fk_barbeiro_agendamento` (`B_Email`),
  KEY `fk_cliente_agendamento` (`C_Email`),
  CONSTRAINT `fk_barbeiro_agendamento` FOREIGN KEY (`B_Email`) REFERENCES `barbeiro` (`Email`) ON UPDATE CASCADE,
  CONSTRAINT `fk_cliente_agendamento` FOREIGN KEY (`C_Email`) REFERENCES `cliente` (`Email`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendamento`
--

LOCK TABLES `agendamento` WRITE;
/*!40000 ALTER TABLE `agendamento` DISABLE KEYS */;
INSERT INTO `agendamento` VALUES (1,'admin@example.com','matheusbareich@gmail.com','C','2024-06-20 16:00:00');
/*!40000 ALTER TABLE `agendamento` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_agendamento_update` AFTER UPDATE ON `agendamento` FOR EACH ROW BEGIN
    DECLARE total DECIMAL(10, 2);

    -- Verifica se o estado foi alterado para 'R'
    IF NEW.Estado = 'R' THEN
        -- Calcula o valor total dos serviços associados ao agendamento
        SELECT SUM(s.Valor)
        INTO total
        FROM servicos_no_agendamento sna
        JOIN servicos s ON sna.servicos_ID = s.ID
        WHERE sna.agendamento_Id_Agendamento = NEW.Id_Agendamento;
        
        -- Insere o valor total na tabela registro_financeiro
        INSERT INTO registro_financeiro (Valor, Observacao)
        VALUES (total, CONCAT('Agendamento ', NEW.Id_Agendamento));
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `barbeiro`
--

DROP TABLE IF EXISTS `barbeiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barbeiro` (
  `Nome` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `Telefone` bigint NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Senha` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barbeiro`
--

LOCK TABLES `barbeiro` WRITE;
/*!40000 ALTER TABLE `barbeiro` DISABLE KEYS */;
INSERT INTO `barbeiro` VALUES ('admin',123,'admin@example.com','123',1),('wanderson',99999999999,'wanderson@example.com','1234',0);
/*!40000 ALTER TABLE `barbeiro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `Nome` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `Telefone` bigint NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Senha` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `Endereco` int NOT NULL,
  PRIMARY KEY (`Email`),
  KEY `fk_cliente_endereco` (`Endereco`),
  CONSTRAINT `fk_cliente_endereco` FOREIGN KEY (`Endereco`) REFERENCES `endereco` (`IDEndereco`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES ('amdin',123456789,'admin@example.com','123',2),('matheus',61999999999,'matheusbareich@gmail.com','123',1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `IDEndereco` int NOT NULL AUTO_INCREMENT,
  `UF` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `Cidade` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`IDEndereco`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,'','guara'),(2,'','ceilandia');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque`
--

DROP TABLE IF EXISTS `estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estoque` (
  `IDProduto` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Quantidade` int NOT NULL,
  `QTD_Alerta` int NOT NULL,
  `Preco` float NOT NULL,
  `LIM_Venda` int NOT NULL,
  `Promocao` int DEFAULT '0',
  PRIMARY KEY (`IDProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque`
--

LOCK TABLES `estoque` WRITE;
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` VALUES (1,'asd',10,3,45,5,20),(2,'oleo para barba',10,3,20,5,0),(3,'shampoo',20,5,40,10,0),(4,'condicionador',20,5,40,10,0),(5,'barbeador',10,3,60,4,0);
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folga`
--

DROP TABLE IF EXISTS `folga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folga` (
  `Id_Folga` int NOT NULL AUTO_INCREMENT,
  `Inicio` datetime NOT NULL,
  `Fim` datetime NOT NULL,
  `B_Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_Folga`),
  KEY `fk_barbeiro_folga` (`B_Email`),
  CONSTRAINT `fk_barbeiro_folga` FOREIGN KEY (`B_Email`) REFERENCES `barbeiro` (`Email`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folga`
--

LOCK TABLES `folga` WRITE;
/*!40000 ALTER TABLE `folga` DISABLE KEYS */;
INSERT INTO `folga` VALUES (11,'2024-05-15 08:00:00','2024-05-15 11:00:00','admin@example.com');
/*!40000 ALTER TABLE `folga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_financeiro`
--

DROP TABLE IF EXISTS `registro_financeiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro_financeiro` (
  `ID_Registro` int NOT NULL AUTO_INCREMENT,
  `Valor` decimal(10,2) NOT NULL,
  `Observacao` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_Registro`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_financeiro`
--

LOCK TABLES `registro_financeiro` WRITE;
/*!40000 ALTER TABLE `registro_financeiro` DISABLE KEYS */;
INSERT INTO `registro_financeiro` VALUES (1,50.00,'teste','2024-05-06 22:12:22'),(2,12.22,'teste','2024-05-09 01:45:30'),(3,0.12,'123','2024-05-09 01:48:31'),(4,1.23,'123','2024-05-09 01:48:33'),(5,1.23,'123','2024-05-09 01:48:35'),(6,1.23,'123','2024-05-09 01:48:37'),(7,1.23,'123','2024-05-09 01:48:40'),(8,1.23,'123','2024-05-09 01:48:42'),(9,1.23,'123','2024-05-09 01:48:44'),(10,1.23,'123','2024-05-09 01:48:48'),(11,1.23,'123','2024-05-09 01:48:51'),(12,1.23,'123','2024-05-09 01:48:55'),(13,35.00,'corte','2024-05-14 21:44:21'),(14,98.66,'cliente y','2024-05-18 13:45:46'),(15,-23.45,'fg','2024-05-18 15:14:30'),(16,75.00,'Agendamento 21','2024-06-20 18:44:00'),(17,75.00,'Agendamento 1','2024-06-20 18:54:15');
/*!40000 ALTER TABLE `registro_financeiro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva` (
  `c_Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Estoque_IDProduto` int NOT NULL,
  `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QTD` int NOT NULL,
  `Estado` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`c_Email`,`Estoque_IDProduto`,`Data`),
  KEY `fk_cliente_has_Estoque_Estoque1` (`Estoque_IDProduto`),
  CONSTRAINT `fk_cliente_has_Estoque_cliente1` FOREIGN KEY (`c_Email`) REFERENCES `cliente` (`Email`) ON UPDATE CASCADE,
  CONSTRAINT `fk_cliente_has_Estoque_Estoque1` FOREIGN KEY (`Estoque_IDProduto`) REFERENCES `estoque` (`IDProduto`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
INSERT INTO `reserva` VALUES ('admin@example.com',1,'2024-05-10 17:55:52',2,'P'),('admin@example.com',2,'2024-05-10 17:55:52',2,'P'),('admin@example.com',3,'2024-05-10 17:55:52',3,'P'),('admin@example.com',4,'2024-05-10 17:55:52',3,'P'),('matheusbareich@gmail.com',1,'2024-05-10 16:43:52',2,'P'),('matheusbareich@gmail.com',1,'2024-05-10 17:54:36',1,'P'),('matheusbareich@gmail.com',1,'2024-05-10 17:57:07',1,'P'),('matheusbareich@gmail.com',1,'2024-05-14 21:55:21',1,'P'),('matheusbareich@gmail.com',1,'2024-05-18 14:29:56',2,'P'),('matheusbareich@gmail.com',1,'2024-05-18 14:30:12',2,'P'),('matheusbareich@gmail.com',2,'2024-05-10 16:43:52',2,'P'),('matheusbareich@gmail.com',2,'2024-05-10 17:54:36',2,'P'),('matheusbareich@gmail.com',2,'2024-05-10 17:57:07',1,'P'),('matheusbareich@gmail.com',2,'2024-05-14 21:55:21',3,'P'),('matheusbareich@gmail.com',2,'2024-05-18 14:30:12',1,'P'),('matheusbareich@gmail.com',3,'2024-05-10 16:43:52',1,'P'),('matheusbareich@gmail.com',3,'2024-05-10 17:54:36',1,'P'),('matheusbareich@gmail.com',3,'2024-05-10 17:57:07',1,'P'),('matheusbareich@gmail.com',3,'2024-05-14 21:55:21',1,'P'),('matheusbareich@gmail.com',3,'2024-05-18 14:30:13',1,'P'),('matheusbareich@gmail.com',4,'2024-05-10 17:45:47',1,'P'),('matheusbareich@gmail.com',4,'2024-05-10 17:54:36',2,'P'),('matheusbareich@gmail.com',4,'2024-05-10 17:57:07',1,'P'),('matheusbareich@gmail.com',4,'2024-05-14 21:55:21',1,'P');
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Valor` float NOT NULL,
  `Duracao` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1,'hidratação',15,'20'),(2,'corte + barba',50,'60'),(3,'corte',40,'30'),(4,'barba',30,'30');
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos_no_agendamento`
--

DROP TABLE IF EXISTS `servicos_no_agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos_no_agendamento` (
  `agendamento_Id_Agendamento` int NOT NULL,
  `servicos_ID` int NOT NULL,
  PRIMARY KEY (`agendamento_Id_Agendamento`,`servicos_ID`),
  KEY `fk_agendamento_has_servicos_servicos1` (`servicos_ID`),
  CONSTRAINT `fk_agendamento_has_servicos_agendamento1` FOREIGN KEY (`agendamento_Id_Agendamento`) REFERENCES `agendamento` (`Id_Agendamento`) ON UPDATE CASCADE,
  CONSTRAINT `fk_agendamento_has_servicos_servicos1` FOREIGN KEY (`servicos_ID`) REFERENCES `servicos` (`ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos_no_agendamento`
--

LOCK TABLES `servicos_no_agendamento` WRITE;
/*!40000 ALTER TABLE `servicos_no_agendamento` DISABLE KEYS */;
INSERT INTO `servicos_no_agendamento` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `servicos_no_agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'leal'
--

--
-- Dumping routines for database 'leal'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-21 13:46:45
