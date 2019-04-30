/*
Navicat MySQL Data Transfer

Source Server         : 2
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : yii2basic

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-04-14 03:13:36
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `car`
-- ----------------------------
DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` mediumtext NOT NULL,
  `longitude` mediumtext NOT NULL,
  `pendingTime` varchar(30) NOT NULL,
  `inUse` varchar(30) NOT NULL,
  `carName` varchar(255) NOT NULL,
  `carImgUrl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of car
-- ----------------------------
INSERT INTO `car` VALUES ('1', '-37.781827', '145.166666', 'n', 'n', 'Holden', 'Holden.jpg');
INSERT INTO `car` VALUES ('2', '-37.782222', '145.167733', 'y', 'y', 'Honda', 'Honda.jpg');
INSERT INTO `car` VALUES ('3', '-37.785555', '145.163463', 'n', 'n', 'Hyundai 2', 'Hyundai 2.jpg');
INSERT INTO `car` VALUES ('4', '-37.781234', '145.161234', 'y', 'y', 'Hyundai', 'Hyundai.jpg');
INSERT INTO `car` VALUES ('5', '-37.786666', '145.166888', 'y', 'y', 'Mazda', 'Mazda.jpg');
INSERT INTO `car` VALUES ('6', '-37.788888', '145.167888', 'n', 'y', 'Subaru SUV', 'Subaru SUV.jpg');
INSERT INTO `car` VALUES ('7', '-37.791111', '145.159999', 'y', 'y', 'Subaru', 'Subaru.jpg');
INSERT INTO `car` VALUES ('8', '-37.789999', '145.159999', 'n', 'n', 'Toyota', 'Toyota.jpg');
