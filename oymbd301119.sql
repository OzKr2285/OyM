/*
Navicat MySQL Data Transfer

Source Server         : OzKrCNX
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : oymbd

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-11-30 18:36:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accesorios`
-- ----------------------------
DROP TABLE IF EXISTS `accesorios`;
CREATE TABLE `accesorios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `desc` varchar(250) DEFAULT NULL,
  `modelo` varchar(10) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accesorios
-- ----------------------------
INSERT INTO `accesorios` VALUES ('24', 'Generico', 'Generico', '2ns', '1233434');

-- ----------------------------
-- Table structure for `actividades`
-- ----------------------------
DROP TABLE IF EXISTS `actividades`;
CREATE TABLE `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of actividades
-- ----------------------------
INSERT INTO `actividades` VALUES ('2', 'Limpieza Valvula', 'Limpieza general');
INSERT INTO `actividades` VALUES ('4', 'CAMBIAR KIT DE ARRASTRE....', 'CAMBIO KIT,....');

-- ----------------------------
-- Table structure for `actividadese`
-- ----------------------------
DROP TABLE IF EXISTS `actividadese`;
CREATE TABLE `actividadese` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of actividadese
-- ----------------------------
INSERT INTO `actividadese` VALUES ('17', 'PRUEBA .... NEW');
INSERT INTO `actividadese` VALUES ('18', 'R');
INSERT INTO `actividadese` VALUES ('19', 'EQUIPOS PARA ACCESORIOS');

-- ----------------------------
-- Table structure for `act_serv_pqrs`
-- ----------------------------
DROP TABLE IF EXISTS `act_serv_pqrs`;
CREATE TABLE `act_serv_pqrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servpqrs` int(11) DEFAULT NULL,
  `id_serv` int(11) DEFAULT NULL,
  `edo` char(1) DEFAULT '0' COMMENT '0:sin validar  1:validado',
  `new` char(1) DEFAULT '0' COMMENT '0: add old   1: addTecnico',
  PRIMARY KEY (`id`),
  KEY `id_servpqrs` (`id_servpqrs`),
  KEY `id_serv` (`id_serv`),
  CONSTRAINT `act_serv_pqrs_ibfk_1` FOREIGN KEY (`id_servpqrs`) REFERENCES `serv_pqrs` (`id`),
  CONSTRAINT `act_serv_pqrs_ibfk_2` FOREIGN KEY (`id_serv`) REFERENCES `servicios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of act_serv_pqrs
-- ----------------------------

-- ----------------------------
-- Table structure for `areas`
-- ----------------------------
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of areas
-- ----------------------------
INSERT INTO `areas` VALUES ('1', 'ADMINISTRATIVA');
INSERT INTO `areas` VALUES ('2', 'COMERCIAL');
INSERT INTO `areas` VALUES ('3', 'TÉCNICA');
INSERT INTO `areas` VALUES ('4', 'OTROS');

-- ----------------------------
-- Table structure for `cargos`
-- ----------------------------
DROP TABLE IF EXISTS `cargos`;
CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  CONSTRAINT `cargos_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cargos
-- ----------------------------
INSERT INTO `cargos` VALUES ('1', '1', 'GERENTE GENERAL');
INSERT INTO `cargos` VALUES ('2', '1', 'DIRECTOR DE ESTRATEGIA Y CRECIMIENTO');
INSERT INTO `cargos` VALUES ('3', '1', 'GERENTE ADMINISTRATIVO Y FINANCIERO');
INSERT INTO `cargos` VALUES ('4', '1', 'TECNOLOGO EN CONTABILIDAD');
INSERT INTO `cargos` VALUES ('5', '1', 'TECNÓLOGO EN SISTEMAS');
INSERT INTO `cargos` VALUES ('6', '1', 'TÉCNICO ADMINISTRATIVO ');
INSERT INTO `cargos` VALUES ('7', '1', 'TÉCNICO HSE');
INSERT INTO `cargos` VALUES ('8', '1', 'APRENDIZ SENA');
INSERT INTO `cargos` VALUES ('9', '1', 'AUXILIAR DE SERVICIOS GENERALES');
INSERT INTO `cargos` VALUES ('12', '2', 'GERENTE COMERCIAL');
INSERT INTO `cargos` VALUES ('13', '2', 'EJECUTIVO COMERCIAL ENERGIA FOTOVOLTAICA');
INSERT INTO `cargos` VALUES ('14', '2', 'TÉCNICO EN ADMINISTRATIVO ');
INSERT INTO `cargos` VALUES ('16', '2', 'ASISTENTE ADMINISTRATIVO');
INSERT INTO `cargos` VALUES ('17', '2', 'AUXILIAR ADMINISTRATIVO');
INSERT INTO `cargos` VALUES ('20', '3', 'GERENTE TÉCNICO Y DE OPERACIONES');
INSERT INTO `cargos` VALUES ('21', '3', 'PROFESIONAL EN OPERACIÓN Y MANTENIMIENTO');
INSERT INTO `cargos` VALUES ('22', '3', 'PROFESIONAL DE PROYECTOS');
INSERT INTO `cargos` VALUES ('23', '3', 'TECNÓLOGO EN ENERGIA FOTOVOLTAICA');
INSERT INTO `cargos` VALUES ('24', '3', 'SUPERVISOR DE INSTALACIONES INTERNAS');
INSERT INTO `cargos` VALUES ('25', '3', 'TÉCNICO OPERATIVO I');
INSERT INTO `cargos` VALUES ('26', '3', 'TÉCNICO OPERATIVO II');
INSERT INTO `cargos` VALUES ('28', '3', 'AUXILIAR DE OBRAS CIVILES');
INSERT INTO `cargos` VALUES ('29', '3', 'AUXILIAR OPERATIVO I');
INSERT INTO `cargos` VALUES ('30', '3', 'CONDUCTOR');
INSERT INTO `cargos` VALUES ('42', '4', 'USUARIO TEMPORAL');

-- ----------------------------
-- Table structure for `categorias`
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'PETICIONES - PQRS', 'PETICIONES');
INSERT INTO `categorias` VALUES ('2', 'QUEJAS - PQRS', 'QUEJAS');
INSERT INTO `categorias` VALUES ('3', 'RECLAMOS - PQRS', 'RECLAMOS');
INSERT INTO `categorias` VALUES ('4', 'SERVICIOS - INSTALACION', 'INSTALACIONES');
INSERT INTO `categorias` VALUES ('5', 'DISPONIBILIDAD', 'DISPONIBILIDAD PARA USO DEL SERVICIO DE GAS');
INSERT INTO `categorias` VALUES ('6', 'ESCAPES', null);
INSERT INTO `categorias` VALUES ('7', 'SOPORTE', 'SOPORTE');
INSERT INTO `categorias` VALUES ('8', 'T2', 'SERVICIOS - TECNICOS');
INSERT INTO `categorias` VALUES ('9', 'SERVICIO TÉCNICO', null);

-- ----------------------------
-- Table structure for `catservicios`
-- ----------------------------
DROP TABLE IF EXISTS `catservicios`;
CREATE TABLE `catservicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of catservicios
-- ----------------------------
INSERT INTO `catservicios` VALUES ('1', 'MANTENIMIENTO', null);
INSERT INTO `catservicios` VALUES ('2', 'INSTALACION', null);
INSERT INTO `catservicios` VALUES ('3', 'REPARACION', 'R');
INSERT INTO `catservicios` VALUES ('4', 'DISPONIBILIDAD', 'DISPONIBILIDAD DE SERVICIO');
INSERT INTO `catservicios` VALUES ('5', 'MNTO PREVENTIVO', 'MNTO PREVENTIVO');

-- ----------------------------
-- Table structure for `demo`
-- ----------------------------
DROP TABLE IF EXISTS `demo`;
CREATE TABLE `demo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of demo
-- ----------------------------
INSERT INTO `demo` VALUES ('30', null);
INSERT INTO `demo` VALUES ('31', null);
INSERT INTO `demo` VALUES ('32', null);
INSERT INTO `demo` VALUES ('33', 'evidencia3.png');
INSERT INTO `demo` VALUES ('34', 'error.jpg');
INSERT INTO `demo` VALUES ('35', 'error.jpg');
INSERT INTO `demo` VALUES ('36', 'evidencia.png');
INSERT INTO `demo` VALUES ('37', 'evidencia2.png');
INSERT INTO `demo` VALUES ('38', 'evidencia3.png');
INSERT INTO `demo` VALUES ('39', 'fallas 5 de Junio.png');
INSERT INTO `demo` VALUES ('40', 'evidencia3.png');
INSERT INTO `demo` VALUES ('41', 'fallas 5 de Junio.png');
INSERT INTO `demo` VALUES ('42', 'error.jpg');
INSERT INTO `demo` VALUES ('43', 'error.jpg');
INSERT INTO `demo` VALUES ('44', 'fallas 5 de Junio.png');
INSERT INTO `demo` VALUES ('45', 'Firma Tatiana.jpg');
INSERT INTO `demo` VALUES ('46', 'firma.jpg');
INSERT INTO `demo` VALUES ('47', 'licencias.jpg');
INSERT INTO `demo` VALUES ('48', 'error.jpg');
INSERT INTO `demo` VALUES ('49', 'Firma Tatiana.jpg');
INSERT INTO `demo` VALUES ('50', 'firma.jpg');
INSERT INTO `demo` VALUES ('51', 'licencias.jpg');
INSERT INTO `demo` VALUES ('52', 'eleccionjeffer.jpg');
INSERT INTO `demo` VALUES ('53', 'error.jpg');
INSERT INTO `demo` VALUES ('54', 'Publiservicios.png');
INSERT INTO `demo` VALUES ('55', 'Firma Tatiana.jpg');
INSERT INTO `demo` VALUES ('56', 'firma.jpg');
INSERT INTO `demo` VALUES ('57', 'eleccionjeffer.jpg');
INSERT INTO `demo` VALUES ('58', 'error.jpg');
INSERT INTO `demo` VALUES ('59', 'eleccionjeffer.jpg');
INSERT INTO `demo` VALUES ('60', 'Firma Tatiana.jpg');
INSERT INTO `demo` VALUES ('61', 'fallas 29 de abril 2.png');
INSERT INTO `demo` VALUES ('62', 'fallas 9 de Mayo.png');
INSERT INTO `demo` VALUES ('63', 'fallas 15 de Mayo.png');
INSERT INTO `demo` VALUES ('64', 'fallas 29 de abril 2.png');
INSERT INTO `demo` VALUES ('65', 'Publiservicios.png');
INSERT INTO `demo` VALUES ('66', 'fallas 9 de Mayo.png');
INSERT INTO `demo` VALUES ('67', 'fallas 15 de Mayo.png');
INSERT INTO `demo` VALUES ('68', 'Publiservicios.png');
INSERT INTO `demo` VALUES ('69', 'fallas 5 de Junio.png');
INSERT INTO `demo` VALUES ('70', 'fallas 15 de Mayo.png');
INSERT INTO `demo` VALUES ('71', 'Publiservicios.png');
INSERT INTO `demo` VALUES ('72', 'fallas 9 de Mayo.png');
INSERT INTO `demo` VALUES ('73', 'evidencia3.png');
INSERT INTO `demo` VALUES ('74', 'eleccionjeffer.jpg');
INSERT INTO `demo` VALUES ('75', 'error.jpg');

-- ----------------------------
-- Table structure for `det_act_equipo`
-- ----------------------------
DROP TABLE IF EXISTS `det_act_equipo`;
CREATE TABLE `det_act_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_act` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `id_actE` int(11) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_act` (`id_act`),
  KEY `id_equipo` (`id_equipo`),
  KEY `det_act_equipo_ibfk_3` (`id_actE`),
  CONSTRAINT `det_act_equipo_ibfk_1` FOREIGN KEY (`id_act`) REFERENCES `actividades` (`id`),
  CONSTRAINT `det_act_equipo_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `ref_equipos` (`id`),
  CONSTRAINT `det_act_equipo_ibfk_3` FOREIGN KEY (`id_actE`) REFERENCES `actividadese` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of det_act_equipo
-- ----------------------------
INSERT INTO `det_act_equipo` VALUES ('39', '2', '1', '17', null);
INSERT INTO `det_act_equipo` VALUES ('42', '4', '5', '18', null);
INSERT INTO `det_act_equipo` VALUES ('43', '2', '5', '18', null);
INSERT INTO `det_act_equipo` VALUES ('44', '4', '8', '19', null);
INSERT INTO `det_act_equipo` VALUES ('45', '2', '8', '19', null);

-- ----------------------------
-- Table structure for `det_equipo`
-- ----------------------------
DROP TABLE IF EXISTS `det_equipo`;
CREATE TABLE `det_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_equipo` int(11) DEFAULT NULL,
  `id_accesorio` int(11) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_equipo` (`id_equipo`),
  KEY `id_accesorio` (`id_accesorio`),
  CONSTRAINT `det_equipo_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  CONSTRAINT `det_equipo_ibfk_2` FOREIGN KEY (`id_accesorio`) REFERENCES `accesorios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of det_equipo
-- ----------------------------

-- ----------------------------
-- Table structure for `det_equipos_estacion`
-- ----------------------------
DROP TABLE IF EXISTS `det_equipos_estacion`;
CREATE TABLE `det_equipos_estacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estacion` int(11) DEFAULT NULL,
  `id_etapa` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `tp_tren` char(255) DEFAULT NULL COMMENT '0 Ppal --- 1 By Pass',
  `id_mpio` varchar(6) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id_etapa` (`id_etapa`),
  KEY `id_equipo` (`id_equipo`),
  KEY `id_mpio` (`id_mpio`),
  KEY `id_estacion` (`id_estacion`),
  CONSTRAINT `det_equipos_estacion_ibfk_2` FOREIGN KEY (`id_etapa`) REFERENCES `etapas` (`id`),
  CONSTRAINT `det_equipos_estacion_ibfk_3` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  CONSTRAINT `det_equipos_estacion_ibfk_5` FOREIGN KEY (`id_mpio`) REFERENCES `mpios` (`id`),
  CONSTRAINT `det_equipos_estacion_ibfk_6` FOREIGN KEY (`id_estacion`) REFERENCES `estaciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of det_equipos_estacion
-- ----------------------------
INSERT INTO `det_equipos_estacion` VALUES ('1', '18', '2', '1', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('2', '18', '2', '2', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('3', '18', '2', '3', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('4', '18', '2', '4', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('5', '18', '2', '5', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('6', '18', '5', '6', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('7', '18', '5', '7', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('8', '18', '5', '8', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('9', '18', '5', '9', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('10', '18', '5', '10', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('11', '18', '5', '11', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('12', '18', '3', '12', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('13', '18', '3', '13', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('14', '18', '1', '14', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('15', '18', '1', '15', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('16', '18', '1', '16', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('17', '18', '1', '17', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('18', '18', '4', '18', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('19', '18', '4', '19', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('20', '18', '4', '20', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('21', '18', '4', '21', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('22', '18', '4', '22', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('23', '18', '4', '23', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('24', '18', '4', '24', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('25', '18', '4', '25', '1', '367');
INSERT INTO `det_equipos_estacion` VALUES ('26', '18', '9', '26', '0', '367');
INSERT INTO `det_equipos_estacion` VALUES ('27', '18', '9', '27', '0', '367');

-- ----------------------------
-- Table structure for `det_ins_equipo`
-- ----------------------------
DROP TABLE IF EXISTS `det_ins_equipo`;
CREATE TABLE `det_ins_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumoE` int(11) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT '',
  `id_insumo` int(11) DEFAULT NULL,
  `id_refequipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_insumo` (`id_insumo`),
  KEY `id_refequipo` (`id_refequipo`),
  KEY `id_insumoE` (`id_insumoE`),
  CONSTRAINT `det_ins_equipo_ibfk_2` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id`),
  CONSTRAINT `det_ins_equipo_ibfk_3` FOREIGN KEY (`id_refequipo`) REFERENCES `ref_equipos` (`id`),
  CONSTRAINT `det_ins_equipo_ibfk_4` FOREIGN KEY (`id_insumoE`) REFERENCES `insumose` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of det_ins_equipo
-- ----------------------------
INSERT INTO `det_ins_equipo` VALUES ('51', '33', 'Aplicar en Seco', '5', '5');
INSERT INTO `det_ins_equipo` VALUES ('52', '33', 'Aplicar en Seco', '4', '2');
INSERT INTO `det_ins_equipo` VALUES ('53', '34', null, '5', '4');
INSERT INTO `det_ins_equipo` VALUES ('54', '35', null, '4', '6');
INSERT INTO `det_ins_equipo` VALUES ('55', '36', null, '5', '6');
INSERT INTO `det_ins_equipo` VALUES ('56', '37', null, '5', '9');
INSERT INTO `det_ins_equipo` VALUES ('57', '38', null, '5', '2');
INSERT INTO `det_ins_equipo` VALUES ('58', '38', null, '4', '2');

-- ----------------------------
-- Table structure for `det_mercados`
-- ----------------------------
DROP TABLE IF EXISTS `det_mercados`;
CREATE TABLE `det_mercados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mercado` int(11) DEFAULT NULL,
  `id_mpio` varchar(6) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mercado` (`id_mercado`),
  KEY `id_mpio` (`id_mpio`),
  CONSTRAINT `det_mercados_ibfk_1` FOREIGN KEY (`id_mercado`) REFERENCES `mercados` (`id`),
  CONSTRAINT `det_mercados_ibfk_2` FOREIGN KEY (`id_mpio`) REFERENCES `mpios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of det_mercados
-- ----------------------------
INSERT INTO `det_mercados` VALUES ('18', '7', '813', null);
INSERT INTO `det_mercados` VALUES ('19', '7', '265', null);
INSERT INTO `det_mercados` VALUES ('20', '7', '666', null);

-- ----------------------------
-- Table structure for `det_mto_es`
-- ----------------------------
DROP TABLE IF EXISTS `det_mto_es`;
CREATE TABLE `det_mto_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mto` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mto` (`id_mto`),
  KEY `id_equipo` (`id_equipo`),
  CONSTRAINT `det_mto_es_ibfk_1` FOREIGN KEY (`id_mto`) REFERENCES `mto_es` (`id`),
  CONSTRAINT `det_mto_es_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of det_mto_es
-- ----------------------------
INSERT INTO `det_mto_es` VALUES ('96', '66', '14', null);
INSERT INTO `det_mto_es` VALUES ('97', '66', '16', null);
INSERT INTO `det_mto_es` VALUES ('98', '67', '16', null);
INSERT INTO `det_mto_es` VALUES ('99', '69', '12', null);
INSERT INTO `det_mto_es` VALUES ('100', '69', '15', null);
INSERT INTO `det_mto_es` VALUES ('101', '70', '12', null);
INSERT INTO `det_mto_es` VALUES ('102', '70', '13', null);

-- ----------------------------
-- Table structure for `det_oficinae`
-- ----------------------------
DROP TABLE IF EXISTS `det_oficinae`;
CREATE TABLE `det_oficinae` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_oficina` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_oficina` (`id_oficina`),
  KEY `id_equipo` (`id_equipo`),
  CONSTRAINT `det_oficinae_ibfk_1` FOREIGN KEY (`id_oficina`) REFERENCES `oficinas` (`id`),
  CONSTRAINT `det_oficinae_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of det_oficinae
-- ----------------------------

-- ----------------------------
-- Table structure for `diametros`
-- ----------------------------
DROP TABLE IF EXISTS `diametros`;
CREATE TABLE `diametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of diametros
-- ----------------------------
INSERT INTO `diametros` VALUES ('1', '1/2 pulgada 16 mm');
INSERT INTO `diametros` VALUES ('2', '1 pulgada 32 mm');
INSERT INTO `diametros` VALUES ('6', '3 pulgadas 90 mm');
INSERT INTO `diametros` VALUES ('7', '4 pulgadas 110 mm');
INSERT INTO `diametros` VALUES ('8', '6 pulgadas');
INSERT INTO `diametros` VALUES ('9', '2 pulgadas 63 mm');

-- ----------------------------
-- Table structure for `dptos`
-- ----------------------------
DROP TABLE IF EXISTS `dptos`;
CREATE TABLE `dptos` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `tmax` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dptos
-- ----------------------------
INSERT INTO `dptos` VALUES ('5', 'ANTIOQUIA', null);
INSERT INTO `dptos` VALUES ('8', 'ATLÁNTICO', null);
INSERT INTO `dptos` VALUES ('11', 'BOGOTÁ, D.C.', null);
INSERT INTO `dptos` VALUES ('13', 'BOLÍVAR', null);
INSERT INTO `dptos` VALUES ('15', 'BOYACÁ', null);
INSERT INTO `dptos` VALUES ('17', 'CALDAS', null);
INSERT INTO `dptos` VALUES ('18', 'CAQUETÁ', null);
INSERT INTO `dptos` VALUES ('19', 'CAUCA', null);
INSERT INTO `dptos` VALUES ('20', 'CESAR', null);
INSERT INTO `dptos` VALUES ('23', 'CÓRDOBA', null);
INSERT INTO `dptos` VALUES ('25', 'CUNDINAMARCA', null);
INSERT INTO `dptos` VALUES ('27', 'CHOCÓ', null);
INSERT INTO `dptos` VALUES ('41', 'HUILA', null);
INSERT INTO `dptos` VALUES ('44', 'LA GUAJIRA', null);
INSERT INTO `dptos` VALUES ('47', 'MAGDALENA', null);
INSERT INTO `dptos` VALUES ('50', 'META', null);
INSERT INTO `dptos` VALUES ('52', 'NARIÑO', null);
INSERT INTO `dptos` VALUES ('54', 'NORTE DE SANTANDER', null);
INSERT INTO `dptos` VALUES ('63', 'QUINDIO', null);
INSERT INTO `dptos` VALUES ('66', 'RISARALDA', null);
INSERT INTO `dptos` VALUES ('68', 'SANTANDER', '3');
INSERT INTO `dptos` VALUES ('70', 'SUCRE', null);
INSERT INTO `dptos` VALUES ('73', 'TOLIMA', null);
INSERT INTO `dptos` VALUES ('76', 'VALLE DEL CAUCA', null);
INSERT INTO `dptos` VALUES ('81', 'ARAUCA', null);
INSERT INTO `dptos` VALUES ('85', 'CASANARE', null);
INSERT INTO `dptos` VALUES ('86', 'PUTUMAYO', null);
INSERT INTO `dptos` VALUES ('91', 'AMAZONAS', null);
INSERT INTO `dptos` VALUES ('94', 'GUAINÍA', null);
INSERT INTO `dptos` VALUES ('95', 'GUAVIARE', null);
INSERT INTO `dptos` VALUES ('97', 'VAUPÉS', null);
INSERT INTO `dptos` VALUES ('99', 'VICHADA', null);

-- ----------------------------
-- Table structure for `equipos`
-- ----------------------------
DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` varchar(20) DEFAULT NULL,
  `id_responsable` varchar(15) DEFAULT '',
  `id_refequipo` int(11) DEFAULT NULL,
  `tag` varchar(20) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `id_modelo` int(11) DEFAULT NULL,
  `num_fac` varchar(50) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `fec_compra` date DEFAULT NULL,
  `fec_garantia` date DEFAULT NULL,
  `fec_instala` date DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `datachip` varchar(150) DEFAULT NULL,
  `estado` char(1) DEFAULT '0' COMMENT '0 sin asignar 1 asignado',
  `edo_mto` int(1) DEFAULT 0 COMMENT '0 disponible mto    1 en mantenimiento',
  `is_equipo` char(1) DEFAULT '0' COMMENT '1 para equipos de computo 0 para equipos estacion',
  PRIMARY KEY (`id`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_responsable` (`id_responsable`),
  KEY `id_refequipo` (`id_refequipo`),
  KEY `id_modelo` (`id_modelo`),
  CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`),
  CONSTRAINT `equipos_ibfk_4` FOREIGN KEY (`id_refequipo`) REFERENCES `ref_equipos` (`id`),
  CONSTRAINT `equipos_ibfk_5` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id`),
  CONSTRAINT `equipos_ibfk_6` FOREIGN KEY (`id_responsable`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipos
-- ----------------------------
INSERT INTO `equipos` VALUES ('1', '2', '1', '1', 'F/S-01', 'Por Definir', '1', '904', '201608112351', '2016-08-26', '2017-08-25', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('2', '1', '1', '2', 'VB05', 'Por Definir', '2', 'Por Definir', '58396-210-23', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('3', '1', '1', '2', 'VB07', 'Por Definir', '2', 'Por Definir', '58396-210-49', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('4', '1', '1', '2', 'VB08', 'Por Definir', '3', 'Por Definir', '60543-360-6', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('5', '1', '1', '2', 'VB06', 'Por Definir', '4', 'Por Definir', 'A105-1T1158', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('6', '3', '1', '3', 'FEC01', 'Por Definir', '14', '27525', '14618963', '2019-08-19', '2020-08-18', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('7', '3', '1', '4', 'FEC02', 'Por Definir', '5', '27525', '12279', '2016-08-23', '2017-08-23', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('8', '1', '1', '2', 'VB09', 'Por Definir', '2', 'Por Definir', '58396-210-16', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('9', '1', '1', '2', 'VB010', 'Por Definir', '2', 'Por Definir', '58396-210-10', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('10', '1', '1', '2', 'VB011', 'Por Definir', '3', 'Por Definir', '60543-360-40', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('11', '1', '1', '2', 'VB012', 'Por Definir', '3', 'Por Definir', '60543-360-20', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('12', '4', '1', '5', 'MOC01', 'Por Definir', '6', '526', '130876', '2019-08-19', '2020-08-18', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('13', '4', '1', '5', 'MOC01', 'Por Definir', '6', '526', '130873', '2019-08-19', '2020-08-18', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('14', '1', '1', '2', 'VB012', 'Por Definir', '2', 'Por Definir', '58396-210-28', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('15', '1', '1', '2', 'VB013', 'Por Definir', '2', 'Por Definir', '58396-210-18', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('16', '2', '1', '6', 'SSVD01', 'Por Definir', '7', '904', '201608112364', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('17', '2', '1', '6', 'SSVD02', 'Por Definir', '7', '904', '201608112365', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('18', '2', '1', '7', 'PC-01', 'Por Definir', '8', '904', '201608112353', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('19', '2', '1', '7', 'PC-02', 'Por Definir', '9', '904', '201608112357', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('20', '2', '1', '8', 'PP-01', 'Por Definir', '10', '904', '201608112354', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('21', '2', '1', '7', 'PC-03', 'Por Definir', '8', '904', '201608112352', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('22', '2', '1', '7', 'PC-04', 'Por Definir', '9', '904', '201608112356', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('23', '2', '1', '8', 'PP-02', 'Por Definir', '11', '904', '201608112358', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('24', '2', '1', '2', 'VB016', 'Por Definir', '2', '904', '58396-210-11', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('25', '2', '1', '2', 'VB014', 'Por Definir', '2', '904', '58396-210-15', '2016-08-26', '2017-08-26', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('26', '1', '1', '9', 'VC01', 'Por Definir', '12', 'Por Definir', '3S3RA8-NRD1', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('27', '1', '1', '2', 'VB017', 'Por Definir', '13', 'Por Definir', '58371-110-64', '0000-00-00', '0000-00-00', '2016-11-15', '', '', '1', '0', '0');
INSERT INTO `equipos` VALUES ('49', '333323232', '1', '12', null, 'EQUIPO DEL VOSTRO', '6', '3123123', '2121231', '2019-10-21', '2019-10-16', '2019-10-21', 'wwww', null, '0', '0', '1');
INSERT INTO `equipos` VALUES ('50', '333323232', '1057411553', '12', null, 'DDDDD', '17', '333333', '12344', '2019-11-19', '2019-11-12', '2019-11-19', 'wwww', null, '0', '0', '1');
INSERT INTO `equipos` VALUES ('51', '333323232', '1048847710', '11', null, 'EEEE', '6', '33', 'w333', '2019-11-19', '2019-11-11', '2019-11-19', 'eeeee', null, '0', '0', '1');

-- ----------------------------
-- Table structure for `equipos_etapa`
-- ----------------------------
DROP TABLE IF EXISTS `equipos_etapa`;
CREATE TABLE `equipos_etapa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ficha_es` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `id_etapa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipos_etapa
-- ----------------------------

-- ----------------------------
-- Table structure for `estaciones`
-- ----------------------------
DROP TABLE IF EXISTS `estaciones`;
CREATE TABLE `estaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTpEstacion` int(10) unsigned NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idmpio` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idTpEstacion` (`idTpEstacion`),
  CONSTRAINT `estaciones_ibfk_1` FOREIGN KEY (`idTpEstacion`) REFERENCES `tp_estacions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of estaciones
-- ----------------------------
INSERT INTO `estaciones` VALUES ('18', '11', 'OCE - 001 MOCHILERO', 'ESTACIÓN DEDICADA A LA REGULACIÓN DE GAS NATURAL PARA OCENSA.', null, '2019-07-02 11:25:35', '2019-07-02 11:25:35');
INSERT INTO `estaciones` VALUES ('19', '11', 'OCE - 002 MOCHILERO', 'demo', null, null, null);
INSERT INTO `estaciones` VALUES ('22', '11', 'nueva', 'nueva esta', null, '2019-08-29 13:18:38', '2019-08-29 13:18:38');

-- ----------------------------
-- Table structure for `etapas`
-- ----------------------------
DROP TABLE IF EXISTS `etapas`;
CREATE TABLE `etapas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) DEFAULT NULL,
  `desc` varchar(256) DEFAULT NULL,
  `tren_ppal` char(1) DEFAULT NULL,
  `tren secundario` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of etapas
-- ----------------------------
INSERT INTO `etapas` VALUES ('1', 'Etapa de Control', '', '1', '1');
INSERT INTO `etapas` VALUES ('2', 'Etapa de Filtracion', null, '1', '0');
INSERT INTO `etapas` VALUES ('3', 'ETAPA DE CALENTAMIENTO', 'E', null, null);
INSERT INTO `etapas` VALUES ('4', 'Etapa de Regulacion', null, null, null);
INSERT INTO `etapas` VALUES ('5', 'Etapa de Medicion', null, null, null);
INSERT INTO `etapas` VALUES ('6', 'Etapa de Odorizacion', null, null, null);
INSERT INTO `etapas` VALUES ('8', 'Etapa de Control Automatico', null, null, null);
INSERT INTO `etapas` VALUES ('9', 'Etapa de Dirección de Flujo', null, null, null);
INSERT INTO `etapas` VALUES ('10', 'Etapa de Control de Sobrepresión', null, null, null);
INSERT INTO `etapas` VALUES ('11', 'Etapa de Instrumentación', null, null, null);
INSERT INTO `etapas` VALUES ('17', 'Etapa de Control Neumática', 'TGI', null, null);

-- ----------------------------
-- Table structure for `etapas_estacion`
-- ----------------------------
DROP TABLE IF EXISTS `etapas_estacion`;
CREATE TABLE `etapas_estacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estacion` int(11) DEFAULT NULL,
  `id_etapa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of etapas_estacion
-- ----------------------------

-- ----------------------------
-- Table structure for `fichared`
-- ----------------------------
DROP TABLE IF EXISTS `fichared`;
CREATE TABLE `fichared` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tp_red` varchar(8) DEFAULT NULL,
  `id_diametro` int(11) DEFAULT NULL,
  `id_red` int(11) DEFAULT NULL,
  `id_mpio` varchar(6) DEFAULT '',
  `id_mpiofin` varchar(6) DEFAULT NULL,
  `fec_creacion` date DEFAULT NULL,
  `cant_poli` int(6) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `plano_g` varchar(255) DEFAULT NULL,
  `plano_a` varchar(255) DEFAULT NULL,
  `plano_c` varchar(255) DEFAULT NULL,
  `plano_p` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_diametro` (`id_diametro`),
  KEY `id_red` (`id_red`),
  KEY `id_mpio` (`id_mpio`),
  KEY `id_mpiofin` (`id_mpiofin`),
  CONSTRAINT `fichared_ibfk_1` FOREIGN KEY (`id_diametro`) REFERENCES `diametros` (`id`),
  CONSTRAINT `fichared_ibfk_2` FOREIGN KEY (`id_red`) REFERENCES `redes` (`id`),
  CONSTRAINT `fichared_ibfk_3` FOREIGN KEY (`id_mpio`) REFERENCES `mpios` (`id`),
  CONSTRAINT `fichared_ibfk_4` FOREIGN KEY (`id_mpiofin`) REFERENCES `mpios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fichared
-- ----------------------------

-- ----------------------------
-- Table structure for `fichaveh`
-- ----------------------------
DROP TABLE IF EXISTS `fichaveh`;
CREATE TABLE `fichaveh` (
  `id` varchar(8) NOT NULL,
  `nchasis` varchar(50) DEFAULT NULL,
  `fec_soat` date DEFAULT NULL,
  `fec_tecno` date DEFAULT NULL,
  `id_asignado` varchar(15) DEFAULT '',
  `id_cargo` int(11) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `id_linea` int(11) DEFAULT NULL,
  `modelo` varchar(10) DEFAULT '',
  `cilindraje` varchar(5) DEFAULT NULL,
  `traccion` varchar(4) DEFAULT NULL,
  `combustible` varchar(20) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `km` int(10) DEFAULT NULL,
  `rin` char(2) DEFAULT NULL,
  `nllantas` varchar(4) DEFAULT NULL,
  `km_cambio` int(10) DEFAULT NULL,
  `ref_aceite` varchar(50) DEFAULT NULL,
  `fec_compra` date DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cargo` (`id_cargo`),
  KEY `id_linea` (`id_linea`),
  KEY `id_asignado` (`id_asignado`),
  CONSTRAINT `fichaveh_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`),
  CONSTRAINT `fichaveh_ibfk_3` FOREIGN KEY (`id_linea`) REFERENCES `lineas` (`id`),
  CONSTRAINT `fichaveh_ibfk_4` FOREIGN KEY (`id_asignado`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fichaveh
-- ----------------------------
INSERT INTO `fichaveh` VALUES ('S57537', '9F9YWYCNCJ1145077', '2019-12-31', '2019-12-31', '1048848185', '30', 'Remolque', '4', '2018', '0', 'No A', 'No Aplica', 'NEGRO', '0', 'No', '4', '0', 'Por Definir', '0000-00-00', 'Remolque para transporte de gas Comprimido');
INSERT INTO `fichaveh` VALUES ('S57538', '9F9YWYCNCJ1145078', '2019-12-31', '2019-12-31', '1048848185', '30', 'Remolque', '4', '2018', '0', 'No A', 'No Aplica', 'NEGRO', '0', 'No', '4', '0', 'Por Definir', '0000-00-00', 'Remolque para transporte de gas Comprimido');
INSERT INTO `fichaveh` VALUES ('WPR191', '9BM952156KB187939', '2019-12-31', '2019-12-31', '1048848185', '30', 'camion', '2', '2019', '7291', 'No A', 'diesel', 'blanco', '19719', 'No', '6', '10000', 'mercedes', '0000-00-00', 'Cabinado tipo de caja manual 2 puertas');
INSERT INTO `fichaveh` VALUES ('WPT273', 'LJN0KB525HX200174', '2019-12-31', '2019-12-31', '1048848185', '30', 'camion', '3', '2017', '2953', 'No A', 'diesel', 'blanco', '0', 'No', '6', '0', 'nissan', '0000-00-00', '5 pasajeros 2 puertas doble cabina');

-- ----------------------------
-- Table structure for `ficha_estaciones`
-- ----------------------------
DROP TABLE IF EXISTS `ficha_estaciones`;
CREATE TABLE `ficha_estaciones` (
  `id` int(11) NOT NULL,
  `id_estacion` int(11) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `id_mpio` varchar(6) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `tp_ficha` char(1) DEFAULT NULL COMMENT '1 Ficha estaciones --- 2 Ficha equipos y herramienta.',
  PRIMARY KEY (`id`),
  KEY `id_mpio` (`id_mpio`),
  KEY `id_estacion` (`id_estacion`),
  CONSTRAINT `ficha_estaciones_ibfk_6` FOREIGN KEY (`id_mpio`) REFERENCES `mpios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ficha_estaciones
-- ----------------------------

-- ----------------------------
-- Table structure for `foto_festaciones`
-- ----------------------------
DROP TABLE IF EXISTS `foto_festaciones`;
CREATE TABLE `foto_festaciones` (
  `id_fichaE` int(11) DEFAULT NULL,
  `desc` varchar(250) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  KEY `id_fichaE` (`id_fichaE`),
  CONSTRAINT `foto_festaciones_ibfk_1` FOREIGN KEY (`id_fichaE`) REFERENCES `ficha_estaciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of foto_festaciones
-- ----------------------------

-- ----------------------------
-- Table structure for `horarios`
-- ----------------------------
DROP TABLE IF EXISTS `horarios`;
CREATE TABLE `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of horarios
-- ----------------------------
INSERT INTO `horarios` VALUES ('1', 'LUNES');

-- ----------------------------
-- Table structure for `insumos`
-- ----------------------------
DROP TABLE IF EXISTS `insumos`;
CREATE TABLE `insumos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of insumos
-- ----------------------------
INSERT INTO `insumos` VALUES ('4', 'PINTURA', 'PINTURA TUBO.');
INSERT INTO `insumos` VALUES ('5', 'ACEITE INDUSTRIAL', 'ACEITE PARA TUBOS DE PRESION');

-- ----------------------------
-- Table structure for `insumose`
-- ----------------------------
DROP TABLE IF EXISTS `insumose`;
CREATE TABLE `insumose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of insumose
-- ----------------------------
INSERT INTO `insumose` VALUES ('33', 'Insumos para calentadores');
INSERT INTO `insumose` VALUES ('34', 'INSUMOS COMPUTADOR');
INSERT INTO `insumose` VALUES ('35', 'INSUMOS VALVULAS GLOBO');
INSERT INTO `insumose` VALUES ('36', 'INSUMOS VALVULAS SHUTE MANTENIMIENTO');
INSERT INTO `insumose` VALUES ('37', 'INSUMOS VALVULA CHECK');
INSERT INTO `insumose` VALUES ('38', 'DEMO VALVULAS GLOBO');

-- ----------------------------
-- Table structure for `lineas`
-- ----------------------------
DROP TABLE IF EXISTS `lineas`;
CREATE TABLE `lineas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_marca` (`id_marca`),
  CONSTRAINT `lineas_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcaveh` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lineas
-- ----------------------------
INSERT INTO `lineas` VALUES ('1', 'Grand Vitara', '14');
INSERT INTO `lineas` VALUES ('2', 'Atego 1726 AUB', '81');
INSERT INTO `lineas` VALUES ('3', 'Cabsta', '80');
INSERT INTO `lineas` VALUES ('4', 'RCTCS2', '82');

-- ----------------------------
-- Table structure for `marcas`
-- ----------------------------
DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of marcas
-- ----------------------------
INSERT INTO `marcas` VALUES ('4', 'Pietro Fiorentimi ');
INSERT INTO `marcas` VALUES ('5', 'Neway');
INSERT INTO `marcas` VALUES ('6', 'Magival');
INSERT INTO `marcas` VALUES ('7', 'Eagle Rese Arch');
INSERT INTO `marcas` VALUES ('8', 'Catco');
INSERT INTO `marcas` VALUES ('9', 'Genérica');
INSERT INTO `marcas` VALUES ('11', 'DELL.');

-- ----------------------------
-- Table structure for `marcaveh`
-- ----------------------------
DROP TABLE IF EXISTS `marcaveh`;
CREATE TABLE `marcaveh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of marcaveh
-- ----------------------------
INSERT INTO `marcaveh` VALUES ('1', 'Abarth');
INSERT INTO `marcaveh` VALUES ('2', 'Alfa Romeo');
INSERT INTO `marcaveh` VALUES ('3', 'Aro');
INSERT INTO `marcaveh` VALUES ('4', 'Asia');
INSERT INTO `marcaveh` VALUES ('5', 'Asia Motors');
INSERT INTO `marcaveh` VALUES ('6', 'Aston Martin');
INSERT INTO `marcaveh` VALUES ('7', 'Audi');
INSERT INTO `marcaveh` VALUES ('8', 'Austin');
INSERT INTO `marcaveh` VALUES ('9', 'Auverland');
INSERT INTO `marcaveh` VALUES ('10', 'Bentley');
INSERT INTO `marcaveh` VALUES ('11', 'Bertone');
INSERT INTO `marcaveh` VALUES ('12', 'Bmw');
INSERT INTO `marcaveh` VALUES ('13', 'Cadillac');
INSERT INTO `marcaveh` VALUES ('14', 'Chevrolet');
INSERT INTO `marcaveh` VALUES ('15', 'Chrysler');
INSERT INTO `marcaveh` VALUES ('16', 'Citroen');
INSERT INTO `marcaveh` VALUES ('17', 'Corvette');
INSERT INTO `marcaveh` VALUES ('18', 'Dacia');
INSERT INTO `marcaveh` VALUES ('19', 'Daewoo');
INSERT INTO `marcaveh` VALUES ('20', 'Daf');
INSERT INTO `marcaveh` VALUES ('21', 'Daihatsu');
INSERT INTO `marcaveh` VALUES ('22', 'Daimler');
INSERT INTO `marcaveh` VALUES ('23', 'Dodge');
INSERT INTO `marcaveh` VALUES ('24', 'Ferrari');
INSERT INTO `marcaveh` VALUES ('25', 'Fiat');
INSERT INTO `marcaveh` VALUES ('26', 'Ford');
INSERT INTO `marcaveh` VALUES ('27', 'Galloper');
INSERT INTO `marcaveh` VALUES ('28', 'Gmc');
INSERT INTO `marcaveh` VALUES ('29', 'Honda');
INSERT INTO `marcaveh` VALUES ('30', 'Hummer');
INSERT INTO `marcaveh` VALUES ('31', 'Hyundai');
INSERT INTO `marcaveh` VALUES ('32', 'Infiniti');
INSERT INTO `marcaveh` VALUES ('33', 'Innocenti');
INSERT INTO `marcaveh` VALUES ('34', 'Isuzu');
INSERT INTO `marcaveh` VALUES ('35', 'Iveco');
INSERT INTO `marcaveh` VALUES ('36', 'Iveco-pegaso');
INSERT INTO `marcaveh` VALUES ('37', 'Jaguar');
INSERT INTO `marcaveh` VALUES ('38', 'Jeep');
INSERT INTO `marcaveh` VALUES ('39', 'Kia');
INSERT INTO `marcaveh` VALUES ('40', 'Lada');
INSERT INTO `marcaveh` VALUES ('41', 'Lamborghini');
INSERT INTO `marcaveh` VALUES ('42', 'Lancia');
INSERT INTO `marcaveh` VALUES ('43', 'Land-rover');
INSERT INTO `marcaveh` VALUES ('44', 'Ldv');
INSERT INTO `marcaveh` VALUES ('45', 'Lexus');
INSERT INTO `marcaveh` VALUES ('46', 'Lotus');
INSERT INTO `marcaveh` VALUES ('47', 'Mahindra');
INSERT INTO `marcaveh` VALUES ('48', 'Maserati');
INSERT INTO `marcaveh` VALUES ('49', 'Maybach');
INSERT INTO `marcaveh` VALUES ('50', 'Mazda');
INSERT INTO `marcaveh` VALUES ('51', 'Mercedes-benz');
INSERT INTO `marcaveh` VALUES ('52', 'Mg');
INSERT INTO `marcaveh` VALUES ('53', 'Mini');
INSERT INTO `marcaveh` VALUES ('54', 'Mitsubishi');
INSERT INTO `marcaveh` VALUES ('55', 'Morgan');
INSERT INTO `marcaveh` VALUES ('56', 'Nissan');
INSERT INTO `marcaveh` VALUES ('57', 'Opel');
INSERT INTO `marcaveh` VALUES ('58', 'Peugeot');
INSERT INTO `marcaveh` VALUES ('59', 'Pontiac');
INSERT INTO `marcaveh` VALUES ('60', 'Porsche');
INSERT INTO `marcaveh` VALUES ('61', 'Renault');
INSERT INTO `marcaveh` VALUES ('62', 'Rolls-royce');
INSERT INTO `marcaveh` VALUES ('63', 'Rover');
INSERT INTO `marcaveh` VALUES ('64', 'Saab');
INSERT INTO `marcaveh` VALUES ('65', 'Santana');
INSERT INTO `marcaveh` VALUES ('66', 'Seat');
INSERT INTO `marcaveh` VALUES ('67', 'Skoda');
INSERT INTO `marcaveh` VALUES ('68', 'Smart');
INSERT INTO `marcaveh` VALUES ('69', 'Ssangyong');
INSERT INTO `marcaveh` VALUES ('70', 'Subaru');
INSERT INTO `marcaveh` VALUES ('71', 'Suzuki');
INSERT INTO `marcaveh` VALUES ('72', 'Talbot');
INSERT INTO `marcaveh` VALUES ('73', 'Tata');
INSERT INTO `marcaveh` VALUES ('74', 'Toyota');
INSERT INTO `marcaveh` VALUES ('75', 'Umm');
INSERT INTO `marcaveh` VALUES ('76', 'Vaz');
INSERT INTO `marcaveh` VALUES ('77', 'Volkswagen');
INSERT INTO `marcaveh` VALUES ('78', 'Volvo');
INSERT INTO `marcaveh` VALUES ('79', 'Wartburg');
INSERT INTO `marcaveh` VALUES ('80', 'CAPRI');
INSERT INTO `marcaveh` VALUES ('81', 'Nissan');
INSERT INTO `marcaveh` VALUES ('82', 'Mercedes Benz');

-- ----------------------------
-- Table structure for `medidores`
-- ----------------------------
DROP TABLE IF EXISTS `medidores`;
CREATE TABLE `medidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial` varchar(20) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `fec_instala` date DEFAULT NULL,
  `estado` char(1) DEFAULT '1' COMMENT '0: dado de baja 1: Nuevo  2: Asignado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of medidores
-- ----------------------------

-- ----------------------------
-- Table structure for `mercados`
-- ----------------------------
DROP TABLE IF EXISTS `mercados`;
CREATE TABLE `mercados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mercados
-- ----------------------------
INSERT INTO `mercados` VALUES ('7', 'ZONA SAN GIL');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2', '2018_02_27_143638_create_personas_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_03_13_133425_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('4', '2018_03_14_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('5', '2019_05_17_125000_create_tp_estacion_table', '1');
INSERT INTO `migrations` VALUES ('6', '2019_05_17_125256_create_estaciones_table', '1');

-- ----------------------------
-- Table structure for `modelos`
-- ----------------------------
DROP TABLE IF EXISTS `modelos`;
CREATE TABLE `modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_marca` (`id_marca`),
  CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modelos
-- ----------------------------
INSERT INTO `modelos` VALUES ('1', 'HFA/1.5', '4');
INSERT INTO `modelos` VALUES ('2', '3in Ansi 600', '5');
INSERT INTO `modelos` VALUES ('3', '2in Ansi 600', '5');
INSERT INTO `modelos` VALUES ('4', '1/2in NPT  800', '6');
INSERT INTO `modelos` VALUES ('5', 'XARTU/1', '7');
INSERT INTO `modelos` VALUES ('6', 'CGA624', '8');
INSERT INTO `modelos` VALUES ('7', '14MN', '4');
INSERT INTO `modelos` VALUES ('8', 'Reflux 819/fo 2in (Trabajador)', '4');
INSERT INTO `modelos` VALUES ('9', 'Reflux PM819 2in (Monitor)', '4');
INSERT INTO `modelos` VALUES ('10', 'Piloto 204/A/2CS', '4');
INSERT INTO `modelos` VALUES ('11', '204/A/R14', '4');
INSERT INTO `modelos` VALUES ('12', '3in Ansi 300 - WCB - HF', '5');
INSERT INTO `modelos` VALUES ('13', '3in Ansi 300', '5');
INSERT INTO `modelos` VALUES ('14', 'Coriolis CMF', '9');
INSERT INTO `modelos` VALUES ('15', 'Generico', '9');
INSERT INTO `modelos` VALUES ('16', 'A 105N/ENP 3in Ansi 600\r\n', '5');
INSERT INTO `modelos` VALUES ('17', 'VOSTRO', '11');
INSERT INTO `modelos` VALUES ('28', 'A 105N/ENP 2in Ansi 602\r\n', '5');
INSERT INTO `modelos` VALUES ('29', 'A 105N/ENP 3in Ansi 601\r\n', '5');
INSERT INTO `modelos` VALUES ('30', 'VOSTTRO 1220', '11');

-- ----------------------------
-- Table structure for `mpios`
-- ----------------------------
DROP TABLE IF EXISTS `mpios`;
CREATE TABLE `mpios` (
  `id` varchar(6) NOT NULL,
  `id_dpto` int(2) unsigned NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `estado` int(1) unsigned NOT NULL,
  `tmax` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_dpto` (`id_dpto`),
  KEY `id_mpio` (`id`),
  CONSTRAINT `mpios_ibfk_1` FOREIGN KEY (`id_dpto`) REFERENCES `dptos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mpios
-- ----------------------------
INSERT INTO `mpios` VALUES ('1', '5', 'Abriaquí', '1', null);
INSERT INTO `mpios` VALUES ('10', '17', 'Aguadas', '1', null);
INSERT INTO `mpios` VALUES ('100', '5', 'Betania', '1', null);
INSERT INTO `mpios` VALUES ('1000', '68', 'Tona', '1', null);
INSERT INTO `mpios` VALUES ('1001', '15', 'Topagá', '1', null);
INSERT INTO `mpios` VALUES ('1002', '25', 'Topaipí', '1', null);
INSERT INTO `mpios` VALUES ('1003', '19', 'Toribío', '1', null);
INSERT INTO `mpios` VALUES ('1004', '76', 'Toro', '1', null);
INSERT INTO `mpios` VALUES ('1005', '15', 'Tota', '1', null);
INSERT INTO `mpios` VALUES ('1006', '19', 'Totoró', '1', null);
INSERT INTO `mpios` VALUES ('1007', '85', 'Trinidad', '1', null);
INSERT INTO `mpios` VALUES ('1008', '76', 'Trujillo', '1', null);
INSERT INTO `mpios` VALUES ('1009', '8', 'Tubará', '1', null);
INSERT INTO `mpios` VALUES ('101', '15', 'Beteitiva', '1', null);
INSERT INTO `mpios` VALUES ('1010', '23', 'Tuchín', '1', null);
INSERT INTO `mpios` VALUES ('1011', '76', 'Tulúa', '1', null);
INSERT INTO `mpios` VALUES ('1012', '52', 'Tumaco', '1', null);
INSERT INTO `mpios` VALUES ('1013', '15', 'Tunja', '1', null);
INSERT INTO `mpios` VALUES ('1014', '15', 'Tunungua', '1', null);
INSERT INTO `mpios` VALUES ('1015', '13', 'Turbaco', '1', null);
INSERT INTO `mpios` VALUES ('1016', '13', 'Turbaná', '1', null);
INSERT INTO `mpios` VALUES ('1017', '5', 'Turbo', '1', null);
INSERT INTO `mpios` VALUES ('1018', '15', 'Turmequé', '1', null);
INSERT INTO `mpios` VALUES ('1019', '15', 'Tuta', '1', null);
INSERT INTO `mpios` VALUES ('102', '5', 'Betulia', '1', null);
INSERT INTO `mpios` VALUES ('1020', '15', 'Tutasá', '1', null);
INSERT INTO `mpios` VALUES ('1021', '85', 'Támara', '1', null);
INSERT INTO `mpios` VALUES ('1022', '5', 'Támesis', '1', null);
INSERT INTO `mpios` VALUES ('1023', '52', 'Túquerres', '1', null);
INSERT INTO `mpios` VALUES ('1024', '25', 'Ubalá', '1', null);
INSERT INTO `mpios` VALUES ('1025', '25', 'Ubaque', '1', null);
INSERT INTO `mpios` VALUES ('1026', '25', 'Ubaté', '1', null);
INSERT INTO `mpios` VALUES ('1027', '76', 'Ulloa', '1', null);
INSERT INTO `mpios` VALUES ('1028', '25', 'Une', '1', null);
INSERT INTO `mpios` VALUES ('1029', '27', 'Unguía', '1', null);
INSERT INTO `mpios` VALUES ('103', '68', 'Betulia', '1', null);
INSERT INTO `mpios` VALUES ('1030', '27', 'Unión Panamericana (ÁNIMAS)', '1', null);
INSERT INTO `mpios` VALUES ('1031', '5', 'Uramita', '1', null);
INSERT INTO `mpios` VALUES ('1032', '50', 'Uribe', '1', null);
INSERT INTO `mpios` VALUES ('1033', '44', 'Uribia', '1', null);
INSERT INTO `mpios` VALUES ('1034', '5', 'Urrao', '1', null);
INSERT INTO `mpios` VALUES ('1035', '44', 'Urumita', '1', null);
INSERT INTO `mpios` VALUES ('1036', '8', 'Usiacuri', '1', null);
INSERT INTO `mpios` VALUES ('1037', '5', 'Valdivia', '1', null);
INSERT INTO `mpios` VALUES ('1038', '23', 'Valencia', '1', null);
INSERT INTO `mpios` VALUES ('1039', '68', 'Valle de San José', '1', null);
INSERT INTO `mpios` VALUES ('104', '25', 'Bituima', '1', null);
INSERT INTO `mpios` VALUES ('1040', '73', 'Valle de San Juan', '1', null);
INSERT INTO `mpios` VALUES ('1041', '86', 'Valle del Guamuez', '1', null);
INSERT INTO `mpios` VALUES ('1042', '20', 'Valledupar', '1', null);
INSERT INTO `mpios` VALUES ('1043', '5', 'Valparaiso', '1', null);
INSERT INTO `mpios` VALUES ('1044', '18', 'Valparaiso', '1', null);
INSERT INTO `mpios` VALUES ('1045', '5', 'Vegachí', '1', null);
INSERT INTO `mpios` VALUES ('1046', '73', 'Venadillo', '1', null);
INSERT INTO `mpios` VALUES ('1047', '5', 'Venecia', '1', null);
INSERT INTO `mpios` VALUES ('1048', '25', 'Venecia (Ospina Pérez)', '1', null);
INSERT INTO `mpios` VALUES ('1049', '15', 'Ventaquemada', '1', null);
INSERT INTO `mpios` VALUES ('105', '15', 'Boavita', '1', null);
INSERT INTO `mpios` VALUES ('1050', '25', 'Vergara', '1', null);
INSERT INTO `mpios` VALUES ('1051', '76', 'Versalles', '1', null);
INSERT INTO `mpios` VALUES ('1052', '68', 'Vetas', '1', null);
INSERT INTO `mpios` VALUES ('1053', '25', 'Viani', '1', null);
INSERT INTO `mpios` VALUES ('1054', '5', 'Vigía del Fuerte', '1', null);
INSERT INTO `mpios` VALUES ('1055', '76', 'Vijes', '1', null);
INSERT INTO `mpios` VALUES ('1056', '54', 'Villa Caro', '1', null);
INSERT INTO `mpios` VALUES ('1057', '19', 'Villa Rica', '1', null);
INSERT INTO `mpios` VALUES ('1058', '15', 'Villa de Leiva', '1', null);
INSERT INTO `mpios` VALUES ('1059', '54', 'Villa del Rosario', '1', null);
INSERT INTO `mpios` VALUES ('106', '54', 'Bochalema', '1', null);
INSERT INTO `mpios` VALUES ('1060', '86', 'Villagarzón', '1', null);
INSERT INTO `mpios` VALUES ('1061', '25', 'Villagómez', '1', null);
INSERT INTO `mpios` VALUES ('1062', '73', 'Villahermosa', '1', null);
INSERT INTO `mpios` VALUES ('1063', '17', 'Villamaría', '1', null);
INSERT INTO `mpios` VALUES ('1064', '13', 'Villanueva', '1', null);
INSERT INTO `mpios` VALUES ('1065', '44', 'Villanueva', '1', null);
INSERT INTO `mpios` VALUES ('1066', '68', 'Villanueva', '1', null);
INSERT INTO `mpios` VALUES ('1067', '85', 'Villanueva', '1', null);
INSERT INTO `mpios` VALUES ('1068', '25', 'Villapinzón', '1', null);
INSERT INTO `mpios` VALUES ('1069', '73', 'Villarrica', '1', null);
INSERT INTO `mpios` VALUES ('107', '11', 'Bogotá D.C.', '1', null);
INSERT INTO `mpios` VALUES ('1070', '50', 'Villavicencio', '1', null);
INSERT INTO `mpios` VALUES ('1071', '41', 'Villavieja', '1', null);
INSERT INTO `mpios` VALUES ('1072', '25', 'Villeta', '1', null);
INSERT INTO `mpios` VALUES ('1073', '25', 'Viotá', '1', null);
INSERT INTO `mpios` VALUES ('1074', '15', 'Viracachá', '1', null);
INSERT INTO `mpios` VALUES ('1075', '50', 'Vista Hermosa', '1', null);
INSERT INTO `mpios` VALUES ('1076', '17', 'Viterbo', '1', null);
INSERT INTO `mpios` VALUES ('1077', '68', 'Vélez', '1', null);
INSERT INTO `mpios` VALUES ('1078', '25', 'Yacopí', '1', null);
INSERT INTO `mpios` VALUES ('1079', '52', 'Yacuanquer', '1', null);
INSERT INTO `mpios` VALUES ('108', '25', 'Bojacá', '1', null);
INSERT INTO `mpios` VALUES ('1080', '41', 'Yaguará', '1', null);
INSERT INTO `mpios` VALUES ('1081', '5', 'Yalí', '1', null);
INSERT INTO `mpios` VALUES ('1082', '5', 'Yarumal', '1', null);
INSERT INTO `mpios` VALUES ('1083', '5', 'Yolombó', '1', null);
INSERT INTO `mpios` VALUES ('1084', '5', 'Yondó (Casabe)', '1', null);
INSERT INTO `mpios` VALUES ('1085', '85', 'Yopal', '1', null);
INSERT INTO `mpios` VALUES ('1086', '76', 'Yotoco', '1', null);
INSERT INTO `mpios` VALUES ('1087', '76', 'Yumbo', '1', null);
INSERT INTO `mpios` VALUES ('1088', '13', 'Zambrano', '1', null);
INSERT INTO `mpios` VALUES ('1089', '68', 'Zapatoca', '1', null);
INSERT INTO `mpios` VALUES ('109', '27', 'Bojayá (Bellavista)', '1', null);
INSERT INTO `mpios` VALUES ('1090', '47', 'Zapayán (PUNTA DE PIEDRAS)', '1', null);
INSERT INTO `mpios` VALUES ('1091', '5', 'Zaragoza', '1', null);
INSERT INTO `mpios` VALUES ('1092', '76', 'Zarzal', '1', null);
INSERT INTO `mpios` VALUES ('1093', '15', 'Zetaquirá', '1', null);
INSERT INTO `mpios` VALUES ('1094', '25', 'Zipacón', '1', null);
INSERT INTO `mpios` VALUES ('1095', '25', 'Zipaquirá', '1', null);
INSERT INTO `mpios` VALUES ('1096', '47', 'Zona Bananera (PRADO - SEVILLA)', '1', null);
INSERT INTO `mpios` VALUES ('1097', '54', 'Ábrego', '1', null);
INSERT INTO `mpios` VALUES ('1098', '41', 'Íquira', '1', null);
INSERT INTO `mpios` VALUES ('1099', '15', 'Úmbita', '1', null);
INSERT INTO `mpios` VALUES ('11', '85', 'Aguazul', '1', null);
INSERT INTO `mpios` VALUES ('110', '5', 'Bolívar', '1', null);
INSERT INTO `mpios` VALUES ('1100', '25', 'Útica', '1', null);
INSERT INTO `mpios` VALUES ('111', '19', 'Bolívar', '1', null);
INSERT INTO `mpios` VALUES ('112', '68', 'Bolívar', '1', null);
INSERT INTO `mpios` VALUES ('113', '76', 'Bolívar', '1', null);
INSERT INTO `mpios` VALUES ('114', '20', 'Bosconia', '1', null);
INSERT INTO `mpios` VALUES ('115', '15', 'Boyacá', '1', null);
INSERT INTO `mpios` VALUES ('116', '5', 'Briceño', '1', null);
INSERT INTO `mpios` VALUES ('117', '15', 'Briceño', '1', null);
INSERT INTO `mpios` VALUES ('118', '68', 'Bucaramanga', '1', null);
INSERT INTO `mpios` VALUES ('119', '54', 'Bucarasica', '1', null);
INSERT INTO `mpios` VALUES ('12', '20', 'Agustín Codazzi', '1', null);
INSERT INTO `mpios` VALUES ('120', '76', 'Buenaventura', '1', null);
INSERT INTO `mpios` VALUES ('121', '15', 'Buenavista', '1', null);
INSERT INTO `mpios` VALUES ('122', '23', 'Buenavista', '1', null);
INSERT INTO `mpios` VALUES ('123', '63', 'Buenavista', '1', null);
INSERT INTO `mpios` VALUES ('124', '70', 'Buenavista', '1', null);
INSERT INTO `mpios` VALUES ('125', '19', 'Buenos Aires', '1', null);
INSERT INTO `mpios` VALUES ('126', '52', 'Buesaco', '1', null);
INSERT INTO `mpios` VALUES ('127', '76', 'Buga', '1', null);
INSERT INTO `mpios` VALUES ('128', '76', 'Bugalagrande', '1', null);
INSERT INTO `mpios` VALUES ('129', '5', 'Burítica', '1', null);
INSERT INTO `mpios` VALUES ('13', '41', 'Aipe', '1', null);
INSERT INTO `mpios` VALUES ('130', '15', 'Busbanza', '1', null);
INSERT INTO `mpios` VALUES ('131', '25', 'Cabrera', '1', null);
INSERT INTO `mpios` VALUES ('132', '68', 'Cabrera', '1', null);
INSERT INTO `mpios` VALUES ('133', '50', 'Cabuyaro', '1', null);
INSERT INTO `mpios` VALUES ('134', '25', 'Cachipay', '1', null);
INSERT INTO `mpios` VALUES ('135', '5', 'Caicedo', '1', null);
INSERT INTO `mpios` VALUES ('136', '76', 'Caicedonia', '1', null);
INSERT INTO `mpios` VALUES ('137', '70', 'Caimito', '1', null);
INSERT INTO `mpios` VALUES ('138', '73', 'Cajamarca', '1', null);
INSERT INTO `mpios` VALUES ('139', '19', 'Cajibío', '1', null);
INSERT INTO `mpios` VALUES ('14', '18', 'Albania', '1', null);
INSERT INTO `mpios` VALUES ('140', '25', 'Cajicá', '1', null);
INSERT INTO `mpios` VALUES ('141', '13', 'Calamar', '1', null);
INSERT INTO `mpios` VALUES ('142', '95', 'Calamar', '1', null);
INSERT INTO `mpios` VALUES ('143', '63', 'Calarcá', '1', null);
INSERT INTO `mpios` VALUES ('144', '5', 'Caldas', '1', null);
INSERT INTO `mpios` VALUES ('145', '15', 'Caldas', '1', null);
INSERT INTO `mpios` VALUES ('146', '19', 'Caldono', '1', null);
INSERT INTO `mpios` VALUES ('147', '68', 'California', '1', null);
INSERT INTO `mpios` VALUES ('148', '76', 'Calima (Darién)', '1', null);
INSERT INTO `mpios` VALUES ('149', '19', 'Caloto', '1', null);
INSERT INTO `mpios` VALUES ('15', '44', 'Albania', '1', null);
INSERT INTO `mpios` VALUES ('150', '76', 'Calí', '1', null);
INSERT INTO `mpios` VALUES ('151', '5', 'Campamento', '1', null);
INSERT INTO `mpios` VALUES ('152', '8', 'Campo de la Cruz', '1', null);
INSERT INTO `mpios` VALUES ('153', '41', 'Campoalegre', '1', null);
INSERT INTO `mpios` VALUES ('154', '15', 'Campohermoso', '1', null);
INSERT INTO `mpios` VALUES ('155', '23', 'Canalete', '1', null);
INSERT INTO `mpios` VALUES ('156', '8', 'Candelaria', '1', null);
INSERT INTO `mpios` VALUES ('157', '76', 'Candelaria', '1', null);
INSERT INTO `mpios` VALUES ('158', '13', 'Cantagallo', '1', null);
INSERT INTO `mpios` VALUES ('159', '27', 'Cantón de San Pablo', '1', null);
INSERT INTO `mpios` VALUES ('16', '68', 'Albania', '1', null);
INSERT INTO `mpios` VALUES ('160', '25', 'Caparrapí', '1', null);
INSERT INTO `mpios` VALUES ('161', '68', 'Capitanejo', '1', null);
INSERT INTO `mpios` VALUES ('162', '5', 'Caracolí', '1', null);
INSERT INTO `mpios` VALUES ('163', '5', 'Caramanta', '1', null);
INSERT INTO `mpios` VALUES ('164', '68', 'Carcasí', '1', null);
INSERT INTO `mpios` VALUES ('165', '5', 'Carepa', '1', null);
INSERT INTO `mpios` VALUES ('166', '73', 'Carmen de Apicalá', '1', null);
INSERT INTO `mpios` VALUES ('167', '25', 'Carmen de Carupa', '1', null);
INSERT INTO `mpios` VALUES ('168', '5', 'Carmen de Viboral', '1', null);
INSERT INTO `mpios` VALUES ('169', '27', 'Carmen del Darién (CURBARADÓ)', '1', null);
INSERT INTO `mpios` VALUES ('17', '25', 'Albán', '1', null);
INSERT INTO `mpios` VALUES ('170', '5', 'Carolina', '1', null);
INSERT INTO `mpios` VALUES ('171', '13', 'Cartagena', '1', null);
INSERT INTO `mpios` VALUES ('172', '18', 'Cartagena del Chairá', '1', null);
INSERT INTO `mpios` VALUES ('173', '76', 'Cartago', '1', null);
INSERT INTO `mpios` VALUES ('174', '97', 'Carurú', '1', null);
INSERT INTO `mpios` VALUES ('175', '73', 'Casabianca', '1', null);
INSERT INTO `mpios` VALUES ('176', '50', 'Castilla la Nueva', '1', null);
INSERT INTO `mpios` VALUES ('177', '5', 'Caucasia', '1', null);
INSERT INTO `mpios` VALUES ('178', '5', 'Cañasgordas', '1', null);
INSERT INTO `mpios` VALUES ('179', '68', 'Cepita', '1', null);
INSERT INTO `mpios` VALUES ('18', '52', 'Albán (San José)', '1', null);
INSERT INTO `mpios` VALUES ('180', '23', 'Cereté', '1', null);
INSERT INTO `mpios` VALUES ('181', '15', 'Cerinza', '1', null);
INSERT INTO `mpios` VALUES ('182', '68', 'Cerrito', '1', null);
INSERT INTO `mpios` VALUES ('183', '47', 'Cerro San Antonio', '1', null);
INSERT INTO `mpios` VALUES ('184', '52', 'Chachaguí', '1', null);
INSERT INTO `mpios` VALUES ('185', '25', 'Chaguaní', '1', null);
INSERT INTO `mpios` VALUES ('186', '70', 'Chalán', '1', null);
INSERT INTO `mpios` VALUES ('187', '73', 'Chaparral', '1', null);
INSERT INTO `mpios` VALUES ('188', '68', 'Charalá', '1', null);
INSERT INTO `mpios` VALUES ('189', '68', 'Charta', '1', null);
INSERT INTO `mpios` VALUES ('19', '76', 'Alcalá', '1', null);
INSERT INTO `mpios` VALUES ('190', '5', 'Chigorodó', '1', null);
INSERT INTO `mpios` VALUES ('191', '68', 'Chima', '1', null);
INSERT INTO `mpios` VALUES ('192', '20', 'Chimichagua', '1', null);
INSERT INTO `mpios` VALUES ('193', '23', 'Chimá', '1', null);
INSERT INTO `mpios` VALUES ('194', '15', 'Chinavita', '1', null);
INSERT INTO `mpios` VALUES ('195', '17', 'Chinchiná', '1', null);
INSERT INTO `mpios` VALUES ('196', '54', 'Chinácota', '1', null);
INSERT INTO `mpios` VALUES ('197', '23', 'Chinú', '1', null);
INSERT INTO `mpios` VALUES ('198', '25', 'Chipaque', '1', null);
INSERT INTO `mpios` VALUES ('199', '68', 'Chipatá', '1', null);
INSERT INTO `mpios` VALUES ('2', '50', 'Acacías', '1', null);
INSERT INTO `mpios` VALUES ('20', '5', 'Alejandria', '1', null);
INSERT INTO `mpios` VALUES ('200', '15', 'Chiquinquirá', '1', null);
INSERT INTO `mpios` VALUES ('201', '20', 'Chiriguaná', '1', null);
INSERT INTO `mpios` VALUES ('202', '15', 'Chiscas', '1', null);
INSERT INTO `mpios` VALUES ('203', '15', 'Chita', '1', null);
INSERT INTO `mpios` VALUES ('204', '54', 'Chitagá', '1', null);
INSERT INTO `mpios` VALUES ('205', '15', 'Chitaraque', '1', null);
INSERT INTO `mpios` VALUES ('206', '15', 'Chivatá', '1', null);
INSERT INTO `mpios` VALUES ('207', '47', 'Chivolo', '1', null);
INSERT INTO `mpios` VALUES ('208', '25', 'Choachí', '1', null);
INSERT INTO `mpios` VALUES ('209', '25', 'Chocontá', '1', null);
INSERT INTO `mpios` VALUES ('21', '47', 'Algarrobo', '1', null);
INSERT INTO `mpios` VALUES ('210', '85', 'Chámeza', '1', null);
INSERT INTO `mpios` VALUES ('211', '25', 'Chía', '1', null);
INSERT INTO `mpios` VALUES ('212', '15', 'Chíquiza', '1', null);
INSERT INTO `mpios` VALUES ('213', '15', 'Chívor', '1', null);
INSERT INTO `mpios` VALUES ('214', '13', 'Cicuco', '1', null);
INSERT INTO `mpios` VALUES ('215', '68', 'Cimitarra', '1', null);
INSERT INTO `mpios` VALUES ('216', '63', 'Circasia', '1', null);
INSERT INTO `mpios` VALUES ('217', '5', 'Cisneros', '1', null);
INSERT INTO `mpios` VALUES ('218', '15', 'Ciénaga', '1', null);
INSERT INTO `mpios` VALUES ('219', '47', 'Ciénaga', '1', null);
INSERT INTO `mpios` VALUES ('22', '41', 'Algeciras', '1', null);
INSERT INTO `mpios` VALUES ('220', '23', 'Ciénaga de Oro', '1', null);
INSERT INTO `mpios` VALUES ('221', '13', 'Clemencia', '1', null);
INSERT INTO `mpios` VALUES ('222', '5', 'Cocorná', '1', null);
INSERT INTO `mpios` VALUES ('223', '73', 'Coello', '1', null);
INSERT INTO `mpios` VALUES ('224', '25', 'Cogua', '1', null);
INSERT INTO `mpios` VALUES ('225', '41', 'Colombia', '1', null);
INSERT INTO `mpios` VALUES ('226', '70', 'Colosó (Ricaurte)', '1', null);
INSERT INTO `mpios` VALUES ('227', '86', 'Colón', '1', null);
INSERT INTO `mpios` VALUES ('228', '52', 'Colón (Génova)', '1', null);
INSERT INTO `mpios` VALUES ('229', '5', 'Concepción', '1', null);
INSERT INTO `mpios` VALUES ('23', '19', 'Almaguer', '1', null);
INSERT INTO `mpios` VALUES ('230', '68', 'Concepción', '1', null);
INSERT INTO `mpios` VALUES ('231', '5', 'Concordia', '1', null);
INSERT INTO `mpios` VALUES ('232', '47', 'Concordia', '1', null);
INSERT INTO `mpios` VALUES ('233', '27', 'Condoto', '1', null);
INSERT INTO `mpios` VALUES ('234', '68', 'Confines', '1', null);
INSERT INTO `mpios` VALUES ('235', '52', 'Consaca', '1', null);
INSERT INTO `mpios` VALUES ('236', '52', 'Contadero', '1', null);
INSERT INTO `mpios` VALUES ('237', '68', 'Contratación', '1', null);
INSERT INTO `mpios` VALUES ('238', '54', 'Convención', '1', null);
INSERT INTO `mpios` VALUES ('239', '5', 'Copacabana', '1', null);
INSERT INTO `mpios` VALUES ('24', '15', 'Almeida', '1', null);
INSERT INTO `mpios` VALUES ('240', '15', 'Coper', '1', null);
INSERT INTO `mpios` VALUES ('241', '63', 'Cordobá', '1', null);
INSERT INTO `mpios` VALUES ('242', '19', 'Corinto', '1', null);
INSERT INTO `mpios` VALUES ('243', '68', 'Coromoro', '1', null);
INSERT INTO `mpios` VALUES ('244', '70', 'Corozal', '1', null);
INSERT INTO `mpios` VALUES ('245', '15', 'Corrales', '1', null);
INSERT INTO `mpios` VALUES ('246', '25', 'Cota', '1', null);
INSERT INTO `mpios` VALUES ('247', '23', 'Cotorra', '1', null);
INSERT INTO `mpios` VALUES ('248', '15', 'Covarachía', '1', null);
INSERT INTO `mpios` VALUES ('249', '70', 'Coveñas', '1', null);
INSERT INTO `mpios` VALUES ('25', '73', 'Alpujarra', '1', null);
INSERT INTO `mpios` VALUES ('250', '73', 'Coyaima', '1', null);
INSERT INTO `mpios` VALUES ('251', '81', 'Cravo Norte', '1', null);
INSERT INTO `mpios` VALUES ('252', '52', 'Cuaspud (Carlosama)', '1', null);
INSERT INTO `mpios` VALUES ('253', '50', 'Cubarral', '1', null);
INSERT INTO `mpios` VALUES ('254', '15', 'Cubará', '1', null);
INSERT INTO `mpios` VALUES ('255', '15', 'Cucaita', '1', null);
INSERT INTO `mpios` VALUES ('256', '25', 'Cucunubá', '1', null);
INSERT INTO `mpios` VALUES ('257', '54', 'Cucutilla', '1', null);
INSERT INTO `mpios` VALUES ('258', '15', 'Cuitiva', '1', null);
INSERT INTO `mpios` VALUES ('259', '50', 'Cumaral', '1', null);
INSERT INTO `mpios` VALUES ('26', '41', 'Altamira', '1', null);
INSERT INTO `mpios` VALUES ('260', '99', 'Cumaribo', '1', null);
INSERT INTO `mpios` VALUES ('261', '52', 'Cumbal', '1', null);
INSERT INTO `mpios` VALUES ('262', '52', 'Cumbitara', '1', null);
INSERT INTO `mpios` VALUES ('263', '73', 'Cunday', '1', null);
INSERT INTO `mpios` VALUES ('264', '18', 'Curillo', '1', null);
INSERT INTO `mpios` VALUES ('265', '68', 'Curití', '1', null);
INSERT INTO `mpios` VALUES ('266', '20', 'Curumaní', '1', null);
INSERT INTO `mpios` VALUES ('267', '5', 'Cáceres', '1', null);
INSERT INTO `mpios` VALUES ('268', '54', 'Cáchira', '1', null);
INSERT INTO `mpios` VALUES ('269', '54', 'Cácota', '1', null);
INSERT INTO `mpios` VALUES ('27', '27', 'Alto Baudó (Pie de Pato)', '1', null);
INSERT INTO `mpios` VALUES ('270', '25', 'Cáqueza', '1', null);
INSERT INTO `mpios` VALUES ('271', '27', 'Cértegui', '1', null);
INSERT INTO `mpios` VALUES ('272', '15', 'Cómbita', '1', null);
INSERT INTO `mpios` VALUES ('273', '13', 'Córdoba', '1', null);
INSERT INTO `mpios` VALUES ('274', '52', 'Córdoba', '1', null);
INSERT INTO `mpios` VALUES ('275', '54', 'Cúcuta', '1', null);
INSERT INTO `mpios` VALUES ('276', '5', 'Dabeiba', '1', null);
INSERT INTO `mpios` VALUES ('277', '76', 'Dagua', '1', null);
INSERT INTO `mpios` VALUES ('278', '44', 'Dibulla', '1', null);
INSERT INTO `mpios` VALUES ('279', '44', 'Distracción', '1', null);
INSERT INTO `mpios` VALUES ('28', '13', 'Altos del Rosario', '1', null);
INSERT INTO `mpios` VALUES ('280', '73', 'Dolores', '1', null);
INSERT INTO `mpios` VALUES ('281', '5', 'Don Matías', '1', null);
INSERT INTO `mpios` VALUES ('282', '66', 'Dos Quebradas', '1', null);
INSERT INTO `mpios` VALUES ('283', '15', 'Duitama', '1', null);
INSERT INTO `mpios` VALUES ('284', '54', 'Durania', '1', null);
INSERT INTO `mpios` VALUES ('285', '5', 'Ebéjico', '1', null);
INSERT INTO `mpios` VALUES ('286', '5', 'El Bagre', '1', null);
INSERT INTO `mpios` VALUES ('287', '47', 'El Banco', '1', null);
INSERT INTO `mpios` VALUES ('288', '76', 'El Cairo', '1', null);
INSERT INTO `mpios` VALUES ('289', '50', 'El Calvario', '1', null);
INSERT INTO `mpios` VALUES ('29', '73', 'Alvarado', '1', null);
INSERT INTO `mpios` VALUES ('290', '54', 'El Carmen', '1', null);
INSERT INTO `mpios` VALUES ('291', '68', 'El Carmen', '1', null);
INSERT INTO `mpios` VALUES ('292', '27', 'El Carmen de Atrato', '1', null);
INSERT INTO `mpios` VALUES ('293', '13', 'El Carmen de Bolívar', '1', null);
INSERT INTO `mpios` VALUES ('294', '50', 'El Castillo', '1', null);
INSERT INTO `mpios` VALUES ('295', '76', 'El Cerrito', '1', null);
INSERT INTO `mpios` VALUES ('296', '52', 'El Charco', '1', null);
INSERT INTO `mpios` VALUES ('297', '15', 'El Cocuy', '1', null);
INSERT INTO `mpios` VALUES ('298', '25', 'El Colegio', '1', null);
INSERT INTO `mpios` VALUES ('299', '20', 'El Copey', '1', null);
INSERT INTO `mpios` VALUES ('3', '27', 'Acandí', '1', null);
INSERT INTO `mpios` VALUES ('30', '5', 'Amagá', '1', null);
INSERT INTO `mpios` VALUES ('300', '18', 'El Doncello', '1', null);
INSERT INTO `mpios` VALUES ('301', '50', 'El Dorado', '1', null);
INSERT INTO `mpios` VALUES ('302', '76', 'El Dovio', '1', null);
INSERT INTO `mpios` VALUES ('303', '15', 'El Espino', '1', null);
INSERT INTO `mpios` VALUES ('304', '68', 'El Guacamayo', '1', null);
INSERT INTO `mpios` VALUES ('305', '13', 'El Guamo', '1', null);
INSERT INTO `mpios` VALUES ('306', '44', 'El Molino', '1', null);
INSERT INTO `mpios` VALUES ('307', '20', 'El Paso', '1', null);
INSERT INTO `mpios` VALUES ('308', '18', 'El Paujil', '1', null);
INSERT INTO `mpios` VALUES ('309', '52', 'El Peñol', '1', null);
INSERT INTO `mpios` VALUES ('31', '5', 'Amalfi', '1', null);
INSERT INTO `mpios` VALUES ('310', '13', 'El Peñon', '1', null);
INSERT INTO `mpios` VALUES ('311', '68', 'El Peñon', '1', null);
INSERT INTO `mpios` VALUES ('312', '25', 'El Peñón', '1', null);
INSERT INTO `mpios` VALUES ('313', '47', 'El Piñon', '1', null);
INSERT INTO `mpios` VALUES ('314', '68', 'El Playón', '1', null);
INSERT INTO `mpios` VALUES ('315', '95', 'El Retorno', '1', null);
INSERT INTO `mpios` VALUES ('316', '47', 'El Retén', '1', null);
INSERT INTO `mpios` VALUES ('317', '70', 'El Roble', '1', null);
INSERT INTO `mpios` VALUES ('318', '25', 'El Rosal', '1', null);
INSERT INTO `mpios` VALUES ('319', '52', 'El Rosario', '1', null);
INSERT INTO `mpios` VALUES ('32', '73', 'Ambalema', '1', null);
INSERT INTO `mpios` VALUES ('320', '52', 'El Tablón de Gómez', '1', null);
INSERT INTO `mpios` VALUES ('321', '19', 'El Tambo', '1', null);
INSERT INTO `mpios` VALUES ('322', '52', 'El Tambo', '1', null);
INSERT INTO `mpios` VALUES ('323', '54', 'El Tarra', '1', null);
INSERT INTO `mpios` VALUES ('324', '54', 'El Zulia', '1', null);
INSERT INTO `mpios` VALUES ('325', '76', 'El Águila', '1', null);
INSERT INTO `mpios` VALUES ('326', '41', 'Elías', '1', null);
INSERT INTO `mpios` VALUES ('327', '68', 'Encino', '1', null);
INSERT INTO `mpios` VALUES ('328', '68', 'Enciso', '1', null);
INSERT INTO `mpios` VALUES ('329', '5', 'Entrerríos', '1', null);
INSERT INTO `mpios` VALUES ('33', '25', 'Anapoima', '1', null);
INSERT INTO `mpios` VALUES ('330', '5', 'Envigado', '1', null);
INSERT INTO `mpios` VALUES ('331', '73', 'Espinal', '1', null);
INSERT INTO `mpios` VALUES ('332', '25', 'Facatativá', '1', null);
INSERT INTO `mpios` VALUES ('333', '73', 'Falan', '1', null);
INSERT INTO `mpios` VALUES ('334', '17', 'Filadelfia', '1', null);
INSERT INTO `mpios` VALUES ('335', '63', 'Filandia', '1', null);
INSERT INTO `mpios` VALUES ('336', '15', 'Firavitoba', '1', null);
INSERT INTO `mpios` VALUES ('337', '73', 'Flandes', '1', null);
INSERT INTO `mpios` VALUES ('338', '18', 'Florencia', '1', null);
INSERT INTO `mpios` VALUES ('339', '19', 'Florencia', '1', null);
INSERT INTO `mpios` VALUES ('34', '52', 'Ancuya', '1', null);
INSERT INTO `mpios` VALUES ('340', '15', 'Floresta', '1', null);
INSERT INTO `mpios` VALUES ('341', '76', 'Florida', '1', null);
INSERT INTO `mpios` VALUES ('342', '68', 'Floridablanca', '1', null);
INSERT INTO `mpios` VALUES ('343', '68', 'Florián', '1', null);
INSERT INTO `mpios` VALUES ('344', '44', 'Fonseca', '1', null);
INSERT INTO `mpios` VALUES ('345', '81', 'Fortúl', '1', null);
INSERT INTO `mpios` VALUES ('346', '25', 'Fosca', '1', null);
INSERT INTO `mpios` VALUES ('347', '52', 'Francisco Pizarro', '1', null);
INSERT INTO `mpios` VALUES ('348', '5', 'Fredonia', '1', null);
INSERT INTO `mpios` VALUES ('349', '73', 'Fresno', '1', null);
INSERT INTO `mpios` VALUES ('35', '76', 'Andalucía', '1', null);
INSERT INTO `mpios` VALUES ('350', '5', 'Frontino', '1', null);
INSERT INTO `mpios` VALUES ('351', '50', 'Fuente de Oro', '1', null);
INSERT INTO `mpios` VALUES ('352', '47', 'Fundación', '1', null);
INSERT INTO `mpios` VALUES ('353', '52', 'Funes', '1', null);
INSERT INTO `mpios` VALUES ('354', '25', 'Funza', '1', null);
INSERT INTO `mpios` VALUES ('355', '25', 'Fusagasugá', '1', null);
INSERT INTO `mpios` VALUES ('356', '25', 'Fómeque', '1', null);
INSERT INTO `mpios` VALUES ('357', '25', 'Fúquene', '1', null);
INSERT INTO `mpios` VALUES ('358', '25', 'Gachalá', '1', null);
INSERT INTO `mpios` VALUES ('359', '25', 'Gachancipá', '1', null);
INSERT INTO `mpios` VALUES ('36', '5', 'Andes', '1', null);
INSERT INTO `mpios` VALUES ('360', '15', 'Gachantivá', '1', null);
INSERT INTO `mpios` VALUES ('361', '25', 'Gachetá', '1', null);
INSERT INTO `mpios` VALUES ('362', '8', 'Galapa', '1', null);
INSERT INTO `mpios` VALUES ('363', '70', 'Galeras (Nueva Granada)', '1', null);
INSERT INTO `mpios` VALUES ('364', '68', 'Galán', '1', null);
INSERT INTO `mpios` VALUES ('365', '25', 'Gama', '1', null);
INSERT INTO `mpios` VALUES ('366', '20', 'Gamarra', '1', null);
INSERT INTO `mpios` VALUES ('367', '15', 'Garagoa', '1', null);
INSERT INTO `mpios` VALUES ('368', '41', 'Garzón', '1', null);
INSERT INTO `mpios` VALUES ('369', '41', 'Gigante', '1', null);
INSERT INTO `mpios` VALUES ('37', '5', 'Angelópolis', '1', null);
INSERT INTO `mpios` VALUES ('370', '76', 'Ginebra', '1', null);
INSERT INTO `mpios` VALUES ('371', '5', 'Giraldo', '1', null);
INSERT INTO `mpios` VALUES ('372', '25', 'Girardot', '1', null);
INSERT INTO `mpios` VALUES ('373', '5', 'Girardota', '1', null);
INSERT INTO `mpios` VALUES ('374', '68', 'Girón', '1', null);
INSERT INTO `mpios` VALUES ('375', '20', 'Gonzalez', '1', null);
INSERT INTO `mpios` VALUES ('376', '54', 'Gramalote', '1', null);
INSERT INTO `mpios` VALUES ('377', '5', 'Granada', '1', null);
INSERT INTO `mpios` VALUES ('378', '25', 'Granada', '1', null);
INSERT INTO `mpios` VALUES ('379', '50', 'Granada', '1', null);
INSERT INTO `mpios` VALUES ('38', '5', 'Angostura', '1', null);
INSERT INTO `mpios` VALUES ('380', '68', 'Guaca', '1', null);
INSERT INTO `mpios` VALUES ('381', '15', 'Guacamayas', '1', null);
INSERT INTO `mpios` VALUES ('382', '76', 'Guacarí', '1', null);
INSERT INTO `mpios` VALUES ('383', '52', 'Guachavés', '1', null);
INSERT INTO `mpios` VALUES ('384', '19', 'Guachené', '1', null);
INSERT INTO `mpios` VALUES ('385', '25', 'Guachetá', '1', null);
INSERT INTO `mpios` VALUES ('386', '52', 'Guachucal', '1', null);
INSERT INTO `mpios` VALUES ('387', '5', 'Guadalupe', '1', null);
INSERT INTO `mpios` VALUES ('388', '41', 'Guadalupe', '1', null);
INSERT INTO `mpios` VALUES ('389', '68', 'Guadalupe', '1', null);
INSERT INTO `mpios` VALUES ('39', '25', 'Anolaima', '1', null);
INSERT INTO `mpios` VALUES ('390', '25', 'Guaduas', '1', null);
INSERT INTO `mpios` VALUES ('391', '52', 'Guaitarilla', '1', null);
INSERT INTO `mpios` VALUES ('392', '52', 'Gualmatán', '1', null);
INSERT INTO `mpios` VALUES ('393', '47', 'Guamal', '1', null);
INSERT INTO `mpios` VALUES ('394', '50', 'Guamal', '1', null);
INSERT INTO `mpios` VALUES ('395', '73', 'Guamo', '1', null);
INSERT INTO `mpios` VALUES ('396', '68', 'Guapota', '1', null);
INSERT INTO `mpios` VALUES ('397', '19', 'Guapí', '1', null);
INSERT INTO `mpios` VALUES ('398', '70', 'Guaranda', '1', null);
INSERT INTO `mpios` VALUES ('399', '5', 'Guarne', '1', null);
INSERT INTO `mpios` VALUES ('4', '41', 'Acevedo', '1', null);
INSERT INTO `mpios` VALUES ('40', '5', 'Anorí', '1', null);
INSERT INTO `mpios` VALUES ('400', '25', 'Guasca', '1', null);
INSERT INTO `mpios` VALUES ('401', '5', 'Guatapé', '1', null);
INSERT INTO `mpios` VALUES ('402', '25', 'Guataquí', '1', null);
INSERT INTO `mpios` VALUES ('403', '25', 'Guatavita', '1', null);
INSERT INTO `mpios` VALUES ('404', '15', 'Guateque', '1', null);
INSERT INTO `mpios` VALUES ('405', '68', 'Guavatá', '1', null);
INSERT INTO `mpios` VALUES ('406', '25', 'Guayabal de Siquima', '1', null);
INSERT INTO `mpios` VALUES ('407', '25', 'Guayabetal', '1', null);
INSERT INTO `mpios` VALUES ('408', '15', 'Guayatá', '1', null);
INSERT INTO `mpios` VALUES ('409', '68', 'Guepsa', '1', null);
INSERT INTO `mpios` VALUES ('41', '17', 'Anserma', '1', null);
INSERT INTO `mpios` VALUES ('410', '15', 'Guicán', '1', null);
INSERT INTO `mpios` VALUES ('411', '25', 'Gutiérrez', '1', null);
INSERT INTO `mpios` VALUES ('412', '66', 'Guática', '1', null);
INSERT INTO `mpios` VALUES ('413', '68', 'Gámbita', '1', null);
INSERT INTO `mpios` VALUES ('414', '15', 'Gámeza', '1', null);
INSERT INTO `mpios` VALUES ('415', '63', 'Génova', '1', null);
INSERT INTO `mpios` VALUES ('416', '5', 'Gómez Plata', '1', null);
INSERT INTO `mpios` VALUES ('417', '54', 'Hacarí', '1', null);
INSERT INTO `mpios` VALUES ('418', '13', 'Hatillo de Loba', '1', null);
INSERT INTO `mpios` VALUES ('419', '68', 'Hato', '1', null);
INSERT INTO `mpios` VALUES ('42', '76', 'Ansermanuevo', '1', null);
INSERT INTO `mpios` VALUES ('420', '85', 'Hato Corozal', '1', null);
INSERT INTO `mpios` VALUES ('421', '44', 'Hatonuevo', '1', null);
INSERT INTO `mpios` VALUES ('422', '5', 'Heliconia', '1', null);
INSERT INTO `mpios` VALUES ('423', '54', 'Herrán', '1', null);
INSERT INTO `mpios` VALUES ('424', '73', 'Herveo', '1', null);
INSERT INTO `mpios` VALUES ('425', '5', 'Hispania', '1', null);
INSERT INTO `mpios` VALUES ('426', '41', 'Hobo', '1', null);
INSERT INTO `mpios` VALUES ('427', '73', 'Honda', '1', null);
INSERT INTO `mpios` VALUES ('428', '73', 'Ibagué', '1', null);
INSERT INTO `mpios` VALUES ('429', '73', 'Icononzo', '1', null);
INSERT INTO `mpios` VALUES ('43', '73', 'Anzoátegui', '1', null);
INSERT INTO `mpios` VALUES ('430', '52', 'Iles', '1', null);
INSERT INTO `mpios` VALUES ('431', '52', 'Imúes', '1', null);
INSERT INTO `mpios` VALUES ('432', '19', 'Inzá', '1', null);
INSERT INTO `mpios` VALUES ('433', '94', 'Inírida', '1', null);
INSERT INTO `mpios` VALUES ('434', '52', 'Ipiales', '1', null);
INSERT INTO `mpios` VALUES ('435', '41', 'Isnos', '1', null);
INSERT INTO `mpios` VALUES ('436', '27', 'Istmina', '1', null);
INSERT INTO `mpios` VALUES ('437', '5', 'Itagüí', '1', null);
INSERT INTO `mpios` VALUES ('438', '5', 'Ituango', '1', null);
INSERT INTO `mpios` VALUES ('439', '15', 'Izá', '1', null);
INSERT INTO `mpios` VALUES ('44', '5', 'Anzá', '1', null);
INSERT INTO `mpios` VALUES ('440', '19', 'Jambaló', '1', null);
INSERT INTO `mpios` VALUES ('441', '76', 'Jamundí', '1', null);
INSERT INTO `mpios` VALUES ('442', '5', 'Jardín', '1', null);
INSERT INTO `mpios` VALUES ('443', '15', 'Jenesano', '1', null);
INSERT INTO `mpios` VALUES ('444', '5', 'Jericó', '1', null);
INSERT INTO `mpios` VALUES ('445', '15', 'Jericó', '1', null);
INSERT INTO `mpios` VALUES ('446', '25', 'Jerusalén', '1', null);
INSERT INTO `mpios` VALUES ('447', '68', 'Jesús María', '1', null);
INSERT INTO `mpios` VALUES ('448', '68', 'Jordán', '1', null);
INSERT INTO `mpios` VALUES ('449', '8', 'Juan de Acosta', '1', null);
INSERT INTO `mpios` VALUES ('45', '5', 'Apartadó', '1', null);
INSERT INTO `mpios` VALUES ('450', '25', 'Junín', '1', null);
INSERT INTO `mpios` VALUES ('451', '27', 'Juradó', '1', null);
INSERT INTO `mpios` VALUES ('452', '23', 'La Apartada y La Frontera', '1', null);
INSERT INTO `mpios` VALUES ('453', '41', 'La Argentina', '1', null);
INSERT INTO `mpios` VALUES ('454', '68', 'La Belleza', '1', null);
INSERT INTO `mpios` VALUES ('455', '25', 'La Calera', '1', null);
INSERT INTO `mpios` VALUES ('456', '15', 'La Capilla', '1', null);
INSERT INTO `mpios` VALUES ('457', '5', 'La Ceja', '1', null);
INSERT INTO `mpios` VALUES ('458', '66', 'La Celia', '1', null);
INSERT INTO `mpios` VALUES ('459', '52', 'La Cruz', '1', null);
INSERT INTO `mpios` VALUES ('46', '25', 'Apulo', '1', null);
INSERT INTO `mpios` VALUES ('460', '76', 'La Cumbre', '1', null);
INSERT INTO `mpios` VALUES ('461', '17', 'La Dorada', '1', null);
INSERT INTO `mpios` VALUES ('462', '54', 'La Esperanza', '1', null);
INSERT INTO `mpios` VALUES ('463', '5', 'La Estrella', '1', null);
INSERT INTO `mpios` VALUES ('464', '52', 'La Florida', '1', null);
INSERT INTO `mpios` VALUES ('465', '20', 'La Gloria', '1', null);
INSERT INTO `mpios` VALUES ('466', '20', 'La Jagua de Ibirico', '1', null);
INSERT INTO `mpios` VALUES ('467', '44', 'La Jagua del Pilar', '1', null);
INSERT INTO `mpios` VALUES ('468', '52', 'La Llanada', '1', null);
INSERT INTO `mpios` VALUES ('469', '50', 'La Macarena', '1', null);
INSERT INTO `mpios` VALUES ('47', '66', 'Apía', '1', null);
INSERT INTO `mpios` VALUES ('470', '17', 'La Merced', '1', null);
INSERT INTO `mpios` VALUES ('471', '25', 'La Mesa', '1', null);
INSERT INTO `mpios` VALUES ('472', '18', 'La Montañita', '1', null);
INSERT INTO `mpios` VALUES ('473', '25', 'La Palma', '1', null);
INSERT INTO `mpios` VALUES ('474', '68', 'La Paz', '1', null);
INSERT INTO `mpios` VALUES ('475', '20', 'La Paz (Robles)', '1', null);
INSERT INTO `mpios` VALUES ('476', '25', 'La Peña', '1', null);
INSERT INTO `mpios` VALUES ('477', '5', 'La Pintada', '1', null);
INSERT INTO `mpios` VALUES ('478', '41', 'La Plata', '1', null);
INSERT INTO `mpios` VALUES ('479', '54', 'La Playa', '1', null);
INSERT INTO `mpios` VALUES ('48', '15', 'Aquitania', '1', null);
INSERT INTO `mpios` VALUES ('480', '99', 'La Primavera', '1', null);
INSERT INTO `mpios` VALUES ('481', '85', 'La Salina', '1', null);
INSERT INTO `mpios` VALUES ('482', '19', 'La Sierra', '1', null);
INSERT INTO `mpios` VALUES ('483', '63', 'La Tebaida', '1', null);
INSERT INTO `mpios` VALUES ('484', '52', 'La Tola', '1', null);
INSERT INTO `mpios` VALUES ('485', '5', 'La Unión', '1', null);
INSERT INTO `mpios` VALUES ('486', '52', 'La Unión', '1', null);
INSERT INTO `mpios` VALUES ('487', '70', 'La Unión', '1', null);
INSERT INTO `mpios` VALUES ('488', '76', 'La Unión', '1', null);
INSERT INTO `mpios` VALUES ('489', '15', 'La Uvita', '1', null);
INSERT INTO `mpios` VALUES ('49', '47', 'Aracataca', '1', null);
INSERT INTO `mpios` VALUES ('490', '19', 'La Vega', '1', null);
INSERT INTO `mpios` VALUES ('491', '25', 'La Vega', '1', null);
INSERT INTO `mpios` VALUES ('492', '15', 'La Victoria', '1', null);
INSERT INTO `mpios` VALUES ('493', '17', 'La Victoria', '1', null);
INSERT INTO `mpios` VALUES ('494', '76', 'La Victoria', '1', null);
INSERT INTO `mpios` VALUES ('495', '66', 'La Virginia', '1', null);
INSERT INTO `mpios` VALUES ('496', '54', 'Labateca', '1', null);
INSERT INTO `mpios` VALUES ('497', '15', 'Labranzagrande', '1', null);
INSERT INTO `mpios` VALUES ('498', '68', 'Landázuri', '1', null);
INSERT INTO `mpios` VALUES ('499', '68', 'Lebrija', '1', null);
INSERT INTO `mpios` VALUES ('5', '13', 'Achí', '1', null);
INSERT INTO `mpios` VALUES ('50', '17', 'Aranzazu', '1', null);
INSERT INTO `mpios` VALUES ('500', '52', 'Leiva', '1', null);
INSERT INTO `mpios` VALUES ('501', '50', 'Lejanías', '1', null);
INSERT INTO `mpios` VALUES ('502', '25', 'Lenguazaque', '1', null);
INSERT INTO `mpios` VALUES ('503', '91', 'Leticia', '1', null);
INSERT INTO `mpios` VALUES ('504', '5', 'Liborina', '1', null);
INSERT INTO `mpios` VALUES ('505', '52', 'Linares', '1', null);
INSERT INTO `mpios` VALUES ('506', '27', 'Lloró', '1', null);
INSERT INTO `mpios` VALUES ('507', '23', 'Lorica', '1', null);
INSERT INTO `mpios` VALUES ('508', '23', 'Los Córdobas', '1', null);
INSERT INTO `mpios` VALUES ('509', '70', 'Los Palmitos', '1', null);
INSERT INTO `mpios` VALUES ('51', '68', 'Aratoca', '1', null);
INSERT INTO `mpios` VALUES ('510', '54', 'Los Patios', '1', null);
INSERT INTO `mpios` VALUES ('511', '68', 'Los Santos', '1', null);
INSERT INTO `mpios` VALUES ('512', '54', 'Lourdes', '1', null);
INSERT INTO `mpios` VALUES ('513', '8', 'Luruaco', '1', null);
INSERT INTO `mpios` VALUES ('514', '73', 'Lérida', '1', null);
INSERT INTO `mpios` VALUES ('515', '73', 'Líbano', '1', null);
INSERT INTO `mpios` VALUES ('516', '19', 'López (Micay)', '1', null);
INSERT INTO `mpios` VALUES ('517', '15', 'Macanal', '1', null);
INSERT INTO `mpios` VALUES ('518', '68', 'Macaravita', '1', null);
INSERT INTO `mpios` VALUES ('519', '5', 'Maceo', '1', null);
INSERT INTO `mpios` VALUES ('52', '81', 'Arauca', '1', null);
INSERT INTO `mpios` VALUES ('520', '25', 'Machetá', '1', null);
INSERT INTO `mpios` VALUES ('521', '25', 'Madrid', '1', null);
INSERT INTO `mpios` VALUES ('522', '13', 'Magangué', '1', null);
INSERT INTO `mpios` VALUES ('523', '52', 'Magüi (Payán)', '1', null);
INSERT INTO `mpios` VALUES ('524', '13', 'Mahates', '1', null);
INSERT INTO `mpios` VALUES ('525', '44', 'Maicao', '1', null);
INSERT INTO `mpios` VALUES ('526', '70', 'Majagual', '1', null);
INSERT INTO `mpios` VALUES ('527', '8', 'Malambo', '1', null);
INSERT INTO `mpios` VALUES ('528', '52', 'Mallama (Piedrancha)', '1', null);
INSERT INTO `mpios` VALUES ('529', '8', 'Manatí', '1', null);
INSERT INTO `mpios` VALUES ('53', '81', 'Arauquita', '1', null);
INSERT INTO `mpios` VALUES ('530', '44', 'Manaure', '1', null);
INSERT INTO `mpios` VALUES ('531', '20', 'Manaure Balcón del Cesar', '1', null);
INSERT INTO `mpios` VALUES ('532', '17', 'Manizales', '1', null);
INSERT INTO `mpios` VALUES ('533', '25', 'Manta', '1', null);
INSERT INTO `mpios` VALUES ('534', '17', 'Manzanares', '1', null);
INSERT INTO `mpios` VALUES ('535', '85', 'Maní', '1', null);
INSERT INTO `mpios` VALUES ('536', '50', 'Mapiripan', '1', null);
INSERT INTO `mpios` VALUES ('537', '13', 'Margarita', '1', null);
INSERT INTO `mpios` VALUES ('538', '5', 'Marinilla', '1', null);
INSERT INTO `mpios` VALUES ('539', '15', 'Maripí', '1', null);
INSERT INTO `mpios` VALUES ('54', '25', 'Arbeláez', '1', null);
INSERT INTO `mpios` VALUES ('540', '73', 'Mariquita', '1', null);
INSERT INTO `mpios` VALUES ('541', '17', 'Marmato', '1', null);
INSERT INTO `mpios` VALUES ('542', '17', 'Marquetalia', '1', null);
INSERT INTO `mpios` VALUES ('543', '66', 'Marsella', '1', null);
INSERT INTO `mpios` VALUES ('544', '17', 'Marulanda', '1', null);
INSERT INTO `mpios` VALUES ('545', '13', 'María la Baja', '1', null);
INSERT INTO `mpios` VALUES ('546', '68', 'Matanza', '1', null);
INSERT INTO `mpios` VALUES ('547', '5', 'Medellín', '1', null);
INSERT INTO `mpios` VALUES ('548', '25', 'Medina', '1', null);
INSERT INTO `mpios` VALUES ('549', '27', 'Medio Atrato', '1', null);
INSERT INTO `mpios` VALUES ('55', '52', 'Arboleda (Berruecos)', '1', null);
INSERT INTO `mpios` VALUES ('550', '27', 'Medio Baudó', '1', null);
INSERT INTO `mpios` VALUES ('551', '27', 'Medio San Juan (ANDAGOYA)', '1', null);
INSERT INTO `mpios` VALUES ('552', '73', 'Melgar', '1', null);
INSERT INTO `mpios` VALUES ('553', '19', 'Mercaderes', '1', null);
INSERT INTO `mpios` VALUES ('554', '50', 'Mesetas', '1', null);
INSERT INTO `mpios` VALUES ('555', '18', 'Milán', '1', null);
INSERT INTO `mpios` VALUES ('556', '15', 'Miraflores', '1', null);
INSERT INTO `mpios` VALUES ('557', '95', 'Miraflores', '1', null);
INSERT INTO `mpios` VALUES ('558', '19', 'Miranda', '1', null);
INSERT INTO `mpios` VALUES ('559', '66', 'Mistrató', '1', null);
INSERT INTO `mpios` VALUES ('56', '54', 'Arboledas', '1', null);
INSERT INTO `mpios` VALUES ('560', '97', 'Mitú', '1', null);
INSERT INTO `mpios` VALUES ('561', '86', 'Mocoa', '1', null);
INSERT INTO `mpios` VALUES ('562', '68', 'Mogotes', '1', null);
INSERT INTO `mpios` VALUES ('563', '68', 'Molagavita', '1', null);
INSERT INTO `mpios` VALUES ('564', '23', 'Momil', '1', null);
INSERT INTO `mpios` VALUES ('565', '13', 'Mompós', '1', null);
INSERT INTO `mpios` VALUES ('566', '15', 'Mongua', '1', null);
INSERT INTO `mpios` VALUES ('567', '15', 'Monguí', '1', null);
INSERT INTO `mpios` VALUES ('568', '15', 'Moniquirá', '1', null);
INSERT INTO `mpios` VALUES ('569', '5', 'Montebello', '1', null);
INSERT INTO `mpios` VALUES ('57', '5', 'Arboletes', '1', null);
INSERT INTO `mpios` VALUES ('570', '13', 'Montecristo', '1', null);
INSERT INTO `mpios` VALUES ('571', '23', 'Montelíbano', '1', null);
INSERT INTO `mpios` VALUES ('572', '63', 'Montenegro', '1', null);
INSERT INTO `mpios` VALUES ('573', '23', 'Monteria', '1', null);
INSERT INTO `mpios` VALUES ('574', '85', 'Monterrey', '1', null);
INSERT INTO `mpios` VALUES ('575', '13', 'Morales', '1', null);
INSERT INTO `mpios` VALUES ('576', '19', 'Morales', '1', null);
INSERT INTO `mpios` VALUES ('577', '18', 'Morelia', '1', null);
INSERT INTO `mpios` VALUES ('578', '70', 'Morroa', '1', null);
INSERT INTO `mpios` VALUES ('579', '25', 'Mosquera', '1', null);
INSERT INTO `mpios` VALUES ('58', '15', 'Arcabuco', '1', null);
INSERT INTO `mpios` VALUES ('580', '52', 'Mosquera', '1', null);
INSERT INTO `mpios` VALUES ('581', '15', 'Motavita', '1', null);
INSERT INTO `mpios` VALUES ('582', '23', 'Moñitos', '1', null);
INSERT INTO `mpios` VALUES ('583', '73', 'Murillo', '1', null);
INSERT INTO `mpios` VALUES ('584', '5', 'Murindó', '1', null);
INSERT INTO `mpios` VALUES ('585', '5', 'Mutatá', '1', null);
INSERT INTO `mpios` VALUES ('586', '54', 'Mutiscua', '1', null);
INSERT INTO `mpios` VALUES ('587', '15', 'Muzo', '1', null);
INSERT INTO `mpios` VALUES ('588', '68', 'Málaga', '1', null);
INSERT INTO `mpios` VALUES ('589', '5', 'Nariño', '1', null);
INSERT INTO `mpios` VALUES ('59', '13', 'Arenal', '1', null);
INSERT INTO `mpios` VALUES ('590', '25', 'Nariño', '1', null);
INSERT INTO `mpios` VALUES ('591', '52', 'Nariño', '1', null);
INSERT INTO `mpios` VALUES ('592', '73', 'Natagaima', '1', null);
INSERT INTO `mpios` VALUES ('593', '5', 'Nechí', '1', null);
INSERT INTO `mpios` VALUES ('594', '5', 'Necoclí', '1', null);
INSERT INTO `mpios` VALUES ('595', '17', 'Neira', '1', null);
INSERT INTO `mpios` VALUES ('596', '41', 'Neiva', '1', null);
INSERT INTO `mpios` VALUES ('597', '25', 'Nemocón', '1', null);
INSERT INTO `mpios` VALUES ('598', '25', 'Nilo', '1', null);
INSERT INTO `mpios` VALUES ('599', '25', 'Nimaima', '1', null);
INSERT INTO `mpios` VALUES ('6', '41', 'Agrado', '1', null);
INSERT INTO `mpios` VALUES ('60', '5', 'Argelia', '1', null);
INSERT INTO `mpios` VALUES ('600', '15', 'Nobsa', '1', null);
INSERT INTO `mpios` VALUES ('601', '25', 'Nocaima', '1', null);
INSERT INTO `mpios` VALUES ('602', '17', 'Norcasia', '1', null);
INSERT INTO `mpios` VALUES ('603', '13', 'Norosí', '1', null);
INSERT INTO `mpios` VALUES ('604', '27', 'Novita', '1', null);
INSERT INTO `mpios` VALUES ('605', '47', 'Nueva Granada', '1', null);
INSERT INTO `mpios` VALUES ('606', '15', 'Nuevo Colón', '1', null);
INSERT INTO `mpios` VALUES ('607', '85', 'Nunchía', '1', null);
INSERT INTO `mpios` VALUES ('608', '27', 'Nuquí', '1', null);
INSERT INTO `mpios` VALUES ('609', '41', 'Nátaga', '1', null);
INSERT INTO `mpios` VALUES ('61', '19', 'Argelia', '1', null);
INSERT INTO `mpios` VALUES ('610', '76', 'Obando', '1', null);
INSERT INTO `mpios` VALUES ('611', '68', 'Ocamonte', '1', null);
INSERT INTO `mpios` VALUES ('612', '54', 'Ocaña', '1', null);
INSERT INTO `mpios` VALUES ('613', '68', 'Oiba', '1', null);
INSERT INTO `mpios` VALUES ('614', '15', 'Oicatá', '1', null);
INSERT INTO `mpios` VALUES ('615', '5', 'Olaya', '1', null);
INSERT INTO `mpios` VALUES ('616', '52', 'Olaya Herrera', '1', null);
INSERT INTO `mpios` VALUES ('617', '68', 'Onzaga', '1', null);
INSERT INTO `mpios` VALUES ('618', '41', 'Oporapa', '1', null);
INSERT INTO `mpios` VALUES ('619', '86', 'Orito', '1', null);
INSERT INTO `mpios` VALUES ('62', '76', 'Argelia', '1', null);
INSERT INTO `mpios` VALUES ('620', '85', 'Orocué', '1', null);
INSERT INTO `mpios` VALUES ('621', '73', 'Ortega', '1', null);
INSERT INTO `mpios` VALUES ('622', '52', 'Ospina', '1', null);
INSERT INTO `mpios` VALUES ('623', '15', 'Otanche', '1', null);
INSERT INTO `mpios` VALUES ('624', '70', 'Ovejas', '1', null);
INSERT INTO `mpios` VALUES ('625', '15', 'Pachavita', '1', null);
INSERT INTO `mpios` VALUES ('626', '25', 'Pacho', '1', null);
INSERT INTO `mpios` VALUES ('627', '19', 'Padilla', '1', null);
INSERT INTO `mpios` VALUES ('628', '41', 'Paicol', '1', null);
INSERT INTO `mpios` VALUES ('629', '20', 'Pailitas', '1', null);
INSERT INTO `mpios` VALUES ('63', '47', 'Ariguaní (El Difícil)', '1', null);
INSERT INTO `mpios` VALUES ('630', '25', 'Paime', '1', null);
INSERT INTO `mpios` VALUES ('631', '15', 'Paipa', '1', null);
INSERT INTO `mpios` VALUES ('632', '15', 'Pajarito', '1', null);
INSERT INTO `mpios` VALUES ('633', '41', 'Palermo', '1', null);
INSERT INTO `mpios` VALUES ('634', '17', 'Palestina', '1', null);
INSERT INTO `mpios` VALUES ('635', '41', 'Palestina', '1', null);
INSERT INTO `mpios` VALUES ('636', '68', 'Palmar', '1', null);
INSERT INTO `mpios` VALUES ('637', '8', 'Palmar de Varela', '1', null);
INSERT INTO `mpios` VALUES ('638', '68', 'Palmas del Socorro', '1', null);
INSERT INTO `mpios` VALUES ('639', '76', 'Palmira', '1', null);
INSERT INTO `mpios` VALUES ('64', '13', 'Arjona', '1', null);
INSERT INTO `mpios` VALUES ('640', '70', 'Palmito', '1', null);
INSERT INTO `mpios` VALUES ('641', '73', 'Palocabildo', '1', null);
INSERT INTO `mpios` VALUES ('642', '54', 'Pamplona', '1', null);
INSERT INTO `mpios` VALUES ('643', '54', 'Pamplonita', '1', null);
INSERT INTO `mpios` VALUES ('644', '25', 'Pandi', '1', null);
INSERT INTO `mpios` VALUES ('645', '15', 'Panqueba', '1', null);
INSERT INTO `mpios` VALUES ('646', '25', 'Paratebueno', '1', null);
INSERT INTO `mpios` VALUES ('647', '25', 'Pasca', '1', null);
INSERT INTO `mpios` VALUES ('648', '19', 'Patía (El Bordo)', '1', null);
INSERT INTO `mpios` VALUES ('649', '15', 'Pauna', '1', null);
INSERT INTO `mpios` VALUES ('65', '5', 'Armenia', '1', null);
INSERT INTO `mpios` VALUES ('650', '15', 'Paya', '1', null);
INSERT INTO `mpios` VALUES ('651', '85', 'Paz de Ariporo', '1', null);
INSERT INTO `mpios` VALUES ('652', '15', 'Paz de Río', '1', null);
INSERT INTO `mpios` VALUES ('653', '47', 'Pedraza', '1', null);
INSERT INTO `mpios` VALUES ('654', '20', 'Pelaya', '1', null);
INSERT INTO `mpios` VALUES ('655', '17', 'Pensilvania', '1', null);
INSERT INTO `mpios` VALUES ('656', '5', 'Peque', '1', null);
INSERT INTO `mpios` VALUES ('657', '66', 'Pereira', '1', null);
INSERT INTO `mpios` VALUES ('658', '15', 'Pesca', '1', null);
INSERT INTO `mpios` VALUES ('659', '5', 'Peñol', '1', null);
INSERT INTO `mpios` VALUES ('66', '63', 'Armenia', '1', null);
INSERT INTO `mpios` VALUES ('660', '19', 'Piamonte', '1', null);
INSERT INTO `mpios` VALUES ('661', '68', 'Pie de Cuesta', '1', null);
INSERT INTO `mpios` VALUES ('662', '73', 'Piedras', '1', null);
INSERT INTO `mpios` VALUES ('663', '19', 'Piendamó', '1', null);
INSERT INTO `mpios` VALUES ('664', '63', 'Pijao', '1', null);
INSERT INTO `mpios` VALUES ('665', '47', 'Pijiño', '1', null);
INSERT INTO `mpios` VALUES ('666', '68', 'Pinchote', '1', null);
INSERT INTO `mpios` VALUES ('667', '13', 'Pinillos', '1', null);
INSERT INTO `mpios` VALUES ('668', '8', 'Piojo', '1', null);
INSERT INTO `mpios` VALUES ('669', '15', 'Pisva', '1', null);
INSERT INTO `mpios` VALUES ('67', '73', 'Armero (Guayabal)', '1', null);
INSERT INTO `mpios` VALUES ('670', '41', 'Pital', '1', null);
INSERT INTO `mpios` VALUES ('671', '41', 'Pitalito', '1', null);
INSERT INTO `mpios` VALUES ('672', '47', 'Pivijay', '1', null);
INSERT INTO `mpios` VALUES ('673', '73', 'Planadas', '1', null);
INSERT INTO `mpios` VALUES ('674', '23', 'Planeta Rica', '1', null);
INSERT INTO `mpios` VALUES ('675', '47', 'Plato', '1', null);
INSERT INTO `mpios` VALUES ('676', '52', 'Policarpa', '1', null);
INSERT INTO `mpios` VALUES ('677', '8', 'Polonuevo', '1', null);
INSERT INTO `mpios` VALUES ('678', '8', 'Ponedera', '1', null);
INSERT INTO `mpios` VALUES ('679', '19', 'Popayán', '1', null);
INSERT INTO `mpios` VALUES ('68', '13', 'Arroyohondo', '1', null);
INSERT INTO `mpios` VALUES ('680', '85', 'Pore', '1', null);
INSERT INTO `mpios` VALUES ('681', '52', 'Potosí', '1', null);
INSERT INTO `mpios` VALUES ('682', '76', 'Pradera', '1', null);
INSERT INTO `mpios` VALUES ('683', '73', 'Prado', '1', null);
INSERT INTO `mpios` VALUES ('684', '52', 'Providencia', '1', null);
INSERT INTO `mpios` VALUES ('686', '20', 'Pueblo Bello', '1', null);
INSERT INTO `mpios` VALUES ('687', '23', 'Pueblo Nuevo', '1', null);
INSERT INTO `mpios` VALUES ('688', '66', 'Pueblo Rico', '1', null);
INSERT INTO `mpios` VALUES ('689', '5', 'Pueblorrico', '1', null);
INSERT INTO `mpios` VALUES ('69', '20', 'Astrea', '1', null);
INSERT INTO `mpios` VALUES ('690', '47', 'Puebloviejo', '1', null);
INSERT INTO `mpios` VALUES ('691', '68', 'Puente Nacional', '1', null);
INSERT INTO `mpios` VALUES ('692', '52', 'Puerres', '1', null);
INSERT INTO `mpios` VALUES ('693', '86', 'Puerto Asís', '1', null);
INSERT INTO `mpios` VALUES ('694', '5', 'Puerto Berrío', '1', null);
INSERT INTO `mpios` VALUES ('695', '15', 'Puerto Boyacá', '1', null);
INSERT INTO `mpios` VALUES ('696', '86', 'Puerto Caicedo', '1', null);
INSERT INTO `mpios` VALUES ('697', '99', 'Puerto Carreño', '1', null);
INSERT INTO `mpios` VALUES ('698', '8', 'Puerto Colombia', '1', null);
INSERT INTO `mpios` VALUES ('699', '50', 'Puerto Concordia', '1', null);
INSERT INTO `mpios` VALUES ('7', '25', 'Agua de Dios', '1', null);
INSERT INTO `mpios` VALUES ('70', '73', 'Ataco', '1', null);
INSERT INTO `mpios` VALUES ('700', '23', 'Puerto Escondido', '1', null);
INSERT INTO `mpios` VALUES ('701', '50', 'Puerto Gaitán', '1', null);
INSERT INTO `mpios` VALUES ('702', '86', 'Puerto Guzmán', '1', null);
INSERT INTO `mpios` VALUES ('703', '86', 'Puerto Leguízamo', '1', null);
INSERT INTO `mpios` VALUES ('704', '23', 'Puerto Libertador', '1', null);
INSERT INTO `mpios` VALUES ('705', '50', 'Puerto Lleras', '1', null);
INSERT INTO `mpios` VALUES ('706', '50', 'Puerto López', '1', null);
INSERT INTO `mpios` VALUES ('707', '5', 'Puerto Nare', '1', null);
INSERT INTO `mpios` VALUES ('708', '91', 'Puerto Nariño', '1', null);
INSERT INTO `mpios` VALUES ('709', '68', 'Puerto Parra', '1', null);
INSERT INTO `mpios` VALUES ('71', '27', 'Atrato (Yuto)', '1', null);
INSERT INTO `mpios` VALUES ('710', '18', 'Puerto Rico', '1', null);
INSERT INTO `mpios` VALUES ('711', '50', 'Puerto Rico', '1', null);
INSERT INTO `mpios` VALUES ('712', '81', 'Puerto Rondón', '1', null);
INSERT INTO `mpios` VALUES ('713', '25', 'Puerto Salgar', '1', null);
INSERT INTO `mpios` VALUES ('714', '54', 'Puerto Santander', '1', null);
INSERT INTO `mpios` VALUES ('715', '19', 'Puerto Tejada', '1', null);
INSERT INTO `mpios` VALUES ('716', '5', 'Puerto Triunfo', '1', null);
INSERT INTO `mpios` VALUES ('717', '68', 'Puerto Wilches', '1', null);
INSERT INTO `mpios` VALUES ('718', '25', 'Pulí', '1', null);
INSERT INTO `mpios` VALUES ('719', '52', 'Pupiales', '1', null);
INSERT INTO `mpios` VALUES ('72', '23', 'Ayapel', '1', null);
INSERT INTO `mpios` VALUES ('720', '19', 'Puracé (Coconuco)', '1', null);
INSERT INTO `mpios` VALUES ('721', '73', 'Purificación', '1', null);
INSERT INTO `mpios` VALUES ('722', '23', 'Purísima', '1', null);
INSERT INTO `mpios` VALUES ('723', '17', 'Pácora', '1', null);
INSERT INTO `mpios` VALUES ('724', '15', 'Páez', '1', null);
INSERT INTO `mpios` VALUES ('725', '19', 'Páez (Belalcazar)', '1', null);
INSERT INTO `mpios` VALUES ('726', '68', 'Páramo', '1', null);
INSERT INTO `mpios` VALUES ('727', '25', 'Quebradanegra', '1', null);
INSERT INTO `mpios` VALUES ('728', '25', 'Quetame', '1', null);
INSERT INTO `mpios` VALUES ('729', '27', 'Quibdó', '1', null);
INSERT INTO `mpios` VALUES ('73', '27', 'Bagadó', '1', null);
INSERT INTO `mpios` VALUES ('730', '63', 'Quimbaya', '1', null);
INSERT INTO `mpios` VALUES ('731', '66', 'Quinchía', '1', null);
INSERT INTO `mpios` VALUES ('732', '15', 'Quipama', '1', null);
INSERT INTO `mpios` VALUES ('733', '25', 'Quipile', '1', null);
INSERT INTO `mpios` VALUES ('734', '54', 'Ragonvalia', '1', null);
INSERT INTO `mpios` VALUES ('735', '15', 'Ramiriquí', '1', null);
INSERT INTO `mpios` VALUES ('736', '85', 'Recetor', '1', null);
INSERT INTO `mpios` VALUES ('737', '13', 'Regidor', '1', null);
INSERT INTO `mpios` VALUES ('738', '5', 'Remedios', '1', null);
INSERT INTO `mpios` VALUES ('739', '47', 'Remolino', '1', null);
INSERT INTO `mpios` VALUES ('74', '27', 'Bahía Solano (Mútis)', '1', null);
INSERT INTO `mpios` VALUES ('740', '8', 'Repelón', '1', null);
INSERT INTO `mpios` VALUES ('741', '50', 'Restrepo', '1', null);
INSERT INTO `mpios` VALUES ('742', '76', 'Restrepo', '1', null);
INSERT INTO `mpios` VALUES ('743', '5', 'Retiro', '1', null);
INSERT INTO `mpios` VALUES ('744', '25', 'Ricaurte', '1', null);
INSERT INTO `mpios` VALUES ('745', '52', 'Ricaurte', '1', null);
INSERT INTO `mpios` VALUES ('746', '68', 'Rio Negro', '1', null);
INSERT INTO `mpios` VALUES ('747', '73', 'Rioblanco', '1', null);
INSERT INTO `mpios` VALUES ('748', '76', 'Riofrío', '1', null);
INSERT INTO `mpios` VALUES ('749', '44', 'Riohacha', '1', null);
INSERT INTO `mpios` VALUES ('75', '27', 'Bajo Baudó (Pizarro)', '1', null);
INSERT INTO `mpios` VALUES ('750', '17', 'Risaralda', '1', null);
INSERT INTO `mpios` VALUES ('751', '41', 'Rivera', '1', null);
INSERT INTO `mpios` VALUES ('752', '52', 'Roberto Payán (San José)', '1', null);
INSERT INTO `mpios` VALUES ('753', '76', 'Roldanillo', '1', null);
INSERT INTO `mpios` VALUES ('754', '73', 'Roncesvalles', '1', null);
INSERT INTO `mpios` VALUES ('755', '15', 'Rondón', '1', null);
INSERT INTO `mpios` VALUES ('756', '19', 'Rosas', '1', null);
INSERT INTO `mpios` VALUES ('757', '73', 'Rovira', '1', null);
INSERT INTO `mpios` VALUES ('758', '15', 'Ráquira', '1', null);
INSERT INTO `mpios` VALUES ('759', '27', 'Río Iró', '1', null);
INSERT INTO `mpios` VALUES ('76', '19', 'Balboa', '1', null);
INSERT INTO `mpios` VALUES ('760', '27', 'Río Quito', '1', null);
INSERT INTO `mpios` VALUES ('761', '17', 'Río Sucio', '1', null);
INSERT INTO `mpios` VALUES ('762', '13', 'Río Viejo', '1', null);
INSERT INTO `mpios` VALUES ('763', '20', 'Río de oro', '1', null);
INSERT INTO `mpios` VALUES ('764', '5', 'Ríonegro', '1', null);
INSERT INTO `mpios` VALUES ('765', '27', 'Ríosucio', '1', null);
INSERT INTO `mpios` VALUES ('766', '68', 'Sabana de Torres', '1', null);
INSERT INTO `mpios` VALUES ('767', '8', 'Sabanagrande', '1', null);
INSERT INTO `mpios` VALUES ('768', '5', 'Sabanalarga', '1', null);
INSERT INTO `mpios` VALUES ('769', '8', 'Sabanalarga', '1', null);
INSERT INTO `mpios` VALUES ('77', '66', 'Balboa', '1', null);
INSERT INTO `mpios` VALUES ('770', '85', 'Sabanalarga', '1', null);
INSERT INTO `mpios` VALUES ('771', '47', 'Sabanas de San Angel (SAN ANGEL)', '1', null);
INSERT INTO `mpios` VALUES ('772', '5', 'Sabaneta', '1', null);
INSERT INTO `mpios` VALUES ('773', '15', 'Saboyá', '1', null);
INSERT INTO `mpios` VALUES ('774', '23', 'Sahagún', '1', null);
INSERT INTO `mpios` VALUES ('775', '41', 'Saladoblanco', '1', null);
INSERT INTO `mpios` VALUES ('776', '17', 'Salamina', '1', null);
INSERT INTO `mpios` VALUES ('777', '47', 'Salamina', '1', null);
INSERT INTO `mpios` VALUES ('778', '54', 'Salazar', '1', null);
INSERT INTO `mpios` VALUES ('779', '73', 'Saldaña', '1', null);
INSERT INTO `mpios` VALUES ('78', '8', 'Baranoa', '1', null);
INSERT INTO `mpios` VALUES ('780', '63', 'Salento', '1', null);
INSERT INTO `mpios` VALUES ('781', '5', 'Salgar', '1', null);
INSERT INTO `mpios` VALUES ('782', '15', 'Samacá', '1', null);
INSERT INTO `mpios` VALUES ('783', '52', 'Samaniego', '1', null);
INSERT INTO `mpios` VALUES ('784', '17', 'Samaná', '1', null);
INSERT INTO `mpios` VALUES ('785', '70', 'Sampués', '1', null);
INSERT INTO `mpios` VALUES ('786', '41', 'San Agustín', '1', null);
INSERT INTO `mpios` VALUES ('787', '20', 'San Alberto', '1', null);
INSERT INTO `mpios` VALUES ('788', '68', 'San Andrés', '1', null);
INSERT INTO `mpios` VALUES ('789', '23', 'San Andrés Sotavento', '1', null);
INSERT INTO `mpios` VALUES ('79', '41', 'Baraya', '1', null);
INSERT INTO `mpios` VALUES ('790', '5', 'San Andrés de Cuerquía', '1', null);
INSERT INTO `mpios` VALUES ('791', '23', 'San Antero', '1', null);
INSERT INTO `mpios` VALUES ('792', '73', 'San Antonio', '1', null);
INSERT INTO `mpios` VALUES ('793', '25', 'San Antonio de Tequendama', '1', null);
INSERT INTO `mpios` VALUES ('794', '68', 'San Benito', '1', null);
INSERT INTO `mpios` VALUES ('795', '70', 'San Benito Abad', '1', null);
INSERT INTO `mpios` VALUES ('796', '25', 'San Bernardo', '1', null);
INSERT INTO `mpios` VALUES ('797', '52', 'San Bernardo', '1', null);
INSERT INTO `mpios` VALUES ('798', '23', 'San Bernardo del Viento', '1', null);
INSERT INTO `mpios` VALUES ('799', '54', 'San Calixto', '1', null);
INSERT INTO `mpios` VALUES ('8', '20', 'Aguachica', '1', null);
INSERT INTO `mpios` VALUES ('80', '52', 'Barbacoas', '1', null);
INSERT INTO `mpios` VALUES ('800', '5', 'San Carlos', '1', null);
INSERT INTO `mpios` VALUES ('801', '23', 'San Carlos', '1', null);
INSERT INTO `mpios` VALUES ('802', '50', 'San Carlos de Guaroa', '1', null);
INSERT INTO `mpios` VALUES ('803', '25', 'San Cayetano', '1', null);
INSERT INTO `mpios` VALUES ('804', '54', 'San Cayetano', '1', null);
INSERT INTO `mpios` VALUES ('805', '13', 'San Cristobal', '1', null);
INSERT INTO `mpios` VALUES ('806', '20', 'San Diego', '1', null);
INSERT INTO `mpios` VALUES ('807', '15', 'San Eduardo', '1', null);
INSERT INTO `mpios` VALUES ('808', '13', 'San Estanislao', '1', null);
INSERT INTO `mpios` VALUES ('809', '13', 'San Fernando', '1', null);
INSERT INTO `mpios` VALUES ('81', '5', 'Barbosa', '1', null);
INSERT INTO `mpios` VALUES ('810', '5', 'San Francisco', '1', null);
INSERT INTO `mpios` VALUES ('811', '25', 'San Francisco', '1', null);
INSERT INTO `mpios` VALUES ('812', '86', 'San Francisco', '1', null);
INSERT INTO `mpios` VALUES ('813', '68', 'San Gil', '1', '2');
INSERT INTO `mpios` VALUES ('814', '13', 'San Jacinto', '1', null);
INSERT INTO `mpios` VALUES ('815', '13', 'San Jacinto del Cauca', '1', null);
INSERT INTO `mpios` VALUES ('816', '5', 'San Jerónimo', '1', null);
INSERT INTO `mpios` VALUES ('817', '68', 'San Joaquín', '1', null);
INSERT INTO `mpios` VALUES ('818', '17', 'San José', '1', null);
INSERT INTO `mpios` VALUES ('819', '68', 'San José de Miranda', '1', null);
INSERT INTO `mpios` VALUES ('82', '68', 'Barbosa', '1', null);
INSERT INTO `mpios` VALUES ('820', '5', 'San José de Montaña', '1', null);
INSERT INTO `mpios` VALUES ('821', '15', 'San José de Pare', '1', null);
INSERT INTO `mpios` VALUES ('822', '23', 'San José de Uré', '1', null);
INSERT INTO `mpios` VALUES ('823', '18', 'San José del Fragua', '1', null);
INSERT INTO `mpios` VALUES ('824', '95', 'San José del Guaviare', '1', null);
INSERT INTO `mpios` VALUES ('825', '27', 'San José del Palmar', '1', null);
INSERT INTO `mpios` VALUES ('826', '50', 'San Juan de Arama', '1', null);
INSERT INTO `mpios` VALUES ('827', '70', 'San Juan de Betulia', '1', null);
INSERT INTO `mpios` VALUES ('828', '13', 'San Juan de Nepomuceno', '1', null);
INSERT INTO `mpios` VALUES ('829', '52', 'San Juan de Pasto', '1', null);
INSERT INTO `mpios` VALUES ('83', '68', 'Barichara', '1', null);
INSERT INTO `mpios` VALUES ('830', '25', 'San Juan de Río Seco', '1', null);
INSERT INTO `mpios` VALUES ('831', '5', 'San Juan de Urabá', '1', null);
INSERT INTO `mpios` VALUES ('832', '44', 'San Juan del Cesar', '1', null);
INSERT INTO `mpios` VALUES ('833', '50', 'San Juanito', '1', null);
INSERT INTO `mpios` VALUES ('834', '52', 'San Lorenzo', '1', null);
INSERT INTO `mpios` VALUES ('835', '73', 'San Luis', '1', null);
INSERT INTO `mpios` VALUES ('836', '5', 'San Luís', '1', null);
INSERT INTO `mpios` VALUES ('837', '15', 'San Luís de Gaceno', '1', null);
INSERT INTO `mpios` VALUES ('838', '85', 'San Luís de Palenque', '1', null);
INSERT INTO `mpios` VALUES ('839', '70', 'San Marcos', '1', null);
INSERT INTO `mpios` VALUES ('84', '50', 'Barranca de Upía', '1', null);
INSERT INTO `mpios` VALUES ('840', '20', 'San Martín', '1', null);
INSERT INTO `mpios` VALUES ('841', '50', 'San Martín', '1', null);
INSERT INTO `mpios` VALUES ('842', '13', 'San Martín de Loba', '1', null);
INSERT INTO `mpios` VALUES ('843', '15', 'San Mateo', '1', null);
INSERT INTO `mpios` VALUES ('844', '68', 'San Miguel', '1', null);
INSERT INTO `mpios` VALUES ('845', '86', 'San Miguel', '1', null);
INSERT INTO `mpios` VALUES ('846', '15', 'San Miguel de Sema', '1', null);
INSERT INTO `mpios` VALUES ('847', '70', 'San Onofre', '1', null);
INSERT INTO `mpios` VALUES ('848', '13', 'San Pablo', '1', null);
INSERT INTO `mpios` VALUES ('849', '52', 'San Pablo', '1', null);
INSERT INTO `mpios` VALUES ('85', '68', 'Barrancabermeja', '1', null);
INSERT INTO `mpios` VALUES ('850', '15', 'San Pablo de Borbur', '1', null);
INSERT INTO `mpios` VALUES ('851', '5', 'San Pedro', '1', null);
INSERT INTO `mpios` VALUES ('852', '70', 'San Pedro', '1', null);
INSERT INTO `mpios` VALUES ('853', '76', 'San Pedro', '1', null);
INSERT INTO `mpios` VALUES ('854', '52', 'San Pedro de Cartago', '1', null);
INSERT INTO `mpios` VALUES ('855', '5', 'San Pedro de Urabá', '1', null);
INSERT INTO `mpios` VALUES ('856', '23', 'San Pelayo', '1', null);
INSERT INTO `mpios` VALUES ('857', '5', 'San Rafael', '1', null);
INSERT INTO `mpios` VALUES ('858', '5', 'San Roque', '1', null);
INSERT INTO `mpios` VALUES ('859', '19', 'San Sebastián', '1', null);
INSERT INTO `mpios` VALUES ('86', '44', 'Barrancas', '1', null);
INSERT INTO `mpios` VALUES ('860', '47', 'San Sebastián de Buenavista', '1', null);
INSERT INTO `mpios` VALUES ('861', '5', 'San Vicente', '1', null);
INSERT INTO `mpios` VALUES ('862', '18', 'San Vicente del Caguán', '1', null);
INSERT INTO `mpios` VALUES ('863', '68', 'San Vicente del Chucurí', '1', null);
INSERT INTO `mpios` VALUES ('864', '47', 'San Zenón', '1', null);
INSERT INTO `mpios` VALUES ('865', '52', 'Sandoná', '1', null);
INSERT INTO `mpios` VALUES ('866', '47', 'Santa Ana', '1', null);
INSERT INTO `mpios` VALUES ('867', '5', 'Santa Bárbara', '1', null);
INSERT INTO `mpios` VALUES ('868', '68', 'Santa Bárbara', '1', null);
INSERT INTO `mpios` VALUES ('869', '52', 'Santa Bárbara (Iscuandé)', '1', null);
INSERT INTO `mpios` VALUES ('87', '13', 'Barranco de Loba', '1', null);
INSERT INTO `mpios` VALUES ('870', '47', 'Santa Bárbara de Pinto', '1', null);
INSERT INTO `mpios` VALUES ('871', '13', 'Santa Catalina', '1', null);
INSERT INTO `mpios` VALUES ('872', '5', 'Santa Fé de Antioquia', '1', null);
INSERT INTO `mpios` VALUES ('873', '27', 'Santa Genoveva de Docorodó', '1', null);
INSERT INTO `mpios` VALUES ('874', '68', 'Santa Helena del Opón', '1', null);
INSERT INTO `mpios` VALUES ('875', '73', 'Santa Isabel', '1', null);
INSERT INTO `mpios` VALUES ('876', '8', 'Santa Lucía', '1', null);
INSERT INTO `mpios` VALUES ('877', '47', 'Santa Marta', '1', null);
INSERT INTO `mpios` VALUES ('878', '15', 'Santa María', '1', null);
INSERT INTO `mpios` VALUES ('879', '41', 'Santa María', '1', null);
INSERT INTO `mpios` VALUES ('88', '8', 'Barranquilla', '1', null);
INSERT INTO `mpios` VALUES ('880', '13', 'Santa Rosa', '1', null);
INSERT INTO `mpios` VALUES ('881', '19', 'Santa Rosa', '1', null);
INSERT INTO `mpios` VALUES ('882', '66', 'Santa Rosa de Cabal', '1', null);
INSERT INTO `mpios` VALUES ('883', '5', 'Santa Rosa de Osos', '1', null);
INSERT INTO `mpios` VALUES ('884', '15', 'Santa Rosa de Viterbo', '1', null);
INSERT INTO `mpios` VALUES ('885', '13', 'Santa Rosa del Sur', '1', null);
INSERT INTO `mpios` VALUES ('886', '99', 'Santa Rosalía', '1', null);
INSERT INTO `mpios` VALUES ('887', '15', 'Santa Sofía', '1', null);
INSERT INTO `mpios` VALUES ('888', '15', 'Santana', '1', null);
INSERT INTO `mpios` VALUES ('889', '19', 'Santander de Quilichao', '1', null);
INSERT INTO `mpios` VALUES ('89', '20', 'Becerríl', '1', null);
INSERT INTO `mpios` VALUES ('890', '54', 'Santiago', '1', null);
INSERT INTO `mpios` VALUES ('891', '86', 'Santiago', '1', null);
INSERT INTO `mpios` VALUES ('892', '5', 'Santo Domingo', '1', null);
INSERT INTO `mpios` VALUES ('893', '8', 'Santo Tomás', '1', null);
INSERT INTO `mpios` VALUES ('894', '5', 'Santuario', '1', null);
INSERT INTO `mpios` VALUES ('895', '66', 'Santuario', '1', null);
INSERT INTO `mpios` VALUES ('896', '52', 'Sapuyes', '1', null);
INSERT INTO `mpios` VALUES ('897', '81', 'Saravena', '1', null);
INSERT INTO `mpios` VALUES ('898', '54', 'Sardinata', '1', null);
INSERT INTO `mpios` VALUES ('899', '25', 'Sasaima', '1', null);
INSERT INTO `mpios` VALUES ('9', '68', 'Aguada', '1', null);
INSERT INTO `mpios` VALUES ('90', '17', 'Belalcázar', '1', null);
INSERT INTO `mpios` VALUES ('900', '15', 'Sativanorte', '1', null);
INSERT INTO `mpios` VALUES ('901', '15', 'Sativasur', '1', null);
INSERT INTO `mpios` VALUES ('902', '5', 'Segovia', '1', null);
INSERT INTO `mpios` VALUES ('903', '25', 'Sesquilé', '1', null);
INSERT INTO `mpios` VALUES ('904', '76', 'Sevilla', '1', null);
INSERT INTO `mpios` VALUES ('905', '15', 'Siachoque', '1', null);
INSERT INTO `mpios` VALUES ('906', '25', 'Sibaté', '1', null);
INSERT INTO `mpios` VALUES ('907', '86', 'Sibundoy', '1', null);
INSERT INTO `mpios` VALUES ('908', '54', 'Silos', '1', null);
INSERT INTO `mpios` VALUES ('909', '25', 'Silvania', '1', null);
INSERT INTO `mpios` VALUES ('91', '5', 'Bello', '1', null);
INSERT INTO `mpios` VALUES ('910', '19', 'Silvia', '1', null);
INSERT INTO `mpios` VALUES ('911', '68', 'Simacota', '1', null);
INSERT INTO `mpios` VALUES ('912', '25', 'Simijaca', '1', null);
INSERT INTO `mpios` VALUES ('913', '13', 'Simití', '1', null);
INSERT INTO `mpios` VALUES ('914', '70', 'Sincelejo', '1', null);
INSERT INTO `mpios` VALUES ('915', '70', 'Sincé', '1', null);
INSERT INTO `mpios` VALUES ('916', '27', 'Sipí', '1', null);
INSERT INTO `mpios` VALUES ('917', '47', 'Sitionuevo', '1', null);
INSERT INTO `mpios` VALUES ('918', '25', 'Soacha', '1', null);
INSERT INTO `mpios` VALUES ('919', '15', 'Soatá', '1', null);
INSERT INTO `mpios` VALUES ('92', '5', 'Belmira', '1', null);
INSERT INTO `mpios` VALUES ('920', '15', 'Socha', '1', null);
INSERT INTO `mpios` VALUES ('921', '68', 'Socorro', '1', '1');
INSERT INTO `mpios` VALUES ('922', '15', 'Socotá', '1', null);
INSERT INTO `mpios` VALUES ('923', '15', 'Sogamoso', '1', null);
INSERT INTO `mpios` VALUES ('924', '18', 'Solano', '1', null);
INSERT INTO `mpios` VALUES ('925', '8', 'Soledad', '1', null);
INSERT INTO `mpios` VALUES ('926', '18', 'Solita', '1', null);
INSERT INTO `mpios` VALUES ('927', '15', 'Somondoco', '1', null);
INSERT INTO `mpios` VALUES ('928', '5', 'Sonsón', '1', null);
INSERT INTO `mpios` VALUES ('929', '5', 'Sopetrán', '1', null);
INSERT INTO `mpios` VALUES ('93', '25', 'Beltrán', '1', null);
INSERT INTO `mpios` VALUES ('930', '13', 'Soplaviento', '1', null);
INSERT INTO `mpios` VALUES ('931', '25', 'Sopó', '1', null);
INSERT INTO `mpios` VALUES ('932', '15', 'Sora', '1', null);
INSERT INTO `mpios` VALUES ('933', '15', 'Soracá', '1', null);
INSERT INTO `mpios` VALUES ('934', '15', 'Sotaquirá', '1', null);
INSERT INTO `mpios` VALUES ('935', '19', 'Sotara (Paispamba)', '1', null);
INSERT INTO `mpios` VALUES ('936', '52', 'Sotomayor (Los Andes)', '1', null);
INSERT INTO `mpios` VALUES ('937', '68', 'Suaita', '1', null);
INSERT INTO `mpios` VALUES ('938', '8', 'Suan', '1', null);
INSERT INTO `mpios` VALUES ('939', '41', 'Suaza', '1', null);
INSERT INTO `mpios` VALUES ('94', '15', 'Belén', '1', null);
INSERT INTO `mpios` VALUES ('940', '25', 'Subachoque', '1', null);
INSERT INTO `mpios` VALUES ('941', '19', 'Sucre', '1', null);
INSERT INTO `mpios` VALUES ('942', '68', 'Sucre', '1', null);
INSERT INTO `mpios` VALUES ('943', '70', 'Sucre', '1', null);
INSERT INTO `mpios` VALUES ('944', '25', 'Suesca', '1', null);
INSERT INTO `mpios` VALUES ('945', '25', 'Supatá', '1', null);
INSERT INTO `mpios` VALUES ('946', '17', 'Supía', '1', null);
INSERT INTO `mpios` VALUES ('947', '68', 'Suratá', '1', null);
INSERT INTO `mpios` VALUES ('948', '25', 'Susa', '1', null);
INSERT INTO `mpios` VALUES ('949', '15', 'Susacón', '1', null);
INSERT INTO `mpios` VALUES ('95', '52', 'Belén', '1', null);
INSERT INTO `mpios` VALUES ('950', '15', 'Sutamarchán', '1', null);
INSERT INTO `mpios` VALUES ('951', '25', 'Sutatausa', '1', null);
INSERT INTO `mpios` VALUES ('952', '15', 'Sutatenza', '1', null);
INSERT INTO `mpios` VALUES ('953', '19', 'Suárez', '1', null);
INSERT INTO `mpios` VALUES ('954', '73', 'Suárez', '1', null);
INSERT INTO `mpios` VALUES ('955', '85', 'Sácama', '1', null);
INSERT INTO `mpios` VALUES ('956', '15', 'Sáchica', '1', null);
INSERT INTO `mpios` VALUES ('957', '25', 'Tabio', '1', null);
INSERT INTO `mpios` VALUES ('958', '27', 'Tadó', '1', null);
INSERT INTO `mpios` VALUES ('959', '13', 'Talaigua Nuevo', '1', null);
INSERT INTO `mpios` VALUES ('96', '27', 'Belén de Bajirá', '1', null);
INSERT INTO `mpios` VALUES ('960', '20', 'Tamalameque', '1', null);
INSERT INTO `mpios` VALUES ('961', '81', 'Tame', '1', null);
INSERT INTO `mpios` VALUES ('962', '52', 'Taminango', '1', null);
INSERT INTO `mpios` VALUES ('963', '52', 'Tangua', '1', null);
INSERT INTO `mpios` VALUES ('964', '97', 'Taraira', '1', null);
INSERT INTO `mpios` VALUES ('965', '5', 'Tarazá', '1', null);
INSERT INTO `mpios` VALUES ('966', '41', 'Tarqui', '1', null);
INSERT INTO `mpios` VALUES ('967', '5', 'Tarso', '1', null);
INSERT INTO `mpios` VALUES ('968', '15', 'Tasco', '1', null);
INSERT INTO `mpios` VALUES ('969', '85', 'Tauramena', '1', null);
INSERT INTO `mpios` VALUES ('97', '66', 'Belén de Umbría', '1', null);
INSERT INTO `mpios` VALUES ('970', '25', 'Tausa', '1', null);
INSERT INTO `mpios` VALUES ('971', '41', 'Tello', '1', null);
INSERT INTO `mpios` VALUES ('972', '25', 'Tena', '1', null);
INSERT INTO `mpios` VALUES ('973', '47', 'Tenerife', '1', null);
INSERT INTO `mpios` VALUES ('974', '25', 'Tenjo', '1', null);
INSERT INTO `mpios` VALUES ('975', '15', 'Tenza', '1', null);
INSERT INTO `mpios` VALUES ('976', '54', 'Teorama', '1', null);
INSERT INTO `mpios` VALUES ('977', '41', 'Teruel', '1', null);
INSERT INTO `mpios` VALUES ('978', '41', 'Tesalia', '1', null);
INSERT INTO `mpios` VALUES ('979', '25', 'Tibacuy', '1', null);
INSERT INTO `mpios` VALUES ('98', '18', 'Belén de los Andaquíes', '1', null);
INSERT INTO `mpios` VALUES ('980', '15', 'Tibaná', '1', null);
INSERT INTO `mpios` VALUES ('981', '15', 'Tibasosa', '1', null);
INSERT INTO `mpios` VALUES ('982', '25', 'Tibirita', '1', null);
INSERT INTO `mpios` VALUES ('983', '54', 'Tibú', '1', null);
INSERT INTO `mpios` VALUES ('984', '23', 'Tierralta', '1', null);
INSERT INTO `mpios` VALUES ('985', '41', 'Timaná', '1', null);
INSERT INTO `mpios` VALUES ('986', '19', 'Timbiquí', '1', null);
INSERT INTO `mpios` VALUES ('987', '19', 'Timbío', '1', null);
INSERT INTO `mpios` VALUES ('988', '15', 'Tinjacá', '1', null);
INSERT INTO `mpios` VALUES ('989', '15', 'Tipacoque', '1', null);
INSERT INTO `mpios` VALUES ('99', '15', 'Berbeo', '1', null);
INSERT INTO `mpios` VALUES ('990', '13', 'Tiquisio (Puerto Rico)', '1', null);
INSERT INTO `mpios` VALUES ('991', '5', 'Titiribí', '1', null);
INSERT INTO `mpios` VALUES ('992', '15', 'Toca', '1', null);
INSERT INTO `mpios` VALUES ('993', '25', 'Tocaima', '1', null);
INSERT INTO `mpios` VALUES ('994', '25', 'Tocancipá', '1', null);
INSERT INTO `mpios` VALUES ('995', '15', 'Toguí', '1', null);
INSERT INTO `mpios` VALUES ('996', '5', 'Toledo', '1', null);
INSERT INTO `mpios` VALUES ('997', '54', 'Toledo', '1', null);
INSERT INTO `mpios` VALUES ('998', '70', 'Tolú', '1', null);
INSERT INTO `mpios` VALUES ('999', '70', 'Tolú Viejo', '1', null);

-- ----------------------------
-- Table structure for `mto_es`
-- ----------------------------
DROP TABLE IF EXISTS `mto_es`;
CREATE TABLE `mto_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fec_realiza` date DEFAULT NULL,
  `fec_finaliza` date DEFAULT NULL,
  `tp_mto` char(1) DEFAULT '' COMMENT '0: Preventivo   1: Correctivo',
  `frec` int(3) DEFAULT NULL COMMENT 'Frecuencia con que se realiza',
  `id_estacion` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT '0' COMMENT '0: Programado 1: En Ejecución 2:Finalizado 3:Reprogramado ',
  PRIMARY KEY (`id`),
  KEY `id_estacion` (`id_estacion`),
  CONSTRAINT `mto_es_ibfk_1` FOREIGN KEY (`id_estacion`) REFERENCES `estaciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mto_es
-- ----------------------------
INSERT INTO `mto_es` VALUES ('66', '2019-11-10', '2019-11-10', '1', '0', '18', '0');
INSERT INTO `mto_es` VALUES ('67', '2019-11-10', '2019-11-10', '2', '0', '18', '0');
INSERT INTO `mto_es` VALUES ('68', '2019-11-10', '2019-11-10', '2', '0', '18', '0');
INSERT INTO `mto_es` VALUES ('69', '2019-11-21', '2019-11-22', '2', '0', '18', '0');
INSERT INTO `mto_es` VALUES ('70', '2019-11-21', '2019-11-22', '2', '0', '18', '0');
INSERT INTO `mto_es` VALUES ('71', '2019-11-21', '2019-11-22', '2', '0', '18', '0');

-- ----------------------------
-- Table structure for `novedades`
-- ----------------------------
DROP TABLE IF EXISTS `novedades`;
CREATE TABLE `novedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of novedades
-- ----------------------------
INSERT INTO `novedades` VALUES ('1', 'Cambio de Aceite ', 'Cambiar aceite');
INSERT INTO `novedades` VALUES ('2', 'Reparacion', 'Reparacion general');

-- ----------------------------
-- Table structure for `nov_veh`
-- ----------------------------
DROP TABLE IF EXISTS `nov_veh`;
CREATE TABLE `nov_veh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_placa` varchar(8) DEFAULT '',
  `id_novedad` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `id_responsable` varchar(15) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id_placa` (`id_placa`),
  KEY `id_novedad` (`id_novedad`),
  KEY `id_responsable` (`id_responsable`),
  CONSTRAINT `nov_veh_ibfk_1` FOREIGN KEY (`id_placa`) REFERENCES `fichaveh` (`id`),
  CONSTRAINT `nov_veh_ibfk_2` FOREIGN KEY (`id_novedad`) REFERENCES `novedades` (`id`),
  CONSTRAINT `nov_veh_ibfk_3` FOREIGN KEY (`id_responsable`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nov_veh
-- ----------------------------

-- ----------------------------
-- Table structure for `objpqrs`
-- ----------------------------
DROP TABLE IF EXISTS `objpqrs`;
CREATE TABLE `objpqrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`),
  CONSTRAINT `objpqrs_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of objpqrs
-- ----------------------------
INSERT INTO `objpqrs` VALUES ('14', '3', '115- CAUSAS JDLSJLKDJKLASJLDJALKJKL', 'JDKLSAJLDJLASJDLKJASDJLKSAJDLKASDASDASDASDAS');
INSERT INTO `objpqrs` VALUES ('15', '8', 'REVISION FUGA INTERNA', 'POSIBLE FUGA INTERNA.');
INSERT INTO `objpqrs` VALUES ('16', '1', 'SOLICITUD DE CONEXIÓN GASODOMESTICO', 'SOLICITUD DE CONEXIÓN GASODOMESTICO');
INSERT INTO `objpqrs` VALUES ('17', '1', 'SOLICITUD DE PUNTO ADICIONAL', 'SOLICITUD DE PUNTO ADICIONAL');
INSERT INTO `objpqrs` VALUES ('18', '3', 'ALTO CONSUMO', null);
INSERT INTO `objpqrs` VALUES ('19', '3', 'ERROR DE LECTURA', null);
INSERT INTO `objpqrs` VALUES ('20', '8', 'FUGA EN INSTALACION INTERNA', null);
INSERT INTO `objpqrs` VALUES ('22', '9', 'DISPONIBILIDAD DE SERVICIO', null);
INSERT INTO `objpqrs` VALUES ('23', '9', 'ACOMETIDAS', null);

-- ----------------------------
-- Table structure for `oficinas`
-- ----------------------------
DROP TABLE IF EXISTS `oficinas`;
CREATE TABLE `oficinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `id_mpio` varchar(6) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `id_horario` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mpio` (`id_mpio`),
  KEY `id_horario` (`id_horario`),
  CONSTRAINT `oficinas_ibfk_1` FOREIGN KEY (`id_mpio`) REFERENCES `mpios` (`id`),
  CONSTRAINT `oficinas_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oficinas
-- ----------------------------
INSERT INTO `oficinas` VALUES ('1', 'Garagoa', '1001', null, null, null, null);

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `personas`
-- ----------------------------
DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id` varchar(15) NOT NULL,
  `nombres` varchar(50) DEFAULT '',
  `Apellidos` varchar(50) DEFAULT NULL,
  `tp_doc` varchar(20) DEFAULT NULL,
  `num_doc` varchar(15) DEFAULT NULL,
  `genero` char(1) DEFAULT '',
  `id_cargo` int(11) DEFAULT NULL,
  `fec_nac` date DEFAULT NULL,
  `id_mpio` varchar(6) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `observacion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT '',
  `is_empleado` char(1) DEFAULT '0',
  `nombreFull` varchar(200) DEFAULT NULL,
  `fec_registro` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_mpio` (`id_mpio`),
  KEY `id_cargo` (`id_cargo`),
  CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`id_mpio`) REFERENCES `mpios` (`id`),
  CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of personas
-- ----------------------------
INSERT INTO `personas` VALUES ('1', 'OSCAR FERNANDO', 'SIERRA ESPARZA', 'CC', '91541579', 'M', '1', '2019-10-15', '921', 'cra 11 5555', 'NEWW', '3115667899', 'oscar.sierra@misena.edu.co', '1', 'OSCAR FERNANDO SIERRA ESPARZA', '2019-11-11 11:27:13');
INSERT INTO `personas` VALUES ('1002290919', 'JULIETH STEFANY ', 'CUBIDES SALGADO', 'CC', '1002290919', 'F', '8', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3222201007', 'aprendizsena@enercer.com ', '1', 'JULIETH STEFANY  CUBIDES SALGADO', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('10098765', 'NICOLAS DEMO', null, 'CEDULA', '10098765', '', null, null, null, null, null, null, null, '0', null, '2019-11-30 17:19:39');
INSERT INTO `personas` VALUES ('1022339534', 'NICOLAS GABRIEL', 'MARTIN RAMIREZ', 'CC', '1022339534', 'M', '25', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3104805495', 'nmartin@enercer.com', '1', 'NICOLAS GABRIEL MARTIN RAMIREZ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1032415822', 'JESUS ALBEIRO ', 'MENDIETA AGUIRRE ', 'CC', '1032415822', 'M', '26', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3143709253', 'jmendieta@enercer.com', '1', 'JESUS ALBEIRO  MENDIETA AGUIRRE ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1048847710', 'ANGELA PATRICIA', 'CASTRO VARGAS', 'CC', '1048847710', 'F', '6', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3132900027', 'acastro@enercer.com', '1', 'ANGELA PATRICIA CASTRO VARGAS', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('1048848185', 'CARLOS JULIAN', 'MORENO MARTÍNEZ', 'CC', '1048848185', 'M', '30', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3104844123', 'carlosjulianmm@gmail.com', '1', 'CARLOS JULIAN MORENO MARTÍNEZ', '2019-10-23 18:13:56');
INSERT INTO `personas` VALUES ('1048849167', 'ELIECER JOAQUIN ', 'MARTIN RAMIREZ', 'CC', '1048849167', 'M', '25', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3107502401', 'emartin@enercer.com', '1', 'ELIECER JOAQUIN  MARTIN RAMIREZ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1048850048', 'KARLA YICEL ', 'BUITRAGO ROMERO', 'CC', '1048850048', 'F', '14', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3114424759', 'kbuitrago@enercer.com', '1', 'KARLA YICEL  BUITRAGO ROMERO', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1048851001', 'DAIVER SEBASTIAN', 'MACIAS GAMBA', 'CC', '1048851001', 'M', '26', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3138480275', 'daivermacias@gmail.com', '1', 'DAIVER SEBASTIAN MACIAS GAMBA', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('1048851441', 'ELDA YANITZA ', 'BARAHONA DUEÑAS', 'CC', '1048851441', 'F', '16', '0000-00-00', '194', 'Por Definir', 'Por Definir', '3143328810', 'comercialchinavita@enercer.com ', '1', 'ELDA YANITZA  BARAHONA DUEÑAS', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1049606252', 'DIANA CAROLINA', 'DALLOS MORANTES', 'CC', '1049606252', 'F', '22', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3143351867', 'ddallos@enercer.com ', '1', 'DIANA CAROLINA DALLOS MORANTES', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1053724309', 'MARIA ALEJANDRA', 'FONSECA GONZALEZ', 'CC', '1053724309', 'F', '14', '0000-00-00', '404', 'Por Definir', 'Por Definir', '3213499349', 'maleja_fonseca1988@outlook.es', '1', 'MARIA ALEJANDRA FONSECA GONZALEZ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1057411253', 'YULIANA', 'RUIZ CRUZ', 'CC', '1057411253', 'F', '29', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3183519188', 'saladecontrol@enercer.com ', '1', 'YULIANA RUIZ CRUZ', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('1057411553', 'ANDRES HERNANDO', 'AGUIRRE CASTAÑEDA ', 'CC', '1057411553', 'M', '26', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3104800144', 'aaguirre@enercer.com', '1', 'ANDRES HERNANDO AGUIRRE CASTAÑEDA ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1057411570 ', 'LUIS FABIAN', 'MARTÍNEZ MORALES  ', 'CC', '1057411570 ', 'M', '26', '0000-00-00', '367', 'Por Definir', 'Por Definir', '313 372 0959', 'lucho-692011@hotmail.com', '1', 'LUIS FABIAN MARTÍNEZ MORALES  ', '2019-10-23 14:48:03');
INSERT INTO `personas` VALUES ('1057411820', 'LUIS EDUARDO', 'RINCON CASTELBLANCO', 'CC', '1057411820', 'M', '26', '0000-00-00', '194', 'Por Definir', 'Por Definir', '3105794995', 'luisfama27@gmail.com', '1', 'LUIS EDUARDO RINCON CASTELBLANCO', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('1057411961', 'CRISTIAN ALEXANDER', 'MORA CENDALES', 'CC', '1057411961', 'M', '29', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3183519188', 'saladecontrol@enercer.com ', '1', 'CRISTIAN ALEXANDER MORA CENDALES', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('1057412501', 'DANIELA ', 'AVILA GARCIA', 'CC', '1057412501', 'F', '7', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3183519393', 'davila@enercer.com', '1', 'DANIELA  AVILA GARCIA', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('1057436351', 'LUIS ARIEL', 'LOPEZ', 'CC', '1057436351', 'M', '26', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3183529876', 'alopez@enercer.com', '1', 'LUIS ARIEL LOPEZ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1057690550', 'OMAIRA YOHANA', 'VALLEJO ÁVILA', 'CC', '1057690550', 'F', '16', '0000-00-00', '404', 'Por Definir', 'Por Definir', '3213499349', 'comercialguateque@enercer.com ', '1', 'OMAIRA YOHANA VALLEJO ÁVILA', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1057919262', 'LEIDY YANIRA', 'ROJAS DIAZ', 'CC', '1057919262', 'F', '16', '0000-00-00', '837', 'Por Definir', 'Por Definir', '3143353139', 'comercialsanluis@enercer.com ', '1', 'LEIDY YANIRA ROJAS DIAZ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('1095919878', 'TATIANA', 'HERNANDEZ', 'CC', '9878', 'F', '42', '1989-05-05', '556', 'Diagonal 13 # 60 -82 Oasis de Mardel', null, '3033368957', null, '0', 'TATIANA HERNANDEZ', '2019-11-29 17:22:30');
INSERT INTO `personas` VALUES ('1100951546', 'JULIAN ERNESTO', 'ROJAS GARAVITO', 'CC', '1100951546', 'M', '5', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3102611231', 'jrojas@enercer.com', '1', 'JULIAN ERNESTO ROJAS GARAVITO', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('2', 'USUARIO NO APLICA', 'TEMPORAL', 'CC', 'NA', 'M', null, null, null, 'SIN DIRECCIÓN', 'USUARIO TEMPORAL', null, null, '0', 'USUARIO NO APLICA TEMPORAL', '2019-11-30 09:44:53');
INSERT INTO `personas` VALUES ('23754539', 'MARIA YALILE', 'SOLER ESPINOSA', 'CC', '23754539', 'F', '9', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3144365124', 'ysoler.publiservicios@gmail.com ', '1', 'MARIA YALILE SOLER ESPINOSA', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('23755097', 'YOLIVED', 'MARTINEZ MORENO', 'CC', '23755097', 'F', '14', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3123507817', 'ymartinez@enercer.com', '1', 'YOLIVED MARTINEZ MORENO', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('23755647', 'DIANA PAOLA', 'RAMIREZ GONZALEZ', 'CC', '23755647', 'F', '29', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3183519188', 'saladecontrol@enercer.com ', '1', 'DIANA PAOLA RAMIREZ GONZALEZ', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('23937101', 'IRENE ', 'LEGUIZAMÓN SILVA ', 'CC', '23937101', 'F', '4', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3108517647', 'ileguizamon@enercer.com', '1', 'IRENE  LEGUIZAMÓN SILVA ', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('33676544', 'LIDIA', 'ALFONSO MENDOZA', 'CC', '33676544', 'F', '9', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3224598827', 'lalfonso.publiservicios@gmail.com ', '1', 'LIDIA ALFONSO MENDOZA', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('35477058', 'CLAUDIA ISABEL', 'GIL RODRIGUEZ', 'CC', '35477058', 'F', '6', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3202377309', 'cgil@enercer.com', '1', 'CLAUDIA ISABEL GIL RODRIGUEZ', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('4165617', 'CARLOS ARTURO ', 'AVILA VERA', 'CC', '4165617', 'M', '1', '0000-00-00', '107', 'Por Definir', 'Por Definir', '3144629289', 'cavila@enercer.com', '1', 'CARLOS ARTURO  AVILA VERA', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('65782574', 'INGRID DEL SOCORRO', 'MARQUEZ', 'CC', '65782574', 'F', '29', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3183519188', 'saladecontrol@enercer.com ', '1', 'INGRID DEL SOCORRO MARQUEZ', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('6774713', 'JOSE VICENTE ', 'BAUTISTA ALBA ', 'CC', '6774713', 'M', '26', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3107561194', 'vbautista@enercer.com', '1', 'JOSE VICENTE  BAUTISTA ALBA ', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('7176889', 'HECTOR JAIME', 'ALFONSO ROA', 'CC', '7176889', 'M', '20', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3107557451', 'jalfonso@enercer.com', '1', 'HECTOR JAIME ALFONSO ROA', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('74346782', 'OSCAR', 'RIVERA ALFONSO', 'CC', '74346782', 'M', '12', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3107504923', 'orivera@enercer.com', '1', 'OSCAR RIVERA ALFONSO', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('74346823', 'HECTOR JULIO', 'CALDERON VELASQUEZ', 'CC', '74346823', 'M', '26', '0000-00-00', '837', 'Por Definir', 'Por Definir', '3107558678', 'hcalderon@enercer.com', '1', 'HECTOR JULIO CALDERON VELASQUEZ', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('74347333', 'WALTER', 'MATEUS LOZANO', 'CC', '74347333', 'M', '26', '0000-00-00', '404', 'Por Definir', 'Por Definir', '3138354460', 'walter.publiservicios@gmail.com ', '1', 'WALTER MATEUS LOZANO', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('7708777', 'JORGE MARIO ', 'AVILA TRUJILLO', 'CC', '7708777', 'M', '3', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3152485166', 'mavila@enercer.com', '1', 'JORGE MARIO  AVILA TRUJILLO', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('79529130', 'PLINIO', 'VARGAS PABON', 'CC', '79529130', 'M', '28', '0000-00-00', '367', 'Por Definir', 'Por Definir', '3204411119', 'pliniovargas1970@gmail.com', '1', 'PLINIO VARGAS PABON', '2019-10-23 13:08:04');
INSERT INTO `personas` VALUES ('79584076', 'OSCAR MAURICIO ', 'PASCAGAZA PEREZ ', 'CC', '79584076', 'M', '24', '0000-00-00', '404', 'Por Definir', 'Por Definir', '3108754293', 'mpascagaza@enercer.com', '1', 'OSCAR MAURICIO  PASCAGAZA PEREZ ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('79785163', 'CARLOS HUMBERTO', 'ALFONSO CRISTANCHO', 'CC', '79785163', 'M', '2', '0000-00-00', '107', 'Por Definir', 'Por Definir', '3124815741', 'calfonso@enercer.com', '1', 'CARLOS HUMBERTO ALFONSO CRISTANCHO', '2019-10-23 13:08:02');
INSERT INTO `personas` VALUES ('79881886', 'LENY ERSON', 'TRIVIÑO GONZÁLEZ', 'CC', '79881886', 'M', '13', '0000-00-00', '107', 'Por Definir', 'Por Definir', '3143303306', 'ltrivino@enercer.com', '1', 'LENY ERSON TRIVIÑO GONZÁLEZ', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('80881664', 'PEDRAZA TELLEZ', 'CRISTIAN CAMILO', 'CC', '80881664', 'M', '23', '0000-00-00', '107', 'Por Definir', 'Por Definir', '3173100067', 'cpedraza@enercer.com', '1', 'PEDRAZA TELLEZ CRISTIAN CAMILO', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('91488431', 'HARVEY', 'AGUDELO MORA', 'CC', '91488431', 'M', '21', '0000-00-00', '556', 'Por Definir', 'Por Definir', '3183516193', 'hagudelo@enercer.com ', '1', 'HARVEY AGUDELO MORA', '2019-10-23 13:08:03');
INSERT INTO `personas` VALUES ('91541578', 'OSCAR', 'SIERRA', 'CC', '91541', 'M', '1', null, '813', 'Diagonal 13 # 60 -82 Oasis de Mardel', 'DEDE', '332323', null, '0', 'OSCAR SIERRA', '2019-11-29 17:21:22');

-- ----------------------------
-- Table structure for `predios`
-- ----------------------------
DROP TABLE IF EXISTS `predios`;
CREATE TABLE `predios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NIU` varchar(7) DEFAULT NULL,
  `id_cliente` int(15) DEFAULT NULL,
  `id_mpio` varchar(6) DEFAULT '',
  `id_medidor` int(11) DEFAULT NULL,
  `id_ruta` int(11) DEFAULT NULL,
  `estrato` char(1) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT '',
  `ubicacion` char(1) DEFAULT '' COMMENT '1 urbana 2 rural 3 otra',
  `fec_suscripcion` date DEFAULT NULL,
  `estado` char(1) DEFAULT '1' COMMENT '1 : activo    0:  inactivo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NIU` (`NIU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of predios
-- ----------------------------

-- ----------------------------
-- Table structure for `proveedores`
-- ----------------------------
DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `id` varchar(20) NOT NULL,
  `tp_doc` char(4) DEFAULT NULL,
  `num_doc` varchar(15) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proveedores
-- ----------------------------
INSERT INTO `proveedores` VALUES ('1', 'NIT', null, 'Por Definir', null, null, null, null);
INSERT INTO `proveedores` VALUES ('1111111', 'NIT', null, 'demo', null, '3178263903', 'Diagonal 13 # 60 -82 Oasis de Mardel', null);
INSERT INTO `proveedores` VALUES ('2', 'NIT', null, 'Equisol', null, null, null, null);
INSERT INTO `proveedores` VALUES ('3', 'NIT', null, ' Instrumentos y Controles (Nimocom)', null, null, null, null);
INSERT INTO `proveedores` VALUES ('333323232', 'NIT', '333323232', 'ENERCER', null, '3178263903', 'Diagonal 13 # 60 -82 Oasis de Mardel', '3232');
INSERT INTO `proveedores` VALUES ('4', 'NIT', '4', 'Gas and Servive SAS', null, null, null, null);
INSERT INTO `proveedores` VALUES ('4444', 'NIT', '4444', 'panamericas', null, '2222', 'craaaa', null);
INSERT INTO `proveedores` VALUES ('91541579', 'CC', '91541579', 'Oscar Web', 'Oscar Sierra', '3182278807', 'bella Isla', 'oscar.sierra@misena.edu.co');

-- ----------------------------
-- Table structure for `redes`
-- ----------------------------
DROP TABLE IF EXISTS `redes`;
CREATE TABLE `redes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of redes
-- ----------------------------
INSERT INTO `redes` VALUES ('1', 'REDES TRONCALES');
INSERT INTO `redes` VALUES ('2', 'REDES URBANAS');

-- ----------------------------
-- Table structure for `ref_equipos`
-- ----------------------------
DROP TABLE IF EXISTS `ref_equipos`;
CREATE TABLE `ref_equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tpequipo` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tpequipo` (`id_tpequipo`),
  CONSTRAINT `ref_equipos_ibfk_1` FOREIGN KEY (`id_tpequipo`) REFERENCES `tp_equipos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_equipos
-- ----------------------------
INSERT INTO `ref_equipos` VALUES ('1', '1', 'Filtración', 'Por Definir');
INSERT INTO `ref_equipos` VALUES ('2', '2', 'Válvula Globo ', 'Por Definir');
INSERT INTO `ref_equipos` VALUES ('3', '3', 'Medidor ', 'Por Definir');
INSERT INTO `ref_equipos` VALUES ('4', '4', 'Computador de Flujo ', 'Por Definir');
INSERT INTO `ref_equipos` VALUES ('5', '5', 'CALENTADOR CATALITICO', 'POR DEFINIR');
INSERT INTO `ref_equipos` VALUES ('6', '2', 'Valvula Slam Shute', 'Por Definir');
INSERT INTO `ref_equipos` VALUES ('7', '7', 'Regulador', 'Por Definir');
INSERT INTO `ref_equipos` VALUES ('8', '8', 'ACCESORIO', 'POR DEFINIR.');
INSERT INTO `ref_equipos` VALUES ('9', '2', 'Válvula Check', 'Por Definir');
INSERT INTO `ref_equipos` VALUES ('11', '12', 'PORTATILES', 'PORTATILES');
INSERT INTO `ref_equipos` VALUES ('12', '12', 'EQUIPOS DE ESCRITORIO', 'EQUIPOS DE ESCRITORIO');
INSERT INTO `ref_equipos` VALUES ('13', '12', 'IMPRESORA LASER', 'IMPRESORA LASER');

-- ----------------------------
-- Table structure for `ref_materiales`
-- ----------------------------
DROP TABLE IF EXISTS `ref_materiales`;
CREATE TABLE `ref_materiales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tp_material` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `cant` int(6) DEFAULT 0,
  `und_med` char(4) DEFAULT 'UNDS',
  `costo` double DEFAULT 0,
  `valor` double DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_tp_material` (`id_tp_material`),
  CONSTRAINT `ref_materiales_ibfk_1` FOREIGN KEY (`id_tp_material`) REFERENCES `tp_material` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_materiales
-- ----------------------------
INSERT INTO `ref_materiales` VALUES ('1', '1', 'ABRAZADERA PLASTICA 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('2', '1', 'ABRAZADERA PLASTICA 3/8\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('3', '1', 'ABRAZADERA PLASTICA 5/8\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('4', '2', 'ADAPTADOR HEMBRA BRONCE 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('5', '2', 'ADAPTADOR HEMBRA COBRE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('6', '2', 'ADAPTADOR HEMBRA Cu 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('7', '2', 'ADAPTADOR HEMBRA Cu 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('8', '2', 'ADAPTADOR HEMBRA PE AL PE  3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('9', '2', 'ADAPTADOR HEMBRA PE AL PE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('10', '2', 'ADAPTADOR HEMBRA PEALPE DE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('11', '2', 'ADAPTADOR MACHO BRONCE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('12', '2', 'ADAPTADOR MACHO COBRE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('13', '2', 'ADAPTADOR MACHO Cu 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('14', '2', 'ADAPTADOR MACHO Cu 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('15', '2', 'ADAPTADOR MACHO PE AL PE  1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('16', '2', 'ADAPTADOR MACHO PE AL PE  3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('17', '3', 'BUSHING HG 3/4 X 1/2', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('18', '4', 'CINTA DE SEÑALIZACIÓN ROJA', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('19', '5', 'CODO CALLE HG 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('20', '5', 'CODO CALLE HG 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('21', '5', 'CODO CALLE HG 3/4', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('22', '5', 'CODO CALLE HG 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('23', '5', 'CODO COBRE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('24', '5', 'CODO Cu 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('25', '5', 'CODO CU 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('26', '5', 'CODO HG 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('27', '5', 'CODO HG 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('28', '5', 'CODO HG 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('29', '5', 'CODO HG 3/8\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('30', '5', 'CODO HG REDUCIDO 1/2\" X 3/8\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('31', '5', 'CODO HG REDUCIDO 3/4\" X 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('32', '5', 'CODO MIXTO BRONCE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('33', '6', 'CONDUFLEX 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('34', '6', 'CONDUFLEX 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('35', '7', 'CONECTORES PARA MEDIDOR', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('36', '8', 'CONJUNTO CHAZO TORNILLO 1/4  x 1.5/8\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('37', '8', 'CONJUNTO ELEVADOR + VALVULA M26 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('38', '8', 'CONJUNTO ELEVADOR + VALVULA M26 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('39', '9', 'COPA REDUCTORA Cu 3/4\" X 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('40', '10', 'ELEVADOR', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('41', '10', 'ELEVADOR 1/2\" ', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('42', '11', 'FUNDENTE', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('43', '12', 'MANGUERA FLEXOMETÁLICA', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('44', '12', 'MANGUERA GUMMY 1M', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('45', '12', 'MANGUERA GUMY', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('46', '13', 'MEDIDOR', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('47', '13', 'MEDIDOR KEUK DONG G-1.6 ', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('48', '14', 'NIPLE HG ', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('49', '14', 'NIPLE HG 1/2\" X 2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('50', '14', 'NIPLE HG 1/2\" X 3\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('51', '14', 'NIPLE HG 1/2\" X 4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('52', '15', 'RACOR M26 X 1/2\" NPT', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('53', '15', 'RACOR M26 X 3/4\" NPT', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('54', '16', 'REDUCCION PEALPE 3/4\" X 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('55', '17', 'REGULADOR HUMCAR R-', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('56', '17', 'REGULADOR HUMCAR REG 203 GN M26x1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('57', '18', 'REJILLA METALICA 38 Cms X 38 Cms', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('58', '18', 'REJILLA METALICA ESPECIAL', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('59', '19', 'SELLANTE FUERA ALTA 36ml', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('60', '19', 'SELLANTE FUERZA ALTA x 36 ML', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('61', '19', 'SELLANTE FUERZA MEDIA 36ml', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('62', '19', 'SELLANTE FUERZA MEDIA x 36 ML', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('63', '20', 'SOLDADURA', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('64', '20', 'SOLDADURA ESTAÑO PLATA 95-5', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('65', '21', 'TAPON HG 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('66', '22', 'TEE COBRE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('67', '22', 'TEE Cu 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('68', '22', 'TEE Cu 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('69', '22', 'TEE PE AL PE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('70', '22', 'TEE PEALPE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('71', '22', 'TEE PEALPE 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('72', '22', 'TEE REDUCIDA Cu 3/4\" X 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('73', '23', 'TRANSICION PE-80 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('74', '24', 'TUBERIA COBRE TIPO \"L\" 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('75', '24', 'TUBERIA Cu TIPO \"L\" 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('76', '24', 'TUBERIA Cu TIPO L 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('77', '24', 'TUBERIA Cu TIPO L 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('78', '24', 'TUBERIA PE AL PE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('79', '24', 'TUBERIA PE AL PE 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('80', '24', 'TUBERIA PE-80 ', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('81', '24', 'TUBERIA PEALPE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('82', '25', 'UNIVERSAL Cu 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('83', '25', 'UNIVERSAL Cu 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('84', '26', 'VALVULA BOLA NPT 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('85', '26', 'VALVULA BOLA NPT 3/4\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('86', '26', 'VALVULA M-26 X 1/2\" NPT', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('87', '26', 'VALVULA NPT 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('88', '26', 'VALVULA PEALPE 1/2\"', '0', 'UNDS', '0', '0');
INSERT INTO `ref_materiales` VALUES ('89', '26', 'VALVULA PEALPE 3/4\"', '0', 'UNDS', '0', '0');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Administrador', 'Administradores de área', '1');
INSERT INTO `roles` VALUES ('2', 'Técnico', 'Tecnico encargado de realizar labores', '1');
INSERT INTO `roles` VALUES ('3', 'Supervisor', 'Puede realizar funciones asignadas de tipo administrador', '1');

-- ----------------------------
-- Table structure for `rutas`
-- ----------------------------
DROP TABLE IF EXISTS `rutas`;
CREATE TABLE `rutas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rutas
-- ----------------------------

-- ----------------------------
-- Table structure for `servicios`
-- ----------------------------
DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_catserv` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_catserv` (`id_catserv`),
  CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_catserv`) REFERENCES `catservicios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of servicios
-- ----------------------------
INSERT INTO `servicios` VALUES ('10', '2', 'INSTALACION UTP', 'INSTALACION POR MEDIO DE CABLE UTP');
INSERT INTO `servicios` VALUES ('11', '2', 'INSTALACION POR RADIO ENLACE', 'INSTALACION POR RADIO ENLACE');
INSERT INTO `servicios` VALUES ('12', '5', 'LIMPIAR BOARD', 'SEJKLJLDSDSAD');

-- ----------------------------
-- Table structure for `serv_pqrs`
-- ----------------------------
DROP TABLE IF EXISTS `serv_pqrs`;
CREATE TABLE `serv_pqrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(15) DEFAULT NULL,
  `id_objpqrs` int(11) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `medio` char(1) DEFAULT NULL,
  `prioridad` char(2) DEFAULT '',
  `desc` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `edo` char(1) DEFAULT '0' COMMENT '0:Nuevo 1: en Proceso  5 Finalizado  3: Aprobado',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_objpqrs` (`id_objpqrs`),
  KEY `id_area` (`id_area`),
  CONSTRAINT `serv_pqrs_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id`),
  CONSTRAINT `serv_pqrs_ibfk_2` FOREIGN KEY (`id_objpqrs`) REFERENCES `objpqrs` (`id`),
  CONSTRAINT `serv_pqrs_ibfk_3` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of serv_pqrs
-- ----------------------------
INSERT INTO `serv_pqrs` VALUES ('33', '1', '15', '4', 'T', 'N', 'WSDADSA', '2019-11-29', '0');
INSERT INTO `serv_pqrs` VALUES ('34', '1095919878', '15', '1', 'T', 'N', 'KLÑ', '2019-11-29', '0');
INSERT INTO `serv_pqrs` VALUES ('35', '91541578', '15', '3', 'T', 'N', 'ESEQEWQEQWEQW', '2019-11-30', '0');
INSERT INTO `serv_pqrs` VALUES ('36', '91541578', '16', '3', 'T', 'N', 'USUARIO SOLICITA INSTALACIÓN DE CALENTADOR', '2019-11-30', '0');
INSERT INTO `serv_pqrs` VALUES ('37', '1095919878', '15', '3', 'T', 'N', 'USUARIO REPORTA FUGA EN LA COCINA', '2019-11-30', '0');

-- ----------------------------
-- Table structure for `tec_serv_pqrs`
-- ----------------------------
DROP TABLE IF EXISTS `tec_serv_pqrs`;
CREATE TABLE `tec_serv_pqrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servpqrs` int(11) DEFAULT NULL,
  `id_tecnico` varchar(15) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id_servpqrs` (`id_servpqrs`),
  KEY `id_tecnico` (`id_tecnico`),
  CONSTRAINT `tec_serv_pqrs_ibfk_1` FOREIGN KEY (`id_servpqrs`) REFERENCES `serv_pqrs` (`id`),
  CONSTRAINT `tec_serv_pqrs_ibfk_2` FOREIGN KEY (`id_tecnico`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tec_serv_pqrs
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_equipos`
-- ----------------------------
DROP TABLE IF EXISTS `tp_equipos`;
CREATE TABLE `tp_equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tp_equipos
-- ----------------------------
INSERT INTO `tp_equipos` VALUES ('1', 'FLITROS', '');
INSERT INTO `tp_equipos` VALUES ('2', 'VÁLVULAS', '');
INSERT INTO `tp_equipos` VALUES ('3', 'MEDIDORES', '');
INSERT INTO `tp_equipos` VALUES ('4', 'COMPUTADORES DE FLUJO', '');
INSERT INTO `tp_equipos` VALUES ('5', 'CALENTADORES', '');
INSERT INTO `tp_equipos` VALUES ('7', 'REGULADORES', '');
INSERT INTO `tp_equipos` VALUES ('8', 'ACCESORIOS', null);
INSERT INTO `tp_equipos` VALUES ('12', 'EQUIPOS DE CÓMPUTO', 'EQUIPOS DE COMPUTACIÓN');

-- ----------------------------
-- Table structure for `tp_estacions`
-- ----------------------------
DROP TABLE IF EXISTS `tp_estacions`;
CREATE TABLE `tp_estacions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tp_estacions
-- ----------------------------
INSERT INTO `tp_estacions` VALUES ('11', 'City Gate', 'Una City Gate es una unidad paquete que mide, reduce y regula la presión del gas, normalmente instalada fuera de los limites de una ciudad o un ducto de distribución. Se encarga de suministrar gas a las ciudades e industrias a una presión requerida por el ', '2019-07-02 11:23:33', '2019-07-02 11:23:33');
INSERT INTO `tp_estacions` VALUES ('12', 'Estación de Regulación', 'Estaciones conectadas a redes propias de distribución, regula presión de gas a presi´n de operación de redes urbanas', '2019-07-02 11:33:49', '2019-07-02 11:33:49');
INSERT INTO `tp_estacions` VALUES ('13', 'Estación Descompresora', 'Descomprimir gas natural comprimido de alta presión', '2019-07-02 11:35:35', '2019-07-02 11:35:35');
INSERT INTO `tp_estacions` VALUES ('14', 'Estación de Control Manual', 'Estaciones donde se verifica las condiciones de presión del gas y se usa para cierres rápidos', '2019-07-02 11:36:57', '2019-07-02 11:36:57');
INSERT INTO `tp_estacions` VALUES ('15', 'Estación de Control Automatico', 'Estaciones donde se verifica las condiciones de presión del gas y se usa para cierres rápidos', '2019-07-02 11:41:59', '2019-07-02 11:42:20');

-- ----------------------------
-- Table structure for `tp_material`
-- ----------------------------
DROP TABLE IF EXISTS `tp_material`;
CREATE TABLE `tp_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tp_material
-- ----------------------------
INSERT INTO `tp_material` VALUES ('1', 'ABRAZADERA');
INSERT INTO `tp_material` VALUES ('2', 'ADAPTADOR');
INSERT INTO `tp_material` VALUES ('3', 'BUSHING');
INSERT INTO `tp_material` VALUES ('4', 'CINTA');
INSERT INTO `tp_material` VALUES ('5', 'CODO');
INSERT INTO `tp_material` VALUES ('6', 'CONDUFLEX');
INSERT INTO `tp_material` VALUES ('7', 'CONECTORES');
INSERT INTO `tp_material` VALUES ('8', 'CONJUNTO');
INSERT INTO `tp_material` VALUES ('9', 'COPA REDUCTOR');
INSERT INTO `tp_material` VALUES ('10', 'ELEVADOR');
INSERT INTO `tp_material` VALUES ('11', 'FUNDENTE');
INSERT INTO `tp_material` VALUES ('12', 'MANGUERA');
INSERT INTO `tp_material` VALUES ('13', 'MEDIDOR');
INSERT INTO `tp_material` VALUES ('14', 'NIPLE');
INSERT INTO `tp_material` VALUES ('15', 'RACOR');
INSERT INTO `tp_material` VALUES ('16', 'REDUCCION');
INSERT INTO `tp_material` VALUES ('17', 'REGULADOR');
INSERT INTO `tp_material` VALUES ('18', 'REJILLA');
INSERT INTO `tp_material` VALUES ('19', 'SELLANTE');
INSERT INTO `tp_material` VALUES ('20', 'SOLDADURA');
INSERT INTO `tp_material` VALUES ('21', 'TAPON');
INSERT INTO `tp_material` VALUES ('22', 'TEE');
INSERT INTO `tp_material` VALUES ('23', 'TRANSICION');
INSERT INTO `tp_material` VALUES ('24', 'TUBERIA');
INSERT INTO `tp_material` VALUES ('25', 'UNIVERSAL');
INSERT INTO `tp_material` VALUES ('26', 'VALVULA');

-- ----------------------------
-- Table structure for `trenetapas`
-- ----------------------------
DROP TABLE IF EXISTS `trenetapas`;
CREATE TABLE `trenetapas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_etapa` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `desc` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idtren` (`id_etapa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trenetapas
-- ----------------------------
INSERT INTO `trenetapas` VALUES ('1', '1', 'Garagoa', null);
INSERT INTO `trenetapas` VALUES ('2', '1', 'Chitiva', null);
INSERT INTO `trenetapas` VALUES ('3', '2', 'Etapa 2', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `usuario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `idrol` int(10) unsigned NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `users_usuario_unique` (`usuario`),
  KEY `users_idrol_foreign` (`idrol`),
  KEY `id` (`id`),
  CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('10098765', '10098765', '$2y$10$4VGY57UboehYwLsgL86igu3LCcT6PzWlia.dFqduUlhSuP8jCbjsa', '1', '2', null, null);
INSERT INTO `users` VALUES ('1', 'admin', '$2y$10$Fjh4JM5ibrIu4wy1Wf8azuMqYc6Zdn.SGCm3y5hq.Q1c9vflFXMe2', '1', '1', null, 'JvKLzcgtt5qURr4xedOEPLSs3PwXOJnfbvgUeeZjrn7DtcrYUpeYRNk9Q55R');
INSERT INTO `users` VALUES ('1', 'oscar.sierra', '$2y$10$8c27NNz6MIA4a7suJJ/x3edFCzTPmcZT.L9Ijr9M6778z4bBV8BNe', '1', '1', 'KBqD0r3a15N7bUMw66k55bEstnGAzoe1XdMren6XcV7sgxgXGszux5b5zFmO', 'JvKLzcgtt5qURr4xedOEPLSs3PwXOJnfbvgUeeZjrn7DtcrYUpeYRNk9Q55R');
DROP TRIGGER IF EXISTS `tr_setEdo`;
DELIMITER ;;
CREATE TRIGGER `tr_setEdo` AFTER INSERT ON `det_equipos_estacion` FOR EACH ROW UPDATE EQUIPOS SET EQUIPOS.ESTADO = 1
WHERE EQUIPOS.ID = NEW.ID_EQUIPO
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_setEdoDelete`;
DELIMITER ;;
CREATE TRIGGER `tr_setEdoDelete` AFTER DELETE ON `det_equipos_estacion` FOR EACH ROW UPDATE EQUIPOS SET EQUIPOS.ESTADO =0
WHERE EQUIPOS.ID = OLD.ID_EQUIPO
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `fullname`;
DELIMITER ;;
CREATE TRIGGER `fullname` BEFORE INSERT ON `personas` FOR EACH ROW BEGIN
  SET NEW.nombrefull = CONCAT(NEW.Nombres, ' ', NEW.Apellidos);
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `fullname2`;
DELIMITER ;;
CREATE TRIGGER `fullname2` BEFORE UPDATE ON `personas` FOR EACH ROW BEGIN
  SET NEW.nombrefull = CONCAT(new.Nombres, ' ', new.Apellidos);
END
;;
DELIMITER ;
