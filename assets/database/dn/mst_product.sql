/*
Navicat MySQL Data Transfer

Source Server         : mysql local
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : do_oee

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2020-06-21 23:56:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mst_product
-- ----------------------------
DROP TABLE IF EXISTS `mst_product`;
CREATE TABLE `mst_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `product` (`product_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of mst_product
-- ----------------------------
INSERT INTO `mst_product` VALUES ('2', 'Vitacimin 100B');
INSERT INTO `mst_product` VALUES ('3', 'Vitacimin 100C');
INSERT INTO `mst_product` VALUES ('1', 'Vitacimin 100T');
