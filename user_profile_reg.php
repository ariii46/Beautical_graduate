<?php
session_start();
// var_dump($_POST);exit();

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
include('inc_def_common.php');
include('inc_fnc_db.php');
include('inc_function.php');

// var_dump($_POST);
// exit();

$user_name = $_POST["user_name"];
$user_yomi = $_POST["user_yomi"];
$user_birthday = $_POST["user_birthday"];
$user_sex = $_POST["user_sex"];
$user_tel = $_POST["user_tel"];
$user_email = $_POST["user_email"];
$user_pw = $_POST["user_pw"];


$asc_set = array();
$asc_set['user_name'] = array('val' => $user_name, 'type' => PDO_STR);
$asc_set['user_yomi'] = array('val' => $user_yomi, 'type' => PDO_STR);
$asc_set['user_birthday'] = array('val' => $user_birthday, 'type' => PDO_STR);
$asc_set['user_sex'] = array('val' => $user_sex, 'type' => PDO_INT);
$asc_set['user_tel'] = array('val' => $user_tel, 'type' => PDO_STR);
$asc_set['user_email'] = array('val' => $user_email, 'type' => PDO_STR);
$asc_set['user_pw'] = array('val' => $user_pw, 'type' => PDO_STR);

//where
$where = 'user_ai=:user_ai';
//where用bind
$asc_bind = array();
$asc_bind['user_ai'] = array('val' => $user_ai, 'type' => PDO_INT);
fnc_pdo_update('31_user_tbl', $asc_set, $where, $asc_bind);


// 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
header("Location:user_main.php");
exit();
