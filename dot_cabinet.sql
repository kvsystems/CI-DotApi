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
-- База данных: `dot_cabinet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cab_groups`
--

CREATE TABLE `cab_groups` (
  `groupId` int(11) NOT NULL,
  `groupName` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `groupStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_groups`
--

INSERT INTO `cab_groups` (`groupId`, `groupName`, `groupStatus`) VALUES
(1, 'Администратор', 1),
(2, 'Клиент', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cab_layout`
--

CREATE TABLE `cab_layout` (
  `layoutId` int(11) NOT NULL,
  `layoutName` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `modules` text COLLATE utf8mb4_bin NOT NULL,
  `layoutState` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_layout`
--

INSERT INTO `cab_layout` (`layoutId`, `layoutName`, `modules`, `layoutState`) VALUES
(1, 'Регистрация', '[1,2]', 1),
(2, 'Авторизация', '[1,3]', 1),
(3, 'CI-REST-API', '[1,4]', 1),
(9, 'CRUD-API', '[1,10]', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cab_messages`
--

CREATE TABLE `cab_messages` (
  `messageId` int(11) NOT NULL,
  `messageLevel` int(11) NOT NULL,
  `messageText` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_messages`
--

INSERT INTO `cab_messages` (`messageId`, `messageLevel`, `messageText`) VALUES
(1, 1, 'Данные успешно получены'),
(2, 2, 'Поле не заполнено'),
(3, 1, 'Пользователь успешно авторизован'),
(4, 2, 'Проверьте логин и пароль'),
(5, 1, 'Ключ успешно активирован'),
(6, 2, 'Не удалось активировать ключ'),
(7, 2, 'Не удалось создать пользователя'),
(8, 2, 'Не удалось создать лицензию'),
(9, 2, 'Не удалось создать сессию'),
(10, 2, 'Не удалось найти сессию'),
(11, 1, 'Сессия успешно удалена'),
(12, 2, 'Не удалось удалить сессию'),
(13, 2, 'Не найдено заданий'),
(14, 1, 'Список заданий успешно получен'),
(15, 2, 'Задание с таким идентификатором не обнаружено');

-- --------------------------------------------------------

--
-- Структура таблицы `cab_messages_level`
--

CREATE TABLE `cab_messages_level` (
  `levelId` int(11) NOT NULL,
  `levelName` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_messages_level`
--

INSERT INTO `cab_messages_level` (`levelId`, `levelName`) VALUES
(1, 'Уведомление'),
(2, 'Ошибка');

-- --------------------------------------------------------

--
-- Структура таблицы `cab_modules`
--

CREATE TABLE `cab_modules` (
  `moduleId` int(11) NOT NULL,
  `moduleName` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `modulePath` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `moduleState` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_modules`
--

INSERT INTO `cab_modules` (`moduleId`, `moduleName`, `modulePath`, `moduleState`) VALUES
(1, 'breadcrumbs', 'web/modules/breadcrumbs', 1),
(2, 'registration', 'web/forms/registration', 1),
(3, 'authorization', 'web/forms/authorization', 1),
(4, 'dashboard', 'web/content/dashboard', 1),
(10, 'crud', 'web/content/crud', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cab_navigation`
--

CREATE TABLE `cab_navigation` (
  `navigationId` int(11) NOT NULL,
  `navigationName` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `routeId` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `navigationType` int(11) NOT NULL,
  `groupAvail` text COLLATE utf8mb4_bin NOT NULL,
  `sortOrder` int(11) NOT NULL,
  `icon` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `visibility` tinyint(1) NOT NULL,
  `navigationState` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_navigation`
--

INSERT INTO `cab_navigation` (`navigationId`, `navigationName`, `routeId`, `parent`, `navigationType`, `groupAvail`, `sortOrder`, `icon`, `visibility`, `navigationState`) VALUES
(1, 'CI-REST-API', 3, 0, 1, '[1,2]', 1, 'fa-dashboard', 1, 1),
(10, 'CRUD-API', 11, 0, 1, '[1,2]', 1, 'fa-dashboard', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cab_routes`
--

CREATE TABLE `cab_routes` (
  `routeId` int(11) NOT NULL,
  `routeUri` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `groupsAvailable` text COLLATE utf8mb4_bin NOT NULL,
  `layoutId` int(11) NOT NULL,
  `routeState` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_routes`
--

INSERT INTO `cab_routes` (`routeId`, `routeUri`, `groupsAvailable`, `layoutId`, `routeState`) VALUES
(1, '/register', '[0]', 1, 1),
(2, '/', '[0]', 2, 1),
(3, '/dashboard', '[1,2]', 3, 1),
(11, '/crud', '[1,2]', 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cab_sessions`
--

CREATE TABLE `cab_sessions` (
  `sessionId` int(11) NOT NULL,
  `sessionHash` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `expiriesAt` datetime NOT NULL,
  `sessionStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_sessions`
--

INSERT INTO `cab_sessions` (`sessionId`, `sessionHash`, `userId`, `groupId`, `createdAt`, `expiriesAt`, `sessionStatus`) VALUES
(91, 'f467cf1969e0971dab84d807bb833e83', 1, 2, '2018-12-10 21:16:48', '2018-12-11 21:16:48', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cab_users`
--

CREATE TABLE `cab_users` (
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `login` varchar(32) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `requisites` text COLLATE utf8mb4_bin,
  `createdAt` datetime NOT NULL,
  `registerIpa` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `userStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `cab_users`
--

INSERT INTO `cab_users` (`userId`, `groupId`, `login`, `password`, `requisites`, `createdAt`, `registerIpa`, `userStatus`) VALUES
(1, 1, 'lekraft', '821b027de8d7de8f253d924cab4b9d70', '', '2018-11-17 10:15:01', '178.46.100.246', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cab_groups`
--
ALTER TABLE `cab_groups`
  ADD PRIMARY KEY (`groupId`);

--
-- Индексы таблицы `cab_layout`
--
ALTER TABLE `cab_layout`
  ADD PRIMARY KEY (`layoutId`);

--
-- Индексы таблицы `cab_messages`
--
ALTER TABLE `cab_messages`
  ADD PRIMARY KEY (`messageId`);

--
-- Индексы таблицы `cab_messages_level`
--
ALTER TABLE `cab_messages_level`
  ADD PRIMARY KEY (`levelId`);

--
-- Индексы таблицы `cab_modules`
--
ALTER TABLE `cab_modules`
  ADD PRIMARY KEY (`moduleId`);

--
-- Индексы таблицы `cab_navigation`
--
ALTER TABLE `cab_navigation`
  ADD PRIMARY KEY (`navigationId`);

--
-- Индексы таблицы `cab_routes`
--
ALTER TABLE `cab_routes`
  ADD PRIMARY KEY (`routeId`);

--
-- Индексы таблицы `cab_sessions`
--
ALTER TABLE `cab_sessions`
  ADD PRIMARY KEY (`sessionId`);

--
-- Индексы таблицы `cab_users`
--
ALTER TABLE `cab_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cab_groups`
--
ALTER TABLE `cab_groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cab_layout`
--
ALTER TABLE `cab_layout`
  MODIFY `layoutId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `cab_messages`
--
ALTER TABLE `cab_messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `cab_messages_level`
--
ALTER TABLE `cab_messages_level`
  MODIFY `levelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cab_modules`
--
ALTER TABLE `cab_modules`
  MODIFY `moduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `cab_navigation`
--
ALTER TABLE `cab_navigation`
  MODIFY `navigationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `cab_routes`
--
ALTER TABLE `cab_routes`
  MODIFY `routeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `cab_sessions`
--
ALTER TABLE `cab_sessions`
  MODIFY `sessionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT для таблицы `cab_users`
--
ALTER TABLE `cab_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
