-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 15 2019 г., 17:38
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

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`, `user_id`) VALUES
(1, 'Kira_Taran', 47, 9),
(2, 'Artem_Tynyanyi', 45, 9),
(3, 'Sergey_Bobkov', 53, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `user_from` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'id1111875596', 'id1651861240', 'some', '2019-03-01 18:14:34', 'yes', 'no', 'no'),
(2, 'id1111875596', 'id1651861240', 'I\'m some fruit', '2019-03-01 18:18:16', 'yes', 'no', 'no'),
(3, 'id1111875596', 'id1651861240', 'new message', '2019-03-01 18:18:32', 'yes', 'no', 'no'),
(4, 'id1111875596', 'id1651861240', 'new message', '2019-03-01 18:18:39', 'yes', 'no', 'no'),
(5, 'id1651861240', 'id1111875596', 'hi, artem, how are you', '2019-03-01 18:19:34', 'yes', 'no', 'no'),
(6, 'id1651861240', 'id1111875596', 'some', '2019-03-01 18:22:09', 'yes', 'no', 'no'),
(7, 'id1651861240', 'id1111875596', 'some', '2019-03-01 18:22:14', 'yes', 'no', 'no'),
(8, 'id1111875596', 'id1651861240', 'some', '2019-03-01 18:24:07', 'yes', 'no', 'no'),
(9, 'id1111875596', 'id1651861240', 'some', '2019-03-01 18:24:11', 'yes', 'no', 'no'),
(10, 'id1111875596', 'id955072364', 'some', '2019-03-07 14:42:15', 'yes', 'no', 'no'),
(11, 'id1111875596', 'id1651861240', 'hi', '2019-03-07 15:22:00', 'yes', 'no', 'no'),
(12, 'id1111875596', 'id1651861240', 'some', '2019-03-07 15:49:19', 'yes', 'no', 'no'),
(13, 'id1111875596', 'id1651861240', 'some', '2019-03-07 15:49:40', 'yes', 'no', 'no'),
(14, 'id1111875596', 'id1651861240', 'some', '2019-03-07 15:49:53', 'yes', 'no', 'no'),
(15, 'id1111875596', 'id1651861240', 'some', '2019-03-07 15:51:31', 'yes', 'no', 'no'),
(16, 'id1111875596', 'id1651861240', 'some', '2019-03-07 15:51:47', 'yes', 'no', 'no'),
(17, 'id1111875596', 'id1651861240', 'some', '2019-03-07 15:51:57', 'yes', 'no', 'no'),
(18, 'id1111875596', 'id1651861240', 'hi', '2019-03-15 14:04:57', 'yes', 'no', 'no'),
(19, 'id1651861240', 'id1111875596', 'Привет тема, как дела', '2019-03-15 14:05:37', 'yes', 'no', 'no'),
(20, 'id1111875596', 'id1651861240', 'Привет корж, отлично', '2019-03-15 14:06:06', 'yes', 'no', 'no'),
(21, 'id1111875596', 'id1651861240', 'как ты поживаешь?', '2019-03-15 15:49:05', 'yes', 'no', 'no'),
(22, 'id1651861240', 'id1111875596', 'norm', '2019-03-15 15:50:03', 'yes', 'no', 'no'),
(23, 'id1651861240', 'id1111875596', 'norm', '2019-03-15 15:50:09', 'yes', 'no', 'no'),
(24, 'id955072364', 'id1111875596', 'hi kira', '2019-03-15 15:50:19', 'yes', 'no', 'no'),
(25, 'id955072364', 'id1651861240', 'hi', '2019-03-15 15:53:08', 'yes', 'no', 'no'),
(26, 'id955072364', 'id1651861240', 'how are yuo', '2019-03-15 15:53:29', 'yes', 'no', 'no'),
(27, 'id1111875596', 'id955072364', 'a new messages', '2019-03-15 15:54:09', 'yes', 'no', 'no'),
(28, 'id1651861240', 'id955072364', 'new', '2019-03-15 15:54:20', 'no', 'no', 'no'),
(29, 'id1651861240', 'id955072364', 'new', '2019-03-15 15:54:24', 'no', 'no', 'no'),
(30, 'id1651861240', 'id955072364', 'new', '2019-03-15 15:55:42', 'no', 'no', 'no'),
(31, 'id1651861240', 'id955072364', 'new', '2019-03-15 15:58:30', 'no', 'no', 'no'),
(32, 'id1651861240', 'id955072364', 'new', '2019-03-15 16:01:07', 'no', 'no', 'no'),
(33, 'id1651861240', 'id955072364', 'new', '2019-03-15 16:03:13', 'no', 'no', 'no'),
(34, 'id1651861240', 'id955072364', 'new', '2019-03-15 16:05:21', 'no', 'no', 'no'),
(35, 'id1651861240', 'id955072364', 'new', '2019-03-15 16:06:18', 'no', 'no', 'no'),
(36, 'id1651861240', 'id1111875596', 'hi', '2019-03-15 16:25:14', 'no', 'no', 'no'),
(37, 'id1111875596', 'id955072364', 'как у тебя дела, что нового пойдем углять', '2019-03-15 16:33:11', 'yes', 'no', 'no'),
(38, 'id955072364', 'id1111875596', 'hi kira', '2019-03-15 16:34:47', 'yes', 'no', 'no'),
(39, 'id484991212', 'id1111875596', 'hi man', '2019-03-15 16:37:39', 'no', 'no', 'no'),
(40, 'id484991212', 'id1111875596', 'hi man', '2019-03-15 16:37:45', 'no', 'no', 'no'),
(41, 'id484991212', 'id1111875596', 'hi man', '2019-03-15 16:39:20', 'no', 'no', 'no'),
(42, 'id484991212', 'id1111875596', 'hi man', '2019-03-15 16:39:54', 'no', 'no', 'no'),
(43, 'id484991212', 'id1111875596', 'hi man', '2019-03-15 16:40:11', 'no', 'no', 'no'),
(44, 'id484991212', 'id1111875596', 'hi man', '2019-03-15 16:40:26', 'no', 'no', 'no'),
(45, 'id955072364', 'id1111875596', 'how are you', '2019-03-15 16:49:11', 'yes', 'no', 'no'),
(46, 'id955072364', 'id1111875596', 'как у тебя дела, что нового пойдем углять', '2019-03-15 16:49:49', 'yes', 'no', 'no'),
(47, 'id1111875596', 'id955072364', 'all good', '2019-03-15 16:50:25', 'no', 'no', 'no');

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
(45, 'hi, serj', '12', '9', '2019-02-15 15:48:38', 'no', 'no', 1, 12),
(46, 'hi, Artem, how are you?', '9', '12', '2019-02-15 15:56:54', 'no', 'yes', 0, 9),
(47, 'hi, sergey', '10', '9', '2019-02-15 16:52:02', 'no', 'no', 1, 10),
(48, 'some', '9', 'none', '2019-02-15 16:52:49', 'no', 'yes', 0, 9),
(49, 'some', '9', 'none', '2019-02-15 16:53:44', 'no', 'yes', 0, 9),
(50, 'some', '9', 'none', '2019-02-15 18:21:42', 'no', 'yes', 0, 9),
(51, 'some', '9', 'none', '2019-02-22 17:35:05', 'no', 'yes', 0, 9),
(52, 'some', '9', 'none', '2019-02-22 17:35:20', 'no', 'yes', 0, 9),
(53, 'some', '9', 'none', '2019-03-01 14:15:38', 'no', 'no', 1, 9),
(54, 'some', '9', 'none', '2019-03-01 14:16:05', 'no', 'no', 0, 9),
(55, 'new post something', '10', 'none', '2019-03-15 16:45:16', 'no', 'no', 0, 10);

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
(9, 'id1111875596', 'Sergey', 'Bobkov', 'Sergey_Bobkov', 'sergey_bobkov@inbox.ru', '$2y$10$/24E1EVKTnPXHlI67BY5leHtaSWcczXToZVJPHCwooiiij3gmZaSC', '2018-12-21', 'assets/images/profile_pics/id11118755963ab287001466a250e795b2337cde6a2bn.jpeg', 28, 4, 'no', ',10,12,'),
(10, 'id955072364', 'Kira', 'Taran', 'Kira_Taran', 'taran.kira@rambler.ru', '$2y$10$Ni0/fYKpm/XxxFDsPnqXZu9r6Ci/AveQRPHf2yfyVRLlN3NzomiiK', '2018-12-21', 'assets/images/profile_pics/id955072364d295d4db29625687dd285f7e3fbc48b5n.jpeg', 10, 4, 'no', ',9,12,'),
(11, 'id1813683130', 'Sergey', 'Bobkov', 'Sergey_Bobkov', 'sergey_bobkov1@inbox.ru', '$2y$10$HSdgwbG7mBDWqPy9CQPZA.IE8OoCUeXe6oA1XATvbqvW.fa5288Sq', '2018-12-21', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(12, 'id1651861240', 'Artem', 'Tynyanyi', 'Artem_Tynyanyi', 'tyn@yandex.ru', '$2y$10$gzxnCNA3Gn/jnucH7LxiUuCw0RJ.z8Laq2SeXJcg9yEQI2MMaOBV.', '2018-12-28', 'assets/images/profile_pics/id16518612406a869ab37456c83e6319187473346d85n.jpeg', 5, 1, 'no', ',10,9,10,'),
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
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
