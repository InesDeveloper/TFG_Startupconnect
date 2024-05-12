-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 12-05-2024 a las 13:13:55
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
  `fk_Empresa` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `contactado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Colaboraciones`
--

INSERT INTO `Colaboraciones` (`Identificador`, `fk_Proyecto`, `fk_Empresa`, `fechaRegistro`, `contactado`) VALUES
(1, 1, 1, '2024-05-02 11:16:59', 1),
(2, 4, 1, '2024-05-12 10:42:51', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Descartes`
--

CREATE TABLE `Descartes` (
  `Identificador` int(255) NOT NULL,
  `fk_Proyecto` int(255) NOT NULL,
  `fk_Empresa` int(255) NOT NULL,
  `Motivo` varchar(255) NOT NULL,
  `fechaRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Descartes`
--

INSERT INTO `Descartes` (`Identificador`, `fk_Proyecto`, `fk_Empresa`, `Motivo`, `fechaRegistro`) VALUES
(1, 2, 1, 'Odio las criptomonedas', '2024-05-04 11:18:02'),
(2, 14, 1, 'No me gusta', '2024-05-12 10:45:18');

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
  `Contrasena` varchar(255) NOT NULL,
  `imagenPerfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Empresas`
--

INSERT INTO `Empresas` (`Identificador`, `Nombre`, `CIF`, `Direccion`, `Telefono`, `Email`, `Contrasena`, `imagenPerfil`) VALUES
(1, 'Lanzadera', 'B98335227', 'Edificio Lanzadera, La Marina de, Carrer del Moll de la Duana, s/n, 46024 Valencia', '963568585', 'lanzadera@lanzadera.com', 'lanzadera', '../assets/img/perfiles/empresa/1.png'),
(2, 'Wayra', 'B-86230562', 'C. de Valverde, 2, Centro, 28004 Madrid', '913796771', 'wayra@wayra.com', 'wayra', NULL),
(3, 'Conector Startup Accelerator', 'B66132788', ' Pça. de Pau Vila, 1, Ciutat Vella, 08003 Barcelona', '938 07 47 27', 'Conector_Startup_Accelerator@correo.com', 'conectorstartup', NULL),
(4, 'Plug and Play Spain', 'B98446487', 'Avinguda del Cardenal Benlloch, 67, El Pla del Real, 46021 València', '902 05 02 16', 'Plug_Play_Spain@correo.com', 'plugplay', NULL),
(5, 'Bbooster Ventures', 'A97586432', 'Travessia s/n 15 E Base 5, 46024 Valencia', '963 59 11 02', 'Bbooster_Ventures@correo.es', 'Bbooster', NULL),
(6, 'Startup Valencia', 'G98929110', 'C/ de Joan Verdeguer, 116, Poblats Marítims, 46024 València', '623 38 71 97', 'Startup_Valencia@correo.es', 'startupvalencia', NULL),
(7, 'Techstars Barcelona', 'B66179862', 'Carrer de Muntaner, 239, 08021 Barcelona', '932902400', 'Techstars_Barcelona@correo.com', 'techstars', NULL),
(8, 'IE Business School Incubator', 'A63265110', 'Calle de María de Molina, 31, Chamartín, 28006 Madrid', '915 68 96 00', 'Business_School_Incubator@correo.com', 'business', NULL),
(9, 'SeedRocket', 'G65046872', 'Talent Garden Barcelona, calle Ramon Turró, 169, A, 08005 Barcelona', '93 551 62 84', 'SeedRocket@correo.com', 'SeedRocket', NULL),
(10, 'Barcelona Activa', 'A58295296', 'C/ de la Llacuna, 162, Sant Martí, 08018 Barcelona', '900 533 175', 'Barcelona_Activa@correo.com', 'barcelonaactiva', NULL),
(11, 'Málaga TechPark', 'A29429990', 'Parque Tecnológico Campanillas, 29590 Málaga', '951 23 13 00', 'Malaga_TechPark@correo.com', 'techparkmalaga', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proyectos`
--

CREATE TABLE `Proyectos` (
  `Identificador` int(255) NOT NULL,
  `fk_Usuarios` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  `urlVideo` varchar(255) NOT NULL,
  `fk_sector` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Proyectos`
--

INSERT INTO `Proyectos` (`Identificador`, `fk_Usuarios`, `Nombre`, `Descripcion`, `urlVideo`, `fk_sector`) VALUES
(1, 2, 'Growntown Garden', 'Fomento de la biodiversidad\r\nAl cultivar plantas y flores en un huerto urbano, se puede crear un hábitat para una variedad de especies de insectos y animales, lo que contribuye a la biodiversidad local.', '', 4),
(2, 5, 'Criptomoneda QuantumCoin', 'Se basa en una red blockchain avanzada que utiliza un protocolo cuántico resistente a ataques, garantizando una seguridad de última generación contra las amenazas emergentes de la computación cuántica.', '', 2),
(3, 3, 'Filtro de agua con nanorobots', 'Es un dispositivo altamente avanzado de purificación de agua que utiliza tecnología de nanorobots. Son extremadamente pequeños, diseñados para moverse a través del agua y eliminar contaminantes a nivel molecular.', '', 4),
(4, 4, 'Fitness Gamificado', 'Combina tecnología de realidad aumentada (AR) con entrenamiento físico para crear una experiencia de ejercicio inmersiva y motivadora.', '', 1),
(5, 2, 'Rastreo de Huella de Carbono en Tiempo Real', 'Tecnología avanzada para monitorear y gestionar las emisiones de carbono de individuos y empresas. ', '', 4),
(6, 3, 'Teleconsulta Virtual Interactiva', 'La plataforma permitiría a los pacientes interactuar con médicos y especialistas en un entorno virtual tridimensional, simulando una visita presencial en un consultorio.', '', 1),
(7, 4, 'Gestión Inteligente del Hogar', 'Solución integral para automatizar y optimizar los sistemas de gestión del hogar a través de dispositivos IoT conectados, utilizando inteligencia artificial para mejorar la eficiencia energética, la seguridad y la comodidad.', '', 2),
(8, 6, 'Mercado Local en Línea', 'Facilita la compra y venta de productos alimenticios y artesanales directamente de productores locales a consumidores en la misma región, fomentando el comercio local y sostenible.', '', 8),
(9, 8, 'Aprendizaje Basado en Proyectos Virtuales', 'Conectar a estudiantes de todo el mundo para trabajar juntos en proyectos multidisciplinarios guiados por expertos.', '', 5),
(10, 9, 'Transporte Compartido para Viajes Largos', 'Facilitar el carpooling o compartir vehículo en rutas largas, haciendo los viajes más económicos y sostenibles.', '', 6),
(11, 10, 'Optimización de Logística de Última Milla', 'Se utilizan tecnología avanzada para gestionar y optimizar las rutas de entrega, coordinar con varios proveedores de transporte y ofrecer soluciones innovadoras para los desafíos logísticos de la última milla.', '', 6),
(12, 7, 'Comunicaciones Unificadas ', 'Soluciones integrales de comunicación y colaboración basadas en la nube que integran voz, video, mensajería, conferencias y compartición de archivos, todo en una sola plataforma accesible desde cualquier dispositivo', '', 9),
(14, 1, 'Test', 'test', 'https://youtu.be/g4HLJPSyJq8?si=DbCZ9J16nJqJvP-j', 5);

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
(4, 'dashboard_sectores_medioambiente'),
(5, 'dashboard_sectores_educacion'),
(6, 'dashboard_sectores_transporte'),
(7, 'dashboard_sectores_energia'),
(8, 'dashboard_sectores_consumo'),
(9, 'dashboard_sectores_comunicacion');

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
  `Contrasena` varchar(255) NOT NULL,
  `imagenPerfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`Identificador`, `Nombre`, `Apellido`, `DNI`, `Email`, `Direccion`, `Telefono`, `Contrasena`, `imagenPerfil`) VALUES
(1, 'UsuarioT', 'ApellidoTest', '12345678T', 'test@test.com', 'Calle Test 123 Ciudad', '123456789', 'test', '../assets/img/perfiles/usuario/1.png'),
(2, 'Ines', 'Sánchez', '81269895Q', 'efreya_sanchez@hotmail.com', 'Calle Falsa 123', '687456312', 'ines', '../assets/img/perfiles/usuario/2.png'),
(3, 'Marie ', 'Curie', '24950987N', 'MarieCurie@usuario.com', 'Enrique Granados, 6 28224 Pozuelo de Alarcón, Madrid', '654678888', 'mariecurie', '../assets/img/perfiles/usuario/3.png'),
(4, 'Luis', 'Mileto', '96862357L', 'mileto@usuario.com', 'calle mileto 28, Valencia', '611266544', 'mileto', '../assets/img/perfiles/usuario/4.png'),
(5, 'Eva', 'Domingo', '06394472N', 'evadomingo@usuario.es', 'calle fin de semana 2, Madrid', '677877978', 'evadomingo', '../assets/img/perfiles/usuario/5.png'),
(6, 'Clara', 'López', '56034789D', 'clara@usuario.com', 'Calle Príncipe, 33, 36202 Vigo', '621456789', 'clara', '../assets/img/perfiles/usuario/6.png'),
(7, 'Luisa', 'Martin', '28905678P', 'luisa@usuario.com', 'Calle Gran Vía, 45, 28013 Madrid', '612345678', 'luisa', NULL),
(8, 'Álvaro', 'Torres', '25134960F', 'alvaro@usuario.com', 'Calle San Juan, 22, 03002 Alicante', '677890321', 'Alvaro', NULL),
(9, 'Lucas', 'Navarro', '49381756K', 'Lucas@usuario.com', 'Avenida de América, 15, 28002 Madrid', '665738294', 'lucas', NULL),
(10, 'Sara', 'García', '31856247E', 'saragarcia@usuario.com', 'Calle de la Estación, 12, 50004 Zaragoza', '673825098', 'sara', NULL);

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
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Descartes`
--
ALTER TABLE `Descartes`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Empresas`
--
ALTER TABLE `Empresas`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `Proyectos`
--
ALTER TABLE `Proyectos`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `Sector`
--
ALTER TABLE `Sector`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
