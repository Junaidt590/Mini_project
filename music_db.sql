/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.17-MariaDB : Database - music_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`music_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `music_db`;

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `instrument_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`slno`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

/*Data for the table `cart` */

insert  into `cart`(`slno`,`uid`,`instrument_id`,`qty`,`price`,`date`) values 
(51,13,11,1,1190,'2022-02-24'),
(52,13,9,1,568,'2022-02-24'),
(60,14,4,1,1200,'2022-02-25'),
(61,14,9,1,568,'2022-02-25'),
(62,0,4,1,1200,'2022-02-28'),
(66,22,4,1,1200,'2022-03-02'),
(67,12,14,1,6999,'2022-03-02');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(15) NOT NULL,
  `sub_cat` varchar(15) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`cat_id`,`cat_name`,`sub_cat`,`image`) values 
(10,'Drum','','uploads/20220222072330.jpg'),
(9,'Guitar','','uploads/20220222072317.jpeg'),
(11,'Ukulele','','uploads/20220222072342.jpg'),
(12,'Veena','','uploads/20220222072354.png'),
(13,'Flute','','uploads/20220222072404.jpg'),
(14,'Piano','','uploads/20220222072414.jpg'),
(15,'Violine','','uploads/20220222154200.jpg');

/*Table structure for table `dealers` */

DROP TABLE IF EXISTS `dealers`;

CREATE TABLE `dealers` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `instrument_id` int(11) NOT NULL,
  `dealer_name` varchar(50) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `dealers` */

insert  into `dealers`(`d_id`,`instrument_id`,`dealer_name`) values 
(10,21,' Symphony Musical Instruments'),
(9,15,'Yamaha'),
(4,4,'Sapthaswara Musicals'),
(5,8,'Yamaha'),
(6,9,'Saraswathi Musicals'),
(7,10,'Sapthaswara Musicals'),
(8,11,'Yamaha'),
(11,20,' Shantinath Drum Enterprises'),
(12,18,'Harmony  musicals'),
(13,13,'Saraswathi Musicals & Sports'),
(14,16,' Symphony Musical Instruments');

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `Feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `User` int(11) NOT NULL,
  `Instrument` int(11) NOT NULL,
  `Feedback` varchar(200) NOT NULL,
  `Reply` varchar(200) NOT NULL,
  PRIMARY KEY (`Feed_id`),
  KEY `feedback_ibfk_1` (`Instrument`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`Instrument`) REFERENCES `instrument` (`instrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `feedback` */

insert  into `feedback`(`Feed_id`,`User`,`Instrument`,`Feedback`,`Reply`) values 
(5,13,10,'I am so satisfied with this rudra veena','Thank you very  much'),
(6,13,4,'It is good','Thank you'),
(7,13,9,'It is nice','thank you'),
(8,14,9,'nice one','');

/*Table structure for table `instrument` */

DROP TABLE IF EXISTS `instrument`;

CREATE TABLE `instrument` (
  `instrument_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `instrument_name` varchar(15) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`instrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `instrument` */

insert  into `instrument`(`instrument_id`,`cat_id`,`brand`,`image`,`instrument_name`,`price`,`stock`,`description`) values 
(4,11,'Kala','uploads/20220223164947.jpg','Soprano ukulele',1200,44,'Kala KA-MK-C Makala Concert Ukulele'),
(8,9,'Yamaha','uploads/20220222072645.jpg','Bass guitar',3000,0,'YAMAHA TRBX174, 4-String Electric Bass Guitar -  Gig Bag Electro-acoustic Guitar '),
(9,13,'Sarangi','uploads/20220223165018.jpg','Wooden flute',568,25,'Sarangi Musical Bamboo Flutes Bansuri C Natural Right Handed Middle (19 inch) '),
(10,12,'Generic','uploads/20220223165043.jpg','Rudra veena',1190,10,'Tube resonator made of stained toon wood, 20 chromatic frets bound to the tube'),
(11,14,'Artesia','uploads/20220223165103.jpg','Digital piano',1190,17,'Artesia A-61 61-Key Digital Piano- Black'),
(12,9,'Yamaha','uploads/20220222073903.jpg','Electric guitar',3000,1,'Yamaha RGX121Z Black Electric Guitar'),
(13,9,'Gretsch','uploads/20220223165128.jpg','Archtop guitar',6,15,'Gretsch G2420T Streamliner Hollow Body Bigsby Electric Guitar'),
(14,9,'LAVA','uploads/20220223165150.jpg','Touch guitar',6999,24,'LAVA ME 2 Carbon Fiber Guitar with Effects 36 Inch '),
(15,9,'Yamaha','uploads/20220222154817.jpg','Jazz guitar',16000,1,'Yamaha RS320  jazz guitar\r\n'),
(16,10,'Premier','uploads/20220223165238.jpg','Bass drum',1600,5,'Bass drum Premier'),
(17,10,'Havana','uploads/20220301150822.jpg','Drum set',5000,20,'Havana Imported HV522 Acoustic Drum Set (Wine Red)'),
(18,15,'Generic','uploads/20220223165218.jpg','Fiddel',2000,6,'Full Size 4/4 Hand-Carved Solid Spruce Top, Solid Maple Back & Sides, JRV212NT with Redwood Bow, Ros'),
(19,10,'RAM','uploads/20220301145128.jpg','Djembe',2000,40,'RAM musical Djembe shiny polish '),
(20,10,'Yamaha','uploads/20220301152421.jpg','Timpani',1200,5,'Timpani-TP-4300'),
(21,10,'Latin Percussion','uploads/20220301152757.jpg','Bongos',3500,25,'Latin Percussion CP221-AW, Multi-Colour');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`uid`,`username`,`pwd`,`type`) values 
(1,'admin','admin','admin'),
(2,'user','user','user'),
(3,'praveen','123','user'),
(4,'a','a','user'),
(5,'b','b','user'),
(6,'bgen','bgen','user'),
(7,'prav','prav','user'),
(8,'abcd','abcd','user'),
(9,'abcd','abcd','user'),
(10,'asdasd','1','user'),
(11,'Akshay','akshay123','user'),
(12,'Anagha','anagha1999','user'),
(13,'Vyshak','vyshak123','user'),
(14,'Abhi','abhilash123','user'),
(15,'Manoj','manoj123','user'),
(16,'Shilpa','shilpa99','user'),
(17,'Amjad','amjad1999','user'),
(18,'Sree','sreepad98','user'),
(19,'Swathi','swathi123','user'),
(20,'Sharia','sharia123','user'),
(21,'Nayana','nayana98','user'),
(22,'Shehala','shehala123','user');

/*Table structure for table `ordertab` */

DROP TABLE IF EXISTS `ordertab`;

CREATE TABLE `ordertab` (
  `ordno` int(11) NOT NULL AUTO_INCREMENT,
  `instrument_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `Proof` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ordno`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `ordertab` */

insert  into `ordertab`(`ordno`,`instrument_id`,`qty`,`price`,`status`,`uid`,`Proof`,`Date`) values 
(13,8,2,3000,'Accept',1,'uploads/20220222075113.jpg','2022-02-22'),
(14,9,1,568,'Ordered',1,'uploads/20220222105635.jpg','2022-02-22'),
(28,4,2,1200,'Accept',13,'uploads/20220223165859.jpeg','2022-02-23'),
(30,8,1,3000,'Ordered',13,'uploads/20220224052815.jpeg','2022-02-24'),
(36,4,1,1200,'Ordered',14,'uploads/20220225085638.jpeg','2022-02-25'),
(37,11,1,1190,'Ordered',14,'uploads/20220225085638.jpeg','2022-02-25'),
(38,9,1,568,'Accept',11,'uploads/20220302065720.jpg','2022-03-02'),
(39,11,1,1190,'Accept',22,'uploads/20220302074940.jpg','2022-03-02'),
(41,4,2,12000,'Ordered',12,'uploads/20220302080009.jpg','2022-03-02');

/*Table structure for table `registration` */

DROP TABLE IF EXISTS `registration`;

CREATE TABLE `registration` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(20) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `registration` */

insert  into `registration`(`uid`,`Fullname`,`Username`,`Address`,`Email`,`Phone`) values 
(11,'Akshay Kumar','','Sopanam(H),Ambanoli Parambe,PO Chevarmabalam,Kozhikode,Kerala','akshay123@gmail.com','9746752421'),
(12,'Anagha Manoj','Anagha','House No:116,\r\nSopanam(H),\r\nAmbanoli parambe,\r\nPO Chevarambalam','anagha@gmail.com','9567793238'),
(13,'Vyshak K','Vyshak','Vyshakham(H),PO Marikkunne,Kozhikode,Kerala','vyshakachu@gmail.com','8921789645'),
(14,'Abhilash','Abhi','Puthukkudi(H),PO Chelavoor,Kozhikode,Kerala','abhip@gmail.com','9657843120'),
(15,'Manoj Kumar','Manoj','Ushas,Ambanoli Parambe,PO Marikkunne,Kerala','manoj67@gmail.com','9048098765'),
(16,'Shilpa Sajeev','Shilpa','Shilpam, Orchid valley, Kozhikode, Kerala','shilpa@gmail.com','9567793238'),
(17,'Amjad Faizal','Amjad','Faizal Manzil,Vellimadukkunne,Kozhikode,Kerala','amjadvk@gmail.com','8921789645'),
(18,'Sreepad E','Sree','Sreepadam(H),Paropadi,Kozhikode,Kerala','sreepadsree19@gmail.com','7736684876'),
(19,'Swathi santhosh','Swathi','Nest, Kozhikode,Kerala-673017','swathi@gmail.com','7689074512'),
(20,'Aysha Sharia','Sharia','Razak Manzil, Kappad, Kozhikode, Kerala','sharia@gmail.com','7658952320'),
(21,'Nayana P','Nayana','Nayanam (H), PO Chevarambalam, Kozhikode, Kerala','nayanap@gmail.com','9765432870'),
(22,'Shehala Akbar','Shehala','Shehala Manzil, Koyilandi,Kozhikode,Kerala','shehalavp@gmail.com','9867455431');

/*Table structure for table `repair` */

DROP TABLE IF EXISTS `repair`;

CREATE TABLE `repair` (
  `rep_id` int(11) NOT NULL AUTO_INCREMENT,
  `User` int(11) NOT NULL,
  `Instrument` int(11) NOT NULL,
  `Problem` varchar(200) NOT NULL,
  `Reply` varchar(200) NOT NULL,
  PRIMARY KEY (`rep_id`),
  KEY `repair_ibfk_1` (`Instrument`),
  CONSTRAINT `repair_ibfk_1` FOREIGN KEY (`Instrument`) REFERENCES `instrument` (`instrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `repair` */

insert  into `repair`(`rep_id`,`User`,`Instrument`,`Problem`,`Reply`) values 
(3,13,4,'Want to tighten the string','Our customer care executive 	will contact you soon');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
