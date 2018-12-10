-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: mysql.kv-sys.ru
-- Время создания: Дек 10 2018 г., 22:41
-- Версия сервера: 5.5.61-log
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dot_api_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `authorId` int(11) NOT NULL,
  `authorName` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `authorStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`authorId`, `authorName`, `authorStatus`) VALUES
(1, 'Автор 1', 1),
(2, 'Автор 2', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE `language` (
  `languageId` int(11) NOT NULL,
  `languageName` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `languageCode` varchar(5) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`languageId`, `languageName`, `languageCode`) VALUES
(1, 'Русский', 'ru_RU'),
(2, 'English', 'en_US');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `statusId` int(11) NOT NULL,
  `statusValue` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`statusId`, `statusValue`) VALUES
(1, 'Включен'),
(2, 'Отключен'),
(3, 'Заблокирован');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `taskId` int(11) NOT NULL,
  `taskDate` datetime NOT NULL,
  `authorId` int(11) NOT NULL,
  `taskStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`taskId`, `taskDate`, `authorId`, `taskStatus`) VALUES
(1, '2018-12-10 09:00:00', 1, 1),
(2, '2018-12-10 10:00:00', 1, 1),
(3, '2018-12-10 12:40:03', 1, 1),
(4, '2018-12-10 12:40:03', 2, 1),
(5, '2018-12-10 12:40:03', 1, 1),
(6, '2018-12-10 12:40:03', 2, 1),
(7, '2018-12-10 12:40:03', 1, 1),
(8, '2018-12-10 12:40:03', 2, 1),
(9, '2018-12-10 12:40:03', 2, 1),
(10, '2018-12-10 12:40:03', 2, 1),
(11, '2018-12-10 12:40:03', 2, 1),
(12, '2018-12-10 12:40:03', 2, 1),
(13, '2018-12-10 12:40:03', 1, 1),
(14, '2018-12-10 12:40:03', 2, 1),
(15, '2018-12-10 12:40:03', 1, 1),
(16, '2018-12-10 12:40:03', 1, 1),
(17, '2018-12-10 12:40:03', 2, 1),
(18, '2018-12-10 12:40:03', 1, 1),
(19, '2018-12-10 12:40:03', 2, 1),
(20, '2018-12-10 12:40:03', 1, 1),
(21, '2018-12-10 12:40:03', 1, 1),
(22, '2018-12-10 12:40:03', 1, 1),
(23, '2018-12-10 12:40:03', 1, 1),
(24, '2018-12-10 12:40:03', 2, 1),
(25, '2018-12-10 12:40:03', 2, 1),
(26, '2018-12-10 12:40:03', 1, 1),
(27, '2018-12-10 12:40:03', 2, 1),
(28, '2018-12-10 12:40:03', 2, 1),
(29, '2018-12-10 12:40:03', 2, 1),
(30, '2018-12-10 12:40:03', 2, 1),
(31, '2018-12-10 12:40:03', 2, 1),
(32, '2018-12-10 12:40:03', 1, 1),
(33, '2018-12-10 12:40:03', 1, 1),
(34, '2018-12-10 12:40:03', 2, 1),
(35, '2018-12-10 12:40:03', 1, 1),
(36, '2018-12-10 12:40:03', 2, 1),
(37, '2018-12-10 12:40:03', 2, 1),
(38, '2018-12-10 12:40:03', 1, 1),
(39, '2018-12-10 12:40:03', 1, 1),
(40, '2018-12-10 12:40:03', 1, 1),
(41, '2018-12-10 12:40:03', 1, 1),
(42, '2018-12-10 12:40:03', 1, 1),
(43, '2018-12-10 12:40:03', 1, 1),
(44, '2018-12-10 12:40:03', 1, 1),
(45, '2018-12-10 12:40:03', 2, 1),
(46, '2018-12-10 12:40:03', 2, 1),
(47, '2018-12-10 12:40:03', 2, 1),
(48, '2018-12-10 12:40:03', 2, 1),
(49, '2018-12-10 12:40:03', 2, 1),
(50, '2018-12-10 12:40:03', 1, 1),
(51, '2018-12-10 12:40:03', 2, 1),
(52, '2018-12-10 12:40:03', 1, 1),
(53, '2018-12-10 12:40:03', 1, 1),
(54, '2018-12-10 12:40:03', 1, 1),
(55, '2018-12-10 12:40:03', 2, 1),
(56, '2018-12-10 12:40:03', 2, 1),
(57, '2018-12-10 12:40:03', 2, 1),
(58, '2018-12-10 12:40:03', 1, 1),
(59, '2018-12-10 12:40:03', 2, 1),
(60, '2018-12-10 12:40:03', 1, 1),
(61, '2018-12-10 12:40:03', 1, 1),
(62, '2018-12-10 12:40:03', 1, 1),
(63, '2018-12-10 12:40:03', 2, 1),
(64, '2018-12-10 12:40:03', 2, 1),
(65, '2018-12-10 12:40:03', 1, 1),
(66, '2018-12-10 12:40:03', 2, 1),
(67, '2018-12-10 12:40:03', 1, 1),
(68, '2018-12-10 12:40:03', 2, 1),
(69, '2018-12-10 12:40:03', 1, 1),
(70, '2018-12-10 12:40:03', 2, 1),
(71, '2018-12-10 12:40:03', 1, 1),
(72, '2018-12-10 12:40:03', 2, 1),
(73, '2018-12-10 12:40:03', 2, 1),
(74, '2018-12-10 12:40:03', 1, 1),
(75, '2018-12-10 12:40:03', 1, 1),
(76, '2018-12-10 12:40:03', 2, 1),
(77, '2018-12-10 12:40:03', 2, 1),
(78, '2018-12-10 12:40:03', 2, 1),
(79, '2018-12-10 12:40:03', 2, 1),
(80, '2018-12-10 12:40:03', 2, 1),
(81, '2018-12-10 12:40:03', 2, 1),
(82, '2018-12-10 12:40:03', 2, 1),
(83, '2018-12-10 12:40:03', 2, 1),
(84, '2018-12-10 12:40:03', 1, 1),
(85, '2018-12-10 12:40:03', 2, 1),
(86, '2018-12-10 12:40:03', 1, 1),
(87, '2018-12-10 12:40:03', 1, 1),
(88, '2018-12-10 12:40:03', 1, 1),
(89, '2018-12-10 12:40:03', 2, 1),
(90, '2018-12-10 12:40:03', 2, 1),
(91, '2018-12-10 12:40:03', 2, 1),
(92, '2018-12-10 12:40:03', 1, 1),
(93, '2018-12-10 12:40:03', 2, 1),
(94, '2018-12-10 12:40:03', 1, 1),
(95, '2018-12-10 12:40:03', 2, 1),
(96, '2018-12-10 12:40:03', 2, 1),
(97, '2018-12-10 12:40:03', 1, 1),
(98, '2018-12-10 12:40:03', 2, 1),
(99, '2018-12-10 12:40:03', 2, 1),
(100, '2018-12-10 12:40:03', 2, 1),
(101, '2018-12-10 12:40:03', 2, 1),
(102, '2018-12-10 12:40:03', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `task_description`
--

CREATE TABLE `task_description` (
  `entryId` int(11) NOT NULL,
  `taskId` int(11) NOT NULL,
  `taskName` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `taskDescription` text COLLATE utf8mb4_bin NOT NULL,
  `languageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `task_description`
--

INSERT INTO `task_description` (`entryId`, `taskId`, `taskName`, `taskDescription`, `languageId`) VALUES
(1, 1, 'Задание 1', 'Описание задания 1', 1),
(2, 2, 'Задание 2', 'Описание задания 2', 1),
(5, 3, 'Задание 3', 'Описание задания 3', 1),
(7, 4, 'Задание 4', 'Описание задания 4', 1),
(9, 5, 'Задание 5', 'Описание задания 5', 1),
(11, 6, 'Задание 6', 'Описание задания 6', 1),
(13, 7, 'Задание 7', 'Описание задания 7', 1),
(15, 8, 'Задание 8', 'Описание задания 8', 1),
(17, 9, 'Задание 9', 'Описание задания 9', 1),
(19, 10, 'Задание 10', 'Описание задания 10', 1),
(21, 11, 'Задание 11', 'Описание задания 11', 1),
(23, 12, 'Задание 12', 'Описание задания 12', 1),
(25, 13, 'Задание 13', 'Описание задания 13', 1),
(27, 14, 'Задание 14', 'Описание задания 14', 1),
(29, 15, 'Задание 15', 'Описание задания 15', 1),
(31, 16, 'Задание 16', 'Описание задания 16', 1),
(33, 17, 'Задание 17', 'Описание задания 17', 1),
(35, 18, 'Задание 18', 'Описание задания 18', 1),
(37, 19, 'Задание 19', 'Описание задания 19', 1),
(39, 20, 'Задание 20', 'Описание задания 20', 1),
(41, 21, 'Задание 21', 'Описание задания 21', 1),
(43, 22, 'Задание 22', 'Описание задания 22', 1),
(45, 23, 'Задание 23', 'Описание задания 23', 1),
(47, 24, 'Задание 24', 'Описание задания 24', 1),
(49, 25, 'Задание 25', 'Описание задания 25', 1),
(51, 26, 'Задание 26', 'Описание задания 26', 1),
(53, 27, 'Задание 27', 'Описание задания 27', 1),
(55, 28, 'Задание 28', 'Описание задания 28', 1),
(57, 29, 'Задание 29', 'Описание задания 29', 1),
(59, 30, 'Задание 30', 'Описание задания 30', 1),
(61, 31, 'Задание 31', 'Описание задания 31', 1),
(63, 32, 'Задание 32', 'Описание задания 32', 1),
(65, 33, 'Задание 33', 'Описание задания 33', 1),
(67, 34, 'Задание 34', 'Описание задания 34', 1),
(69, 35, 'Задание 35', 'Описание задания 35', 1),
(71, 36, 'Задание 36', 'Описание задания 36', 1),
(73, 37, 'Задание 37', 'Описание задания 37', 1),
(75, 38, 'Задание 38', 'Описание задания 38', 1),
(77, 39, 'Задание 39', 'Описание задания 39', 1),
(79, 40, 'Задание 40', 'Описание задания 40', 1),
(81, 41, 'Задание 41', 'Описание задания 41', 1),
(83, 42, 'Задание 42', 'Описание задания 42', 1),
(85, 43, 'Задание 43', 'Описание задания 43', 1),
(87, 44, 'Задание 44', 'Описание задания 44', 1),
(89, 45, 'Задание 45', 'Описание задания 45', 1),
(91, 46, 'Задание 46', 'Описание задания 46', 1),
(93, 47, 'Задание 47', 'Описание задания 47', 1),
(95, 48, 'Задание 48', 'Описание задания 48', 1),
(97, 49, 'Задание 49', 'Описание задания 49', 1),
(99, 50, 'Задание 50', 'Описание задания 50', 1),
(101, 51, 'Задание 51', 'Описание задания 51', 1),
(103, 52, 'Задание 52', 'Описание задания 52', 1),
(105, 53, 'Задание 53', 'Описание задания 53', 1),
(107, 54, 'Задание 54', 'Описание задания 54', 1),
(109, 55, 'Задание 55', 'Описание задания 55', 1),
(111, 56, 'Задание 56', 'Описание задания 56', 1),
(113, 57, 'Задание 57', 'Описание задания 57', 1),
(115, 58, 'Задание 58', 'Описание задания 58', 1),
(117, 59, 'Задание 59', 'Описание задания 59', 1),
(119, 60, 'Задание 60', 'Описание задания 60', 1),
(121, 61, 'Задание 61', 'Описание задания 61', 1),
(123, 62, 'Задание 62', 'Описание задания 62', 1),
(125, 63, 'Задание 63', 'Описание задания 63', 1),
(127, 64, 'Задание 64', 'Описание задания 64', 1),
(129, 65, 'Задание 65', 'Описание задания 65', 1),
(131, 66, 'Задание 66', 'Описание задания 66', 1),
(133, 67, 'Задание 67', 'Описание задания 67', 1),
(135, 68, 'Задание 68', 'Описание задания 68', 1),
(137, 69, 'Задание 69', 'Описание задания 69', 1),
(139, 70, 'Задание 70', 'Описание задания 70', 1),
(141, 71, 'Задание 71', 'Описание задания 71', 1),
(143, 72, 'Задание 72', 'Описание задания 72', 1),
(145, 73, 'Задание 73', 'Описание задания 73', 1),
(147, 74, 'Задание 74', 'Описание задания 74', 1),
(149, 75, 'Задание 75', 'Описание задания 75', 1),
(151, 76, 'Задание 76', 'Описание задания 76', 1),
(153, 77, 'Задание 77', 'Описание задания 77', 1),
(155, 78, 'Задание 78', 'Описание задания 78', 1),
(157, 79, 'Задание 79', 'Описание задания 79', 1),
(159, 80, 'Задание 80', 'Описание задания 80', 1),
(161, 81, 'Задание 81', 'Описание задания 81', 1),
(163, 82, 'Задание 82', 'Описание задания 82', 1),
(165, 83, 'Задание 83', 'Описание задания 83', 1),
(167, 84, 'Задание 84', 'Описание задания 84', 1),
(169, 85, 'Задание 85', 'Описание задания 85', 1),
(171, 86, 'Задание 86', 'Описание задания 86', 1),
(173, 87, 'Задание 87', 'Описание задания 87', 1),
(175, 88, 'Задание 88', 'Описание задания 88', 1),
(177, 89, 'Задание 89', 'Описание задания 89', 1),
(179, 90, 'Задание 90', 'Описание задания 90', 1),
(181, 91, 'Задание 91', 'Описание задания 91', 1),
(183, 92, 'Задание 92', 'Описание задания 92', 1),
(185, 93, 'Задание 93', 'Описание задания 93', 1),
(187, 94, 'Задание 94', 'Описание задания 94', 1),
(189, 95, 'Задание 95', 'Описание задания 95', 1),
(191, 96, 'Задание 96', 'Описание задания 96', 1),
(193, 97, 'Задание 97', 'Описание задания 97', 1),
(195, 98, 'Задание 98', 'Описание задания 98', 1),
(197, 99, 'Задание 99', 'Описание задания 99', 1),
(199, 100, 'Задание 100', 'Описание задания 100', 1),
(201, 101, 'Задание 101', 'Описание задания 101', 1),
(203, 102, 'Задание 102', 'Описание задания 102', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorId`),
  ADD KEY `authorId` (`authorId`,`authorStatus`);

--
-- Индексы таблицы `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`languageId`),
  ADD KEY `languageId` (`languageId`,`languageCode`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusId`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskId`),
  ADD KEY `taskId` (`taskId`,`taskStatus`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `taskStatus` (`taskStatus`);

--
-- Индексы таблицы `task_description`
--
ALTER TABLE `task_description`
  ADD PRIMARY KEY (`entryId`),
  ADD KEY `taskId` (`taskId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `authorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
  MODIFY `languageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `statusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT для таблицы `task_description`
--
ALTER TABLE `task_description`
  MODIFY `entryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1999;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`authorId`) REFERENCES `author` (`authorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`taskStatus`) REFERENCES `status` (`statusId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `task_description`
--
ALTER TABLE `task_description`
  ADD CONSTRAINT `task_description_ibfk_1` FOREIGN KEY (`taskId`) REFERENCES `task` (`taskId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;