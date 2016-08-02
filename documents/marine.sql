-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 年 8 月 02 日 09:53
-- サーバのバージョン： 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marine`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `editor` varchar(20) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `comment`
--

INSERT INTO `comment` (`id`, `message_id`, `title`, `comment`, `editor`, `created`, `modified`) VALUES
(1, 2, 'テストコメント１', 'コメントコメントコメントコメントコメントコメント', '市岡さえ', '2016-08-02', '2016-08-02'),
(2, 2, 'テストコメント2', 'コメントコメントコメントコメントコメントコメント', '市岡さえ', '2016-08-02', '2016-08-02'),
(3, 3, 'テストコメント3', 'コメントコメントコメントコメントコメントコメント', '市岡さえ', '2016-08-02', '2016-08-02');

-- --------------------------------------------------------

--
-- テーブルの構造 `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `editor` varchar(20) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `message`
--

INSERT INTO `message` (`id`, `title`, `comment`, `editor`, `created`, `modified`) VALUES
(1, 'テスト１', 'コメントコメントコメントコメントコメントコメント', '市岡さえ', '2016-08-02', '2016-08-02'),
(2, 'テスト2', 'コメントコメントコメントコメントコメントコメント', '市岡さえ', '2016-08-02', '2016-08-02'),
(3, 'テスト3', 'コメントコメントコメントコメントコメントコメント', '市岡さえ', '2016-08-02', '2016-08-02'),
(4, 'テスト4', 'コメントコメントコメントコメントコメントコメント', '市岡さえ', '2016-08-02', '2016-08-02'),
(5, 'テスト5', 'コメントコメントコメントコメントコメントコメント', '市岡さえ', '2016-08-02', '2016-08-02');

-- --------------------------------------------------------

--
-- テーブルの構造 `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `addfile` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `notice`
--

INSERT INTO `notice` (`id`, `title`, `comment`, `addfile`, `created`, `modified`) VALUES
(1, 'テスト１', 'コメントコメントコメントコメントコメントコメントコメントコメント', 'test/filename.img', '2016-08-02', '2016-08-02'),
(2, 'テスト2', 'コメントコメントコメントコメントコメントコメント', 'test/filename.img', '2016-08-02', '2016-08-02'),
(3, 'テスト3', 'コメントコメントコメントコメントコメントコメント', 'test/filename.img', '2016-08-02', '2016-08-02'),
(4, 'テスト4', 'コメントコメントコメントコメントコメントコメント', 'test/filename.img', '2016-08-02', '2016-08-02'),
(5, 'テスト5', 'コメントコメントコメントコメントコメントコメント', 'test/filename.img', '2016-08-02', '2016-08-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `message_id_2` (`message_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
