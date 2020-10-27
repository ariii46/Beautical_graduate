<?php
//サーバー環境による設定自動切り替え
include('inc_fnc_set_env.php');
fnc_set_env();

include('inc_def_const.php'); //SITE_TITLE

//開発モード（mode_dev）
$mode_dev = '';
if (isset($_GET['a'])) {
	$mode_dev = 'ShowAllPage';
}

//乱数（キャッシュクリア用）
$rnd = mt_rand(1000, 9999);

$debug = '';

//css環境切り替え
$html_style_sheet = '';
$html_style_sheet .= "<link rel='stylesheet' type='text/css' href='css/reset.css' />\n";
$html_style_sheet .= "<link rel='stylesheet' type='text/css' href='css/sanitize.css' />\n";
$html_style_sheet .= "<link rel='stylesheet' type='text/css' href='css/style.css' />\n";
if (isset($_GET['n'])) {
	$html_style_sheet = "<link rel='stylesheet' href='css/style_n.css?" . $rnd . "'>\n";
}

//login_pw
$login_pw = '***';
if (isset($_GET['n'])) {
	$login_pw = 'n';
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/style_salon_login.css?<?= strtotime('now') ?>">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<title><?= SITE_MODE ?><?= SITE_TITLE ?></title>
	<?= $html_style_sheet ?>
</head>

<body>
	<div class="login">
		<div class="site_title">Beautical</div>
		<form class="login_form" action="salon_login.php" method="POST">
			<i class="fas fa-store"></i>
			<div class="login_title">SALON LOGIN</div>
			<div class="login_txt"><i class="fas fa-cut">サロンID</i><input type='text' name='txt_salon_id' value='102' placeholder="サロンID"></div>
			<div class="login_txt"><i class="fas fa-lock">パスワード</i><input type='password' name='txt_salon_pw' value='<?= $login_pw ?>' placeholder="パスワード"></div>
			<div><button>ログイン</button></div>
		</form>
	</div>
</body>

</html>