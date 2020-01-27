/*
Navicat MySQL Data Transfer

Source Server         : localDBs
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : library

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-12-02 13:13:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cat_carreras`
-- ----------------------------
DROP TABLE IF EXISTS `cat_carreras`;
CREATE TABLE `cat_carreras` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SIGLAS_CARRERA` varchar(11) DEFAULT NULL,
  `NOMBRE_CARRERA` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cat_carreras
-- ----------------------------
INSERT INTO `cat_carreras` VALUES ('1', 'LM', 'Licenciatura en Matemáticas');
INSERT INTO `cat_carreras` VALUES ('2', 'LA', 'Licenciatura en Actuaría');
INSERT INTO `cat_carreras` VALUES ('3', 'LMAD', 'Licenciatura en Multiedia y Animación Digital');
INSERT INTO `cat_carreras` VALUES ('4', 'LF', 'Licenciatura en Física');
INSERT INTO `cat_carreras` VALUES ('5', 'LCC', 'Licenciatura en Ciencas Computacionales');
INSERT INTO `cat_carreras` VALUES ('6', 'LSTI', 'Licenciatura en Seguridad de Tecnologías de la Información');

-- ----------------------------
-- Table structure for `t_donaciones`
-- ----------------------------
DROP TABLE IF EXISTS `t_donaciones`;
CREATE TABLE `t_donaciones` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `MATRICULA` bigint(20) DEFAULT NULL,
  `FECHA_GRADUACION` datetime DEFAULT NULL,
  `CARRERA` int(11) DEFAULT NULL,
  `NOMBRE` varchar(255) DEFAULT NULL,
  `FECHA_TRAMITE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2616 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_donaciones
-- ----------------------------

-- ----------------------------
-- Table structure for `t_usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `t_usuarios`;
CREATE TABLE `t_usuarios` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(255) DEFAULT NULL,
  `PWD` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_usuarios
-- ----------------------------
INSERT INTO `t_usuarios` VALUES ('1', 'hola', 'muda');
INSERT INTO `t_usuarios` VALUES ('2', 'vim', 'fc968d3cf5825f77411059bae8179961');
DROP TRIGGER IF EXISTS `encryptPWDInsert`;
DELIMITER ;;
CREATE TRIGGER `encryptPWDInsert` BEFORE INSERT ON `t_usuarios` FOR EACH ROW SET new.PWD = MD5(new.PWD)
;;
DELIMITER ;
