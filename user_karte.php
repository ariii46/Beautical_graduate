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
    $salon_addr1 = $asc_rec['salon_addr1'];
    $salon_addr2 = $asc_rec['salon_addr2'];
    $salon_hp = $asc_rec['salon_hp'];
    $salon_ptp_logo = $asc_rec['salon_ptp_logo'];
    $salon_insta = $asc_rec['salon_insta'];
    $salon_blog = $asc_rec['salon_blog'];
    $salon_youtube = $asc_rec['salon_youtube'];
}

//41_order_tblユーザーテーブルの呼び出し
$ary_fld = array('order_ai', 'order_counsel_datetime', 'order_visit_datetime', 'order_ope_stylist', 'order_ope_menu', 'order_ope_price', 'order_karte_datetime', 'order_karte_rdo_hair_damage', 'order_karte_rdo_head_solid', 'order_karte_rdo_hair_gloss'); //SELECT取得値

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
    //加工
    $order_visit_datetime = str_replace('/', '-', $order_visit_datetime);
    // 髪質診断用
    $order_karte_rdo_hair_damage = $asc_rec['order_karte_rdo_hair_damage'];
    $order_karte_rdo_head_solid = $asc_rec['order_karte_rdo_head_solid'];
    $order_karte_rdo_hair_gloss = $asc_rec['order_karte_rdo_hair_gloss'];
}

list($user_ai, $flg_counsel_yet, $counsel_result) = fc_make_div_child_show_counsel_result($order_ai);
list($user_ai, $asc_rec_order, $karte_result) = fc_make_div_show_order_karte($order_ai);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//カウンセリング回答(閲覧用）html生成
function fc_make_div_child_show_counsel_result($a_order_ai)
{
    global $g_ary_sort_gruop_counsel;
    $rnd = mt_rand(1000, 9999);
    $html_order_counsel_result = '';

    //41_order_tbl
    $ary_fld = array(
        'order_user_ai', 'order_flg_counsel_result', 'order_counsel_datetime', 'order_counsel_stylist', 'order_flg_counsel_yet'
    );
    foreach ($g_ary_sort_gruop_counsel as $gruop_code => $gruop_jpn) {
        array_push($ary_fld, 'order_' . $gruop_code);
    }
    $where = 'order_ai=:order_ai';
    $asc_bind = array(); //WHEREのbind値
    $asc_bind['order_ai'] = array('val' => $a_order_ai, 'type' => PDO_INT);
    $ary_fetchall = fnc_pdo_select('41_order_tbl', $ary_fld, $where, '', $asc_bind);
    $asc_rec_order = $ary_fetchall[0]; //1レコード該当前提
    $order_user_ai = $asc_rec_order['order_user_ai'];
    $order_flg_counsel_yet = $asc_rec_order['order_flg_counsel_yet'];

    //カウンセリング回答UI表示
    foreach ($g_ary_sort_gruop_counsel as $gruop_code => $gruop_jpn) {
        if (strpos($gruop_code, 'tac_') === false) {
            $html_order_counsel_result .= '<span class="spn_counsel">' . $gruop_jpn . '</span>';
            $html_order_counsel_result .= '<br>';
        }
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
            // } else if (strpos($gruop_code, 'tac_') === 0) { //textarea コンサル用
            // $html_order_counsel_result .= $asc_rec_order['order_' . $gruop_code];
            // $html_order_counsel_result .= "\n" . '<br>';
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
    return array($order_user_ai, $order_flg_counsel_yet, $html_order_counsel_result);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//カルテ内容(閲覧用）
function fc_make_div_show_order_karte($a_order_ai)
{
    global $g_ary_sort_gruop_karte, $g_asc_side_gruop_karte;
    $rnd = mt_rand(1000, 9999);
    $html_order_karte = '';

    //41_order_tbl
    $ary_fld = array(
        'order_user_ai', 'order_visit_datetime', 'order_ope_stylist', 'order_ope_menu', 'order_ope_price', 'order_flg_karte', 'order_karte_datetime'
    ); //SELECT取得値
    foreach ($g_ary_sort_gruop_karte as $gruop_code => $gruop_jpn) {
        array_push($ary_fld, 'order_karte_' . $gruop_code);
    }
    $where = 'order_ai=:order_ai';
    $asc_bind = array(); //WHEREのbind値
    $asc_bind['order_ai'] = array('val' => $a_order_ai, 'type' => PDO_INT);
    $ary_fetchall = fnc_pdo_select('41_order_tbl', $ary_fld, $where, '', $asc_bind);
    $asc_rec_order = $ary_fetchall[0]; //1レコード該当前提
    $order_user_ai = $asc_rec_order['order_user_ai'];
    //カルテUI表示

    foreach ($g_ary_sort_gruop_karte as $gruop_code => $gruop_jpn) {
        $html_order_karte .= '<div class="div_karte_gruop">';
        $html_order_karte .= '<span class="spn_karte">' . $gruop_jpn . '</span>';
        $html_order_karte .= '<br>';
        //
        if ((strpos($gruop_code, 'rdo_') === 0) || (strpos($gruop_code, 'cbx_') === 0)) { //radioタグ or checkboxタグ
            $s_ary_sort = 'g_ary_sort_' . $gruop_code;
            global $$s_ary_sort;
            $s_asc_term = 'g_asc_term_' . $gruop_code;
            if (strpos($gruop_code, 'rdo_') === 0) { //radioタグ
                $html_order_karte .= '<div class="side_gruop_karte">';
                $html_order_karte .= $g_asc_side_gruop_karte[$gruop_code]['front'];
                $html_order_karte .= '</div>';
            }
            global $$s_asc_term;
            foreach ($$s_ary_sort as $val) { //$val=rdo,cbxのoption value値
                $jpn = $$s_asc_term[$val];
                //
                if (strpos($gruop_code, 'rdo_') === 0) { //radioタグ
                    $border = '';
                    if ($asc_rec_order['order_karte_' . $gruop_code] == $val) { //選択されたrdoなら
                        $border = 'border:5px solid silver;';
                    }
                    $html_order_karte .= '<div style="display:inline-block;' . $border . '">';
                    $html_order_karte .= $jpn;
                    $html_order_karte .= "\n" . '<br>';
                    $html_order_karte .= '</div>';
                } else if (strpos($gruop_code, 'cbx_') === 0) { //checkboxタグ
                    if (strpos($asc_rec_order['order_karte_' . $gruop_code], ",$val,") !== false) { //,で囲まれた選択コードがあるなら
                        $html_order_karte .= $jpn;
                        $html_order_karte .= "\n" . '<br>';
                    }
                }
            }
            if (strpos($gruop_code, 'rdo_') === 0) { //radioタグ
                $html_order_karte .= $g_asc_side_gruop_karte[$gruop_code]['back'];
            }
        } else if (strpos($gruop_code, 'txt_') === 0) { //input type=text
            $html_order_karte .= $asc_rec_order['order_karte_' . $gruop_code];
            $html_order_karte .= "\n" . '<br>';
        } else if (strpos($gruop_code, 'tta_') === 0) { //textarea
            $html_order_karte .= $asc_rec_order['order_karte_' . $gruop_code];
            $html_order_karte .= "\n" . '<br>';
        } else if (strpos($gruop_code, 'dtf_') === 0) { //日付範囲（自）
            $html_order_karte .= $asc_rec_order['order_karte_' . $gruop_code];
            $html_order_karte .= "\n" . '<br>';
        } else if (strpos($gruop_code, 'dtt_') === 0) { //日付範囲（至）
            $html_order_karte .= $asc_rec_order['order_karte_' . $gruop_code];
            $html_order_karte .= "\n" . '<br>';
        } else if (strpos($gruop_code, 'ptp_') === 0) { //写真ピッカー
            $photo_dir = 'photo/order/';
            $num_photo = $asc_rec_order['order_karte_' . $gruop_code]; //写真枚数
            if ($num_photo > 0) {
                $html_order_karte .= '<div>';
                for ($photo_sn = 1; $photo_sn <= $num_photo; $photo_sn++) {
                    $photo_path = $photo_dir . 'p' . $a_order_ai . '_' . $gruop_code . '-' . $photo_sn . '.jpg';
                    if (file_exists($photo_path)) {
                        $html_order_karte .= '<img src="' . $photo_path . '?' . $rnd . '">';
                    }
                }
                $html_order_karte .= '</div>';
            }
        }
        $html_order_karte .= '</div>';
        $html_order_karte .= '<br>';
    }
    //
    return array($order_user_ai, $asc_rec_order, $html_order_karte);
}

?>

<!-- ここからHTML -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_user_karte.css?<?= strtotime('now') ?>">
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
        <div class="karte_title"><i class="fas fa-clipboard"></i>今回のカルテ</div>
        <button class="btnn"><?= $order_counsel_datetime ?>~の<br>
            カウンセリング内容をみる</button>
        <!-- カウンセリング情報の表示 -->
        <div id='counsel_hide'><?= $counsel_result ?></div>
        <!-- カルテ情報の表示 -->
        <div><i class="far fa-calendar-alt"></i>ご来店日</div>
        <div class="yomo_4"><?= $order_visit_datetime ?>〜</div>
        <div><i class="fas fa-cut"></i>施術メニュー</div>
        <div class="yomo_4"><?= $order_ope_menu ?></div>
        <div><?= $karte_result ?></div>
        <!--/* 髪質診断関連のGridで記載 */ -->
        <!-- <div class="wrapper">
            <div class="theme1">髪のダメージ：</div>
            <div class="theme1_1">←　健康</div>
            <div class="theme1_2"><img src="photo/karte/5mini.PNG"></div>
            <div class="theme1_3"><input id="image_5" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_damage" value="5" <?php if (!empty($order_karte_rdo_hair_damage) && $order_karte_rdo_hair_damage === "5") {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>></div>
            <div class="theme1_4"><img src="photo/karte/4mini.PNG"></div>
            <div class="theme1_5"><input id="image_4" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_damage" value="4" <?php if (!empty($order_karte_rdo_hair_damage) && $order_karte_rdo_hair_damage === "4") {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>></div>
            <div class="theme1_6"><img src="photo/karte/3mini.PNG"></div>
            <div class="theme1_7"><input id="image_3" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_damage" value="3" <?php if (!empty($order_karte_rdo_hair_damage) && $order_karte_rdo_hair_damage === "3") {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>></div>
            <div class="theme1_8"><img src="photo/karte/2mini.PNG"></div>
            <div class="theme1_9"><input id="image_2" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_damage" value="2" <?php if (!empty($order_karte_rdo_hair_damage) && $order_karte_rdo_hair_damage === "2") {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>></div>
            <div class="theme1_10"><img src="photo/karte/1mini.PNG"></div>
            <div class="theme1_11"><input id="image_1" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_damage" value="1" <?php if (!empty($order_karte_rdo_hair_damage) && $order_karte_rdo_hair_damage === "1") {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>></div>
            <div class="theme1_12">傷み　→</div>
        </div>

        <div class="wrapper">
            <div class="theme1">頭皮の硬さ：</div>
            <div class="theme1_1">←　柔</div>
            <div class="theme1_2"><img src="photo/karte/5mini.PNG"></div>
            <div class="theme1_3"><input id="image_5" readonly="readonly" type="radio" disabled name="order_karte_rdo_head_solid" value="5" <?php if (!empty($order_karte_rdo_head_solid) && $order_karte_rdo_head_solid === "5") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>></div>
            <div class="theme1_4"><img src="photo/karte/4mini.PNG"></div>
            <div class="theme1_5"><input id="image_4" readonly="readonly" type="radio" disabled name="order_karte_rdo_head_solid" value="4" <?php if (!empty($order_karte_rdo_head_solid) && $order_karte_rdo_head_solid === "4") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>></div>
            <div class="theme1_6"><img src="photo/karte/3mini.PNG"></div>
            <div class="theme1_7"><input id="image_3" readonly="readonly" type="radio" disabled name="order_karte_rdo_head_solid" value="3" <?php if (!empty($order_karte_rdo_head_solid) && $order_karte_rdo_head_solid === "3") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>></div>
            <div class="theme1_8"><img src="photo/karte/2mini.PNG"></div>
            <div class="theme1_9"><input id="image_2" readonly="readonly" type="radio" disabled name="order_karte_rdo_head_solid" value="2" <?php if (!empty($order_karte_rdo_head_solid) && $order_karte_rdo_head_solid === "2") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>></div>
            <div class="theme1_10"><img src="photo/karte/1mini.PNG"></div>
            <div class="theme1_11"><input id="image_1" readonly="readonly" type="radio" disabled name="order_karte_rdo_head_solid" value="1" <?php if (!empty($order_karte_rdo_head_solid) && $order_karte_rdo_head_solid === "1") {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>></div>
            <div class="theme1_12">硬　→</div>
        </div>

        <div class="wrapper">
            <div class="theme1">髪のツヤ：</div>
            <div class="theme1_1">←　ツヤツヤ</div>
            <div class="theme1_2"><img src="photo/karte/5mini.PNG"></div>
            <div class="theme1_3"><input id="image_5" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_gloss" value="5" <?php if (!empty($order_karte_rdo_hair_gloss) && $order_karte_rdo_hair_gloss === "5") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>></div>
            <div class="theme1_4"><img src="photo/karte/4mini.PNG"></div>
            <div class="theme1_5"><input id="image_4" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_gloss" value="4" <?php if (!empty($order_karte_rdo_hair_gloss) && $order_karte_rdo_hair_gloss === "4") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>></div>
            <div class="theme1_6"><img src="photo/karte/3mini.PNG"></div>
            <div class="theme1_7"><input id="image_3" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_gloss" value="3" <?php if (!empty($order_karte_rdo_hair_gloss) && $order_karte_rdo_hair_gloss === "3") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>></div>
            <div class="theme1_8"><img src="photo/karte/2mini.PNG"></div>
            <div class="theme1_9"><input id="image_2" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_gloss" value="2" <?php if (!empty($order_karte_rdo_hair_gloss) && $order_karte_rdo_hair_gloss === "2") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>></div>
            <div class="theme1_10"><img src="photo/karte/1mini.PNG"></div>
            <div class="theme1_11"><input id="image_1" readonly="readonly" type="radio" disabled name="order_karte_rdo_hair_gloss" value="1" <?php if (!empty($order_karte_rdo_hair_gloss) && $order_karte_rdo_hair_gloss === "1") {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>></div>
            <div class="theme1_12">パサパサ　→</div>
        </div> -->

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
    <script>
        $(function() {
            $('#btn').click(function() {

            });
        });
    </script>
    <script>
        $('.btnn').on('click', function() {
            $('#counsel_hide').toggle();
            if ($(this).text() === 'カウンセリング内容を閉じる') {
                $(this).text('<?= $order_counsel_datetime ?>~のカウンセリング内容をみる');
            } else {
                $(this).text('カウンセリング内容を閉じる');
            }
        });
    </script>
</body>

</html>