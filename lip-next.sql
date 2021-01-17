-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-01-17 23:31:52
-- サーバのバージョン： 10.4.16-MariaDB
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `lip-next`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `apply`
--

CREATE TABLE `apply` (
  `applyid` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `internshipID` int(11) NOT NULL,
  `applytime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `apply`
--

INSERT INTO `apply` (`applyid`, `userID`, `internshipID`, `applytime`) VALUES
(2, 1, 2, '2021-01-17 05:12:19');

-- --------------------------------------------------------

--
-- テーブルの構造 `bookmark`
--

CREATE TABLE `bookmark` (
  `bookmarkid` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `internshipID` int(11) NOT NULL,
  `bookmarktime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `chat`
--

CREATE TABLE `chat` (
  `chatid` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `messagetext` varchar(255) NOT NULL,
  `sendtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `chat`
--

INSERT INTO `chat` (`chatid`, `sender`, `receiver`, `messagetext`, `sendtime`) VALUES
(5, 1, 2, 'Onedayイベント１に申し込みが完了しました。メッセージがくるまでしばらくお待ちください。', '2021-01-17 05:12:19');

-- --------------------------------------------------------

--
-- テーブルの構造 `company`
--

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `companyinfo` varchar(255) NOT NULL,
  `companylogo` varchar(255) NOT NULL,
  `companyurl` varchar(255) NOT NULL,
  `companybusiness` varchar(255) NOT NULL,
  `companymail` varchar(255) NOT NULL,
  `companypasswd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `company`
--

INSERT INTO `company` (`companyID`, `companyname`, `companyinfo`, `companylogo`, `companyurl`, `companybusiness`, `companymail`, `companypasswd`) VALUES
(1, 'SellCa株式会社', 'GLION GROUPの企業になります。GLION GROUPは世界的にも活躍する75社を有するグループです。SellCa はその中でもトップのベンチャー企業です。', 'EnterpriseLogo\\sellca.png', 'https://www.sellca-sellcar.com/', '中古車ネット販売サイト運営', 'company1@jp.com', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `internship`
--

CREATE TABLE `internship` (
  `internshipID` int(11) NOT NULL,
  `internshipname` varchar(255) NOT NULL,
  `internshipoutline` varchar(255) NOT NULL,
  `internshipfor` varchar(255) NOT NULL,
  `internshipregion` varchar(255) NOT NULL,
  `internshiplocation` varchar(255) NOT NULL,
  `internshipfield` varchar(255) NOT NULL,
  `internshipimage` varchar(255) NOT NULL,
  `internshipsalary` varchar(255) NOT NULL,
  `internshipinfo` varchar(255) NOT NULL,
  `internshiptype` varchar(255) NOT NULL,
  `internshipattention` int(11) NOT NULL,
  `internshipcondition` varchar(10) NOT NULL,
  `companyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `internship`
--

INSERT INTO `internship` (`internshipID`, `internshipname`, `internshipoutline`, `internshipfor`, `internshipregion`, `internshiplocation`, `internshipfield`, `internshipimage`, `internshipsalary`, `internshipinfo`, `internshiptype`, `internshipattention`, `internshipcondition`, `companyID`) VALUES
(1, 'インターンシップ１', 'GLION GROUPの企業になります。GLION GROUPは世界的にも活躍する75社を有するグループです。SellCa はその中でもトップのベンチャー企業です。', '起業を志す学生。就活で有利に立ちたい学生。社長が学生起業をされている方であるので、学生起業であったり、起業全般に対するサポートをしてくださいます。また、ここでの営業経験やマーケティング経験を生かして起業、将来の就活に活かすことができます。', '近畿', '三宮', 'マーケティング', 'https://re-vol.net/wp/wp-content/uploads/2020/05/sellca-pf-724x1024.png', '学生による（昇給あり)', '', '長期インターンシップ', 3, '募集中', 1),
(2, 'Onedayイベント１', 'GLION GROUPの企業になります。GLION GROUPは世界的にも活躍する75社を有するグループです。SellCa はその中でもトップのベンチャー企業です。', '起業を志す学生。就活で有利に立ちたい学生。社長が学生起業をされている方であるので、学生起業であったり、起業全般に対するサポートをしてくださいます。また、ここでの営業経験やマーケティング経験を生かして起業、将来の就活に活かすことができます。', '近畿', '三宮', 'マーケティング', 'https://re-vol.net/wp/wp-content/uploads/2020/05/sellca-pf-724x1024.png', '時給1000円', '', 'OneDayイベント', 6, '募集中', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `usermail` varchar(255) NOT NULL,
  `userpasswd` varchar(255) NOT NULL,
  `userphonenumber` bigint(20) NOT NULL,
  `useruniversity` varchar(255) NOT NULL,
  `userundergraduate` varchar(255) NOT NULL,
  `userdepartment` varchar(255) NOT NULL,
  `userschoolyear` int(2) NOT NULL,
  `usergraduateyear` int(5) NOT NULL,
  `userselfappeal` varchar(255) NOT NULL,
  `userareaofinterest` varchar(255) NOT NULL,
  `userclubinhighschool` varchar(255) NOT NULL,
  `usercurrentactivity` varchar(255) NOT NULL,
  `usercondition` varchar(10) NOT NULL,
  `usersignupday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`userID`, `username`, `usermail`, `userpasswd`, `userphonenumber`, `useruniversity`, `userundergraduate`, `userdepartment`, `userschoolyear`, `usergraduateyear`, `userselfappeal`, `userareaofinterest`, `userclubinhighschool`, `usercurrentactivity`, `usercondition`, `usersignupday`) VALUES
(1, 'test', 'example@jp.com', '$2y$10$4s37pnGKLGvNT.DBRMs3Fe.r1jELZdg.wxP2OR2c5Fn.NUoDPIaB2', 0, '', '', '', 0, 2023, '', '', '', '', '', '2021-01-17'),
(2, 'root', 'root@jp.com', '$2y$10$nhaV6HpEzU75DBt7Ez53yOJhCOpyJt3Gl9ZOVqog.DUfS7mD.mOdW', 0, '', '', '', 0, 0, '', '', '', '', '', '2021-01-17');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`applyid`);

--
-- テーブルのインデックス `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatid`);

--
-- テーブルのインデックス `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`);

--
-- テーブルのインデックス `internship`
--
ALTER TABLE `internship`
  ADD PRIMARY KEY (`internshipID`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `apply`
--
ALTER TABLE `apply`
  MODIFY `applyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `chat`
--
ALTER TABLE `chat`
  MODIFY `chatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `company`
--
ALTER TABLE `company`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `internship`
--
ALTER TABLE `internship`
  MODIFY `internshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
