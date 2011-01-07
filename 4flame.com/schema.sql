-- MySQL dump 10.11
--
-- Host: localhost    Database: 4flame
-- ------------------------------------------------------
-- Server version	5.0.51a-24

--

DROP TABLE IF EXISTS `replies`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `replies` (
  `id` int(11) NOT NULL auto_increment,
  `thread_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `content` varchar(1024) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `threads` (
  `id` int(11) NOT NULL auto_increment,
  `topic` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(64) default NULL,
  `password` varchar(1024) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

