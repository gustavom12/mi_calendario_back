-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-09-2021 a las 03:13:35
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id17517886_calendario`
--
CREATE DATABASE IF NOT EXISTS `id17517886_calendario` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id17517886_calendario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_categorias`
--

CREATE TABLE `configuracion_categorias` (
  `CategoriaId` int(11) NOT NULL,
  `NegocioId` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `duracion_minutos` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL,
  `costo` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion_categorias`
--

INSERT INTO `configuracion_categorias` (`CategoriaId`, `NegocioId`, `nombre`, `duracion_minutos`, `estado`, `costo`) VALUES
(4, 1, 'Corte de barba', 20, 'activo', 500.00),
(5, 1, 'Corte de pelo', 40, 'activo', 800.00),
(6, 1, 'Corte de pelo y barba', 60, 'activo', 1200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_especifica`
--

CREATE TABLE `configuracion_especifica` (
  `fecha` varchar(11) NOT NULL,
  `id` int(11) NOT NULL,
  `desde` time NOT NULL,
  `hasta` time NOT NULL,
  `desde_1` time NOT NULL,
  `hasta_1` time NOT NULL,
  `dia` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion_especifica`
--

INSERT INTO `configuracion_especifica` (`fecha`, `id`, `desde`, `hasta`, `desde_1`, `hasta_1`, `dia`) VALUES
('2021-09-02', 1, '09:00:00', '13:00:00', '14:00:00', '16:00:00', NULL),
('2021-09-04', 3, '00:00:00', '00:00:00', '00:00:00', '00:00:00', NULL),
('2021-09-03', 6, '08:00:00', '13:00:00', '14:00:00', '18:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_turnos`
--

CREATE TABLE `configuracion_turnos` (
  `ConfiguracionId` int(11) NOT NULL,
  `NegocioId` int(11) DEFAULT NULL,
  `dia` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `desde` time NOT NULL,
  `hasta` time NOT NULL,
  `desde_1` time NOT NULL,
  `hasta_1` time NOT NULL,
  `intervalo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion_turnos`
--

INSERT INTO `configuracion_turnos` (`ConfiguracionId`, `NegocioId`, `dia`, `nombre`, `desde`, `hasta`, `desde_1`, `hasta_1`, `intervalo`) VALUES
(169, NULL, 1, 'Lunes', '10:00:00', '20:00:00', '00:00:00', '00:00:00', 15),
(170, NULL, 2, 'Martes', '09:00:00', '13:00:00', '14:00:00', '18:00:00', 15),
(171, NULL, 3, 'Miercoles', '09:00:00', '13:00:00', '00:00:00', '00:00:00', 15),
(172, NULL, 4, 'Jueves', '09:00:00', '13:00:00', '14:00:00', '16:00:00', 15),
(173, NULL, 5, 'Viernes', '08:00:00', '13:00:00', '14:00:00', '18:00:00', 15),
(174, NULL, 6, 'Sabado', '09:00:00', '13:00:00', '00:00:00', '00:00:00', 15),
(175, NULL, 7, 'Domingo', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `NegocioId` int(11) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `localidad` varchar(250) DEFAULT NULL,
  `provincia` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) NOT NULL,
  `foto_1` varchar(250) DEFAULT NULL,
  `foto_2` varchar(250) DEFAULT NULL,
  `foto_3` varchar(250) DEFAULT NULL,
  `estado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `RoleId` int(11) NOT NULL,
  `Descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `TurnoId` int(11) NOT NULL,
  `NegocioId` int(11) NOT NULL,
  `UsuarioId` int(11) DEFAULT NULL,
  `dia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `nombre_usuario` varchar(250) NOT NULL,
  `nombre_negocio` varchar(250) NOT NULL,
  `duracion_minutos` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `categoria` varchar(40) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`TurnoId`, `NegocioId`, `UsuarioId`, `dia`, `fecha`, `hora`, `nombre_usuario`, `nombre_negocio`, `duracion_minutos`, `precio`, `categoria`, `telefono`, `email`) VALUES
(13, 1, 0, 1, '2021-08-30', '00:00:10', 'dwdawa daw', 'nombre', 30, 0, 'Primer clase de inglés', '', 'gustavo.n.mercado2@gmail.com'),
(14, 1, NULL, 1, '2021-08-30', '10:30:00', 'dwdawa daw', 'nombre', 30, 0, 'Primer clase de inglés', '', 'gustavo.n.mercado2@gmail.com'),
(15, 1, NULL, 1, '2021-08-30', '00:00:10', 'dwdawa daw', 'nombre', 30, 0, 'Primer clase de inglés', '', 'gustavo.n.mercado2@gmail.com'),
(16, 1, NULL, 2, '2021-08-31', '10:00:00', 'aw dwawad', 'nombre', 30, 0, 'Primer clase de inglés', '', 'gustavo.n.mercado2@gmail.com'),
(17, 1, NULL, 2, '2021-08-31', '09:00:00', 'Nombre Completo', 'nombre', 30, 0, 'Primer clase de inglés', '', 'gustavo.n.mercado2@gmail.com'),
(18, 1, NULL, 2, '2021-08-31', '09:00:00', 'Nombre Completo', 'nombre', 30, 0, 'Primer clase de inglés', '', 'gustavo.n.mercado2@gmail.com'),
(19, 1, NULL, 2, '2021-08-31', '11:30:00', 'Gustavo Mercado', 'nombre', 30, 0, 'Primer clase de inglés', '2994107678', 'gustavo.n.mercado2@gmail.com'),
(20, 1, NULL, 2, '2021-08-31', '11:30:00', 'Gustavo Mercado', 'nombre', 30, 0, 'Primer clase de inglés', '2994107678', 'gustavo.n.mercado2@gmail.com'),
(21, 1, NULL, 3, '2021-09-01', '10:30:00', 'Gustavo Mercado', 'nombre', 30, 0, 'Primer clase de inglés', '2994107678', 'gustavo.n.mercado2@gmail.com'),
(22, 1, NULL, 3, '2021-09-01', '09:30:00', 'Gustavo Mercado', 'nombre', 30, 0, 'Primer clase de inglés', '2994107678', 'gustavo.n.mercado2@gmail.com'),
(23, 1, NULL, 4, '2021-09-02', '10:00:00', 'Gustavo Mercado', 'nombre', 60, 1200, 'Corte de pelo y barba', '2994107678', 'gustavo.n.mercado2@gmail.com'),
(24, 1, NULL, 4, '2021-09-02', '14:40:00', 'Gustavo Mercado', 'nombre', 40, 800, 'Corte de pelo', '2994107678', 'gustavo.n.mercado2@gmail.com'),
(25, 1, NULL, 3, '2021-09-08', '09:00:00', 'edgar ', 'nombre', 40, 800, 'Corte de pelo', '', 'prueba@gmail.com'),
(26, 1, NULL, 1, '2021-09-06', '11:00:00', 'User prueba', 'nombre', 60, 1200, 'Corte de pelo y barba', 'aaaaaaa', 'keiracony@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuarioId` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `RoleId` int(11) DEFAULT NULL,
  `selfie` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion_categorias`
--
ALTER TABLE `configuracion_categorias`
  ADD PRIMARY KEY (`CategoriaId`);

--
-- Indices de la tabla `configuracion_especifica`
--
ALTER TABLE `configuracion_especifica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion_turnos`
--
ALTER TABLE `configuracion_turnos`
  ADD PRIMARY KEY (`ConfiguracionId`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`NegocioId`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`TurnoId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuarioId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion_categorias`
--
ALTER TABLE `configuracion_categorias`
  MODIFY `CategoriaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `configuracion_especifica`
--
ALTER TABLE `configuracion_especifica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `configuracion_turnos`
--
ALTER TABLE `configuracion_turnos`
  MODIFY `ConfiguracionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `NegocioId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `TurnoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UsuarioId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
