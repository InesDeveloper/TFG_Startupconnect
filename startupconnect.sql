-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 07-05-2024 a las 12:01:28
-- Versión del servidor: 5.7.39
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `startupconnect`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Colaboraciones`
--

CREATE TABLE `Colaboraciones` (
  `Identificador` int(255) NOT NULL,
  `fk_Proyecto` int(11) NOT NULL,
  `fk_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Colaboraciones`
--

INSERT INTO `Colaboraciones` (`Identificador`, `fk_Proyecto`, `fk_Empresa`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Descartes`
--

CREATE TABLE `Descartes` (
  `Identificador` int(255) NOT NULL,
  `fk_Proyecto` int(255) NOT NULL,
  `fk_Empresa` int(255) NOT NULL,
  `Motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Descartes`
--

INSERT INTO `Descartes` (`Identificador`, `fk_Proyecto`, `fk_Empresa`, `Motivo`) VALUES
(1, 2, 1, 'Odio las criptomonedas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Empresas`
--

CREATE TABLE `Empresas` (
  `Identificador` int(255) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `CIF` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Empresas`
--

INSERT INTO `Empresas` (`Identificador`, `Nombre`, `CIF`, `Direccion`, `Telefono`, `Email`, `Contrasena`) VALUES
(1, 'Lanzadera', 'B98335227', 'Edificio Lanzadera, La Marina de, Carrer del Moll de la Duana, s/n, 46024 Valencia', '963568585', 'lanzadera@lanzadera.com', 'lanzadera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proyectos`
--

CREATE TABLE `Proyectos` (
  `Identificador` int(255) NOT NULL,
  `fk_Usuarios` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  `fk_sector` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Proyectos`
--

INSERT INTO `Proyectos` (`Identificador`, `fk_Usuarios`, `Nombre`, `Descripcion`, `fk_sector`) VALUES
(1, 2, 'Growntown Garden', 'Huertos urbanos descripción', 1),
(2, 2, 'Nueva criptomoneda', 'Criptomoneda que se usará como moneda bla bla bla especulación bla bla bla', 2),
(3, 1, 'Filtro de agua con nanorobots', 'Filtros de agua inteligentes con robots que eliminan las partículas nocivas.', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sector`
--

CREATE TABLE `Sector` (
  `Identificador` int(255) NOT NULL,
  `Tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Sector`
--

INSERT INTO `Sector` (`Identificador`, `Tipo`) VALUES
(1, 'dashboard_sectores_salud'),
(2, 'dashboard_sectores_tecnologia'),
(3, 'dashboard_sectores_otros'),
(4, 'dashboard_sectores_medioambiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `Identificador` int(255) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `DNI` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` varchar(255) NOT NULL,
  `Contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`Identificador`, `Nombre`, `Apellido`, `DNI`, `Email`, `Direccion`, `Telefono`, `Contrasena`) VALUES
(1, 'UsuarioTest', 'ApellidoTest', '12345678T', 'test@test.com', 'Calle Test 123 Ciudad', '123456789', 'test'),
(2, 'Ines', 'Sánchez', '81269895Q', 'efreya_sanchez@hotmail.com', 'Calle Falsa 123', '687456312', 'ines');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Colaboraciones`
--
ALTER TABLE `Colaboraciones`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `fk_colab_empresa` (`fk_Empresa`),
  ADD KEY `fk_colab_proyecto` (`fk_Proyecto`);

--
-- Indices de la tabla `Descartes`
--
ALTER TABLE `Descartes`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `fk_descartes_empresa` (`fk_Empresa`),
  ADD KEY `fk_descartes_proyecto` (`fk_Proyecto`);

--
-- Indices de la tabla `Empresas`
--
ALTER TABLE `Empresas`
  ADD PRIMARY KEY (`Identificador`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `Proyectos`
--
ALTER TABLE `Proyectos`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `fk_proyecto_sector` (`fk_sector`),
  ADD KEY `fk_proyecto_usuario` (`fk_Usuarios`);

--
-- Indices de la tabla `Sector`
--
ALTER TABLE `Sector`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`Identificador`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Colaboraciones`
--
ALTER TABLE `Colaboraciones`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Descartes`
--
ALTER TABLE `Descartes`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Empresas`
--
ALTER TABLE `Empresas`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Proyectos`
--
ALTER TABLE `Proyectos`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Sector`
--
ALTER TABLE `Sector`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Colaboraciones`
--
ALTER TABLE `Colaboraciones`
  ADD CONSTRAINT `fk_colab_empresa` FOREIGN KEY (`fk_Empresa`) REFERENCES `Empresas` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_colab_proyecto` FOREIGN KEY (`fk_Proyecto`) REFERENCES `Proyectos` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Descartes`
--
ALTER TABLE `Descartes`
  ADD CONSTRAINT `fk_descartes_empresa` FOREIGN KEY (`fk_Empresa`) REFERENCES `Empresas` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_descartes_proyecto` FOREIGN KEY (`fk_Proyecto`) REFERENCES `Proyectos` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Proyectos`
--
ALTER TABLE `Proyectos`
  ADD CONSTRAINT `fk_proyecto_sector` FOREIGN KEY (`fk_sector`) REFERENCES `Sector` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proyecto_usuario` FOREIGN KEY (`fk_Usuarios`) REFERENCES `Usuarios` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
