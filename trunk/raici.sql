-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2015 at 05:36 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `raici`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE IF NOT EXISTS `master_barang` (
`id_barang` int(15) NOT NULL,
  `id_produksi` int(15) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ket` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `id_produksi`, `nama`, `ket`) VALUES
(1, 2345, 'Samsung Galaxy Tab 3', ' Keren banget, harganya tapi mahal...'),
(2, 4534, 'Mouse Gamming', 'Mouse gamming canggih'),
(3, 3435, 'Samsung Kacang Godog', 'Kacang godong yang terbuat dari coklat swiss pilihan'),
(4, 5467, 'Kacang Garing', 'Kacang garing yang direbus setengah matang'),
(5, 8790, 'Pensil sam  putih', 'pensil yang tidak memerlukan penghapus, karena berwarna putih'),
(6, 2479, 'Handphone 2456', 'Handphone yang tidak ada yang punya, karena cuman nama'),
(7, 6648, 'Tempe Godog', 'Tempe godog yang bikin tambah laperrrr'),
(9, 3793, 'Kucing Samsung ', 'Kucing yang sangat agresif sekali');

-- --------------------------------------------------------

--
-- Table structure for table `master_pesan`
--

CREATE TABLE IF NOT EXISTS `master_pesan` (
`id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_pesan`
--

INSERT INTO `master_pesan` (`id`, `nama`, `email`, `pesan`) VALUES
(10, 'Bahrun Ghozali', 'bahrun@ghozali.com', 'Nama saya bahrun ghozali'),
(12, 'Hasyim Asy''ari', 'hasyim@hasyim.com', 'Testing aja'),
(13, 'Dibyo Sudarsono', 'dibyo@rai.asia', 'Ini pesan dari Dibyo mas berooo...'),
(19, 'Abid Fauzi', 'ahamt@fauzi.com', 'yah nama saya abid fauzi ajah'),
(20, 'Susan', 'susan@khoiruddin.com', 'Disini pesannya'),
(21, 'SlametA', 'slamet@khoir.com', 'yaaa ini slamet');

-- --------------------------------------------------------

--
-- Table structure for table `rc_groups`
--

CREATE TABLE IF NOT EXISTS `rc_groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rc_groups`
--

INSERT INTO `rc_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Merupakan akun Super Admin, bisa akses semua'),
(2, 'member', 'Grup dengan akses limited'),
(3, 'super_admin', 'Special group for RAI team only'),
(4, 'ecek_ecek', 'Ecek ecek'),
(5, 'ra_jelas', 'Ra Jelas');

-- --------------------------------------------------------

--
-- Table structure for table `rc_login_attempts`
--

CREATE TABLE IF NOT EXISTS `rc_login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rc_options`
--

CREATE TABLE IF NOT EXISTS `rc_options` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rc_options`
--

INSERT INTO `rc_options` (`id`, `name`, `value`) VALUES
(1, 'site_title', 'Khoiruddin.Com'),
(2, 'site_tagline', 'Khoirunnaas Anf''uhum Linnaas'),
(3, 'site_desc', 'Web-blog pribadi Muhammad Khoiruddin'),
(4, 'admin_email', 'contact@khoiruddin.com'),
(5, 'super_admin_group', 'super_admin'),
(6, 'admin_group', 'admin'),
(7, 'default_group', 'member'),
(8, 'identity', 'username');

-- --------------------------------------------------------

--
-- Table structure for table `rc_permissions`
--

CREATE TABLE IF NOT EXISTS `rc_permissions` (
`id` bigint(20) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `role_id` int(11) unsigned NOT NULL,
  `rule` char(4) NOT NULL DEFAULT '0000'
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rc_permissions`
--

INSERT INTO `rc_permissions` (`id`, `group_id`, `role_id`, `rule`) VALUES
(30, 3, 45, '0100'),
(31, 3, 46, '0100'),
(32, 3, 47, '0100'),
(33, 3, 48, '0100'),
(34, 3, 49, '0100'),
(35, 3, 50, '0100'),
(36, 3, 41, '1111'),
(37, 3, 51, '1111'),
(46, 1, 45, '0100'),
(47, 1, 46, '0100'),
(48, 1, 47, '0100'),
(49, 1, 48, '0100'),
(50, 1, 49, '0100'),
(51, 1, 50, '0100'),
(52, 1, 41, '1111'),
(53, 1, 51, '1111'),
(54, 2, 45, '0100'),
(55, 2, 46, '0100'),
(56, 2, 47, '0100'),
(57, 2, 48, '0100'),
(58, 2, 49, '0100'),
(59, 2, 50, '0100'),
(60, 2, 41, '1111');

-- --------------------------------------------------------

--
-- Table structure for table `rc_roles`
--

CREATE TABLE IF NOT EXISTS `rc_roles` (
`id` int(11) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `url` varchar(70) CHARACTER SET latin1 DEFAULT NULL,
  `desc` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `parent` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rc_roles`
--

INSERT INTO `rc_roles` (`id`, `category_id`, `name`, `url`, `desc`, `parent`) VALUES
(41, 16, 'Export, Validasi, Paging', 'master_barang', 'Master Data Barang', '0'),
(45, 10, 'Forms', 'forms', 'Desain form general', '0'),
(46, 10, 'Radio Checkboxes', 'radio_checks', 'Desain Radio Button dan Checkbox', '0'),
(47, 10, 'Buttons', 'buttons', 'Desain berbagai macam tombol', '0'),
(48, 10, 'Tables', 'tables', 'Desain berbagai macam tabel', '0'),
(49, 10, 'Icons', 'icons', 'Desain berbagai macam ikon', '0'),
(50, 10, 'Designs', 'designs', 'Variety of design', '1'),
(51, 16, 'Ajax', 'master_pesan', 'Contoh CRUD menggunakan Ajax', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rc_roles_category`
--

CREATE TABLE IF NOT EXISTS `rc_roles_category` (
`id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `icon_code` varchar(50) NOT NULL,
  `order_number` tinyint(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rc_roles_category`
--

INSERT INTO `rc_roles_category` (`id`, `category`, `icon_code`, `order_number`) VALUES
(10, 'Designs', 'fa fa-leaf', 2),
(16, 'Contoh', 'fa fa-bars', 1),
(18, 'Mainan', 'fa fa-anchor', 3);

-- --------------------------------------------------------

--
-- Table structure for table `rc_users`
--

CREATE TABLE IF NOT EXISTS `rc_users` (
`id` int(11) unsigned NOT NULL,
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
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rc_users`
--

INSERT INTO `rc_users` (`id`, `first_name`, `ip_address`, `last_name`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `company`, `phone`) VALUES
(1, 'Khoiruddin', '127.0.0.1', 'Khoiruddin', 'super', '$2y$08$toHLx3wJBs57J8EalFFXoep4A.JVMCJb4JCn1jHySQ4HZw4FkkPSG', '', 'muhammad@khoiruddin.com', NULL, 'kNx6Lnfs7271YD56IpdRme0c8f544add9f05c491', 1421251700, NULL, 1268889823, 1423498279, 1, '-', '-'),
(25, 'Abid Fauzi', '127.0.0.1', 'Abid', 'admin', '$2y$08$XuJOE22ymTf2EOtYFMhiPuKu99Fq4N5.zY2.m/4mwIS9kkAEODBom', NULL, 'abid@fauzi.com', NULL, NULL, NULL, NULL, 1421245814, 1423484403, 1, '-', '-'),
(27, 'Fadlurrahman', '127.0.0.1', 'Fadlur', 'member', '$2y$08$vShPnVWPU8A10O8jIObCnuCdvyG4j7OHi9/d0UNsU5b71gxMg.3q.', NULL, 'fadlur@fadlur.com', NULL, NULL, NULL, NULL, 1422287134, 1422978608, 1, '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `rc_users_groups`
--

CREATE TABLE IF NOT EXISTS `rc_users_groups` (
`id` bigint(20) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rc_users_groups`
--

INSERT INTO `rc_users_groups` (`id`, `user_id`, `group_id`) VALUES
(167, 1, 3),
(163, 25, 1),
(168, 27, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
 ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `master_pesan`
--
ALTER TABLE `master_pesan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rc_groups`
--
ALTER TABLE `rc_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rc_login_attempts`
--
ALTER TABLE `rc_login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rc_options`
--
ALTER TABLE `rc_options`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rc_permissions`
--
ALTER TABLE `rc_permissions`
 ADD PRIMARY KEY (`id`), ADD KEY `group_id` (`group_id`), ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `rc_roles`
--
ALTER TABLE `rc_roles`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `url` (`url`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `rc_roles_category`
--
ALTER TABLE `rc_roles_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rc_users`
--
ALTER TABLE `rc_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rc_users_groups`
--
ALTER TABLE `rc_users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
MODIFY `id_barang` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `master_pesan`
--
ALTER TABLE `master_pesan`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `rc_groups`
--
ALTER TABLE `rc_groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rc_login_attempts`
--
ALTER TABLE `rc_login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rc_options`
--
ALTER TABLE `rc_options`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `rc_permissions`
--
ALTER TABLE `rc_permissions`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `rc_roles`
--
ALTER TABLE `rc_roles`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `rc_roles_category`
--
ALTER TABLE `rc_roles_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `rc_users`
--
ALTER TABLE `rc_users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `rc_users_groups`
--
ALTER TABLE `rc_users_groups`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=169;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `rc_permissions`
--
ALTER TABLE `rc_permissions`
ADD CONSTRAINT `rc_permissions_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `rc_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rc_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `rc_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rc_roles`
--
ALTER TABLE `rc_roles`
ADD CONSTRAINT `rc_roles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `rc_roles_category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rc_users_groups`
--
ALTER TABLE `rc_users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `rc_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `rc_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
