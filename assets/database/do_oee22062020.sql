/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100113
 Source Host           : localhost:3306
 Source Schema         : do_oee

 Target Server Type    : MySQL
 Target Server Version : 100113
 File Encoding         : 65001

 Date: 22/06/2020 16:07:52
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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
  `date` date NULL DEFAULT NULL,
  `shift` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `operator` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `leader` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `log` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `state` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `machine` int(11) NULL DEFAULT NULL,
  `product` int(11) NULL DEFAULT NULL,
  `product_batch` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `product_good` int(10) NULL DEFAULT NULL,
  `product_reject` int(10) NULL DEFAULT NULL,
  `user_locked` int(11) NULL DEFAULT NULL,
  `time_locked` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `log1`(`date`, `shift`, `machine`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of log_book
-- ----------------------------
INSERT INTO `log_book` VALUES (1, '2020-06-21', '1', NULL, '1', NULL, 'lock', 1, 1, '01234', 1000, 150, 5, '2020-06-21 15:53:00');
INSERT INTO `log_book` VALUES (2, '2020-06-21', '2', NULL, '6', NULL, 'lock', 1, 1, '01235', 1000, 10, 5, '2020-06-22 14:31:00');
INSERT INTO `log_book` VALUES (3, '2020-06-21', '3', NULL, NULL, NULL, 'open', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for log_book_det_operator
-- ----------------------------
DROP TABLE IF EXISTS `log_book_det_operator`;
CREATE TABLE `log_book_det_operator`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_log_book` int(11) NOT NULL,
  `id_pic` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq1`(`id_log_book`, `id_pic`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of log_book_det_operator
-- ----------------------------
INSERT INTO `log_book_det_operator` VALUES (1, 1, 11);
INSERT INTO `log_book_det_operator` VALUES (2, 2, 5);
INSERT INTO `log_book_det_operator` VALUES (3, 3, 9);

-- ----------------------------
-- Table structure for log_book_det_time
-- ----------------------------
DROP TABLE IF EXISTS `log_book_det_time`;
CREATE TABLE `log_book_det_time`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_log_book` int(11) NULL DEFAULT NULL,
  `time` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `code` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `det_time1`(`id_log_book`, `time`, `code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 577 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of log_book_det_time
-- ----------------------------
INSERT INTO `log_book_det_time` VALUES (289, 1, '09:00', '3');
INSERT INTO `log_book_det_time` VALUES (290, 1, '09:05', '1');
INSERT INTO `log_book_det_time` VALUES (291, 1, '09:10', '1');
INSERT INTO `log_book_det_time` VALUES (292, 1, '09:15', '1');
INSERT INTO `log_book_det_time` VALUES (293, 1, '09:20', '1');
INSERT INTO `log_book_det_time` VALUES (294, 1, '09:25', '1');
INSERT INTO `log_book_det_time` VALUES (295, 1, '09:30', '1');
INSERT INTO `log_book_det_time` VALUES (296, 1, '09:35', '1');
INSERT INTO `log_book_det_time` VALUES (297, 1, '09:40', '1');
INSERT INTO `log_book_det_time` VALUES (298, 1, '09:45', '13');
INSERT INTO `log_book_det_time` VALUES (299, 1, '09:50', '1');
INSERT INTO `log_book_det_time` VALUES (300, 1, '09:55', '1');
INSERT INTO `log_book_det_time` VALUES (301, 1, '10:00', '1');
INSERT INTO `log_book_det_time` VALUES (302, 1, '10:05', '1');
INSERT INTO `log_book_det_time` VALUES (303, 1, '10:10', '1');
INSERT INTO `log_book_det_time` VALUES (304, 1, '10:15', '1');
INSERT INTO `log_book_det_time` VALUES (305, 1, '10:20', '1');
INSERT INTO `log_book_det_time` VALUES (306, 1, '10:25', '1');
INSERT INTO `log_book_det_time` VALUES (307, 1, '10:30', '1');
INSERT INTO `log_book_det_time` VALUES (308, 1, '10:35', '1');
INSERT INTO `log_book_det_time` VALUES (309, 1, '10:40', '1');
INSERT INTO `log_book_det_time` VALUES (310, 1, '10:45', '1');
INSERT INTO `log_book_det_time` VALUES (311, 1, '10:50', '1');
INSERT INTO `log_book_det_time` VALUES (312, 1, '10:55', '1');
INSERT INTO `log_book_det_time` VALUES (313, 1, '11:00', '1');
INSERT INTO `log_book_det_time` VALUES (314, 1, '11:05', '1');
INSERT INTO `log_book_det_time` VALUES (315, 1, '11:10', '1');
INSERT INTO `log_book_det_time` VALUES (316, 1, '11:15', '1');
INSERT INTO `log_book_det_time` VALUES (317, 1, '11:20', '1');
INSERT INTO `log_book_det_time` VALUES (318, 1, '11:25', '1');
INSERT INTO `log_book_det_time` VALUES (319, 1, '11:30', '1');
INSERT INTO `log_book_det_time` VALUES (320, 1, '11:35', '1');
INSERT INTO `log_book_det_time` VALUES (321, 1, '11:40', '1');
INSERT INTO `log_book_det_time` VALUES (322, 1, '11:45', '1');
INSERT INTO `log_book_det_time` VALUES (323, 1, '11:50', '1');
INSERT INTO `log_book_det_time` VALUES (324, 1, '11:55', '1');
INSERT INTO `log_book_det_time` VALUES (325, 1, '12:00', '1');
INSERT INTO `log_book_det_time` VALUES (326, 1, '12:05', '1');
INSERT INTO `log_book_det_time` VALUES (327, 1, '12:10', '1');
INSERT INTO `log_book_det_time` VALUES (328, 1, '12:15', '1');
INSERT INTO `log_book_det_time` VALUES (329, 1, '12:20', '1');
INSERT INTO `log_book_det_time` VALUES (330, 1, '12:25', '1');
INSERT INTO `log_book_det_time` VALUES (331, 1, '12:30', '1');
INSERT INTO `log_book_det_time` VALUES (332, 1, '12:35', '1');
INSERT INTO `log_book_det_time` VALUES (333, 1, '12:40', '1');
INSERT INTO `log_book_det_time` VALUES (334, 1, '12:45', '1');
INSERT INTO `log_book_det_time` VALUES (335, 1, '12:50', '1');
INSERT INTO `log_book_det_time` VALUES (336, 1, '12:55', '1');
INSERT INTO `log_book_det_time` VALUES (337, 1, '13:00', '1');
INSERT INTO `log_book_det_time` VALUES (338, 1, '13:05', '1');
INSERT INTO `log_book_det_time` VALUES (339, 1, '13:10', '1');
INSERT INTO `log_book_det_time` VALUES (340, 1, '13:15', '1');
INSERT INTO `log_book_det_time` VALUES (341, 1, '13:20', '1');
INSERT INTO `log_book_det_time` VALUES (342, 1, '13:25', '1');
INSERT INTO `log_book_det_time` VALUES (343, 1, '13:30', '1');
INSERT INTO `log_book_det_time` VALUES (344, 1, '13:35', '1');
INSERT INTO `log_book_det_time` VALUES (345, 1, '13:40', '1');
INSERT INTO `log_book_det_time` VALUES (346, 1, '13:45', '1');
INSERT INTO `log_book_det_time` VALUES (347, 1, '13:50', '1');
INSERT INTO `log_book_det_time` VALUES (348, 1, '13:55', '1');
INSERT INTO `log_book_det_time` VALUES (349, 1, '14:00', '1');
INSERT INTO `log_book_det_time` VALUES (350, 1, '14:05', '1');
INSERT INTO `log_book_det_time` VALUES (351, 1, '14:10', '1');
INSERT INTO `log_book_det_time` VALUES (352, 1, '14:15', '1');
INSERT INTO `log_book_det_time` VALUES (353, 1, '14:20', '1');
INSERT INTO `log_book_det_time` VALUES (354, 1, '14:25', '1');
INSERT INTO `log_book_det_time` VALUES (355, 1, '14:30', '1');
INSERT INTO `log_book_det_time` VALUES (356, 1, '14:35', '1');
INSERT INTO `log_book_det_time` VALUES (357, 1, '14:40', '1');
INSERT INTO `log_book_det_time` VALUES (358, 1, '14:45', '1');
INSERT INTO `log_book_det_time` VALUES (359, 1, '14:50', '1');
INSERT INTO `log_book_det_time` VALUES (360, 1, '14:55', '1');
INSERT INTO `log_book_det_time` VALUES (361, 1, '15:00', '1');
INSERT INTO `log_book_det_time` VALUES (362, 1, '15:05', '1');
INSERT INTO `log_book_det_time` VALUES (363, 1, '15:10', '1');
INSERT INTO `log_book_det_time` VALUES (364, 1, '15:15', '1');
INSERT INTO `log_book_det_time` VALUES (365, 1, '15:20', '1');
INSERT INTO `log_book_det_time` VALUES (366, 1, '15:25', '1');
INSERT INTO `log_book_det_time` VALUES (367, 1, '15:30', '1');
INSERT INTO `log_book_det_time` VALUES (368, 1, '15:35', '1');
INSERT INTO `log_book_det_time` VALUES (369, 1, '15:40', '1');
INSERT INTO `log_book_det_time` VALUES (370, 1, '15:45', '1');
INSERT INTO `log_book_det_time` VALUES (371, 1, '15:50', '1');
INSERT INTO `log_book_det_time` VALUES (372, 1, '15:55', '1');
INSERT INTO `log_book_det_time` VALUES (373, 1, '16:00', '1');
INSERT INTO `log_book_det_time` VALUES (374, 1, '16:05', '1');
INSERT INTO `log_book_det_time` VALUES (375, 1, '16:10', '1');
INSERT INTO `log_book_det_time` VALUES (376, 1, '16:15', '1');
INSERT INTO `log_book_det_time` VALUES (377, 1, '16:20', '1');
INSERT INTO `log_book_det_time` VALUES (378, 1, '16:25', '1');
INSERT INTO `log_book_det_time` VALUES (379, 1, '16:30', '1');
INSERT INTO `log_book_det_time` VALUES (380, 1, '16:35', '1');
INSERT INTO `log_book_det_time` VALUES (381, 1, '16:40', '1');
INSERT INTO `log_book_det_time` VALUES (382, 1, '16:45', '1');
INSERT INTO `log_book_det_time` VALUES (383, 1, '16:50', '1');
INSERT INTO `log_book_det_time` VALUES (384, 1, '16:55', '1');
INSERT INTO `log_book_det_time` VALUES (469, 2, '00:00', '1');
INSERT INTO `log_book_det_time` VALUES (470, 2, '00:05', '1');
INSERT INTO `log_book_det_time` VALUES (471, 2, '00:10', '1');
INSERT INTO `log_book_det_time` VALUES (472, 2, '00:15', '1');
INSERT INTO `log_book_det_time` VALUES (473, 2, '00:20', '1');
INSERT INTO `log_book_det_time` VALUES (474, 2, '00:25', '1');
INSERT INTO `log_book_det_time` VALUES (475, 2, '00:30', '1');
INSERT INTO `log_book_det_time` VALUES (476, 2, '00:35', '1');
INSERT INTO `log_book_det_time` VALUES (477, 2, '00:40', '1');
INSERT INTO `log_book_det_time` VALUES (478, 2, '00:45', '1');
INSERT INTO `log_book_det_time` VALUES (479, 2, '00:50', '1');
INSERT INTO `log_book_det_time` VALUES (480, 2, '00:55', '1');
INSERT INTO `log_book_det_time` VALUES (385, 2, '17:00', '1');
INSERT INTO `log_book_det_time` VALUES (386, 2, '17:05', '1');
INSERT INTO `log_book_det_time` VALUES (387, 2, '17:10', '2');
INSERT INTO `log_book_det_time` VALUES (388, 2, '17:15', '1');
INSERT INTO `log_book_det_time` VALUES (389, 2, '17:20', '1');
INSERT INTO `log_book_det_time` VALUES (390, 2, '17:25', '1');
INSERT INTO `log_book_det_time` VALUES (391, 2, '17:30', '14');
INSERT INTO `log_book_det_time` VALUES (392, 2, '17:35', '1');
INSERT INTO `log_book_det_time` VALUES (393, 2, '17:40', '1');
INSERT INTO `log_book_det_time` VALUES (394, 2, '17:45', '1');
INSERT INTO `log_book_det_time` VALUES (395, 2, '17:50', '1');
INSERT INTO `log_book_det_time` VALUES (396, 2, '17:55', '1');
INSERT INTO `log_book_det_time` VALUES (397, 2, '18:00', '1');
INSERT INTO `log_book_det_time` VALUES (398, 2, '18:05', '1');
INSERT INTO `log_book_det_time` VALUES (399, 2, '18:10', '1');
INSERT INTO `log_book_det_time` VALUES (400, 2, '18:15', '1');
INSERT INTO `log_book_det_time` VALUES (401, 2, '18:20', '1');
INSERT INTO `log_book_det_time` VALUES (402, 2, '18:25', '1');
INSERT INTO `log_book_det_time` VALUES (403, 2, '18:30', '1');
INSERT INTO `log_book_det_time` VALUES (404, 2, '18:35', '1');
INSERT INTO `log_book_det_time` VALUES (405, 2, '18:40', '1');
INSERT INTO `log_book_det_time` VALUES (406, 2, '18:45', '1');
INSERT INTO `log_book_det_time` VALUES (407, 2, '18:50', '1');
INSERT INTO `log_book_det_time` VALUES (408, 2, '18:55', '1');
INSERT INTO `log_book_det_time` VALUES (409, 2, '19:00', '1');
INSERT INTO `log_book_det_time` VALUES (410, 2, '19:05', '1');
INSERT INTO `log_book_det_time` VALUES (411, 2, '19:10', '17');
INSERT INTO `log_book_det_time` VALUES (412, 2, '19:15', '1');
INSERT INTO `log_book_det_time` VALUES (413, 2, '19:20', '1');
INSERT INTO `log_book_det_time` VALUES (414, 2, '19:25', '1');
INSERT INTO `log_book_det_time` VALUES (415, 2, '19:30', '1');
INSERT INTO `log_book_det_time` VALUES (416, 2, '19:35', '1');
INSERT INTO `log_book_det_time` VALUES (417, 2, '19:40', '1');
INSERT INTO `log_book_det_time` VALUES (418, 2, '19:45', '1');
INSERT INTO `log_book_det_time` VALUES (419, 2, '19:50', '14');
INSERT INTO `log_book_det_time` VALUES (420, 2, '19:55', '1');
INSERT INTO `log_book_det_time` VALUES (421, 2, '20:00', '1');
INSERT INTO `log_book_det_time` VALUES (422, 2, '20:05', '1');
INSERT INTO `log_book_det_time` VALUES (423, 2, '20:10', '1');
INSERT INTO `log_book_det_time` VALUES (424, 2, '20:15', '1');
INSERT INTO `log_book_det_time` VALUES (425, 2, '20:20', '1');
INSERT INTO `log_book_det_time` VALUES (426, 2, '20:25', '1');
INSERT INTO `log_book_det_time` VALUES (427, 2, '20:30', '1');
INSERT INTO `log_book_det_time` VALUES (428, 2, '20:35', '1');
INSERT INTO `log_book_det_time` VALUES (429, 2, '20:40', '1');
INSERT INTO `log_book_det_time` VALUES (430, 2, '20:45', '1');
INSERT INTO `log_book_det_time` VALUES (431, 2, '20:50', '1');
INSERT INTO `log_book_det_time` VALUES (432, 2, '20:55', '1');
INSERT INTO `log_book_det_time` VALUES (433, 2, '21:00', '1');
INSERT INTO `log_book_det_time` VALUES (434, 2, '21:05', '1');
INSERT INTO `log_book_det_time` VALUES (435, 2, '21:10', '1');
INSERT INTO `log_book_det_time` VALUES (436, 2, '21:15', '1');
INSERT INTO `log_book_det_time` VALUES (437, 2, '21:20', '1');
INSERT INTO `log_book_det_time` VALUES (438, 2, '21:25', '1');
INSERT INTO `log_book_det_time` VALUES (439, 2, '21:30', '1');
INSERT INTO `log_book_det_time` VALUES (440, 2, '21:35', '1');
INSERT INTO `log_book_det_time` VALUES (441, 2, '21:40', '1');
INSERT INTO `log_book_det_time` VALUES (442, 2, '21:45', '1');
INSERT INTO `log_book_det_time` VALUES (443, 2, '21:50', '1');
INSERT INTO `log_book_det_time` VALUES (444, 2, '21:55', '1');
INSERT INTO `log_book_det_time` VALUES (445, 2, '22:00', '1');
INSERT INTO `log_book_det_time` VALUES (446, 2, '22:05', '1');
INSERT INTO `log_book_det_time` VALUES (447, 2, '22:10', '1');
INSERT INTO `log_book_det_time` VALUES (448, 2, '22:15', '1');
INSERT INTO `log_book_det_time` VALUES (449, 2, '22:20', '1');
INSERT INTO `log_book_det_time` VALUES (450, 2, '22:25', '1');
INSERT INTO `log_book_det_time` VALUES (451, 2, '22:30', '1');
INSERT INTO `log_book_det_time` VALUES (452, 2, '22:35', '1');
INSERT INTO `log_book_det_time` VALUES (453, 2, '22:40', '1');
INSERT INTO `log_book_det_time` VALUES (454, 2, '22:45', '1');
INSERT INTO `log_book_det_time` VALUES (455, 2, '22:50', '1');
INSERT INTO `log_book_det_time` VALUES (456, 2, '22:55', '1');
INSERT INTO `log_book_det_time` VALUES (457, 2, '23:00', '1');
INSERT INTO `log_book_det_time` VALUES (458, 2, '23:05', '1');
INSERT INTO `log_book_det_time` VALUES (459, 2, '23:10', '1');
INSERT INTO `log_book_det_time` VALUES (460, 2, '23:15', '1');
INSERT INTO `log_book_det_time` VALUES (461, 2, '23:20', '1');
INSERT INTO `log_book_det_time` VALUES (462, 2, '23:25', '1');
INSERT INTO `log_book_det_time` VALUES (463, 2, '23:30', '1');
INSERT INTO `log_book_det_time` VALUES (464, 2, '23:35', '1');
INSERT INTO `log_book_det_time` VALUES (465, 2, '23:40', '1');
INSERT INTO `log_book_det_time` VALUES (466, 2, '23:45', '1');
INSERT INTO `log_book_det_time` VALUES (467, 2, '23:50', '1');
INSERT INTO `log_book_det_time` VALUES (468, 2, '23:55', '1');
INSERT INTO `log_book_det_time` VALUES (481, 3, '01:00', '1');
INSERT INTO `log_book_det_time` VALUES (482, 3, '01:05', '1');
INSERT INTO `log_book_det_time` VALUES (483, 3, '01:10', '1');
INSERT INTO `log_book_det_time` VALUES (484, 3, '01:15', '6');
INSERT INTO `log_book_det_time` VALUES (485, 3, '01:20', '1');
INSERT INTO `log_book_det_time` VALUES (486, 3, '01:25', '1');
INSERT INTO `log_book_det_time` VALUES (487, 3, '01:30', '15');
INSERT INTO `log_book_det_time` VALUES (488, 3, '01:35', '1');
INSERT INTO `log_book_det_time` VALUES (489, 3, '01:40', '1');
INSERT INTO `log_book_det_time` VALUES (490, 3, '01:45', '1');
INSERT INTO `log_book_det_time` VALUES (491, 3, '01:50', '1');
INSERT INTO `log_book_det_time` VALUES (492, 3, '01:55', '1');
INSERT INTO `log_book_det_time` VALUES (493, 3, '02:00', '1');
INSERT INTO `log_book_det_time` VALUES (494, 3, '02:05', '1');
INSERT INTO `log_book_det_time` VALUES (495, 3, '02:10', '1');
INSERT INTO `log_book_det_time` VALUES (496, 3, '02:15', '1');
INSERT INTO `log_book_det_time` VALUES (497, 3, '02:20', '1');
INSERT INTO `log_book_det_time` VALUES (498, 3, '02:25', '1');
INSERT INTO `log_book_det_time` VALUES (499, 3, '02:30', '1');
INSERT INTO `log_book_det_time` VALUES (500, 3, '02:35', '1');
INSERT INTO `log_book_det_time` VALUES (501, 3, '02:40', '1');
INSERT INTO `log_book_det_time` VALUES (502, 3, '02:45', '1');
INSERT INTO `log_book_det_time` VALUES (503, 3, '02:50', '1');
INSERT INTO `log_book_det_time` VALUES (504, 3, '02:55', '1');
INSERT INTO `log_book_det_time` VALUES (505, 3, '03:00', '1');
INSERT INTO `log_book_det_time` VALUES (506, 3, '03:05', '1');
INSERT INTO `log_book_det_time` VALUES (507, 3, '03:10', '1');
INSERT INTO `log_book_det_time` VALUES (508, 3, '03:15', '1');
INSERT INTO `log_book_det_time` VALUES (509, 3, '03:20', '1');
INSERT INTO `log_book_det_time` VALUES (510, 3, '03:25', '1');
INSERT INTO `log_book_det_time` VALUES (511, 3, '03:30', '1');
INSERT INTO `log_book_det_time` VALUES (512, 3, '03:35', '1');
INSERT INTO `log_book_det_time` VALUES (513, 3, '03:40', '1');
INSERT INTO `log_book_det_time` VALUES (514, 3, '03:45', '1');
INSERT INTO `log_book_det_time` VALUES (515, 3, '03:50', '1');
INSERT INTO `log_book_det_time` VALUES (516, 3, '03:55', '1');
INSERT INTO `log_book_det_time` VALUES (517, 3, '04:00', '1');
INSERT INTO `log_book_det_time` VALUES (518, 3, '04:05', '1');
INSERT INTO `log_book_det_time` VALUES (519, 3, '04:10', '1');
INSERT INTO `log_book_det_time` VALUES (520, 3, '04:15', '1');
INSERT INTO `log_book_det_time` VALUES (521, 3, '04:20', '1');
INSERT INTO `log_book_det_time` VALUES (522, 3, '04:25', '1');
INSERT INTO `log_book_det_time` VALUES (523, 3, '04:30', '1');
INSERT INTO `log_book_det_time` VALUES (524, 3, '04:35', '1');
INSERT INTO `log_book_det_time` VALUES (525, 3, '04:40', '1');
INSERT INTO `log_book_det_time` VALUES (526, 3, '04:45', '1');
INSERT INTO `log_book_det_time` VALUES (527, 3, '04:50', '1');
INSERT INTO `log_book_det_time` VALUES (528, 3, '04:55', '1');
INSERT INTO `log_book_det_time` VALUES (529, 3, '05:00', '1');
INSERT INTO `log_book_det_time` VALUES (530, 3, '05:05', '1');
INSERT INTO `log_book_det_time` VALUES (531, 3, '05:10', '1');
INSERT INTO `log_book_det_time` VALUES (532, 3, '05:15', '1');
INSERT INTO `log_book_det_time` VALUES (533, 3, '05:20', '1');
INSERT INTO `log_book_det_time` VALUES (534, 3, '05:25', '1');
INSERT INTO `log_book_det_time` VALUES (535, 3, '05:30', '1');
INSERT INTO `log_book_det_time` VALUES (536, 3, '05:35', '1');
INSERT INTO `log_book_det_time` VALUES (537, 3, '05:40', '1');
INSERT INTO `log_book_det_time` VALUES (538, 3, '05:45', '1');
INSERT INTO `log_book_det_time` VALUES (539, 3, '05:50', '1');
INSERT INTO `log_book_det_time` VALUES (540, 3, '05:55', '1');
INSERT INTO `log_book_det_time` VALUES (541, 3, '06:00', '1');
INSERT INTO `log_book_det_time` VALUES (542, 3, '06:05', '1');
INSERT INTO `log_book_det_time` VALUES (543, 3, '06:10', '1');
INSERT INTO `log_book_det_time` VALUES (544, 3, '06:15', '1');
INSERT INTO `log_book_det_time` VALUES (545, 3, '06:20', '1');
INSERT INTO `log_book_det_time` VALUES (546, 3, '06:25', '1');
INSERT INTO `log_book_det_time` VALUES (547, 3, '06:30', '1');
INSERT INTO `log_book_det_time` VALUES (548, 3, '06:35', '1');
INSERT INTO `log_book_det_time` VALUES (549, 3, '06:40', '1');
INSERT INTO `log_book_det_time` VALUES (550, 3, '06:45', '1');
INSERT INTO `log_book_det_time` VALUES (551, 3, '06:50', '1');
INSERT INTO `log_book_det_time` VALUES (552, 3, '06:55', '1');
INSERT INTO `log_book_det_time` VALUES (553, 3, '07:00', '1');
INSERT INTO `log_book_det_time` VALUES (554, 3, '07:05', '1');
INSERT INTO `log_book_det_time` VALUES (555, 3, '07:10', '1');
INSERT INTO `log_book_det_time` VALUES (556, 3, '07:15', '1');
INSERT INTO `log_book_det_time` VALUES (557, 3, '07:20', '1');
INSERT INTO `log_book_det_time` VALUES (558, 3, '07:25', '1');
INSERT INTO `log_book_det_time` VALUES (559, 3, '07:30', '1');
INSERT INTO `log_book_det_time` VALUES (560, 3, '07:35', '1');
INSERT INTO `log_book_det_time` VALUES (561, 3, '07:40', '1');
INSERT INTO `log_book_det_time` VALUES (562, 3, '07:45', '1');
INSERT INTO `log_book_det_time` VALUES (563, 3, '07:50', '1');
INSERT INTO `log_book_det_time` VALUES (564, 3, '07:55', '1');
INSERT INTO `log_book_det_time` VALUES (565, 3, '08:00', '1');
INSERT INTO `log_book_det_time` VALUES (566, 3, '08:05', '1');
INSERT INTO `log_book_det_time` VALUES (567, 3, '08:10', '1');
INSERT INTO `log_book_det_time` VALUES (568, 3, '08:15', '1');
INSERT INTO `log_book_det_time` VALUES (569, 3, '08:20', '1');
INSERT INTO `log_book_det_time` VALUES (570, 3, '08:25', '1');
INSERT INTO `log_book_det_time` VALUES (571, 3, '08:30', '1');
INSERT INTO `log_book_det_time` VALUES (572, 3, '08:35', '1');
INSERT INTO `log_book_det_time` VALUES (573, 3, '08:40', '1');
INSERT INTO `log_book_det_time` VALUES (574, 3, '08:45', '1');
INSERT INTO `log_book_det_time` VALUES (575, 3, '08:50', '1');
INSERT INTO `log_book_det_time` VALUES (576, 3, '08:55', '1');

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
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mst_line
-- ----------------------------
INSERT INTO `mst_line` VALUES (1, '1', 'Siebler');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mst_machine
-- ----------------------------
INSERT INTO `mst_machine` VALUES (1, 'S1', 'Siebler', '1');

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mst_pic
-- ----------------------------
INSERT INTO `mst_pic` VALUES (1, 'Irsyad', 'Leader', 1);
INSERT INTO `mst_pic` VALUES (3, 'Ricky', 'Leader', 3);
INSERT INTO `mst_pic` VALUES (4, 'Qory', 'Leader', 1);
INSERT INTO `mst_pic` VALUES (5, 'Eli', 'Operator', 2);
INSERT INTO `mst_pic` VALUES (6, 'Yogi', 'Leader', 2);
INSERT INTO `mst_pic` VALUES (9, 'Zaenal', 'Operator', 3);
INSERT INTO `mst_pic` VALUES (10, 'Rangga', 'Operator', 1);
INSERT INTO `mst_pic` VALUES (11, 'Dimas', 'Operator', 1);
INSERT INTO `mst_pic` VALUES (12, 'Rangga', 'Leader', 3);

-- ----------------------------
-- Table structure for mst_product
-- ----------------------------
DROP TABLE IF EXISTS `mst_product`;
CREATE TABLE `mst_product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mst_product
-- ----------------------------
INSERT INTO `mst_product` VALUES (1, 'Vitacimin Grape');

-- ----------------------------
-- Table structure for mst_time_shift
-- ----------------------------
DROP TABLE IF EXISTS `mst_time_shift`;
CREATE TABLE `mst_time_shift`  (
  `id` int(11) NOT NULL,
  `codeShift` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `startShift` time(6) NULL DEFAULT NULL,
  `endShift` time(6) NULL DEFAULT NULL,
  PRIMARY KEY (`codeShift`, `id`) USING BTREE,
  UNIQUE INDEX `code`(`codeShift`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mst_time_shift
-- ----------------------------
INSERT INTO `mst_time_shift` VALUES (1, 'S1', '09:00:00.000000', '16:55:00.000000');
INSERT INTO `mst_time_shift` VALUES (2, 'S2', '17:00:00.000000', '00:55:00.000000');
INSERT INTO `mst_time_shift` VALUES (3, 'S3', '01:00:00.000000', '07:55:00.000000');

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user_level
-- ----------------------------
INSERT INTO `tbl_user_level` VALUES (1, 'Super Admin');
INSERT INTO `tbl_user_level` VALUES (2, 'Admin');

-- ----------------------------
-- Function structure for report_daily
-- ----------------------------
DROP FUNCTION IF EXISTS `report_daily`;
delimiter ;;
CREATE FUNCTION `report_daily`(`v_date` date,`v_id_downtime` int,`v_shift` int,`v_machine` int)
 RETURNS int(11)
BEGIN
	#Routine body goes here...
	DECLARE jml INT;
	SELECT count(*) INTO jml FROM log_book a
	LEFT JOIN log_book_det_time b on a.id = b.id_log_book
	WHERE a.date = v_date and b.CODE = v_id_downtime and a.shift = v_shift and a.machine = v_machine;

	RETURN jml;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
