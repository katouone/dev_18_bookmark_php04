-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 1 月 22 日 19:26
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `php04_kadai`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `php04_needs_table`
--

CREATE TABLE `php04_needs_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `scene` text NOT NULL,
  `type` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `url` text NOT NULL,
  `indate` datetime NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL,
  `user_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `php04_needs_table`
--

INSERT INTO `php04_needs_table` (`id`, `name`, `country`, `scene`, `type`, `content`, `url`, `indate`, `lat`, `lng`, `user_id`) VALUES
(1, 'bbb', 'マラウィ', '医療', '驚いたこと', '病院内にどのような部署があるのかわからない', 'https://world-diary.jica.go.jp/sunadasachie/activity/post_1.php', '2021-01-20 17:49:10', '-13.50', '34.00', 2),
(2, 'AAA', 'マラウィ', '医療', '驚いたこと', '病棟は部門によってはかなり近代的で、冷蔵庫が設置されている病棟も少なくない。透析室もあり、癌化学療法も行われている。', 'https://world-diary.jica.go.jp/sunadasachie/activity/post_1.php', '2021-01-09 06:59:56', '−13.5', '34', 1),
(3, 'bbb', 'マラウィ', '医療', '困りごと', 'ベッドも日本のように決まっておらず、小児病棟では1つのベッドに赤ちゃんが3人寝ていることは普通', 'https://world-diary.jica.go.jp/sunadasachie/activity/post_1.php', '2021-01-09 07:21:23', '-13.5', '34', 2),
(4, 'testuser', 'ガーナ', '街中', '驚いたこと', '近代的なスーパーマーケットがあった\r\n大きかった', '', '2021-01-16 04:05:20', '6', '0.02', 9),
(6, 'testuser', 'ガーナ', '街中', '驚いたこと', '広い道路がたくさんあって、渋滞中に行商がいろいろ売りに来る', '', '2021-01-16 09:01:37', '6', '0', 9),
(7, 'testuser', 'ブダペスト', '街中', '驚いたこと', '温泉がある', '', '2021-01-16 09:09:00', '47.5003838', '19.0529735', 9),
(8, 'testuser', 'サンパウロ', '街中', '驚いたこと', 'ほとんど英語は通じなかった', '', '2021-01-17 12:32:54', '-23.550692', '-46.647278', 9),
(9, 'AAA', 'マラケシュ', '街中', '驚いたこと', 'ああああ', '', '2021-01-17 13:05:33', '43.6777176', '-79.6248197', 1),
(10, 'ccc', '小牧市', '', '困りごと', 'ああ', '', '2021-01-17 14:05:14', '35.289752', '136.914021', 3),
(12, 'bbb', 'dar es salaam', '街中', '驚いたこと', '英語が公用語なのにあまり通じない', '', '2021-01-20 15:41:50', '-6.8133808', '39.2915985', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `php04_user_table`
--

CREATE TABLE `php04_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `php04_user_table`
--

INSERT INTO `php04_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'AAA', 'kanri', '1234', 1, 1),
(2, 'bbb', 'henshu', '1234', 0, 0),
(3, 'ccc', 'CCC', '1234', 0, 1),
(4, 'A', 'A', '1234', 1, 1),
(9, 'testuser', 'test1', '1234', 0, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `php04_needs_table`
--
ALTER TABLE `php04_needs_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `php04_user_table`
--
ALTER TABLE `php04_user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `php04_needs_table`
--
ALTER TABLE `php04_needs_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルのAUTO_INCREMENT `php04_user_table`
--
ALTER TABLE `php04_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;