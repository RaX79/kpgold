-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 08 2021 г., 01:48
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kpgold`
--

-- --------------------------------------------------------

--
-- Структура таблицы `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unitName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unitName` (`unitName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `units`
--

INSERT INTO `units` (`id`, `unitName`) VALUES
(7, 'Бухгалтерия'),
(1, 'Канцелярия'),
(20, 'Отдел информационных технологий'),
(6, 'Отдел организации труда'),
(4, 'Отдел охраны труда'),
(2, 'Секретариат'),
(3, 'Служба делопроизводства'),
(5, 'Служба управления персоналом');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `secondName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `unit` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstName`, `secondName`, `lastName`, `birth`, `sex`, `unit`) VALUES
(58, 'Арнольд', 'Дмитриевич', 'Алексеев', '1957-11-07', 1, 'Бухгалтерия'),
(59, 'Адриан', 'Сергеевич', 'Сидоров', '1987-11-18', 1, 'Служба управления персоналом'),
(60, 'Панкратий', 'Игнатьевич', 'Кулагин', '1997-08-27', 1, 'Секретариат'),
(61, 'Иосиф', 'Никитевич', 'Зайцев', '1985-10-30', 1, 'Отдел охраны труда'),
(62, 'Ермолай', 'Лукьянович', 'Воронов', '1990-12-23', 1, 'Бухгалтерия'),
(63, 'Аэлита', 'Львовна', 'Бобылёва', '2002-12-01', 0, 'Бухгалтерия'),
(64, 'Фанни', 'Сергеевна', 'Макарова', '1998-11-30', 0, 'Канцелярия'),
(65, 'Элиза', 'Артёмовна', 'Яковлева', '2001-11-04', 0, 'Отдел организации труда'),
(66, 'Марьяна', 'Давидовна', 'Королёва', '1975-11-05', 0, 'Служба управления персоналом');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
