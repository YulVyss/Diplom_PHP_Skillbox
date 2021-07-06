-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fashion
-- ------------------------------------------------------
-- Server version	8.0.15

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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `summ` int(11) NOT NULL,
  `delivery` varchar(45) NOT NULL,
  `payment` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `addresss` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `activity` tinyint(1) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `new` tinyint(1) DEFAULT NULL,
  `sale` tinyint(1) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `c_category_id_idx1` (`category_id`),
  CONSTRAINT `c_category_id` FOREIGN KEY (`category_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'платье с длинными рукавами',3999,1,'product-1.jpg',1,1,1),(2,'платье короткое без рукавов',3599,1,'product-6.jpg',1,0,1),(3,'ботильоны',5999,1,'product-9.jpg',0,1,1),(4,'туника',2500,1,'product-8.jpg',1,1,1),(5,'джинсы',4366,1,'jeans.jpg',0,1,2),(6,'босоножки на каблуке',3999,1,'bosonogki.jpg',1,0,5),(7,'сапоги черные',2799,1,'product-1.jpg',0,1,5),(8,'рубашка',1500,1,'product-2.jpg',0,1,1),(9,'шорты',2699,1,'product-2.jpg',1,0,1),(10,'часы',9099,1,'product-3.jpg',0,0,4),(11,'майка',1111,1,'maika1.jpg',1,0,3),(12,'кепка',1200,1,'kepka.jpg',0,0,4),(14,'футболка',3200,1,'fotbolka.jpg',1,0,3),(15,'угги',3000,1,'uggi.jpg',1,0,5),(16,'угги',11000,1,'uggi2.jpg',1,0,5),(17,'юбка',4900,1,'ubka.jpg',1,0,1),(18,'платье',5200,1,'blue-dress.webp',1,0,3),(19,'платье',6300,1,'dress.jpg',1,0,3),(20,'панама',799,1,'panama01.webp',1,0,3),(21,'толстовка',4500,1,'jacket01.webp',1,0,3),(22,'спортивный костюм',7200,1,'sport_man.jpg',0,0,2),(23,'спортивный костюм',7200,1,'sport01.webp',0,0,3),(24,'рубашка',1790,1,'product-8.jpg',1,0,1),(25,'рубашка',1790,1,'rubashka.jpg',1,0,2),(26,'очки солнцезащитные',2777,1,'product-6.jpg',1,0,1),(27,'джинсы',9999,1,'jeans2.jpg',0,0,2),(28,'джинсы',7440,1,'jeans3.jpg',0,0,2),(29,'кепка',1200,1,'kepka2.jpg',0,0,4),(30,'кепка',2100,1,'kepka3.jpg',1,0,4),(31,'рубашка',5899,1,'rubashka2.jpg',1,0,2);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'женщины'),(2,'мужчины'),(3,'дети'),(4,'аксессуары'),(5,'обувь');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rights` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'admin','admin@fashion.ru','$2y$10$YGJIe61bnWP9hOp2EFtixeomGcm2eKoi3C6.H3IyQajFaDBXEXIWq',1),(6,'operator1','operator1@fashion.ru','$2y$10$eejL4hNORFXRGu68GIGmRuBliQW69Ivo0fUTdHxaPbZZbADaVRC1a',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-04  7:23:11
