<?php
session_start();
//var_dump($_POST);exit();

//サーバー環境による設定自動切り替え
include('inc_fnc_set_env.php');
fnc_set_env();

if (isset($_SESSION['user_ai'])) {
    $user_ai = $_SESSION['user_ai'];
}

if (isset($user_ai) == false) {
    die('ログインが必要です');
}
include('inc_def_const.php'); //SITE_TITLE
include('inc_fnc_db.php');
include('inc_function.php');
include('inc_fnc_user.php');





//31_user_tblユーザーテーブルの呼び出し
$ary_fld = array('user_salon_id', 'user_name'); //SELECT取得値
$where = 'user_ai=:user_ai';
$asc_bind = array(); //WHEREのbind値
$asc_bind['user_ai'] = array('val' => $user_ai, 'type' => PDO_INT); //指定user_ai
$ary_fetchall = fnc_pdo_select('31_user_tbl', $ary_fld, $where, '', $asc_bind);
if (count($ary_fetchall) == 1) { //1件該当が前提
    $asc_rec = $ary_fetchall[0];
    $user_salon_id = $asc_rec['user_salon_id'];
    $user_name = $asc_rec['user_name'];
}

//21_salon_tbl サロンテーブルの呼び出し
$ary_fld = array(
    'salon_name', 'salon_addr1', 'salon_addr2', 'salon_tel', 'salon_email', 'salon_hp', 'salon_insta', 'salon_blog', 'salon_youtube', 'salon_map', 'salon_ptp_image', 'salon_ptp_logo', 'salon_ptp_hp', 'salon_ptp_prepaid', 'salon_ptp_profile_change', 'salon_ptp_thank_you'
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
    $salon_ptp_logo = $asc_rec['salon_ptp_logo'];
    $salon_insta = $asc_rec['salon_insta'];
    $salon_blog = $asc_rec['salon_blog'];
    $salon_youtube = $asc_rec['salon_youtube'];
}

//41_order_tblユーザーテーブルの呼び出し
$ary_fld = array('order_ai', 'order_counsel_datetime', 'order_visit_datetime', 'order_karte_datetime'); //SELECT取得値

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
    $order_karte_datetime = $asc_rec['order_karte_datetime'];
}


//乱数（キャッシュクリア用）
$rnd = mt_rand(1000, 9999);
$html_karte_list = fnc_make_html_karte_list($user_ai, 1);

?>

<!DOCTYPE html>
<html lang="ja">
<!-- ヘッダー -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_user_karte_list.css?<?= strtotime('now') ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
        <div class="logo"><a href="user_main.php"><?= $salon_name ?></a></div>
        <!-- ハンバーガーボタン -->
        <div class="drawr_btn"><span></span><span></span><span></span></div>
        <!-- ハンバーガーボタン中身 -->
        <div class="div_menu_nav">
            <div class="drawr_content">
                <ul>
                    <li><a href="user_main.php"><i class="fas fa-home"></i>TOP</a></li>
                    <li><a href="user_karte_list.php"><i class="fas fa-clipboard"></i>カルテ</a></li>
                    <li><a href="<?= $salon_hp ?>"><i class="fas fa-calendar-alt"></i>WEB予約</a></li>
                    <li><a href="user_pay.php?order_ai=<?= $order_ai ?>"><i class="fas fa-credit-card"></i>決済確認</a></li>
                    <li><a href="user_profile.php"><i class="fas fa-user-circle"></i>プロフィール変更</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i>ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="top">
        <!-- <div><?= $user_name ?>さま</div> -->
        <div class="karte_list">カルテ一覧</div>
        <!-- カルテリスト -->
        <div><?= $html_karte_list ?></div>


        <!-- ここから下はどのページでも固定 -->
        <div class="contact">
            <div class="contact_txt">
                <div class="contact_salon_name"><?= $salon_name ?></div>
                <span><?= $salon_addr1 ?><?= $salon_addr2 ?></span>
            </div>
            <!-- お問い合わせボタンのHTML -->
            <div class="animation">
                <div class="effect"></div>
                <a href="#"> お問い合わせはこちら </a>
            </div>
            <footer>
                <div class="footer_name">\ Let's Share /</div>
                <a href="<?= $salon_hp ?>"><i class="fas fa-cut"></i></a>
                <a href="<?= $salon_insta ?>"><i class="fab fa-instagram"></i></a>
                <a href="<?= $salon_blog ?>"><i class="fab fa-blogger"></i></a>
                <a href=""><i class="fab fa-youtube"></i></a>
                <div class="footer_salon_name">@<?= $salon_name ?></div></a>
            </footer>
        </div>
    </div>
    <!-- /////////////////////////////////////////////////////////// -->
    <!-- ハンバーガーボタンのJS -->
    <script>
        $('.drawr_btn').on('click', function() {
            // alert('ok');
            $('.drawr_content').toggleClass('active');
            $('.drawr_btn').toggleClass('active');
        });
    </script>
</body>

</html>