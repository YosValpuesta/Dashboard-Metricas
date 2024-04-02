-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2024 a las 07:37:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dashboard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hu`
--

CREATE TABLE `hu` (
  `numeroHU` int(3) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `PH` int(3) NOT NULL,
  `Responsable` varchar(20) DEFAULT NULL,
  `FechaCreacion` varchar(30) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `Sprint` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hu`
--

INSERT INTO `hu` (`numeroHU`, `Nombre`, `PH`, `Responsable`, `FechaCreacion`, `Estado`, `Sprint`) VALUES
(25, 'CRUD Usuarios', 13, 'YosValpuesta', '11-03-2024', 'Backlog', 1),
(26, 'CRUD Productos', 8, 'YosValpuesta', '11-03-2024', 'Backlog', 1),
(27, 'Login', 1, 'DianaSev', '11-03-2024', 'Backlog', 1),
(28, 'sswwww', 1, 'Juanito', '01-04-2024', 'Backlog', 1),
(29, 'sdfdcede', 1, 'admin', '01-04-2024', 'Backlog', 1),
(30, 'Registro', 1, 'DianaSev', '11-03-2024', 'Backlog', 1),
(31, 'd', 1, 'admin', '01-04-2024', 'Backlog', 1),
(32, 'jkj', 1, 'admin', '01-04-2024', 'Backlog', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hu_tablero`
--

CREATE TABLE `hu_tablero` (
  `numeroHU` int(3) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `puntos` int(3) DEFAULT NULL,
  `responsable` varchar(20) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `Sprint` int(2) NOT NULL,
  `FechaAgregada` date DEFAULT NULL,
  `FechaIniciada` date DEFAULT NULL,
  `FechaTerminada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hu_tablero`
--

INSERT INTO `hu_tablero` (`numeroHU`, `nombre`, `puntos`, `responsable`, `estado`, `Sprint`, `FechaAgregada`, `FechaIniciada`, `FechaTerminada`) VALUES
(25, 'CRUD Usuarios', 13, 'YosValpuesta', 'Terminada', 1, '2024-03-11', '2024-03-13', '2024-03-15'),
(26, 'CRUD Productos', 8, 'YosValpuesta', 'Terminada', 1, '2024-03-11', '2024-03-11', '2024-03-16'),
(27, 'Login', 1, 'DianaSev', 'Terminada', 1, '2024-03-11', '2024-03-12', '2024-03-13'),
(28, 'sswwww', 1, 'Juanito', 'Terminada', 1, '2024-03-12', '2024-03-13', '2024-03-15'),
(29, 'sdfdcede', 1, 'admin', 'Por Hacer', 1, '2024-03-12', '2024-03-12', '2024-03-14'),
(30, 'Registro', 1, 'DianaSev', 'Por Hacer', 1, '2024-03-11', '2024-03-12', '2024-03-13'),
(31, 'd', 1, 'admin', 'Por Hacer', 1, '2024-03-13', '2024-03-13', '2024-03-15'),
(32, 'jkj', 1, 'admin', 'Por Hacer', 1, '2024-03-13', '2024-03-14', '2024-03-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metricawip`
--

CREATE TABLE `metricawip` (
  `idWIP` int(2) NOT NULL,
  `valorPorHacer` int(3) DEFAULT NULL,
  `valorHaciendo` int(3) DEFAULT NULL,
  `valorTerminado` int(3) DEFAULT NULL,
  `proyectoNombre` varchar(40) NOT NULL,
  `Sprint` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metricawip`
--

INSERT INTO `metricawip` (`idWIP`, `valorPorHacer`, `valorHaciendo`, `valorTerminado`, `proyectoNombre`, `Sprint`) VALUES
(6, 4, 2, 3, 'Nutripulp', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablero`
--

CREATE TABLE `tablero` (
  `Nombre` varchar(40) NOT NULL,
  `TotalSprint` int(2) NOT NULL,
  `DuracionSprint` int(2) NOT NULL,
  `Duracion` varchar(20) NOT NULL,
  `Desarrolladores` int(2) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tablero`
--

INSERT INTO `tablero` (`Nombre`, `TotalSprint`, `DuracionSprint`, `Duracion`, `Desarrolladores`, `FechaInicio`, `FechaFin`) VALUES
('Nutripulp', 5, 5, 'Días', 3, '2024-03-11', '2024-04-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(20) NOT NULL,
  `Nombre` varchar(40) DEFAULT NULL,
  `Apellido` varchar(40) DEFAULT NULL,
  `Correo` varchar(40) NOT NULL,
  `Contraseña` varchar(15) NOT NULL,
  `Rol` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Nombre`, `Apellido`, `Correo`, `Contraseña`, `Rol`) VALUES
('DianaSev', 'Diana', 'Sevilla Perez', 'diana14@gmail.com', 'uacm123', 'Desarrollador'),
('Jorge-Scrum', 'Jorge', 'Hernández Ortiz', 'jorHer@gmail.com', 'uacm124', 'Diseñador'),
('JuanitoCruz', 'Juan', 'Flores Cruz', 'juan.98@gmail.com', 'uacm123', 'Desarrollador'),
('YosValpuesta', 'Yoselin', 'Valpuesta', 'yose.valpuesta@gmail.com', 'uacm123', 'Desarrollador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hu`
--
ALTER TABLE `hu`
  ADD PRIMARY KEY (`numeroHU`);

--
-- Indices de la tabla `hu_tablero`
--
ALTER TABLE `hu_tablero`
  ADD PRIMARY KEY (`numeroHU`);

--
-- Indices de la tabla `metricawip`
--
ALTER TABLE `metricawip`
  ADD PRIMARY KEY (`idWIP`),
  ADD KEY `proyectoNombre` (`proyectoNombre`);

--
-- Indices de la tabla `tablero`
--
ALTER TABLE `tablero`
  ADD PRIMARY KEY (`Nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hu`
--
ALTER TABLE `hu`
  MODIFY `numeroHU` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `metricawip`
--
ALTER TABLE `metricawip`
  MODIFY `idWIP` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `metricawip`
--
ALTER TABLE `metricawip`
  ADD CONSTRAINT `metricawip_ibfk_1` FOREIGN KEY (`proyectoNombre`) REFERENCES `tablero` (`Nombre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
