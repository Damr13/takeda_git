/*
Navicat MySQL Data Transfer

Source Server         : mysql local
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : do_oee

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2020-06-21 01:44:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log_book
-- ----------------------------
DROP TABLE IF EXISTS `log_book`;
CREATE TABLE `log_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `shift` varchar(255) DEFAULT NULL,
  `operator` varchar(255) DEFAULT NULL,
  `leader` varchar(255) DEFAULT NULL,
  `log` text,
  `state` varchar(255) DEFAULT NULL,
  `machine` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `product_batch` varchar(20) DEFAULT NULL,
  `product_good` int(10) DEFAULT NULL,
  `product_reject` int(10) DEFAULT NULL,
  `user_locked` int(11) DEFAULT NULL,
  `time_locked` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `log1` (`date`,`shift`,`machine`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of log_book
-- ----------------------------
INSERT INTO `log_book` VALUES ('1', '2020-06-21', '1', null, '1', null, 'lock', '1', '3', '55555555', '3000', '100', '5', '2020-06-21 01:17:00');
INSERT INTO `log_book` VALUES ('2', '2020-06-21', '2', null, '6', null, 'lock', '1', '1', '7', '1000', '20', '5', '2020-06-21 01:19:00');
INSERT INTO `log_book` VALUES ('3', '2020-06-21', '3', null, '12', null, 'lock', '1', '2', '777', '100', '3', '5', '2020-06-21 01:20:00');
