-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2023 a las 21:56:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `semestral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` varchar(50) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `rol` text NOT NULL DEFAULT 'administrador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `nombre`, `apellido`, `usuario`, `correo`, `contrasena`, `rol`) VALUES
('c5152d8a6d3a7d33f0a4574f73a1e5dc', 'Gabo', 'mar', 'gab1234', 'gab@gmail.com', '123456', 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` varchar(50) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `rol` text NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `usuario`, `correo`, `contrasena`, `rol`) VALUES
('42ee533715daf69dcd356bfdf51eb491', 'Eric ', 'Bethancourt', 'yeric', 'yeric@gmail.com', '123456', 'cliente'),
('70710431973b9f7b661199e32b5ed9b8', 'Yissel', 'Martinez', 'yissel25', 'yissel@gmail.com', '12345', 'cliente'),
('deb7474835b4fc20718ce45abb10c3ec', 'Gabo', 'Martinez', 'gab123', 'gab@gmail.com', '123456', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` varchar(50) DEFAULT NULL,
  `id_producto` varchar(50) DEFAULT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `id_producto`, `fecha_pedido`, `cantidad`) VALUES
(14, 'deb7474835b4fc20718ce45abb10c3ec', '20452f5dea2d13a05cae9fc70b64d543', '2023-12-04 06:11:27', 1),
(15, 'deb7474835b4fc20718ce45abb10c3ec', '36fa515bb296d7fde5c1a47cf3869672', '2023-12-04 06:11:27', 1),
(16, 'deb7474835b4fc20718ce45abb10c3ec', '877a334af841684c0b0efeffeb5303c2', '2023-12-04 06:11:27', 1),
(17, 'deb7474835b4fc20718ce45abb10c3ec', '20452f5dea2d13a05cae9fc70b64d543', '2023-12-04 06:13:46', 1),
(18, 'deb7474835b4fc20718ce45abb10c3ec', '20452f5dea2d13a05cae9fc70b64d543', '2023-12-04 06:15:05', 1),
(19, '70710431973b9f7b661199e32b5ed9b8', '20452f5dea2d13a05cae9fc70b64d543', '2023-12-06 18:36:43', 1),
(20, '42ee533715daf69dcd356bfdf51eb491', '4eae8bfdba8b244252f427f395398d3d', '2023-12-06 19:01:02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` varchar(50) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `precio` float NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `marca` text NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `rutaImagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `modelo`, `marca`, `categoria`, `rutaImagen`) VALUES
('6575a8ba2fd84', 'Sundial', 130.5, 'Dunk Low', 'Nike', 'hombre', 'img/image 8.png'),
('657741ee40276', 'Low 86', 125.23, 'Rivarley', 'Adidas', 'hombre', 'img/8a4a5e2a-bd8d-40cb-80ca-486cdbfa7c07.png'),
('6577422845814', 'Rayo Macqueen', 50.9, 'Classic', 'Crocs', 'hombre', 'img/mcqueen.png'),
('657742c8acb55', 'Dusty Olive', 110.29, 'Dunk Low', 'Nike', 'hombre', 'img/verde.png'),
('657742f9a1c26', 'El Paso', 168.9, 'BB', 'Adidas', 'hombre', 'img/el paso.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
