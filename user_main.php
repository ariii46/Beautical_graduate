<?php
session_start();
//var_dump($_POST);exit();

//サーバー環境による設定自動切り替え
include('inc_fnc_set_env.php');
fnc_set_env();

if (isset($_SESSION['user_ai'])) {
	$user_ai = $_SESSION['user_ai'];
}

// die($user_ai);

if (isset($user_ai) == false) {
	die('ログインが必要です');
}
include('inc_def_const.php'); //SITE_TITLE
include('inc_fnc_db.php');
include('inc_function.php');




//31_user_tblユーザーテーブルの呼び出し
$ary_fld = array('user_salon_id', 'user_name'); //SELECT取得値

$where = 'user_ai=:user_ai';

$asc_bind = array(); //WHEREのbind値
$asc_bind['user_ai'] = array('val' => $user_ai, 'type' => PDO_INT); //指定user_ai
$ary_fetchall = fnc_pdo_select('31_user_tbl', $ary_fld, $where, '', $asc_bind);
if (count($ary_fetchall) == 1) { //1件該当が前提
	$asc_rec = $ary_fetchall[0];
	$user_name = $asc_rec['user_name'];
	$user_salon_id = $asc_rec['user_salon_id'];
}

//21_salon_tbl サロンテーブルの呼び出し
$ary_fld = array(
	'salon_name', 'salon_addr1', 'salon_addr2', 'salon_tel', 'salon_email', 'salon_hp', 'salon_insta', 'salon_blog', 'salon_youtube', 'salon_zoom', 'salon_map', 'salon_ptp_image', 'salon_ptp_logo', 'salon_ptp_hp', 'salon_ptp_karte', 'salon_ptp_prepaid', 'salon_ptp_profile_change', 'salon_ptp_thank_you'
); //SELECT取得値

$where = 'salon_id=:salon_id';
$asc_bind = array(); //WHEREのbind値
$asc_bind['salon_id'] = array('val' => $user_salon_id, 'type' => PDO_INT);
$ary_fetchall = fnc_pdo_select('21_salon_tbl', $ary_fld, $where, '', $asc_bind);
if (count($ary_fetchall) == 1) { //1件該当が前提
	$asc_rec = $ary_fetchall[0];
	$salon_name = $asc_rec['salon_name'];
	$salon_addr1 = $asc_rec['salon_addr1'];
	$salon_addr2 = $asc_rec['salon_addr2'];
	$salon_hp = $asc_rec['salon_hp'];
	$salon_insta = $asc_rec['salon_insta'];
	$salon_blog = $asc_rec['salon_blog'];
	$salon_youtube = $asc_rec['salon_youtube'];
	$salon_ptp_image = $asc_rec['salon_ptp_image'];
	$salon_ptp_logo = $asc_rec['salon_ptp_logo'];
	$salon_ptp_hp = $asc_rec['salon_ptp_hp'];
	$salon_map = $asc_rec['salon_map'];
	$salon_zoom = $asc_rec['salon_zoom'];
	$salon_ptp_prepaid = $asc_rec['salon_ptp_prepaid'];
	$salon_ptp_profile_change = $asc_rec['salon_ptp_profile_change'];
	$salon_ptp_karte = $asc_rec['salon_ptp_karte'];
}

//41_order_tblユーザーテーブルの呼び出し
$ary_fld = array('order_ai', 'order_counsel_datetime', 'order_visit_datetime', 'order_flg_user_filled'); //SELECT取得値

$where = 'order_user_ai=:order_user_ai';
$orderby = 'ORDER BY order_counsel_datetime desc LIMIT 1';

$asc_bind = array(); //WHEREのbind値
$asc_bind['order_user_ai'] = array('val' => $user_ai, 'type' => PDO_INT); //指定user_ai
$ary_fetchall = fnc_pdo_select('41_order_tbl', $ary_fld, $where, $orderby, $asc_bind);
if (count($ary_fetchall) == 1) { //1件該当が前提
	$asc_rec = $ary_fetchall[0];
	$order_ai = $asc_rec['order_ai'];
	$order_counsel_datetime = $asc_rec['order_counsel_datetime'];
	$order_visit_datetime = $asc_rec['order_visit_datetime'];
	$order_flg_user_filled = $asc_rec['order_flg_user_filled'];
}

//乱数（キャッシュクリア用）
$rnd = mt_rand(1000, 9999);
?>


<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./css/user_main.css?<?= strtotime('now') ?>">
	<script src="js/jquery-3.1.0.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<title>beautical</title>
</head>

<body>
	<header class="pc_header">
		<div class="logo"><img src="" alt=""></div>
		<ul>
			<li><a href="user_karte_list.php">カルテ</a></li>
			<li><a href="<?= $salon_hp ?>">WEB予約</a></li>
			<li><a href="user_pay.php?order_ai=<?= $order_ai ?>">決済</a></li>
			<li><a href="user_profile.php">プロフィール変更</a></li>
		</ul>
	</header>
	<header class="sp_header">
		<div class="logo"><?= $salon_name ?></div>
		<!-- ハンバーガーボタン -->
		<div class="drawr_btn"><span></span><span></span><span></span></div>
		<!-- ハンバーガーボタン中身 -->
		<div class="div_menu_nav">
			<div class="drawr_content">
				<ul>
					<li><a href="user_main.php"><i class="fas fa-home home"></i>TOP</a></li>
					<li><a href="user_karte_list.php"><i class="fas fa-clipboard"></i>カルテ</a></li>
					<li><a href="<?= $salon_hp ?>"><i class="fas fa-calendar-alt"></i>WEB予約</a></li>
					<li><a href="user_pay.php?order_ai=<?= $order_ai ?>"><i class="fas fa-credit-card"></i>決済確認</a></li>
					<li><a href="user_profile.php"><i class="fas fa-user-circle"></i>プロフィール変更</a></li>
					<li><a href="#"><i class="fas fa-sign-out-alt"></i>ログアウト</a></li>
				</ul>
			</div>
		</div>
	</header>

	<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->
	<div class="top">
		<div class="top_user_name">こんにちは<?= $user_name ?>さま</div>
		<div>
			<!-- カウンセリング予約ボタン -->
			<div class="btn_counsel_start">
				<div class="btn_counsel_start_effect"></div>
				<a href="<?= $salon_zoom ?>">❤︎カウンセリング予約<span><?= $order_counsel_datetime ?></span>
					<div>ビデオチャット スタート</div>
				</a>
			</div>
			<!-- 事前アンケートのスタートボタン -->
			<!-- <div class="btn_counsel_answer">
				<a href="user_counsel_input.php?order_ai=<?= $order_ai ?>">事前アンケート回答はこちらから</a> -->
			<?php if ($order_flg_user_filled) { ?>
				<div class="btn_counsel_answer">
					<p>回答ありがとうございました。</p>
				</div>
			<?php } else { ?>
				<div class="btn_counsel_answer">
					<a href="user_counsel_input.php?order_ai=<?= $order_ai ?>">事前アンケート回答はこちらから</a></div>
			<?php } ?>


		</div> <!-- 画像スライド START -->
		<div class="swiper-container">
			<!-- メイン表示部分 -->
			<div class="swiper-wrapper">
				<!-- 各スライド -->
				<?php for ($i = 1; $i <= $salon_ptp_image; $i++) { ?>
					<div class="swiper-slide"><img src="photo/salon/p<?= $user_salon_id ?>_ptp_image-<?= $i ?>.jpg?<?= $rnd ?>" alt=""></div>
				<?php } ?>
			</div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
			<div class="swiper-pagination"></div>
		</div>
		<!-- //////////////////////////////////////////////////////////////////////// -->
		<div class="content_top">
			<h3>MENU</h3>
			<p class="dot_txt">メニュー</p>
		</div>
		<div class="content_list_up">
			<div class="content_list">
				<?php for ($i = 1; $i <= $salon_ptp_karte; $i++) { ?>
					<a href="user_karte_list.php"><img src="photo/salon/p<?= $user_salon_id ?>_karte-<?= $i ?>.jpg?<?= $rnd ?>" alt="カルテ画像" style="height:130px;"></a>
				<?php } ?>
				<p>カルテ</p>
			</div>
			<div class="content_list">
				<?php for ($i = 1; $i <= $salon_ptp_hp; $i++) { ?>
					<a href="<?= $salon_hp ?>"><img src="photo/salon/p<?= $user_salon_id ?>_hp-<?= $i ?>.jpg?<?= $rnd ?>" alt="ホームページ" style="height:130px;"></a>
				<?php } ?>
				<p>WEB予約</p>
			</div>
		</div>
		<div class="content_list_down">
			<div class="content_list">
				<?php for ($i = 1; $i <= $salon_ptp_prepaid; $i++) { ?>
					<a href="user_pay.php?order_ai=<?= $order_ai ?>"><img src="photo/salon/p<?= $user_salon_id ?>_prepaid-<?= $i ?>.jpg?<?= $rnd ?>" alt=" 決済確認" style="height:130px;"></a>
				<?php } ?>
				<p>決済確認</p>
			</div>
			<div class="content_list">
				<?php for ($i = 1; $i <= $salon_ptp_profile_change; $i++) { ?>
					<a href="user_profile.php"><img src="photo/salon/p<?= $user_salon_id ?>_profile_change-<?= $i ?>.jpg?<?= $rnd ?>" alt="プロフィール変更" style="height:130px;"></a>
				<?php } ?>
				<p>プロフィール変更</p>
			</div>
		</div>
		<!-- //////////////////////////////////////////////////////////////////////// -->
		<!-- ここから下はどのページでも固定のサロン情報のフッター -->
		<div class="contact">
			<div class="contact_txt">
				<div class="contact_salon_name"><?= $salon_name ?></div>
				<span><?= $salon_addr1 ?><?= $salon_addr2 ?></span>
			</div>
			<div class="ggmap"><iframe src="<?= $salon_map ?>" width="" height="" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
			<!-- お問い合わせボタン -->
			<div class="animation">
				<div class="effect"></div>
				<a href="#"> お問い合わせはこちら </a>
			</div>
			<footer>
				<div class="footer_name">\ Let's Share /</div>
				<a href="<?= $salon_hp ?>"><i class="fas fa-cut"></i></a>
				<a href="<?= $salon_insta ?>"><i class="fab fa-instagram"></i></a>
				<a href="<?= $salon_blog ?>"><i class="fab fa-blogger"></i></a>
				<a href="<?= $salon_youtube ?>"><i class="fab fa-youtube"></i></a>
				<div class="footer_salon_name">@<?= $salon_name ?></div></a>
			</footer>
		</div>
	</div>

	<!-- //////////////////////////////////////////////////////////////////////// -->
	<!-- ハンバーガーボタンのJS -->
	<script>
		$('.drawr_btn').on('click', function() {
			// alert('ok');
			$('.drawr_content').toggleClass('active');
			$('.drawr_btn').toggleClass('active');
		});
	</script>
	<!-- スライドショーのJS -->
	<script>
		var mySwiper = new Swiper('.swiper-container', {
			autoplay: {
				delay: 3000,
				stopOnLastSlide: false,
				disableOnInteraction: false,
				reverseDirection: false
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev'
			},
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true
			}
		});
	</script>
</body>

</html>