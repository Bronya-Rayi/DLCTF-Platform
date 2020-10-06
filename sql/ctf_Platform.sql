/*
 Navicat Premium Data Transfer

 Source Server         : phpstudy
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : dlctf

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 05/10/2020 15:20:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ctf_hint
-- ----------------------------
DROP TABLE IF EXISTS `ctf_hint`;
CREATE TABLE `ctf_hint`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_id` int(10) NOT NULL,
  `hint_data` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ctf_hint
-- ----------------------------

-- ----------------------------
-- Table structure for ctf_notice
-- ----------------------------
DROP TABLE IF EXISTS `ctf_notice`;
CREATE TABLE `ctf_notice`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `notice_data` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ctf_notice
-- ----------------------------

-- ----------------------------
-- Table structure for ctf_solved_task
-- ----------------------------
DROP TABLE IF EXISTS `ctf_solved_task`;
CREATE TABLE `ctf_solved_task`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `task_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `score` int(10) NOT NULL,
  `add_time` datetime(0) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ctf_solved_task
-- ----------------------------

-- ----------------------------
-- Table structure for ctf_submit_flag
-- ----------------------------
DROP TABLE IF EXISTS `ctf_submit_flag`;
CREATE TABLE `ctf_submit_flag`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `task_id` int(10) NOT NULL,
  `check_status` int(10) NOT NULL,
  `add_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ctf_submit_flag
-- ----------------------------

-- ----------------------------
-- Table structure for ctf_task
-- ----------------------------
DROP TABLE IF EXISTS `ctf_task`;
CREATE TABLE `ctf_task`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_task` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `task_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `task_data` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_hide` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `score` int(10) NOT NULL,
  `fb_student_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `flag` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_time` datetime(0) NULL DEFAULT NULL,
  `solved_number` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ctf_task
-- ----------------------------

-- ----------------------------
-- Table structure for ctf_time
-- ----------------------------
DROP TABLE IF EXISTS `ctf_time`;
CREATE TABLE `ctf_time`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ctf_start_time` int(11) NULL DEFAULT NULL,
  `ctf_end_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ctf_time
-- ----------------------------
INSERT INTO `ctf_time` VALUES (1, 1546304461, 1988154061);

-- ----------------------------
-- Table structure for matchs
-- ----------------------------
DROP TABLE IF EXISTS `matchs`;
CREATE TABLE `matchs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `match_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `start_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of matchs
-- ----------------------------
INSERT INTO `matchs` VALUES (1, 'ctf', '第一个测试ctf大赛', 'on', '2020-07-27 10:55:26');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`student_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
