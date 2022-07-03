-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-30 08:22:16
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `vote`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '序號',
  `acc` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帳號',
  `pw` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `name` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名稱'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `logs`
--

CREATE TABLE `logs` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '序號',
  `user_id` int(11) UNSIGNED NOT NULL COMMENT '投票者',
  `subject_id` int(11) UNSIGNED NOT NULL COMMENT '投票項目',
  `option_id` int(11) UNSIGNED NOT NULL COMMENT '選項',
  `vote_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '投票時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `subject_id`, `option_id`, `vote_time`) VALUES
(1, 0, 5, 24, '2022-06-29 01:49:35'),
(2, 0, 2, 1, '2022-06-29 01:59:16'),
(3, 0, 2, 5, '2022-06-29 02:15:27'),
(4, 0, 5, 23, '2022-06-29 04:01:36'),
(5, 0, 5, 22, '2022-06-29 04:01:45'),
(6, 0, 5, 22, '2022-06-29 04:01:52'),
(7, 0, 6, 28, '2022-06-29 04:02:07'),
(8, 0, 5, 22, '2022-06-29 04:44:14'),
(9, 0, 2, 4, '2022-06-30 05:31:15'),
(10, 0, 2, 3, '2022-06-30 05:31:19');

-- --------------------------------------------------------

--
-- 資料表結構 `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL COMMENT '序號',
  `option` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '選項描述',
  `subject_id` int(11) NOT NULL COMMENT '主題',
  `total` int(11) NOT NULL DEFAULT 0 COMMENT '投票人數統計'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `options`
--

INSERT INTO `options` (`id`, `option`, `subject_id`, `total`) VALUES
(1, '美而美', 2, 1),
(2, 'Qbuger', 2, 0),
(3, '麥當勞', 2, 1),
(4, 'MOS', 2, 1),
(5, '豆漿店', 2, 1),
(6, '大腸麵線', 2, 0),
(20, '夜店', 5, 0),
(21, '酒吧', 5, 0),
(22, 'KTV', 5, 4),
(23, '海邊', 5, 1),
(24, '遊樂園', 5, 1),
(25, '爬山', 5, 0),
(26, '河濱公園', 5, 0),
(27, '貓', 6, 0),
(28, '狗', 6, 1),
(29, '蜜袋鼯', 6, 0),
(30, '龍貓', 6, 0),
(31, '蜥蜴', 6, 0),
(32, '鱷魚', 6, 0),
(33, '刺蝟', 6, 0),
(34, '螞蟻', 6, 0),
(35, '難', 7, 0),
(36, '不難', 7, 0),
(37, '火龍果', 8, 0),
(38, '奇異果', 8, 0),
(39, '蘋果', 8, 0),
(40, '葡萄', 8, 0),
(41, '楊桃', 8, 0),
(42, '柳丁', 8, 0),
(43, '荔枝', 8, 0),
(44, '龍眼', 8, 0),
(45, '小米', 9, 0),
(46, '蘋果', 9, 0),
(47, '紅米', 9, 0),
(48, 'OPPO', 9, 0),
(49, 'realme', 9, 0),
(50, '三星', 9, 0),
(51, 'HTC', 9, 0),
(52, 'SONY', 9, 0),
(53, '華為', 9, 0),
(54, 'vivo', 9, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '序號',
  `subject` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '主題描述',
  `type_id` int(11) NOT NULL COMMENT '主題類別',
  `multiple` tinyint(1) NOT NULL DEFAULT 0 COMMENT '單/複選',
  `mulit_limit` tinyint(4) NOT NULL DEFAULT 1 COMMENT '單/複選項目數',
  `start` date NOT NULL COMMENT '開始時間',
  `end` date NOT NULL COMMENT '結束時間',
  `total` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投票人數統計'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `type_id`, `multiple`, `mulit_limit`, `start`, `end`, `total`) VALUES
(2, '今天早餐吃什麼', 4, 0, 1, '2022-06-22', '2022-07-02', 4),
(5, '假日去哪玩', 4, 0, 1, '2022-06-23', '2022-07-03', 6),
(6, '有養什麼寵物呢?', 4, 1, 1, '2022-06-23', '2022-07-03', 1),
(7, '今天課程難不難', 4, 0, 1, '2022-06-23', '2022-07-03', 0),
(8, '喜歡吃什麼水果', 4, 1, 1, '2022-06-23', '2022-07-03', 0),
(9, '喜歡的手機品牌', 6, 0, 1, '2022-06-29', '2022-07-09', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `types`
--

CREATE TABLE `types` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '序號',
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分類名稱'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(3, '政治'),
(4, '生活'),
(5, '經濟'),
(6, '科技');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '序號',
  `acc` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帳號',
  `pw` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `name` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名稱',
  `birthday` date NOT NULL COMMENT '生日',
  `addr` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '住址',
  `email` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passnote` int(36) NOT NULL COMMENT '密碼提示'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `acc`, `pw`, `name`, `birthday`, `addr`, `email`, `passnote`) VALUES
(2, 'hollie', '4321', 'hollie', '1989-10-13', '台北市', 'chaohongling1013@gmail.com', 0),
(3, 'mack', '1234', '阿明', '2000-02-03', '台北市', 'chaohongling1013@gmail.com', 0),
(4, 'baby', '4321', 'baby', '2000-08-11', '台北市', 'tsubasababy1013@gmail.com', 1234),
(5, 'mary', '81dc9bdb52d04dc2', 'mary', '1993-02-09', '新北市', 'tsubasababy1013@gmail.com', 0),
(6, 'aaaa', '65ba841e01d6db7733e90a5b7f9e6f80', 'cccc', '1234-12-31', '123151', 'tsubasababy1013@gmail.com', 23415),
(7, 'tsubasa', '81dc9bdb52d04dc20036dbd8313ed055', 'hollie', '2022-05-31', '台北市', 'tsubasababy1013@gmail.com', 1234),
(9, 'ckckck', '4ed7837a2cae4e32a3b7f21cd483569d', 'ckckck', '2022-06-13', '台北市', 'tsubasababy1013@gmail.com', 0),
(10, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2022-06-22', '台北市', 'tsubasababy1013@gmail.com', 0),
(11, 'abcd', 'e2fc714c4727ee9395f324cd2e7f331f', 'abcd', '2022-06-09', '台北市', 'tsubasababy1013@gmail.com', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序號', AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序號', AUTO_INCREMENT=55;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序號', AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序號', AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序號', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
