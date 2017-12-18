-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 18 2017 г., 19:36
-- Версия сервера: 5.6.31
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `twitter`
--

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `likeID` int(11) NOT NULL,
  `likeBy` int(11) NOT NULL,
  `likeOn` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`likeID`, `likeBy`, `likeOn`) VALUES
(14, 1, 2),
(15, 1, 3),
(16, 1, 1),
(17, 1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `trends`
--

CREATE TABLE IF NOT EXISTS `trends` (
  `trendID` int(11) NOT NULL,
  `hashtag` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `trends`
--

INSERT INTO `trends` (`trendID`, `hashtag`, `createdOn`) VALUES
(1, 'php', '2017-12-05 00:00:00'),
(2, 'tag', '2017-12-05 21:21:53');

-- --------------------------------------------------------

--
-- Структура таблицы `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
  `tweetID` int(11) NOT NULL,
  `status` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `tweetBy` int(11) NOT NULL,
  `retweetID` int(11) NOT NULL,
  `retweetBy` int(11) NOT NULL,
  `tweetImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `likesCount` int(11) NOT NULL,
  `retweetCount` int(11) NOT NULL,
  `postedOn` datetime NOT NULL,
  `retweetMsg` varchar(140) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tweets`
--

INSERT INTO `tweets` (`tweetID`, `status`, `tweetBy`, `retweetID`, `retweetBy`, `tweetImage`, `likesCount`, `retweetCount`, `postedOn`, `retweetMsg`) VALUES
(1, 'i &lt; 3 php', 1, 0, 0, '', 1, 0, '2017-12-02 16:53:09', ''),
(2, 'ура!!!', 1, 0, 0, 'users/preview_1365523262.jpg', 1, 0, '2017-12-02 17:15:25', ''),
(3, 'Новый твит с #tag', 1, 0, 0, '', 1, 0, '2017-12-05 20:21:53', ''),
(4, 'Новый твит с @tag', 1, 0, 0, '', 0, 0, '2017-12-05 20:22:41', ''),
(5, '@petya http://petya.com', 3, 0, 0, '', 1, 3, '2017-12-08 19:57:20', ''),
(6, 'Новый твит с @tag', 4, 2, 1, '', 0, 1, '2017-12-16 19:48:47', 'text'),
(7, 'Новый твит с @tag', 4, 3, 1, '', 0, 1, '2017-12-16 19:50:25', 'второй ретвит'),
(8, '@petya http://petya.com', 3, 4, 1, '', 0, 1, '2017-12-16 21:36:21', 'Привет мир!!!'),
(9, '@petya http://petya.com', 3, 5, 1, '', 0, 2, '2017-12-16 21:42:58', 'Hello!!!'),
(10, '@petya http://petya.com', 3, 5, 1, '', 1, 3, '2017-12-17 18:19:24', 'text');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `screenName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `profileImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profileCover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `following` int(11) NOT NULL,
  `followers` int(11) NOT NULL,
  `bio` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `screenName`, `profileImage`, `profileCover`, `following`, `followers`, `bio`, `country`, `website`) VALUES
(1, 'paulL', 'paul@mail.com', 'ccb3ac0d883c12642a17ac5440f2869b', 'paul', 'users/d4084a181e9382e070783858c0ccafd8_400x400.jpeg', 'users/finance-business-website-headers_782399.jpg', 0, 0, 'i&lt;3php', '', ''),
(2, 'vasya', 'vasya_pupkin@mail.ru', 'ccb3ac0d883c12642a17ac5440f2869b', 'vasya', 'assets/images/defaultProfileImage.png', 'assets/images/defaultCoverImage.png', 0, 0, '', '', ''),
(3, 'petya', 'petya@yandex.ru', 'ccb3ac0d883c12642a17ac5440f2869b', 'petya', 'assets/images/defaultProfileImage.png', 'assets/images/defaultCoverImage.png', 0, 0, '', '', ''),
(4, 'sasha', 'sasha@yandex.ru', 'ccb3ac0d883c12642a17ac5440f2869b', 'sasha', 'assets/images/defaultProfileImage.png', 'assets/images/defaultCoverImage.png', 0, 0, '', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`);

--
-- Индексы таблицы `trends`
--
ALTER TABLE `trends`
  ADD PRIMARY KEY (`trendID`),
  ADD UNIQUE KEY `hashtag` (`hashtag`);

--
-- Индексы таблицы `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`tweetID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `trends`
--
ALTER TABLE `trends`
  MODIFY `trendID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `tweets`
--
ALTER TABLE `tweets`
  MODIFY `tweetID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
