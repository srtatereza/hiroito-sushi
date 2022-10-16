-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-10-2022 a las 23:41:32
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
CREATE DATABASE IF NOT EXISTS `hiroito_sushi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hiroito_sushi`;

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
(15, 'tereza', 'franco', 'calle berrocal 3', '698858075', 'terezafranco94@gmail.com', '$2y$08$1664801651633adb73458uHXE3ftrBx47ilgWtd1m3rAK8H7c7tpO'),
(19, 'ana', 'vega', 'berrocal 4', '123654789', 'ana@gmail.com', '$2y$08$1665419362634448627d8e8SPRFVgW6FxZnmWDnlAl4OZUQfVLxam'),
(22, 'maria', 'perez', 'calle maria 1', '963852741', 'maria@gmail.com', '$2y$08$1665891279634b7bcf143u9LMFwv48KQaDaWTLOE5nkGy9y5j1nMa'),
(23, 'lola', 'lola', 'calle lola ', '965852140', 'lola@gmail.com', '$2y$08$1665902688634ba860899urBNuF7grhXVspbPx8FDz0xzDUOAvCCC'),
(24, 'david', 'vega', 'berrocal 3', '621212121', 'xdavidvega95@gmail.com', '$2y$08$1665905166634bb20e6ddu4X0Wjs2cqqvoRmJGwNPtNpEx.Uksqnu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` varchar(32) NOT NULL COMMENT 'PK de la tabla pedidos, de tipo autoincremental con indice Primary.',
  `fecha` date NOT NULL COMMENT 'fecha donde se realizo el pedido, de tipo date.',
  `id_cliente` int(11) NOT NULL COMMENT 'Fk de la tabla clientes , de tipo INT con indice Index.',
  `id_producto` int(11) NOT NULL COMMENT 'Fk de la tabla productos, de tipo INT con indice Index.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fecha`, `id_cliente`, `id_producto`) VALUES
('217312296999', '2022-10-16', 24, 1),
('217312296999', '2022-10-16', 24, 2),
('222094620540', '2022-10-16', 24, 5),
('266581086149', '2022-10-16', 24, 5),
('349236298493', '2022-10-16', 22, 1),
('534543738431', '2022-10-16', 15, 5),
('854716175746', '2022-10-16', 19, 6),
('898366172885', '2022-10-14', 19, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL COMMENT 'PK de la tabla producto , de indice Primary , autoincremental.',
  `nombre` varchar(45) NOT NULL COMMENT 'nombre del producto, de tipo Varchar.',
  `código` varchar(45) NOT NULL COMMENT 'código del producto, para identificarlo , de tipo varchar.',
  `imagen` text NOT NULL COMMENT 'imagen del producto , de tipo text .',
  `precio` double(10,2) NOT NULL COMMENT 'precio del producto, de tipo double para almacenar los valores reales en doble precisión.',
  `ingredientes` text NOT NULL COMMENT 'ingredientes del producto, de tipo blog que nos permite almacenar texto largos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `código`, `imagen`, `precio`, `ingredientes`) VALUES
(1, 'Nigiri', 'N1', 'product-images/imagen1.jpg', 4.80, 'Atun, Aguacate, arroz, queso crema, salsa de la casa, cebolla , guasabi , caramelo , cilantro.'),
(2, 'futomaki', 'F1', 'product-images/imagen2.jpg', 9.50, 'Tempurizado de salmon , queso crema, aguacate, salsa de anguila, salsa de la casa , soja , miel.'),
(3, 'Salmon', 'S1', 'product-images/imagen3.jpg', 8.50, 'Salmon,  aguacate,  topping de salmon,  cebollin, guasabi , salsa de la casa , soja.'),
(4, 'Ebi Abocado', 'E1', 'product-images/imagen4.jpg', 8.50, 'Langostino rebozado, salmon,queso crema, aguacate,topping de aguacate con salsa tigger.'),
(5, 'Nella Roll', 'R1', 'product-images/imagen6.jpg', 11.00, 'Roll envuelto en arroz de sushi,queso crema, vegetales , aguacate, salmon, salsa de la casa.'),
(6, 'Brutal Roll', 'B1', 'product-images/imagen5.jpg', 11.00, 'Roll envuelto en arroz de sushi, queso crema, aguacate, salmon flameado, salsa.');

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
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pedido` (`id_cliente`,`id_producto`) USING BTREE;

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK de la tabla clientes, de tipo primary autoincremental.', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK de la tabla producto , de indice Primary , autoincremental.', AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
