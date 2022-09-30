-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2022 a las 14:22:01
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examen`
--
DROP DATABASE IF EXISTS `examen`;
CREATE DATABASE IF NOT EXISTS `examen` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `examen`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(50) NOT NULL COMMENT 'pk de la tabla, identificador del usuario'' auto incremental.',
  `nombre` varchar(50) NOT NULL COMMENT 'nombre del paciente ',
  `peso` int(11) NOT NULL COMMENT 'peso del paciente.',
  `altura` float NOT NULL COMMENT 'altura del paciente, es de tipo float porque necesitamos almacenar los datos en numero decimales.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `peso`, `altura`) VALUES
(1, 'maria@correo.com', 50, 1.7),
(2, 'petra@correo.com', 60, 1.8),
(3, '$usuario', 0, 0),
(4, '$nombre', 0, 0),
(5, '$nombre', 0, 0),
(6, 'tereza', 5, 170),
(7, 'tereza', 5, 170),
(8, 'camila', 80, 165),
(9, 'camila', 80, 165),
(10, 'camila', 80, 165),
(11, 'camila', 80, 165),
(12, 'camila', 80, 165),
(13, 'david', 85, 170),
(14, 'juan', 65, 185),
(15, 'juan', 65, 185),
(16, 'juan', 65, 185),
(17, 'juan', 65, 185),
(18, 'juan', 80, 150),
(19, 'carlos', 80, 150),
(20, 'carlos', 80, 150),
(21, 'carlos', 80, 150),
(22, 'carlos', 80, 150),
(23, 'carlos', 80, 150),
(24, 'carlos', 80, 150),
(25, 'carlos', 80, 150),
(26, 'carlos', 80, 150),
(27, 'carlos', 80, 150),
(28, 'carlos', 80, 150),
(29, 'carlos', 80, 150),
(30, 'carlos', 80, 150),
(31, 'carlos', 80, 150),
(32, 'carlos', 80, 150),
(33, 'carlos', 80, 150),
(34, 'carlos', 80, 150),
(35, 'carlos', 80, 150),
(36, 'carlos', 80, 150),
(37, 'miguel angel', 80, 150),
(38, 'miguel angel', 80, 150),
(39, 'miguel angel', 80, 150),
(40, 'miguel angel', 80, 150),
(41, 'miguel angel', 80, 150),
(42, 'miguel angel', 80, 150),
(43, 'leo', 60, 170),
(44, '', 0, 0),
(45, 'juan', 60, 170);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(50) NOT NULL AUTO_INCREMENT COMMENT 'pk de la tabla, identificador del usuario'' auto incremental.', AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
