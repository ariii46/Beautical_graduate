<?php
session_start();


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

$order_ai = $_POST['order_ai'];

//POST値②（g_ary_sort_gruop関連）
$asc_counsel = array(); //カウンセリング回答（asc_setに引き継ぐ）
$asc_counsel['order_flg_counsel_result'] = array('val' => true, 'type' => PDO_INT);
$asc_counsel_photo = array(); //カウンセリング写真（特別な処理）

foreach ($_POST as $fld => $val) { //$_POSTループ
    if (strpos($fld, 'rdo_') === 0) { //radio（単一回答）時 
        $fld = 'order_' . $fld;
        $asc_counsel[$fld] = array('val' => $val, 'type' => PDO_INT);
    } else if (strpos($fld, 'cbx_') === 0) { //checkbox（複数回答）時 
        $fld = 'order_' . $fld;
        $asc_counsel[$fld] = array('val' => $val, 'type' => PDO_STR);
    } else if (strpos($fld, 'txt_') === 0) { //input type=text
        $fld = 'order_' . $fld;
        $asc_counsel[$fld] = array('val' => $val, 'type' => PDO_STR);
    } else if (strpos($fld, 'tta_') === 0) { //textarea
        $fld = 'order_' . $fld;
        $asc_counsel[$fld] = array('val' => $val, 'type' => PDO_STR);
    } else if (strpos($fld, 'ptp_') === 0) { //$fld=(ptp_グループ名-写真SN)
        $ary = explode('-', $fld); //「ptp_グループコード」と「写真SN」に分割
        if (count($ary) == 2) {
            $asc_counsel_photo[$ary[0]][$ary[1]] = $val; //[ptp_グループコード][写真SN]=BASE64 形式
        }
    }
}
$asc_counsel['order_flg_user_filled']=array('val' => true, 'type' => PDO_INT);


// var_dump($asc_counsel);
// exit();

//where
$where = 'order_ai=:order_ai';
//where用bind
$asc_bind = array();
$asc_bind['order_ai'] = array('val' => $order_ai, 'type' => PDO_INT);
fnc_pdo_update('41_order_tbl', $asc_counsel, $where, $asc_bind);


// 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
header("Location:user_main.php");
exit();
