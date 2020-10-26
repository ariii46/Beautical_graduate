<?php
	//サーバー環境による設定自動切り替え
	include('inc_fnc_set_env.php');
	fnc_set_env();

	include('inc_def_const.php');//SITE_TITLE
	
	//開発モード（mode_dev）
	$mode_dev='';
	if(isset($_GET['a'])){
		$mode_dev='ShowAllPage';
	}

	//乱数（キャッシュクリア用）
	$rnd=mt_rand(1000,9999);

	$debug='';

	//css環境切り替え
	$html_style_sheet='';
	$html_style_sheet.="<link rel='stylesheet' type='text/css' href='css/reset.css' />\n";
	$html_style_sheet.="<link rel='stylesheet' type='text/css' href='css/sanitize.css' />\n";
	$html_style_sheet.="<link rel='stylesheet' type='text/css' href='css/style_index.css' />\n";
	if(isset($_GET['n'])){
		$html_style_sheet="<link rel='stylesheet' href='css/style_n.css?".$rnd."'>\n";
	}
	
	//login_pw
	$login_pw='***';
	if(isset($_GET['n'])){
		$login_pw='n';
	}
	
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= SITE_MODE ?><?= SITE_TITLE ?></title>
	<?= $html_style_sheet ?>
</head>
<body>
	<div>
		<form action="user_login.php" method="POST">
			<div><?= SITE_TITLE ?></div>
			<div>サロンID<input type='text' name='txt_user_salon_id' value='102'></div>
			<div>ユーザーID<input type='text' name='txt_user_id' value='1004'></div>
			<div>パスワード<input type='password' name='txt_user_pw' value='<?= $login_pw ?>'></div>
			<div><button>ログイン</button></div>
		</form>
	</div>
</body>
</html>