-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2013 a las 06:25:28
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bd_calidad`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `archivos_pendientes`
--
CREATE TABLE IF NOT EXISTS `archivos_pendientes` (
`id_archivo` int(10)
,`nombre_archivo` varchar(100)
,`fecha_solicitud` datetime
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_admins`
--

CREATE TABLE IF NOT EXISTS `tbl_admins` (
  `id_admin` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(25) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_admins`
--

INSERT INTO `tbl_admins` (`id_admin`, `nombre`, `correo`, `estado`) VALUES
(1, 'admin', 'jpgarcia01@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivos`
--

CREATE TABLE IF NOT EXISTS `tbl_archivos` (
  `id_archivo` int(10) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(10) NOT NULL,
  `id_subcat` int(10) NOT NULL,
  `nombre_archivo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `version` varchar(10) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `url_archivo` varchar(50) NOT NULL,
  `url_online` varchar(500) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_archivo`),
  UNIQUE KEY `nombre_archivo` (`nombre_archivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `tbl_archivos`
--

INSERT INTO `tbl_archivos` (`id_archivo`, `id_categoria`, `id_subcat`, `nombre_archivo`, `version`, `fecha_creacion`, `id_usuario`, `url_archivo`, `url_online`, `estado`) VALUES
(1, 1, 1, 'archivo1', '1', '2013-08-09 00:00:00', 25, 'prueba.doc', '', 1),
(2, 2, 2, 'archivo2', '1', '2013-08-08 00:00:00', 36, 'archivo2.doc', '', 1),
(49, 1, 1, 'xzass', '3', '2013-10-20 21:46:11', 0, 'wii party.txt', 'https://docs.google.com/viewdhl=es', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `id_categoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-activo/2-inactivo',
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `nombre_categoria` (`nombre_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`id_categoria`, `nombre_categoria`, `fecha_creacion`, `estado`) VALUES
(1, 'Categoria1', '2013-08-19 00:00:00', 1),
(2, 'Categoria2', '2013-08-19 00:00:00', 1),
(3, 'categoriajp', '2013-10-19 10:12:39', 1),
(6, 'dÃƒÂ­a', '2013-10-19 10:25:16', 1),
(7, 'ÃƒÂ¡rbol', '2013-10-19 10:26:29', 1),
(8, 'cáma', '2013-10-19 10:27:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pendientes`
--

CREATE TABLE IF NOT EXISTS `tbl_pendientes` (
  `id_pendiente` int(10) NOT NULL AUTO_INCREMENT,
  `id_archivo` int(10) NOT NULL,
  `comentario` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nuevo_archivo` varchar(20) NOT NULL,
  `url_online` varchar(500) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `id_usuario` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_pendiente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tbl_pendientes`
--

INSERT INTO `tbl_pendientes` (`id_pendiente`, `id_archivo`, `comentario`, `nuevo_archivo`, `url_online`, `fecha_solicitud`, `id_usuario`, `estado`) VALUES
(1, 1, 'comentario del archivo', 'prueba.doc', '', '2013-08-09 00:00:00', '25', 0),
(2, 2, 'adasd dsdadsa asda ', 'prueba2.doc', '', '2013-08-09 00:00:00', '36', 1),
(3, 2, 'ssadad', 'valiente.png', '', '2013-10-20 18:15:35', '', 1),
(4, 49, 'comentario comentario', 'wii party.txt', '', '2013-10-20 22:12:55', '', 1),
(5, 1, 'coment', 'https://docs.google.', '', '2013-10-20 22:21:17', '', 1),
(6, 1, 'comementario', 'wii party.txt', 'https://docs.google.com/', '2013-10-20 22:23:41', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_subcat`
--

CREATE TABLE IF NOT EXISTS `tbl_subcat` (
  `id_subcat` int(10) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(10) NOT NULL,
  `nombre_subcat` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_subcat`),
  UNIQUE KEY `nombre_subcat` (`nombre_subcat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_subcat`
--

INSERT INTO `tbl_subcat` (`id_subcat`, `id_categoria`, `nombre_subcat`, `fecha_creacion`, `estado`) VALUES
(1, 1, 'Subcategoria1', '2013-08-08 00:00:00', 1),
(2, 2, 'subcategoria2', '2013-08-08 00:00:00', 1),
(3, 8, 'kíko', '2013-10-19 10:46:01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `correo` varchar(25) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id`, `nombre`, `correo`, `estado`, `fecha_creacion`) VALUES
(1, 'usuario1', 'jpgarcia01@gmail.com', 1, '2013-08-08 00:00:00');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_maestro`
--
CREATE TABLE IF NOT EXISTS `vista_maestro` (
`id_archivo` int(10)
,`id_categoria` int(10)
,`id_subcat` int(10)
,`nombre_archivo` varchar(100)
,`version` varchar(10)
,`fecha_creacion` datetime
,`id_usuario` int(10)
,`url_archivo` varchar(50)
,`url_online` varchar(500)
,`estado` tinyint(4)
,`nombre_categoria` varchar(50)
,`nombre_subcat` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_pendientes`
--
CREATE TABLE IF NOT EXISTS `vista_pendientes` (
`id_archivo` int(10)
,`nombre_archivo` varchar(100)
,`comentario` varchar(150)
,`fecha_solicitud` datetime
);
-- --------------------------------------------------------

--
-- Estructura para la vista `archivos_pendientes`
--
DROP TABLE IF EXISTS `archivos_pendientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `archivos_pendientes` AS select `tbl_archivos`.`id_archivo` AS `id_archivo`,`tbl_archivos`.`nombre_archivo` AS `nombre_archivo`,`tbl_pendientes`.`fecha_solicitud` AS `fecha_solicitud` from (`tbl_archivos` join `tbl_pendientes` on((`tbl_archivos`.`id_archivo` = `tbl_pendientes`.`id_archivo`))) limit 0,30;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_maestro`
--
DROP TABLE IF EXISTS `vista_maestro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_maestro` AS select `tbl_archivos`.`id_archivo` AS `id_archivo`,`tbl_archivos`.`id_categoria` AS `id_categoria`,`tbl_archivos`.`id_subcat` AS `id_subcat`,`tbl_archivos`.`nombre_archivo` AS `nombre_archivo`,`tbl_archivos`.`version` AS `version`,`tbl_archivos`.`fecha_creacion` AS `fecha_creacion`,`tbl_archivos`.`id_usuario` AS `id_usuario`,`tbl_archivos`.`url_archivo` AS `url_archivo`,`tbl_archivos`.`url_online` AS `url_online`,`tbl_archivos`.`estado` AS `estado`,`tbl_categorias`.`nombre_categoria` AS `nombre_categoria`,`tbl_subcat`.`nombre_subcat` AS `nombre_subcat` from ((`tbl_archivos` join `tbl_categorias` on((`tbl_archivos`.`id_categoria` = `tbl_categorias`.`id_categoria`))) join `tbl_subcat` on((`tbl_archivos`.`id_subcat` = `tbl_subcat`.`id_subcat`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_pendientes`
--
DROP TABLE IF EXISTS `vista_pendientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pendientes` AS select `tbl_archivos`.`id_archivo` AS `id_archivo`,`tbl_archivos`.`nombre_archivo` AS `nombre_archivo`,`tbl_pendientes`.`comentario` AS `comentario`,`tbl_pendientes`.`fecha_solicitud` AS `fecha_solicitud` from (`tbl_archivos` join `tbl_pendientes` on((`tbl_archivos`.`id_archivo` = `tbl_pendientes`.`id_archivo`))) limit 0,30;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
