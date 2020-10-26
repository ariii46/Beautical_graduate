-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-10-15 12:59:27
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `beautical_graduate`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `21_salon_tbl`
--

CREATE TABLE `21_salon_tbl` (
  `salon_id` bigint(20) NOT NULL,
  `salon_pw` varchar(12) NOT NULL,
  `salon_name` varchar(32) NOT NULL,
  `salon_tel` varchar(15) NOT NULL,
  `salon_addr1` varchar(32) NOT NULL,
  `salon_addr2` varchar(32) NOT NULL,
  `salon_email` varchar(50) NOT NULL,
  `salon_hp` varchar(50) NOT NULL,
  `salon_insta` varchar(50) NOT NULL,
  `salon_blog` varchar(50) NOT NULL,
  `salon_fb` varchar(50) NOT NULL,
  `salon_latlng` varchar(30) NOT NULL,
  `salon_ptp_image` tinyint(4) NOT NULL,
  `salon_ptp_logo` tinyint(4) NOT NULL,
  `salon_ptp_karte` tinyint(4) NOT NULL,
  `salon_ptp_hp` tinyint(4) NOT NULL,
  `salon_ptp_prepaid` tinyint(4) NOT NULL,
  `salon_ptp_profile_change` tinyint(4) NOT NULL,
  `salon_ptp_thank_you` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `21_salon_tbl`
--

INSERT INTO `21_salon_tbl` (`salon_id`, `salon_pw`, `salon_name`, `salon_tel`, `salon_addr1`, `salon_addr2`, `salon_email`, `salon_hp`, `salon_insta`, `salon_blog`, `salon_fb`, `salon_latlng`, `salon_ptp_image`, `salon_ptp_logo`, `salon_ptp_karte`, `salon_ptp_hp`, `salon_ptp_prepaid`, `salon_ptp_profile_change`, `salon_ptp_thank_you`) VALUES
(102, '102', 'サロン G\'s1', '092-123-456', '福岡市中央区大名1-2-3', 'Gsビル4階', 'aaa', 'bbb', 'ccc', 'ddd', 'ee', 'fff', 2, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `31_user_tbl`
--

CREATE TABLE `31_user_tbl` (
  `user_ai` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_salon_id` bigint(20) NOT NULL,
  `user_pw` varchar(12) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_yomi` varchar(15) NOT NULL,
  `user_hpid` varchar(20) NOT NULL,
  `user_birthday` varchar(10) NOT NULL,
  `user_sex` tinyint(1) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_tel` varchar(15) NOT NULL,
  `user_before_anke` varchar(500) NOT NULL,
  `user_add_date` varchar(10) NOT NULL,
  `user_edit_date` varchar(10) NOT NULL,
  `user_flg_deleted` tinyint(1) NOT NULL,
  `user_search_term` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `31_user_tbl`
--

INSERT INTO `31_user_tbl` (`user_ai`, `user_id`, `user_salon_id`, `user_pw`, `user_name`, `user_yomi`, `user_hpid`, `user_birthday`, `user_sex`, `user_email`, `user_tel`, `user_before_anke`, `user_add_date`, `user_edit_date`, `user_flg_deleted`, `user_search_term`) VALUES
(1, 1001, 102, 'xN3qZn9X', '新垣 結衣', 'アラガキ ユイ', '5843682', '2020/10/31', 1, 'yui@aragaki.com', '012-4546-666', '0', '2020/09/14', '2020/10/11', 0, '1新垣 結衣アラガキ ユイ'),
(2, 1002, 102, 'SX934fcf', '田中 みな実', 'タナカ ミナミ', '', '2020/09/14', 1, 'minami@tanaka.jp', '', '0', '2020/09/14', '2020/09/29', 0, '18石原 さとみイシハラ サトミ'),
(3, 1003, 102, 'chrRR7YA', '北島 由美恵', 'ユミエン', '4562482', '2020/09/14', 1, 'yumie@kitajima.jp', '111-111-1111', '0', '2020/09/15', '2020/10/07', 0, '19北島 由美恵ユミエン'),
(4, 1004, 102, 'ED7KdabX', '四方田 有香', 'ヨモダ　アリカ', 'zz', '2020/09/20', 1, 'arika@yomoda.jp', '222-222-2222', '0', '2020/09/20', '2020/10/01', 0, '20四方田 有香ヨモダ　アリカ'),
(5, 1005, 102, 'WkgUR462', '広瀬 すず', 'ヒロセ スズ', '222222222', '2021/10/22', 1, 'hirose@suzu.jp', '0123-456-789', '0', '2020/09/20', '2020/09/29', 0, '21広瀬 すずヒロセ スズ'),
(6, 1006, 102, '8ZqFhGw8', '石田 ゆり子', 'イシダ ユリコ', '', '2021/06/08', 1, 'yuriko@ishida.com', '', '0', '2020/09/29', '2020/09/29', 0, '22石田 ゆり子イシダ ユリコ'),
(7, 1007, 102, 'ZwzyqF97', '久慈 暁子', 'クジ アキコ', '33333333333', '2021/10/12', 1, 'akiko@kuji.com', '333-333-3333', '0', '2020/10/01', '2020/10/01', 0, '23久慈 暁子クジ アキコ'),
(24, 1008, 102, 'bVgD7vZf', '中森明菜', 'ナカモリアキナ', '00000000', '2020/10/12', 1, 'akina@nakamori.jp', '00000000', '', '2020/10/14', '2020/10/14', 0, '1008中森明菜ナカモリアキナ'),
(25, 1009, 102, 'fE8QRCfn', 'ローランド', 'ローランド', 'aaaa', '2020/10/08', 2, 'aaa', 'aaaa', '', '2020/10/14', '2020/10/14', 0, '25ローランドローランド');

-- --------------------------------------------------------

--
-- テーブルの構造 `41_order_tbl`
--

CREATE TABLE `41_order_tbl` (
  `order_ai` bigint(20) NOT NULL,
  `order_user_ai` bigint(20) NOT NULL,
  `order_flg_counsel_datetime` tinyint(1) NOT NULL,
  `order_counsel_datetime` varchar(16) NOT NULL,
  `order_counsel_stylist` varchar(16) NOT NULL,
  `order_flg_counsel_result` tinyint(1) NOT NULL,
  `order_visit_datetime` varchar(16) NOT NULL,
  `order_ptp_goal_hair_style` tinyint(4) NOT NULL,
  `order_ptp_goal_hair_color1` tinyint(4) NOT NULL,
  `order_cbx_goal_hair_quality` varchar(20) NOT NULL,
  `order_rdo_goal_female_image` tinyint(4) NOT NULL,
  `order_cbx_cur_hair_damege` varchar(20) NOT NULL,
  `order_cbx_cur_worry` varchar(20) NOT NULL,
  `order_txt_cur_care` varchar(100) NOT NULL,
  `order_rdo_cur_allergy_medicine` tinyint(4) NOT NULL,
  `order_cbx_goal_hair_color2` varchar(20) NOT NULL,
  `order_cbx_past_hair_ope` varchar(20) NOT NULL,
  `order_rdo_ope_strength_shampoo` tinyint(4) NOT NULL,
  `order_rdo_ope_spend_style` tinyint(4) NOT NULL,
  `order_rdo_ope_spare_time` tinyint(4) NOT NULL,
  `order_cbx_ope_help` varchar(20) NOT NULL,
  `order_tta_user_message` varchar(100) NOT NULL,
  `order_tta_salon_memo` varchar(100) NOT NULL,
  `order_flg_counsel_yet` tinyint(1) NOT NULL,
  `order_flg_prepaid` tinyint(1) NOT NULL,
  `order_flg_prepaid_sent` tinyint(1) NOT NULL,
  `order_flg_prepaid_done` tinyint(1) NOT NULL,
  `order_prepaid_price` int(11) NOT NULL,
  `order_prepaid_datetime` varchar(16) NOT NULL,
  `order_flg_ope` tinyint(1) NOT NULL,
  `order_ope_stylist` varchar(16) NOT NULL,
  `order_ope_menu` varchar(51) NOT NULL,
  `order_ope_price` int(11) NOT NULL,
  `order_ope_detail` varchar(100) NOT NULL,
  `order_ope_after_anke` varchar(500) NOT NULL,
  `order_flg_karte` tinyint(1) NOT NULL,
  `order_ptp_karte_before` tinyint(4) NOT NULL,
  `order_ptp_karte_after` tinyint(4) NOT NULL,
  `order_karte_datetime` varchar(16) NOT NULL,
  `order_karte_memo` varchar(100) NOT NULL,
  `order_search_term` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `41_order_tbl`
--

INSERT INTO `41_order_tbl` (`order_ai`, `order_user_ai`, `order_flg_counsel_datetime`, `order_counsel_datetime`, `order_counsel_stylist`, `order_flg_counsel_result`, `order_visit_datetime`, `order_ptp_goal_hair_style`, `order_ptp_goal_hair_color1`, `order_cbx_goal_hair_quality`, `order_rdo_goal_female_image`, `order_cbx_cur_hair_damege`, `order_cbx_cur_worry`, `order_txt_cur_care`, `order_rdo_cur_allergy_medicine`, `order_cbx_goal_hair_color2`, `order_cbx_past_hair_ope`, `order_rdo_ope_strength_shampoo`, `order_rdo_ope_spend_style`, `order_rdo_ope_spare_time`, `order_cbx_ope_help`, `order_tta_user_message`, `order_tta_salon_memo`, `order_flg_counsel_yet`, `order_flg_prepaid`, `order_flg_prepaid_sent`, `order_flg_prepaid_done`, `order_prepaid_price`, `order_prepaid_datetime`, `order_flg_ope`, `order_ope_stylist`, `order_ope_menu`, `order_ope_price`, `order_ope_detail`, `order_ope_after_anke`, `order_flg_karte`, `order_ptp_karte_before`, `order_ptp_karte_after`, `order_karte_datetime`, `order_karte_memo`, `order_search_term`) VALUES
(1, 1, 1, '2020/10/15 19:58', 'aaa', 1, '', 3, 3, '', 0, '', '', '', 0, '', '', 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, '', 0, '', '', 0, '', '', 0, 0, 0, '', '', '新垣結衣,アラガキユイ,aaa,');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `21_salon_tbl`
--
ALTER TABLE `21_salon_tbl`
  ADD PRIMARY KEY (`salon_id`);

--
-- テーブルのインデックス `31_user_tbl`
--
ALTER TABLE `31_user_tbl`
  ADD PRIMARY KEY (`user_ai`),
  ADD KEY `user_salon_id` (`user_salon_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `user_search_term` (`user_search_term`),
  ADD KEY `user_is_deleted` (`user_flg_deleted`);

--
-- テーブルのインデックス `41_order_tbl`
--
ALTER TABLE `41_order_tbl`
  ADD PRIMARY KEY (`order_ai`),
  ADD KEY `order_flg_counsel_datetime` (`order_flg_counsel_datetime`),
  ADD KEY `order_flg_counsel_result` (`order_flg_counsel_result`),
  ADD KEY `order_flg_karte` (`order_flg_karte`),
  ADD KEY `order_search_term` (`order_search_term`),
  ADD KEY `order_user_ai` (`order_user_ai`),
  ADD KEY `order_flg_prepaid` (`order_flg_prepaid`) USING BTREE;

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `31_user_tbl`
--
ALTER TABLE `31_user_tbl`
  MODIFY `user_ai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- テーブルのAUTO_INCREMENT `41_order_tbl`
--
ALTER TABLE `41_order_tbl`
  MODIFY `order_ai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
