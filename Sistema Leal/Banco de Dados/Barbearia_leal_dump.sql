drop database leal;
CREATE DATABASE  IF NOT EXISTS `leal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `leal`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: leal
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
  `Id_Agendamento` int(11) NOT NULL AUTO_INCREMENT,
  `B_Email` varchar(100) NOT NULL,
  `C_Email` VARCHAR(100) NULL,
  `Estado` char(1) NOT NULL,
  `Horario` datetime NOT NULL,
  PRIMARY KEY (`Id_Agendamento`),
  KEY `fk_barbeiro_agendamento` (`B_Email`),
  KEY `fk_cliente_agendamento` (`C_Email`),
  CONSTRAINT `fk_barbeiro_agendamento` FOREIGN KEY (`B_Email`) REFERENCES `barbeiro` (`Email`) ON UPDATE CASCADE,
  CONSTRAINT `fk_cliente_agendamento` FOREIGN KEY (`C_Email`) REFERENCES `cliente` (`Email`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendamento`
--

LOCK TABLES `agendamento` WRITE;
/*!40000 ALTER TABLE `agendamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barbeiro`
--

DROP TABLE IF EXISTS `barbeiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barbeiro` (
  `Nome` varchar(45) NOT NULL,
  `Telefone` bigint(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(45) NOT NULL,
  `Admin` boolean NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barbeiro`
--

LOCK TABLES `barbeiro` WRITE;
/*!40000 ALTER TABLE `barbeiro` DISABLE KEYS */;
/*!40000 ALTER TABLE `barbeiro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `Nome` varchar(45) NOT NULL,
  `Telefone` bigint(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(150) NOT NULL,
  `Endereco` int(11) NOT NULL,
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
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `IDEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `UF` varchar(45) NOT NULL,
  `Cidade` varchar(45) NOT NULL,
  PRIMARY KEY (`IDEndereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque`
--

DROP TABLE IF EXISTS `estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estoque` (
  `IDProduto` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `QTD_Alerta` int(11) NOT NULL,
  `Valor_Venda` float NOT NULL,
  `Venda` tinyint(4) NOT NULL,
  `LIM_Venda` int(11) NOT NULL,
  `Promocao` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDProduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque`
--

LOCK TABLES `estoque` WRITE;
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folga`
--

DROP TABLE IF EXISTS `folga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folga` (
  `Id_Folga` int(11) NOT NULL AUTO_INCREMENT,
  `Inicio` datetime NOT NULL,
  `Fim` datetime NOT NULL,
  `B_Email` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_Folga`),
  KEY `fk_barbeiro_folga` (`B_Email`),
  CONSTRAINT `fk_barbeiro_folga` FOREIGN KEY (`B_Email`) REFERENCES `barbeiro` (`Email`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folga`
--

LOCK TABLES `folga` WRITE;
/*!40000 ALTER TABLE `folga` DISABLE KEYS */;
/*!40000 ALTER TABLE `folga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro financeiro`
--

DROP TABLE IF EXISTS `registro financeiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro financeiro` (
  `ID_Registro` int(11) NOT NULL AUTO_INCREMENT,
  `Valor` decimal(10,2) NOT NULL,
  `Observacao` varchar(100) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Registro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro financeiro`
--

LOCK TABLES `registro financeiro` WRITE;
/*!40000 ALTER TABLE `registro financeiro` DISABLE KEYS */;
/*!40000 ALTER TABLE `registro financeiro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva` (
  `c_Email` VARCHAR(100) NOT NULL,
  `Estoque_IDProduto` int(11) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT current_timestamp(),
  `Estado` char(1) NOT NULL,
  PRIMARY KEY (`c_Email`,`Estoque_IDProduto`),
  KEY `fk_cliente_has_Estoque_Estoque1` (`Estoque_IDProduto`),
  CONSTRAINT `fk_cliente_has_Estoque_Estoque1` FOREIGN KEY (`Estoque_IDProduto`) REFERENCES `estoque` (`IDProduto`) ON UPDATE CASCADE,
  CONSTRAINT `fk_cliente_has_Estoque_cliente1` FOREIGN KEY (`c_Email`) REFERENCES `cliente` (`Email`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Valor` float NOT NULL,
  `Duracao` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos_no_agendamento`
--

DROP TABLE IF EXISTS `servicos_no_agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos_no_agendamento` (
  `agendamento_Id_Agendamento` int(11) NOT NULL,
  `servicos_ID` int(11) NOT NULL,
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
/*!40000 ALTER TABLE `servicos_no_agendamento` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO barbeiro 
(Nome,Telefone, Email, Senha, Admin)
VALUES
("admin","123","admin@example.com","123",true)

-- Dump completed on 2024-04-19 11:56:00
