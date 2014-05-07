-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-05-2014 a las 20:52:33
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
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `drivers`
--

INSERT INTO `drivers` (`id`, `username`, `password`, `max_people_count`, `active`, `has_modern_car`, `has_air_conditioner`, `description`) VALUES
(7, 'eduartd@nauta.cu', 'b074e2f38af8d33d8026b4facf2a6bfc03e4f77f', 4, 0, 0, 0, 'Ernesto (Moskovich)'),
(8, 'wary@dps.grm.sld.cu', 'f1ed9dc220787b7570dd4bf76f0b29205e55562a', 4, 0, 1, 1, 'Wary'),
(9, 'rricardo@grm.desoft.cu', '2773b7ee46895cf2b2f38fcb80f1403c1f136ec0', 4, 0, 0, 0, 'Nello (Lada)'),
(11, 'mproenza@grm.desoft.cu', '60dd56fce363a2e493ae60bfdc64a9dffb0b227b', 4, 1, 1, 1, 'Martín'),
(12, 'yoelt@nauta.cu', 'afbffb5f53e46c239e221925ba7871773fd67c9f', 4, 0, 1, 1, 'Yoel Toledano (El pollo), Citroen C5 2008'),
(13, 'cl8ff@frcuba.co.cu', '6c4279ec98f5799eacc782d98f86b739ab1b7b06', 4, 0, 0, 0, 'Paqui (Moskovich Aleco)'),
(14, 'Kevin.pellicer@nauta.cu', '4ff9d19ef18919fdf95eb1eca65467093de8bd70', 4, 0, 0, 0, 'Alberto Pellicer Rodríguez (43-1536, 52569900), Lada'),
(16, 'sanchez@granma.copextel.com.cu', 'a21149656d0c0d11fcc75aedada815879b445a1d', 4, 0, 1, 1, 'José A. Sánchez (El médico) (Renault SM3)'),
(17, 'carlosrm111@gmail.com', 'baffc19e71f28ab6ac86d54b8603f1f9db3d3d1b', 6, 0, 1, 1, 'Peugeot 405'),
(18, 'zacarias85@nauta.cu', 'ccbddb8cc88e4fb27414082e97605639a902d44a', 4, 0, 0, 0, 'Moskovich'),
(19, 'jbjorgeton227@gmail.com', '2bd25c88a68fffd36308d79d3f4b6c567055b556', 4, 0, 0, 0, 'Lada'),
(20, 'ronald.caballero@nauta.cu', '94777760361e1f5c78b97537374b23839fcc1331', 6, 0, 0, 0, 'Pontiac Clásico, viajes por el Oriente nada más'),
(21, 'eduardotorres@nauta.cu', '742270a2a3bf58888dad85e806c611a141474b71', 4, 0, 1, 1, 'Citroen ZX');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

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
(44, 16, 4),
(45, 17, 5),
(46, 18, 5),
(47, 19, 5),
(48, 20, 5),
(49, 21, 5),
(52, 11, 5);

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

--
-- Volcado de datos para la tabla `email_queue`
--

INSERT INTO `email_queue` (`id`, `to`, `from_name`, `from_email`, `subject`, `config`, `template`, `layout`, `format`, `template_vars`, `sent`, `locked`, `send_tries`, `send_at`, `created`, `modified`) VALUES
('5367d6b6-5180-4f42-8a6d-0f3c10d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#23)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"23","locality_id":"5","where":"La Habana","direction":"0","date":"17-05-2014","people_count":"3","contact":"Llamar al 42-3095","user_id":"1","state":"C","drivers_sent_count":1,"need_modern_car":true,"need_air_conditioner":"1","created":"2014-05-05","modified":"2014-05-05"},"Locality":{"id":"5","name":"Santiago de Cuba"},"User":{"id":"1","username":"ttt@ttt.ttt","role":"regular"}},"admin":{"drivers":[{"DriverLocality":{"id":"52","driver_id":"11","locality_id":"5"},"Driver":{"id":"11","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":1},"creator_role":"regular"}', 1, 0, 0, '2014-05-05 18:21:42', '2014-05-05 14:21:42', '2014-05-05 14:21:55'),
('5367d6b6-caf8-428a-af2a-0f3c10d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#23)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"23","locality_id":"5","where":"La Habana","direction":"0","date":"17-05-2014","people_count":"3","contact":"Llamar al 42-3095","user_id":"1","state":"C","drivers_sent_count":1,"need_modern_car":true,"need_air_conditioner":"1","created":"2014-05-05","modified":"2014-05-05"},"Locality":{"id":"5","name":"Santiago de Cuba"},"User":{"id":"1","username":"ttt@ttt.ttt","role":"regular"}}}', 1, 0, 0, '2014-05-05 18:21:42', '2014-05-05 14:21:42', '2014-05-05 14:21:56'),
('5367fce5-6870-47e0-b824-0f3c10d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#22)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"22","locality_id":"5","where":"sdfsd fsdg sfdfs dff","direction":"0","date":"16-05-2014","people_count":"2","contact":"fsd fsdfsdf sdfsdf","user_id":"3","state":"C","drivers_sent_count":1,"need_modern_car":true,"need_air_conditioner":"1","created":"2014-05-05","modified":"2014-05-05"},"Locality":{"id":"5","name":"Santiago de Cuba"},"User":{"id":"3","username":"mproenza@grm.desoft.cu","role":"admin"}},"admin":{"drivers":[{"DriverLocality":{"id":"52","driver_id":"11","locality_id":"5"},"Driver":{"id":"11","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":0},"creator_role":"admin"}', 1, 0, 0, '2014-05-05 21:04:37', '2014-05-05 17:04:37', '2014-05-05 17:08:35'),
('5367fdb6-ecb4-4749-a5a0-0f3c10d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#25)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"25","locality_id":"5","where":"La Habana","direction":"0","date":"17-05-2014","people_count":"3","contact":"Llamar al tel. 42-3095","user_id":"11","state":"C","drivers_sent_count":1,"need_modern_car":true,"need_air_conditioner":"1","created":"2014-05-05","modified":"2014-05-05"},"Locality":{"id":"5","name":"Santiago de Cuba"},"User":{"id":"11","username":"nelson@ksabes.com","role":"tester"}},"admin":{"drivers":[{"DriverLocality":{"id":"52","driver_id":"11","locality_id":"5"},"Driver":{"id":"11","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":0},"creator_role":"tester"}', 1, 0, 0, '2014-05-05 21:08:06', '2014-05-05 17:08:06', '2014-05-05 17:08:35'),
('536a3dd1-5348-4b81-abb3-0e3410d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#27)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"27","locality_id":"1","where":"Varadero","direction":"0","date":"15-05-2014","people_count":"1","contact":"dsa asdasds","user_id":"3","state":"C","drivers_sent_count":1,"need_modern_car":true,"need_air_conditioner":"1","created":"2014-05-07","modified":"2014-05-07"},"Locality":{"id":"1","name":"Bayamo"},"User":{"id":"3","username":"mproenza@grm.desoft.cu","role":"admin"}},"admin":{"drivers":[{"DriverLocality":{"id":"28","driver_id":"11","locality_id":"1"},"Driver":{"id":"11","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":0},"creator_role":"admin"}', 1, 0, 0, '2014-05-07 14:06:09', '2014-05-07 10:06:09', '2014-05-07 10:08:32'),
('536a99b2-0518-4125-a567-0e3410d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#28)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"28","locality_id":"1","where":"asds dasdasd","direction":"0","date":"17-05-2014","people_count":"3","contact":"ds da dasdasdasd","user_id":"19","state":"C","drivers_sent_count":1,"need_modern_car":true,"need_air_conditioner":"0","created":"2014-05-07","modified":"2014-05-07"},"Locality":{"id":"1","name":"Bayamo"},"User":{"id":"19","username":"iii@iii.iii","role":"regular"}}}', 0, 0, 0, '2014-05-07 20:38:10', '2014-05-07 16:38:10', '2014-05-07 16:38:10'),
('536a99b2-4f58-4b71-a494-0e3410d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#28)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"28","locality_id":"1","where":"asds dasdasd","direction":"0","date":"17-05-2014","people_count":"3","contact":"ds da dasdasdasd","user_id":"19","state":"C","drivers_sent_count":1,"need_modern_car":true,"need_air_conditioner":"0","created":"2014-05-07","modified":"2014-05-07"},"Locality":{"id":"1","name":"Bayamo"},"User":{"id":"19","username":"iii@iii.iii","role":"regular"}},"admin":{"drivers":[{"DriverLocality":{"id":"28","driver_id":"11","locality_id":"1"},"Driver":{"id":"11","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":1},"creator_role":"regular"}', 0, 0, 0, '2014-05-07 20:38:10', '2014-05-07 16:38:10', '2014-05-07 16:38:10');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `localities`
--

INSERT INTO `localities` (`id`, `name`, `province_id`) VALUES
(1, 'Bayamo', 1),
(2, 'Manzanillo', 1),
(3, 'Guisa', 1),
(4, 'Jiguaní', 1),
(5, 'Santiago de Cuba', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'Granma'),
(2, 'Santiago de Cuba');

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
  `created_from_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `travels_locality_fk` (`locality_id`),
  KEY `travels_user_fk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `travels`
--

INSERT INTO `travels` (`id`, `locality_id`, `where`, `direction`, `date`, `people_count`, `contact`, `user_id`, `state`, `drivers_sent_count`, `need_modern_car`, `need_air_conditioner`, `created`, `modified`, `created_from_ip`) VALUES
(22, 5, 'sdfsd fsdg sfdfs dff', 0, '2014-05-16', 2, 'fsd fsdfsdf sdfsdf', 3, 'C', 1, 1, 1, '2014-05-05', '2014-05-05', ''),
(23, 5, 'La Habana', 0, '2014-05-17', 3, 'Llamar al 42-3095', 1, 'C', 1, 1, 1, '2014-05-05', '2014-05-05', ''),
(24, 1, 'dfds fdsf', 0, '2014-05-16', 1, 'fd fsdf', 13, 'U', 0, 1, 0, '2014-05-05', '2014-05-05', ''),
(25, 5, 'La Habana', 0, '2014-05-17', 3, 'Llamar al tel. 42-3095', 11, 'C', 1, 1, 1, '2014-05-05', '2014-05-05', ''),
(26, 3, 'Villa Clara (Santa Clara)', 0, '2014-05-10', 2, 'bla, bla, bla', 1, 'U', 0, 0, 0, '2014-05-06', '2014-05-06', ''),
(27, 1, 'Varadero', 0, '2014-05-15', 1, 'dsa asdasds', 3, 'C', 1, 1, 1, '2014-05-07', '2014-05-07', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=1 ;

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
  `registered_from_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `active`, `display_name`, `email_confirmed`, `travel_count`, `created`, `registered_from_ip`) VALUES
(1, 'ttt@ttt.ttt', '3a49921023b6c1d0a53cc864581e91f5f0e05109', 'regular', 1, 'martin', 1, 2, '0000-00-00', '127.0.0.1'),
(3, 'mproenza@grm.desoft.cu', '60dd56fce363a2e493ae60bfdc64a9dffb0b227b', 'admin', 1, '', 1, 2, '0000-00-00', '127.0.0.1'),
(11, 'nelson@ksabes.com', 'f83bf0b762b0eb17c78b944c77d1d3eb3149bc81', 'tester', 1, '', 0, 1, '2014-04-17', '127.0.0.1'),
(13, 'yproenza003@gmail.com', '6e112beb5c6a8a609c579516d6fc3e8785a6e0b1', 'tester', 1, '', 0, 1, '2014-04-25', '127.0.0.1'),
(14, 'manuel@ksabes.com', 'ac6a59c7f77ded10e5da77a2d9488df7eddb503e', 'admin', 1, '', 0, 0, '2014-05-02', '127.0.0.1'),
(15, 'xfeanor@gmail.com', '628cb7a00d45d591885f246421951ab26601aa09', 'regular', 1, '', 0, 0, '2014-05-02', '127.0.0.1'),
(16, 'elieserivera@gmail.com', 'dd236c560b98671a0dfdff005571019548218868', 'regular', 1, '', 0, 0, '2014-05-07', '127.0.0.1'),
(17, 'info@domain.it', '5c05fad9ee8bbeaff0b050a576bdbb182dfbc190', 'regular', 1, '', 0, 0, '2014-05-07', '127.0.0.1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `user_interactions`
--

INSERT INTO `user_interactions` (`id`, `user_id`, `interaction_code`, `interaction_due`, `expired`, `created`, `modified`) VALUES
(16, 3, 'z0591d378e3af95084c07418c13b9946', 'confirm email', 1, '2014-05-05', '2014-05-05'),
(17, 3, 'R9c49e13b2e317af6fddb0a833ecd483', 'change password', 0, '2014-05-05', '2014-05-05'),
(18, 1, 'fb212a4234743a5e1b235584db530fcb', 'confirm email', 1, '2014-05-06', '2014-05-06');

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
