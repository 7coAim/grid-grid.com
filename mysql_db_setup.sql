--
-- Table structure for table `usertable`
--

DROP TABLE IF EXISTS `usertable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usertable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tw_user_id` varchar(30) DEFAULT NULL,
  `tw_screen_name` varchar(15) DEFAULT NULL,
  `tw_access_token` varchar(255) DEFAULT NULL,
  `tw_access_token_secret` varchar(255) DEFAULT NULL,
  `facebook_user_id` varchar(30) DEFAULT NULL,
  `facebook_name` varchar(255) DEFAULT NULL,
  `facebook_picture` varchar(255) DEFAULT NULL,
  `facebook_access_token` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` text NOT NULL,
  `pass` text,
  `mail` text,
  `data` text,
  `URL1` text,
  `LINK1` text,
  `background` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tw_user_id` (`tw_user_id`),
  UNIQUE KEY `facebook_user_id` (`facebook_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- Dump completed on 2014-04-26  3:40:00
