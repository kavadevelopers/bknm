-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 09, 2019 at 11:42 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `empty-champs`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_deactivation`
--

DROP TABLE IF EXISTS `agent_deactivation`;
CREATE TABLE IF NOT EXISTS `agent_deactivation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent` varchar(250) NOT NULL COMMENT 'Number Of Agents',
  `saller` varchar(250) NOT NULL COMMENT 'Number Of Sallers',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent_deactivation`
--

INSERT INTO `agent_deactivation` (`id`, `agent`, `saller`) VALUES
(1, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `agent_details`
--

DROP TABLE IF EXISTS `agent_details`;
CREATE TABLE IF NOT EXISTS `agent_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fi_name` varchar(50) NOT NULL COMMENT 'First Name',
  `mi_name` varchar(50) NOT NULL COMMENT 'MiddleName',
  `la_name` varchar(50) NOT NULL COMMENT 'Last Name',
  `fa_name` varchar(50) NOT NULL,
  `mo_name` varchar(50) NOT NULL,
  `bdate` date NOT NULL COMMENT 'Birth Date',
  `jdate` date NOT NULL COMMENT 'Joining Date',
  `year` varchar(10) NOT NULL,
  `proof_type` varchar(250) NOT NULL,
  `proof_num` varchar(250) NOT NULL,
  `quali` varchar(150) NOT NULL COMMENT 'Qualification',
  `desig` varchar(60) NOT NULL COMMENT 'Designation',
  `email` varchar(110) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `mobile2` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `state` varchar(60) NOT NULL,
  `bank` varchar(60) NOT NULL,
  `ac_number` varchar(30) NOT NULL COMMENT 'A/C Number',
  `ifsc_code` varchar(30) NOT NULL,
  `branch_name` varchar(60) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `gur_type` varchar(250) NOT NULL,
  `gur_name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agent_promotion`
--

DROP TABLE IF EXISTS `agent_promotion`;
CREATE TABLE IF NOT EXISTS `agent_promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `silver` varchar(250) NOT NULL,
  `gold` varchar(250) NOT NULL,
  `diamond` varchar(250) NOT NULL,
  `super` varchar(250) NOT NULL,
  `silver_commission` decimal(40,2) NOT NULL DEFAULT '0.00',
  `gold_commission` decimal(40,2) NOT NULL,
  `diamond_commission` decimal(40,2) NOT NULL,
  `super_commission` decimal(40,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent_promotion`
--

INSERT INTO `agent_promotion` (`id`, `silver`, `gold`, `diamond`, `super`, `silver_commission`, `gold_commission`, `diamond_commission`, `super_commission`) VALUES
(1, '2400', '5000', '10000', '12100', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `auth_key`
--

DROP TABLE IF EXISTS `auth_key`;
CREATE TABLE IF NOT EXISTS `auth_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(250) NOT NULL,
  `for` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_key`
--

INSERT INTO `auth_key` (`id`, `code`, `for`) VALUES
(1, '2019', 'subadmin'),
(2, '2019', 'business'),
(3, '2019', 'agent'),
(4, '2019', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank` varchar(250) NOT NULL,
  `ac_name` varchar(250) NOT NULL,
  `ac_no` varchar(250) NOT NULL,
  `ifsc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank`, `ac_name`, `ac_no`, `ifsc`) VALUES
(1, 'Axis Bank', 'Champs', '31756395963', 'AXIS0015820');

-- --------------------------------------------------------

--
-- Table structure for table `binary`
--

DROP TABLE IF EXISTS `binary`;
CREATE TABLE IF NOT EXISTS `binary` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `agent_id` varchar(250) NOT NULL,
  `parent` varchar(50) NOT NULL,
  `left` varchar(50) NOT NULL,
  `right` varchar(50) NOT NULL,
  `coustmer` varchar(250) NOT NULL,
  `last_leg` varchar(250) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'active - 0, non-active - 1',
  `promotion` varchar(250) NOT NULL DEFAULT 'none',
  `leg` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_partners`
--

DROP TABLE IF EXISTS `business_partners`;
CREATE TABLE IF NOT EXISTS `business_partners` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fi_name` varchar(50) NOT NULL COMMENT 'First Name',
  `mi_name` varchar(50) NOT NULL COMMENT 'Middle Name',
  `la_name` varchar(50) NOT NULL COMMENT 'Last Name',
  `fa_name` varchar(50) NOT NULL,
  `mo_name` varchar(50) NOT NULL,
  `bdate` date NOT NULL COMMENT 'Birth Date',
  `jdate` date NOT NULL COMMENT 'Joining Date',
  `age` varchar(10) NOT NULL,
  `proof_type` varchar(250) NOT NULL,
  `proof_num` varchar(250) NOT NULL,
  `quali` varchar(150) NOT NULL COMMENT 'Qualification',
  `desig` varchar(60) NOT NULL COMMENT 'Designation',
  `email` varchar(110) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `mobile2` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `state` varchar(60) NOT NULL,
  `bank` varchar(60) NOT NULL,
  `ac_number` varchar(30) NOT NULL COMMENT 'A/C Number',
  `ifsc_code` varchar(30) NOT NULL,
  `branch_name` varchar(60) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `persent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sex` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_share`
--

DROP TABLE IF EXISTS `business_share`;
CREATE TABLE IF NOT EXISTS `business_share` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(250) NOT NULL,
  `credit_amount` decimal(40,2) NOT NULL,
  `date` date NOT NULL,
  `payment_mode` varchar(250) NOT NULL,
  `payment_mode_detail` text NOT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` varchar(250) NOT NULL,
  `updated_by` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `create_product`
--

DROP TABLE IF EXISTS `create_product`;
CREATE TABLE IF NOT EXISTS `create_product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(250) NOT NULL,
  `total_land_yard` text NOT NULL,
  `total_land_ht` text,
  `lan_size_sqft` text,
  `product_id` varchar(250) NOT NULL,
  `ploat_land_yard` text NOT NULL,
  `ploat_size_ht` text NOT NULL,
  `ploat_size_sqft` text NOT NULL,
  `date` date DEFAULT NULL,
  `rem_land_yrd` text NOT NULL,
  `rem_land_ht` text NOT NULL,
  `rem_land_sqft` text NOT NULL,
  `ploat_code` varchar(250) NOT NULL,
  `plan_code` varchar(250) NOT NULL,
  `quantity` varchar(250) NOT NULL,
  `selling_amount` decimal(10,0) NOT NULL,
  `direct_agent` decimal(40,2) NOT NULL,
  `parent_direct_agent` decimal(40,2) NOT NULL,
  `other_parent` decimal(40,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1 used',
  `created_by` varchar(250) NOT NULL,
  `updated_by` varchar(250) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `gross` decimal(40,2) NOT NULL,
  `location` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

DROP TABLE IF EXISTS `customer_detail`;
CREATE TABLE IF NOT EXISTS `customer_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fi_name` varchar(50) NOT NULL COMMENT 'First Name',
  `mi_name` varchar(50) NOT NULL COMMENT 'MiddleName',
  `la_name` varchar(50) NOT NULL COMMENT 'Last Name',
  `bdate` date NOT NULL COMMENT 'Birth Date',
  `gur_type` varchar(250) NOT NULL,
  `gur_name` varchar(250) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `mobile2` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `no_fi_name` varchar(50) NOT NULL COMMENT 'Nominee First Name',
  `no_mi_name` varchar(50) NOT NULL COMMENT 'Nominee MiddleName',
  `no_la_name` varchar(50) NOT NULL COMMENT 'Nominee Last Name',
  `no_gur_type` varchar(250) NOT NULL,
  `no_gur_name` varchar(250) NOT NULL,
  `no_bdate` date NOT NULL COMMENT 'Nominee Birth Date',
  `relation` varchar(50) NOT NULL COMMENT 'Nominee Relationship with customer ',
  `no_address` text NOT NULL COMMENT 'Nominee Address',
  `user_id` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `nage` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `booking` varchar(30) NOT NULL,
  `remarks` text NOT NULL,
  `plan` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
CREATE TABLE IF NOT EXISTS `expense` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `desc` varchar(250) NOT NULL,
  `purchase_id` varchar(50) NOT NULL,
  `amount` decimal(40,2) NOT NULL,
  `date` date NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` varchar(250) NOT NULL,
  `updated_by` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

DROP TABLE IF EXISTS `investment`;
CREATE TABLE IF NOT EXISTS `investment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `invest_amount` decimal(40,2) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_mode` varchar(250) NOT NULL,
  `pay_mode_detail` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` varchar(250) NOT NULL,
  `updated_by` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masterpass`
--

DROP TABLE IF EXISTS `masterpass`;
CREATE TABLE IF NOT EXISTS `masterpass` (
  `id` int(11) NOT NULL,
  `pass` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masterpass`
--

INSERT INTO `masterpass` (`id`, `pass`) VALUES
(1, 'master');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(250) NOT NULL,
  `message` longtext NOT NULL COMMENT 'Description',
  `notification_type` varchar(250) NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 Unread, 1 Read',
  `main_id` varchar(50) NOT NULL,
  `for` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `main_id` varchar(50) NOT NULL COMMENT 'sell id or purchase id',
  `installment_id` varchar(50) NOT NULL COMMENT 'Installment_id',
  `type` varchar(250) NOT NULL COMMENT 'Sell Or Purchase',
  `date` date NOT NULL,
  `amount_install` decimal(30,2) NOT NULL,
  `late_charge` decimal(20,2) NOT NULL,
  `pay_type` varchar(250) NOT NULL,
  `pay_detail` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plan_code`
--

DROP TABLE IF EXISTS `plan_code`;
CREATE TABLE IF NOT EXISTS `plan_code` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `plan_code` varchar(250) NOT NULL,
  `month` varchar(250) NOT NULL,
  `year` varchar(250) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_by` varchar(250) NOT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

DROP TABLE IF EXISTS `prefix`;
CREATE TABLE IF NOT EXISTS `prefix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(250) NOT NULL,
  `prefix` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`id`, `user_type`, `prefix`) VALUES
(1, 'agent', 'AGENT'),
(2, 'subadmin', 'SUB'),
(3, 'business', 'CHMPLBP0'),
(4, 'customer', 'CHMPLREG0'),
(5, 'product', 'CHMPLPD0'),
(6, 'purchase', 'P0'),
(7, 'person', 'CHMPL0');

-- --------------------------------------------------------

--
-- Table structure for table `proof`
--

DROP TABLE IF EXISTS `proof`;
CREATE TABLE IF NOT EXISTS `proof` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proof`
--

INSERT INTO `proof` (`id`, `type`) VALUES
(1, 'AADHAAR NUMBER'),
(2, 'PAN NUMBER'),
(7, 'VOTERID NUMBER'),
(5, 'DRIVING LICENCE'),
(6, 'PASSPORT NUMBER');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `num_of_sellers` varchar(50) NOT NULL,
  `num_of_purchaser` varchar(250) DEFAULT NULL,
  `purchase_id` varchar(250) NOT NULL,
  `date` date DEFAULT NULL,
  `install_packges` varchar(250) DEFAULT NULL,
  `no_of_installment` varchar(250) DEFAULT NULL,
  `time_installment` varchar(250) DEFAULT NULL,
  `conditions` longtext,
  `purchase_amount` decimal(40,2) NOT NULL,
  `adva_payment` decimal(40,2) NOT NULL,
  `bal_amount` decimal(40,2) NOT NULL,
  `rem_land_yrd` text NOT NULL,
  `rem_land_ht` text NOT NULL,
  `rem_land_sqft` text NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_by` varchar(200) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `w_name` varchar(250) NOT NULL,
  `w_mobile` varchar(250) NOT NULL,
  `w_address` text NOT NULL,
  `w2_name` text NOT NULL,
  `w2_mobile` varchar(250) NOT NULL,
  `w2_add` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_installment_detail`
--

DROP TABLE IF EXISTS `purchase_installment_detail`;
CREATE TABLE IF NOT EXISTS `purchase_installment_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `install_packges` varchar(250) NOT NULL COMMENT 'Installment Package',
  `no_of_installment` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  `deal_amount` decimal(20,2) NOT NULL COMMENT ' Deal Amount / Total Amount',
  `adva_payment` decimal(20,2) NOT NULL,
  `instal_amount` decimal(20,2) NOT NULL COMMENT 'Installment Amount / Reamaning Amount',
  `remaining_amount` decimal(20,2) DEFAULT NULL,
  `instl_remaning` decimal(40,2) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `purchase_main_id` varchar(50) NOT NULL,
  `saller_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_land_detail`
--

DROP TABLE IF EXISTS `purchase_land_detail`;
CREATE TABLE IF NOT EXISTS `purchase_land_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(250) NOT NULL,
  `land_detail` longtext,
  `mouza` varchar(200) NOT NULL,
  `tehsil` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `khasra` varchar(200) NOT NULL,
  `land_type` varchar(200) NOT NULL,
  `land_location` varchar(200) NOT NULL,
  `ac_num_land` varchar(200) NOT NULL,
  `total_land_yrd` text NOT NULL,
  `total_land` text NOT NULL COMMENT 'Hectares',
  `per_unit_share` varchar(200) NOT NULL,
  `purchase_amount` varchar(200) NOT NULL,
  `purchase_date` date NOT NULL,
  `lan_size` longtext NOT NULL COMMENT 'Square Feet(Sq.Ft)',
  `adva_payment` varchar(200) NOT NULL,
  `adva_pay_date` date NOT NULL,
  `bal_amount` varchar(200) NOT NULL,
  `time_ward_land` varchar(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `payment_mode_detail` varchar(250) DEFAULT NULL,
  `purchase_main_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_purchaser_dynamic`
--

DROP TABLE IF EXISTS `purchase_purchaser_dynamic`;
CREATE TABLE IF NOT EXISTS `purchase_purchaser_dynamic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pu_name` varchar(250) NOT NULL,
  `pu_gur_type` varchar(250) NOT NULL,
  `pu_gur_name` varchar(250) NOT NULL,
  `pu_address` longtext NOT NULL,
  `pu_state` varchar(250) NOT NULL,
  `pu_bank` varchar(250) NOT NULL,
  `pu_ac_number` varchar(250) NOT NULL,
  `pu_ifsc_code` varchar(250) NOT NULL,
  `pu_email` varchar(250) NOT NULL,
  `pu_mobile` varchar(250) NOT NULL,
  `pu_proof_type` varchar(250) NOT NULL,
  `pu_proof_num` varchar(250) NOT NULL,
  `pu_my_image` varchar(250) NOT NULL DEFAULT 'user.png',
  `main_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_seller_dynamic`
--

DROP TABLE IF EXISTS `purchase_seller_dynamic`;
CREATE TABLE IF NOT EXISTS `purchase_seller_dynamic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `gur_type` varchar(250) NOT NULL COMMENT 'Gudians Type',
  `gur_name` varchar(250) NOT NULL COMMENT 'Gurdians Name',
  `address` text NOT NULL,
  `state` varchar(200) NOT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `ac_number` varchar(200) DEFAULT NULL,
  `ifsc_code` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mobile` varchar(200) NOT NULL,
  `proof_type` varchar(250) NOT NULL,
  `proof_num` varchar(250) NOT NULL,
  `my_image` varchar(250) DEFAULT 'user.png',
  `main_id` varchar(200) NOT NULL,
  `share` decimal(40,2) NOT NULL,
  `advance` decimal(40,2) NOT NULL,
  `balance` decimal(40,2) NOT NULL,
  `p_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sell_installment_detail`
--

DROP TABLE IF EXISTS `sell_installment_detail`;
CREATE TABLE IF NOT EXISTS `sell_installment_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `install_packges` varchar(250) NOT NULL,
  `no_of_installment` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  `deal_amount` decimal(20,2) NOT NULL,
  `adva_payment` decimal(20,2) NOT NULL,
  `instal_amount` decimal(20,2) NOT NULL,
  `remaining_amount` decimal(20,2) DEFAULT NULL,
  `instal_remaining` decimal(40,2) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `sell_product_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sell_product`
--

DROP TABLE IF EXISTS `sell_product`;
CREATE TABLE IF NOT EXISTS `sell_product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `coust_name` varchar(250) NOT NULL,
  `product_id` varchar(250) NOT NULL,
  `selling_amount` decimal(20,2) NOT NULL,
  `ploat_size_yrd` text NOT NULL,
  `ploat_size` varchar(250) NOT NULL,
  `ploat_size_h` text NOT NULL,
  `adva_payment` decimal(20,2) NOT NULL,
  `rem_amount` decimal(20,2) NOT NULL,
  `payment_mode` varchar(250) NOT NULL,
  `pay_detail` text NOT NULL,
  `date` date NOT NULL,
  `first_receipt_date` date DEFAULT NULL,
  `receipt_no` varchar(250) NOT NULL,
  `book_no` varchar(250) NOT NULL,
  `install_packges` varchar(250) NOT NULL,
  `no_of_installment` varchar(250) DEFAULT NULL,
  `time_installment` varchar(250) DEFAULT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_by` varchar(250) NOT NULL,
  `delete_flag` tinyint(250) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `remarks` text NOT NULL,
  `plan_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `share_parterner`
--

DROP TABLE IF EXISTS `share_parterner`;
CREATE TABLE IF NOT EXISTS `share_parterner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parterner` varchar(50) NOT NULL,
  `amount` decimal(40,2) NOT NULL,
  `percent` decimal(5,2) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subadmin_details`
--

DROP TABLE IF EXISTS `subadmin_details`;
CREATE TABLE IF NOT EXISTS `subadmin_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) NOT NULL,
  `middle_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `mobile2` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `state` varchar(60) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subadmin_details`
--

INSERT INTO `subadmin_details` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `mobile`, `mobile2`, `address`, `city`, `zip`, `state`, `user_id`, `sex`) VALUES
(1, 'Super', '', 'User', 'admin@admin.com', '9898989898', '', 'Mall Road, Kanpur', 'Kanpur', '556688', 'Delhi', '1', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(250) NOT NULL COMMENT 'sale,purchase,credit,debit,payments',
  `credit` decimal(40,2) NOT NULL,
  `debit` decimal(40,2) NOT NULL,
  `credit_by` varchar(50) NOT NULL,
  `debit_by` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `investment_id` bigint(20) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(20) NOT NULL,
  `user_type_id` varchar(50) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `reference_id` varchar(50) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `image` varchar(250) NOT NULL DEFAULT 'user.png',
  `key_persons` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_type`, `user_type_id`, `user_name`, `pass`, `email`, `mobile`, `reference_id`, `delete_flag`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`, `image`, `key_persons`) VALUES
(1, 'subadmin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', '9898989898', '0', 0, '0', '1', '2018-11-30 06:34:34', '2019-01-27 17:33:32', NULL, '722647ad7a43bed21b2b2c880bec59ac.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_request`
--

DROP TABLE IF EXISTS `withdraw_request`;
CREATE TABLE IF NOT EXISTS `withdraw_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(250) NOT NULL,
  `withdraw_amount` decimal(40,2) NOT NULL,
  `date` date NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Not Confrim, 1=>Confirm, 2=> Reject',
  `created_by` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
