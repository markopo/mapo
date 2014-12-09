-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2014 at 04:20 PM
-- Server version: 5.1.68-community
-- PHP Version: 5.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `movie`
--
CREATE DATABASE IF NOT EXISTS `movie` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `movie`;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'comedy'),
(2, 'romance'),
(3, 'college'),
(4, 'crime'),
(5, 'drama'),
(6, 'thriller'),
(7, 'animation'),
(8, 'adventure'),
(9, 'family'),
(10, 'svenskt'),
(11, 'action'),
(12, 'horror');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `director` varchar(100) DEFAULT NULL,
  `LENGTH` int(11) DEFAULT NULL,
  `YEAR` int(11) NOT NULL DEFAULT '1900',
  `plot` text,
  `image` varchar(100) DEFAULT NULL,
  `subtext` char(3) DEFAULT NULL,
  `speech` char(3) DEFAULT NULL,
  `quality` char(3) DEFAULT NULL,
  `format` char(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `director`, `LENGTH`, `YEAR`, `plot`, `image`, `subtext`, `speech`, `quality`, `format`) VALUES
(1, 'Pulp fiction', NULL, NULL, 1994, NULL, 'img/movie/pulp-fiction.jpg', NULL, NULL, NULL, NULL),
(2, 'American Pie', NULL, NULL, 1999, NULL, 'img/movie/american-pie.jpg', NULL, NULL, NULL, NULL),
(3, 'Pokémon The Movie 2000', NULL, NULL, 1999, NULL, 'img/movie/pokemon.jpg', NULL, NULL, NULL, NULL),
(4, 'Kopps', NULL, NULL, 2003, NULL, 'img/movie/kopps.jpg', NULL, NULL, NULL, NULL),
(5, 'From Dusk Till Dawn', NULL, NULL, 1996, NULL, 'img/movie/from-dusk-till-dawn.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie2genre`
--

CREATE TABLE IF NOT EXISTS `movie2genre` (
  `idMovie` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL,
  PRIMARY KEY (`idMovie`,`idGenre`),
  KEY `idGenre` (`idGenre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie2genre`
--

INSERT INTO `movie2genre` (`idMovie`, `idGenre`) VALUES
(1, 1),
(2, 1),
(4, 1),
(2, 2),
(2, 3),
(5, 4),
(1, 5),
(1, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 9),
(4, 10),
(4, 11),
(5, 11),
(5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acronym` char(12) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `salt` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acronym` (`acronym`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `acronym`, `name`, `password`, `salt`) VALUES
(1, 'doe', 'John/Jane Doe', 'e21abb8eadd30dc9a2d56f007226a74b', 1416830276),
(2, 'admin', 'Administrator', '02f239e4b623615e2d8c61cac033779d', 1416830276);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vmovie`
--
CREATE TABLE IF NOT EXISTS `vmovie` (
`id` int(11)
,`title` varchar(100)
,`director` varchar(100)
,`LENGTH` int(11)
,`YEAR` int(11)
,`plot` text
,`image` varchar(100)
,`subtext` char(3)
,`speech` char(3)
,`quality` char(3)
,`format` char(3)
,`genre` varchar(341)
);
-- --------------------------------------------------------

--
-- Structure for view `vmovie`
--
DROP TABLE IF EXISTS `vmovie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vmovie` AS select `m`.`id` AS `id`,`m`.`title` AS `title`,`m`.`director` AS `director`,`m`.`LENGTH` AS `LENGTH`,`m`.`YEAR` AS `YEAR`,`m`.`plot` AS `plot`,`m`.`image` AS `image`,`m`.`subtext` AS `subtext`,`m`.`speech` AS `speech`,`m`.`quality` AS `quality`,`m`.`format` AS `format`,group_concat(`g`.`name` separator ',') AS `genre` from ((`movie` `m` left join `movie2genre` `m2g` on((`m`.`id` = `m2g`.`idMovie`))) left join `genre` `g` on((`m2g`.`idGenre` = `g`.`id`))) group by `m`.`id`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie2genre`
--
ALTER TABLE `movie2genre`
  ADD CONSTRAINT `movie2genre_ibfk_1` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `movie2genre_ibfk_2` FOREIGN KEY (`idGenre`) REFERENCES `genre` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
