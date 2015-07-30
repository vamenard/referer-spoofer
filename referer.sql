-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Genere le : Jeu 05 Novembre 2009 a 17:24
-- Version du serveur: 5.1.37
-- Version de PHP: 5.2.10-2ubuntu6.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `referer`
--

-- --------------------------------------------------------

--
-- Structure de la table `crawls`
--

CREATE TABLE IF NOT EXISTS `crawls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_url_id` int(11) NOT NULL,
  `fk_referer_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `crawls`
--

INSERT INTO `crawls` (`id`, `fk_url_id`, `fk_referer_id`, `token`, `confirmed`, `created`, `updated`) VALUES
(1, 1, 2, '1257457245', 0, '2009-11-05 16:40:45', '2009-11-05 16:40:45'),

-- --------------------------------------------------------

--
-- Structure de la table `referers`
--

CREATE TABLE IF NOT EXISTS `referers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referer` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `referers`
--

INSERT INTO `referers` (`id`, `referer`) VALUES
(1, 'viaroot.com'),
(2, 'graphotron.ca');

-- --------------------------------------------------------

--
-- Structure de la table `urls`
--

CREATE TABLE IF NOT EXISTS `urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `urls`
--

INSERT INTO `urls` (`id`, `url`) VALUES
(1, 'http://heptacube.com'),
(2, 'http://diffpuppy.com');
