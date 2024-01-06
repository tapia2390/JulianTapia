-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2024 a las 21:43:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parqueadero`
--

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
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `moto`
--

INSERT INTO `moto` (`id`, `placa`, `descripcion`, `fecha_ingreso`, `valor_cobrado`, `fecha_salida`, `estado`) VALUES
(1, 'hjq 313', '2 cascos', '2024-01-06 08:19:18', 0, '0000-00-00 00:00:00', 1),
(2, 'cpn 67e', 'hola', '2024-01-06 07:19:18', 0, '0000-00-00 00:00:00', 1),
(3, '', '', '2024-01-06 15:38:23', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_parqueadero`
--

CREATE TABLE `registros_parqueadero` (
  `id` int(11) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `tiempo_duracion` int(11) DEFAULT NULL,
  `valor_cobrado` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `moto`
--
ALTER TABLE `moto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registros_parqueadero`
--
ALTER TABLE `registros_parqueadero`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `moto`
--
ALTER TABLE `moto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registros_parqueadero`
--
ALTER TABLE `registros_parqueadero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
