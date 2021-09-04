--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2021_09_01_105511_create_products_table',1),(4,'2021_09_01_121645_create_orders_table',1),(5,'2021_09_03_061657_create_order_products_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_products_order_id_foreign` (`order_id`),
  KEY `order_products_product_id_foreign` (`product_id`),
  CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES (4,2021090001,1,'Ani Riyani','1',5000,'2021-09-03 08:46:56','2021-09-03 08:46:56'),(5,2021090001,2,'Ani Riyani','2',20000,'2021-09-03 08:46:56','2021-09-03 08:46:56'),(7,2021090002,3,'Nopandi','4',60000,'2021-09-03 08:49:35','2021-09-03 08:49:35'),(8,2021090002,4,'Nopandi','2',40000,'2021-09-03 08:49:36','2021-09-03 08:49:36'),(9,2021090003,11,'M. Choirul Fajri','1',100000,'2021-09-03 08:50:25','2021-09-03 08:50:25'),(18,2021090008,2,'Lily','2',20000,'2021-09-03 10:03:43','2021-09-04 00:11:18'),(21,2021080011,5,'Bezarre','2',50000,'2021-09-03 10:07:47','2021-09-03 10:07:47'),(27,2021090017,3,'Abdul Rozak','3',45000,'2021-09-03 23:38:20','2021-09-04 00:10:39');
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2021090018 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2021080011,'Bezarre','2021-08-29 17:00:00',50000,'2021-09-03 10:07:46','2021-09-03 10:07:46'),(2021090001,'Ani Riyani','2021-08-31 17:00:00',25000,'2021-09-03 08:46:56','2021-09-03 08:46:56'),(2021090002,'Nopandi','2021-09-01 17:00:00',100000,'2021-09-03 08:49:35','2021-09-03 08:49:35'),(2021090003,'M. Choirul Fajri','2021-09-02 17:00:00',100000,'2021-09-03 08:50:25','2021-09-03 08:50:25'),(2021090008,'Lily','2021-09-02 17:00:00',20000,'2021-09-03 10:03:43','2021-09-04 00:11:18'),(2021090017,'Abdul Rozak','2021-08-31 17:00:00',45000,'2021-09-03 23:38:20','2021-09-04 00:10:39');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Product 1','product_1',5000,2,'2021-09-02 23:35:39','2021-09-02 23:35:39'),(2,1,'Product 2','product_2',10000,8,'2021-09-02 23:35:39','2021-09-02 23:35:39'),(3,1,'Product 3','product_3',15000,10,'2021-09-02 23:35:40','2021-09-03 01:50:06'),(4,1,'Product 4','product_4',20000,2,'2021-09-02 23:35:40','2021-09-02 23:35:40'),(5,1,'Product 5','product_5',25000,11,'2021-09-02 23:35:40','2021-09-02 23:35:40'),(11,1,'Product 6','product-6',100000,5,'2021-09-03 04:41:22','2021-09-03 04:41:22');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin_store',1,'$2y$10$4ZBg36iphzHRelPpjhU.SOAIxxOCQLz/78f4l/0UGvF/lECdENzEe','2021-09-02 23:35:32','2021-09-02 23:35:32'),(2,'User','user_store',0,'$2y$10$EQcQFLavk0XfYxbcGurM1uubQsImE0J1BgrdCbFJQPsIw.Tz17fMC','2021-09-02 23:35:32','2021-09-02 23:35:32'),(3,'Guest','guest_1',0,'$2y$10$9lSkjeijNUL93G44jjWqv.O.BYmqzx8BwSuDsrr4dnmByTb3Q04I2','2021-09-02 23:35:32','2021-09-02 23:35:32'),(4,'Mulki Sulaiman','mulki123',0,'$2y$10$lArXNElKtOpp/mPgqz5lv.6paw17bv0m2JtaOZnHpxieK2FNmKfuS','2021-09-04 00:05:44','2021-09-04 00:05:44');
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

-- Dump completed on 2021-09-04 16:07:26
