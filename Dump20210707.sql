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
  `date` datetime DEFAULT NULL,
  `price` int(11) NOT NULL,
  `user-name` varchar(255) NOT NULL,
  `user-surname` varchar(255) NOT NULL,
  `user-thirdname` varchar(255) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `delivery` varchar(45) NOT NULL,
  `payment` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `home` varchar(255) DEFAULT NULL,
  `aprt` varchar(255) DEFAULT NULL,
  `product-id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `product-id_UNIQUE` (`product-id`),
  KEY `c_prod-id_idx` (`product-id`),
  CONSTRAINT `c_prod-id` FOREIGN KEY (`product-id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'2021-06-04 15:45:51',3999,'Иван','Иванов','','email@mail.ru','666','Самовывоз','Банковской картой','Выполнено','побыстрее','Москва','Чайкина','55','3',1),(2,'2021-06-08 15:45:51',3599,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Курьерная доставка','Наличные','Выполнено','','Сочи','Севастьянова','15','11',2),(3,'2021-06-10 15:45:51',1200,'Олег','Ромашкин','','romashkin_o@mail.ru','+79182345678','Курьерная доставка','','Выполнено','отправлять почтой России','Новосибирск','Ипотечная','142','87',29),(5,'2021-06-14 15:45:51',1111,'Бон','Джови','','bonjovy@yahoo.com','+14325664354','Самовывоз','','Выполнено','','','','','',11),(6,'2021-06-15 15:45:51',1500,'Василий','Пупкин','','pupkin@gmail.com','89244947962','Самовывоз','','Не выполнено','','','','','',8),(7,'2021-06-16 15:45:51',799,'Анна','Максимова','','vyssotskaya.yulia@gmail.com','+79186667962','Самовывоз','','Не выполнено','','','','','',20),(8,'2021-05-24 15:45:51',1790,'Олег','Ромашкин','','romashkin_o@mail.ru','+79282947911','Самовывоз','','Не выполнено','','','','','',24),(12,'2021-05-22 15:45:51',1200,'Рома','Высоцкий','','vyssotski@gmail.com','+79283456789','Самовывоз','','Не выполнено','','','','','',12),(13,'2021-06-24 15:47:50',4500,'Юлия','Высоцкая','','yulia@gmail.com','+79282947944','Курьерная доставка','','Не выполнено','','Сочи','Транспортная','11','22',21),(14,'2021-07-01 14:43:38',3500,'Антон','Свиридов','','sviridov@gmail.com','+79183337755','Самовывоз','','Не выполнено','ddd','','','','',36),(16,'2021-07-01 14:50:07',23456,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Самовывоз','Банковской картой','Не выполнено','','','','','',37),(17,'2021-07-01 14:51:01',3000,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Самовывоз','Наличные','Не выполнено','','','','','',15),(18,'2021-07-01 20:06:02',5200,'Макс','Иванов','','Ivanov@gmail.com','+79112349867','Курьерная доставка','Банковской картой','Не выполнено','все хочу','Челябинск','Челябинская','12','44',18);
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
  `price` decimal(12,2) NOT NULL,
  `activity` tinyint(1) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `new` tinyint(1) DEFAULT NULL,
  `sale` tinyint(1) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `c_category_id_idx1` (`category_id`),
  CONSTRAINT `c_category_id` FOREIGN KEY (`category_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'платье с длинными рукавами',4500.00,1,'product-1.jpg',1,0,1),(2,'платье короткое без рукавов',5000.00,1,'product-6.jpg',1,0,1),(3,'ботильоны',5999.00,1,'product-9.jpg',0,1,1),(4,'туника',3333.00,1,'product-8.jpg',1,0,1),(5,'джинсы',4300.00,1,'jeans.jpg',1,0,1),(6,'босоножки на каблуке',3999.00,1,'bosonogki.jpg',0,1,5),(7,'сапоги черные',2799.00,1,'product-1.jpg',0,1,5),(8,'рубашка',1500.00,1,'product-2.jpg',0,1,1),(9,'шорты',2699.00,1,'product-2.jpg',1,0,1),(10,'часы',9099.00,1,'product-3.jpg',0,0,4),(11,'майка',1111.00,1,'maika1.jpg',1,0,3),(12,'кепка',1200.00,1,'kepka.jpg',0,0,4),(14,'футболка',3200.00,1,'fotbolka.jpg',1,0,3),(15,'угги',3000.00,1,'uggi.jpg',1,0,5),(16,'угги',11000.00,1,'uggi2.jpg',1,0,5),(17,'юбка',4900.00,1,'ubka.jpg',1,0,1),(18,'платье',5200.00,1,'blue-dress.webp',1,0,3),(19,'платье',6300.00,1,'dress.jpg',1,0,3),(20,'панама',799.00,1,'panama01.webp',1,0,3),(21,'толстовка',4500.00,1,'jacket01.webp',1,0,3),(22,'спортивный костюм',7200.00,1,'sport_man.jpg',0,0,2),(23,'спортивный костюм',7200.00,1,'sport01.webp',0,0,3),(24,'рубашка',1790.00,1,'product-8.jpg',1,0,1),(25,'рубашка',1790.00,1,'rubashka.jpg',1,0,2),(26,'очки солнцезащитные',2777.00,1,'product-6.jpg',1,0,1),(27,'джинсы',9999.00,1,'jeans2.jpg',0,0,2),(28,'джинсы',7440.00,1,'jeans3.jpg',0,0,2),(29,'кепка',1200.00,1,'kepka2.jpg',0,0,4),(30,'кепка',2100.00,1,'kepka3.jpg',1,0,4),(31,'рубашка',5899.00,1,'rubashka2.jpg',1,0,2),(32,'угги',3000.00,1,'',1,0,2),(33,'Угги',3999.00,1,'uggi.jpg',0,1,5),(34,'угги',3000.00,1,'',0,0,2),(35,'футболка для мальчика',1200.00,1,'fotbolka.jpg',1,0,3),(36,'Платье на девочку',3500.00,1,'panama01.webp',0,1,3),(37,'угги',2356.00,1,'uggi2.jpg',1,0,5),(38,'джинсы-бананы',4880.00,1,'jeans2.jpg',0,0,1),(39,'джинсы-бананы',4880.00,1,'jeans2.jpg',0,0,2),(40,'логнслив',2400.00,1,'',0,1,2),(41,'кроссы',34000.00,1,'jeans3.jpg',1,0,5),(42,'штаны',4500.00,1,'sport_man.jpg',0,0,2),(43,'сумка',56000.00,1,'product-5.jpg',0,0,4),(44,'рюкзак',3600.00,1,'product-5.jpg',0,0,4),(53,'кроссовки беговые sport',5500.00,1,'',1,1,5),(54,'штаны',3500.00,1,'product-4.jpg',0,1,1),(55,'штаны в полоску',4500.00,1,'product-4.jpg',0,0,3),(56,'Платье на девочку',3200.00,1,'dress.jpg',1,0,3);
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
  `rights` varchar(25) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'admin','admin@fashion.ru','$2y$10$YGJIe61bnWP9hOp2EFtixeomGcm2eKoi3C6.H3IyQajFaDBXEXIWq','admin'),(6,'operator1','operator1@fashion.ru','$2y$10$eejL4hNORFXRGu68GIGmRuBliQW69Ivo0fUTdHxaPbZZbADaVRC1a','operator'),(7,'operator2','operator2@fashion.ru','$2y$10$OIx7xLpkhPj5Dy75ip0hf.nGKHSk/Oj757gm6gLZN8wdn4YB2/gye','operator');
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

-- Dump completed on 2021-07-07  9:28:48
