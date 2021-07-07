/*
Navicat MySQL Data Transfer

Source Server         : mysql local
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : do_oee

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2020-06-21 01:45:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mst_time_shift
-- ----------------------------
DROP TABLE IF EXISTS `mst_time_shift`;
CREATE TABLE `mst_time_shift` (
  `id` int(11) NOT NULL,
  `codeShift` varchar(11) NOT NULL,
  `startShift` time(6) DEFAULT NULL,
  `endShift` time(6) DEFAULT NULL,
  PRIMARY KEY (`codeShift`,`id`),
  UNIQUE KEY `code` (`codeShift`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of mst_time_shift
-- ----------------------------
INSERT INTO `mst_time_shift` VALUES ('1', 'S1', '09:00:00.000000', '16:55:00.000000');
INSERT INTO `mst_time_shift` VALUES ('2', 'S2', '17:00:00.000000', '00:55:00.000000');
INSERT INTO `mst_time_shift` VALUES ('3', 'S3', '01:00:00.000000', '07:55:00.000000');
