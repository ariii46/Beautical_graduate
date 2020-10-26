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


if (isset($_GET['order_ai'])) {
    $order_ai = $_GET['order_ai'];
}
if (isset($order_ai) == false) {
    die('来店が特定されておりません');
}


include('inc_def_const.php'); //SITE_TITLE
include('inc_fnc_db.php');
include('inc_function.php');
include('inc_def_common.php');



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
    'salon_name', 'salon_addr1', 'salon_addr2', 'salon_tel', 'salon_email', 'salon_hp', 'salon_insta', 'salon_blog', 'salon_youtube', 'salon_map', 'salon_ptp_image', 'salon_ptp_logo', 'salon_ptp_hp', 'salon_ptp_prepaid', 'salon_ptp_profile_change', 'salon_ptp_thank_you'
); //SELECT取得値

$where = 'salon_id=:salon_id';
$asc_bind = array(); //WHEREのbind値
$asc_bind['salon_id'] = array('val' => $user_salon_id, 'type' => PDO_INT);
$ary_fetchall = fnc_pdo_select('21_salon_tbl', $ary_fld, $where, '', $asc_bind);
if (count($ary_fetchall) == 1) { //1件該当が前提
    $asc_rec = $ary_fetchall[0];
    $salon_name = $asc_rec['salon_name'];
    $salon_tel = $asc_rec['salon_tel'];
    $salon_addr1 = $asc_rec['salon_addr1'];
    $salon_addr2 = $asc_rec['salon_addr2'];
    $salon_hp = $asc_rec['salon_hp'];
    $salon_ptp_logo = $asc_rec['salon_ptp_logo'];
    $salon_ptp_thank_you = $asc_rec['salon_ptp_thank_you'];
    $salon_insta = $asc_rec['salon_insta'];
    $salon_blog = $asc_rec['salon_blog'];
    $salon_youtube = $asc_rec['salon_youtube'];
}

//41_order_tblユーザーテーブルの呼び出し
$ary_fld = array('order_ai', 'order_counsel_datetime', 'order_visit_datetime', 'order_ope_stylist', 'order_ope_menu', 'order_ope_price', 'order_karte_datetime',  'order_flg_prepaid', 'order_flg_prepaid_sent', 'order_flg_prepaid_done'); //SELECT取得値

$where = 'order_ai=:order_ai';
// $orderby = 'ORDER BY order_counsel_datetime desc LIMIT 1';

$asc_bind = array(); //WHEREのbind値
$asc_bind['order_ai'] = array('val' => $order_ai, 'type' => PDO_INT); //指定user_ai
$ary_fetchall = fnc_pdo_select('41_order_tbl', $ary_fld, $where, '', $asc_bind);
if (count($ary_fetchall) == 1) { //1件該当が前提
    $asc_rec = $ary_fetchall[0];
    $order_ai = $asc_rec['order_ai'];
    $order_counsel_datetime = $asc_rec['order_counsel_datetime'];
    $order_visit_datetime = $asc_rec['order_visit_datetime'];
    $order_karte_datetime = $asc_rec['order_karte_datetime'];
    $order_ope_stylist = $asc_rec['order_ope_stylist'];
    $order_ope_menu = $asc_rec['order_ope_menu'];
    $order_ope_price = $asc_rec['order_ope_price'];
    $order_flg_prepaid = $asc_rec['order_flg_prepaid'];
    $order_flg_prepaid_sent = $asc_rec['order_flg_prepaid_sent'];
    $order_flg_prepaid_done = $asc_rec['order_flg_prepaid_done'];

    //加工
    $order_visit_datetime = str_replace('/', '-', $order_visit_datetime);
}
//乱数（キャッシュクリア用）
$rnd = mt_rand(1000, 9999);

$html_pay = '';
if ($order_flg_prepaid_done == true) {
    $html_pay .= <<< EOM
        <div class="div_pay_prepaid_sent">決済完了</div>
        <div class="div_pay_prepaid_sent_txt">お支払いが完了しました。<br>
            当日お会いできるのを<br>心より楽しみにしております。<br>
            何か変更等ございましたら<br>
            {$salon_tel}までお問い合わせください。</div>
        <div class="div_pay_prepaid_sent_ptp">
            <img src="photo/salon/p{$user_salon_id}_ptp_thank_you-1.jpg?{$rnd}" alt="" height="200px">
        </div>
        <div class="div_pay_prepaid_sent_msg">{$salon_name}スタッフ一同</div>
        EOM;
} else if ($order_flg_prepaid_sent == true) {
    $html_pay .= <<< EOM
        <div class="div_pay_prepaid">決済確認中...</div>
        <div class="div_pay_prepaid_txt">ご予約ありがとうございます。<br>
        ご登録いただいたメールアドレスに<br>
        お支払いのリンクをお送りしております。<br>
        メールの内容に沿って来店日前日までに<br>
        決済をお済ませください。<br>
        ご不明点がありましたら{$salon_tel}まで<br>
        お問い合わせください。</div> 
        <div class="div_pay_detail">ご予約詳細<br>
        お名前：{$user_name}さま<br>
        メニュー内容：{$order_ope_menu}<br>
        決済金額：{$order_ope_price}円</div>
        EOM;
}

?>

<!-- ここからHTML -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_user_pay.css?<?= strtotime('now') ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>beautical</title>
</head>

<body>
    <!-- ヘッダー -->
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
                    <li><a href="user_main.php"><i class="fas fa-home"></i>TOP</a></li>
                    <li><a href="user_karte_list.php"><i class="fas fa-clipboard"></i>カルテ</a></li>
                    <li><a href="<?= $salon_hp ?>"><i class="fas fa-calendar-alt"></i>WEB予約</a></li>
                    <li><a href="user_pay.php?order_ai=<?= $order_ai ?>"><i class="fas fa-credit-card"></i>決済確認</a></li>
                    <li><a href="user_profile.php"><i class="fas fa-user-circle"></i>プロフィール変更</a></li>
                    <li><a href=""><i class="fas fa-sign-out-alt"></i>ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="top">
        <!-- <div><?= $user_name ?>さま</div> -->


        <div><?= $html_pay ?></div>


        <!-- ここから下はどのページでも固定でサロン情報のフッター -->
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
    <!-- //////////////////////////////////////////////////////////////////////// -->
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