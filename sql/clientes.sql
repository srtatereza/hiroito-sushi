-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2022 a las 14:54:18
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
-- Base de datos: `hiroito_sushi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL COMMENT 'PK de la tabla clientes, de tipo primary autoincremental.',
  `nombre` varchar(45) NOT NULL COMMENT 'nombre del cliente. de tipo varchar.',
  `apellido` varchar(45) NOT NULL COMMENT 'apellido del cliente de tipo varchar.',
  `direccion` varchar(45) NOT NULL COMMENT 'direccion del cliente de tipo varchar.',
  `telefono` varchar(9) NOT NULL COMMENT 'telefono del cliente de tipo varchar.',
  `email` varchar(45) NOT NULL COMMENT 'email del cliente, de tipo varchar , con indice unique.',
  `contraseña` varchar(30) NOT NULL COMMENT 'contraseña del cliente, de tipo varchar.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `direccion`, `telefono`, `email`, `contraseña`) VALUES
(1, 'tereza', 'franco', 'calle berrocal 3', '698858075', 'terezafranco94@gmail.com', 'tereza1994'),
(2, 'sofia', 'rodriguez', 'calle delicias 3', '698807962', 'sofiarodriguez@gmail.com', 'sofia1994'),
(3, '', '', '', '', '', '$2y$08$16643627666334290edcee/'),
(4, 'miguel', 'perez', 'calle miguel 34', '123852456', 'miguel@gmail.com', '123456'),
(5, 'dasdas', '', 'dasdsadasd', '611178388', 'luis@luis.com', '18989'),
(6, 'tryteu', '', 'ytietiu 465132', '5465156', 'srhuwyru@gmail.cm', '16484798'),
(7, 'ryttey8u7e', '', 'iyiriu@gmail.es', '558554', 'iyiriu@gmail.es', '465464'),
(8, 'michell ', '', 'calle pepi 65', '856123452', 'hyhthy@ft.com', '852963'),
(9, 'michell', '', 'calle 45', '852456102', 'mivhel@ft.es', '852410'),
(10, 'david', '', 'calle tetuan', '856965412', 'try@ft.es', '852102'),
(11, 'yuiyui875', '', 'iryiuytiu 56', '4646513', 'yu@tf.es', '$2y$08$16645400796336ddaff0auv'),
(12, 'Michell', '', 'Debajo del puente', '611178388', 'michelle@stripper.com', '$2y$08$16645404666336df324d6O/');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK de la tabla clientes, de tipo primary autoincremental.', AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
