-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-07-2019 a las 12:23:05
-- Versión del servidor: 5.7.26-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siconu`
--
DROP DATABASE IF EXISTS `siconu`;
CREATE DATABASE IF NOT EXISTS `siconu` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `siconu`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento`
--

DROP TABLE IF EXISTS `asiento`;
CREATE TABLE `asiento` (
  `id_asiento` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `concepto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_estandar`
--

DROP TABLE IF EXISTS `catalogo_estandar`;
CREATE TABLE `catalogo_estandar` (
  `id_catalogo_estandar` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `clasificacion_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo_estandar`
--

INSERT INTO `catalogo_estandar` (`id_catalogo_estandar`, `tipo_id`, `clasificacion_id`, `nombre`) VALUES
(88, 1, 1, 'Caja'),
(89, 1, 1, 'Bancos'),
(90, 1, 1, 'Mercancías'),
(91, 1, 1, 'Clientes'),
(92, 1, 1, 'Documentos por cobrar'),
(93, 1, 1, 'Deudores diversos'),
(94, 1, 1, 'Papelería y útiles'),
(95, 1, 1, 'Propaganda y publicidad'),
(96, 1, 1, 'Primas de seguros'),
(97, 1, 1, 'Rentas pagadas por anticipado'),
(98, 1, 1, 'Intereses pagados por anticipado'),
(99, 1, 2, 'Terrenos'),
(100, 1, 2, 'Edificios'),
(101, 1, 2, 'Mobiliario y equipo de oficina'),
(102, 1, 2, 'Equipo de cómputo '),
(103, 1, 2, 'Equipo de transporte'),
(104, 2, 2, 'Equipo de reparto'),
(105, 2, 2, 'Gastos de constitución'),
(106, 2, 2, 'Gastos de instalación'),
(107, 2, 2, 'Depósitos en garantía'),
(108, 2, 1, 'Proveedores'),
(109, 2, 1, 'Documentos por pagar '),
(110, 2, 1, 'Acreedores diversos'),
(111, 2, 1, 'Rentas cobradas por anticipado'),
(112, 2, 1, 'Intereses cobrados por anticipado'),
(113, 2, 2, 'Hipotecas por pagar'),
(114, 2, 2, 'Documentos por pagar largo plazo'),
(115, 3, 0, 'Capital contribuido'),
(116, 3, 0, 'Capital ganado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_usuario`
--

DROP TABLE IF EXISTS `catalogo_usuario`;
CREATE TABLE `catalogo_usuario` (
  `id_catalogo_usuario` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `clasificiacion_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion_cuenta`
--

DROP TABLE IF EXISTS `clasificacion_cuenta`;
CREATE TABLE `clasificacion_cuenta` (
  `id_clasificacion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clasificacion_cuenta`
--

INSERT INTO `clasificacion_cuenta` (`id_clasificacion`, `nombre`) VALUES
(0, 'Capital'),
(1, 'Circulante'),
(2, 'No circulante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_asiento`
--

DROP TABLE IF EXISTS `registro_asiento`;
CREATE TABLE `registro_asiento` (
  `id_registro` int(11) NOT NULL,
  `asiento_id` int(11) NOT NULL,
  `folio` varchar(50) NOT NULL,
  `catalogo_usuario_id` int(11) NOT NULL,
  `cuenta` varchar(50) NOT NULL,
  `parcial` float NOT NULL DEFAULT '0',
  `debe` float NOT NULL DEFAULT '0',
  `haber` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta_almacen`
--

DROP TABLE IF EXISTS `tarjeta_almacen`;
CREATE TABLE `tarjeta_almacen` (
  `id_tarjeta` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `entradas` int(11) NOT NULL,
  `salidas` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `unitario` float NOT NULL,
  `promedio` float NOT NULL,
  `debe` float NOT NULL,
  `haber` float NOT NULL,
  `maximo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cuenta`
--

DROP TABLE IF EXISTS `tipo_cuenta`;
CREATE TABLE `tipo_cuenta` (
  `id_tipo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cuenta`
--

INSERT INTO `tipo_cuenta` (`id_tipo`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Pasivo'),
(3, 'Capital');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `rol` int(1) NOT NULL DEFAULT '3',
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `apellido_paterno` varchar(50) NOT NULL DEFAULT '',
  `apellido_materno` varchar(50) NOT NULL DEFAULT '',
  `matricula` varchar(11) NOT NULL,
  `contrasenia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_grupo`
--

DROP TABLE IF EXISTS `usuario_grupo`;
CREATE TABLE `usuario_grupo` (
  `id_usuario_grupo` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD PRIMARY KEY (`id_asiento`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- Indices de la tabla `catalogo_estandar`
--
ALTER TABLE `catalogo_estandar`
  ADD PRIMARY KEY (`id_catalogo_estandar`),
  ADD KEY `tipo_id` (`tipo_id`,`clasificacion_id`),
  ADD KEY `clasificacion_id` (`clasificacion_id`);

--
-- Indices de la tabla `catalogo_usuario`
--
ALTER TABLE `catalogo_usuario`
  ADD PRIMARY KEY (`id_catalogo_usuario`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `tipo_id` (`tipo_id`,`clasificiacion_id`),
  ADD KEY `clasificiacion_id` (`clasificiacion_id`);

--
-- Indices de la tabla `clasificacion_cuenta`
--
ALTER TABLE `clasificacion_cuenta`
  ADD PRIMARY KEY (`id_clasificacion`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `registro_asiento`
--
ALTER TABLE `registro_asiento`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_ejercicio` (`asiento_id`),
  ADD KEY `catalogo_usuario_id` (`catalogo_usuario_id`);

--
-- Indices de la tabla `tarjeta_almacen`
--
ALTER TABLE `tarjeta_almacen`
  ADD PRIMARY KEY (`id_tarjeta`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- Indices de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD PRIMARY KEY (`id_usuario_grupo`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asiento`
--
ALTER TABLE `asiento`
  MODIFY `id_asiento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `catalogo_estandar`
--
ALTER TABLE `catalogo_estandar`
  MODIFY `id_catalogo_estandar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT de la tabla `catalogo_usuario`
--
ALTER TABLE `catalogo_usuario`
  MODIFY `id_catalogo_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clasificacion_cuenta`
--
ALTER TABLE `clasificacion_cuenta`
  MODIFY `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `registro_asiento`
--
ALTER TABLE `registro_asiento`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarjeta_almacen`
--
ALTER TABLE `tarjeta_almacen`
  MODIFY `id_tarjeta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  MODIFY `id_usuario_grupo` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD CONSTRAINT `asiento_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `catalogo_estandar`
--
ALTER TABLE `catalogo_estandar`
  ADD CONSTRAINT `catalogo_estandar_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_cuenta` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogo_estandar_ibfk_2` FOREIGN KEY (`clasificacion_id`) REFERENCES `clasificacion_cuenta` (`id_clasificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `catalogo_usuario`
--
ALTER TABLE `catalogo_usuario`
  ADD CONSTRAINT `catalogo_usuario_ibfk_2` FOREIGN KEY (`clasificiacion_id`) REFERENCES `clasificacion_cuenta` (`id_clasificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogo_usuario_ibfk_3` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_cuenta` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_asiento`
--
ALTER TABLE `registro_asiento`
  ADD CONSTRAINT `registro_asiento_ibfk_1` FOREIGN KEY (`asiento_id`) REFERENCES `asiento` (`id_asiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_asiento_ibfk_2` FOREIGN KEY (`catalogo_usuario_id`) REFERENCES `catalogo_usuario` (`id_catalogo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarjeta_almacen`
--
ALTER TABLE `tarjeta_almacen`
  ADD CONSTRAINT `tarjeta_almacen_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `empresa` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD CONSTRAINT `usuario_grupo_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_grupo_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
