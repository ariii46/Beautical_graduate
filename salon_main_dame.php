<?php
//サーバー環境による設定自動切り替え
include('inc_fnc_set_env.php');
fnc_set_env();

include('inc_def_const.php'); //SITE_TITLE

//開発モード（mode_dev）
$mode_dev = '';
if (isset($_GET['a'])) {
	$mode_dev = 'ShowAllPage';
}

//乱数（キャッシュクリア用）
$rnd = mt_rand(1000, 9999);

$debug = '';

$date_today = date('Y-m-d'); //今日
//$date_today=date('2020-09-26');//開発用

//css環境切り替え
$html_style_sheet = '';
$html_style_sheet .= "<link rel='stylesheet' type='text/css' href='css/reset.css' />\n";
$html_style_sheet .= "<link rel='stylesheet' type='text/css' href='css/sanitize.css' />\n";
$html_style_sheet .= "<link rel='stylesheet' type='text/css' href='css/style_salon.css' />\n";

$html_style_ref = '';
$html_style_ref .= '<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">' . "\n";
$html_style_ref .= '<link rel="stylesheet" href="./css/style_salon.css?<?= ' . strtotime('now') . ' ?>">' . "\n";
$html_style_ref .= '<script src="js/jquery-3.1.0.min.js"></script>' . "\n";
$html_style_ref .= '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">' . "\n";

if (isset($_GET['n'])) {
	$html_style_sheet = "<link rel='stylesheet' href='css/style_n.css?" . $rnd . "'>\n";
	$html_style_ref = '';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= SITE_MODE ?><?= SITE_TITLE ?></title>
	<?= $html_style_sheet ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<?= $html_style_ref ?>

</head>

<body>
	<input type='hidden' id='hdn_mode_dev' value='<?= $mode_dev ?>'>
	<input id='fle_photo_picker' type='file' accept='image/*' name='imgfile' multiple style='display:none;'>

	<div class='div_page' id='div_page_timetable'>
		<div class="div_page_title">
			<span class='spn_page_title'>■タイム テーブル</span>
			<span class='spn_dev'>［①div_page_timetable］</span>
			<div class="div_page_logout_btn"><a href="">ログアウト</a></div>
		</div>
		<div class="page_title">
			<ul class="icon_list">
				<li><button class="btn_timetable"><span><i class="fas fa-clock"></i></span>タイムテーブル</button></li>
				<li><button class='btn_manage_user'><span><i class="fas fa-users"></i></span>顧客管理顧客管理</button></li>
				<li><button class='btn_manage_counsel'><span><i class="fas fa-users"></i></span>(×)予約/カルテ管理</button></li>
				<li><button class='btn_set_salon_data'><span><i class="fas fa-users"></i></span>サロン情報設定</button></li>
				<li><button class='btn_go_square_dashboard'><span><i class="fas fa-users"></i></span>Squareダッシュボード</button></li>
				<li><button class='btn_go__dashboard'><span><i class="fas fa-video"></i></span>Squareダッシュボード</button></li>

			</ul>
		</div>
		<div>
			<button class='btn_timetable_date' value='-1'>←</button>
			<input type='date' id='tdt_timetable' value='<?= $date_today ?>'>
			<button class='btn_timetable_date' value='1'>→</button>
			<span id='spn_salon_id'>spn_salon_id</span>
			<span class='spn_salon_name'>spn_salon_name</span>
		</div>
		<div>
			<span></span>
			<input type='text' id='txt_search_order_word' placeholder='名前/フリガナ/担当者/メニュー'>
			<button id='btn_search_order'>検索</button>
		</div>
		<div id='div_top_timetable'>
			<table id='tbl_timetable'>
				<thead>
					<tr>
						<th rowspan='3'>時刻</th>
						<th rowspan='3'>名前</th>
						<th colspan='6'>予約</th>
						<th rowspan='3'>カルテ</th>
					</tr>
					<tr>
						<th rowspan='2'>メニュー</th>
						<th rowspan='2'>担当者</th>
						<th colspan='2'>カウンセリング</th>
						<th rowspan='2'>事前決済</th>
						<th rowspan='2'>施術</th>
					</tr>
					<tr>
						<th>日時</th>
						<th>内容</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan='10'>fc_make_tbody_child_tbl_order() → fnc_make_tr_child_tbl_order()</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class='div_page' id='div_page_manage_user'>
		<div>
			<span class='spn_page_title'>■顧客管理（一覧）</span>
			<span class='spn_dev'>［②div_page_manage_user]</span>
		</div>
		<div>
			<span></span>
			<input type='text' id='txt_search_user' placeholder='ID/名前/フリガナ ※空欄で全検索'>
			<button id='btn_search_user'>検索</button><span>表示：フリガナ順</span>
			<button id='btn_add_user'>新規顧客</button>
		</div>
		<div id='div_table_user'>
			<table id='tbl_manage_user'>
				<thead>
					<tr>
						<th>予約</th>
						<th>顧客ID<br>HotPepper ID</th>
						<th>名前</th>
						<th>性別<br>生年月日</th>
						<th>電話番号<br>メールアドレス</th>
						<th>編集</th>
						<th>更新日<br>登録日</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan='7'>検索を実行して下さい</td>
					</tr>
				</tbody>
			</table>
		</div>
		<button class='btn_back'>戻る</button>
	</div>

	<div class='div_page' id='div_page_edit_user'>
		<div>
			<span class='spn_page_title'>■顧客管理：</span><span class='spn_ope'>（新規・編集・削除）</span>
			<span class='spn_dev'>［③div_page_edit_user］</span>
		</div>
		<div>
			<span>名前</span><input type='text' class='txt_user_name'>
			<span>フリガナ</span><input type='text' class='txt_user_yomi'>
		</div>
		<div>
			<span>生年月日</span><input type='date' class='txd_user_birthday'>
			<span>性別</span>
			<label><input type='radio' name='rdo_edit_user_sex' value='1' checked>女</label>
			<label><input type='radio' name='rdo_edit_user_sex' value='2'>男</label>
		</div>
		<div>
			<span>メールアドレス</span><input type='text' class='txt_user_email'>
		</div>
		<div>
			<span>電話番号</span><input type='text' class='txt_user_tel'>
			<span>ホットペッパーID</span><input type='text' class='txt_user_hpid'>
		</div>
		<div>
			<label id='lbl_delete_user'><input type='checkbox' id='cbx_delete_user'>この顧客を削除</label>
			<button id='btn_reg_user'>登録</button>
			<button class='btn_cancel'>キャンセル</button>
		</div>
	</div>

	<div class='div_page' id='div_page_add_order'>
		<div>
			<span class='spn_page_title'>■予約/カルテ管理（新規）</span>
			<span class='spn_dev'>［④div_page_add_order］</span>
		</div>
		<div id='div_tbl_add_order'>
			<table id='tbl_add_order'>
				<thead>
					<tr>
						<th rowspan='3'><?= SITE_TITLE ?> ID<br>HotPepper ID</th>
						<th rowspan='3'>名前</th>
						<th colspan='6'>予約</th>
						<th rowspan='3'>カルテ</th>
					</tr>
					<tr>
						<th rowspan='2'>メニュー</th>
						<th rowspan='2'>担当者</th>
						<th colspan='2'>カウンセリング</th>
						<th rowspan='2'>事前決済</th>
						<th rowspan='2'>施術</th>
					</tr>
					<tr>
						<th>日時</th>
						<th>内容</th>
					</tr>
				</thead>
				<tbody>
					<tr id='tr_add_order'>
						<td colspan='9'>tr_add_order=fnc_make_tr_child_tbl_add_order()</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<button class='btn_back'>戻る</button>
		</div>
	</div>

	<div class='div_page' id='div_page_edit_order_counsel_datetime'>
		<div>
			<span class='spn_page_title'>■カウンセリング日時 予約：</span><span class='spn_ope'>（新規・編集・削除）</span>
			<span class='spn_dev'>［⑤div_page_edit_order_counsel_datetime］</span>
		</div>
		<div>
			<span>顧客ID：</span><span class='spn_user_id'>spn_user_id</span>
		</div>
		<div>
			<span>顧客名：</span><span class='spn_user_name'>spn_user_name</span>
		</div>
		<div>
			<span>予約日時：</span><input type='datetime-local' class='tdl_order_counsel_datetime'>
		</div>
		<div>
			<span>カウンセリング担当者：</span><input type='text' class='txt_order_counsel_stylist'>
		</div>
		<div>
			<button class='btn_reg_order_counsel_datetime'>登録</button>
			<button class='btn_cancel'>キャンセル</button>
		</div>
	</div>

	<div class='div_page' id='div_page_show_order_counsel_result'>
		<div>
			<span class='spn_page_title'>■カウンセリング（閲覧）</span>
			<span class='spn_dev'>［⑥div_page_show_order_counsel_result］</span>
		</div>
		<div>
			<div><span>顧客ID：</span><span class='spn_user_id'>spn_user_id</span></div>
			<div><span class='spn_user_name'>spn_user_name</span>（<span class='spn_user_yomi'>spn_user_yomi</span>）</div>
			<div><span>生年月日：</span><span class='spn_user_birthday'>spn_user_birthday</span>（<span class='spn_user_sex'>spn_user_sex</span>）</div>
			<div><span>メールアドレス：</span><span class='spn_user_email'>spn_user_email</span></div>
			<div><span>電話番号：</span><span class='spn_user_tel'>spn_user_tel</span></div>
			<div><span>ホットペッパーID：</span><span class='spn_user_hpid'>spn_user_hpid</span></div>
		</div>
		<hr>
		<div id='div_show_order_counsel_result'>div_show_order_counsel_result</div>
		<hr>
		<button class='btn_edit_order_counsel_result' value='order_ai'>編集</button>
		<button class='btn_back'>戻る</button>
	</div>

	<div class='div_page' id='div_page_edit_order_counsel_result'>
		<input id='ipt_choose_multi_photo' type='file' accept='image/*' name='imgfile' multiple style='display:none;'>
		<div>
			<span class='spn_page_title'>■カウンセリング：</span><span class='spn_ope'>（新規・編集・削除）</span>
			<span class='spn_dev'>［⑦div_page_edit_order_counsel_result］</span>
		</div>
		<div>
			<div><span>顧客ID：</span><span class='spn_user_id'>spn_user_id</span></div>
			<div><span class='spn_user_name'>spn_user_name</span></div>
		</div>
		<hr>
		<div id='div_edit_order_counsel_result'>div_edit_order_counsel_result</div>
		<hr>
		<div>
			<label><input type="checkbox" id="order_flg_counsel_yet">(×)一時保存</label>
		</div>
		<div>
			<button class='btn_reg_order_counsel_result'>登録</button>
			<button class='btn_cancel'>キャンセル</button>
		</div>
	</div>

	<div class='div_page' id='div_page_edit_order_prepaid'>
		<div>
			<span class='spn_page_title'>■事前決済：</span><span class='spn_ope'>（新規・編集・削除）</span>
			<span class='spn_dev'>［⑧div_page_edit_order_prepaid］</span>
		</div>
		<div>
			<span>顧客ID：</span><span class='spn_user_id'>spn_user_id</span>
		</div>
		<div>
			<span>顧客名：</span><span class='spn_user_name'>spn_user_name</span>
		</div>
		<div>
			<span>メニュー内容（1行目をタイムテーブルで表示）：</span><textarea class='tta_order_ope_menu'></textarea>
		</div>
		<div>
			<span>事前決済金額：</span><input type='text' class='txt_order_prepaid_price'>円
		</div>
		<div>
			<a href="https://squareup.com/login" target='_blank'>Squareダッシュボード</a>
		</div>
		<div>
			<label><input type='checkbox' class='cbx_order_flg_prepaid_sent'>請求メール送信済み</label>
		</div>
		<div>
			<label><input type='checkbox' class='cbx_order_flg_prepaid_done'>決済済み</label>
		</div>
		<div>
			<button class='btn_reg_order_prepaid'>登録</button>
			<button class='btn_cancel'>キャンセル</button>
		</div>
	</div>

	<div class='div_page' id='div_page_show_order_ope'>
		<div>
			<span class='spn_page_title'>■施術（閲覧）</span>
			<span class='spn_dev'>［⑨div_page_show_order_ope］</span>
		</div>
		<div>
			<span>顧客ID：</span><span class='spn_user_id'>spn_user_id</span>
		</div>
		<div>
			<span>顧客名：</span><span class='spn_user_name'>spn_user_name</span>
		</div>
		<div>
			<span>施術担当者：</span><span class='spn_order_ope_stylist'>spn_order_ope_stylist</span>
		</div>
		<div>
			<span>来店日時：</span><span class='spn_order_visit_datetime'>spn_order_visit_datetime</span>
		</div>
		<div>
			<span>メニュー内容：</span><span class='spn_order_ope_menu'>spn_order_ope_menu</span>
		</div>
		<div>
			<span>施術金額：</span><span class='spn_order_ope_price'>spn_order_ope_price</span>
		</div>
		<div>
			<button class='btn_edit_order_ope' value='order_ai'>編集</button>
			<button class='btn_back'>戻る</button>
		</div>

	</div>

	<div class='div_page' id='div_page_edit_order_ope'>
		<div>
			<span class='spn_page_title'>■施術：</span><span class='spn_ope'>（新規・編集・削除）</span>
			<span class='spn_dev'>［⑩div_page_edit_order_ope］</span>
		</div>
		<div>
			<span>顧客ID：</span><span class='spn_user_id'>spn_user_id</span>
		</div>
		<div>
			<span>顧客名：</span><span class='spn_user_name'>spn_user_name</span>
		</div>
		<div>
			<span>施術担当者：</span><input type='text' class='txt_order_ope_stylist'>
		</div>
		<div>
			<span>来店日時：</span><input type='datetime-local' class='tdl_order_visit_datetime'>
		</div>
		<div>
			<span>メニュー内容（1行目をタイムテーブルで表示）：</span><textarea class='tta_order_ope_menu'></textarea>
		</div>
		<div>
			<span>施術金額：</span><input type='text' class='txt_order_ope_price'>円
		</div>
		<div>
			<button class='btn_reg_order_ope'>登録</button>
			<button class='btn_cancel'>キャンセル</button>
		</div>
	</div>

	<div class='div_page' id='div_page_show_order_karte'>
		<div>
			<span class='spn_page_title'>■カルテ（閲覧）</span>
			<span class='spn_dev'>［⑪div_page_show_order_karte］</span>
		</div>
		<div>
			<div>
				<span>顧客ID：</span><span class="spn_user_id">spn_user_id</span>
			</div>
			<div>
				<span>顧客名：</span><span class="spn_user_name">spn_user_name</span>
			</div>
			<div>
				ビフォー（施術後写真）
				<div class='ptp_karte_before'></div>
			</div>
			<div>
				アフター（施術後写真）
				<div class='ptp_karte_after'></div>
			</div>
			<div>
				<span>来店日時：</span><span class="spn_order_visit_datetime">spn_order_visit_datetime</span>
			</div>
			<div>
				<span>メニュー内容：</span><span class="spn_order_ope_menu">spn_order_ope_menu</span>
			</div>
			<div>
				<span>施術担当者：</span><span class="spn_order_ope_stylist">spn_order_ope_stylist</span>
			</div>
			<div>
				<span>施術金額：</span><span class="spn_order_ope_price">spn_order_ope_price</span>
			</div>
			<div>
				<span>施術詳細・アフターケア方法：</span><span class="spn_order_ope_detail">spn_order_ope_detail</span>
			</div>
		</div>
		<button class='btn_edit_order_karte' value='order_ai'>編集</button>
		<button class='btn_back'>戻る</button>
	</div>

	<div class='div_page' id='div_page_edit_order_karte'>
		<div>
			<span class='spn_page_title'>■カルテ：</span><span class='spn_ope'>（新規・編集・削除）</span>
			<span class='spn_dev'>［⑫div_page_edit_order_karte］</span>
		</div>
		<div>
			<span>顧客ID：</span><span class='spn_user_id'>spn_user_id</span>
		</div>
		<div>
			<span>顧客名：</span><span class='spn_user_name'>spn_user_name</span>
		</div>
		<div>
			ビフォー写真：
			<div class='div_photo_picker ptp_karte_before'>クリックして画像選択（?枚以内）</div>
		</div>
		<div>
		</div>
		<div>
			アフター写真：
			<div class='div_photo_picker ptp_karte_after'>クリックして画像選択（?枚以内）</div>
		</div>
		<div>
			<span>来店日時：</span><input type='datetime-local' class='tdl_order_visit_datetime'>
		</div>
		<div>
			<span>メニュー内容（1行目をタイムテーブルで表示）：</span><textarea class='tta_order_ope_menu'></textarea>
		</div>
		<div>
			<span>施術担当者：</span><input type='text' class='txt_order_ope_stylist'>
		</div>
		<div>
			<span>施術金額：</span><input type='text' class='txt_order_ope_price'>円
		</div>
		<div>
			<span>施術詳細・アフターケア方法：</span><textarea class='tta_order_ope_detail'></textarea>
		</div>
		<div>
			<button class='btn_reg_order_karte'>登録</button>
			<button class='btn_cancel'>キャンセル</button>
		</div>
	</div>

	<div class='div_page' id='div_page_manage_order'>
		<div>
			<span class='spn_page_title'>■予約/カルテ管理</span>
			<span class='spn_dev'>［⑬div_page_manage_order］</span>
		</div>
		<div>
			<span>ワード検索</span>
			<input type='text' id='txt_search_order' placeholder='ID/名前/日付'>
			<button id='btn_search_order'>(×)検索</button>
		</div>
		<div id='div_table_order'>
			<table id='tbl_manage_order'>
				<thead>
					<tr>
						<th rowspan='3'><?= SITE_TITLE ?> ID<br>HotPepper ID</th>
						<th rowspan='3'>名前</th>
						<th rowspan='3'>新規<br>追加</th>
						<th colspan='6'>予約</th>
						<th rowspan='3'>カルテ</th>
					</tr>
					<tr>
						<th rowspan='2'>メニュー</th>
						<th rowspan='2'>担当者</th>
						<th colspan='2'>カウンセリング</th>
						<th rowspan='2'>事前決済</th>
						<th rowspan='2'>施術</th>
					</tr>
					<tr>
						<th>日時</th>
						<th>内容</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td>データなし</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
		<button class='btn_back'>戻る</button>
	</div>

	<div class='div_page' id='div_page_show_salon_data'>
		<div>
			<span class='spn_page_title'>■サロン情報</span>
			<span class='spn_dev'>［⑭div_page_show_salon_data］</span>
		</div>
		<div>
			<div><span>サロン名：</span><span class='spn_salon_name'>spn_salon_name</span></div>
			<div><span>住所：</span><span class='spn_salon_addr1'>spn_salon_addr1</span><span class='spn_salon_addr2'>spn_salon_addr2</span></div>
			<div><span>電話番号：</span><span class='spn_salon_tel'>spn_salon_tel</span></div>
			<div><span>メールアドレス：</span><span class='spn_salon_email'>spn_salon_email</span></div>
			<div><span>ホームページ：</span><span class='spn_salon_hp'>spn_salon_hp</span></div>
			<div><span>インスタグラム：</span><span class='spn_salon_insta'>spn_salon_insta</span></div>
			<div><span>ブログ：</span><span class='spn_salon_blog'>spn_salon_blog</span></div>
			<div><span>Facebook：</span><span class='spn_salon_fb'>spn_salon_fb</span></div>
			<div><span>経度・緯度：</span><span class='spn_salon_latlng'>spn_salon_latlng</span></div>
			<div>
				サロンイメージ
				<div class='ptp_image'></div>
			</div>
			<div>
				サロンロゴ
				<div class='ptp_logo'></div>
			</div>
			<div>
				カルテ
				<div class='ptp_karte'></div>
			</div>
			<div>
				ホームページ
				<div class='ptp_hp'></div>
			</div>
			<div>
				決済確認
				<div class='ptp_prepaid'></div>
			</div>
			<div>
				プロフィール変更
				<div class='ptp_profile_change'></div>
			</div>
			<div>
				ありがとう画面
				<div class='ptp_thank_you'></div>
			</div>
		</div>
		<hr>
		<button id='btn_edit_salon_data' value='salon_id'>編集</button>
		<button class='btn_back'>戻る</button>
	</div>

	<div class='div_page' id='div_page_edit_salon_data'>
		<div>
			<span class='spn_page_title'>■サロン情報編集</span>
			<span class='spn_dev'>［⑮div_page_edit_salon_data］</span>
		</div>
		<div>
			<div><span>サロン名：</span><input type='text' class='txt_salon_name' value='txt_salon_name'></span></div>
			<div><span>住所：</span><input type='text' class='txt_salon_addr1' value='txt_salon_addr1'><input type='text' class='txt_salon_addr2' value='txt_salon_addr2'></div>
			<div><span>電話番号：</span><input type='text' class='txt_salon_tel' value='txt_salon_tel'></div>
			<div><span>メールアドレス：</span><input type='text' class='txt_salon_email' value='txt_salon_email'></div>
			<div><span>ホームページ：</span><input type='text' class='txt_salon_hp' value='txt_salon_hp'></div>
			<div><span>インスタグラム：</span><input type='text' class='txt_salon_insta' value='txt_salon_insta'></div>
			<div><span>ブログ：</span><input type='text' class='txt_salon_blog' value='txt_salon_blog'></div>
			<div><span>Facebook：</span><input type='text' class='txt_salon_fb' value='txt_salon_fb'></div>
			<div><span>経度・緯度：</span><input type='text' class='txt_salon_latlng' value='txt_salon_latlng'></div>
			<div>
				サロンイメージ（最大5枚）
				<div class='div_photo_picker ptp_image'>クリックして画像選択（5枚以内）</div>
			</div>
			<div>
				サロンロゴ（1枚）
				<div class='div_photo_picker ptp_logo'>クリックして画像選択（1枚以内）</div>
			</div>
			<div>
				カルテ（1枚）
				<div class='div_photo_picker ptp_karte'>クリックして画像選択（1枚以内）</div>
			</div>
			<div>
				ホームページ（1枚）
				<div class='div_photo_picker ptp_hp'>クリックして画像選択（1枚以内）</div>
			</div>
			<div>
				決済確認（1枚）
				<div class='div_photo_picker ptp_prepaid'>クリックして画像選択（1枚以内）</div>
			</div>
			<div>
				プロフィール変更（1枚）
				<div class='div_photo_picker ptp_profile_change'>クリックして画像選択（1枚以内）</div>
			</div>
			<div>
				ありがとう画面（1枚）
				<div class='div_photo_picker ptp_thank_you'>クリックして画像選択（1枚以内）</div>
			</div>
		</div>
		<div>
			<button id='btn_reg_salon_data'>登録</button>
			<button class='btn_cancel'>キャンセル</button>
		</div>
	</div>
	<div id="div_loading" style="display: none;position: absolute;width:128px;height:128px;z-index: 10;">
		<img src="etc/img/loader.gif" style="width:128px;height:128px;">
	</div>

	<script type='text/javascript' src="salon.js?<?= $rnd ?>"'></script>

</body>
</html>