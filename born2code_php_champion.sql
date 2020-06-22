-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql1026.db.sakura.ne.jp
-- 生成日時: 2020 年 6 月 22 日 17:21
-- サーバのバージョン： 5.7.28-log
-- PHP のバージョン: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `born2code_php_champion`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `calendar_table`
--

CREATE TABLE `calendar_table` (
  `id` int(11) NOT NULL,
  `STUDENT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TUTOR` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `calendar_table`
--

INSERT INTO `calendar_table` (`id`, `STUDENT`, `TUTOR`, `title`, `text`, `color`, `day`, `start`, `end`) VALUES
(19, '半田', NULL, 'aaaaa', 'php', '#ff0000', '2020-06-18', '18:00', '19:00'),
(59, '山枡student', '山枡tutor', 'test', 'test', '#ff0000', '2020-06-09', '18:00', '20:00'),
(60, '山枡student', NULL, 'test', 'test', '#ff0000', '2020-06-17', '18:00', '20:00'),
(61, '山枡student', NULL, 'tst', 'tsd', '#ff0000', '2020-07-02', '18:00', '21:00'),
(62, '山枡student', '山枡tutor', 'test', 'test', '#12e2ae', '2020-06-23', '18:00', '21:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `tutors_user_table`
--

CREATE TABLE `tutors_user_table` (
  `user_id` int(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_type` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tutors_user_table`
--

INSERT INTO `tutors_user_table` (`user_id`, `email`, `lid`, `lpw`, `user_type`, `life_flg`) VALUES
(1, 'test1@mail', 'perusona', '$2y$10$/rHfaDGgIuvJ1FE5.mkW7uikacQImWhTzNtFAfkLpq5t4Is.kmzky', 1, 0),
(2, 'test2@mail', 'taiga', '$2y$10$eAnhMYrKQp.XAC4ufVA3p.nHx3VmXd9nEeyYtuHRl9OdCuM80GzY.', 1, 0),
(3, 'test2@mail', 'taiga', '$2y$10$BDZOMT.ZZzWGWfsMM6icUucT32nFvnyGArBMdXSiZLz8mpeXu0YxO', 1, 0),
(4, 'test3@mail', 'handa', '$2y$10$vEtuQy0JMrEXT9Yn4mxkkO60JxxEstI05jD5pqA7ZAC6psjPEOkQW', 1, 0),
(5, 'test4@mail', 'yamamas', '$2y$10$bq0M2SdFb/WILGWReQ7Hn.PkfwmDUybsgSYwCGyzdeJEKiMUW1tC2', 1, 0),
(6, 'taiga@gmail.com', '大河', '12', 0, 0),
(7, '1', 'kanri', '1', 0, 0),
(8, '12@12', '西田', '12', 1, 0),
(9, 'arusu.m3@gmail.com', '山枡manager', '12', 0, 0),
(10, '12', '西田', '12', 1, 0),
(11, '12@12', '小栗', '12', 1, 0),
(12, '12@12', '半田', '12', 0, 0),
(13, '12@12', '大井', '12', 1, 0),
(14, 'arusu.m3@gmail.com', '山枡さん', '12', 0, 0),
(15, '12@12', '古謝さん', '12', 1, 0),
(16, 'arusu.m3@gmail.com', '山枡student', '316', 1, 0),
(17, 'arusu.m3@gmail.com', '山枡tutor', '316', 1, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `calendar_table`
--
ALTER TABLE `calendar_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `tutors_user_table`
--
ALTER TABLE `tutors_user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `calendar_table`
--
ALTER TABLE `calendar_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- テーブルのAUTO_INCREMENT `tutors_user_table`
--
ALTER TABLE `tutors_user_table`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
