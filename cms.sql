-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 15 2013 г., 23:51
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_image` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `dt` date NOT NULL,
  `is_show` enum('0','1','2') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id_article`, `id_image`, `title`, `content`, `dt`, `is_show`) VALUES
(1, 149, 'Новая крутая CMS', '<p>))))))))))))))))))</p>\r\n\r\n<p><widget title="Обращение" widget-type="document-pdf">[[--widget/documents/7--]]</widget></p>\r\n\r\n<p>выаавы</p>\r\n', '2013-12-15', '1'),
(2, 144, 'Битрикс в страхе от новой CMS ШП', '<p>ухахахаха</p>\r\n\r\n<p>Они реально в шоке!!!!</p>\r\n', '2013-12-15', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `docs`
--

CREATE TABLE IF NOT EXISTS `docs` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `path` varchar(256) NOT NULL,
  `type` varchar(3) NOT NULL,
  `is_show` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_doc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `docs`
--

INSERT INTO `docs` (`id_doc`, `title`, `path`, `type`, `is_show`) VALUES
(7, 'Обращение', 'Obraschenie.pdf', 'pdf', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `title` varchar(256) NOT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `name`, `title`) VALUES
(1, 'main', 'Главная'),
(8, 'gallery1', 'Основная галерея');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id_gallery` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  `num_sort` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id_gallery` (`id_gallery`,`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery_images`
--

INSERT INTO `gallery_images` (`id_gallery`, `id_image`, `num_sort`) VALUES
(1, 138, 0),
(1, 139, 0),
(1, 140, 0),
(1, 141, 0),
(1, 142, 0),
(1, 143, 0),
(1, 146, 0),
(1, 147, 0),
(1, 148, 0),
(8, 131, 1),
(8, 132, 3),
(8, 133, 2),
(8, 134, 0),
(8, 135, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(256) NOT NULL,
  `title_image` varchar(256) NOT NULL,
  `alt` varchar(256) NOT NULL,
  `href` varchar(256) NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=150 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_image`, `path`, `title_image`, `alt`, `href`) VALUES
(1, '7186631.jpg', '', '', ''),
(2, '8328726.jpg', '', '', ''),
(3, '8687432.jpg', '', '', ''),
(4, '9016177.jpg', '', '', ''),
(5, '5402774.jpg', '', '', ''),
(6, '8754409.jpg', '', '', ''),
(34, '6693198.jpg', '', '', ''),
(35, '6543276.jpg', '', '', ''),
(36, '9294802.jpg', '', '', ''),
(39, 'italtrike.jpg', '', '', ''),
(51, 'Bauman.jpeg', '', '', ''),
(58, 'milc(1).jpg', '', '', ''),
(59, 'ARTA6671(1).JPG', '', '', ''),
(60, 'site.jpg', '', '', ''),
(61, '17907321.jpg', '', '', ''),
(63, 'photo-small.jpg', '', '', ''),
(66, 'news-image1.jpg', '', '', ''),
(130, 'Penguins(1).jpg', '', '', ''),
(131, '8084266.jpg', '', '', ''),
(132, '2112795.jpg', 'Сначала сюды идёшь', '', ''),
(133, '7027612.jpg', 'Уворачиваешься от неё', '', ''),
(134, '7890804.jpg', 'Далее вот этот ориентир', 'Зимой он без лепестков', ''),
(135, '3562331.jpg', '', '', ''),
(138, '6443.jpg', '12344', '', ''),
(139, '8720299.jpg', '', '', ''),
(140, '9000111.jpg', '', '', ''),
(141, '636407.jpg', '', '', ''),
(142, '127504.jpg', '', '', ''),
(143, '4988415.jpg', '', '', ''),
(144, 'Koala(1).jpg', '', '', ''),
(146, '9512200.jpg', '', '', ''),
(147, '5342519.jpg', '', '', ''),
(148, '6404248.jpg', '', '', ''),
(149, 'Penguins(2).jpg', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id_menu`, `title`) VALUES
(1, 'Верхнее'),
(2, 'Для главной'),
(3, 'Для компов');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_pages`
--

CREATE TABLE IF NOT EXISTS `menu_pages` (
  `id_menu` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `num_sort` int(11) NOT NULL,
  UNIQUE KEY `id_menu` (`id_menu`,`id_page`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_pages`
--

INSERT INTO `menu_pages` (`id_menu`, `id_page`, `num_sort`) VALUES
(1, 1, 0),
(1, 2, 1),
(1, 3, 2),
(1, 4, 3),
(2, 2, 0),
(2, 3, 1),
(2, 4, 2),
(2, 13, 3),
(3, 14, 0),
(3, 15, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `url` varchar(256) NOT NULL,
  `full_cache_url` varchar(512) NOT NULL,
  `title` varchar(256) NOT NULL,
  `title_in_menu` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `keywords` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `is_show` enum('0','1','2') NOT NULL DEFAULT '1',
  `children_sort` int(11) NOT NULL DEFAULT '0',
  `id_template` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_page`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id_page`, `id_menu`, `id_parent`, `url`, `full_cache_url`, `title`, `title_in_menu`, `content`, `keywords`, `description`, `is_show`, `children_sort`, `id_template`) VALUES
(1, 2, 0, 'home', 'home', 'Главная', 'Главная', '<p>Главная!</p>\n\n<p>Уважаемый участник семинара, прочтите обращение <widget title="Обращение" widget-type="document-pdf">[[--widget/documents/7--]]</widget></p>\n', 'Главная', 'Главная', '1', 0, 1),
(2, 0, 0, 'products', 'products', 'Товары', 'Товары', '<p>Товары</p>\r\n', 'Товары', 'Товары', '1', 0, 1),
(3, 0, 0, 'services', 'services', 'Услуги', 'Услуги', '<p>Услуги</p>\r\n', 'Услуги', 'Услуги', '1', 0, 1),
(4, 2, 0, 'contacts', 'contacts', 'Контакты', 'Новые Контакты', '<p>Добраться до нас можно так:</p>\r\n\r\n<p><widget title="Основная галерея" widget-type="slider">[[--widget/slider/8--]]</widget></p>\r\n', 'Контакты', 'Контакты', '1', 0, 3),
(5, 0, 2, 'computers', 'products/computers', 'Компы', 'Компы', '<p>Компы</p>\r\n', 'Компы', 'Компы', '1', 0, 1),
(6, 0, 2, 'gadgets', 'products/gadgets', 'Гаджеты', 'Гаджеты', '<p>Гаджеты</p>\n\n<p><widget title="Главная" widget-type="lightbox">[[--widget/gallery/1--]]</widget></p>\n', 'Гаджеты', 'Гаджеты', '1', 0, 1),
(7, 3, 5, 'notebooks', 'products/computers/notebooks', 'Ноутбуки', 'Ноутбуки', '<p>Ноутбуки</p>\r\n', 'Ноутбуки', 'Ноутбуки', '1', 0, 1),
(8, 0, 5, 'base', 'products/computers/base', 'Стационарные', 'Стационарные', '<widget title="Главная" widget-type="slider">[[--widget/slider/1--]]</widget>\n<p>Стационарные</p>\n', 'Стационарные', 'Стационарные', '1', 0, 1),
(9, 0, 5, 'mono', 'products/computers/mono', 'Моноблоки', 'Моноблоки', '<p>Моноблоки</p>\r\n', 'Моноблоки', 'Моноблоки', '1', 0, 1),
(10, 0, 3, 'repair', 'services/repair', 'Ремонт', 'Ремонт', '<p>Ремонт</p>\r\n', 'Ремонт', 'Ремонт', '1', 0, 1),
(11, 0, 3, 'utilization', 'services/utilization', 'Утилизация', 'Утилизация', '<p>Утилизация</p>\r\n', 'Утилизация', 'Утилизация', '1', 0, 1),
(12, 0, 3, 'software', 'services/software', 'Установка ПО', 'Установка ПО', '<p>Установка ПО</p>\r\n', 'Установка ПО', 'Установка ПО', '1', 0, 1),
(13, 0, 0, 'news', 'news', 'Новости', 'Новости', '<p>Новости</p>\r\n', 'Новости', 'Новости', '1', 0, 1),
(14, 3, 7, 'asus', 'products/computers/notebooks/asus', 'Asus', 'Asus', '<p>Asus</p>\r\n\r\n<p><widget title="Главная" widget-type="slider">[[--widget/slider/1--]]</widget></p>\r\n', 'Asus', 'Asus', '1', 0, 3),
(15, 0, 7, 'acer', 'products/computers/notebooks/acer', 'acer', 'acer', '<p><em><strong>acer</strong></em></p>\n\n<p><em><strong>dfghjkl</strong></em></p>\n\n<p><img alt="" height="183" src="/media/images/ck/55eca11aecbd.jpg" width="245" /></p>\n', 'acer', 'acer', '1', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `privs`
--

CREATE TABLE IF NOT EXISTS `privs` (
  `id_priv` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id_priv`),
  UNIQUE KEY `name` (`name`(200))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `privs`
--

INSERT INTO `privs` (`id_priv`, `name`, `description`) VALUES
(1, 'ALL', 'Всё может'),
(2, 'PAGES', 'Редактирование страниц');

-- --------------------------------------------------------

--
-- Структура таблицы `privs2roles`
--

CREATE TABLE IF NOT EXISTS `privs2roles` (
  `id_priv` int(5) NOT NULL,
  `id_role` int(5) NOT NULL,
  PRIMARY KEY (`id_priv`,`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `privs2roles`
--

INSERT INTO `privs2roles` (`id_priv`, `id_role`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `name` (`name`(200))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id_role`, `name`, `description`) VALUES
(1, 'admin', 'Администратор'),
(2, 'manager', 'Контент мен');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_last` datetime NOT NULL,
  PRIMARY KEY (`id_session`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id_session`, `id_user`, `sid`, `time_start`, `time_last`) VALUES
(1, 1, 'GQpR4st4uK', '2013-04-30 19:08:40', '2013-04-30 19:18:07'),
(2, 1, 'iIalUiff9G', '2013-04-30 19:34:03', '2013-04-30 19:35:37'),
(3, 1, '2ZgZmLUXYG', '2013-06-18 21:19:20', '2013-06-18 21:21:49'),
(4, 1, '5HknSFgN6U', '2013-06-18 21:36:34', '2013-06-18 21:36:45'),
(5, 1, 'gBb3kVmYfH', '2013-07-26 18:46:34', '2013-07-26 18:46:50'),
(6, 1, 'q9dJ75UWdD', '2013-07-26 19:05:04', '2013-07-26 19:07:43'),
(7, 1, 'y5P6rvi7Ak', '2013-07-26 19:07:46', '2013-07-26 19:15:54'),
(8, 1, 'afOJF1na7a', '2013-07-26 19:15:57', '2013-07-26 19:39:50'),
(9, 1, '22cugtYmrZ', '2013-08-23 11:23:43', '2013-08-23 12:04:45'),
(10, 1, '3XNVFBFzKI', '2013-08-23 13:31:49', '2013-08-23 13:32:38'),
(11, 1, '0oKvzJ6I7I', '2013-08-23 20:54:53', '2013-08-23 20:55:03'),
(12, 1, 'rGo8gi4wJr', '2013-08-23 21:28:38', '2013-08-23 21:29:33'),
(13, 1, 'TxGLhArsfc', '2013-08-23 21:36:03', '2013-08-23 21:59:31'),
(14, 1, 'TZQLy5JpX6', '2013-09-24 19:07:33', '2013-09-24 19:36:19'),
(15, 1, 'zvMM8RFjFL', '2013-09-24 19:47:03', '2013-09-24 19:48:45'),
(16, 1, 'fZ5jZ1yujZ', '2013-09-29 15:19:47', '2013-09-29 19:04:04'),
(17, 1, 'uRowD47g9T', '2013-10-12 18:46:01', '2013-10-12 20:51:55'),
(18, 1, '7TPiZwgaAZ', '2013-10-13 12:39:30', '2013-10-13 13:16:46'),
(19, 1, 'Rx1TrpNrHk', '2013-10-13 14:13:57', '2013-10-13 17:44:43'),
(20, 1, 'cRUo4uY5mv', '2013-10-13 17:46:29', '2013-10-13 18:03:01'),
(21, 1, 'XvPniU6MYg', '2013-10-13 18:03:28', '2013-10-13 18:05:11'),
(22, 1, 'aiI2bYYr0P', '2013-10-13 18:05:23', '2013-10-13 18:06:40'),
(23, 2, '297EvPujE6', '2013-10-13 18:06:47', '2013-10-13 18:07:36'),
(24, 1, 'ac4HqIybi8', '2013-10-13 18:07:44', '2013-10-13 18:51:47'),
(25, 1, 'KLrvVim1BP', '2013-10-14 00:30:10', '2013-10-14 00:30:21'),
(26, 1, 'ks09qrxOZT', '2013-10-19 11:49:10', '2013-10-19 11:49:52'),
(27, 1, 'pJw3otP4si', '2013-10-24 18:49:53', '2013-10-24 18:50:11'),
(28, 1, 'QtW920PPrq', '2013-10-25 18:46:16', '2013-10-25 18:46:34'),
(29, 1, '9WgVaKxM5x', '2013-10-31 14:26:20', '2013-10-31 14:27:01'),
(30, 3, 'H3GNVrU3Ud', '2013-10-31 14:29:08', '2013-10-31 14:29:19'),
(31, 1, 'msIJDN0kav', '2013-10-31 14:29:25', '2013-10-31 14:34:40'),
(32, 1, 'pbolJ1AKjr', '2013-10-31 14:35:43', '2013-10-31 14:59:59'),
(33, 1, 'Fh7JBcbtit', '2013-10-31 15:21:37', '2013-10-31 15:21:44'),
(34, 1, '1ihLpqi5hM', '2013-10-31 16:55:41', '2013-10-31 16:55:51'),
(35, 1, '6a8rDcAnWe', '2013-10-31 17:25:45', '2013-10-31 17:43:43'),
(36, 3, 'TN21QTMvDs', '2013-11-01 18:45:46', '2013-11-01 18:46:13'),
(37, 3, 'PacnTAiryD', '2013-11-02 19:01:10', '2013-11-02 19:01:28'),
(38, 1, 'DCsNr7UGTd', '2013-11-02 19:01:39', '2013-11-02 19:36:29'),
(39, 1, 'xQujuKGDbC', '2013-11-02 19:36:32', '2013-11-03 01:46:59'),
(40, 1, 'YrSMwbyM6j', '2013-11-02 22:17:59', '2013-11-02 22:20:53'),
(41, 3, 'p9rdHwNors', '2013-11-03 13:54:45', '2013-11-03 13:54:51'),
(42, 1, '3UxnCjAy7c', '2013-11-03 13:55:02', '2013-11-03 13:57:27'),
(43, 1, '81FnqFlgLP', '2013-11-03 14:18:01', '2013-11-03 14:41:03'),
(44, 1, '9CIQV3SMAL', '2013-11-03 14:23:20', '2013-11-03 14:43:04'),
(45, 1, '1TUS4RyU3g', '2013-11-03 14:43:10', '2013-11-03 18:46:46'),
(46, 1, '4Jul8360ez', '2013-11-03 18:47:43', '2013-11-03 18:48:59'),
(47, 1, 'xx6fuLAnvo', '2013-11-03 22:59:37', '2013-11-04 00:13:46'),
(48, 3, 'bMv0JqhdrJ', '2013-11-04 00:10:36', '2013-11-04 00:22:25'),
(49, 3, '9f3mnLhEWe', '2013-11-04 00:13:01', '2013-11-04 00:24:18'),
(50, 3, 'cNrvxx5WEP', '2013-11-04 00:13:47', '2013-11-04 00:16:54'),
(51, 1, 'JpqeM2pOBs', '2013-11-04 00:16:57', '2013-11-04 00:21:34'),
(52, 3, 'htpYoh7K40', '2013-11-09 01:08:07', '2013-11-09 01:09:15'),
(53, 3, '5wsdP87z6n', '2013-11-09 01:09:15', '2013-11-09 01:09:27'),
(54, 3, 'iuo9ZvEYhO', '2013-11-09 01:09:40', '2013-11-09 01:14:38'),
(55, 1, 'Sbfj3TExWO', '2013-11-09 01:14:46', '2013-11-09 01:14:55'),
(56, 1, 'MTIX7QuADs', '2013-11-09 23:26:04', '2013-11-10 00:10:42'),
(57, 1, 'e538PZ0teF', '2013-11-10 00:10:48', '2013-11-10 01:09:47'),
(58, 1, 'w1eOkNWKUo', '2013-11-10 12:06:18', '2013-11-10 13:20:18'),
(59, 1, 'UtL5kMpCB6', '2013-11-10 18:13:47', '2013-11-10 22:18:32'),
(60, 1, 'daMCl3sTEW', '2013-11-12 00:36:48', '2013-11-12 01:49:33'),
(61, 1, 'SkBq5RYvsh', '2013-11-12 23:25:38', '2013-11-13 01:49:45'),
(62, 1, 'q7pbR0OwjL', '2013-11-13 23:33:55', '2013-11-13 23:45:02'),
(63, 1, 'P1rU5fIhMC', '2013-11-13 23:45:08', '2013-11-14 00:02:47'),
(64, 1, 'oRbm61eMHb', '2013-11-16 00:47:18', '2013-11-16 00:48:35'),
(65, 1, 'yRXAHTtR5s', '2013-11-17 00:06:08', '2013-11-17 02:10:05'),
(66, 1, 'FcPaMPjsSB', '2013-11-17 02:02:40', '2013-11-17 02:02:40'),
(67, 1, 'WSGCablhBd', '2013-11-17 13:17:21', '2013-11-17 21:01:26'),
(68, 1, 'voB0x0QGjJ', '2013-11-17 14:59:19', '2013-11-17 18:04:17'),
(69, 1, 'o24raM5b46', '2013-11-17 19:14:57', '2013-11-17 19:15:15'),
(70, 1, 'ektGBkPnoy', '2013-11-17 22:42:15', '2013-11-17 23:15:08'),
(71, 1, 'Lv7Xm627El', '2013-11-18 23:25:28', '2013-11-19 00:24:04'),
(72, 1, '1yLGRJckCm', '2013-11-19 00:24:13', '2013-11-19 00:53:37'),
(73, 1, 'KwAjhXV4ra', '2013-11-19 00:53:46', '2013-11-19 01:16:04'),
(74, 1, 'cYAYWzjEKu', '2013-11-19 01:16:14', '2013-11-19 01:20:19'),
(75, 1, 'GAqfjMSxJE', '2013-11-20 23:36:22', '2013-11-21 01:23:30'),
(76, 1, 'IkFNkw7Oh4', '2013-11-21 23:08:19', '2013-11-21 23:11:45'),
(77, 1, 'VA7s3hrrbB', '2013-11-22 20:29:25', '2013-11-22 20:38:52'),
(78, 1, 'w2FVD1lOMZ', '2013-11-25 11:50:43', '2013-11-25 12:24:51'),
(79, 1, 'desXnc2V6t', '2013-11-27 15:55:28', '2013-11-27 22:05:53'),
(80, 1, 'oMATLZb8B1', '2013-11-28 11:06:38', '2013-11-28 17:21:55'),
(81, 1, 'dc4PbTYf0Y', '2013-11-28 12:19:52', '2013-11-28 17:19:28'),
(82, 1, 'I6uJavRjvd', '2013-11-28 18:04:47', '2013-11-28 19:25:29'),
(83, 1, 'x5YIiph05C', '2013-11-28 19:25:57', '2013-11-28 21:52:56'),
(84, 1, 'tu25qvTfEs', '2013-11-28 22:57:20', '2013-11-29 01:05:57'),
(85, 1, 'jQxgtx4pWk', '2013-11-29 01:10:27', '2013-11-29 01:22:32'),
(86, 1, 'WcGdFmxBgL', '2013-11-29 23:31:59', '2013-11-30 01:40:47'),
(87, 1, '6nbaCrc5UI', '2013-11-29 23:32:57', '2013-11-29 23:56:45'),
(88, 1, 'VzDJsFnipj', '2013-11-30 22:31:18', '2013-11-30 23:18:36'),
(89, 1, 'H0XJaZedxI', '2013-12-01 22:06:17', '2013-12-01 23:36:52'),
(90, 1, '77B4CIoNnJ', '2013-12-01 23:37:00', '2013-12-02 01:28:40'),
(91, 1, 'Hj5Rrma51q', '2013-12-02 23:37:44', '2013-12-03 00:57:58'),
(92, 1, 'mcMIi6p8El', '2013-12-05 14:09:57', '2013-12-05 14:25:49'),
(93, 1, 'MFBu89u5i3', '2013-12-10 21:06:07', '2013-12-10 21:07:49'),
(94, 1, 'XzIufaqCTG', '2013-12-14 11:44:36', '2013-12-14 12:09:31'),
(95, 1, '2Ea1oajmwK', '2013-12-14 12:19:32', '2013-12-14 12:20:05'),
(96, 1, 'Y1fRxikQGB', '2013-12-15 17:15:52', '2013-12-15 18:08:50'),
(97, 1, 'u5I2QW9eJb', '2013-12-15 18:09:05', '2013-12-15 20:04:36'),
(98, 1, 'SYMsmj35J3', '2013-12-15 19:52:03', '2013-12-15 19:52:39'),
(99, 1, 'Kivy0sxWbD', '2013-12-15 19:53:02', '2013-12-15 19:54:34'),
(100, 1, '5CxmMTnop3', '2013-12-15 20:05:11', '2013-12-15 20:05:16'),
(101, 1, 'VZQK9viqUN', '2013-12-15 20:06:15', '2013-12-15 20:06:19'),
(102, 1, '3ofmkTARYt', '2013-12-15 20:07:02', '2013-12-15 20:07:06'),
(103, 1, 'trgAztbzdI', '2013-12-15 20:09:17', '2013-12-15 20:24:55'),
(104, 1, 'daa6ciyHoj', '2013-12-15 21:11:19', '2013-12-15 21:13:14'),
(105, 1, 'dpkVGyI8Az', '2013-12-15 21:14:06', '2013-12-15 23:06:19');

-- --------------------------------------------------------

--
-- Структура таблицы `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id_template` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id_template`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `templates`
--

INSERT INTO `templates` (`id_template`, `path`, `name`) VALUES
(1, 'v_main.php', 'Основной'),
(3, 'v_index.php', 'для главной');

-- --------------------------------------------------------

--
-- Структура таблицы `texts`
--

CREATE TABLE IF NOT EXISTS `texts` (
  `id_text` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(30) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `dt` date NOT NULL,
  `is_show` enum('0','1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_text`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `texts`
--

INSERT INTO `texts` (`id_text`, `alias`, `title`, `content`, `dt`, `is_show`) VALUES
(1, 'f_contacts', 'Подвал2', 'Ещё какой-нибудь текст в подвале', '0000-00-00', '1'),
(2, 'h_contacts', 'Шапка', '8911111111111', '2013-11-21', '1'),
(4, 'h_title', 'заголовок в шапке', 'Название сайта3456', '2013-11-25', '1'),
(5, 'f_copyright', 'копирайт', 'Текст в подвале с каким-нибудь копирайтом &copy;', '2013-11-25', '1'),
(6, 'f_developer', 'Разработчик', 'Кем-то создано', '2013-11-25', '1'),
(7, 'h_subtitle', 'Подзаголовок в шапке', 'Сайт что-то делает', '2013-12-05', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `login` varchar(256) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_role` int(5) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `login` (`login`(200))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `id_role`, `name`) VALUES
(1, 'test@test.ru', '202cb962ac59075b964b07152d234b70', 1, 'admin'),
(2, 'manager', '202cb962ac59075b964b07152d234b70', 2, 'Пупс'),
(3, '123', '202cb962ac59075b964b07152d234b70', 2, '123'),
(4, 'sda', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'dsfds'),
(5, '12334', '202cb962ac59075b964b07152d234b70', 1, 'rerege'),
(7, 'sadsadsa', '202cb962ac59075b964b07152d234b70', 1, 'dadas');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
