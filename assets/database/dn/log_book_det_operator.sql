/*
Navicat MySQL Data Transfer

Source Server         : mysql local
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : do_oee

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2020-06-21 01:44:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log_book_det_operator
-- ----------------------------
DROP TABLE IF EXISTS `log_book_det_operator`;
CREATE TABLE `log_book_det_operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_log_book` int(11) NOT NULL,
  `id_pic` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq1` (`id_log_book`,`id_pic`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log_book_det_operator
-- ----------------------------
INSERT INTO `log_book_det_operator` VALUES ('1', '1', '10');
INSERT INTO `log_book_det_operator` VALUES ('2', '2', '5');
INSERT INTO `log_book_det_operator` VALUES ('3', '3', '9');
