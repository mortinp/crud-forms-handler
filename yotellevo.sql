-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-05-2014 a las 19:50:16
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yotellevo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `max_people_count` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `has_modern_car` tinyint(1) NOT NULL,
  `has_air_conditioner` tinyint(1) NOT NULL,
  `contact_name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `drivers`
--

INSERT INTO `drivers` (`id`, `username`, `password`, `max_people_count`, `active`, `has_modern_car`, `has_air_conditioner`, `contact_name`) VALUES
(7, 'eduartd@nauta.cu', 'b074e2f38af8d33d8026b4facf2a6bfc03e4f77f', 4, 0, 0, 0, 'Ernesto (Moskovich)'),
(8, 'wary@dps.grm.sld.cu', 'f1ed9dc220787b7570dd4bf76f0b29205e55562a', 4, 0, 1, 1, 'Wary'),
(9, 'rricardo@grm.desoft.cu', '2773b7ee46895cf2b2f38fcb80f1403c1f136ec0', 4, 0, 1, 0, 'Nello'),
(11, 'mproenza@grm.desoft.cu', '60dd56fce363a2e493ae60bfdc64a9dffb0b227b', 4, 1, 1, 1, 'Martín'),
(12, 'yoelt@nauta.cu', 'afbffb5f53e46c239e221925ba7871773fd67c9f', 4, 0, 1, 1, 'Yoel Toledano (El pollo)'),
(13, 'cl8ff@frcuba.co.cu', '6c4279ec98f5799eacc782d98f86b739ab1b7b06', 4, 0, 0, 0, 'Paqui (Moskovich Aleco)'),
(14, 'Kevin.pellicer@nauta.cu', '4ff9d19ef18919fdf95eb1eca65467093de8bd70', 4, 0, 0, 0, 'Alberto Pellicer Rodríguez (43-1536, 52569900)'),
(16, 'sanchez@granma.copextel.com.cu', 'a21149656d0c0d11fcc75aedada815879b445a1d', 4, 0, 1, 1, 'José A. Sánchez (El médico) (Renault SM3)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `driver_localities`
--

DROP TABLE IF EXISTS `driver_localities`;
CREATE TABLE IF NOT EXISTS `driver_localities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` bigint(20) unsigned NOT NULL,
  `locality_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `driver_localities_driver_fk` (`driver_id`),
  KEY `driver_localities_locality_fk` (`locality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `driver_localities`
--

INSERT INTO `driver_localities` (`id`, `driver_id`, `locality_id`) VALUES
(12, 7, 1),
(13, 7, 2),
(14, 7, 3),
(15, 7, 4),
(20, 8, 1),
(21, 8, 2),
(22, 8, 3),
(23, 8, 4),
(24, 9, 1),
(25, 9, 2),
(26, 9, 3),
(27, 9, 4),
(28, 11, 1),
(29, 11, 2),
(30, 11, 3),
(31, 11, 4),
(32, 12, 1),
(33, 12, 2),
(34, 12, 3),
(35, 12, 4),
(36, 13, 1),
(37, 13, 2),
(38, 13, 3),
(39, 13, 4),
(41, 16, 1),
(42, 16, 2),
(43, 16, 3),
(44, 16, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_queue`
--

DROP TABLE IF EXISTS `email_queue`;
CREATE TABLE IF NOT EXISTS `email_queue` (
  `id` char(36) CHARACTER SET ascii NOT NULL,
  `to` varchar(129) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `config` varchar(30) NOT NULL,
  `template` varchar(50) NOT NULL,
  `layout` varchar(50) NOT NULL,
  `format` varchar(5) NOT NULL,
  `template_vars` text NOT NULL,
  `sent` tinyint(1) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `send_tries` int(2) NOT NULL,
  `send_at` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localities`
--

DROP TABLE IF EXISTS `localities`;
CREATE TABLE IF NOT EXISTS `localities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `province_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `localities_province_fk` (`province_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `localities`
--

INSERT INTO `localities` (`id`, `name`, `province_id`) VALUES
(1, 'Bayamo', 1),
(2, 'Manzanillo', 1),
(3, 'Guisa', 1),
(4, 'Jiguaní', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pending_users`
--

DROP TABLE IF EXISTS `pending_users`;
CREATE TABLE IF NOT EXISTS `pending_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `activation_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'Granma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `travels`
--

DROP TABLE IF EXISTS `travels`;
CREATE TABLE IF NOT EXISTS `travels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `locality_id` bigint(20) unsigned NOT NULL,
  `where` varchar(250) NOT NULL,
  `direction` tinyint(4) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `people_count` int(11) NOT NULL,
  `contact` text NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `state` char(1) NOT NULL,
  `drivers_sent_count` int(10) unsigned NOT NULL,
  `need_modern_car` tinyint(1) NOT NULL,
  `need_air_conditioner` int(11) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `travels_locality_fk` (`locality_id`),
  KEY `travels_user_fk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `travels`
--

INSERT INTO `travels` (`id`, `locality_id`, `where`, `direction`, `date`, `people_count`, `contact`, `user_id`, `state`, `drivers_sent_count`, `need_modern_car`, `need_air_conditioner`, `created`, `modified`) VALUES
(16, 1, 'fgdf gdfgdf', 0, '2014-05-24', 3, 'gf gdfg fdg', 1, 'C', 1, 0, 1, '2014-05-02', '2014-05-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `travels_by_email`
--

DROP TABLE IF EXISTS `travels_by_email`;
CREATE TABLE IF NOT EXISTS `travels_by_email` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `locality_id` bigint(20) unsigned NOT NULL,
  `where` varchar(250) COLLATE latin1_bin NOT NULL,
  `direction` int(11) NOT NULL,
  `description` varchar(1000) COLLATE latin1_bin NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `state` varchar(250) COLLATE latin1_bin NOT NULL,
  `drivers_sent_count` int(11) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `display_name` varchar(200) NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `travel_count` int(11) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `active`, `display_name`, `email_confirmed`, `travel_count`, `created`) VALUES
(1, 'ttt@ttt.ttt', '3a49921023b6c1d0a53cc864581e91f5f0e05109', 'regular', 1, 'martin', 1, 1, '0000-00-00'),
(3, 'mproenza@grm.desoft.cu', '60dd56fce363a2e493ae60bfdc64a9dffb0b227b', 'admin', 1, '', 1, 0, '0000-00-00'),
(11, 'nelson@ksabes.com', 'f83bf0b762b0eb17c78b944c77d1d3eb3149bc81', 'tester', 1, '', 0, 0, '2014-04-17'),
(13, 'yproenza003@gmail.com', '6e112beb5c6a8a609c579516d6fc3e8785a6e0b1', 'tester', 1, '', 0, 0, '2014-04-25'),
(14, 'manuel@ksabes.com', 'ac6a59c7f77ded10e5da77a2d9488df7eddb503e', 'admin', 1, '', 0, 0, '2014-05-02'),
(15, 'xfeanor@gmail.com', '628cb7a00d45d591885f246421951ab26601aa09', 'regular', 1, '', 0, 0, '2014-05-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_interactions`
--

DROP TABLE IF EXISTS `user_interactions`;
CREATE TABLE IF NOT EXISTS `user_interactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `interaction_code` varchar(250) COLLATE latin1_bin NOT NULL,
  `interaction_due` varchar(250) COLLATE latin1_bin NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `user_interactions`
--

INSERT INTO `user_interactions` (`id`, `user_id`, `interaction_code`, `interaction_due`, `expired`, `created`, `modified`) VALUES
(10, 1, 'K98858442e3ed6bc98d2e2417c01f641', 'confirm email', 1, '2014-05-02', '2014-05-02'),
(11, 1, 'l47550014c4b62ebbd297f0ff337a9c8', 'confirm email', 0, '2014-05-02', '2014-05-02');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `driver_localities`
--
ALTER TABLE `driver_localities`
  ADD CONSTRAINT `driver_localities_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `driver_localities_ibfk_2` FOREIGN KEY (`locality_id`) REFERENCES `localities` (`id`);

--
-- Filtros para la tabla `localities`
--
ALTER TABLE `localities`
  ADD CONSTRAINT `localities_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

--
-- Filtros para la tabla `travels`
--
ALTER TABLE `travels`
  ADD CONSTRAINT `travels_ibfk_1` FOREIGN KEY (`locality_id`) REFERENCES `localities` (`id`),
  ADD CONSTRAINT `travels_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
