-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 08 2019 г., 18:15
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
(32, 'Sergey_Bobkov', 42, 10),
(34, 'Sergey_Bobkov', 42, 9),
(35, 'Kira_Taran', 23, 9);

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
(13, 'Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, \"consectetur\", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги \"de Finibus Bonorum et Malorum\" (\"О пределах добра и зла\"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", происходит от одной из строк в разделе 1.10.32', 'Sergey_Bobkov', 'none', '2018-12-21 15:54:41', 'no', 'no', 0, 9),
(14, 'some', 'Sergey_Bobkov', 'none', '2018-12-21 15:54:57', 'no', 'no', 0, 9),
(15, 'some', 'Sergey_Bobkov', 'none', '2018-12-21 17:09:29', 'no', 'no', 0, 9),
(16, 'hello', 'Kira_Taran', 'none', '2018-12-21 17:24:46', 'no', 'no', 0, 10),
(17, 'много постов', 'Kira_Taran', 'none', '2018-12-21 17:25:21', 'no', 'no', 0, 10),
(18, 'some', 'Kira_Taran', 'none', '2018-12-26 15:32:26', 'no', 'no', 0, 10),
(19, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'Kira_Taran', 'none', '2018-12-26 15:33:07', 'no', 'no', 0, 10),
(20, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'Kira_Taran', 'none', '2018-12-26 15:33:25', 'no', 'no', 0, 10),
(21, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'Kira_Taran', 'none', '2018-12-26 15:33:41', 'no', 'no', 0, 10),
(22, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'Kira_Taran', 'none', '2018-12-26 15:33:46', 'no', 'no', 0, 10),
(23, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'Kira_Taran', 'none', '2018-12-26 15:33:49', 'no', 'no', 1, 10),
(24, 'new', 'Sergey_Bobkov', 'none', '2018-12-26 16:31:47', 'no', 'no', 0, 9),
(25, 'new', 'Sergey_Bobkov', 'none', '2018-12-26 16:31:54', 'no', 'no', 0, 9),
(26, '5', 'Sergey_Bobkov', 'none', '2018-12-26 16:31:59', 'no', 'no', 0, 9),
(27, '3', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:01', 'no', 'no', 0, 9),
(28, '44', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:04', 'no', 'no', 0, 9),
(29, '221', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:08', 'no', 'no', 0, 9),
(30, 's', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:11', 'no', 'no', 0, 9),
(31, 's', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:13', 'no', 'no', 0, 9),
(32, 's', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:15', 'no', 'no', 0, 9),
(33, 's', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:16', 'no', 'no', 0, 9),
(34, 'ыыыыыыыыыыыыы', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:19', 'no', 'no', 0, 9),
(35, 'ыыыыыыыыыыыыыыыыыыыы', 'Sergey_Bobkov', 'none', '2018-12-26 16:32:22', 'no', 'no', 0, 9),
(36, 'some', 'Artem_Tynyanyi', 'none', '2018-12-28 12:23:31', 'no', 'no', 0, 12),
(37, 'hi serj', 'Artem_Tynyanyi', 'none', '2018-12-28 12:29:24', 'no', 'no', 0, 12),
(38, 'sime', 'Sergey_Bobkov', 'none', '2018-12-28 12:57:58', 'no', 'no', 0, 9),
(39, 'some', 'Sergey_Bobkov', 'none', '2018-12-28 14:40:49', 'no', 'no', 0, 9),
(40, 'new', 'Sergey_Bobkov', 'none', '2018-12-28 14:54:36', 'no', 'no', 0, 9),
(41, 'better lessons', 'Artem_Tynyanyi', 'none', '2018-12-28 15:44:46', 'no', 'no', 0, 12),
(42, 'same', 'Sergey_Bobkov', 'none', '2019-01-11 14:24:06', 'no', 'no', 2, 9);

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
(23, '1', '9', 'Sergey_Bobkov', '2018-12-28 15:38:56', 'no', 40),
(24, '1', '9', 'Sergey_Bobkov', '2018-12-28 15:39:13', 'no', 40),
(25, 'some', '12', 'Sergey_Bobkov', '2018-12-28 15:39:53', 'no', 40),
(26, 'new', '12', 'Sergey_Bobkov', '2018-12-28 15:43:36', 'no', 39),
(27, 'some', '12', 'Artem_Tynyanyi', '2018-12-28 15:45:01', 'no', 41),
(28, 'new', '12', 'Artem_Tynyanyi', '2018-12-28 15:45:20', 'no', 41),
(29, 'new', '12', 'Sergey_Bobkov', '2018-12-28 15:45:47', 'no', 26),
(30, 'new comment', '9', 'Artem_Tynyanyi', '2018-12-28 16:18:40', 'no', 41),
(31, 'some', '9', 'Sergey_Bobkov', '2019-01-11 12:31:45', 'no', 13),
(32, '4', '9', 'Artem_Tynyanyi', '2019-01-11 14:23:55', 'no', 41);

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
(9, 'id1111875596', 'Sergey', 'Bobkov', 'Sergey_Bobkov', 'sergey_bobkov@inbox.ru', '$2y$10$/24E1EVKTnPXHlI67BY5leHtaSWcczXToZVJPHCwooiiij3gmZaSC', '2018-12-21', 'assets/images/profile_pics/defaults/head_emerald.png', 19, 3, 'no', ',10,12,'),
(10, 'id955072364', 'Kira', 'Taran', 'Kira_Taran', 'taran.kira@rambler.ru', '$2y$10$Ni0/fYKpm/XxxFDsPnqXZu9r6Ci/AveQRPHf2yfyVRLlN3NzomiiK', '2018-12-21', 'assets/images/profile_pics/defaults/head_emerald.png', 8, 3, 'no', ',9,'),
(11, 'id1813683130', 'Sergey', 'Bobkov', 'Sergey_Bobkov', 'sergey_bobkov1@inbox.ru', '$2y$10$HSdgwbG7mBDWqPy9CQPZA.IE8OoCUeXe6oA1XATvbqvW.fa5288Sq', '2018-12-21', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(12, 'id1651861240', 'Artem', 'Tynyanyi', 'Artem_Tynyanyi', 'tyn@yandex.ru', '$2y$10$gzxnCNA3Gn/jnucH7LxiUuCw0RJ.z8Laq2SeXJcg9yEQI2MMaOBV.', '2018-12-28', 'assets/images/profile_pics/defaults/head_emerald.png', 3, 0, 'no', ',10,9,'),
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `posts_comments`
--
ALTER TABLE `posts_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
