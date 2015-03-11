/*
SQLyog Ultimate v9.50 
MySQL - 5.5.39 : Database - db_pilar
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `album` */

DROP TABLE IF EXISTS `album`;

CREATE TABLE `album` (
  `id_album` int(4) NOT NULL AUTO_INCREMENT,
  `album` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `album` */

/*Table structure for table `berita` */

DROP TABLE IF EXISTS `berita`;

CREATE TABLE `berita` (
  `id_berita` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `konten` text,
  `slug` varchar(100) DEFAULT NULL,
  `keyword` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `berita` */

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id_gallery` int(4) NOT NULL AUTO_INCREMENT,
  `id_album` int(4) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_gallery`),
  KEY `id_album` (`id_album`),
  CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gallery` */

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `id_jadwal` int(4) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(100) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `konten` text,
  `slug` varchar(100) DEFAULT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jadwal` */

/*Table structure for table `klien` */

DROP TABLE IF EXISTS `klien`;

CREATE TABLE `klien` (
  `id_klien` int(4) NOT NULL AUTO_INCREMENT,
  `nama_klien` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `konten` text,
  PRIMARY KEY (`id_klien`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `klien` */

/*Table structure for table `layanan` */

DROP TABLE IF EXISTS `layanan`;

CREATE TABLE `layanan` (
  `id_layanan` int(4) NOT NULL AUTO_INCREMENT,
  `layanan` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `slug` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`id_layanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `layanan` */

/*Table structure for table `master_barang` */

DROP TABLE IF EXISTS `master_barang`;

CREATE TABLE `master_barang` (
  `id_barang` int(15) NOT NULL AUTO_INCREMENT,
  `id_produksi` int(15) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ket` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `master_barang` */

insert  into `master_barang`(`id_barang`,`id_produksi`,`nama`,`ket`) values (1,2345,'Samsung Galaxy Tab 3',' Keren banget, harganya tapi mahal...'),(2,4534,'Mouse Gamming','Mouse gamming canggih'),(3,3435,'Samsung Kacang Godog','Kacang godong yang terbuat dari coklat swiss pilihan'),(4,5467,'Kacang Garing','Kacang garing yang direbus setengah matang'),(5,8790,'Pensil sam  putih','pensil yang tidak memerlukan penghapus, karena berwarna putih'),(6,2479,'Handphone 2456','Handphone yang tidak ada yang punya, karena cuman nama'),(7,6648,'Tempe Godog','Tempe godog yang bikin tambah laperrrr'),(9,3793,'Kucing Samsung ','Kucing yang sangat agresif sekali');

/*Table structure for table `master_pesan` */

DROP TABLE IF EXISTS `master_pesan`;

CREATE TABLE `master_pesan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `master_pesan` */

insert  into `master_pesan`(`id`,`nama`,`email`,`pesan`) values (10,'Bahrun Ghozali','bahrun@ghozali.com','Nama saya bahrun ghozali'),(12,'Hasyim Asy\'ari','hasyim@hasyim.com','Testing aja'),(13,'Dibyo Sudarsono','dibyo@rai.asia','Ini pesan dari Dibyo mas berooo...'),(19,'Abid Fauzi','ahamt@fauzi.com','yah nama saya abid fauzi ajah'),(20,'Susan','susan@khoiruddin.com','Disini pesannya'),(21,'SlametA','slamet@khoir.com','yaaa ini slamet');

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `id_profil` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `konten` text,
  `slug` varchar(100) DEFAULT NULL,
  `keyword` varchar(200) DEFAULT NULL,
  `urutan` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profil` */

/*Table structure for table `rc_groups` */

DROP TABLE IF EXISTS `rc_groups`;

CREATE TABLE `rc_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `rc_groups` */

insert  into `rc_groups`(`id`,`name`,`description`) values (1,'admin','Merupakan akun Super Admin, bisa akses semua'),(2,'member','Grup dengan akses limited'),(3,'super_admin','Special group for RAI team only'),(4,'ecek_ecek','Ecek ecek'),(5,'ra_jelas','Ra Jelas');

/*Table structure for table `rc_login_attempts` */

DROP TABLE IF EXISTS `rc_login_attempts`;

CREATE TABLE `rc_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rc_login_attempts` */

/*Table structure for table `rc_options` */

DROP TABLE IF EXISTS `rc_options`;

CREATE TABLE `rc_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `rc_options` */

insert  into `rc_options`(`id`,`name`,`value`) values (1,'site_title','Khoiruddin.Com'),(2,'site_tagline','Khoirunnaas Anf\'uhum Linnaas'),(3,'site_desc','Web-blog pribadi Muhammad Khoiruddin'),(4,'admin_email','contact@khoiruddin.com'),(5,'super_admin_group','super_admin'),(6,'admin_group','admin'),(7,'default_group','member'),(8,'identity','username');

/*Table structure for table `rc_permissions` */

DROP TABLE IF EXISTS `rc_permissions`;

CREATE TABLE `rc_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `role_id` int(11) unsigned NOT NULL,
  `rule` char(4) NOT NULL DEFAULT '0000',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `rc_permissions_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `rc_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rc_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `rc_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

/*Data for the table `rc_permissions` */

insert  into `rc_permissions`(`id`,`group_id`,`role_id`,`rule`) values (30,3,45,'0100'),(31,3,46,'0100'),(32,3,47,'0100'),(33,3,48,'0100'),(34,3,49,'0100'),(35,3,50,'0100'),(36,3,41,'1111'),(37,3,51,'1111'),(46,1,45,'0100'),(47,1,46,'0100'),(48,1,47,'0100'),(49,1,48,'0100'),(50,1,49,'0100'),(51,1,50,'0100'),(52,1,41,'1111'),(53,1,51,'1111'),(54,2,45,'0100'),(55,2,46,'0100'),(56,2,47,'0100'),(57,2,48,'0100'),(58,2,49,'0100'),(59,2,50,'0100'),(60,2,41,'1111');

/*Table structure for table `rc_roles` */

DROP TABLE IF EXISTS `rc_roles`;

CREATE TABLE `rc_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `url` varchar(70) CHARACTER SET latin1 DEFAULT NULL,
  `desc` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `parent` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `rc_roles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `rc_roles_category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*Data for the table `rc_roles` */

insert  into `rc_roles`(`id`,`category_id`,`name`,`url`,`desc`,`parent`) values (41,16,'Export, Validasi, Paging','master_barang','Master Data Barang','0'),(45,10,'Forms','forms','Desain form general','0'),(46,10,'Radio Checkboxes','radio_checks','Desain Radio Button dan Checkbox','0'),(47,10,'Buttons','buttons','Desain berbagai macam tombol','0'),(48,10,'Tables','tables','Desain berbagai macam tabel','0'),(49,10,'Icons','icons','Desain berbagai macam ikon','0'),(50,10,'Designs','designs','Variety of design','1'),(51,16,'Ajax','master_pesan','Contoh CRUD menggunakan Ajax','0');

/*Table structure for table `rc_roles_category` */

DROP TABLE IF EXISTS `rc_roles_category`;

CREATE TABLE `rc_roles_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `icon_code` varchar(50) NOT NULL,
  `order_number` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `rc_roles_category` */

insert  into `rc_roles_category`(`id`,`category`,`icon_code`,`order_number`) values (10,'Designs','fa fa-leaf',2),(16,'Contoh','fa fa-bars',1),(18,'Mainan','fa fa-anchor',3);

/*Table structure for table `rc_users` */

DROP TABLE IF EXISTS `rc_users`;

CREATE TABLE `rc_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `rc_users` */

insert  into `rc_users`(`id`,`first_name`,`ip_address`,`last_name`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`company`,`phone`) values (1,'Khoiruddin','127.0.0.1','Khoiruddin','super','$2y$08$toHLx3wJBs57J8EalFFXoep4A.JVMCJb4JCn1jHySQ4HZw4FkkPSG','','muhammad@khoiruddin.com',NULL,'kNx6Lnfs7271YD56IpdRme0c8f544add9f05c491',1421251700,NULL,1268889823,1423498279,1,'-','-'),(25,'Abid Fauzi','127.0.0.1','Abid','admin','$2y$08$XuJOE22ymTf2EOtYFMhiPuKu99Fq4N5.zY2.m/4mwIS9kkAEODBom',NULL,'abid@fauzi.com',NULL,NULL,NULL,NULL,1421245814,1426082963,1,'-','-'),(27,'Fadlurrahman','127.0.0.1','Fadlur','member','$2y$08$vShPnVWPU8A10O8jIObCnuCdvyG4j7OHi9/d0UNsU5b71gxMg.3q.',NULL,'fadlur@fadlur.com',NULL,NULL,NULL,NULL,1422287134,1422978608,1,'-','-');

/*Table structure for table `rc_users_groups` */

DROP TABLE IF EXISTS `rc_users_groups`;

CREATE TABLE `rc_users_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `rc_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `rc_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

/*Data for the table `rc_users_groups` */

insert  into `rc_users_groups`(`id`,`user_id`,`group_id`) values (167,1,3),(163,25,1),(168,27,2);

/*Table structure for table `slider` */

DROP TABLE IF EXISTS `slider`;

CREATE TABLE `slider` (
  `id_slider` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `slider` */

/*Table structure for table `sub_layanan` */

DROP TABLE IF EXISTS `sub_layanan`;

CREATE TABLE `sub_layanan` (
  `id_sub_layanan` int(4) NOT NULL AUTO_INCREMENT,
  `id_layanan` int(4) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `konten` text,
  `slug` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_sub_layanan`),
  KEY `id_layanan` (`id_layanan`),
  CONSTRAINT `sub_layanan_ibfk_1` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sub_layanan` */

/*Table structure for table `testimoni` */

DROP TABLE IF EXISTS `testimoni`;

CREATE TABLE `testimoni` (
  `id_testimoni` int(4) NOT NULL AUTO_INCREMENT,
  `testimoni` text,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_testimoni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `testimoni` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
