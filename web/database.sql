-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Време на генериране: 
-- Версия на сървъра: 5.5.32
-- Версия на PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `rusehack`
--
CREATE DATABASE IF NOT EXISTS `rusehack` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rusehack`;

-- --------------------------------------------------------

--
-- Структура на таблица `rusehack_app_keys`
--

CREATE TABLE IF NOT EXISTS `rusehack_app_keys` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `appkey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `rusehack_cars`
--

CREATE TABLE IF NOT EXISTS `rusehack_cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `fueltype` varchar(255) NOT NULL,
  `consumption` float NOT NULL,
  `class` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `public` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `rusehack_ci_sessions`
--

CREATE TABLE IF NOT EXISTS `rusehack_ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `rusehack_price_cache`
--

CREATE TABLE IF NOT EXISTS `rusehack_price_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(64) NOT NULL,
  `gasoline` float NOT NULL,
  `diesel` float NOT NULL,
  `lpg` float NOT NULL,
  `methane` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `rusehack_users`
--

CREATE TABLE IF NOT EXISTS `rusehack_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `passkey` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Схема на данните от таблица `rusehack_users`
--

INSERT INTO `rusehack_users` (`id`, `username`, `passkey`, `email`) VALUES
(1, 'u1', '03ad751aa5de5b7fd249ba3c3b2737bd910198b2', 'u1@localhost');
-- password is u1

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
