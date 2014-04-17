-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-04-2014 a las 12:34:24
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE IF NOT EXISTS `drivers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `max_people_count` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `drivers`
--

INSERT INTO `drivers` (`id`, `username`, `password`, `max_people_count`, `active`) VALUES
(5, 'nelson@ksabes.com', 'f83bf0b762b0eb17c78b944c77d1d3eb3149bc81', 4, 0),
(6, 'mproenza@grm.desoft.cu', '11d73e76166b34c786ff3227813b3a467818c264', 4, 1),
(7, 'eduartd@nauta.cu', 'b074e2f38af8d33d8026b4facf2a6bfc03e4f77f', 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `driver_localities`
--

CREATE TABLE IF NOT EXISTS `driver_localities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` bigint(20) unsigned NOT NULL,
  `locality_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `driver_localities_driver_fk` (`driver_id`),
  KEY `driver_localities_locality_fk` (`locality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `driver_localities`
--

INSERT INTO `driver_localities` (`id`, `driver_id`, `locality_id`) VALUES
(6, 5, 1),
(7, 5, 2),
(8, 6, 1),
(9, 6, 2),
(10, 6, 3),
(11, 6, 4),
(12, 7, 1),
(13, 7, 2),
(14, 7, 3),
(15, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_queue`
--

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
('534d47b6-e6dc-41e6-a1fc-04d810d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#54)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"54","locality_id":"4","destination":"fd fsdfsd","date":"26-04-2014","people_count":"3","contact":"fd fsdfsdfsd","need_loggage":false,"user_id":"3","state":"C","drivers_sent_count":1},"Locality":{"id":"4","name":"Jiguan\\u00ed"},"User":{"id":"3","username":"mproenza@grm.desoft.cu","role":"admin"}},"admin":{"drivers":[{"DriverLocality":{"id":"11","driver_id":"6","locality_id":"4"},"Driver":{"id":"6","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":null}}', 1, 0, 0, '2014-04-15 14:52:38', '2014-04-15 14:52:38', '2014-04-15 15:31:07'),
('534d54d1-1adc-4189-bb62-04d810d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#55)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"55","locality_id":"1","destination":"Mirador Guisa","date":"25-04-2014","people_count":"3","contact":"sad asdsad","need_loggage":false,"user_id":"3","state":"C","drivers_sent_count":1},"Locality":{"id":"1","name":"Bayamo"},"User":{"id":"3","username":"mproenza@grm.desoft.cu","role":"admin"}},"admin":{"drivers":[{"DriverLocality":{"id":"8","driver_id":"6","locality_id":"1"},"Driver":{"id":"6","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":null}}', 1, 0, 0, '2014-04-15 15:48:33', '2014-04-15 15:48:33', '2014-04-15 16:17:01'),
('534d566e-f084-4d44-8063-04d810d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#56)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"56","locality_id":"2","destination":"fdfd fdf","date":"18-04-2014","people_count":"3","contact":"fd sfsdf","need_loggage":false,"user_id":"3","state":"C","drivers_sent_count":1},"Locality":{"id":"2","name":"Manzanillo"},"User":{"id":"3","username":"mproenza@grm.desoft.cu","role":"admin"}},"admin":{"drivers":[{"DriverLocality":{"id":"9","driver_id":"6","locality_id":"2"},"Driver":{"id":"6","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":null}}', 1, 0, 0, '2014-04-15 15:55:26', '2014-04-15 15:55:26', '2014-04-15 16:17:01'),
('534e9138-e4d8-45e0-8568-085c10d2655b', 'mproenza@grm.desoft.cu', '', '', 'Nuevo Anuncio de Viaje (#47)', 'yotellevo', 'new_travel', 'default', 'html', '{"travel":{"Travel":{"id":"47","locality_id":"3","destination":"fds fsdfsdf","date":"19-04-2014","people_count":"2","contact":"fsd fsfsdfsd","need_loggage":false,"user_id":"3","state":"C","drivers_sent_count":1},"Locality":{"id":"3","name":"Guisa"},"User":{"id":"3","username":"mproenza@grm.desoft.cu","role":"admin"}},"admin":{"drivers":[{"DriverLocality":{"id":"10","driver_id":"6","locality_id":"3"},"Driver":{"id":"6","username":"mproenza@grm.desoft.cu","max_people_count":"4"}}],"notified_count":null}}', 1, 0, 0, '2014-04-16 14:18:32', '2014-04-16 14:18:32', '2014-04-16 14:18:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localities`
--

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
(5, 'Holguín', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pending_users`
--

CREATE TABLE IF NOT EXISTS `pending_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `activation_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `pending_users`
--

INSERT INTO `pending_users` (`id`, `username`, `password`, `role`, `activation_id`) VALUES
(1, 'rrr@rrr.rrr', 'rrr', 'regular', 'racc5f5400be51f50da796761e33f15b'),
(2, 'lvaldes@grm.desoft.cu', 'luisvaldes', 'regular', 'Y6b656216fc7ba3581640eaf73141a74');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinces`
--

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
(2, 'Holguín');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `travels`
--

CREATE TABLE IF NOT EXISTS `travels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `locality_id` bigint(20) unsigned NOT NULL,
  `destination` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `people_count` int(11) NOT NULL,
  `contact` text NOT NULL,
  `need_loggage` tinyint(1) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `state` char(1) NOT NULL,
  `drivers_sent_count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `travels_locality_fk` (`locality_id`),
  KEY `travels_user_fk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `travels`
--

INSERT INTO `travels` (`id`, `locality_id`, `destination`, `date`, `people_count`, `contact`, `need_loggage`, `user_id`, `state`, `drivers_sent_count`) VALUES
(45, 1, 'gffsdfsdf', '2014-04-26', 3, 'fdfsdf dfdsfd', 0, 1, 'C', 1),
(46, 1, 'das dasdas', '2014-04-26', 3, 'ds adasdas', 0, 3, 'C', 1),
(47, 3, 'fds fsdfsdf', '2014-04-19', 2, 'fsd fsfsdfsd', 0, 3, 'C', 1),
(48, 2, 'sdf sdfsdfsd', '2014-04-19', 3, 'fd fsdfsdf', 0, 6, 'U', 0),
(49, 5, 'Bayamo', '2014-04-26', 2, 'das dasdasdas', 0, 3, 'U', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `display_name` varchar(200) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `active`, `display_name`, `created`) VALUES
(1, 'ttt@ttt.ttt', '3a49921023b6c1d0a53cc864581e91f5f0e05109', 'regular', 1, 'martin', '0000-00-00'),
(3, 'mproenza@grm.desoft.cu', '60dd56fce363a2e493ae60bfdc64a9dffb0b227b', 'admin', 1, '', '0000-00-00'),
(4, 'nelson@ksabes.com', 'f83bf0b762b0eb17c78b944c77d1d3eb3149bc81', 'admin', 1, '', '0000-00-00'),
(5, 'yyy@yyy.yyy', '204fd5ba3dc199156254911fc8d088f6f20962fa', 'regular', 1, '', '2014-04-15'),
(6, 'uuu@uuu.uuu', 'a374f64d906d66e31e4b27e80991a46d2e91feb9', 'regular', 1, '', '2014-04-16');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
