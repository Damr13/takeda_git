/*
Navicat MySQL Data Transfer

Source Server         : mysql local
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : do_oee

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2020-06-21 01:45:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mst_pic
-- ----------------------------
DROP TABLE IF EXISTS `mst_pic`;
CREATE TABLE `mst_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `shift` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of mst_pic
-- ----------------------------
INSERT INTO `mst_pic` VALUES ('1', 'Irsyad', 'Leader', '1');
INSERT INTO `mst_pic` VALUES ('3', 'Ricky', 'Leader', '3');
INSERT INTO `mst_pic` VALUES ('4', 'Qory', 'Leader', '1');
INSERT INTO `mst_pic` VALUES ('5', 'Eli', 'Operator', '2');
INSERT INTO `mst_pic` VALUES ('6', 'Yogi', 'Leader', '2');
INSERT INTO `mst_pic` VALUES ('9', 'Zaenal', 'Operator', '3');
INSERT INTO `mst_pic` VALUES ('10', 'Rangga', 'Operator', '1');
INSERT INTO `mst_pic` VALUES ('11', 'Dimas', 'Operator', '1');
INSERT INTO `mst_pic` VALUES ('12', 'Rangga', 'Leader', '3');
