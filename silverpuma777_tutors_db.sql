-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql2011.db.sakura.ne.jp
-- 生成日時: 2020 年 6 月 29 日 15:09
-- サーバのバージョン： 5.7.29-log
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
-- データベース: `silverpuma777_tutors_db`
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
  `start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `calendar_table`
--

INSERT INTO `calendar_table` (`id`, `STUDENT`, `TUTOR`, `title`, `text`, `color`, `day`, `start`) VALUES
(19, '半田', '田中太郎', 'aaaaa', 'php', '#ff0000', '2020-06-18', '18:00'),
(59, '山枡student', '山枡tutor', 'test', 'test', '#ff0000', '2020-06-09', '18:00'),
(60, '山枡student', '田中太郎', 'test', 'test', '#ff0000', '2020-06-17', '18:00'),
(61, '山枡student', '大河', 'tst', 'tsd', '#ff0000', '2020-07-02', '18:00'),
(62, '山枡student', '山枡tutor', 'test', 'test', '#12e2ae', '2020-06-23', '18:00'),
(63, '山田花子', '田中太郎', 'CSS', 'セレクター\r\n（初歩的なところから教わりたい）', '#000000', '2020-06-25', '18:00'),
(64, '山田大介', '田中太郎', 'HTML', 'HTML', '#000000', '2020-06-23', '18:00'),
(65, '山田大介', '田中太郎', 'PHP', 'HH', '#000000', '2020-06-24', '18:00'),
(66, '山田たかし', '田中太郎', 'PHP', 'Python 基礎\r\n(SESSIONについて)', '#000000', '2020-06-24', '18:00'),
(67, '山田隆', '半田寿久', 'HTML', 'HTML/CSSの学習環境を整えよう [macOS編] (全5回)\r\n(エディターの使い方)', '#000000', '2020-06-25', '18:00'),
(68, '山田大介', '田中太郎', 'HTML', '詳解HTML フォーム部品編 \r\n(初歩的なところから)', '#000000', '2020-06-25', '18:00'),
(69, '田中太郎', '田中太郎', 'HTML', '詳解HTML フォーム部品編 \r\n(エディターでバグが出てしまいハマっている。)', '#000000', '2020-06-24', '18:00'),
(70, '小林太郎', '山田はなこ', 'PHP', '基礎\r\n（SESSION）', '#000000', '2020-06-24', '18:00'),
(71, '田中たろう', '山田はなこ', 'PHP', 'HA', '#000000', '2020-06-24', '18:00'),
(72, '大井', '山田はなこ', 'PHP', 'a', '#000000', '2020-06-24', '18:00'),
(73, '大井', NULL, 'sa', 'sa', '#000000', '2020-06-10', '18:00'),
(74, '山田はなこ', NULL, 'PHP', 'sa', '#000000', '2020-06-24', '18:00'),
(75, 'マイケルジャクソン', NULL, 'PHP', '詳解PHP ビルトイン関数\r\n（詳しい内容）', '#000000', '2020-06-25', '18:00'),
(76, 'taro', NULL, 'PHP', '', '#000000', '2020-06-03', '18:00'),
(77, 'taro', NULL, 'HTML', 'ああああああ', '#000000', '2020-06-10', '18:00'),
(78, 'taro', NULL, 'さ', 'あああ\r\nあああ', '#000000', '2020-06-11', '18:00'),
(79, 'R', NULL, 'PHP', 'RRR', '#000000', '2020-06-03', '18:00'),
(80, 'R', NULL, 'sa', 'R\r\nR\r\n', '#000000', '2020-06-04', '18:00'),
(81, 'E', NULL, 'PHP', 'E\r\nE', '#000000', '2020-06-09', '18:00'),
(82, '小林大河', NULL, 'PHP', 'PHP', '#000000', '2020-06-30', '18:00'),
(83, '小林大河', NULL, 'HTML', 'sa', '#000000', '2020-06-29', '18:00'),
(84, '小林大河', '小林大河', 'as', 'as', '#000000', '2020-07-01', '18:00'),
(85, 'taiga kobayashi', 'taiga kobayashi', '', 'sa', '#000000', '2020-06-29', '18:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `tutors_user_table`
--

CREATE TABLE `tutors_user_table` (
  `user_id` int(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fb` varchar(255) DEFAULT NULL,
  `lid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_type` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tutors_user_table`
--

INSERT INTO `tutors_user_table` (`user_id`, `email`, `fb`, `lid`, `lpw`, `user_type`, `life_flg`) VALUES
(1, 'test1@mail', NULL, 'perusona', '$2y$10$/rHfaDGgIuvJ1FE5.mkW7uikacQImWhTzNtFAfkLpq5t4Is.kmzky', 1, 0),
(2, 'test2@mail', NULL, 'taiga', '$2y$10$eAnhMYrKQp.XAC4ufVA3p.nHx3VmXd9nEeyYtuHRl9OdCuM80GzY.', 1, 0),
(3, 'test2@mail', NULL, 'taiga', '$2y$10$BDZOMT.ZZzWGWfsMM6icUucT32nFvnyGArBMdXSiZLz8mpeXu0YxO', 1, 0),
(4, 'test3@mail', NULL, 'handa', '$2y$10$vEtuQy0JMrEXT9Yn4mxkkO60JxxEstI05jD5pqA7ZAC6psjPEOkQW', 1, 0),
(5, 'test4@mail', NULL, 'yamamas', '$2y$10$bq0M2SdFb/WILGWReQ7Hn.PkfwmDUybsgSYwCGyzdeJEKiMUW1tC2', 1, 0),
(6, 'taiga@gmail.com', NULL, '大河', '12', 0, 0),
(7, '1', NULL, 'kanri', '1', 0, 0),
(8, '12@12', NULL, '西田', '12', 1, 0),
(9, 'arusu.m3@gmail.com', NULL, '山枡manager', '12', 0, 0),
(10, '12', NULL, '西田', '12', 1, 0),
(11, '12@12', NULL, '小栗', '12', 1, 0),
(12, '12@12', NULL, '半田', '12', 0, 0),
(13, '12@12', NULL, '大井', '12', 1, 0),
(14, 'arusu.m3@gmail.com', NULL, '山枡さん', '12', 0, 0),
(15, '12@12', NULL, '古謝さん', '12', 1, 0),
(16, 'arusu.m3@gmail.com', NULL, '山枡student', '316', 1, 0),
(17, 'arusu.m3@gmail.com', NULL, '山枡tutor', '316', 1, 0),
(18, 'thetutors777@gmail.com', NULL, '山田大介', '12', 1, 0),
(19, 'thetutors777@gmail.com', NULL, '山田花子', '12', 1, 0),
(20, 'thetutors777@gmail.com', NULL, '山田たかし', '12', 1, 0),
(21, 'thetutors777@gmail.com', NULL, '山田隆', '12', 1, 0),
(22, 'thetutors777@gmail.com', NULL, '山田隆', '12', 1, 0),
(23, 'thetutors777@gmail.com', NULL, '山田宗', '12', 1, 0),
(24, 'thetutors777@gmail.com', NULL, '半田寿久', '12', 1, 0),
(25, 'thetutors777@gmail.com', NULL, '田中太郎', '12', 1, 0),
(26, 'thetutors777@gmail.com', NULL, '田中太郎', '12', 1, 0),
(27, 'thetutors777@gmail.com', NULL, '小林太郎', '12', 1, 0),
(28, 'thetutors777@gmail.com', NULL, '田中たろう', 't', 1, 0),
(29, 'thetutors777@gmail.com', NULL, '田中たろう', '12', 1, 0),
(30, 'thetutors777@gmail.com', NULL, '山田はなこ', '12', 1, 0),
(31, 'thetutors777@gmail.com', NULL, 'マイケルジャクソン', '123', 1, 0),
(32, 'thetutors777@gmail.com', NULL, 'taro', '12', 1, 0),
(33, 'thetutors777@gmail.com', NULL, 'R', '12', 1, 0),
(34, 'E', NULL, 'E', '12', 1, 0),
(35, 'A', NULL, 'A', '12', 1, 0),
(36, 'taiga.k.5884@gmail.com', 'https://www.facebook.com/taiga.kobayashi.92', '小林大河', '12', 1, 0),
(37, 'thetutors777@gmail.com', 'https://www.facebook.com/', 'taiga kobayashi', '12', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- テーブルのAUTO_INCREMENT `tutors_user_table`
--
ALTER TABLE `tutors_user_table`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
