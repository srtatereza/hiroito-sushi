-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-09-2022 a las 21:16:38
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

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

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL COMMENT 'PK de la tabla clientes, de tipo primary autoincremental.',
  `nombre` varchar(45) NOT NULL COMMENT 'nombre del cliente. de tipo varchar.',
  `apellido` varchar(45) NOT NULL COMMENT 'apellido del cliente de tipo varchar.',
  `direccion` varchar(45) NOT NULL COMMENT 'direccion del cliente de tipo varchar.',
  `telefono` varchar(9) NOT NULL COMMENT 'telefono del cliente de tipo varchar.',
  `email` varchar(45) NOT NULL COMMENT 'email del cliente, de tipo varchar , con indice unique.',
  `contraseña` varchar(60) NOT NULL COMMENT 'contraseña del cliente, de tipo varchar.'
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
(12, 'Michell', '', 'Debajo del puente', '611178388', 'michelle@stripper.com', '$2y$08$16645404666336df324d6O/'),
(13, 'David', '', 'Berrocal', '1234567', 'asd@asd.es', '$2y$08$166456515263373fa0ed1O4Ywyycr9iMT10hTMyz2VouJTn91/pmi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_producto`
--

CREATE TABLE `ordenes_producto` (
  `id_ordenes_producto` int(11) NOT NULL COMMENT 'PK de la tabla ordenes_producto, de tipo primary , autoincremental.',
  `fecha` date NOT NULL COMMENT 'fecha de la compra del producto.',
  `id_cliente` int(11) NOT NULL COMMENT 'FK de la tabla cliente. de tipo INT , index.',
  `id_producto` int(11) NOT NULL COMMENT 'Fk de la tabla producto , de tipo INT , index.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordenes_producto`
--

INSERT INTO `ordenes_producto` (`id_ordenes_producto`, `fecha`, `id_cliente`, `id_producto`) VALUES
(1, '2022-09-28', 1, 1),
(2, '2022-06-12', 2, 2),
(6, '2022-09-28', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL COMMENT 'PK de la tabla productos, con indice primary , autoincremental.',
  `nombre` varchar(45) NOT NULL COMMENT 'nombre del producto, de tipo Varchar.',
  `precio` float NOT NULL COMMENT 'precio del producto, de tipo float porque el precio puede tener decimales.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`) VALUES
(1, 'nirigi', 8.5),
(2, 'takitaki', 9.5);

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
-- Indices de la tabla `ordenes_producto`
--
ALTER TABLE `ordenes_producto`
  ADD PRIMARY KEY (`id_ordenes_producto`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK de la tabla clientes, de tipo primary autoincremental.', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ordenes_producto`
--
ALTER TABLE `ordenes_producto`
  MODIFY `id_ordenes_producto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK de la tabla ordenes_producto, de tipo primary , autoincremental.', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK de la tabla productos, con indice primary , autoincremental.', AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ordenes_producto`
--
ALTER TABLE `ordenes_producto`
  ADD CONSTRAINT `ordenes_producto_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `ordenes_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
