-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-10-23 09:59:20
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
  `salon_youtube` varchar(50) NOT NULL,
  `salon_map` varchar(500) NOT NULL,
  `salon_zoom` varchar(250) NOT NULL,
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

INSERT INTO `21_salon_tbl` (`salon_id`, `salon_pw`, `salon_name`, `salon_tel`, `salon_addr1`, `salon_addr2`, `salon_email`, `salon_hp`, `salon_insta`, `salon_blog`, `salon_youtube`, `salon_map`, `salon_zoom`, `salon_ptp_image`, `salon_ptp_logo`, `salon_ptp_karte`, `salon_ptp_hp`, `salon_ptp_prepaid`, `salon_ptp_profile_change`, `salon_ptp_thank_you`) VALUES
(102, '102', 'サロン G\'s1', '092-123-456', '福岡市中央区大名1-2-3', 'Gsビル4階', 'aaa', 'bbb', 'ccc', 'ddd', 'https://www.youtube.com/watch?v=0E3kmE_0RmU', 'fffa', 'https://zoom.us/j/9524815855?pwd=cjF0anV4ckRjWDFMOGplVFg5ZS9LQT09', 1, 0, 0, 0, 0, 0, 1);

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
(1, 1001, 102, 'xN3qZn9X', '新垣 結衣', 'アラガキ ユイ', '5843682', '2020/10/31', 1, 'yui@aragaki.com', '012-4546-666', '0', '2020/09/14', '2020/10/23', 0, '1新垣 結衣アラガキ ユイ'),
(2, 1002, 102, 'SX934fcf', '田中 みな実', 'タナカ ミナミ', '', '2020/09/14', 1, 'minami@tanaka.jp', '', '0', '2020/09/14', '2020/09/29', 0, '1002,田中みな実,タナカミナミ'),
(3, 1003, 102, 'chrRR7YA', '北島 由美恵', 'ユミエン', '4562482', '2020/09/14', 1, 'yumie@kitajima.jp', '111-111-1111', '0', '2020/09/15', '2020/10/07', 0, '1003,北島由美恵,ユミエン'),
(4, 1004, 102, 'ED7KdabX', '四方田 有香', 'ヨモダ　アリカ', 'zz', '2020/09/20', 1, 'arika@yomoda.jp', '222-222-2222', '0', '2020/09/20', '2020/10/01', 0, '1004,四方田有香,ヨモダアリカ'),
(5, 1005, 102, 'WkgUR462', '広瀬 すず', 'ヒロセ スズ', '222222222', '2021/10/22', 1, 'hirose@suzu.jp', '0123-456-789', '0', '2020/09/20', '2020/09/29', 0, '1005,広瀬すず,ヒロセスズ'),
(6, 1006, 102, '8ZqFhGw8', '石田 ゆり子', 'イシダ ユリコ', '123', '2021/06/08', 1, 'yuriko@ishida.com', '', '0', '2020/09/29', '2020/10/16', 0, '6石田 ゆり子イシダ ユリコ'),
(7, 1007, 102, 'ZwzyqF97', '久慈 暁子', 'クジ アキコ', '33333333333', '2021/10/12', 1, 'akiko@kuji.com', '333-333-3333', '0', '2020/10/01', '2020/10/23', 0, '7久慈 暁子クジ アキコ'),
(24, 1008, 102, 'bVgD7vZf', '中森明菜', 'ナカモリアキナ', '00000000', '2020/10/12', 1, 'akina@nakamori.jp', '00000000', '', '2020/10/14', '2020/10/14', 0, '1008,中森　明菜,ナカモリア キ ナ');

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
  `order_rdo_cur_media_cognize` tinyint(4) NOT NULL,
  `order_tac_cur_media_cognize` varchar(200) NOT NULL,
  `order_rdo_ope_request_menu` tinyint(4) NOT NULL,
  `order_tac_ope_request_menu` varchar(200) NOT NULL,
  `order_rdo_ope_request_price` tinyint(4) NOT NULL,
  `order_tac_ope_request_price` varchar(200) NOT NULL,
  `order_rdo_ope_request_time` tinyint(4) NOT NULL,
  `order_tac_ope_request_time` varchar(200) NOT NULL,
  `order_cbx_cur_reason_change_slaon` varchar(20) NOT NULL,
  `order_tac_cur_reason_change_slaon` varchar(200) NOT NULL,
  `order_cbx_pre_ope_menu` varchar(20) NOT NULL,
  `order_tac_pre_ope_menu` varchar(200) NOT NULL,
  `order_rdo_pre_ope_interval` tinyint(4) NOT NULL,
  `order_tac_pre_ope_interval` varchar(200) NOT NULL,
  `order_cbx_cur_request_tech` varchar(20) NOT NULL,
  `order_tac_cur_request_tech` varchar(200) NOT NULL,
  `order_cbx_cur_request_service` varchar(20) NOT NULL,
  `order_tac_cur_request_service` varchar(200) NOT NULL,
  `order_cbx_ope_request_spend` varchar(20) NOT NULL,
  `order_tac_ope_request_spend` varchar(200) NOT NULL,
  `order_cbx_cur_worry_hair_quality` varchar(20) NOT NULL,
  `order_tac_cur_worry_hair_quality` varchar(200) NOT NULL,
  `order_cbx_cur_worry_hair_status` varchar(20) NOT NULL,
  `order_tac_cur_worry_hair_status` varchar(200) NOT NULL,
  `order_cbx_cur_picky_home_care` varchar(20) NOT NULL,
  `order_tac_cur_picky_home_care` varchar(200) NOT NULL,
  `order_rdo_ope_request_hair_style` tinyint(4) NOT NULL,
  `order_tac_ope_request_hair_style` varchar(200) NOT NULL,
  `order_ptp_goal_hair_style` tinyint(4) NOT NULL,
  `order_tac_goal_hair_style` varchar(200) NOT NULL,
  `order_rdo_goal_image` tinyint(4) NOT NULL,
  `order_tac_goal_image` varchar(200) NOT NULL,
  `order_rdo_goal_hair_quality` tinyint(4) NOT NULL,
  `order_tac_goal_hair_quality` varchar(200) NOT NULL,
  `order_rdo_ope_strength_shampoo` tinyint(4) NOT NULL,
  `order_tac_ope_strength_shampoo` varchar(200) NOT NULL,
  `order_cbx_ope_help` varchar(20) NOT NULL,
  `order_tac_ope_help` varchar(200) NOT NULL,
  `order_ptp_goal_hair_color` tinyint(4) NOT NULL,
  `order_tac_goal_hair_color` varchar(200) NOT NULL,
  `order_rdo_cur_hair_color` tinyint(4) NOT NULL,
  `order_tac_cur_hair_color` varchar(200) NOT NULL,
  `order_rdo_cur_hair_brightness` tinyint(4) NOT NULL,
  `order_tac_cur_hair_brightness` varchar(200) NOT NULL,
  `order_rdo_cur_hair_white` tinyint(4) NOT NULL,
  `order_tac_cur_hair_white` varchar(200) NOT NULL,
  `order_rdo_past_ope_ache` tinyint(4) NOT NULL,
  `order_tac_past_ope_ache` varchar(200) NOT NULL,
  `order_rdo_cur_request_hair_color` tinyint(4) NOT NULL,
  `order_tac_cur_request_hair_color` varchar(200) NOT NULL,
  `order_tta_user_message` varchar(200) NOT NULL,
  `order_tac_user_message` varchar(200) NOT NULL,
  `order_tac_ope_menu` varchar(200) NOT NULL,
  `order_tac_ope_visit_datetime` varchar(200) NOT NULL,
  `order_tac_ope_submit_price` varchar(200) NOT NULL,
  `order_tac_ope_lecture_pay` varchar(200) NOT NULL,
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
  `order_karte_ptp_hair_before` tinyint(4) NOT NULL,
  `order_karte_ptp_hair_after` tinyint(4) NOT NULL,
  `order_karte_rdo_hair_damage` tinyint(4) NOT NULL,
  `order_karte_rdo_head_solid` tinyint(4) NOT NULL,
  `order_karte_rdo_hair_gloss` tinyint(4) NOT NULL,
  `order_karte_tta_after_care` varchar(200) NOT NULL,
  `order_karte_dtf_next_visit_date` varchar(10) NOT NULL,
  `order_karte_dtt_next_visit_date` varchar(10) NOT NULL,
  `order_karte_tta_next_recommend_menu` varchar(200) NOT NULL,
  `order_karte_tta_next_order_present` varchar(200) NOT NULL,
  `order_karte_datetime` varchar(16) NOT NULL,
  `order_flg_user_filled` tinyint(1) NOT NULL,
  `order_search_term` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `41_order_tbl`
--

INSERT INTO `41_order_tbl` (`order_ai`, `order_user_ai`, `order_flg_counsel_datetime`, `order_counsel_datetime`, `order_counsel_stylist`, `order_flg_counsel_result`, `order_visit_datetime`, `order_rdo_cur_media_cognize`, `order_tac_cur_media_cognize`, `order_rdo_ope_request_menu`, `order_tac_ope_request_menu`, `order_rdo_ope_request_price`, `order_tac_ope_request_price`, `order_rdo_ope_request_time`, `order_tac_ope_request_time`, `order_cbx_cur_reason_change_slaon`, `order_tac_cur_reason_change_slaon`, `order_cbx_pre_ope_menu`, `order_tac_pre_ope_menu`, `order_rdo_pre_ope_interval`, `order_tac_pre_ope_interval`, `order_cbx_cur_request_tech`, `order_tac_cur_request_tech`, `order_cbx_cur_request_service`, `order_tac_cur_request_service`, `order_cbx_ope_request_spend`, `order_tac_ope_request_spend`, `order_cbx_cur_worry_hair_quality`, `order_tac_cur_worry_hair_quality`, `order_cbx_cur_worry_hair_status`, `order_tac_cur_worry_hair_status`, `order_cbx_cur_picky_home_care`, `order_tac_cur_picky_home_care`, `order_rdo_ope_request_hair_style`, `order_tac_ope_request_hair_style`, `order_ptp_goal_hair_style`, `order_tac_goal_hair_style`, `order_rdo_goal_image`, `order_tac_goal_image`, `order_rdo_goal_hair_quality`, `order_tac_goal_hair_quality`, `order_rdo_ope_strength_shampoo`, `order_tac_ope_strength_shampoo`, `order_cbx_ope_help`, `order_tac_ope_help`, `order_ptp_goal_hair_color`, `order_tac_goal_hair_color`, `order_rdo_cur_hair_color`, `order_tac_cur_hair_color`, `order_rdo_cur_hair_brightness`, `order_tac_cur_hair_brightness`, `order_rdo_cur_hair_white`, `order_tac_cur_hair_white`, `order_rdo_past_ope_ache`, `order_tac_past_ope_ache`, `order_rdo_cur_request_hair_color`, `order_tac_cur_request_hair_color`, `order_tta_user_message`, `order_tac_user_message`, `order_tac_ope_menu`, `order_tac_ope_visit_datetime`, `order_tac_ope_submit_price`, `order_tac_ope_lecture_pay`, `order_tta_salon_memo`, `order_flg_counsel_yet`, `order_flg_prepaid`, `order_flg_prepaid_sent`, `order_flg_prepaid_done`, `order_prepaid_price`, `order_prepaid_datetime`, `order_flg_ope`, `order_ope_stylist`, `order_ope_menu`, `order_ope_price`, `order_ope_detail`, `order_ope_after_anke`, `order_flg_karte`, `order_karte_ptp_hair_before`, `order_karte_ptp_hair_after`, `order_karte_rdo_hair_damage`, `order_karte_rdo_head_solid`, `order_karte_rdo_hair_gloss`, `order_karte_tta_after_care`, `order_karte_dtf_next_visit_date`, `order_karte_dtt_next_visit_date`, `order_karte_tta_next_recommend_menu`, `order_karte_tta_next_order_present`, `order_karte_datetime`, `order_flg_user_filled`, `order_search_term`) VALUES
(1, 1, 1, '2020/10/18 05:16', 'aaa', 1, '', 2, '', 4, '', 5, '', 0, '', ',2,4,', '', ',4,6,', '', 3, '', ',3,', '', ',3,', '', '', '', '', '', ',1,4,', '目がかすんでいる', '', '', 0, '', 0, '', 0, '', 4, '', 2, '', ',1,2,', '', 3, '', 0, '', 0, '', 2, '', 2, '', 2, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', 0, '', '', 0, '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0, '新垣結衣,アラガキユイ,aaa,'),
(2, 1, 1, '2020/10/20 22:02', '', 1, '', 1, '', 2, '', 3, '', 3, 'ご希望の時間は何時になりますでしょか？', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 2, '', 0, '', 0, '', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', 0, '', '', 0, '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0, '新垣結衣,アラガキユイ,,'),
(3, 1, 1, '2020/10/21 13:57', '', 1, '', 3, '', 3, '', 4, '', 0, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', 0, '', '', 0, '', '', 1, 1, 1, 1, 2, 5, '@@@@@', '2020/10/21', '2020/10/30', 'a', 'aa', '', 0, '新垣結衣,アラガキユイ,,'),
(4, 7, 1, '2020/10/22 13:41', '', 0, '2020/10/23 14:50', 0, '', 0, '', 0, '', 0, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', 0, '22', '11', 123456, '', '', 1, 3, 0, 5, 4, 3, 'a', '2020/10/24', '2020/10/31', 'b', 'c', '', 0, '久慈暁子,クジアキコ,,1122'),
(5, 1, 1, '2020/10/23 16:10', 'ww', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', 0, '', '', 0, '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0, '新垣結衣,アラガキユイ,ww,');

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
  MODIFY `user_ai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- テーブルのAUTO_INCREMENT `41_order_tbl`
--
ALTER TABLE `41_order_tbl`
  MODIFY `order_ai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
