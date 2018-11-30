-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 30 2018 г., 15:49
-- Версия сервера: 5.7.20
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `SocialNetworkFB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `unique_id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `unique_id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(3, 1973230180, 'Sergey', 'Bobkov', 'Sergey_Bobkov', 'sergey_bobkov@inbox.ru', '$2y$10$bdHZPVcBfSvW5klU1GM9Iu9RjjAc6cwg6D./kS583qoz7lIFp34MS', '2018-11-30', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(4, 1098113401, 'Kira', 'Taran', 'Kira_Taran', 'taran.kira@rambler.ru', '$2y$10$HfW59LizWWAog3fWqCI0ouMbvDu8cLPyic8Je2m3OxdNCreicA2JG', '2018-11-30', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(5, 29243417, 'Sergey', 'Bobkov', 'Sergey_Bobkov', 'sergey_bobkov2@inbox.ru', '$2y$10$r58NrMRPzxt7i71fQcrsoemgmuz2pB.v2ShHHzf78/wToo3aoOlk6', '2018-11-30', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ',');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
