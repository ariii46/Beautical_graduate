<?php
	session_start();
	//var_dump($_POST);exit();

  // ログインできたら情報をsession領域に保存して一覧ページへ移動
	$_SESSION = array(); // セッション変数を空にする
	$_SESSION['session_id'] = session_id();
	$txt_salon_id=$_POST['txt_salon_id'];
	$txt_salon_pw=$_POST['txt_salon_pw'];


	$_SESSION["salon_id"]=$txt_salon_id;
	
	//GETパラメータ設定
	$param_get='';
	if($txt_salon_pw=='n'){
		$param_get='n';
	}

	if($param_get!='')$param_get='?'.$param_get;

	header('Location:salon_main.php'.$param_get); // メインページへ移動
	exit();

