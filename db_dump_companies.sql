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
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `city` varchar(255) NOT NULL DEFAULT '',
  `director_name` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `bank_name` varchar(255) NOT NULL DEFAULT '',
  `inn` varchar(255) NOT NULL DEFAULT '',
  `kpp` varchar(255) NOT NULL DEFAULT '',
  `checking_account` varchar(255) NOT NULL DEFAULT '',
  `correspondent_account` varchar(255) NOT NULL DEFAULT '',
  `bik` varchar(255) NOT NULL DEFAULT '',
  `form` varchar(300) NOT NULL DEFAULT '',
  `name` varchar(300) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `companies`
--

INSERT INTO `companies` (`id`, `user`, `city`, `director_name`, `address`, `bank_name`, `inn`, `kpp`, `checking_account`, `correspondent_account`, `bik`, `form`, `name`) VALUES
(1, 20, '', '', '', '', '', '', '', '', '', '', ''),
(2, 24, 'Владикавказ', 'Сурков Иван Григорьевич', 'г. Владикавказ, ул. Бестужева, 5б', 'Отделение №57588 Южного филиала Сбербанка России', '5516665816', '1613316456', '49856458539645029348689', '34859845736423423677754', '4573775', 'Публичное акционерное общество', 'Тестовая компания'),
(3, 29, 'г. Уссурийск', 'Болотин Иван Андреевич', 'г. Уссурийск, ул. Некрасова, 55', 'Росбанк', '6849943', '5774899', '567876543948585493299', '000000000000099998888', '747674', 'ОАО', 'ДальПрокат');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
