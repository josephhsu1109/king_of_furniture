-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-06-21 13:44:27
-- 伺服器版本： 10.4.19-MariaDB
-- PHP 版本： 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `myuser`
--

-- --------------------------------------------------------

--
-- 資料表結構 `item_data`
--

CREATE TABLE `item_data` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_price` int(10) NOT NULL,
  `item_category` enum('桌椅','收納','電器','其他') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_status` enum('二手-近全新','二手-良好','二手-普通') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_location` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_describe` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_exist` enum('尚有存貨','已出售') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_img` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_seller` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `item_data`
--

INSERT INTO `item_data` (`item_id`, `item_name`, `item_price`, `item_category`, `item_status`, `item_location`, `item_describe`, `item_exist`, `item_img`, `item_seller`) VALUES
(5, 'ikea摺疊桌', 98, '桌椅', '二手-普通', '桃園', '我賣的一定最便宜', '尚有存貨', '20210621013506.c0c5c0b22c6e19ca063cc5151b48df17.jpg', '0926020372'),
(1, 'ikea摺疊桌', 99, '桌椅', '二手-近全新', '元智大學', '商品為灰色', '尚有存貨', '20210621120000.c0c5c0b22c6e19ca063cc5151b48df17.jpg', '0911222333'),
(3, '塑膠三層櫃', 199, '收納', '二手-普通', '新竹市', '你看到圖片有四層可是商品名稱是三層是因為最下面的抽屜被我用壞了', '尚有存貨', '20210621120400.a6b09793287d2537db8c13fc7d8a8ae6.jpg', '0911222333'),
(4, '電風扇', 555, '電器', '二手-近全新', '元智大學', '風超級無敵大大大大大大大大大大', '尚有存貨', '20210621120525.eecdede9b6f372a7721c9c35656156b7.jpg', '0926020372'),
(2, '三層櫃', 200, '收納', '二手-普通', '元智大學', '那個鐵很容易凹掉 建議東西不要放太多 介意者不要購買!!!!!!!!!!!!!!!!!', '尚有存貨', '20210621120234.a00e95994c570741c62eb44fac0f1c7d.jpg', '0911222333');

-- --------------------------------------------------------

--
-- 資料表結構 `member_data`
--

CREATE TABLE `member_data` (
  `u_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `u_acc` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_pw` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_sex` enum('F','M') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'M',
  `u_birthday` date DEFAULT NULL,
  `u_mail` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_phone` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_status` enum('SELL','BUY') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'BUY'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member_data`
--

INSERT INTO `member_data` (`u_id`, `u_acc`, `u_pw`, `u_sex`, `u_birthday`, `u_mail`, `u_phone`, `u_status`) VALUES
(0000000001, 'admin', 'admin', 'F', '2021-06-09', 'admin@gmail.com', '0926020372', 'SELL'),
(0000000002, 'admin2', 'admin2', 'M', '2021-06-02', 'admin2@gmail.com', '0926020373', 'BUY'),
(0000000003, '123123', '123123', 'F', '0000-00-00', 'ccc@testmail', '0911222333', 'SELL');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `add_ID` int(10) NOT NULL,
  `add_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `add_input` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `message`
--

INSERT INTO `message` (`add_ID`, `add_name`, `add_mail`, `add_input`) VALUES
(1, '5485', 'a092@5251', '1546541');

-- --------------------------------------------------------

--
-- 資料表結構 `wish_data`
--

CREATE TABLE `wish_data` (
  `w_id` int(10) NOT NULL,
  `w_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `w_category` enum('桌椅','收納','電器','其他') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `w_price` int(10) NOT NULL,
  `w_describe` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `wish_data`
--

INSERT INTO `wish_data` (`w_id`, `w_name`, `w_category`, `w_price`, `w_describe`) VALUES
(1, '桌子', '桌椅', 99, '長度100公分以上'),
(2, '椅子', '桌椅', 150, '適合吃飯使用'),
(3, '電風扇', '電器', 200, '黑色'),
(4, '三層櫃', '收納', 101, '塑膠'),
(5, '卡扣式木頭地板', '其他', 1000, '要鋪5坪的房間'),
(6, '三層櫃', '收納', 180, '要是木頭的，想要放書耐重、耐潮濕');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `item_data`
--
ALTER TABLE `item_data`
  ADD PRIMARY KEY (`item_id`);

--
-- 資料表索引 `member_data`
--
ALTER TABLE `member_data`
  ADD PRIMARY KEY (`u_id`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`add_ID`);

--
-- 資料表索引 `wish_data`
--
ALTER TABLE `wish_data`
  ADD PRIMARY KEY (`w_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `item_data`
--
ALTER TABLE `item_data`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_data`
--
ALTER TABLE `member_data`
  MODIFY `u_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `message`
--
ALTER TABLE `message`
  MODIFY `add_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `wish_data`
--
ALTER TABLE `wish_data`
  MODIFY `w_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
