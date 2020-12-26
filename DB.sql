-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-12-2020 a las 07:01:09
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `TFSOTR`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `idAula` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `sede` varchar(255) DEFAULT NULL,
  `tipo` enum('TEO','LAB','COM') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`idAula`, `nombre`, `sede`, `tipo`) VALUES
(1, 'A-11', 'MO', 'TEO'),
(2, 'C-51', 'MO', 'LAB'),
(3, 'C-52', 'MO', 'LAB'),
(4, 'C-54', 'MO', 'LAB'),
(5, 'C-55', 'MO', 'LAB'),
(6, 'C-56', 'MO', 'LAB'),
(7, 'SB-306', 'SM', 'LAB'),
(8, 'SB-305', 'SM', 'LAB'),
(9, 'SB-301', 'SM', 'LAB'),
(10, 'SB-601', 'SM', 'LAB'),
(11, 'SB-503', 'SM', 'LAB'),
(12, 'VH-101', 'VL', 'LAB'),
(13, 'SA-101', 'SM', 'LAB'),
(14, 'C-51', 'MO', 'COM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `codCurso` varchar(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ciclo` int(11) DEFAULT NULL,
  `horasTeoria` int(11) DEFAULT NULL,
  `horasLaboratorio` int(11) DEFAULT NULL,
  `grupos` int(11) DEFAULT NULL,
  `carrera` enum('ELEC','MECA','INDU','CIEN') DEFAULT NULL,
  `creditos` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `uActualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`codCurso`, `nombre`, `ciclo`, `horasTeoria`, `horasLaboratorio`, `grupos`, `carrera`, `creditos`, `activo`, `uActualizacion`) VALUES
('EL109', 'Robótica e Inteligencia Artificial', 9, 3, 3, 0, 'ELEC', 4, 1, '2020-12-01 21:46:59'),
('EL117', 'Tecnologías de Fabricación y Manufactura', 3, 3, 3, 2, 'MECA', 3, 1, '2020-12-01 21:48:39'),
('EL172', 'Programación de Computadoras', 4, 3, 1, 0, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL174', 'Microcontroladores', 5, 3, 3, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL184', 'Programación Avanzada de Computadoras', 6, 2, 3, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL186', 'Sensores y Actuadores', 8, 3, 1, 0, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL190', 'Redes de Comunicaciones 1', 3, 3, 2, 1, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL204', 'Electrónica de Potencia', 9, 2, 2, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL208', 'Comunicaciones Móviles', 10, 2, 0, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL217', 'Ingeniería de Comunicaciones', 7, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL218', 'Ingeniería de Control 1 ', 6, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL222', 'Procesamiento Digital de Señales', 7, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL226', 'Sistemas Operativos en Tiempo Real', 9, 2, 2, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL227', 'Software para Ingeniería', 2, 2, 1, 1, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL228', 'Procesamiento Avanzado de Señales e Imágenes', 8, 4, 0, 0, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL229', 'Redes de Comunicaciones 2', 6, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL230', 'Electromagnetismo', 6, 4, 0, 0, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL231', 'Señales y Sistemas ', 6, 4, 0, 0, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL232', 'Máquinas Eléctricas', 7, 2, 2, 2, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL233', 'Diseño de Circuitos Electrónicos', 7, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL234', 'Sistemas Embebidos', 8, 3, 2, 0, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL23444', 'Nuevo', 4, 2, 1, 2, 'MECA', 2, 1, '2020-12-02 20:29:51'),
('EL235', 'Gestión de Proyectos de Ingeniería', 7, 3, 0, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL236', 'Proyecto Electrónico 1', 9, 2, 4, 0, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL237', 'Proyecto Electrónico 2', 10, 2, 4, 0, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL240', 'Comunicaciones Ópticas', 10, 3, 0, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL242', 'Redes de Banda Ancha e Internet', 8, 2, 2, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL243', 'Análisis de Circuitos Eléctricos 1', 4, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL244', 'Análisis de Circuitos Eléctricos 2', 5, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL245', 'Circuitos Lógicos Digitales', 3, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL246', 'Dispositivos y Circuitos Analógicos', 5, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL247', 'Electrónica Industrial', 8, 2, 2, 2, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL248', 'Ingeniería de Control 2', 7, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL249', 'Introducción a la Electrónica', 1, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL251', 'Sensores y Actuadores', 6, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL252', 'Sistemas de Automatización Industrial', 9, 2, 2, 2, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('EL253', 'Sistemas Digitales', 4, 3, 2, 2, 'ELEC', 4, 1, '2020-09-30 16:14:21'),
('EL66', 'No se', 2, 2, 2, 2, 'MECA', 2, 1, '2020-12-01 21:23:16'),
('EL888', 'Otro', 2, 2, 2, 2, 'ELEC', 3, 1, '2020-12-01 21:25:02'),
('IN134', 'Gestión Energética', 8, 3, 2, 2, 'INDU', 4, 1, '2020-09-30 16:14:21'),
('IN397', 'Seminario de Investigación Académica 2', 8, 3, 0, 0, 'INDU', 3, 1, '2020-09-30 16:14:21'),
('MA444', 'Estadística', 3, 4, 0, 0, 'CIEN', 4, 1, '2020-09-30 16:14:21'),
('MA462', 'Física 2', 4, 5, 0, 0, 'CIEN', 6, 1, '2020-09-30 16:14:21'),
('MA463', 'Matemática Analítica 4', 4, 4, 0, 0, 'CIEN', 5, 1, '2020-09-30 16:14:21'),
('MA466', 'Física 1', 3, 3, 0, 0, 'CIEN', 4, 1, '2020-09-30 16:14:21'),
('MA471', 'Bioingeniería', 7, 3, 0, 0, 'CIEN', 3, 1, '2020-09-30 16:14:21'),
('MA641', 'Física 3', 5, 5, 2, 0, 'CIEN', 6, 1, '2020-09-30 16:14:21'),
('MA654', 'Matemática Analítica 3', 3, 4, 0, 0, 'CIEN', 5, 1, '2020-09-30 16:14:21'),
('MA655', 'Matemática Analítica 5', 5, 4, 0, 0, 'CIEN', 5, 1, '2020-09-30 16:14:21'),
('MC18', 'Manufactura Integrada por Computadora', 9, 2, 3, 2, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC31', 'Proyecto Mecatrónico 1', 9, 2, 4, 0, 'MECA', 4, 1, '2020-09-30 16:14:21'),
('MC32', 'Robótica Industrial', 10, 2, 0, 3, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC33', 'Ingeniería de Control 3', 8, 2, 2, 0, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC34', 'Mandos Neumáticos e Hidráulicos', 9, 2, 2, 2, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC35', 'Diseño de Máquinas Automáticas', 9, 2, 2, 0, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC36', 'Mecatrónica Aplicada al Gas Natural', 9, 2, 2, 0, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC37', 'Sistemas Scada y DCS', 10, 2, 2, 2, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC38', 'Redes Industriales', 8, 2, 2, 2, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC39', 'Control de Procesos', 8, 2, 2, 2, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('MC40', 'Introducción a la Mecatrónica', 1, 3, 2, 2, 'MECA', 4, 1, '2020-09-30 16:14:21'),
('MC41', 'Proyecto Mecatrónico 2', 10, 2, 4, 0, 'MECA', 4, 1, '2020-09-30 16:14:21'),
('MC42', 'Sistemas CAD/CAM', 8, 2, 2, 3, 'MECA', 3, 1, '2020-09-30 16:14:21'),
('TE19', 'Sistemas de Comunicaciones', 8, 2, 2, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21'),
('TE51', 'Radiopropagación y Antenas', 8, 3, 0, 0, 'ELEC', 3, 1, '2020-09-30 16:14:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `idDocente` int(11) DEFAULT NULL,
  `semestre` varchar(255) DEFAULT NULL,
  `campus` enum('MO','SM','VL','MO-SM','TODOS') DEFAULT NULL,
  `diaHora` varchar(255) DEFAULT NULL,
  `uActualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`idDocente`, `semestre`, `campus`, `diaHora`, `uActualizacion`) VALUES
(3333, '2020-2', 'SM', '0-7', '2020-12-02 14:28:21'),
(3333, '2020-2', 'MO', '0-8', '2020-12-02 14:28:21'),
(3333, '2020-2', 'SM', '2-8', '2020-12-02 14:28:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `idDocente` int(11) NOT NULL,
  `id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `apellidoP` varchar(255) DEFAULT NULL,
  `apellidoM` varchar(255) DEFAULT NULL,
  `carrera` varchar(255) DEFAULT NULL,
  `contrato` varchar(255) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  `horasMax` int(11) DEFAULT NULL,
  `horasMin` int(11) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `fotoLink` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`idDocente`, `id`, `name`, `apellidoP`, `apellidoM`, `carrera`, `contrato`, `habilitado`, `horasMax`, `horasMin`, `correo`, `fotoLink`) VALUES
(2222, 'MHO7gGjfQ1WNjpd5uklcvVTFUYq2', 'Sergio', 'Salas', 'Arriarán', 'Ingeniería Electrónica', 'Staff', 1, 40, 4, 'sergio.salas@upc.pe', NULL),
(3333, 'swZO74FRnKYiomfQCyDla37m9qt2', 'Jose', 'Kalun', 'Lau', 'elec', 'dictante', 1, 12, 2, 'kalun.lau@upc.pe', NULL),
(3423, 'v8Q4sqt1HsXpVYWx8dNLCSU7dcR2', 'Jose', 'baltazar', 'M', 'elec', 'staff', 0, 12, 12, 'balta@upc.edu.pe', NULL),
(4444, 'z8kUqBf4cqer0Lsoz3A3JwAMm8A3', 'Juan Andres', 'Rodriguez', 'Canahuire', 'elec', 'staff', 1, 25, 20, 'u201726246@upc.edu.pe', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `codCurso` varchar(255) DEFAULT NULL,
  `idDocente` int(11) DEFAULT NULL,
  `seccion` varchar(255) DEFAULT NULL,
  `tipoSesion` enum('TEO','LAB') DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `horaInicio` int(11) DEFAULT NULL,
  `horaFin` int(11) DEFAULT NULL,
  `idAula` int(11) DEFAULT NULL,
  `grupo` int(11) DEFAULT NULL,
  `estado` enum('Abierto','Cerrado') DEFAULT NULL,
  `vacantes` int(11) DEFAULT NULL,
  `semestre` varchar(255) DEFAULT NULL,
  `uActualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `codCurso`, `idDocente`, `seccion`, `tipoSesion`, `dia`, `horaInicio`, `horaFin`, `idAula`, `grupo`, `estado`, `vacantes`, `semestre`, `uActualizacion`) VALUES
(37, 'EL117', 2222, 'EL128', 'TEO', 1, 16, 19, 1, 0, 'Abierto', 20, '2020-2', '2020-12-02 20:20:53'),
(38, 'EL117', 2222, 'EL128', 'LAB', 0, 7, 10, 3, 1, 'Abierto', 20, '2020-2', '2020-12-02 20:20:53'),
(39, 'EL204', 2222, 'EL24', 'TEO', 1, 16, 18, 1, 0, 'Abierto', 20, '2020-2', '2020-12-02 20:23:36'),
(40, 'EL204', 2222, 'EL24', 'LAB', 0, 7, 9, 8, 1, 'Abierto', 20, '2020-2', '2020-12-02 20:23:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `last_access` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `accesos` int(11) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `last_access`, `accesos`, `isAdmin`) VALUES
('MHO7gGjfQ1WNjpd5uklcvVTFUYq2', '2020-12-26 05:59:18', 57, 1),
('swZO74FRnKYiomfQCyDla37m9qt2', '2020-12-26 05:37:36', 53, 0),
('v8Q4sqt1HsXpVYWx8dNLCSU7dcR2', '2020-12-02 12:38:30', 0, 0),
('z8kUqBf4cqer0Lsoz3A3JwAMm8A3', '2020-12-26 05:58:55', 10, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`idAula`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codCurso`);

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD KEY `idDocente` (`idDocente`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`idDocente`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codCurso` (`codCurso`),
  ADD KEY `idDocente` (`idDocente`),
  ADD KEY `idAula` (`idAula`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD CONSTRAINT `disponibilidad_ibfk_1` FOREIGN KEY (`idDocente`) REFERENCES `docentes` (`idDocente`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`codCurso`) REFERENCES `cursos` (`codCurso`),
  ADD CONSTRAINT `horarios_ibfk_2` FOREIGN KEY (`idDocente`) REFERENCES `docentes` (`idDocente`),
  ADD CONSTRAINT `horarios_ibfk_3` FOREIGN KEY (`idAula`) REFERENCES `aulas` (`idAula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
