#TABLA DETALLE_TIPO_COSTO
DROP TABLE IF EXISTS `detalle_tipo_costo`;
CREATE TABLE IF NOT EXISTS `detalle_tipo_costo` (
  `codigo_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `rut_persona` int(11) NOT NULL,
  `codigo_tipo_costo` int(11) NOT NULL,
  `nombre_detalle` varchar(100) DEFAULT NULL,
  `valor` int(11) NOT NULL DEFAULT '0',
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo_detalle`,`rut_persona`,`codigo_tipo_costo`),
  KEY `fk_DETALLE_TIPO_COSTO_TIPO_COSTO_idx` (`codigo_tipo_costo`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

#TABLA MES
DROP TABLE IF EXISTS `mes`;
CREATE TABLE IF NOT EXISTS `mes` (
  `codigo_mes` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codigo_mes`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `mes` (`codigo_mes`, `descripcion`) VALUES
(1, 'ENERO'),
(2, 'FEBRERO'),
(3, 'MARZO'),
(4, 'ABRIL'),
(5, 'MAYO'),
(6, 'JUNIO'),
(7, 'JULIO'),
(8, 'AGOSTO'),
(9, 'SEPTIEMBRE'),
(10, 'OCTUBRE'),
(11, 'NOVIEMBRE'),
(12, 'DICIEMBRE');


#TABLA PERSONA
DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `rut_persona` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_p` varchar(100) DEFAULT NULL,
  `apellido_m` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rut_persona`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `persona` (`rut_persona`, `nombre`, `apellido_p`, `apellido_m`) VALUES
(168850638, 'Emilio', 'Correa', 'Soto');


#TABLA REGISTRO_REMUNERACIONES
DROP TABLE IF EXISTS `registro_remuneraciones`;
CREATE TABLE IF NOT EXISTS `registro_remuneraciones` (
  `codigo_registro_remuneracion` int(11) NOT NULL AUTO_INCREMENT,
  `rut_persona` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `remuneracion` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_registro_remuneracion`,`rut_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#TABLA REGISTRO_REMUNERACIONES_DETALLE
DROP TABLE IF EXISTS `registro_remuneracion_detalle`;
CREATE TABLE IF NOT EXISTS `registro_remuneracion_detalle` (
  `codigo_registro_remuneracion` int(11) NOT NULL,
  `codigo_detalle` int(11) NOT NULL,
  `codigo_tipo_costo` int(11) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`codigo_registro_remuneracion`,`codigo_detalle`,`codigo_tipo_costo`),
  KEY `fk_REGISTRO_REMUNERACION_DETALLE_DETALLE_TIPO_COSTO1_idx` (`codigo_detalle`,`codigo_tipo_costo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#TABLA TIPO_COSTO
DROP TABLE IF EXISTS `tipo_costo`;
CREATE TABLE IF NOT EXISTS `tipo_costo` (
  `codigo_tipo_costo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_costo` varchar(100) DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo_tipo_costo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `tipo_costo` (`codigo_tipo_costo`, `nombre_tipo_costo`, `activo`) VALUES
(1, 'COSTO FIJOS', 1),
(2, 'COSTO VARIABLES', 1);

#TABLA USUARIO
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `rut_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `contrasenia` varchar(255) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `administrador` int(11) NOT NULL DEFAULT '0',
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`rut_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `usuario` (`rut_usuario`, `nombre_usuario`, `contrasenia`, `fecha_registro`, `administrador`, `activo`) VALUES
(168850638, 'ecorrea', '$2y$10$jjvg/Fd49ZKXA1ryfXztKeEFsz1vfD9lecAds0bT8a8M1irbxyPuS', '2017-12-16', 1, 1);