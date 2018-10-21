SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS evocar;

USE evocar;

DROP TABLE IF EXISTS box;

CREATE TABLE `box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO box VALUES("2","2017-11-26 22:54:04");
INSERT INTO box VALUES("3","2017-12-04 09:54:46");



DROP TABLE IF EXISTS box_id2;

CREATE TABLE `box_id2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS category;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS company;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO company VALUES("1","iva","20");
INSERT INTO company VALUES("2","nit","143141175-5 RÃ©gimen Simplificado");
INSERT INTO company VALUES("3","cell","300 528 14 12");
INSERT INTO company VALUES("4","web","");
INSERT INTO company VALUES("5","direccion","Calle 20  Carrera 1  # 179");
INSERT INTO company VALUES("6","skin","AdminLTE");



DROP TABLE IF EXISTS configuration;

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `kind` int(11) DEFAULT NULL,
  `val` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short` (`short`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS operation;

CREATE TABLE `operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `q` float DEFAULT NULL,
  `operation_type_id` int(11) DEFAULT NULL,
  `sell_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `operation_type_id` (`operation_type_id`),
  KEY `sell_id` (`sell_id`)
) ENGINE=MyISAM AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

INSERT INTO operation VALUES("247","25","7","2","67","2017-12-02 14:49:44");
INSERT INTO operation VALUES("3","3","3","1","0","2017-02-22 10:49:43");
INSERT INTO operation VALUES("4","4","2","1","0","2017-02-22 12:30:44");
INSERT INTO operation VALUES("5","5","4","1","0","2017-02-22 12:39:00");
INSERT INTO operation VALUES("6","6","7","1","0","2017-02-22 12:51:40");
INSERT INTO operation VALUES("7","7","2","1","0","2017-02-22 12:54:55");
INSERT INTO operation VALUES("8","8","3","1","0","2017-02-22 12:58:44");
INSERT INTO operation VALUES("12","12","1","1","0","2017-02-22 13:14:03");
INSERT INTO operation VALUES("10","10","8","1","0","2017-02-22 13:08:23");
INSERT INTO operation VALUES("11","11","1","1","0","2017-02-22 13:10:48");
INSERT INTO operation VALUES("13","13","1","1","0","2017-02-22 13:15:10");
INSERT INTO operation VALUES("14","14","8","1","0","2017-02-27 10:52:30");
INSERT INTO operation VALUES("15","15","3","1","0","2017-02-27 10:54:28");
INSERT INTO operation VALUES("16","16","3","1","0","2017-02-27 11:06:25");
INSERT INTO operation VALUES("17","17","6","1","0","2017-02-27 11:08:59");
INSERT INTO operation VALUES("18","18","4","1","0","2017-02-27 11:10:41");
INSERT INTO operation VALUES("19","19","3","1","0","2017-02-27 11:13:44");
INSERT INTO operation VALUES("20","20","4","1","0","2017-02-27 11:18:03");
INSERT INTO operation VALUES("21","21","5","1","0","2017-02-27 11:19:44");
INSERT INTO operation VALUES("22","22","2","1","0","2017-02-27 11:22:02");
INSERT INTO operation VALUES("23","23","1","1","0","2017-02-27 11:24:05");
INSERT INTO operation VALUES("223","31","124","2","37","2017-03-18 12:27:56");
INSERT INTO operation VALUES("25","12","0.5","1","2","2017-03-01 15:23:23");
INSERT INTO operation VALUES("26","17","0.5","1","2","2017-03-01 15:23:23");
INSERT INTO operation VALUES("27","16","0.5","1","2","2017-03-01 15:23:23");
INSERT INTO operation VALUES("28","21","0.5","1","2","2017-03-01 15:23:23");
INSERT INTO operation VALUES("29","6","0.5","1","2","2017-03-01 15:23:23");
INSERT INTO operation VALUES("30","24","0","1","0","2017-03-01 15:26:35");
INSERT INTO operation VALUES("31","24","0.5","1","3","2017-03-01 15:26:54");
INSERT INTO operation VALUES("32","25","28","1","0","2017-03-02 09:49:21");
INSERT INTO operation VALUES("33","26","18","1","0","2017-03-02 09:51:31");
INSERT INTO operation VALUES("34","0","10","1","0","2017-03-02 10:00:12");
INSERT INTO operation VALUES("35","27","10","1","0","2017-03-02 10:13:53");
INSERT INTO operation VALUES("36","28","13","1","0","2017-03-02 10:27:12");
INSERT INTO operation VALUES("37","29","36","1","0","2017-03-02 10:46:21");
INSERT INTO operation VALUES("38","30","10","1","0","2017-03-02 10:50:30");
INSERT INTO operation VALUES("39","31","259","1","0","2017-03-02 11:04:00");
INSERT INTO operation VALUES("40","32","10","1","0","2017-03-02 11:15:43");
INSERT INTO operation VALUES("41","33","3","1","0","2017-03-02 11:27:14");
INSERT INTO operation VALUES("42","34","30","1","0","2017-03-02 11:47:14");
INSERT INTO operation VALUES("43","35","4","1","0","2017-03-02 11:53:37");
INSERT INTO operation VALUES("44","36","8","1","0","2017-03-02 11:57:43");
INSERT INTO operation VALUES("45","37","98","1","0","2017-03-02 12:03:24");
INSERT INTO operation VALUES("46","38","1.5","1","0","2017-03-02 12:22:14");
INSERT INTO operation VALUES("47","39","29","1","0","2017-03-02 12:24:26");
INSERT INTO operation VALUES("48","40","10","1","0","2017-03-02 12:25:47");
INSERT INTO operation VALUES("49","41","1","1","0","2017-03-02 12:27:04");
INSERT INTO operation VALUES("50","42","150","1","0","2017-03-02 12:29:29");
INSERT INTO operation VALUES("51","43","25","1","0","2017-03-02 12:31:44");
INSERT INTO operation VALUES("52","44","46","1","0","2017-03-02 12:33:26");
INSERT INTO operation VALUES("53","0","91","1","0","2017-03-02 12:41:31");
INSERT INTO operation VALUES("54","0","51","1","0","2017-03-02 12:44:41");
INSERT INTO operation VALUES("55","0","51","1","0","2017-03-02 12:49:47");
INSERT INTO operation VALUES("56","45","50","1","0","2017-03-02 13:03:08");
INSERT INTO operation VALUES("57","46","91","1","0","2017-03-02 13:06:23");
INSERT INTO operation VALUES("58","47","102","1","0","2017-03-02 13:08:31");
INSERT INTO operation VALUES("59","48","257","1","0","2017-03-02 13:12:34");
INSERT INTO operation VALUES("60","49","87","1","0","2017-03-02 13:15:53");
INSERT INTO operation VALUES("61","50","53","1","0","2017-03-02 13:24:35");
INSERT INTO operation VALUES("62","51","10","1","0","2017-03-02 13:36:10");
INSERT INTO operation VALUES("63","52","97","1","0","2017-03-02 13:40:02");
INSERT INTO operation VALUES("64","53","17","1","0","2017-03-02 13:42:56");
INSERT INTO operation VALUES("65","54","19","1","0","2017-03-02 14:42:19");
INSERT INTO operation VALUES("66","55","28","1","0","2017-03-02 14:51:40");
INSERT INTO operation VALUES("67","56","21","1","0","2017-03-02 15:05:36");
INSERT INTO operation VALUES("224","83","5","2","38","2017-03-20 12:32:40");
INSERT INTO operation VALUES("69","57","12","1","0","2017-03-02 15:13:42");
INSERT INTO operation VALUES("70","58","20","1","0","2017-03-03 14:07:07");
INSERT INTO operation VALUES("71","59","6","1","0","2017-03-03 16:25:45");
INSERT INTO operation VALUES("72","60","6","1","0","2017-03-03 16:28:34");
INSERT INTO operation VALUES("225","81","33","2","39","2017-03-20 13:11:02");
INSERT INTO operation VALUES("226","72","15","2","40","2017-03-21 09:17:30");
INSERT INTO operation VALUES("76","61","4","1","0","2017-03-04 08:44:20");
INSERT INTO operation VALUES("77","61","0.5","1","8","2017-03-04 08:46:01");
INSERT INTO operation VALUES("78","62","38","1","0","2017-03-04 09:00:07");
INSERT INTO operation VALUES("79","63","24","1","0","2017-03-04 09:09:15");
INSERT INTO operation VALUES("80","64","3","1","0","2017-03-04 09:32:36");
INSERT INTO operation VALUES("195","158","4","1","0","2017-03-15 11:07:05");
INSERT INTO operation VALUES("196","159","0","1","0","2017-03-15 11:11:44");
INSERT INTO operation VALUES("227","76","6","2","41","2017-03-21 09:19:58");
INSERT INTO operation VALUES("84","65","6","1","0","2017-03-04 11:37:37");
INSERT INTO operation VALUES("85","66","32","1","0","2017-03-04 12:06:22");
INSERT INTO operation VALUES("86","38","10","1","10","2017-03-04 12:24:14");
INSERT INTO operation VALUES("87","67","209","1","0","2017-03-04 15:05:56");
INSERT INTO operation VALUES("89","69","12","1","0","2017-03-04 15:42:00");
INSERT INTO operation VALUES("90","70","6","1","0","2017-03-04 15:54:00");
INSERT INTO operation VALUES("197","160","0","1","0","2017-03-15 11:13:56");
INSERT INTO operation VALUES("198","161","0","1","0","2017-03-15 11:15:44");
INSERT INTO operation VALUES("93","71","44","1","0","2017-03-05 13:05:21");
INSERT INTO operation VALUES("94","72","84","1","0","2017-03-05 13:19:34");
INSERT INTO operation VALUES("95","73","3","1","0","2017-03-05 13:23:24");
INSERT INTO operation VALUES("96","74","20","1","0","2017-03-05 13:38:12");
INSERT INTO operation VALUES("97","75","178","1","0","2017-03-05 13:40:35");
INSERT INTO operation VALUES("98","76","132","1","0","2017-03-05 14:04:02");
INSERT INTO operation VALUES("99","77","78","1","0","2017-03-05 14:05:57");
INSERT INTO operation VALUES("103","81","50","1","0","2017-03-05 14:31:23");
INSERT INTO operation VALUES("101","79","100","1","0","2017-03-05 14:25:17");
INSERT INTO operation VALUES("102","80","39","1","0","2017-03-05 14:28:07");
INSERT INTO operation VALUES("104","82","179","1","0","2017-03-05 14:33:39");
INSERT INTO operation VALUES("105","83","5","1","0","2017-03-05 14:39:48");
INSERT INTO operation VALUES("106","84","25","1","0","2017-03-05 14:47:58");
INSERT INTO operation VALUES("107","85","18","1","0","2017-03-05 14:52:09");
INSERT INTO operation VALUES("108","86","10","1","0","2017-03-05 15:00:00");
INSERT INTO operation VALUES("109","87","8","1","0","2017-03-05 15:01:48");
INSERT INTO operation VALUES("110","88","30","1","0","2017-03-05 15:03:18");
INSERT INTO operation VALUES("111","89","39","1","0","2017-03-05 15:04:04");
INSERT INTO operation VALUES("112","90","18","1","0","2017-03-05 15:09:24");
INSERT INTO operation VALUES("113","91","5","1","0","2017-03-05 15:12:12");
INSERT INTO operation VALUES("114","92","23","1","0","2017-03-05 15:14:46");
INSERT INTO operation VALUES("115","93","9","1","0","2017-03-05 15:19:33");
INSERT INTO operation VALUES("116","94","6","1","0","2017-03-05 15:21:22");
INSERT INTO operation VALUES("117","95","34.5","1","0","2017-03-06 11:09:14");
INSERT INTO operation VALUES("118","96","5","1","0","2017-03-06 13:44:05");
INSERT INTO operation VALUES("119","97","14","1","0","2017-03-06 13:56:54");
INSERT INTO operation VALUES("120","98","12","1","0","2017-03-06 14:01:40");
INSERT INTO operation VALUES("121","99","15","1","0","2017-03-06 14:04:57");
INSERT INTO operation VALUES("122","100","3","1","0","2017-03-06 14:50:05");
INSERT INTO operation VALUES("123","101","21","1","0","2017-03-06 14:59:53");
INSERT INTO operation VALUES("124","102","12","1","0","2017-03-06 15:12:19");
INSERT INTO operation VALUES("126","104","4","1","0","2017-03-06 15:44:46");
INSERT INTO operation VALUES("127","105","5","1","0","2017-03-06 15:51:42");
INSERT INTO operation VALUES("128","106","5","1","0","2017-03-06 16:04:04");
INSERT INTO operation VALUES("129","107","53","1","0","2017-03-06 16:12:14");
INSERT INTO operation VALUES("130","108","4","1","0","2017-03-06 16:23:28");
INSERT INTO operation VALUES("131","109","6","1","0","2017-03-06 16:29:08");
INSERT INTO operation VALUES("132","110","36","1","0","2017-03-06 17:07:07");
INSERT INTO operation VALUES("133","111","31","1","0","2017-03-06 17:20:36");
INSERT INTO operation VALUES("134","112","9","1","0","2017-03-06 17:30:11");
INSERT INTO operation VALUES("135","113","3","1","0","2017-03-08 11:25:28");
INSERT INTO operation VALUES("136","114","22","1","0","2017-03-08 12:30:38");
INSERT INTO operation VALUES("137","115","2","1","0","2017-03-08 12:37:21");
INSERT INTO operation VALUES("148","122","6","1","0","2017-03-09 12:48:38");
INSERT INTO operation VALUES("139","117","20","1","0","2017-03-09 07:44:47");
INSERT INTO operation VALUES("140","118","20","1","0","2017-03-09 08:29:34");
INSERT INTO operation VALUES("146","121","22","1","16","2017-03-09 11:57:31");
INSERT INTO operation VALUES("142","120","100","1","0","2017-03-09 11:06:06");
INSERT INTO operation VALUES("144","119","250","1","15","2017-03-09 11:30:18");
INSERT INTO operation VALUES("199","162","0","1","0","2017-03-15 11:16:33");
INSERT INTO operation VALUES("149","123","23","1","0","2017-03-09 12:49:49");
INSERT INTO operation VALUES("150","124","2","1","0","2017-03-09 12:51:08");
INSERT INTO operation VALUES("151","125","101","1","0","2017-03-10 11:36:23");
INSERT INTO operation VALUES("152","126","23","1","0","2017-03-10 11:56:45");
INSERT INTO operation VALUES("153","127","7","1","0","2017-03-10 12:01:53");
INSERT INTO operation VALUES("154","128","106","1","0","2017-03-10 12:17:01");
INSERT INTO operation VALUES("155","129","50","1","0","2017-03-10 12:36:21");
INSERT INTO operation VALUES("156","128","77","1","18","2017-03-10 12:45:25");
INSERT INTO operation VALUES("157","130","155","1","0","2017-03-10 14:51:11");
INSERT INTO operation VALUES("158","131","10","1","0","2017-03-10 15:10:03");
INSERT INTO operation VALUES("159","132","35","1","0","2017-03-10 16:13:55");
INSERT INTO operation VALUES("160","133","32","1","0","2017-03-10 16:15:28");
INSERT INTO operation VALUES("161","134","4","1","0","2017-03-10 16:39:27");
INSERT INTO operation VALUES("162","135","9","1","0","2017-03-10 16:40:22");
INSERT INTO operation VALUES("163","136","12","1","0","2017-03-11 09:17:50");
INSERT INTO operation VALUES("164","137","16","1","0","2017-03-11 09:38:58");
INSERT INTO operation VALUES("165","138","11","1","0","2017-03-11 09:41:45");
INSERT INTO operation VALUES("166","139","17","1","0","2017-03-11 09:56:40");
INSERT INTO operation VALUES("200","163","0","1","0","2017-03-15 11:17:38");
INSERT INTO operation VALUES("168","140","13","1","0","2017-03-11 10:04:39");
INSERT INTO operation VALUES("169","141","40","1","0","2017-03-11 10:23:18");
INSERT INTO operation VALUES("170","142","36","1","0","2017-03-11 10:25:01");
INSERT INTO operation VALUES("171","143","2","1","0","2017-03-11 10:36:49");
INSERT INTO operation VALUES("201","164","0","1","0","2017-03-15 11:19:54");
INSERT INTO operation VALUES("173","144","2","1","0","2017-03-11 10:47:18");
INSERT INTO operation VALUES("174","145","2","1","0","2017-03-11 11:00:38");
INSERT INTO operation VALUES("175","146","2","1","0","2017-03-11 11:16:16");
INSERT INTO operation VALUES("176","147","81","1","0","2017-03-11 11:36:10");
INSERT INTO operation VALUES("177","148","28","1","0","2017-03-11 11:38:28");
INSERT INTO operation VALUES("178","149","14","1","0","2017-03-13 11:23:36");
INSERT INTO operation VALUES("179","150","7","1","0","2017-03-13 12:06:49");
INSERT INTO operation VALUES("180","151","2","1","0","2017-03-14 08:33:02");
INSERT INTO operation VALUES("181","152","1","1","0","2017-03-14 09:14:41");
INSERT INTO operation VALUES("182","153","1","1","0","2017-03-14 09:46:50");
INSERT INTO operation VALUES("183","154","1","1","0","2017-03-14 10:06:26");
INSERT INTO operation VALUES("184","155","500","1","0","2017-03-15 07:35:58");
INSERT INTO operation VALUES("185","156","1500","1","0","2017-03-15 07:47:21");
INSERT INTO operation VALUES("202","165","0","1","0","2017-03-15 11:21:01");
INSERT INTO operation VALUES("203","166","0","1","0","2017-03-15 11:21:46");
INSERT INTO operation VALUES("204","167","0","1","0","2017-03-15 11:22:00");
INSERT INTO operation VALUES("205","168","6","1","0","2017-03-15 11:50:07");
INSERT INTO operation VALUES("206","169","2","1","0","2017-03-15 12:05:32");
INSERT INTO operation VALUES("207","170","3","1","0","2017-03-15 12:08:17");
INSERT INTO operation VALUES("208","171","6","1","0","2017-03-15 12:17:03");
INSERT INTO operation VALUES("209","172","2","1","0","2017-03-15 12:47:59");
INSERT INTO operation VALUES("210","173","6","1","0","2017-03-15 12:59:29");
INSERT INTO operation VALUES("211","174","9","1","0","2017-03-15 13:01:11");
INSERT INTO operation VALUES("228","178","2","1","0","2017-03-22 09:44:26");
INSERT INTO operation VALUES("213","175","19","1","0","2017-03-15 13:15:15");
INSERT INTO operation VALUES("214","176","11","1","0","2017-03-15 14:26:18");
INSERT INTO operation VALUES("215","177","16","1","0","2017-03-15 14:27:52");
INSERT INTO operation VALUES("229","179","0","1","0","2017-03-22 09:49:35");
INSERT INTO operation VALUES("230","179","3","1","42","2017-03-22 09:53:16");
INSERT INTO operation VALUES("232","31","4","2","43","2017-03-22 15:17:32");
INSERT INTO operation VALUES("233","31","131","2","44","2017-03-23 09:45:15");
INSERT INTO operation VALUES("234","29","36","2","45","2017-03-23 09:46:07");
INSERT INTO operation VALUES("235","75","5","2","46","2017-03-24 15:38:26");
INSERT INTO operation VALUES("236","72","10","2","47","2017-03-28 09:47:42");
INSERT INTO operation VALUES("237","77","20","2","48","2017-04-10 09:36:29");
INSERT INTO operation VALUES("238","120","100","2","49","2017-04-29 16:27:05");
INSERT INTO operation VALUES("239","73","3","2","50","2017-04-29 16:30:50");
INSERT INTO operation VALUES("240","85","1","2","51","2017-05-05 09:04:49");
INSERT INTO operation VALUES("241","84","1","2","52","2017-05-05 09:05:39");
INSERT INTO operation VALUES("242","30","2","2","53","2017-05-05 09:06:54");
INSERT INTO operation VALUES("243","86","1","2","54","2017-05-11 08:28:11");
INSERT INTO operation VALUES("244","38","1","2","64","2017-11-26 18:36:42");
INSERT INTO operation VALUES("245","10","1","2","65","2017-11-26 22:55:00");
INSERT INTO operation VALUES("246","6","1","2","66","2017-11-27 12:51:39");
INSERT INTO operation VALUES("248","30","1","2","67","2017-12-02 14:49:44");
INSERT INTO operation VALUES("249","11","1","2","67","2017-12-02 14:49:44");
INSERT INTO operation VALUES("250","32","3","2","67","2017-12-02 14:49:44");
INSERT INTO operation VALUES("251","13","1","2","68","2017-12-02 14:53:00");
INSERT INTO operation VALUES("252","85","1","2","69","2017-12-04 10:09:00");



DROP TABLE IF EXISTS payment;

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sell_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS person;

CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `identity` varchar(50) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `email1` varchar(50) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `kind` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO person VALUES("8","","a","a","a","a","a","a","a","","a","1","2017-11-29 11:33:14");



DROP TABLE IF EXISTS product;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `inventary_min` int(11) DEFAULT '10',
  `price_in` float DEFAULT NULL,
  `price_out` float DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `presentation` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

INSERT INTO product VALUES("3","","02vi6601","VINILO NOVEX TIPO 1 CURUBA","PINTURA DE AGUA","5","22847","27000","ESTANTE 1","GALON","7","0","2017-02-22 10:49:43","0");
INSERT INTO product VALUES("4","","02vi3301","VINILO NOVEX TIPO 1 OCEANICO","PINTURA DE AGUA ","5","22847","27000","ESTANTE 1","GALON","7","0","2017-02-22 12:30:44","0");
INSERT INTO product VALUES("5","","02vi5201","VINILO NOVEX TIPO 1 VERDE PRIMAVERAL","PINTURA DE AGUA","5","22847","27000","ESTANTE 1","GALON","7","0","2017-02-22 12:39:00","1");
INSERT INTO product VALUES("6","","02vi9901","VINILO NOVEX TIPO 1 AZUL MEDITERRANEO","PINTURA DE AGUA","5","16703","27000","ESTANTE 1","GALON","7","0","2017-02-22 12:51:40","1");
INSERT INTO product VALUES("7","","02vi6001","VINILO NOVEX TIPO 1 ROJO VIVO","PINTURA DE AGUA","5","24524","27000","ESTANTE 1","GALON","7","0","2017-02-22 12:54:55","1");
INSERT INTO product VALUES("8","","02vi9101","VINILO NOVEX TIPO 1 CORAL","PINTURA DE AGUA","5","22847","27000","ESTANTE 1","GALON","7","0","2017-02-22 12:58:44","1");
INSERT INTO product VALUES("12","","02vi0701","VINILO NOVEX TIPO 1 VERDE PINO ","PINTURA DE AGUA","5","22847","27000","ESTANTE 1","GALON","7","0","2017-02-22 13:14:03","1");
INSERT INTO product VALUES("10","","02vi6401","VINILO NOVEX TIPO 1 CONCENTRADO NARANJA TENTACION","PINTURA DE AGUA","5","16703","27000","ESTANTE 1","GALON","7","0","2017-02-22 13:08:23","1");
INSERT INTO product VALUES("11","","02vi5401","VINILO NOVEX TIPO 1 MANDARINA TROPICAL ","PINTURA DE AGUA","5","22847","27000","ESTANTE 1","GALON","7","0","2017-02-22 13:10:48","1");
INSERT INTO product VALUES("13","","02vi6701","VINILO NOVEX TIPO 1 PALO DE ROSA","PINTURA DE AGUA","5","22847","27000","ESTANTE 1","GALON","7","0","2017-02-22 13:15:10","1");
INSERT INTO product VALUES("14","","02in5201","VINILO VELMAX TIPO 2 VERDE PRIMAVERAL","PINTURA DE AGUA","5","15921","22000","ESTANTE 2","GALON","7","0","2017-02-27 10:52:30","1");
INSERT INTO product VALUES("15","","02in9901","VINILO VELMAX TIPO 2 AZUL MEDITERRANEO","PINTURA DE AGUA","5","16703","22000","ESTANTE 2","GALON","7","0","2017-02-27 10:54:28","1");
INSERT INTO product VALUES("16","","02in5401","VINILO VELMAX TIPO 2 MANDARINA TROPICAL","PINTURA DE AGUA","5","15921","22000","ESTANTE 2","GALON","7","0","2017-02-27 11:06:25","1");
INSERT INTO product VALUES("17","","02in62501","VINILO VELMAX TIPO 2 NARANJA AMANECER","PINTURA DE AGUA","5","15921","22000","ESTANTE 2","GALON","7","0","2017-02-27 11:08:59","1");
INSERT INTO product VALUES("18","","02in6601","VINILO VELMAX TIPO 2 CURUBA","PINTURA DE AGUA","5","15921","22000","ESTANTE 2","GALON","7","0","2017-02-27 11:10:41","1");
INSERT INTO product VALUES("19","","02in6801","VINILO VELMAX TIPO 2 CAPUCHINO","PINTURA DE AGUA","5","15921","22000","ESTANTE 2","GALON","7","0","2017-02-27 11:13:44","1");
INSERT INTO product VALUES("20","","02in5901","VINILO VELMAX TIPO 2 NEGRO","PINTURA DE AGUA","5","15921","22000","ESTANTE 2","GALON","7","0","2017-02-27 11:18:03","1");
INSERT INTO product VALUES("21","","02IN6401","VINILO VELMAX TIPO 2 NARANJA TENTACION","PINTURA DE AGUA","5","16703","22000","ESTANTE 2","GALON","7","0","2017-02-27 11:19:44","1");
INSERT INTO product VALUES("22","","02T36801","VINILO TIPO 3 TRIGO","PINTURA DE AGUA","5","9999","12000","ESTANTE 2","GALON","7","0","2017-02-27 11:22:02","1");
INSERT INTO product VALUES("23","","02t36601","VINILO TIPO 3 CURUBA","PINTURA DE AGUA","5","9999","12000","ESTANTE 2","GALON","7","0","2017-02-27 11:24:05","1");
INSERT INTO product VALUES("24","","02IN6001","VINILO VELMAX TIPO 2 ROJO","0","5","16703","22000","ESTANTE 2","GALON","3","0","2017-03-01 15:26:35","1");
INSERT INTO product VALUES("25","","7708254632543","A-LORBA 3.5 mata hormigas ","0","5","700","1500","ESTANTE 4","sobre","3","4","2017-03-02 09:49:21","1");
INSERT INTO product VALUES("26","","no tiene","campeÃ³n insecticida","0","5","700","1500","ESTANTE 4","sobre","3","4","2017-03-02 09:51:31","1");
INSERT INTO product VALUES("27","","no tiene","adaptador macho 1y 1/2","0","5","100","400","0","pvc","3","3","2017-03-02 10:13:53","1");
INSERT INTO product VALUES("28","","NO TIENE","adaptador macho 2 ","0","5","1800","3000","0","0","3","3","2017-03-02 10:27:12","1");
INSERT INTO product VALUES("29","","7709990812275","cemento Ultracem 50kg uso general","0","5","17446","18000","0","bolsa","3","2","2017-03-02 10:46:21","1");
INSERT INTO product VALUES("30","","7707269340061","cemento blanco 20kg argos","0","5","18950","25000","0","bolsa","3","2","2017-03-02 10:50:30","1");
INSERT INTO product VALUES("31","","7707269340016","cemento gris uso general 50kg Argos","0","5","16500","18000","0","bolsa","3","2","2017-03-02 11:04:00","1");
INSERT INTO product VALUES("32","","NO TIENE","codo 2\" presion","tubheria pvc\n\n","5","3600","6000","estanteria 5","0","3","3","2017-03-02 11:15:43","1");
INSERT INTO product VALUES("33","","NO TIENE","buje Pvc de 3/4 a 1/2","0","5","141.562","500","0","0","3","2","2017-03-02 11:27:14","1");
INSERT INTO product VALUES("34","","NO TIENE","llave control Paso 1/2 ","0","5","1154","3000","0","0","3","2","2017-03-02 11:47:14","1");
INSERT INTO product VALUES("35","","NO TIENE","llave control Paso 1 ","0","5","2457","4500","0","0","3","2","2017-03-02 11:53:37","1");
INSERT INTO product VALUES("36","","NO TIENE","llave control Paso 3/4 ","0","5","1485","3000","0","0","3","2","2017-03-02 11:57:43","1");
INSERT INTO product VALUES("37","","NO TIENE","T  1/2 ","0","5","191","500","0","0","3","3","2017-03-02 12:03:24","1");
INSERT INTO product VALUES("38","","NO TIENE","Tubo Pvc  4 pulgadas sanitario tigre   x 6mts","0","5","24700","30000","0","0","3","3","2017-03-02 12:22:14","1");
INSERT INTO product VALUES("39","","NO TIENE","Tubo Pvc 1 y 1/2 sanitario eco x 6 mts","0","5","8000","12000","0","0","3","2","2017-03-02 12:24:26","1");
INSERT INTO product VALUES("40","","NO TIENE","Tubo Pvc 2 sanitario eco x 6 mts","0","5","9500","16000","0","0","3","2","2017-03-02 12:25:47","1");
INSERT INTO product VALUES("41","","NO TIENE","Tubo Pvc 3 sanitario eco x 6 mts","0","5","14500","22000","0","0","3","2","2017-03-02 12:27:04","1");
INSERT INTO product VALUES("42","","NO TIENE","Tubo Pvc 1/2 sanitario eco x 6 mts","0","5","3200","5000","0","0","3","2","2017-03-02 12:29:29","1");
INSERT INTO product VALUES("43","","NO TIENE","Tubo Pvc 1 Pulga Presion eco x 6 mts 11mm","0","5","8000","12000","0","0","3","2","2017-03-02 12:31:44","1");
INSERT INTO product VALUES("44","","NO TIENE","Tubo Pvc 3/4 Pulga Presion x 6 mts 11mm","0","5","5200","10000","0","0","3","2","2017-03-02 12:33:26","1");
INSERT INTO product VALUES("45","","NO TIENE","Tubo condy instalacion Pvc 3/4 Pulga Presion  x 3mts","0","5","1750","3500","0","0","3","2","2017-03-02 13:03:08","1");
INSERT INTO product VALUES("46","","NO TIENE","Tubo condy instalacion Pvc 1/2  Pulga Presion  x 3mts","0","5","1300","2500","0","0","3","2","2017-03-02 13:06:23","1");
INSERT INTO product VALUES("47","","NO TIENE","adaptador hembra 1/2 Pulgada","0","5","170","400","0","0","3","3","2017-03-02 13:08:31","1");
INSERT INTO product VALUES("48","","NO TIENE","codo PresiÃ³n 90 grados Pvc 1/2 liso  tigre","0","5","204","400","0","0","3","2","2017-03-02 13:12:34","1");
INSERT INTO product VALUES("49","","NO TIENE","uniÃ³n Pvc 1/2\"","0","5","117","400","0","0","3","3","2017-03-02 13:15:53","1");
INSERT INTO product VALUES("50","","NO TIENE","uniÃ³n Pvc 1\" tigre","0","5","339","1000","0","0","3","3","2017-03-02 13:24:35","1");
INSERT INTO product VALUES("51","","NO TIENE","uniÃ³n Pvc 2 \"","0","5","1450","3000","0","0","3","3","2017-03-02 13:36:10","1");
INSERT INTO product VALUES("52","","NO TIENE","tapÃ³n PresiÃ³n sold 1/2 Pulgada Pvc  liso","0","5","100","300","0","0","3","2","2017-03-02 13:40:02","1");
INSERT INTO product VALUES("53","","NO TIENE","tapÃ³n con rosca 1/2 Pulgada Pvc","0","5","137","300","0","0","3","3","2017-03-02 13:42:56","1");
INSERT INTO product VALUES("54","","NO TIENE","tapÃ³n 2\" Pvc presiÃ³n blanco ","0","5","1500","3000","0","0","3","3","2017-03-02 14:42:19","1");
INSERT INTO product VALUES("55","","NO TIENE","tapÃ³n prueba gris 4 pulgada Pvc ","0","5","1200","2500","0","0","3","2","2017-03-02 14:51:40","1");
INSERT INTO product VALUES("56","","NO TIENE","uniÃ³n universal Pvc 1/2\"","0","5","1118","2000","0","0","3","3","2017-03-02 15:05:36","1");
INSERT INTO product VALUES("57","","NO TIENE","uniÃ³n universal Pvc 1 pulgada","0","5","1268","3000","0","0","3","3","2017-03-02 15:13:42","1");
INSERT INTO product VALUES("58","","NO TIENE","tabla de madera 3m x 11pulgadas","0","5","10000","12000","0","0","3","2","2017-03-03 14:07:07","1");
INSERT INTO product VALUES("59","","7707002568837","cerradura alcoba u oficina 5831 madera oscura marca dor stanpr","0","5","11185","18000","0","0","3","2","2017-03-03 16:25:45","1");
INSERT INTO product VALUES("60","","7706520048241","cerradura alcoba jn-1075 semi oscura marca joni","0","5","9457","17000","0","0","3","2","2017-03-03 16:28:34","1");
INSERT INTO product VALUES("61","","NO TIENE","tintilla de un litro","0","3","12000","15000","0","litro pinpinita","3","6","2017-03-04 08:44:20","1");
INSERT INTO product VALUES("62","","NO TIENE","peganew pegante para ceramica 25 kg blanco pegante cerramico","0","5","9500","13000","0 ","BOLSA X 25 KG BLANCO ","3","2","2017-03-04 09:00:07","1");
INSERT INTO product VALUES("63","","NO TIENE","peganew pegante para ceramica 25 kg GRIS pegante cerramico","0","5","8500","12000","0","BOLSA X 25 KG BLANCO ","3","2","2017-03-04 09:09:15","1");
INSERT INTO product VALUES("64","","NO TIENE","PESO # 7 COLGANTE  GRANDE 200 KLS ","0","1","62050","70000","0","0","3","0","2017-03-04 09:32:36","1");
INSERT INTO product VALUES("65","","NO TIENE","PESO # 4 COLGANTE  PLATON 13 KLS","0","5","35000","40000","0","0","3","0","2017-03-04 11:37:37","1");
INSERT INTO product VALUES("66","","NO TIENE","madera listÃ³n 4\" x 2\" x 4.5 mt madera abarcon ","0","5","16000","20000","0","0","3","2","2017-03-04 12:06:22","1");
INSERT INTO product VALUES("67","","NO TIENE","curva conduit  3/4\"","0","5","323.38","700","0","curbas berde","1","0","2017-03-04 15:05:56","1");
INSERT INTO product VALUES("69","","7453038487948","lampara casadora luz fuerte y largo alcance 12","0","5","7000","10000","0","12","1","0","2017-03-04 15:42:00","1");
INSERT INTO product VALUES("70","","6939020409774","linterna 7 LED sj - 977","0","2","8000","10000","0","00","1","0","2017-03-04 15:54:00","1");
INSERT INTO product VALUES("71","","NO TIENE","varilla  currugada 5/8","0","5","17500","22000","0","hierro","1","0","2017-03-05 13:05:21","1");
INSERT INTO product VALUES("72","","NO TIENE","varilla  1/2 (original 12mm)  currugada","0","5","10200","12500","0","hierro","1","0","2017-03-05 13:19:34","1");
INSERT INTO product VALUES("73","","NO TIENE","varilla  1/2\"  currugada milimetrica 11mm","0","5","9000","11000","0","hierro","1","0","2017-03-05 13:23:24","1");
INSERT INTO product VALUES("74","","NO TIENE","varilla  cuadrada 5/8","0","5","26250","30000","0","hierro","1","0","2017-03-05 13:38:12","1");
INSERT INTO product VALUES("75","","NO TIENE","varilla original 3/8 (currugada 9mm)","0","5","6200","8000","0","hierro","1","0","2017-03-05 13:40:35","1");
INSERT INTO product VALUES("76","","NO TIENE","varilla  3/8 (lisa 7.5mm)","0","5","4500","5500","0","hierro","1","0","2017-03-05 14:04:02","1");
INSERT INTO product VALUES("77","","NO TIENE","varilla  3/8 (milimetrica 8.5mm)","0","5","5200","6500","0","hierro","1","0","2017-03-05 14:05:57","1");
INSERT INTO product VALUES("81","","NO TIENE","varilla  1/2\"  cuadrada","0","5","17800","20500","0","hierro","1","0","2017-03-05 14:31:23","1");
INSERT INTO product VALUES("79","","NO TIENE","varilla  10MM entorchada","0","5","10500","13500","0","hierro","1","0","2017-03-05 14:25:17","1");
INSERT INTO product VALUES("80","","NO TIENE","varilla  10MM cuadrada","0","5","10500","13500","0","hierro","1","0","2017-03-05 14:28:07","1");
INSERT INTO product VALUES("82","","NO TIENE","varilla 1/4\"","0","5","1500","2000","0","hierro","1","0","2017-03-05 14:33:39","1");
INSERT INTO product VALUES("83","","NO TIENE","varilla  1/2  entorchada","0","5","17800","20500","0","hierro","1","0","2017-03-05 14:39:48","1");
INSERT INTO product VALUES("84","","NO TIENE","tubos cuadrados 1\" galvanizado calibre 20","0","5","18600","22500","0","galvanizado","1","0","2017-03-05 14:47:58","1");
INSERT INTO product VALUES("85","","NO TIENE","tubo galvanizado rectangular 1x2\"","0","5","34500","40000","0","galvanizado","1","0","2017-03-05 14:52:09","1");
INSERT INTO product VALUES("86","","NO TIENE","tubo galvanizado metalico x 3","0","5","57578","72000","0","galvanizado","1","0","2017-03-05 15:00:00","1");
INSERT INTO product VALUES("87","","NO TIENE","tubo galbanizado metalico x 2","0","5","45000","55000","0","galvanizado","1","0","2017-03-05 15:01:48","1");
INSERT INTO product VALUES("88","","NO TIENE","t cielo raso aluminio blanco","0","5","7500","9500","0","aluminio blanco","1","0","2017-03-05 15:03:18","1");
INSERT INTO product VALUES("89","","NO TIENE","angulo cielo raso aluminio blanco","0","5","7500","9500","0","aluminio blanco","1","0","2017-03-05 15:04:04","1");
INSERT INTO product VALUES("90","","NO TIENE","regla aLuminio blanco ","0","5","70000","100000","0"," regleta aluminio blanco x 6 mts","1","0","2017-03-05 15:09:24","1");
INSERT INTO product VALUES("91","","NO TIENE","tubo p.v.c 1/2 blanco tigre 21 mm ","0","5","4800","6000","0","p.v.c marcado 21 mm","1","0","2017-03-05 15:12:12","1");
INSERT INTO product VALUES("92","","NO TIENE","varilla roscada 3/8","0","5","1350","3500","0","hierro","1","0","2017-03-05 15:14:46","1");
INSERT INTO product VALUES("93","","NO TIENE","varilla roscada 1/2","0","5","2800","5200","0","varilla roscada ","1","0","2017-03-05 15:19:33","1");
INSERT INTO product VALUES("94","","NO TIENE","varilla roscada 5/8 ","0","5","8000","12000","0","varilla roscada","1","0","2017-03-05 15:21:22","1");
INSERT INTO product VALUES("95","","no tiene","SOLDADURA ELECTRICA SOLTRODE X 20KLS  A 1 E 6011","0","5","5500","7000","0","VARILLAS ","1","0","2017-03-06 11:09:14","1");
INSERT INTO product VALUES("96","","7704353013078","interuptor 3 calores aceb ","material electrico","5","8500","13000","0","0","1","0","2017-03-06 13:44:05","1");
INSERT INTO product VALUES("97","","NO TIENE","candado chadid 75 mm","0","5","7500","12500","estanteria 4","material dorado","1","0","2017-03-06 13:56:54","1");
INSERT INTO product VALUES("98","","NO TIENE","candado chadid  63 mm","0","5","6000","10000","estanteria 4","material dorado","1","0","2017-03-06 14:01:40","1");
INSERT INTO product VALUES("99","","NO TIENE","candado chadid  50 MM","0","5","4000","6000","estanteria 4","material dorado","1","0","2017-03-06 14:04:57","1");
INSERT INTO product VALUES("100","","no  ","dado 8mm ranger osagonal cuadrante 3/8","0","5","1800","3500","0","copa","1","8","2017-03-06 14:50:05","1");
INSERT INTO product VALUES("101","","028877321608","dis corte metal dewalt 4 1/2 pul","0","5","2700","4500","0","disco ","1","8","2017-03-06 14:59:53","1");
INSERT INTO product VALUES("102","","028877321639","disco corte metal 7 pul diwalt","0","5","4200","7000","0","disco amarillo","1","8","2017-03-06 15:12:19","1");
INSERT INTO product VALUES("104","","7453066503054","disco corte madera circular 41/2 pul 40 dientes","0","5","4600","7000","0","acero0","1","8","2017-03-06 15:44:46","1");
INSERT INTO product VALUES("105","","7453066503047","disco corte madera circular 41/2 pul 24 dientes","0","5","4200","6500","0","acero0","1","8","2017-03-06 15:51:42","1");
INSERT INTO product VALUES("106","","7453066501791","disco corte seco xpul 4 1/2  milenio tuool","0","2","3800","6000","vitrina 3 puesto 3","hierrob","1","8","2017-03-06 16:04:04","1");
INSERT INTO product VALUES("107","","7702587061414","bisagra 1 1/2 latonada comun c 22","0","10","300","700","vitrina 3 puesto 3","cobre laton","1","0","2017-03-06 16:12:14","1");
INSERT INTO product VALUES("108","","7702587810579","pasador cuadrado de 4 pul latonadoc 18 ct","0","3","1400","3000","vitrina 3 puesto 3","pasador","1","0","2017-03-06 16:23:28","1");
INSERT INTO product VALUES("109","","7702587500159","porta candado 3 1/2 latonado c.18 ct unidad","0","2","2000","3500","vitrina 3 puesto 3","platina","1","0","2017-03-06 16:29:08","1");
INSERT INTO product VALUES("110","","7702587131506","bis nudo cab pl 2x2 lat cl 16 trio ","0","5","2560","4500","vitrina 3 puesto 3","bolsas de 3 unidades  ","1","0","2017-03-06 17:07:07","1");
INSERT INTO product VALUES("111","","7702587131667","bis nudo cab pl 3 1/2 x3 1/2 dor br cl 14 trio ","0","5","1900","2700","vitrina 3 puesto 3","triovi","1","2","2017-03-06 17:20:36","1");
INSERT INTO product VALUES("112","","no tiene","bis induma 4x4 cl 14 dorada ","0","5","2270","3500","vitrina 3 puesto 3","bols de 3 unidades","1","2","2017-03-06 17:30:11","1");
INSERT INTO product VALUES("113","","7702561142009","molino tradicional corona","0","5","62000","75000","estanteria 4","caja","2","0","2017-03-08 11:25:27","1");
INSERT INTO product VALUES("114","","7707177450111","ferrominerales rojo fino","0","5","3060","5000","estanteria 4","caja ","2","0","2017-03-08 12:30:38","1");
INSERT INTO product VALUES("115","","7707177450135","ferrominerales negro fino","0","5","3060","5000","estanteria 4","caja es","2","0","2017-03-08 12:37:21","1");
INSERT INTO product VALUES("116","","7707177450135","ferrominerales negro fino","0","5","3060","5000","estanteria 4","caja","2","0","2017-03-08 12:37:28","0");
INSERT INTO product VALUES("117","","NO TIENE","tanques plasticos de 120 litros ","color blanco","5","25000","35000","no","caneca plastica","1","0","2017-03-09 07:44:47","1");
INSERT INTO product VALUES("118","","NO TIENETI","Tubo Pvc  4 pulgadas sanitario ECO   x 6mt","0","5","20500","28000","estante hierro","tubo amarillo","1","3","2017-03-09 08:29:34","1");
INSERT INTO product VALUES("119","","NO TIENE","soga rollo x 250 mt","0","5","300","600","exividor","soga azul x metro","1","0","2017-03-09 10:02:25","1");
INSERT INTO product VALUES("120","","NO TIENE","alambre centelsa # 14 azul celeste 100 metro","0","5","650","900","0","alambre x metro azul  celeste","2","0","2017-03-09 11:06:06","1");
INSERT INTO product VALUES("121","","NO TIENE","adptador macho 1/2 presion","tuberia pvc","5","100","400","estanteria 5","pvc","2","0","2017-03-09 11:45:19","1");
INSERT INTO product VALUES("122","","7707177450142","ferrominerales verde fino","0","5","3060","5000","estanteria 4","caja","2","0","2017-03-09 12:48:38","1");
INSERT INTO product VALUES("123","","7707177450159","ferrominerales azul fino","0","5","3060","5000","estanteria 4","caja","2","0","2017-03-09 12:49:49","1");
INSERT INTO product VALUES("124","","7707177450128","ferrominerales amarillo fino","0","5","3060","50000","estanteria 4","caja","2","0","2017-03-09 12:51:08","1");
INSERT INTO product VALUES("125","","NO TIENE","buje reductor de 3/4 a 1/2","0","5","150","400","0","pvc","7","3","2017-03-10 11:36:23","1");
INSERT INTO product VALUES("126","","NO TIENE","buje reductor de 1 a 3/4","0","5","450","1000","0","pvc","7","0","2017-03-10 11:56:45","1");
INSERT INTO product VALUES("127","","NO TIENE","codo 1/2 con rosca","0","5","200","600","0","p.vc","7","0","2017-03-10 12:01:53","1");
INSERT INTO product VALUES("128","","NO TIENE","semicodo x 45Âº de 1/2","0","5","274","400","0","p.v.c.","7","0","2017-03-10 12:17:01","1");
INSERT INTO product VALUES("129","","NO TIENE","codo presion de 90Âº x 1","0","5","480","1000","0","p.v.c.","7","3","2017-03-10 12:36:21","1");
INSERT INTO product VALUES("130","","NO TIENE","adaptador terminal conduit 1/2","0","5","100","400","0","p.v.c.","7","3","2017-03-10 14:51:11","1");
INSERT INTO product VALUES("131","","NO TIENE","adaptador macho 1\"","0","5","380","1000","0","pvc","7","3","2017-03-10 15:10:03","1");
INSERT INTO product VALUES("132","","NO TIENE","tapa luz 8 venas","0","5","1900","2500","0","pvc","7","2","2017-03-10 16:13:55","1");
INSERT INTO product VALUES("133","","NO TIENE","tapa luz 5 venas","0","5","1000","1500","0","madera","7","2","2017-03-10 16:15:28","1");
INSERT INTO product VALUES("134","","NO TIENE","sifon completo","0","5","3500","6000","estanteria 5","p.v.c.","7","3","2017-03-10 16:39:27","1");
INSERT INTO product VALUES("135","","NO TIENE","u de sifon","0","5","1500","2500","0","pvc","7","3","2017-03-10 16:40:22","1");
INSERT INTO product VALUES("136","","NO TIENE","rodachin giratorio 2","0","5","1400","2500","0","platina hierro","1","0","2017-03-11 09:17:50","1");
INSERT INTO product VALUES("137","","NO TIENE","platina hierro 3/16 x 1\"","0","5","13600","17000","0","platina hierro","1","0","2017-03-11 09:38:58","1");
INSERT INTO product VALUES("138","","NO TIENE","angulo hierro 1/8 x 1\"","0","5","14000","17000","0","angulo hierro","1","0","2017-03-11 09:41:45","1");
INSERT INTO product VALUES("139","","NO TIENE","tablas x 3.2.90 mts","0","5","9000","12000","0","madera","1","0","2017-03-11 09:56:40","1");
INSERT INTO product VALUES("140","","NO TIENE","pita ata todo x 130 mts","0","5","1700","2500","ESTANTE 2","rollo","1","0","2017-03-11 10:04:39","1");
INSERT INTO product VALUES("141","","NO TIENE","pie amigo  8x10 x par","0","5","3000","6000","0","aluminio","1","0","2017-03-11 10:23:18","1");
INSERT INTO product VALUES("142","","NO TIENE","pie amigo  6x8 x par","0","5","2400","4000","estanteria 4","aluminio","1","0","2017-03-11 10:25:01","1");
INSERT INTO product VALUES("143","","NO TIENE","suncho plastico x 2kls","0","5","12900","14500","vitrina azul ","suncho desc 500","1","0","2017-03-11 10:36:49","1");
INSERT INTO product VALUES("144","","7704353030198","cocineta 2pto electrica Haceb","0","5","87000","105000","estanteria 4","caja","1","0","2017-03-11 10:47:18","1");
INSERT INTO product VALUES("145","","7704353031683","cocineta 2 pto gas Haceb","0","5","48000","60000","ESTANTE 3","caja","1","0","2017-03-11 11:00:38","1");
INSERT INTO product VALUES("146","","NO TIENE","cerradura baÃ±o palanca acabado satinado satinado","0","5","18000","23000","ESTANTE 4","caja","7","0","2017-03-11 11:16:16","1");
INSERT INTO product VALUES("147","","NO TIENE","pintuco domestico x 220 ml Azul vera, Caoba, Verde esm, naranja","0","5","2000","3500","estanteria 4","TARRO","7","0","2017-03-11 11:36:09","1");
INSERT INTO product VALUES("148","","NO TIENE","pintuco domestico x 110 ml Azul verano,. tabaco claro","0","5","1000","2000","estanteria 4","TARRO","7","0","2017-03-11 11:38:28","1");
INSERT INTO product VALUES("149","","NO TIENE","clavo estrÃ­a acero corsan 3\"","0","5","3112","5000","estante 3","caja","7","0","2017-03-13 11:23:36","1");
INSERT INTO product VALUES("150","","3cch127nk","puntilla cors 2\" * 500 gr","0","5","1670","2500","estanteria 4","caja","7","2","2017-03-13 12:06:49","1");
INSERT INTO product VALUES("151","","7707002563207 - 5mil desc","Taladro electrÃ³nico sk620 de 1/2 -13mm-500w","0","5","50950","75000","estanteria 3 ","caja","7","0","2017-03-14 08:33:02","1");
INSERT INTO product VALUES("152","","7707316456127","taladro sdh 600 percutor stanley","0","5","104050","125000","estanteria 3","caja","7","0","2017-03-14 09:14:41","1");
INSERT INTO product VALUES("153","","7707316456141","pulidora angular 1/2 stanley 850w","0","5","133750","155000","estanteria 3","caja ","7","0","2017-03-14 09:46:50","1");
INSERT INTO product VALUES("154","","7707002530643","pulidora angular 1/2 stanprof sk720","0","5","49750","70000","estanteria 3","caja","7","0","2017-03-14 10:06:26","1");
INSERT INTO product VALUES("155","","NO TIENE","ZINC","0","5","13800","17000","0","LAMINA","7","0","2017-03-15 07:35:58","1");
INSERT INTO product VALUES("156","","NO TIENE","BLOK ZAMO","0","5","1000","1200","0","BLOK","7","0","2017-03-15 07:47:21","1");
INSERT INTO product VALUES("157","","7704353013078","interructor 3 calores","0","5","0","0","vittrina 1","caja","7","0","2017-03-15 11:05:32","1");
INSERT INTO product VALUES("158","","7704353013078","interructor 3 calores","0","5","0","0","vittrina 1","caja","7","0","2017-03-15 11:07:05","1");
INSERT INTO product VALUES("159","","7702561100559","balin  de acero molino y arandela juego x2","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:11:44","1");
INSERT INTO product VALUES("160","","7702561224354","tapÃ³n de seguridad olla express de 80kpa 4l-6","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:13:56","1");
INSERT INTO product VALUES("161","","NO TIENE","botÃ³n estufa","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:15:44","1");
INSERT INTO product VALUES("162","","NO TIENE","goma punta regulador","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:16:33","1");
INSERT INTO product VALUES("163","","NO TIENE","arandela prensa tornillo de molino","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:17:38","1");
INSERT INTO product VALUES("164","","NO TIENE","filtro cobre 2 salidas con barbulla ","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:19:54","1");
INSERT INTO product VALUES("165","","NO TIENE","filtro cobre 1 salida sin barbulla ","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:21:01","1");
INSERT INTO product VALUES("166","","NO TIENE","filtro secador para r 134 azul","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:21:46","1");
INSERT INTO product VALUES("167","","NO TIENE","botÃ³n secado ","0","5","0","0","vittrina 1","-","7","0","2017-03-15 11:22:00","1");
INSERT INTO product VALUES("168","","NO TIENE","taimer 3 cvables haceb","0","5","11000","18000","vittrina 1","-","7","0","2017-03-15 11:50:07","1");
INSERT INTO product VALUES("169","","NO TIENE","taimer doble 3 cables central","0","5","11000","18000","vittrina 1","-","7","0","2017-03-15 12:05:32","1");
INSERT INTO product VALUES("170","","NO TIENE","taimer doble 5 cables ","0","5","10000","18000","vittrina 1","-","7","0","2017-03-15 12:08:17","1");
INSERT INTO product VALUES("171","","NO TIENE","taimer 7 cables (doble) control selector","0","5","11000","18000","vittrina 1","-","7","0","2017-03-15 12:17:03","1");
INSERT INTO product VALUES("172","","NO TIENE","taimer 6 cables enc","0","5","11000","18000","vittrina 1","-","7","0","2017-03-15 12:47:59","1");
INSERT INTO product VALUES("173","","NO TIENE","taimer 7 cables Q/I","0","5","11000","18000","vittrina 1","-","7","0","2017-03-15 12:59:29","1");
INSERT INTO product VALUES("174","","NO TIENE","taimer 6 cables O/R C/P","0","5","11000","18000","vittrina 1","-","7","0","2017-03-15 13:01:11","1");
INSERT INTO product VALUES("175","","NO TIENE","taimer secado Q/R","0","5","8000","12000","vittrina 1","-","7","0","2017-03-15 13:15:15","1");
INSERT INTO product VALUES("176","","NO TIENE","tornillo de tapa de inodoro x par","0","5","1000","2500","vittrina 1","-","7","0","2017-03-15 14:26:18","1");
INSERT INTO product VALUES("177","","NO TIENE","tornillo tanque inidoro","0","5","300","500","vittrina 1","-","7","0","2017-03-15 14:27:52","1");
INSERT INTO product VALUES("178","","NO TIENE","rodillo naranja 9\" linea maestrol","0","5","3000","5500","0","0","7","0","2017-03-22 09:44:26","1");
INSERT INTO product VALUES("179","","NO TIENE","bota caucho negra - bata","0","5","14650","23000","ESTANTE 1","bota","7","0","2017-03-22 09:49:35","1");
INSERT INTO product VALUES("180","","NO TIENE","rodillo 9 naranja linea maestrto","0","5","2900","5500","0","empaque plastico","7","0","2017-03-22 11:51:16","0");



DROP TABLE IF EXISTS sell;

CREATE TABLE `sell` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `operation_type_id` int(11) DEFAULT '2',
  `accredit` tinyint(1) NOT NULL DEFAULT '0',
  `accreditlast` int(11) DEFAULT '0',
  `box_id` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `box_id` (`box_id`),
  KEY `operation_type_id` (`operation_type_id`),
  KEY `user_id` (`user_id`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

INSERT INTO sell VALUES("37","0","7","2","1","1","1","2232000","2046000","0","2017-03-18 12:27:56");
INSERT INTO sell VALUES("2","0","3","1","0","0","0","44047.5","0","0","2017-03-01 15:23:23");
INSERT INTO sell VALUES("3","0","3","1","0","0","0","8351.5","0","0","2017-03-01 15:26:54");
INSERT INTO sell VALUES("38","0","7","2","0","0","0","102500","89000","5000","2017-03-20 12:32:40");
INSERT INTO sell VALUES("39","0","7","2","0","0","0","676500","587400","33000","2017-03-20 13:11:02");
INSERT INTO sell VALUES("40","0","7","2","0","0","0","187500","153000","0","2017-03-21 09:17:30");
INSERT INTO sell VALUES("8","0","3","1","0","0","0","6000","0","0","2017-03-04 08:46:01");
INSERT INTO sell VALUES("41","0","7","2","0","0","0","33000","27000","3000","2017-03-21 09:19:58");
INSERT INTO sell VALUES("10","0","1","1","0","0","0","247000","0","0","2017-03-04 12:24:14");
INSERT INTO sell VALUES("42","0","7","1","0","0","0","43950","0","0","2017-03-22 09:53:16");
INSERT INTO sell VALUES("43","0","7","2","0","0","0","72000","66000","2000","2017-03-22 15:17:32");
INSERT INTO sell VALUES("14","0","2","1","0","0","0","75000","0","0","2017-03-09 11:27:24");
INSERT INTO sell VALUES("15","0","2","1","0","0","0","75000","0","0","2017-03-09 11:30:18");
INSERT INTO sell VALUES("16","0","2","1","0","0","0","2200","0","0","2017-03-09 11:57:31");
INSERT INTO sell VALUES("44","0","7","2","0","0","0","2358000","2161500","0","2017-03-23 09:45:15");
INSERT INTO sell VALUES("18","0","7","1","0","0","0","21098","0","0","2017-03-10 12:45:25");
INSERT INTO sell VALUES("45","0","7","2","0","0","0","648000","628056","0","2017-03-23 09:46:07");
INSERT INTO sell VALUES("46","0","7","2","0","0","0","40000","31000","1000","2017-03-24 15:38:26");
INSERT INTO sell VALUES("47","0","7","2","0","0","0","125000","102000","5000","2017-03-28 09:47:42");
INSERT INTO sell VALUES("48","0","7","2","0","0","0","130000","104000","0","2017-04-10 09:36:28");
INSERT INTO sell VALUES("49","0","7","2","0","0","0","90000","65000","10000","2017-04-29 16:27:05");
INSERT INTO sell VALUES("50","0","7","2","0","0","0","33000","27000","0","2017-04-29 16:30:50");
INSERT INTO sell VALUES("51","0","7","2","0","0","0","40000","34500","0","2017-05-05 09:04:49");
INSERT INTO sell VALUES("52","0","7","2","0","0","0","22500","18600","0","2017-05-05 09:05:39");
INSERT INTO sell VALUES("53","0","7","2","0","0","0","50000","37900","0","2017-05-05 09:06:54");
INSERT INTO sell VALUES("54","0","7","2","0","0","0","72000","57578","2000","2017-05-11 08:28:11");
INSERT INTO sell VALUES("63","","3","2","0","0","2","30000","24700","0","2017-11-26 18:29:08");
INSERT INTO sell VALUES("64","","3","2","0","0","2","30000","24700","0","2017-11-26 18:36:42");
INSERT INTO sell VALUES("65","","3","2","0","0","3","27000","16703","0","2017-11-26 22:55:00");
INSERT INTO sell VALUES("66","","3","2","0","0","3","27000","16703","0","2017-11-27 12:51:39");
INSERT INTO sell VALUES("67","","3","2","0","0","3","80500","57497","0","2017-12-02 14:49:44");
INSERT INTO sell VALUES("68","","3","2","0","0","3","27000","22847","0","2017-12-02 14:53:00");
INSERT INTO sell VALUES("69","","3","2","0","0","","40000","34500","0","2017-12-04 10:09:00");



DROP TABLE IF EXISTS user;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `identity` int(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO user VALUES("1","Jose ","Trillos","0","Jose Trillos","Jose Trillos","b0761e2e5aa1306ffb7bac16f5050e27791a482f","","1","1","2016-11-02 18:44:44");
INSERT INTO user VALUES("2","Amalfi","Amalfi Florez","22844995","Amalfi Florez","Amalfi Florez","5cdefe10e8f1ca11fd51c47cd5e6801be94069c5","","1","1","2017-02-17 09:31:56");
INSERT INTO user VALUES("3","Donaldo ","Puentes","1049939104","Donaldo Puentes","Donaldo Puentes","b0761e2e5aa1306ffb7bac16f5050e27791a482f","user1-160x160.jpg","1","1","2017-02-17 09:36:53");
INSERT INTO user VALUES("6","administrador","admin","0","admin","admin","90b9aa725f80cf4f64e990b78a9fc5ebd6cecad","","0","1","2016-11-02 18:44:44");
INSERT INTO user VALUES("7","SHIRLEY","TRILLOS","1128054446","SHIRTRIFLOR","shellyvan7@hotmail.com","3a2ac959954fe760e734a0911f82187dd314ce49","","1","1","2017-02-21 11:29:48");
INSERT INTO user VALUES("8","no admin","","0","","admin","90b9aa7e25f80cf4f64e990b78a9fc55ebd6cecad","","1","0","2016-11-02 18:44:44");



SET FOREIGN_KEY_CHECKS=1;