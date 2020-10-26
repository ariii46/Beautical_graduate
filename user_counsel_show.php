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
    $salon_addr1 = $asc_rec['salon_addr1'];
    $salon_addr2 = $asc_rec['salon_addr2'];
    $salon_hp = $asc_rec['salon_hp'];
    $salon_insta = $asc_rec['salon_insta'];
    $salon_blog = $asc_rec['salon_blog'];
    $salon_youtube = $asc_rec['salon_youtube'];
}

//41_order_tblユーザーテーブルの呼び出し
$ary_fld = array('order_ai', 'order_counsel_datetime', 'order_visit_datetime', 'order_ope_stylist', 'order_ope_menu', 'order_ope_price', 'order_karte_datetime', 'order_karte_memo'); //SELECT取得値

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
    $order_ope_stylist = $asc_rec['order_ope_stylist'];
    $order_ope_menu = $asc_rec['order_ope_menu'];
    $order_karte_memo = $asc_rec['order_karte_memo'];
    $order_ope_price = $asc_rec['order_ope_price'];
    //加工
    $order_visit_datetime = str_replace('/', '-', $order_visit_datetime);
}

list($user_ai, $counsel_result) = fc_make_div_child_show_counsel_result($order_ai);
list($user_ai, $karte_result) = fc_make_div_show_order_karte($order_ai);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//カウンセリング回答(閲覧用）html生成
//コール元：fnc_btn_show_order_counsel_result()とfnc_btn_reg_order_counsel_result()
function fc_make_div_child_show_counsel_result($a_order_ai)
{
    global $g_ary_sort_gruop;
    $rnd = mt_rand(1000, 9999);
    $html_order_counsel_result = '';

    //41_order_tbl
    $ary_fld = array('order_user_ai', 'order_flg_counsel_result', 'order_counsel_datetime', 'order_counsel_stylist');
    foreach ($g_ary_sort_gruop as $gruop_code => $gruop_jpn) {
        array_push($ary_fld, 'order_' . $gruop_code);
    }
    $where = 'order_ai=:order_ai';
    $asc_bind = array(); //WHEREのbind値
    $asc_bind['order_ai'] = array('val' => $a_order_ai, 'type' => PDO_INT);
    $ary_fetchall = fnc_pdo_select('41_order_tbl', $ary_fld, $where, '', $asc_bind);
    $asc_rec_order = $ary_fetchall[0]; //1レコード該当前提
    $order_user_ai = $asc_rec_order['order_user_ai'];

    //カウンセリング回答UI表示
    foreach ($g_ary_sort_gruop as $gruop_code => $gruop_jpn) {
        $html_order_counsel_result .= '▼' . $gruop_jpn;
        $html_order_counsel_result .= '<br>';
        //
        if ((strpos($gruop_code, 'rdo_') === 0) || (strpos($gruop_code, 'cbx_') === 0)) { //radioタグ or checkboxタグ
            $s_ary_sort = 'g_ary_sort_' . $gruop_code;
            global $$s_ary_sort;
            $s_asc_term = 'g_asc_term_' . $gruop_code;
            global $$s_asc_term;
            foreach ($$s_ary_sort as $val) { //$val=rdo,cbxのoption value値
                $jpn = $$s_asc_term[$val];
                //
                if (strpos($gruop_code, 'rdo_') === 0) { //radioタグ
                    if ($asc_rec_order['order_' . $gruop_code] == $val) { //選択されたrdoなら
                        $html_order_counsel_result .= $jpn;
                        $html_order_counsel_result .= "\n" . '<br>';
                        break; //rdoは1つ選択されたらループ抜け
                    }
                } else if (strpos($gruop_code, 'cbx_') === 0) { //checkboxタグ
                    if (strpos($asc_rec_order['order_' . $gruop_code], ",$val,") !== false) { //,で囲まれた選択コードがあるなら
                        $html_order_counsel_result .= $jpn;
                        $html_order_counsel_result .= "\n" . '<br>';
                    }
                }
            }
        } else if (strpos($gruop_code, 'txt_') === 0) { //input type=text
            $html_order_counsel_result .= $asc_rec_order['order_' . $gruop_code];
            $html_order_counsel_result .= "\n" . '<br>';
        } else if (strpos($gruop_code, 'tta_') === 0) { //textarea
            $html_order_counsel_result .= $asc_rec_order['order_' . $gruop_code];
            $html_order_counsel_result .= "\n" . '<br>';
        } else if (strpos($gruop_code, 'ptp_') === 0) { //写真ピッカー
            $photo_dir = 'photo/order/';
            $num_photo = $asc_rec_order['order_' . $gruop_code]; //写真枚数
            if ($num_photo > 0) {
                $html_order_counsel_result .= '<div>';
                for ($photo_sn = 1; $photo_sn <= $num_photo; $photo_sn++) {
                    $photo_path = $photo_dir . 'p' . $a_order_ai . '_' . $gruop_code . '-' . $photo_sn . '.jpg';
                    if (file_exists($photo_path)) {
                        $html_order_counsel_result .= '<img src="' . $photo_path . '?' . $rnd . '">';
                    }
                }
                $html_order_counsel_result .= '</div>';
            }
        }
        $html_order_counsel_result .= '<br>';
    }
    //
    return array($order_user_ai, $html_order_counsel_result);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//カルテ内容(閲覧用）
function fc_make_div_show_order_karte($a_order_ai)
{
    $html = '';
    $order_user_ai = 0;

    //初期化
    $spn_order_visit_datetime = '';
    $spn_order_ope_menu = '';
    $spn_order_ope_stylist = '';
    $spn_order_ope_price = '';
    $spn_order_ope_detail = '';

    if ($a_order_ai > 0) { //念のため
        //41_order_tbl
        $ary_fld = array('order_user_ai', 'order_visit_datetime', 'order_ope_menu', 'order_ope_stylist', 'order_ope_price', 'order_ope_detail'); //SELECT取得値
        $where = 'order_ai=:order_ai';
        $asc_bind = array(); //WHEREのbind値
        $asc_bind['order_ai'] = array('val' => $a_order_ai, 'type' => PDO_INT);
        $ary_fetchall = fnc_pdo_select('41_order_tbl', $ary_fld, $where, '', $asc_bind);
        $asc_rec = $ary_fetchall[0]; //1レコード該当前提
        //
        $order_user_ai = $asc_rec['order_user_ai'];
        $spn_order_visit_datetime = fnc_conv_datetime('SQL', $asc_rec['order_visit_datetime']);
        $spn_order_ope_stylist = $asc_rec['order_ope_stylist'];
        $spn_order_ope_menu = $asc_rec['order_ope_menu'];
        $spn_order_ope_stylist = $asc_rec['order_ope_stylist'];
        $spn_order_ope_price = $asc_rec['order_ope_price'];
        $spn_order_ope_detail = $asc_rec['order_ope_detail'];

        //31_user_tbl情報取得
        $spn_user_id = '';
        $spn_user_name = '';
        $ary_fld = array('user_id', 'user_name'); //SELECT取得値
        $where = 'user_ai=:user_ai';
        $asc_bind = array(); //WHEREのbind値
        $asc_bind['user_ai'] = array('val' => $order_user_ai, 'type' => PDO_INT);
        $ary_fetchall = fnc_pdo_select('31_user_tbl', $ary_fld, $where, '', $asc_bind);
        $asc_rec = $ary_fetchall[0]; //1レコード該当前提
        $user_id = $asc_rec['user_id'];
        $user_name = $asc_rec['user_name'];
    }

    $html .= '<div>' . "\n";
    $html .= '<span>顧客ID：</span><span class="spn_user_id">' . $spn_user_id . '</span>' . "\n";
    $html .= '</div>' . "\n";
    $html .= '<div>' . "\n";
    $html .= '<span>顧客名：</span><span class="spn_user_name">' . $spn_user_name . '</span>' . "\n";
    $html .= '</div>' . "\n";
    $html .= '<div>' . "\n";
    $html .= 'ビフォー・アフター写真' . "\n";
    $html .= '</div>' . "\n";
    $html .= '<div>' . "\n";
    $html .= '<span>来店日時：</span><span class="spn_order_visit_datetime">' . $spn_order_visit_datetime . '</span>' . "\n";
    $html .= '</div>' . "\n";
    $html .= '<div>' . "\n";
    $html .= '<span>メニュー内容：</span><span class="spn_order_ope_menu">' . $spn_order_ope_menu . '</span>' . "\n";
    $html .= '</div>' . "\n";
    $html .= '<div>' . "\n";
    $html .= '<span>施術担当者：</span><span class="spn_order_ope_stylist">' . $spn_order_ope_stylist . '</span>' . "\n";
    $html .= '</div>' . "\n";
    $html .= '<div>' . "\n";
    $html .= '<span>金額：</span><span class="spn_order_ope_price">' . $spn_order_ope_price . '</span>' . "\n";
    $html .= '</div>' . "\n";
    $html .= '<div>' . "\n";
    $html .= '<span>施術詳細・アフターケア方法：</span><span class="spn_order_ope_detail">' . $spn_order_ope_detail . '</span>' . "\n";
    $html .= '</div>' . "\n";

    //
    return array($order_user_ai, $html);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_user_counsel.css?<?= strtotime('now') ?>">
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>beautical</title>
</head>

<body>
    <header class="pc_header">
        <div class="logo"><img src="" alt=""></div>
        <ul>
            <li><a href="user_karte_list.php">カルテ</a></li>
            <li><a href="<?= $salon_hp ?>">ホームページ</a></li>
            <li><a href="user_pay.php?order_ai=<?= $order_ai ?>">決済</a></li>
            <li><a href="user_profile.php">プロフィール変更</a></li>
        </ul>
    </header>

    <header class="sp_header">
        <div class="logo"><img src="./img/salon_logo.jpg" alt="サロンロゴ" style="height:40px;"></div>
        <!-- ハンバーガーボタン -->
        <div class="btn_logout"><img src="./img/logout_icon.png" alt="" style="height:30px;"></div>
        <div class="drawr_btn"><span></span><span></span><span></span></div>
        <!-- ハンバーガーボタン中身 -->
        <div class="div_menu_nav">
            <div class="drawr_content">カルテ</div>
            <div class="drawr_content">ホームページ</div>
            <div class="drawr_content">決済</div>
            <div class="drawr_content">プロフィール変更</div>
        </div>
    </header>
    <div class="top">
        <!-- <div>こんにちは<?= $user_name ?>さま</div> -->


        <div><?= $counsel_result ?></div>
        <div><?= $karte_result ?></div>




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
            <!-- ここまで -->
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

</body>

</html>