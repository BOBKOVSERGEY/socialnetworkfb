-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 15 2019 г., 18:23
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
-- Структура таблицы `friend_request`
--

CREATE TABLE `friend_request` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `user_from` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(255) NOT NULL,
  `deleted` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `user_id`) VALUES
(43, 'some', '9', 'none', '2019-02-15 15:39:42', 'no', 'yes', 0, 9),
(45, 'hi, serj', '12', '9', '2019-02-15 15:48:38', 'no', 'no', 0, 12),
(46, 'hi, Artem, how are you?', '9', '12', '2019-02-15 15:56:54', 'no', 'no', 0, 9),
(47, 'hi, sergey', '10', '9', '2019-02-15 16:52:02', 'no', 'no', 0, 10),
(48, 'some', '9', 'none', '2019-02-15 16:52:49', 'no', 'yes', 0, 9),
(49, 'some', '9', 'none', '2019-02-15 16:53:44', 'no', 'yes', 0, 9),
(50, 'some', '9', 'none', '2019-02-15 18:21:42', 'no', 'yes', 0, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `posts_comments`
--

CREATE TABLE `posts_comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `posted_to` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts_comments`
--

INSERT INTO `posts_comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(33, 'some', '9', '10', '2019-02-15 17:16:00', 'no', 47);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `unique_id` varchar(255) NOT NULL,
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
(9, 'id1111875596', 'Sergey', 'Bobkov', 'Sergey_Bobkov', 'sergey_bobkov@inbox.ru', '$2y$10$/24E1EVKTnPXHlI67BY5leHtaSWcczXToZVJPHCwooiiij3gmZaSC', '2018-12-21', 'assets/images/profile_pics/defaults/head_emerald.png', 24, 3, 'no', ',10,12,'),
(10, 'id955072364', 'Kira', 'Taran', 'Kira_Taran', 'taran.kira@rambler.ru', '$2y$10$Ni0/fYKpm/XxxFDsPnqXZu9r6Ci/AveQRPHf2yfyVRLlN3NzomiiK', '2018-12-21', 'assets/images/profile_pics/defaults/head_emerald.png', 9, 3, 'no', ',9,'),
(11, 'id1813683130', 'Sergey', 'Bobkov', 'Sergey_Bobkov', 'sergey_bobkov1@inbox.ru', '$2y$10$HSdgwbG7mBDWqPy9CQPZA.IE8OoCUeXe6oA1XATvbqvW.fa5288Sq', '2018-12-21', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(12, 'id1651861240', 'Artem', 'Tynyanyi', 'Artem_Tynyanyi', 'tyn@yandex.ru', '$2y$10$gzxnCNA3Gn/jnucH7LxiUuCw0RJ.z8Laq2SeXJcg9yEQI2MMaOBV.', '2018-12-28', 'assets/images/profile_pics/defaults/head_emerald.png', 5, 0, 'no', ',10,9,'),
(13, 'id484991212', 'Nikita', 'Borovok', 'Nikita_Borovok', 'n1@n.ru', '$2y$10$oZWYnBNcMuMpOy2EFOCcaeoB8iiMo01KJEM/zLKaE3U7VHu/I5pKi', '2019-02-08', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts_comments`
--
ALTER TABLE `posts_comments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `posts_comments`
--
ALTER TABLE `posts_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
