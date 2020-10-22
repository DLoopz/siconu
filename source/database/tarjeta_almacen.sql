-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2020 a las 21:55:38
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siconu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta_almacen`
--

DROP TABLE IF EXISTS `tarjeta_almacen`;
CREATE TABLE `tarjeta_almacen` (
  `id_tarjeta` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `entradas` int(11) NOT NULL,
  `salidas` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `unitario` float NOT NULL,
  `promedio` float NOT NULL,
  `debe` float NOT NULL,
  `haber` float NOT NULL,
  `saldo` float NOT NULL,
  `terminar` int(1) NOT NULL DEFAULT '0',
  `nombre_articulo` varchar(50) NOT NULL,
  `tipo_unidad` varchar(50) NOT NULL,
  `tipo_registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tarjeta_almacen`
--
ALTER TABLE `tarjeta_almacen`
  ADD PRIMARY KEY (`id_tarjeta`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tarjeta_almacen`
--
ALTER TABLE `tarjeta_almacen`
  MODIFY `id_tarjeta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tarjeta_almacen`
--
ALTER TABLE `tarjeta_almacen`
  ADD CONSTRAINT `tarjeta_almacen_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
