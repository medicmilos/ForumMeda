-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2016 at 09:16 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meda_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comments` int(11) NOT NULL,
  `id_posts` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comments`, `id_posts`, `username`, `comment`, `time`) VALUES
(16, 8, 'test', 'Note that the colons will blow up on the bash command line if you dont use double quotes. ', '2016-06-02 21:28:47'),
(17, 6, 'test', 'It basically reads value from memory, increments it and puts back to memory. ', '2016-06-02 21:30:00'),
(18, 7, 'test', 'Tilde path resolving is something that webpack does, node-sass doesnt have such a resolver built in. sass-loader for webpack has this. You can write your own import resolution alternatively.', '2016-06-02 21:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu_place` int(2) NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(350) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `menu_place`, `name`, `link`, `parent`) VALUES
(1, 2, 'All Posts&sol; ', 'index.php?page=0', 'a'),
(2, 2, 'Contact&sol; ', 'index.php?page=9', 'b'),
(3, 2, 'Author&sol; ', 'index.php?page=10', 'c'),
(4, 2, 'Documentation', 'documentation.pdf ', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `nested_comments`
--

CREATE TABLE `nested_comments` (
  `id_nested_comments` int(11) NOT NULL,
  `id_comments` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_posts` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nested_comments`
--

INSERT INTO `nested_comments` (`id_nested_comments`, `id_comments`, `username`, `comment`, `time`, `id_posts`) VALUES
(11, 17, 'SuperMario95', 'Not really..', '2016-06-02 21:31:37', 6),
(12, 17, 'SuperMario95', 'Sorry buddy', '2016-06-02 21:31:53', 6);

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id_session` int(2) NOT NULL,
  `session` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`id_session`, `session`, `time`) VALUES
(12, 'Administrator', 1466259367),
(8, '', 1466258392);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id_poll` int(2) NOT NULL,
  `question` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id_poll`, `question`, `active`) VALUES
(1, 'Do you like our website?', 1),
(2, 'Do you like PHP?', 0),
(3, 'Do you like C#?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id_answers` int(5) NOT NULL,
  `id_poll` int(5) NOT NULL,
  `answer` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `votes` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id_answers`, `id_poll`, `answer`, `votes`) VALUES
(1, 1, 'Yes', 0),
(2, 1, 'It can be better', 0),
(3, 1, 'No', 0),
(4, 2, 'Yes', 0),
(5, 2, 'No', 0),
(6, 3, 'Yes', 0),
(7, 3, 'No', 0);

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id_votes` int(5) NOT NULL,
  `id_answers` int(5) NOT NULL,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_posts` int(11) NOT NULL,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `votes` int(11) NOT NULL,
  `views` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_posts`, `title`, `description`, `username`, `votes`, `views`, `time`, `tags`) VALUES
(6, 'How do I quit Android emulator when force quit does not work?!', 'All I want to do is to be able to force quit these icons. I have tried both killall Dock and killall', 'Administrator', 0, 78, '2016-06-02 21:19:01', 'android, emulators, php'),
(7, 'Is there a way to apply a velocity.js animation over a NodeList?', 'Is there a way to apply a velocity.js animation over a NodeList as opposed to an element (without jQuery)?', 'Administrator', 0, 16, '2016-06-02 21:19:34', 'nodeJS, js, frontend'),
(8, 'How to run selenium chrome nodes using proxy?', 'xvfb-run --server-args=":99.0 Dhttp.grid/register -nodeConfig /opt/selenium/config.json\n\n\nWhen I run this command I can see the proxy values on console again but I the assets are not loaded by the browser.', 'Administrator', 0, 13, '2016-06-02 21:20:07', 'php, mysql, js'),
(18, 'Ext JS  TypeError name is undefined', 'I have worked with Ext JS 6.0 and now I am trying to get my application to work in Ext JS 4.0.7. There is probably a syntax error from version 4 that is wellformed code in version 6 I am not catching but for the life of me I cannot figure out what it is.', 'SuperMario95', 0, 20, '2016-06-10 20:26:33', 'javascript, xtype'),
(20, 'ASP.NET Compilation Error HTTP Status Code', 'The title is pretty self-explanatory. I have an ASP.NET page written in VB, but I want to code in a custom error message for a "Compilation Error." To do this, I need the HTTP status code that the error returns. Any help would be greatly appreciated.', 'SuperMario95', 0, 16, '2016-06-10 20:26:33', 'asp.net, vb.net, http, http-headers');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_mod` int(1) NOT NULL DEFAULT '2',
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `email`, `gender`, `image`, `description`, `time`, `user_mod`, `active`) VALUES
(1, 'SuperMario95', 'd484ec2f63752a4ade14fe2f970b35d4', 'milos.medic@gmail.com', '', '12548973_939560639485521_6196167925708801707_n.jpg', 'Volem da vozim brzi auto.', '2016-05-05 12:51:30', 2, 1),
(3, 'test', 'd484ec2f63752a4ade14fe2f970b35d4', 'test@gmail.com', '', '12508833_941979695910282_3511000216763555964_n.jpg', 'My names is Bond, James Bond.', '2016-05-03 21:27:07', 2, 1),
(4, 'PetronijevicMarinko2', 'd484ec2f63752a4ade14fe2f970b35d4', 'medo@gmail.com', '', '12400845_935949716513280_1596796959989217897_n.jpg', 'Dzon Snjezni je ziv!', '2016-05-05 15:45:20', 2, 1),
(7, 'Administrator', 'd68e56ecfcc9aa0cce1a32e4f2304cd5', 'admin@admin.com', '', 'milos.jpg', 'Admin.', '2016-05-03 21:39:22', 1, 1),
(10, 'VeseliBurek', 'd484ec2f63752a4ade14fe2f970b35d4', 'marko.medo@gmail.com', 'M', '1618627_934386476669604_5427652282228272887_n.jpg', 'Pozdrav.', '2016-06-04 15:54:42', 2, 1),
(12, 'NadrogiranaPrepelica', 'd484ec2f63752a4ade14fe2f970b35d4', 'tes2222t@gmail.com', 'M', '1935637_931559203618998_1545241227860732117_n.jpg', 'cao duragiii', '2016-06-04 15:58:17', 2, 1),
(13, 'Tarzan', 'd484ec2f63752a4ade14fe2f970b35d4', 'marko.medo@gmail.com', 'M', 'perica.png', 'Pozdrav.', '2016-06-04 15:54:42', 2, 1),
(15, 'KurotresinaAnka', '8ce37a9be6376fb7ca8be9195bda66d2', 'lakilazar1@gmail.com', '', 'mecka_u_moskvi_1991_godine.jpg', 'Metallica!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', '2016-06-08 22:06:04', 2, 1),
(18, 'Pericamikica', 'd484ec2f63752a4ade14fe2f970b35d4', 'medaquit@gmail.com', '', '', '', '2016-06-10 16:31:04', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_mods`
--

CREATE TABLE `user_mods` (
  `id_user_mods` int(11) NOT NULL,
  `mod_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_mods`
--

INSERT INTO `user_mods` (`id_user_mods`, `mod_name`) VALUES
(1, 'Administrator'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comments`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `nested_comments`
--
ALTER TABLE `nested_comments`
  ADD PRIMARY KEY (`id_nested_comments`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id_session`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id_poll`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id_answers`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`id_votes`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_posts`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `user_mods`
--
ALTER TABLE `user_mods`
  ADD PRIMARY KEY (`id_user_mods`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nested_comments`
--
ALTER TABLE `nested_comments`
  MODIFY `id_nested_comments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id_session` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id_poll` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id_answers` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id_votes` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_posts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user_mods`
--
ALTER TABLE `user_mods`
  MODIFY `id_user_mods` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
