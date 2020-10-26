<?php
session_start();
//var_dump($_POST);exit();

//サーバー環境による設定自動切り替え
include('inc_fnc_set_env.php');
fnc_set_env();

include('inc_function.php'); //一般関数
include('inc_fnc_db.php'); //DB用関数

// ログインできたら情報をsession領域に保存して一覧ページへ移動
$_SESSION = array(); // セッション変数を空にする
$_SESSION['session_id'] = session_id();
$txt_user_salon_id = $_POST['txt_user_salon_id'];
$txt_user_id = $_POST['txt_user_id'];
$txt_user_pw = $_POST['txt_user_pw'];

//31_user_tbl情報取得
$user_ai = 0;
$ary_fld = array('user_ai'); //SELECT取得値
$where = 'user_salon_id=:user_salon_id AND user_id=:user_id';
$asc_bind = array(); //WHEREのbind値
$asc_bind['user_salon_id'] = array('val' => $txt_user_salon_id, 'type' => PDO_INT);
$asc_bind['user_id'] = array('val' => $txt_user_id, 'type' => PDO_INT);
$ary_fetchall = fnc_pdo_select('31_user_tbl', $ary_fld, $where, '', $asc_bind);
if (count($ary_fetchall) == 1) {
	$asc_rec = $ary_fetchall[0]; //1レコード該当前提
	$user_ai = $asc_rec['user_ai'];
}

if ($user_ai != 0) {
	$_SESSION['user_ai'] = $user_ai;
	//GETパラメータ設定
	$param_get = '';
	if ($txt_user_pw == 'n') {
		$param_get = 'n';
	}

	if ($param_get != '') $param_get = '?' . $param_get;

	header('Location:user_main.php' . $param_get); // メインページへ移動
} else {
	die('ログインできません');
}
exit();
