-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-08-2019 a las 11:00:38
-- Versión del servidor: 5.7.27-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.2

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
  `concepto` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `asiento`:
--   `empresa_id`
--       `empresa` -> `id_empresa`
--

--
-- Volcado de datos para la tabla `asiento`
--

INSERT INTO `asiento` (`id_asiento`, `empresa_id`, `concepto`, `fecha`) VALUES
(42, 9, 'Primer movimiento', '2019-08-14'),
(47, 9, 'segundo movimiento', '2019-08-15'),
(48, 9, 'prueba parcial', '2019-08-15');

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
-- RELACIONES PARA LA TABLA `catalogo_estandar`:
--   `tipo_id`
--       `tipo_cuenta` -> `id_tipo`
--   `clasificacion_id`
--       `clasificacion_cuenta` -> `id_clasificacion`
--

--
-- Volcado de datos para la tabla `catalogo_estandar`
--

INSERT INTO `catalogo_estandar` (`id_catalogo_estandar`, `tipo_id`, `clasificacion_id`, `nombre`) VALUES
(1, 1, 1, 'Caja'),
(2, 1, 1, 'Bancos'),
(3, 1, 1, 'Mercancías'),
(5, 1, 1, 'Clientes'),
(6, 1, 1, 'Documentos por cobrar'),
(7, 1, 1, 'Deudores diversos'),
(8, 1, 1, 'Papelería y útiles'),
(9, 1, 1, 'Propaganda y publicidad'),
(10, 1, 1, 'Primas de seguros'),
(11, 1, 1, 'Rentas pagadas por anticipado'),
(12, 1, 1, 'Intereses pagados por anticipado'),
(13, 1, 2, 'Terrenos'),
(14, 1, 2, 'Edificios'),
(15, 1, 2, 'Mobiliario y equipo de oficina'),
(16, 1, 2, 'Equipo de cómputo '),
(17, 1, 2, 'Equipo de transporte'),
(18, 1, 2, 'Equipo de reparto'),
(19, 1, 2, 'Gastos de constitución'),
(20, 1, 2, 'Gastos de instalación'),
(21, 1, 2, 'Depósitos en garantía'),
(22, 2, 1, 'Proveedores'),
(23, 2, 1, 'Documentos por pagar '),
(24, 2, 1, 'Acreedores diversos'),
(25, 2, 1, 'Rentas cobradas por anticipado'),
(26, 2, 1, 'Intereses cobrados por anticipado'),
(27, 2, 2, 'Hipotecas por pagar'),
(28, 2, 2, 'Documentos por pagar largo plazo'),
(31, 3, 1, 'capital ganado'),
(32, 3, 1, 'capital contribuido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_usuario`
--

DROP TABLE IF EXISTS `catalogo_usuario`;
CREATE TABLE `catalogo_usuario` (
  `id_catalogo_usuario` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `clasificacion_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `catalogo_usuario`:
--   `clasificacion_id`
--       `clasificacion_cuenta` -> `id_clasificacion`
--   `tipo_id`
--       `tipo_cuenta` -> `id_tipo`
--

--
-- Volcado de datos para la tabla `catalogo_usuario`
--

INSERT INTO `catalogo_usuario` (`id_catalogo_usuario`, `tipo_id`, `clasificacion_id`, `nombre`, `usuario_id`) VALUES
(97, 1, 1, 'Caja', 19),
(98, 1, 1, 'Bancos', 19),
(99, 1, 1, 'Mercancías', 19),
(100, 1, 1, 'Clientes', 19),
(101, 1, 1, 'Documentos por cobrar', 19),
(102, 1, 1, 'Deudores diversos', 19),
(103, 1, 1, 'Papelería y útiles', 19),
(104, 1, 1, 'Propaganda y publicidad', 19),
(105, 1, 1, 'Primas de seguros', 19),
(106, 1, 1, 'Rentas pagadas por anticipado', 19),
(107, 1, 1, 'Intereses pagados por anticipado', 19),
(108, 1, 2, 'Terrenos', 19),
(109, 1, 2, 'Edificios', 19),
(110, 1, 2, 'Mobiliario y equipo de oficina', 19),
(111, 1, 2, 'Equipo de cómputo ', 19),
(112, 1, 2, 'Equipo de transporte', 19),
(113, 1, 2, 'Equipo de reparto', 19),
(114, 1, 2, 'Gastos de constitución', 19),
(115, 1, 2, 'Gastos de instalación', 19),
(116, 1, 2, 'Depósitos en garantía', 19),
(117, 2, 1, 'Proveedores', 19),
(118, 2, 1, 'Documentos por pagar ', 19),
(119, 2, 1, 'Acreedores diversos', 19),
(120, 2, 1, 'Rentas cobradas por anticipado', 19),
(121, 2, 1, 'Intereses cobrados por anticipado', 19),
(122, 2, 2, 'Hipotecas por pagar', 19),
(123, 2, 2, 'Documentos por pagar largo plazo', 19),
(124, 3, 1, 'capital ganado', 19),
(125, 3, 1, 'capital contribuido', 19),
(126, 1, 1, 'Caja chica', 19);

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
-- RELACIONES PARA LA TABLA `clasificacion_cuenta`:
--

--
-- Volcado de datos para la tabla `clasificacion_cuenta`
--

INSERT INTO `clasificacion_cuenta` (`id_clasificacion`, `nombre`) VALUES
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

--
-- RELACIONES PARA LA TABLA `empresa`:
--

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `usuario_id`, `nombre`) VALUES
(9, 21, 'prueba ejercicio S.A de C.V'),
(10, 21, 'empresita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `grupo`:
--

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre`) VALUES
(18, '111'),
(19, '123'),
(20, '901'),
(24, '301');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `grupos_usuarios`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `grupos_usuarios`;
CREATE TABLE `grupos_usuarios` (
`id_usuario_grupo` int(11)
,`usuario_id` int(11)
,`grupo_id` int(11)
,`grupo` varchar(50)
,`nombre` varchar(50)
,`apellido_paterno` varchar(50)
,`apellido_materno` varchar(50)
,`rol` int(1)
,`matricula` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `parcial`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `parcial`;
CREATE TABLE `parcial` (
`id_asiento` int(11)
,`empresa_id` int(11)
,`descripcion` varchar(50)
,`fecha` date
,`id_registro` int(11)
,`asiento_id` int(11)
,`folio` varchar(50)
,`catalogo_usuario_id` int(11)
,`cuenta` varchar(50)
,`parcial` float
,`debe` float
,`haber` float
,`id_parcial` int(11)
,`registro_id` int(11)
,`concepto` varchar(50)
,`cantidad` float
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `rayado_diario`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `rayado_diario`;
CREATE TABLE `rayado_diario` (
`id_asiento` int(11)
,`empresa_id` int(11)
,`concepto` varchar(50)
,`fecha` date
,`id_registro` int(11)
,`asiento_id` int(11)
,`folio` varchar(50)
,`catalogo_usuario_id` int(11)
,`cuenta` varchar(50)
,`parcial` float
,`debe` float
,`haber` float
);

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

--
-- RELACIONES PARA LA TABLA `registro_asiento`:
--   `asiento_id`
--       `asiento` -> `id_asiento`
--   `catalogo_usuario_id`
--       `catalogo_usuario` -> `id_catalogo_usuario`
--

--
-- Volcado de datos para la tabla `registro_asiento`
--

INSERT INTO `registro_asiento` (`id_registro`, `asiento_id`, `folio`, `catalogo_usuario_id`, `cuenta`, `parcial`, `debe`, `haber`) VALUES
(44, 42, '2201', 122, 'Hipotecas por pagar', 0, 0, 1000),
(53, 47, '1101', 97, 'Caja', 0, 1000, 0),
(54, 47, '1103', 99, 'Mercancías', 0, 1, 0),
(55, 47, '1107', 103, 'Papelería y útiles', 0, 1001, 0),
(56, 47, '1102', 98, 'Bancos', 0, 0, 2001),
(57, 47, '1101', 97, 'Caja', 0, 0, 1),
(58, 48, '1109', 105, 'Primas de seguros', 0, 3100, 0),
(59, 48, '1101', 97, 'Caja', 0, 0, 3100),
(60, 42, '1101', 97, 'Caja', 0, 1000, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_parcial`
--

DROP TABLE IF EXISTS `registro_parcial`;
CREATE TABLE `registro_parcial` (
  `id_parcial` int(11) NOT NULL,
  `registro_id` int(11) NOT NULL,
  `concepto` varchar(50) NOT NULL,
  `cantidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `registro_parcial`:
--

--
-- Volcado de datos para la tabla `registro_parcial`
--

INSERT INTO `registro_parcial` (`id_parcial`, `registro_id`, `concepto`, `cantidad`) VALUES
(1, 48, 'abc', 123),
(2, 48, 'eee', 1),
(3, 48, '111', 11),
(4, 51, 'bancoA', 1000),
(5, 53, 'bancoA', 1000),
(6, 54, 'fdsdfsf', 1),
(7, 55, 'ya sabes', 1001),
(8, 56, 'BancoA', 1000),
(9, 56, 'BancoB', 1000),
(10, 56, 'BancoC', 1),
(11, 58, 'primaA', 1000),
(12, 58, 'primaB', 2100);

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

--
-- RELACIONES PARA LA TABLA `tarjeta_almacen`:
--   `empresa_id`
--       `empresa` -> `id_empresa`
--

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
-- RELACIONES PARA LA TABLA `tipo_cuenta`:
--

--
-- Volcado de datos para la tabla `tipo_cuenta`
--

INSERT INTO `tipo_cuenta` (`id_tipo`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Pasivo'),
(3, 'Capital contable');

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
  `matricula` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `usuario`:
--

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `rol`, `nombre`, `apellido_paterno`, `apellido_materno`, `matricula`, `contrasenia`) VALUES
(1, 1, 'admin', 'admin', 'admin', 'root', '63a9f0ea7bb98050796b649e85481845 '),
(19, 2, 'DavidM', 'Lopez', 'Polanco', 'dloopz16@gmail.com', '698d51a19d8a121ce581499d7b701668'),
(21, 3, 'aaa', 'aaa', 'aaa', '12345', '25d55ad283aa400af464c76d713c07ad'),
(25, 3, 'ccc', 'ccc', 'ccc', '12368', '25d55ad283aa400af464c76d713c07ad'),
(27, 3, 'aaa', 'aaa', 'aaa', '0114010005', '25d55ad283aa400af464c76d713c07ad'),
(28, 2, 'profesor', 'profesor', 'profesor', 'asas@gmail.com', 'dda5ad8a4da8b217e69db78e02951256'),
(29, 2, 'profesor', 'profesor', 'profesor', 'prosor1@homail.com', '1b129ef22981d8a624f451b88ef37371');

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
-- RELACIONES PARA LA TABLA `usuario_grupo`:
--   `grupo_id`
--       `grupo` -> `id_grupo`
--   `usuario_id`
--       `usuario` -> `id_usuario`
--

--
-- Volcado de datos para la tabla `usuario_grupo`
--

INSERT INTO `usuario_grupo` (`id_usuario_grupo`, `usuario_id`, `grupo_id`) VALUES
(8, 19, 20),
(9, 21, 20),
(14, 25, 20),
(17, 27, 24);

-- --------------------------------------------------------

--
-- Estructura para la vista `grupos_usuarios`
--
DROP TABLE IF EXISTS `grupos_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `grupos_usuarios`  AS  select `usuario_grupo`.`id_usuario_grupo` AS `id_usuario_grupo`,`usuario_grupo`.`usuario_id` AS `usuario_id`,`usuario_grupo`.`grupo_id` AS `grupo_id`,`grupo`.`nombre` AS `grupo`,`usuario`.`nombre` AS `nombre`,`usuario`.`apellido_paterno` AS `apellido_paterno`,`usuario`.`apellido_materno` AS `apellido_materno`,`usuario`.`rol` AS `rol`,`usuario`.`matricula` AS `matricula` from ((`usuario` join `usuario_grupo` on((`usuario`.`id_usuario` = `usuario_grupo`.`usuario_id`))) join `grupo` on((`grupo`.`id_grupo` = `usuario_grupo`.`grupo_id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `parcial`
--
DROP TABLE IF EXISTS `parcial`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `parcial`  AS  select `asiento`.`id_asiento` AS `id_asiento`,`asiento`.`empresa_id` AS `empresa_id`,`asiento`.`concepto` AS `descripcion`,`asiento`.`fecha` AS `fecha`,`parcial`.`id_registro` AS `id_registro`,`parcial`.`asiento_id` AS `asiento_id`,`parcial`.`folio` AS `folio`,`parcial`.`catalogo_usuario_id` AS `catalogo_usuario_id`,`parcial`.`cuenta` AS `cuenta`,`parcial`.`parcial` AS `parcial`,`parcial`.`debe` AS `debe`,`parcial`.`haber` AS `haber`,`parcial`.`id_parcial` AS `id_parcial`,`parcial`.`registro_id` AS `registro_id`,`parcial`.`concepto` AS `concepto`,`parcial`.`cantidad` AS `cantidad` from (`asiento` join (select `registro_asiento`.`id_registro` AS `id_registro`,`registro_asiento`.`asiento_id` AS `asiento_id`,`registro_asiento`.`folio` AS `folio`,`registro_asiento`.`catalogo_usuario_id` AS `catalogo_usuario_id`,`registro_asiento`.`cuenta` AS `cuenta`,`registro_asiento`.`parcial` AS `parcial`,`registro_asiento`.`debe` AS `debe`,`registro_asiento`.`haber` AS `haber`,`registro_parcial`.`id_parcial` AS `id_parcial`,`registro_parcial`.`registro_id` AS `registro_id`,`registro_parcial`.`concepto` AS `concepto`,`registro_parcial`.`cantidad` AS `cantidad` from (`registro_asiento` join `registro_parcial` on((`registro_asiento`.`id_registro` = `registro_parcial`.`registro_id`)))) `parcial` on((`asiento`.`id_asiento` = `parcial`.`asiento_id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `rayado_diario`
--
DROP TABLE IF EXISTS `rayado_diario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rayado_diario`  AS  select `asiento`.`id_asiento` AS `id_asiento`,`asiento`.`empresa_id` AS `empresa_id`,`asiento`.`concepto` AS `concepto`,`asiento`.`fecha` AS `fecha`,`registro_asiento`.`id_registro` AS `id_registro`,`registro_asiento`.`asiento_id` AS `asiento_id`,`registro_asiento`.`folio` AS `folio`,`registro_asiento`.`catalogo_usuario_id` AS `catalogo_usuario_id`,`registro_asiento`.`cuenta` AS `cuenta`,`registro_asiento`.`parcial` AS `parcial`,`registro_asiento`.`debe` AS `debe`,`registro_asiento`.`haber` AS `haber` from (`asiento` join `registro_asiento` on((`asiento`.`id_asiento` = `registro_asiento`.`asiento_id`))) ;

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
  ADD KEY `tipo_id` (`tipo_id`,`clasificacion_id`),
  ADD KEY `clasificiacion_id` (`clasificacion_id`);

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
-- Indices de la tabla `registro_parcial`
--
ALTER TABLE `registro_parcial`
  ADD PRIMARY KEY (`id_parcial`),
  ADD KEY `registro_id` (`registro_id`);

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
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `matricula` (`matricula`);

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
  MODIFY `id_asiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `catalogo_estandar`
--
ALTER TABLE `catalogo_estandar`
  MODIFY `id_catalogo_estandar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `catalogo_usuario`
--
ALTER TABLE `catalogo_usuario`
  MODIFY `id_catalogo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT de la tabla `clasificacion_cuenta`
--
ALTER TABLE `clasificacion_cuenta`
  MODIFY `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `registro_asiento`
--
ALTER TABLE `registro_asiento`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `registro_parcial`
--
ALTER TABLE `registro_parcial`
  MODIFY `id_parcial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  MODIFY `id_usuario_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
  ADD CONSTRAINT `catalogo_usuario_ibfk_2` FOREIGN KEY (`clasificacion_id`) REFERENCES `clasificacion_cuenta` (`id_clasificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Filtros para la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD CONSTRAINT `usuario_grupo_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_grupo_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;