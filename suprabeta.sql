DROP TABLE IF EXISTS `detail_vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) unsigned NOT NULL,
  `km` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_vehicles_vehicle_id_foreign` (`vehicle_id`),
  CONSTRAINT `detail_vehicles_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `detail_vehicles` WRITE;
/*!40000 ALTER TABLE `detail_vehicles` DISABLE KEYS */;
INSERT INTO `detail_vehicles` VALUES (3,10,'153098','cambio de valvula SCV y regeneración forzada de filtro de particulas DPF','2020-03-30 18:24:09','2020-03-30 18:24:09'),(4,11,'60786','Cambio de kit de distribución superior, cambio de inyector de cilindro 4 por encontrarse en retorno y punta abierta, se limpia dpf de manera manual, se realiza regeneracion forzada de dpf, y mantención completa. (la falla se origina por saturación de filtro de particulas dpf, ya que el vehiculo entra en modo de post inyeccion, la cual obliga a los inyectores abrir en tiempo de escape, por lo cual falla el inyector quedando punta abierta, generando incremento en nivel de aceite y un sobre trabajo del tensor hidraulico, lo que provoco a la vez el aumento en diametro de la cadena de distribución, se recomienda sacar a carretera 1 vez cada 10 días, con temperatura de trabajo de motor a la mitad y en 4ta marcha a 2500 rpm por almenos unos 30 min).','2020-03-30 18:43:14','2020-03-30 18:43:14'),(5,14,'135794','Reparación de sistema de frenos delantero, cambio de discos y pastillas, desarme de sistema de caliper completo, limpieza, cambio de kit de reparacion de caliper (orring cara plana de piston, guardapolvos, y 1 piston del lado izquierdo) limpieza y engrase de pasadores, cambio de liquido de frenos.','2020-03-30 18:44:04','2020-03-30 18:44:04'),(6,16,'148100','AJUSTE DE MOTOR COMPLETO Y REPARACION DE SISTEMA DE INYECCION','2020-03-30 18:44:49','2020-03-30 18:44:49');
/*!40000 ALTER TABLE `detail_vehicles` ENABLE KEYS */;
UNLOCK TABLES;



DROP TABLE IF EXISTS `mechanic_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mechanic_client` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `mechanic_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mechanic_client_user_id_foreign` (`user_id`),
  KEY `mechanic_client_mechanic_id_foreign` (`mechanic_id`),
  CONSTRAINT `mechanic_client_mechanic_id_foreign` FOREIGN KEY (`mechanic_id`) REFERENCES `users` (`id`),
  CONSTRAINT `mechanic_client_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mechanic_client`
--

LOCK TABLES `mechanic_client` WRITE;
/*!40000 ALTER TABLE `mechanic_client` DISABLE KEYS */;
INSERT INTO `mechanic_client` VALUES (10,10,2),(11,12,10),(12,13,10);
/*!40000 ALTER TABLE `mechanic_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'RUBÉN TORRES','rtr.servicioautomotriz@gmail.com','$2y$10$jRUCUxRzCr/yuvgLJtKIr.IlB7xBmIF0ALMEhh1AUrXJzcoRTp.lu','aQzFnZheFitqYuThkE8qXtfr6wqRWNp6vgUpwLXE9Hf8rYVoXk94fIsaCv7p','2020-03-25 17:47:12','2020-03-25 17:47:12'),
	(12,'FREDDY NUÑEZ','sdlipigasfnunez@gmail.com','$2y$10$S6POno8ZznIlyUrPErS/weJFE5EU8DMpQV5pnQG8r5.TBNLMK3LNm',NULL,'2020-03-25 18:00:38','2020-03-25 18:57:23'),
    (13,'Gabriela Alejandra Godoy Valdivia','Lavados.institucionales@gmail.com','$2y$10$xxALM3.4idxZz8YdR0ZgV.5LrfNNSfKDEStlOZlX1KiOHabQsc09m',NULL,'2020-03-30 19:20:51','2020-03-30 19:20:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `patent` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `chasis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) DEFAULT NULL,
  `engine` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` text COLLATE utf8mb4_unicode_ci,
  `km` text COLLATE utf8mb4_unicode_ci,
  `mechanic` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_user_id_foreign` (`user_id`),
  CONSTRAINT `vehicles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,2,'WF4728','iuajdojasoidjsa','FORD RANGER',2006,'2300 CC BENCINA 16V DOHC 4 CIL. L','BLANCO','122000',NULL,'2020-03-20 17:04:44','2020-03-20 17:04:44'),(2,1,'xcvxcvxcvcxv','cxvxcvxcvcxv','AUDI 4000',1985,'1800 CC','vxcvxvcxv','44444',NULL,'2020-03-20 17:09:49','2020-03-20 17:09:49'),(3,4,'dadadsad','asdadsa','ALEKO 2141',1992,'1600 CC BENCINA','blanco','23422',NULL,'2020-03-20 19:08:03','2020-03-20 19:08:03'),(4,4,'fsdljhfdskhfk','fsfsfsfsdfds','DAEWOO ESPERO',1999,'2000 CC 8V SOHC BENCINA INY. MONOP 4 CIL. L C20LE','GRIS','44444',NULL,'2020-03-20 19:39:54','2020-03-20 19:39:54'),(5,3,'wf4728','hjdhadjh','FORD CAPRI',1989,'1600 CC BENCINA','blanco','123123',NULL,'2020-03-24 12:39:15','2020-03-24 12:39:15'),(6,4,'adads','asdad','ACURA INTEGRA',1997,'1800 CC BENCINA','asdad','1231',NULL,'2020-03-24 14:58:46','2020-03-24 14:58:46'),(7,2,'sdada','asdadsa','ALEKO 2141',1992,'1600 CC BENCINA','asdad','12232',NULL,'2020-03-24 16:37:27','2020-03-24 16:37:27'),(8,9,'KTRH-50','Jf1gd5lj33g048176','AMERICAN MOTORS CJ8',1984,'4200 CC BENCINA','BLANCO','444444',NULL,'2020-03-24 17:09:10','2020-03-24 17:09:10'),(9,4,'asdad','asdad','ACURA INTEGRA',1997,'1800 CC BENCINA','blanco','1231231',NULL,'2020-03-30 17:32:29','2020-03-30 17:32:29'),(10,12,'GRPX-84','KNCSJX76AE7870678','KIA MOTORS FRONTIER',2015,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','153098',NULL,'2020-03-30 18:23:30','2020-03-30 18:23:30'),(11,12,'KHPD-11','KNCSJX76AE7870678','KIA MOTORS FRONTIER',2018,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','60786',NULL,'2020-03-30 18:24:55','2020-03-30 18:24:55'),(12,12,'FCXS-27','KNCSJX76AD7703894','KIA MOTORS FRONTIER',2013,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','187177',NULL,'2020-03-30 18:32:10','2020-03-30 18:32:10'),(13,12,'KW-2480','KNCSE013277243031','KIA MOTORS FRONTIER',2007,'2500 CC 8V SOHC DIESEL INY. IDI 4 CIL. L','Blanco','325373',NULL,'2020-03-30 18:33:42','2020-03-30 18:33:42'),(14,12,'DWFC-95','KNCSJX76AD7660696','KIA MOTORS FRONTIER',2012,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','135794',NULL,'2020-03-30 18:34:46','2020-03-30 18:34:46'),(15,12,'KPKZ-89','KNCSJX76AD7660696','KIA MOTORS FRONTIER',2017,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','51360',NULL,'2020-03-30 18:36:10','2020-03-30 18:36:10'),(16,12,'DXJP-84','KNCSJX76AD7662350','KIA MOTORS FRONTIER',2012,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','148967',NULL,'2020-03-30 18:37:14','2020-03-30 18:37:14'),(17,12,'KTRH-50','KNCSJX76AD7662350','KIA MOTORS FRONTIER',2018,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','44128',NULL,'2020-03-30 18:38:05','2020-03-30 18:38:05'),(18,12,'KTRH-51','KNCSJX76AD7662350','KIA MOTORS FRONTIER',2018,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','53969',NULL,'2020-03-30 18:38:45','2020-03-30 18:38:45'),(19,12,'KTRH-52','KNCSJX76AD7662350','KIA MOTORS FRONTIER',2018,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','30245',NULL,'2020-03-30 18:39:23','2020-03-30 18:39:23'),(20,12,'CXDS-72','KNCSJX73AA7466465','KIA MOTORS FRONTIER',2011,'2500 CC 8V SOHC DIESEL INY. IDI 4 CIL. L','Blanco',NULL,NULL,'2020-03-30 18:40:57','2020-03-30 18:40:57'),(21,12,'GPTK-19','KNCSJX76AF7872820','KIA MOTORS FRONTIER',2014,'2500 CC DIESEL 16V DOHC 4 CIL. L INY. CRDI','Blanco','159310',NULL,'2020-03-30 18:42:26','2020-03-30 18:42:26'),(22,13,'JYBD-61','3N6BD33B8JK810754','NISSAN NAVARA',2016,'2500 CC 16V DOHC DIESEL CRDI 4 CIL. L TURBO','GRIS','105331',NULL,'2020-03-30 19:25:04','2020-03-30 19:25:04'),(23,10,'bcvbcbvb','FRONTIER','AMERICAN MOTORS CJ8',1984,'4200 CC BENCINA','ghfd','1111',NULL,'2020-04-15 17:11:04','2020-04-15 17:11:04');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-22 16:29:15
