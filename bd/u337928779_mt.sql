-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-03-2024 a las 14:54:55
-- Versión del servidor: 10.11.7-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u337928779_mt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id`, `descripcion`, `fecha`, `valor`) VALUES
(1, 'trapero', '2024-03-11 10:35:47', 6000),
(2, 'trapiadora', '2024-03-19 20:56:17', 3000),
(3, 'jabon', '2024-03-20 00:10:10', 3600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `descripcion`, `fecha`, `valor`) VALUES
(1, 'guantes', '2024-03-11 10:35:33', 25000),
(2, 'guantes', '2024-03-19 20:55:45', 6000),
(3, 'botas', '2024-03-20 00:09:55', 6800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lavadas`
--

CREATE TABLE `lavadas` (
  `id` int(11) NOT NULL,
  `placa` text NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `valor_cobrado` int(11) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `cascos` text NOT NULL,
  `ubicacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lavadas`
--

INSERT INTO `lavadas` (`id`, `placa`, `descripcion`, `fecha_ingreso`, `valor_cobrado`, `fecha_salida`, `estado`, `cascos`, `ubicacion`) VALUES
(5, 'CPN 67E', 'lavada  de moto negra', '2024-03-08 23:11:43', 3800, '0000-00-00 00:00:00', 0, '1', ''),
(6, 'kpn 47e', 'lavada normal', '2024-03-09 15:35:43', 17000, '2024-03-09 15:45:42', 0, '2', '4 y 5'),
(8, 'ppn 47y', 'lavada  de moto roja', '2024-03-09 15:42:08', 18000, '2024-03-11 10:36:03', 0, '1', '8'),
(10, 'Onb16e', '1 mtin ', '2024-03-11 21:14:01', 5000, '2024-03-19 20:50:07', 0, '1', '7'),
(11, 'OVI85G ', '1 mtin', '2024-03-11 21:19:24', 4500, '2024-03-20 00:09:19', 0, '1', '21'),
(12, 'DPT95B', '', '2024-03-11 21:27:06', 0, '0000-00-00 00:00:00', 1, '2', '2-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moto`
--

CREATE TABLE `moto` (
  `id` int(11) NOT NULL,
  `placa` text NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `valor_cobrado` int(11) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `cascos` text NOT NULL,
  `ubicacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `moto`
--

INSERT INTO `moto` (`id`, `placa`, `descripcion`, `fecha_ingreso`, `valor_cobrado`, `fecha_salida`, `estado`, `cascos`, `ubicacion`) VALUES
(5, 'apn 67e', 'parqueadero', '2024-03-09 11:06:52', 43200, '2024-03-11 10:35:49', 0, '2', ''),
(11, 'Mjl48d', '1 sp negro', '2024-03-11 21:18:12', 175500, '2024-03-20 00:09:06', 0, '2', '3/4'),
(12, 'BRE977', 'DIF PLACA', '2024-03-11 21:22:36', 0, '0000-00-00 00:00:00', 1, '3', '3-5-6'),
(14, 'BRE978', 'sin cascos', '2024-03-19 20:42:11', 2700, '2024-03-19 23:35:02', 0, '5', '3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lavadas`
--
ALTER TABLE `lavadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `moto`
--
ALTER TABLE `moto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lavadas`
--
ALTER TABLE `lavadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `moto`
--
ALTER TABLE `moto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
