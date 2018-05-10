-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 11 2018 г., 09:18
-- Версия сервера: 5.7.22-0ubuntu0.16.04.1
-- Версия PHP: 7.1.16-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '5',
  `rent_place` varchar(500) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `role` int(1) NOT NULL DEFAULT '3',
  `head` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `access`, `rent_place`, `email`, `role`, `head`) VALUES
(4, 'Центральный', 'central', '233ec5bda5fa468329234788b4ee61711ea3041e', 5, 'ул. Корабельная набережная, 1', '', 3, 20),
(5, 'ПРЕСТИЖ', 'vgues', 'e64e572068ce30fa004539addcf82afcecf9ba04', 5, 'Крылова 10/1', '', 3, 20),
(6, 'magnit', 'magnit', 'bebdcb0918a9aa123c2b68aefb977ae35e70cc50', 5, 'ул. Всеволода Сибирцева 88 ст2', '', 3, 20),
(7, 'Автопрокат №1', '1prokat', 'cd53ffd6a489a5f466b476599cb7c0d3ad1548b2', 5, 'ул. Жигура 2 б стр.2', '', 3, 20),
(8, 'Prim', 'prim', '4b760b581bf0ab4d9e40aae1823be445cca16c17', 5, 'Новый адрес', '', 3, 20),
(9, 'Варяг', 'varyag', '98d7640e4509f5a90389c5138e64f78ee343521d', 5, 'ул. Бородинская, 46, корп. 1', '', 3, 20),
(10, 'fantasy', 'fantasy', 'bffdd05fdd51fc2611ee11ac88259d9cc6dd5f88', 5, '', '', 3, 20),
(11, 'cherre', 'cherre', '25f8552071a8978b0447cfd5e1688eaaa5595bcc', 5, '', '', 3, 20),
(12, 'Администратор', 'admin', '7c222fb2927d828af22f592134e8932480637c0d', 5, '', '', 1, 0),
(20, 'ПримАвтоПрокат', 'ivan.rusia@mail.ru', '904f1c4b3db56b8f742f795b23634b8ddf8d3f26', 5, '', 'ivan.rusia@mail.ru', 2, 12),
(24, 'Тестовая компания', 'hibermail@gmail.com1', 'ee53f40792759a838afb2c2f7dc901f8d4ea55fb', 5, '', 'hibermail@gmail.com1', 2, 12),
(25, 'Филиал №1', 'dd@g.ru', '7c222fb2927d828af22f592134e8932480637c0d', 5, '', 'dd@g.ru', 3, 24),
(26, 'Филиал №2', 'ss@g.ru', '7c222fb2927d828af22f592134e8932480637c0d', 5, '', 'ss@g.ru', 3, 24),
(29, 'ДальПрокат', 'hibermail@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 5, '', 'hibermail@gmail.com', 2, 12),
(30, 'Новый прокат', 'q@q.ru', '7c222fb2927d828af22f592134e8932480637c0d', 5, '', 'q@q.ru', 3, 29);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
