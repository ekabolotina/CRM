-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 09 2018 г., 16:36
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
-- Структура таблицы `url`
--

CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `url`
--

INSERT INTO `url` (`id`, `url`, `page`) VALUES
(1, 'login', 'main/login.php'),
(2, '', 'main/main.php'),
(3, 'login_user', 'main/api/login.php'),
(5, 'logout', 'main/api/logout.php'),
(6, 'order/new', 'order/add.php'),
(8, 'auto/add', 'auto/add.php'),
(9, 'clients/add', 'client/add.php'),
(11, 'auto/add/getCarMakes', 'car/api/get_makes_list.php'),
(12, 'auto/add/getCarModels', 'car/api/get_models_list.php'),
(13, 'auto/add/addCar', 'auto/api/add.php'),
(14, 'auto/all', 'auto/list.php'),
(15, 'clients/add/addClient', 'client/api/add.php'),
(16, 'clients/all', 'client/list.php'),
(17, 'clients/all/getCientsList', 'client/api/get_list.php'),
(18, 'auto/all/getAutoList', 'auto/api/get_list.php'),
(19, 'order/process', 'order/api/create.php'),
(20, 'order/genRentContract', 'order/contract.php'),
(21, 'order/all', 'order/list.php'),
(22, 'order/return', 'order/api/return.php'),
(24, 'order/getOrder', 'order/api/get.php'),
(25, 'settings', 'main/settings.php'),
(26, 'settings/save', 'main/api/settings_save.php'),
(28, 'clients/getClient', 'client/api/get_single.php'),
(29, 'clients/getFeedbackUser', 'client/api/get_feedback.php'),
(30, 'uploadFile', 'file/api/upload.php'),
(31, 'removeFile', 'file/api/remove.php'),
(32, 'feedback', 'main/feedback.php'),
(33, 'feedback/process', 'main/api/feedback_send.php'),
(34, 'clients/edit', 'client/edit.php'),
(35, 'clients/edit/updateClient', 'client/api/update.php'),
(36, 'car/addModel/add', 'car/api/add_model.php'),
(37, 'car/addModel', 'car/add_model.php'),
(38, 'admin', 'admin/overview.php'),
(39, 'admin/company', 'admin/admin/company.php'),
(40, 'admin/api/branch/add', 'admin/api/add_branch.php'),
(41, 'admin/company/add', 'admin/admin/add_company.php'),
(42, 'admin/api/company/add', 'admin/api/add_company.php'),
(43, 'admin/branch/add', 'admin/company/add_branch.php'),
(44, 'admin/branch', 'admin/company/branch.php');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `url`
--
ALTER TABLE `url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
