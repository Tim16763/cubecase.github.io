-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 05 2018 г., 16:28
-- Версия сервера: 5.5.59-0+deb8u1
-- Версия PHP: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cases`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cases`
--

CREATE TABLE IF NOT EXISTS `cases` (
`id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `oldp` int(15) NOT NULL DEFAULT '0',
  `price` int(255) NOT NULL,
  `img` varchar(256) NOT NULL,
  `items` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `categorys`
--

CREATE TABLE IF NOT EXISTS `categorys` (
`id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE IF NOT EXISTS `config` (
`id` int(11) NOT NULL,
  `namesite` varchar(256) NOT NULL,
  `shop_id_digiseller` int(255) NOT NULL,
  `id_tovar_digiseller` int(255) NOT NULL,
  `password_digiseller` varchar(256) NOT NULL,
  `payment` varchar(256) NOT NULL,
  `shop_id_freekassa` int(255) NOT NULL,
  `secret_word_freekassa` varchar(256) NOT NULL,
  `vkgroup` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `crafts`
--

CREATE TABLE IF NOT EXISTS `crafts` (
`id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `item_id` varchar(256) NOT NULL,
  `lots` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(11) NOT NULL,
  `sell_price` int(255) NOT NULL,
  `name` varchar(256) NOT NULL,
  `img` text NOT NULL,
  `chance` int(255) NOT NULL,
  `key` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `live_drop`
--

CREATE TABLE IF NOT EXISTS `live_drop` (
`id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `item_id` varchar(256) NOT NULL,
  `case_id` varchar(256) NOT NULL,
  `key` varchar(256) NOT NULL,
  `vi` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=1628 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=1972 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `promocodes`
--

CREATE TABLE IF NOT EXISTS `promocodes` (
`id` int(11) NOT NULL,
  `code` varchar(256) NOT NULL,
  `count` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `promocode_use`
--

CREATE TABLE IF NOT EXISTS `promocode_use` (
`id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `code_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2014 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `avatar` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `balance` int(255) NOT NULL DEFAULT '0',
  `open_box` int(255) NOT NULL DEFAULT '0',
  `open_sum` int(255) NOT NULL DEFAULT '0',
  `affiliate_code` varchar(256) DEFAULT NULL,
  `affiliate_use` varchar(256) DEFAULT NULL,
  `affiliate_profit` int(255) NOT NULL DEFAULT '0',
  `role` varchar(256) NOT NULL DEFAULT 'user',
  `remember_token` text,
  `h` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3474 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `withdraw`
--

CREATE TABLE IF NOT EXISTS `withdraw` (
`id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `payway` varchar(256) NOT NULL,
  `amount` int(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cases`
--
ALTER TABLE `cases`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categorys`
--
ALTER TABLE `categorys`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `crafts`
--
ALTER TABLE `crafts`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `live_drop`
--
ALTER TABLE `live_drop`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promocodes`
--
ALTER TABLE `promocodes`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promocode_use`
--
ALTER TABLE `promocode_use`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `withdraw`
--
ALTER TABLE `withdraw`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cases`
--
ALTER TABLE `cases`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `categorys`
--
ALTER TABLE `categorys`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `config`
--
ALTER TABLE `config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `crafts`
--
ALTER TABLE `crafts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=220;
--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT для таблицы `live_drop`
--
ALTER TABLE `live_drop`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1628;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1972;
--
-- AUTO_INCREMENT для таблицы `promocodes`
--
ALTER TABLE `promocodes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `promocode_use`
--
ALTER TABLE `promocode_use`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2014;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3474;
--
-- AUTO_INCREMENT для таблицы `withdraw`
--
ALTER TABLE `withdraw`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
