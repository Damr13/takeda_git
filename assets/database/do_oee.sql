/*
 Navicat Premium Data Transfer

 Source Server         : myConnection
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : do_oee

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 13/06/2020 21:23:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'takeda', '42ce2f91530a3e22f4112ac9c069de75', 'takeda', NULL);

-- ----------------------------
-- Table structure for log_book
-- ----------------------------
DROP TABLE IF EXISTS `log_book`;
CREATE TABLE `log_book`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime(0) NULL DEFAULT NULL,
  `machine` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shift` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `operator` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `leader` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `log` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_book
-- ----------------------------
INSERT INTO `log_book` VALUES (1, '2020-06-11 16:16:36', 'A', '1', 'Qory', 'Irsyad', '08:00, 1, 08:05, 1, 08:10, 1, 08:15, 1, 08:20, 1, 08:25, 1, 08:30, 1, 08:35, 1, 08:40, 1, 08:45, 1, 08:50, 1, 08:55, 1, 09:00, 1, 09:05, 1, 09:10, 1, 09:15, 1, 09:20, 1, 09:25, 1, 09:30, 1, 09:35, 1, 09:40, 1, 09:45, 1, 09:50, 1, 09:55, 1, 10:00, 1, 10:05, 1, 10:10, 1, 10:15, 1, 10:20, 1, 10:25, 1, 10:30, 1, 10:35, 1, 10:40, 1, 10:45, 1, 10:50, 1, 10:55, 1, 11:00, 1, 11:05, 1, 11:10, 1, 11:15, 1, 11:20, 1, 11:25, 1, 11:30, 1, 11:35, 1, 11:40, 1, 11:45, 1, 11:50, 1, 11:55, 1, 12:00, 1, 12:05, 1, 12:10, 1, 12:15, 1, 12:20, 1, 12:25, 1, 12:30, 1, 12:35, 1, 12:40, 1, 12:45, 1, 12:50, 1, 12:55, 1, 13:00, 1, 13:05, 1, 13:10, 1, 13:15, 1, 13:20, 1, 13:25, 1, 13:30, 1, 13:35, 1, 13:40, 1, 13:45, 1, 13:50, 1, 13:55, 1, 14:00, 1, 14:05, 1, 14:10, 1, 14:15, 1, 14:20, 1, 14:25, 1, 14:30, 1, 14:35, 1, 14:40, 1, 14:45, 1, 14:50, 1, 14:55, 1, 15:00, 1, 15:05, 1, 15:10, 1, 15:15, 1, 15:20, 1, 15:25, 1, 15:30, 1, 15:35, 1, 15:40, 1, 15:45, 1, 15:50, 1, 15:55, 1, ');
INSERT INTO `log_book` VALUES (2, '2020-06-11 16:16:40', 'A', '2', 'Eli', 'Ricky', '16:00, 1, 16:05, 1, 16:10, 1, 16:15, 1, 16:20, 1, 16:25, 1, 16:30, 1, 16:35, 1, 16:40, 1, 16:45, 1, 16:50, 1, 16:55, 1, 17:00, 1, 17:05, 1, 17:10, 1, 17:15, 1, 17:20, 1, 17:25, 1, 17:30, 1, 17:35, 1, 17:40, 1, 17:45, 1, 17:50, 1, 17:55, 1, 18:00, 1, 18:05, 1, 18:10, 1, 18:15, 1, 18:20, 1, 18:25, 1, 18:30, 1, 18:35, 1, 18:40, 1, 18:45, 1, 18:50, 1, 18:55, 1, 19:00, 1, 19:05, 1, 19:10, 1, 19:15, 1, 19:20, 1, 19:25, 1, 19:30, 1, 19:35, 1, 19:40, 1, 19:45, 1, 19:50, 1, 19:55, 1, 20:00, 1, 20:05, 1, 20:10, 1, 20:15, 1, 20:20, 1, 20:25, 1, 20:30, 1, 20:35, 1, 20:40, 1, 20:45, 1, 20:50, 1, 20:55, 1, 21:00, 1, 21:05, 1, 21:10, 1, 21:15, 1, 21:20, 1, 21:25, 1, 21:30, 1, 21:35, 1, 21:40, 1, 21:45, 1, 21:50, 1, 21:55, 1, 22:00, 1, 22:05, 1, 22:10, 1, 22:15, 1, 22:20, 1, 22:25, 1, 22:30, 1, 22:35, 1, 22:40, 1, 22:45, 1, 22:50, 1, 22:55, 1, 23:00, 1, 23:05, 1, 23:10, 1, 23:15, 1, 23:20, 1, 23:25, 1, 23:30, 1, 23:35, 1, 23:40, 1, 23:45, 1, 23:50, 1, 23:55, 1, ');
INSERT INTO `log_book` VALUES (3, '2020-06-11 16:16:42', 'A', '3', 'Dimas', 'Rangga', '00:00, 1, 00:05, 1, 00:10, 1, 00:15, 1, 00:20, 1, 00:25, 1, 00:30, 1, 00:35, 1, 00:40, 1, 00:45, 1, 00:50, 1, 00:55, 1, 01:00, 1, 01:05, 1, 01:10, 1, 01:15, 1, 01:20, 1, 01:25, 1, 01:30, 1, 01:35, 1, 01:40, 1, 01:45, 1, 01:50, 1, 01:55, 1, 02:00, 1, 02:05, 1, 02:10, 1, 02:15, 1, 02:20, 1, 02:25, 1, 02:30, 1, 02:35, 1, 02:40, 1, 02:45, 1, 02:50, 1, 02:55, 1, 03:00, 1, 03:05, 1, 03:10, 1, 03:15, 1, 03:20, 1, 03:25, 1, 03:30, 1, 03:35, 1, 03:40, 1, 03:45, 1, 03:50, 1, 03:55, 1, 04:00, 1, 04:05, 1, 04:10, 1, 04:15, 1, 04:20, 1, 04:25, 1, 04:30, 1, 04:35, 1, 04:40, 1, 04:45, 1, 04:50, 1, 04:55, 1, 05:00, 1, 05:05, 1, 05:10, 1, 05:15, 1, 05:20, 1, 05:25, 1, 05:30, 1, 05:35, 1, 05:40, 1, 05:45, 1, 05:50, 1, 05:55, 1, 06:00, 1, 06:05, 1, 06:10, 1, 06:15, 1, 06:20, 1, 06:25, 1, 06:30, 1, 06:35, 1, 06:40, 1, 06:45, 1, 06:50, 1, 06:55, 1, 07:00, 1, 07:05, 1, 07:10, 1, 07:15, 1, 07:20, 1, 07:25, 1, 07:30, 1, 07:35, 1, 07:40, 1, 07:45, 1, 07:50, 1, 07:55, 1, ');

-- ----------------------------
-- Table structure for mst_downtime
-- ----------------------------
DROP TABLE IF EXISTS `mst_downtime`;
CREATE TABLE `mst_downtime`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `downtimeCode` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  `downtimeName` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `downtimeGroup` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_downtime
-- ----------------------------
INSERT INTO `mst_downtime` VALUES (1, '1a', 'Run Mesin', 'RT');
INSERT INTO `mst_downtime` VALUES (2, '2a', 'Persiapan harian', 'PDT');
INSERT INTO `mst_downtime` VALUES (3, '2b', 'Persiapan batch baru', 'PDT');
INSERT INTO `mst_downtime` VALUES (4, '2c', 'Mengganti Alufoil/PVC', 'PDT');
INSERT INTO `mst_downtime` VALUES (5, '2d', 'Mengganti gulungan sisa alu', 'PDT');
INSERT INTO `mst_downtime` VALUES (6, '2e', 'Sanitasi tiap shift', 'PDT');
INSERT INTO `mst_downtime` VALUES (7, '2f', 'Sanitasi tiap ganti batch + penyelesaian dokumen', 'PDT');
INSERT INTO `mst_downtime` VALUES (8, '2g', 'Istirahat & Sholat', 'PDT');
INSERT INTO `mst_downtime` VALUES (9, '2h', 'Briefing/ GMP Campaign day', 'PDT');
INSERT INTO `mst_downtime` VALUES (10, '2i', 'Preventive Maintenance/Overhaul', 'PDT');
INSERT INTO `mst_downtime` VALUES (11, '2j', 'Istirahat Mata', 'PDT');
INSERT INTO `mst_downtime` VALUES (12, '2k', 'Pembersihan Mingguan', 'PDT');
INSERT INTO `mst_downtime` VALUES (13, '3a', 'Perbaikan rotary clutch/ air cylinder', 'UDT');
INSERT INTO `mst_downtime` VALUES (14, '3b', 'Perbaikan tablet gencet/ tidak center', 'UDT');
INSERT INTO `mst_downtime` VALUES (15, '3c', 'Perbaikan dumper/ sensor missing tablet', 'UDT');
INSERT INTO `mst_downtime` VALUES (16, '3d', 'Perbaikan cutting', 'UDT');
INSERT INTO `mst_downtime` VALUES (17, '3e', 'Perbaikan conveyor primary ', 'UDT');
INSERT INTO `mst_downtime` VALUES (18, '3f', 'Perbaikan conveyor secondary', 'UDT');
INSERT INTO `mst_downtime` VALUES (19, '3g', 'Perbaikan inkjet printing primary', 'UDT');
INSERT INTO `mst_downtime` VALUES (20, '3h', 'Perbaikan inkjet printing secondary', 'UDT');
INSERT INTO `mst_downtime` VALUES (21, '3i', 'Perbaikan timbangan', 'UDT');
INSERT INTO `mst_downtime` VALUES (22, '3j', 'Perbaikan shutter (tablet tidak turun)', 'UDT');
INSERT INTO `mst_downtime` VALUES (23, '3k', 'Perbaikan Sealing roll', 'UDT');
INSERT INTO `mst_downtime` VALUES (24, '3l', 'Perbaikan Stopper', 'UDT');
INSERT INTO `mst_downtime` VALUES (25, '3m', 'Suhu/RH/DP Tidak Memenuhi Syarat', 'UDT');
INSERT INTO `mst_downtime` VALUES (26, '3n', 'Listrik mati', 'UDT');
INSERT INTO `mst_downtime` VALUES (27, '3o', 'Lain lain (sebutkan)', 'UDT');
INSERT INTO `mst_downtime` VALUES (28, '4a', 'Menunggu Operator', 'IT');
INSERT INTO `mst_downtime` VALUES (29, '4b', 'Menunggu Maintenance', 'IT');
INSERT INTO `mst_downtime` VALUES (30, '4c', 'Menunggu/Mengambil Tablet', 'IT');
INSERT INTO `mst_downtime` VALUES (31, '4d', 'Menunggu/Mengambil Bahan Kemas', 'IT');
INSERT INTO `mst_downtime` VALUES (32, '4e', 'Tablet/Aluvoil/PVC  bermasalah', 'IT');
INSERT INTO `mst_downtime` VALUES (33, '4f', 'Tidak ada proses', 'IT');
INSERT INTO `mst_downtime` VALUES (34, '4g', 'Lain lain (sebutkan)', 'IT');
INSERT INTO `mst_downtime` VALUES (35, '5a', 'Suhu/RH/DP Tidak memenuhi syarat', 'UT');
INSERT INTO `mst_downtime` VALUES (36, '5b', 'Listrik Mati', 'UT');
INSERT INTO `mst_downtime` VALUES (37, '5c', 'Compressor Drop', 'UT');

-- ----------------------------
-- Table structure for mst_line
-- ----------------------------
DROP TABLE IF EXISTS `mst_line`;
CREATE TABLE `mst_line`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lineId` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lineName` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mst_machine
-- ----------------------------
DROP TABLE IF EXISTS `mst_machine`;
CREATE TABLE `mst_machine`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machineCode` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `machineName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lineId` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `LineId`(`lineId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mst_pic
-- ----------------------------
DROP TABLE IF EXISTS `mst_pic`;
CREATE TABLE `mst_pic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shift` int(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_pic
-- ----------------------------
INSERT INTO `mst_pic` VALUES (1, 'Irsyad', 'Leader', 1);
INSERT INTO `mst_pic` VALUES (3, 'Ricky', 'Leader', 3);
INSERT INTO `mst_pic` VALUES (4, 'Qory', 'Operator', 1);
INSERT INTO `mst_pic` VALUES (5, 'Eli', 'Operator', 2);
INSERT INTO `mst_pic` VALUES (6, 'Yogi', 'Operator', 3);
INSERT INTO `mst_pic` VALUES (9, 'Zaenal', 'Operator', 3);
INSERT INTO `mst_pic` VALUES (10, 'Rangga', 'Operator', 1);
INSERT INTO `mst_pic` VALUES (11, 'Dimas', 'Operator', 1);
INSERT INTO `mst_pic` VALUES (12, 'Rangga', 'Leader', 3);

-- ----------------------------
-- Table structure for mst_pic_copy1
-- ----------------------------
DROP TABLE IF EXISTS `mst_pic_copy1`;
CREATE TABLE `mst_pic_copy1`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shift` int(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_pic_copy1
-- ----------------------------
INSERT INTO `mst_pic_copy1` VALUES (1, 'Irsyad', 'Leader', 1);
INSERT INTO `mst_pic_copy1` VALUES (2, 'Irsyad', 'Leader', 2);
INSERT INTO `mst_pic_copy1` VALUES (3, 'Ricky', 'Leader', 3);
INSERT INTO `mst_pic_copy1` VALUES (4, 'Qory', 'Operator', 1);
INSERT INTO `mst_pic_copy1` VALUES (5, 'Eli', 'Operator', 2);
INSERT INTO `mst_pic_copy1` VALUES (6, 'Yogi', 'Operator', 3);
INSERT INTO `mst_pic_copy1` VALUES (7, 'Eli', 'Operator', 1);
INSERT INTO `mst_pic_copy1` VALUES (8, 'Yogi', 'Operator', 2);
INSERT INTO `mst_pic_copy1` VALUES (9, 'Zaenal', 'Operator', 3);
INSERT INTO `mst_pic_copy1` VALUES (10, 'Rangga', 'Operator', 1);

-- ----------------------------
-- Table structure for mst_time_shift
-- ----------------------------
DROP TABLE IF EXISTS `mst_time_shift`;
CREATE TABLE `mst_time_shift`  (
  `codeShift` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `startShift` time(6) NULL DEFAULT NULL,
  `endShift` time(6) NULL DEFAULT NULL,
  PRIMARY KEY (`codeShift`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_time_shift
-- ----------------------------
INSERT INTO `mst_time_shift` VALUES ('S1', '09:00:00.000000', '16:55:00.000000');
INSERT INTO `mst_time_shift` VALUES ('S2', '17:00:00.000000', '00:55:00.000000');
INSERT INTO `mst_time_shift` VALUES ('S3', '01:00:00.000000', '08:55:00.000000');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `images` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_users`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (5, 'takeda', 'takeda@example.com', '$2y$04$5xdES5g35dnT/z/uBysPeuhreNmlj5FjdIyG/cUjqgr.8.1QRyngK', '', 1, 'y');

-- ----------------------------
-- Table structure for tbl_user_level
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_level`;
CREATE TABLE `tbl_user_level`  (
  `id_user_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_user_level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_user_level
-- ----------------------------
INSERT INTO `tbl_user_level` VALUES (1, 'Super Admin');
INSERT INTO `tbl_user_level` VALUES (2, 'Admin');

SET FOREIGN_KEY_CHECKS = 1;
