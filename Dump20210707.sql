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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'2021-06-04 15:45:51',3999,'Иван','Иванов','','email@mail.ru','666','Самовывоз','Банковской картой','Выполнено','побыстрее','Москва','Чайкина','55','3',1),(2,'2021-06-08 15:45:51',3599,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Курьерная доставка','Наличные','Выполнено','','Сочи','Севастьянова','15','11',2),(3,'2021-06-10 15:45:51',1200,'Олег','Ромашкин','','romashkin_o@mail.ru','+79182345678','Курьерная доставка','','Выполнено','отправлять почтой России','Новосибирск','Ипотечная','142','87',29),(5,'2021-06-14 15:45:51',1111,'Бон','Джови','','bonjovy@yahoo.com','+14325664354','Самовывоз','','Выполнено','','','','','',11),(6,'2021-06-15 15:45:51',1500,'Василий','Пупкин','','pupkin@gmail.com','89244947962','Самовывоз','','Не выполнено','','','','','',8),(7,'2021-06-16 15:45:51',799,'Анна','Максимова','','vyssotskaya.yulia@gmail.com','+79186667962','Самовывоз','','Не выполнено','','','','','',20),(8,'2021-05-24 15:45:51',1790,'Олег','Ромашкин','','romashkin_o@mail.ru','+79282947911','Самовывоз','','Не выполнено','','','','','',24),(12,'2021-05-22 15:45:51',1200,'Рома','Высоцкий','','vyssotski@gmail.com','+79283456789','Самовывоз','','Не выполнено','','','','','',12),(13,'2021-06-24 15:47:50',4500,'Юлия','Высоцкая','','yulia@gmail.com','+79282947944','Курьерная доставка','','Не выполнено','','Сочи','Транспортная','11','22',21),(14,'2021-07-01 14:43:38',3500,'Антон','Свиридов','','sviridov@gmail.com','+79183337755','Самовывоз','','Не выполнено','ddd','','','','',36),(16,'2021-07-01 14:50:07',23456,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Самовывоз','Банковской картой','Не выполнено','','','','','',37),(17,'2021-07-01 14:51:01',3000,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Самовывоз','Наличные','Не выполнено','','','','','',15),(18,'2021-07-01 20:06:02',5200,'Макс','Иванов','','Ivanov@gmail.com','+79112349867','Курьерная доставка','Банковской картой','Не выполнено','все хочу','Челябинск','Челябинская','12','44',18),(20,'2021-07-08 09:57:58',3999,'Марк','Марков','','mark@mail.ru','89002883444','Самовывоз','Банковской картой','Не выполнено','','','','','',6),(21,'2021-07-08 12:40:29',4300,'Мирон','Иванов','','ivanov@gmail.com','89287847944','Самовывоз','Наличные','Не выполнено','[jxe l;byib','Сочи','ул. Севастьянова 15/1,  кв. 60','','',5),(22,'2021-07-08 14:59:22',2100,'Вася','Кудряшкин','','kudra@gmail.com','+79368374634','Самовывоз','Банковской картой','Не выполнено','','','','','',30),(25,'2021-07-09 15:49:52',3200,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Самовывоз','Банковской картой','Не выполнено','','','','','',14),(29,'2021-07-09 15:52:53',1790,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Самовывоз','Банковской картой','Не выполнено','','','','','',25),(30,'2021-07-09 15:53:54',5899,'Василий','Васянов','','vv@mail.ru','89365267538','Самовывоз','Банковской картой','Не выполнено','','','','','',31),(31,'2021-07-10 13:34:27',9999,'Yuliajhhhhh','Vyssotskaya','','vyssotskaya.yulia@gmail.com','89282947962','Курьерная доставка','Банковской картой','Не выполнено','12345678901234567890123567','','','','',27),(32,'2021-07-10 13:34:47',2400,'Юлия','Высоцкая','','vyssotskaya.yulia@gmail.com','+79282947962','Самовывоз','Банковской картой','Выполнено','','','','','',40),(33,'2021-07-14 10:02:38',4900,'Карлсон','Карлсон','','karlson@gmail.com','+72234445566','Самовывоз','Банковской картой','Не выполнено','','','','','',16);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'платье с длинными рукавами',4500.00,1,'product-1.jpg',1,0),(2,'платье короткое без рукавов',5000.00,1,'product-6.jpg',1,0),(3,'ботильоны',5999.00,1,'product-9.jpg',0,1),(4,'туника',3333.00,1,'product-8.jpg',1,0),(5,'джинсы',4300.00,1,'jeans3.jpg',0,1),(6,'босоножки на каблуке',3999.00,1,'bosonogki.jpg',0,1),(7,'сапоги черные',2799.00,1,'product-1.jpg',0,1),(8,'рубашка',1500.00,1,'product-2.jpg',0,1),(9,'шорты',2699.00,1,'product-2.jpg',1,0),(10,'часы',9099.00,1,'product-3.jpg',0,0),(11,'майка',1111.00,1,'maika1.jpg',1,0),(12,'кепка',1200.00,1,'kepka.jpg',0,0),(14,'футболка',3200.00,1,'fotbolka.jpg',1,0),(15,'угги',3000.00,1,'uggi.jpg',1,0),(16,'угги',11000.00,1,'uggi2.jpg',1,0),(17,'юбка',4900.00,1,'ubka.jpg',1,0),(18,'платье',5200.00,1,'blue-dress.webp',1,0),(19,'платье',6300.00,1,'dress.jpg',1,0),(20,'панама',799.00,1,'panama01.webp',1,0),(21,'толстовка',4500.00,1,'jacket01.webp',1,0),(22,'спортивный костюм',7200.00,1,'sport_man.jpg',0,0),(23,'спортивный костюм',7200.00,1,'sport01.webp',0,0),(24,'рубашка',1790.00,1,'product-8.jpg',1,0),(25,'рубашка',1790.00,1,'rubashka.jpg',1,0),(26,'очки солнцезащитные',2777.00,1,'product-6.jpg',1,0),(27,'джинсы',9999.00,1,'jeans2.jpg',0,0),(28,'джинсы',7440.00,1,'jeans3.jpg',0,0),(29,'кепка',1200.00,1,'kepka2.jpg',0,0),(30,'кепка',2100.00,1,'kepka3.jpg',1,0),(31,'рубашка',5899.00,1,'rubashka2.jpg',1,0),(32,'угги',3000.00,1,'uggikids.jpg',1,0),(33,'Угги',3999.00,1,'uggi.jpg',0,1),(34,'угги',3600.00,1,'uggikids2.jpg',0,1),(35,'футболка для мальчика',1200.00,1,'fotbolka.jpg',1,0),(36,'Платье на девочку',3500.00,1,'panama01.webp',0,1),(37,'угги',2356.00,1,'uggi2.jpg',1,0),(38,'джинсы-бананы',4880.00,1,'jeans2.jpg',0,0),(39,'джинсы-бананы',4880.00,1,'jeans2.jpg',0,0),(40,'логнслив',2400.00,1,'longslive2.jpg',1,0),(41,'кроссы',34000.00,1,'jeans3.jpg',1,0),(43,'сумка из кожи',56000.00,1,'product-5.jpg',1,0),(44,'сумка женская',3600.00,1,'product-5.jpg',1,0),(45,'кроссовки беговые sport',5500.00,1,'jeans3.jpg',1,0),(60,'толстовка',3200.00,1,'jacket01.webp',1,0),(62,'сумка на пояс',4410.00,1,'majka01.webp',1,0),(67,'туфли на каблуке',6700.00,1,'shoes1.jpg',1,0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_sections`
--

DROP TABLE IF EXISTS `products_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `c_id_sec_idx` (`id_prod`),
  KEY `c_id_prod_idx` (`id_section`),
  CONSTRAINT `c_prod_id` FOREIGN KEY (`id_prod`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_sections`
--

LOCK TABLES `products_sections` WRITE;
/*!40000 ALTER TABLE `products_sections` DISABLE KEYS */;
INSERT INTO `products_sections` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,2),(6,6,5),(7,7,5),(8,8,1),(9,9,1),(10,10,4),(11,11,3),(12,12,4),(13,14,3),(14,15,5),(15,16,5),(16,17,1),(17,18,3),(18,19,3),(19,20,3),(20,21,3),(21,22,2),(22,23,3),(23,24,1),(24,25,2),(25,26,1),(26,27,2),(27,28,2),(28,29,4),(29,30,4),(30,31,2),(31,32,5),(32,33,5),(33,34,5),(34,35,3),(35,36,3),(36,37,5),(37,38,1),(38,39,2),(39,40,2),(40,41,5),(44,45,5),(45,14,1),(60,67,5),(67,62,3),(68,62,4),(69,60,2),(70,60,3),(71,44,4),(72,43,4);
/*!40000 ALTER TABLE `products_sections` ENABLE KEYS */;
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

-- Dump completed on 2021-07-14 10:04:48
