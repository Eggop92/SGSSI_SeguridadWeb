-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2013 a las 22:26:21
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `seguridad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `idnoticia` int(11) NOT NULL DEFAULT '0',
  `noticia` varchar(600) DEFAULT NULL,
  `usr` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idnoticia`),
  KEY `usr` (`usr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idnoticia`, `noticia`, `usr`) VALUES
(1, 'Se inaugura la pagina de noticias de Egoitz y Jon Ander', 'jon'),
(2, 'Se ha demostrado que 5 de cada 10 expertos son la mitad', 'jon'),
(4, 'Ego se ha unido a la pagina', 'ego');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` varchar(30) NOT NULL DEFAULT '',
  `passw` varchar(45) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `passw`, `nombre`, `email`) VALUES
('ego', '37349f07c95879abf625e8e7ae56170c', 'ego', 'ego@lalala.com'),
('jon', '006cb570acdab0e0bfc8e3dcb7bb4edf', 'Jon Ander', 'jafontan002@ikasle.ehu.es');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`usr`) REFERENCES `usuarios` (`idUsuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
