-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tienda
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
-- Table structure for table `asientos`
--

DROP TABLE IF EXISTS `asientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asientos` (
  `asiento_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(10) NOT NULL,
  `fila` int(11) NOT NULL,
  `columna` int(11) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `sala_fk` int(11) NOT NULL,
  PRIMARY KEY (`asiento_id`),
  KEY `sala_fk` (`sala_fk`),
  CONSTRAINT `sala_fk` FOREIGN KEY (`sala_fk`) REFERENCES `salas` (`sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asientos`
--

LOCK TABLES `asientos` WRITE;
/*!40000 ALTER TABLE `asientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `asientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cines`
--

DROP TABLE IF EXISTS `cines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cines` (
  `cine_id` int(11) NOT NULL AUTO_INCREMENT,
  `sala_num` int(11) NOT NULL,
  `ubicacion` varchar(30) NOT NULL,
  PRIMARY KEY (`cine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cines`
--

LOCK TABLES `cines` WRITE;
/*!40000 ALTER TABLE `cines` DISABLE KEYS */;
/*!40000 ALTER TABLE `cines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cines_productos`
--

DROP TABLE IF EXISTS `cines_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cines_productos` (
  `cine_fk` int(11) NOT NULL,
  `producto_fk` int(11) NOT NULL,
  PRIMARY KEY (`cine_fk`,`producto_fk`),
  KEY `producto_fk` (`producto_fk`),
  CONSTRAINT `cines_productos_ibfk_1` FOREIGN KEY (`cine_fk`) REFERENCES `cines` (`cine_id`),
  CONSTRAINT `cines_productos_ibfk_2` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cines_productos`
--

LOCK TABLES `cines_productos` WRITE;
/*!40000 ALTER TABLE `cines_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cines_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clasificaciones`
--

DROP TABLE IF EXISTS `clasificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clasificaciones` (
  `clasificacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  PRIMARY KEY (`clasificacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificaciones`
--

LOCK TABLES `clasificaciones` WRITE;
/*!40000 ALTER TABLE `clasificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `clasificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes_funciones`
--

DROP TABLE IF EXISTS `clientes_funciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes_funciones` (
  `cliente_fk` int(11) NOT NULL,
  `funcion_fk` int(11) NOT NULL,
  `tipo_pago` varchar(30) NOT NULL,
  PRIMARY KEY (`cliente_fk`,`funcion_fk`),
  KEY `funcion_fk` (`funcion_fk`),
  CONSTRAINT `clientes_funciones_ibfk_1` FOREIGN KEY (`funcion_fk`) REFERENCES `funciones` (`funcion_id`),
  CONSTRAINT `clientes_funciones_ibfk_2` FOREIGN KEY (`cliente_fk`) REFERENCES `clientes` (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_funciones`
--

LOCK TABLES `clientes_funciones` WRITE;
/*!40000 ALTER TABLE `clientes_funciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes_funciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `empleado_id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `rol_fk` int(11) NOT NULL,
  `cine_empleados_fk` int(11) NOT NULL,
  PRIMARY KEY (`empleado_id`),
  KEY `rol_fk` (`rol_fk`),
  KEY `cine_empleados_fk` (`cine_empleados_fk`),
  CONSTRAINT `cine_empleados_fk` FOREIGN KEY (`cine_empleados_fk`) REFERENCES `cines` (`cine_id`),
  CONSTRAINT `rol_fk` FOREIGN KEY (`rol_fk`) REFERENCES `roles` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados_clientes_productos`
--

DROP TABLE IF EXISTS `empleados_clientes_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados_clientes_productos` (
  `empleado_fk` int(11) NOT NULL,
  `cliente_fk` int(11) NOT NULL,
  `producto_fk` int(11) NOT NULL,
  `tipo_pago` varchar(30) NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`empleado_fk`,`cliente_fk`,`producto_fk`),
  KEY `cliente_fk` (`cliente_fk`),
  KEY `producto_fk` (`producto_fk`),
  CONSTRAINT `empleados_clientes_productos_ibfk_1` FOREIGN KEY (`empleado_fk`) REFERENCES `empleados` (`empleado_id`),
  CONSTRAINT `empleados_clientes_productos_ibfk_2` FOREIGN KEY (`cliente_fk`) REFERENCES `clientes` (`cliente_id`),
  CONSTRAINT `empleados_clientes_productos_ibfk_3` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados_clientes_productos`
--

LOCK TABLES `empleados_clientes_productos` WRITE;
/*!40000 ALTER TABLE `empleados_clientes_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleados_clientes_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formatos`
--

DROP TABLE IF EXISTS `formatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formatos` (
  `formato_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) NOT NULL,
  PRIMARY KEY (`formato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formatos`
--

LOCK TABLES `formatos` WRITE;
/*!40000 ALTER TABLE `formatos` DISABLE KEYS */;
/*!40000 ALTER TABLE `formatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funciones`
--

DROP TABLE IF EXISTS `funciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funciones` (
  `funcion_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`funcion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funciones`
--

LOCK TABLES `funciones` WRITE;
/*!40000 ALTER TABLE `funciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `funciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funciones_peliculas`
--

DROP TABLE IF EXISTS `funciones_peliculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funciones_peliculas` (
  `funcion_fk` int(11) NOT NULL,
  `pelicula_fk` int(11) NOT NULL,
  PRIMARY KEY (`funcion_fk`,`pelicula_fk`),
  KEY `pelicula_fk` (`pelicula_fk`),
  CONSTRAINT `funciones_peliculas_ibfk_1` FOREIGN KEY (`funcion_fk`) REFERENCES `funciones` (`funcion_id`),
  CONSTRAINT `funciones_peliculas_ibfk_2` FOREIGN KEY (`pelicula_fk`) REFERENCES `peliculas` (`pelicula_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funciones_peliculas`
--

LOCK TABLES `funciones_peliculas` WRITE;
/*!40000 ALTER TABLE `funciones_peliculas` DISABLE KEYS */;
/*!40000 ALTER TABLE `funciones_peliculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funciones_salas`
--

DROP TABLE IF EXISTS `funciones_salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funciones_salas` (
  `funcion_fk` int(11) NOT NULL,
  `sala_fk` int(11) NOT NULL,
  PRIMARY KEY (`funcion_fk`,`sala_fk`),
  KEY `sala_fk` (`sala_fk`),
  CONSTRAINT `funciones_salas_ibfk_1` FOREIGN KEY (`funcion_fk`) REFERENCES `funciones` (`funcion_id`),
  CONSTRAINT `funciones_salas_ibfk_2` FOREIGN KEY (`sala_fk`) REFERENCES `salas` (`sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funciones_salas`
--

LOCK TABLES `funciones_salas` WRITE;
/*!40000 ALTER TABLE `funciones_salas` DISABLE KEYS */;
/*!40000 ALTER TABLE `funciones_salas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `generos` (
  `genero_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`genero_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (1,'terror'),(2,'fantasia'),(3,'comedia');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lenguajes`
--

DROP TABLE IF EXISTS `lenguajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lenguajes` (
  `lenguaje_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`lenguaje_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lenguajes`
--

LOCK TABLES `lenguajes` WRITE;
/*!40000 ALTER TABLE `lenguajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `lenguajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peliculas`
--

DROP TABLE IF EXISTS `peliculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peliculas` (
  `pelicula_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `duracion` time NOT NULL,
  `clasificacion_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`pelicula_id`),
  KEY `clasificacion_fk` (`clasificacion_fk`),
  CONSTRAINT `clasificacion_fk` FOREIGN KEY (`clasificacion_fk`) REFERENCES `clasificaciones` (`clasificacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peliculas`
--

LOCK TABLES `peliculas` WRITE;
/*!40000 ALTER TABLE `peliculas` DISABLE KEYS */;
/*!40000 ALTER TABLE `peliculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peliculas_formatos`
--

DROP TABLE IF EXISTS `peliculas_formatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peliculas_formatos` (
  `pelicula_fk` int(11) NOT NULL,
  `formato_fk` int(11) NOT NULL,
  PRIMARY KEY (`pelicula_fk`,`formato_fk`),
  KEY `formato_fk` (`formato_fk`),
  CONSTRAINT `peliculas_formatos_ibfk_1` FOREIGN KEY (`pelicula_fk`) REFERENCES `peliculas` (`pelicula_id`),
  CONSTRAINT `peliculas_formatos_ibfk_2` FOREIGN KEY (`formato_fk`) REFERENCES `formatos` (`formato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peliculas_formatos`
--

LOCK TABLES `peliculas_formatos` WRITE;
/*!40000 ALTER TABLE `peliculas_formatos` DISABLE KEYS */;
/*!40000 ALTER TABLE `peliculas_formatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peliculas_generos`
--

DROP TABLE IF EXISTS `peliculas_generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peliculas_generos` (
  `pelicula_fk` int(11) NOT NULL,
  `genero_fk` int(11) NOT NULL,
  PRIMARY KEY (`pelicula_fk`,`genero_fk`),
  KEY `genero_fk` (`genero_fk`),
  CONSTRAINT `peliculas_generos_ibfk_1` FOREIGN KEY (`pelicula_fk`) REFERENCES `peliculas` (`pelicula_id`),
  CONSTRAINT `peliculas_generos_ibfk_2` FOREIGN KEY (`genero_fk`) REFERENCES `generos` (`genero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peliculas_generos`
--

LOCK TABLES `peliculas_generos` WRITE;
/*!40000 ALTER TABLE `peliculas_generos` DISABLE KEYS */;
/*!40000 ALTER TABLE `peliculas_generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peliculas_lenguajes`
--

DROP TABLE IF EXISTS `peliculas_lenguajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peliculas_lenguajes` (
  `pelicula_fk` int(11) NOT NULL,
  `lenguajes` int(11) NOT NULL,
  PRIMARY KEY (`pelicula_fk`,`lenguajes`),
  KEY `lenguajes` (`lenguajes`),
  CONSTRAINT `peliculas_lenguajes_ibfk_1` FOREIGN KEY (`pelicula_fk`) REFERENCES `peliculas` (`pelicula_id`),
  CONSTRAINT `peliculas_lenguajes_ibfk_2` FOREIGN KEY (`lenguajes`) REFERENCES `lenguajes` (`lenguaje_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peliculas_lenguajes`
--

LOCK TABLES `peliculas_lenguajes` WRITE;
/*!40000 ALTER TABLE `peliculas_lenguajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `peliculas_lenguajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salas`
--

DROP TABLE IF EXISTS `salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salas` (
  `sala_id` int(11) NOT NULL AUTO_INCREMENT,
  `sala_num` int(11) NOT NULL,
  `tipo_sala_fk` int(11) DEFAULT NULL,
  `cine_fk` int(11) NOT NULL,
  PRIMARY KEY (`sala_id`),
  KEY `tipo_sala_fk` (`tipo_sala_fk`),
  KEY `cine_fk` (`cine_fk`),
  CONSTRAINT `cine_fk` FOREIGN KEY (`cine_fk`) REFERENCES `cines` (`cine_id`),
  CONSTRAINT `tipo_sala_fk` FOREIGN KEY (`tipo_sala_fk`) REFERENCES `tipo_salas` (`tipo_sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salas`
--

LOCK TABLES `salas` WRITE;
/*!40000 ALTER TABLE `salas` DISABLE KEYS */;
/*!40000 ALTER TABLE `salas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salas_peliculas`
--

DROP TABLE IF EXISTS `salas_peliculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salas_peliculas` (
  `sala_fk` int(11) NOT NULL,
  `pelicula_fk` int(11) NOT NULL,
  PRIMARY KEY (`sala_fk`,`pelicula_fk`),
  KEY `pelicula_fk` (`pelicula_fk`),
  CONSTRAINT `salas_peliculas_ibfk_1` FOREIGN KEY (`pelicula_fk`) REFERENCES `peliculas` (`pelicula_id`),
  CONSTRAINT `salas_peliculas_ibfk_2` FOREIGN KEY (`sala_fk`) REFERENCES `salas` (`sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salas_peliculas`
--

LOCK TABLES `salas_peliculas` WRITE;
/*!40000 ALTER TABLE `salas_peliculas` DISABLE KEYS */;
/*!40000 ALTER TABLE `salas_peliculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_salas`
--

DROP TABLE IF EXISTS `tipo_salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_salas` (
  `tipo_sala_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `capacidad` int(11) NOT NULL,
  PRIMARY KEY (`tipo_sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_salas`
--

LOCK TABLES `tipo_salas` WRITE;
/*!40000 ALTER TABLE `tipo_salas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_salas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-06 22:39:24
