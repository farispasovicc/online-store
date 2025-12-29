-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: onlinestore
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderitems`
--

LOCK TABLES `orderitems` WRITE;
/*!40000 ALTER TABLE `orderitems` DISABLE KEYS */;
INSERT INTO `orderitems` VALUES (2,1,4,1,24.99),(3,2,3,1,59.90),(4,3,2,1,119.50),(5,3,5,1,189.00),(6,4,4,1,24.99),(7,5,5,1,189.00),(8,10,1,1,129.90),(9,26,1,1,129.90),(10,27,1,1,129.90),(11,28,1,1,129.90),(12,29,1,1,129.90),(13,30,1,1,129.90),(14,31,1,1,129.90),(15,32,1,1,129.90),(16,1,1,2,420.99),(17,1,1,2,64.99),(18,1,1,2,64.99),(19,23,1,2,64.99),(20,23,1,2,64.99),(22,1,1,2,64.99),(23,1,1,2,6477.99);
/*!40000 ALTER TABLE `orderitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'Completed',139.99,'2024-01-15 11:30:00'),(2,2,'Processing',59.90,'2025-10-28 14:20:54'),(3,3,'Paid',308.50,'2025-10-28 14:20:54'),(4,4,'Cancelled',24.99,'2025-10-28 14:20:54'),(5,5,'Completed',189.00,'2025-10-28 14:20:54'),(6,6,'Pending',25.98,'2025-10-28 16:13:09'),(7,6,'Pending',25.98,'2025-10-28 16:17:58'),(8,6,'Pending',25.98,'2025-10-28 16:22:51'),(9,6,'Pending',129.90,'2025-10-28 16:35:45'),(10,1,'Pending',129.90,'2025-10-28 16:38:00'),(12,6,'Pending',25.98,'2025-10-30 10:19:25'),(13,6,'Pending',25.98,'2025-10-30 10:19:29'),(14,6,'Pending',25.98,'2025-10-30 10:19:30'),(15,6,'Pending',25.98,'2025-10-30 10:19:31'),(16,6,'Pending',25.98,'2025-10-30 10:19:31'),(17,6,'Pending',25.98,'2025-10-30 10:19:32'),(18,6,'Pending',25.98,'2025-10-30 10:19:33'),(19,6,'Pending',25.98,'2025-10-30 10:19:33'),(20,6,'Pending',25.98,'2025-10-30 10:19:33'),(21,6,'Pending',25.98,'2025-10-30 10:19:33'),(22,6,'Pending',25.98,'2025-10-30 10:19:33'),(23,6,'Pending',25.98,'2025-10-30 10:19:33'),(24,6,'Pending',25.98,'2025-10-30 10:19:34'),(25,6,'Pending',25.98,'2025-10-30 10:25:04'),(26,6,'Pending',129.90,'2025-10-30 10:27:28'),(27,27,'Pending',129.90,'2025-10-30 10:28:26'),(28,27,'Pending',129.90,'2025-10-30 10:28:28'),(29,27,'Pending',129.90,'2025-10-30 19:06:43'),(30,27,'Pending',129.90,'2025-10-30 19:09:50'),(31,27,'Pending',129.90,'2025-10-30 19:10:39'),(32,27,'Pending',129.90,'2025-10-30 19:33:01'),(33,1,'Pending',420.99,'2024-01-15 11:30:00'),(34,1,'Pending',129.99,'2024-01-15 11:30:00'),(35,1,'Pending',129.99,'2024-01-15 11:30:00');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `paid_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (2,2,'Credit Card','Pending',59.90,'2025-10-28 14:21:01'),(3,3,'Credit Card','Successful',308.50,'2025-10-28 14:21:01'),(4,4,'Credit Card','Cancelled',24.99,'2025-10-28 14:21:01'),(5,5,'Credit Card','Successful',189.00,'2025-10-28 14:21:01'),(6,10,'Credit Card','Successful',129.90,'2025-10-28 16:38:00'),(7,26,'Credit Card','Successful',129.90,'2025-10-30 10:27:28'),(8,27,'Credit Card','Successful',129.90,'2025-10-30 10:28:26'),(9,28,'Credit Card','Successful',129.90,'2025-10-30 10:28:28'),(10,29,'Credit Card','Successful',129.90,'2025-10-30 19:06:43'),(11,30,'Credit Card','Successful',129.90,'2025-10-30 19:09:50'),(12,31,'Credit Card','Successful',129.90,'2025-10-30 19:10:39'),(13,32,'Credit Card','Successful',129.90,'2025-10-30 19:33:01'),(14,1,'POSTMAN','Successful',129.99,'2024-01-15 11:35:00'),(15,1,'Credit Card','Successful',129.99,'2024-01-15 11:35:00'),(16,1,'Credit Card','Successful',129.99,'2024-01-15 11:35:00');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Nike Air Max Updateddddddddd','Nike',139.99),(2,'Adidas Essentials Tracksuit','Adidas',119.50),(3,'Zara Slim Fit Jeans','Zara',59.90),(4,'H&M Oversized T-Shirt','H&M',24.99),(5,'The North Face Puffer Jacket','The North Face',189.00),(7,'Nike Tech Fleece Hoodie','Nike',129.90),(8,'Nike Tech Fleece Hoodie','Nike',129.90),(9,'Nike Tech Fleece Hoodie','Nike',129.90);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Updated','Doe Updated','john.updated@example.com',NULL,'user','2024-01-15 10:00:00'),(2,'Tarik','Mehic','tarik.mehic@gmail.com',NULL,'user','2025-10-28 14:20:39'),(3,'Amna','Halilovic','amna.halilovic@gmail.com',NULL,'user','2025-10-28 14:20:39'),(4,'Lejla','Karic','lejla.karic@gmail.com',NULL,'user','2025-10-28 14:20:39'),(5,'Muhamed','Selimovic','muhamed.selimovic@gmail.com',NULL,'user','2025-10-28 14:20:39'),(6,'John','Doe','john.doe@gmail.com',NULL,'user','2025-10-28 16:13:09'),(10,'Faris','Hodzic','faris.hodzic@gmail.com',NULL,'user','2025-10-28 16:38:00'),(27,'Pasovic','Faris','pasovic.faris@gmail.com',NULL,'user','2025-10-30 10:28:25'),(28,'Pasovic','Faris','pasovic.faris@gmail.com',NULL,'user','2025-10-30 10:28:28'),(29,'Pasovic','Faris','pasovic.faris@gmail.com',NULL,'user','2025-10-30 19:06:43'),(30,'Faris','Faris','pasovic.faris@gmail.com',NULL,'user','2025-10-30 19:09:50'),(31,'Faris','Faris','pasovic.faris@gmail.com',NULL,'user','2025-10-30 19:10:39'),(32,'Faris','Faris','pasovic.faris@gmail.com',NULL,'user','2025-10-30 19:33:01'),(34,'Post','Man','post.manovic@example.com',NULL,'user','2024-01-15 10:00:00'),(35,'Test','User','john.doe@example.com',NULL,'user','2024-01-15 12:00:00'),(36,NULL,NULL,'test123@example.com','$2y$10$0TNqL1IMf5B3pnve1jemN.IR0D6eRxXswLEiTMH3yHJWI.XDK7LtG','user','2025-12-10 22:48:12'),(37,'Faris','Admin','faris@admin.com','adminfaris','admin','2025-12-11 00:12:58'),(38,'Admin','User','admin@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa1rWo2rWl8H6Y3WfI9lNqXG6l.','admin','2025-12-11 00:14:00'),(39,'Faris','Pasovic','admin@examplee.com','$2y$10$yctJ9T9HBjOd/cgPw5D3v.zGRztXqH6Hws02VAHxRhHkksIKQUYxe','admin','2025-12-11 00:20:09'),(40,NULL,NULL,'faris@gmail.com','$2y$10$2OB4AOJUpovlvBgRI7XHB.vmB6sfoxgGrb.dJR66Poaj2JyuN4tK2','user','2025-12-13 00:22:01'),(41,NULL,NULL,'user_test@example.com','$2y$10$aMgM7O4dlQCMBB7gWpzPsemxt/.V.r5nxH2OG46Itk83Qt7zLttGa','user','2025-12-13 12:49:46'),(42,NULL,NULL,'admin_test@example.com','$2y$10$bhRRA6gPJboWPIpxxCaj6.EPZiC6VRMKMif5fu4EibqZqfk4epENK','admin','2025-12-13 12:56:04'),(43,NULL,NULL,'user@test.com','$2y$10$KTKzRcoWdMMeNySksfggbe/p1T7RlKkpYM1cMlDlHMkzuwbaEsJIW','user','2025-12-13 13:00:44'),(44,NULL,NULL,'admin@test.com','$2y$10$p7vtjXoZlbt5k8cnXLRSTO4I8Eks/rEhITZXsEQhcbNAJQ1LXE9IW','admin','2025-12-13 13:02:41'),(45,NULL,NULL,'testuser@example.com','$2y$10$fcHUchvUAMnyi0dzx6PYl.RcXGAEzT.RJx6lJrCLvVJzXSfjZLFwy','user','2025-12-13 13:24:24'),(46,NULL,NULL,'admiin@example.com','$2y$10$gKbJC8CZ23yDJ2eq/T/wvuHGqUZj3IkT/DNTWfVqXWNt.ukdwgXvu','admin','2025-12-13 13:24:48'),(47,NULL,NULL,'testuser1@gmail.com','$2y$10$mPcBsxATgXB2z5NNze0QM.8CD.4d7sqe8vbbJE0BypLmpvpFkjyU2','user','2025-12-14 05:51:08'),(48,NULL,NULL,'user2@test.com','$2y$10$jl769Wx/5TCQiUw1oA0Vke4Y4yP2TB/XNKgricJ.boLQPjeC5GDxG','admin','2025-12-14 07:29:16'),(49,NULL,NULL,'user1@test.com','$2y$10$O5SrLoAbfhK/yuZed45Na.6WrxOCyIhzvgEmwI.FnPaPcqVG5JhWu','user','2025-12-14 17:20:14'),(50,NULL,NULL,'user@user.com','$2y$10$.ZeTR4iI6LueMsrYErmNCO1NUPXOZhyCmohsTUrFOAhiiEhYO9Rz6','user','2025-12-14 17:36:12'),(51,NULL,NULL,'adminadmin@test.com','$2y$10$t6njhgFKHTDsVDYb/6f3w./WWTmniCMZGPbMRqnVVeKNYYdRiYdsi','admin','2025-12-14 17:40:51'),(52,NULL,NULL,'demo@gmail.com','$2y$10$qzh2T3u/2JTKnu0GG1lJwO5PYmS.XJAKMG6tbA.dhS61c9zIFH6wa','user','2025-12-14 18:53:52'),(53,NULL,NULL,'frspasovic@gmail.com','$2y$10$4Ye/SJ7dajHgX6quXKRoT.xwgokGaFUW7ocruiIrGlHW05JPzmETa','user','2025-12-14 20:35:32'),(54,NULL,NULL,'frs@gmail.com','$2y$10$gOU/HDzVxUg5t6NAf8q0pOGQDkgTLu9dIF6lEfSq24F.204AaIgSK','user','2025-12-14 20:36:38'),(55,NULL,NULL,'adminadmin@gmail.com','$2y$10$W0guATtuNLGqcWt89A08FekRwuIgjI3azx0wYRA4ozJKb2PgAMs6e','admin','2025-12-14 22:34:53'),(56,NULL,NULL,'testuser3@gmail.com','$2y$10$r50SAWUmI.VUgpSDwXAhP.jgm1KrV1RxHWpG0wQXz1f0zpVj3la1a','user','2025-12-14 23:29:42'),(57,'John','Doe','john.deeeeoe@example.com',NULL,'user','2024-01-15 10:00:00'),(58,NULL,NULL,'aaaaaa@gmail.com','$2y$10$IhTJJwyJ5hf6IqZZHWTvuOtCPT3Mq.RBGR3RxXraXPF1QEvsXZP7u','user','2025-12-14 23:43:05'),(59,NULL,NULL,'amila@gmail.com','$2y$10$UK.8bojw3TQOOJxSZoRv2Ovzx4VOGYUrLu8V.lrWBcJR9o0Q5hhem','user','2025-12-19 13:22:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'onlinestore'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-27 20:36:04
