-- phpMyAdmin SQL Dump
-- version 4.0.10.9
-- http://www.phpmyadmin.net
--
-- Gazda: localhost
-- Timp de generare: 21 Apr 2015 la 08:22
-- Versiune server: 5.1.73
-- Versiune PHP: 5.4.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza de date: `mma`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usern` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `admins`
--

INSERT INTO `admins` (`id`, `usern`, `passwd`) VALUES
(1, 'admin', '79deafaa017b452c225ad3b18cfba027');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(2) NOT NULL,
  `price` int(10) NOT NULL,
  `power` int(3) NOT NULL,
  `agility` int(3) NOT NULL,
  `endurance` int(3) NOT NULL,
  `energy` int(3) NOT NULL,
  `fastness` int(3) NOT NULL,
  `type` int(11) NOT NULL,
  `img` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Salvarea datelor din tabel `items`
--

INSERT INTO `items` (`id`, `name`, `status`, `price`, `power`, `agility`, `endurance`, `energy`, `fastness`, `type`, `img`) VALUES
(1, 'manusi_test', 1, 100, 10, 10, 10, 10, 10, 1, 'assets/imgs/1.png'),
(2, 'manusi_2_test', 2, 10000, 50, 60, 40, 25, 80, 1, ''),
(3, 'short_test', 1, 100, 2, 3, 10, 50, 10, 2, 'assets/imgs/short1.png'),
(4, 'power_drink', 1, 100, 50, 0, 0, 0, 0, 3, '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `items_equiped`
--

CREATE TABLE IF NOT EXISTS `items_equiped` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_item` int(3) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_win` int(11) NOT NULL,
  `user_lost` int(11) NOT NULL,
  `fight_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `pm`
--

CREATE TABLE IF NOT EXISTS `pm` (
  `id` bigint(20) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `premium_history`
--

CREATE TABLE IF NOT EXISTS `premium_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `premium_expire` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `quest`
--

CREATE TABLE IF NOT EXISTS `quest` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `quest_no` int(2) NOT NULL,
  `id_user` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `start_points` int(11) NOT NULL,
  `player_max_force` int(11) NOT NULL,
  `player_max_agility` int(11) NOT NULL,
  `player_max_endurance` int(11) NOT NULL,
  `player_max_fastness` int(11) NOT NULL,
  `premium_bonus_force` int(11) NOT NULL,
  `premium_bonus_agility` int(11) NOT NULL,
  `premium_bonus_endurance` int(11) NOT NULL,
  `premium_bonus_fastness` int(11) NOT NULL,
  `premium_bonus_money` int(11) NOT NULL,
  `premium_bonus_points` int(11) NOT NULL,
  `premium_bonus_price` int(11) NOT NULL,
  `premium_bonus_time` int(11) NOT NULL,
  `paypal_email` varchar(255) NOT NULL,
  `web_email` varchar(255) NOT NULL,
  `ad_place` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;



-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tournaments`
--

CREATE TABLE IF NOT EXISTS `tournaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `poster` text NOT NULL,
  `max_players` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `winner_rewarded` int(11) NOT NULL,
  `rewards` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tournaments_players`
--

CREATE TABLE IF NOT EXISTS `tournaments_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usern` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `online_time` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `power` int(11) NOT NULL,
  `agility` int(11) NOT NULL,
  `endurance` int(11) NOT NULL,
  `fastness` int(11) NOT NULL,
  `total_stats` int(11) NOT NULL,
  `energy` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `battles_won` int(11) NOT NULL,
  `battles_lost` int(11) NOT NULL,
  `tournaments_won` int(11) NOT NULL,
  `workouts` int(11) NOT NULL,
  `workout_start_time` int(11) NOT NULL,
  `workout_end_time` int(11) NOT NULL,
  `drink_end_time` int(11) NOT NULL,
  `workout_type` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `premium` int(11) NOT NULL,
  `gloves` int(2) NOT NULL DEFAULT '0',
  `shorts` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
