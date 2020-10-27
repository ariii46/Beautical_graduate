<?php
$g_asc_yobi = array(0 => '日', 1 => '月', 2 => '火', 3 => '水', 4 => '木', 5 => '金', 6 => '土');

$g_asc_sex = array(1 => '女', 2 => '男');


//カウンセリング用----------------------------------------------------------------------------------------------------
//sort指定順に選択肢termを表示 $g_ary_sort_(code_term),$g_asc_term_(code_term)
// []内の番号がDBに記録される
//表示順・非表示変更はsort配列にて

$g_ary_sort_gruop_counsel = array(
	'rdo_cur_media_cognize' => '<div class="yomo">１．当店をお知りになったきっかけをお選びください。</div>',
	'tac_cur_media_cognize' => '他の美容室がたくさんある中で、当店をお選びいただいた理由や決め手はありましたか？<br>どんなところが良かったですか?例えば～とか·どんなところが気になりましたか？',

	'rdo_ope_request_menu' => '<div class="yomo">２．本日のご希望のメニューを教えてください。</div><br>※カラーをお選びの方は後ほど、２０〜２５番についてもご回答ください。',
	'tac_ope_request_menu' => '本日のご希望のメニューは〇〇とXXでよろしいでしょうか？',

	'rdo_ope_request_price' => '<div class="yomo">３．ご参考までに本日のおおよそのご予算をお教えください。</div> ',
	'tac_ope_request_price' => 'ご予算の件、承りました。後ほど、メニュー確定後に金額をご案内致しますね。',

	'rdo_ope_request_time' => '<div class="yomo">４．本日のお時間のご都合をお教えください。</div>',
	'tac_ope_request_time' => '終了希望の時間がある場合：ご希望の時間は何時になりますでしょか？',

	'cbx_cur_reason_change_slaon' => '<div class="yomo">５．美容室を変えようと思ったきっかけを教えてください。</div>',
	'tac_cur_reason_change_slaon' => 'これまでの美容室で嬉しかったことはありますか？<br>これまでの美容室で嫌だったことはありますか？<br>その他の場合：差し支えなければ、理由をお聞かせいただけますか？',

	'cbx_pre_ope_menu' => '<div class="yomo">６．前回の施術メニューを教えてください。</div>',
	'tac_pre_ope_menu' => '前回はどんなメニューをされたのですか？',

	'rdo_pre_ope_interval' => '<div class="yomo">７．前回は何ヶ月前に施術されましたか。</div>',
	'tac_pre_ope_interval' => '大体いつもそのくらいの周期でご来店されるのですか？<br>お休みは〇〇（平日or休日）ですか？',

	'cbx_cur_request_tech' => '<div class="yomo">８．技術面で美容室に求めるものをお教えください。（最大３つ）</div>',
	'tac_cur_request_tech' => 'そうなんですね、〇〇ってXXですよね。（共感）<br>（聞きたいことがあれば掘り下げて確認する）<br>その他の場合：差し支えなければ、美容室へのこだわりを教えていただけますか？',

	'cbx_cur_request_service' => '<div class="yomo">９．サービス面で美容室に求めるものを教えてください。（最大３つ）</div>',
	'tac_cur_request_service' => 'そうなんですね、〇〇ってXXですよね。（共感）<br>（聞きたいことがあれば掘り下げて確認する）<br>その他の場合：差し支えなければ、美容室へのこだわりを教えていただけますか？',

	'cbx_ope_request_spend' => '<div class="yomo">１０．当日のサロンでの過ごし方のご希望を教えてください。（最大３つ）</div>',
	'tac_ope_request_spend' => '雑誌を読みたい場合：お好きなジャンルの雑誌等はありますか？<br>その他の場合：どんなお過ごし方がお好きでしょうか？',

	'cbx_cur_worry_hair_quality' => '<div class="yomo">１１．髪の状態で気になるところを教えてください。（複数選択可）</div>',
	'tac_cur_worry_hair_quality' => 'いつから気になっていますか？<br>どこが気になりますか？<br>どんな時に気になりますか？<br>どうなれたらいいですか？',

	'cbx_cur_worry_hair_status' => '<div class="yomo">１２．頭皮の状態で気になるところに○をしてください。（複数選択可）</div>',
	'tac_cur_worry_hair_status' => 'いつから気になっていますか？<br>どこが気になりますか？<br>どんな時に気になりますか？<br>どうなれたらいいですか？',

	'cbx_cur_picky_home_care' => '<div class="yomo">１３．こだわりのホームケアがあれば教えてください。</div>',
	'tac_cur_picky_home_care' => 'どんな風にされているんですか？<br>朝・夜などいつのタイミングでされるのですか？<br>集中トリートメントの場合：どのくらいの頻度でされるのですか？<br>〇〇様のお悩みやライフスタイルにあったホームケアの方法を後ほどご提案させて頂いてもよろしいでしょうか?',

	'rdo_ope_request_hair_style' => '<div class="yomo">１４．本日のヘアスタイルの方向性に○をつけてください。</div><br>※ご希望のイメージがありましたら、質問１５〜１７、質問２０にご登録ください。<br>',
	'tac_ope_request_hair_style' => '？？？？',

	'ptp_goal_hair_style' => '～こだわり条件設定～<br><div class="yomo">１５．なりたい髪型のイメージがあれば写真をアップしてください。（３枚まで）</div>',
	'tac_goal_hair_style' => '（髪型のイメージについて聞きたいこと、提案を話す。）',

	'rdo_goal_image' => '<div class="yomo">１６．なりたいイメージがあれば教えてください。</div>',
	'tac_goal_image' => '（なりたいイメージについて聞きたいこと、提案を話す。）',

	'rdo_goal_hair_quality' => '<div class="yomo">１７．なりたい髪質があれば教えてください。</div>',
	'tac_goal_hair_quality' => '（なりたい髪質について聞きたいこと、提案を話す。）',

	'rdo_ope_strength_shampoo' => '<div class="yomo">１８．お好きなシャンプーの強さ</div>',
	'tac_ope_strength_shampoo' => '確認のみ',

	'cbx_ope_help' => '<div class="yomo">１９．お手伝いできること</div>',
	'tac_ope_help' => '提案：XXX',

	'ptp_goal_hair_color' => '<div class="yomo">２０．なりたい髪色のイメージがあれば写真をアップしてください。（３枚まで）</div>',
	'tac_goal_hair_color' => '？？？',

	'rdo_cur_hair_color' => '<div class="yomo">２１．現在の髪色を教えてください。</div>',
	'tac_cur_hair_color' => '確認のみ',

	'rdo_cur_hair_brightness' => '<div class="yomo">２２．現在の髪の明るさを教えてください。</div>',
	'tac_cur_hair_brightness' => '確認のみ',

	'rdo_cur_hair_white' => '<div class="yomo">２３．現在の白髪の量を教えてください。</div>',
	'tac_cur_hair_white' => '確認のみ',

	'rdo_past_ope_ache' => '<div class="yomo">２４．美容室の施術で染みたことはありますか？</div>',
	'tac_past_ope_ache' => '染みたことがある場合は確認',

	'rdo_cur_request_hair_color' => '<div class="yomo">２５．カラーに求めるものはありますか？</div>',
	'tac_cur_request_hair_color' => '鮮やかさ・発色の場合：xxxx<br>色持ちの良さの場合：xxxx<br>頭皮や髪に優しい薬剤選定：xxxx<br>白髪の染まりの場合：xxxx',

	'tta_user_message' => '<div class="yomo">２６．その他要望・スタッフに伝えておきたいこと</div>',
	'tac_user_message' => '記入項目があれば確認',

	'tac_ope_menu' => '<hr class="hr_counsel">↓以降はお客様には見えない。編集モードで登場<br>２７．施術内容の確認',

	'tac_ope_visit_datetime' => '<hr class="hr_counsel">２８．来店日時の決定',

	'tac_ope_submit_price' => '<hr class="hr_counsel">２９．決済額の提示',

	'tac_ope_lecture_pay' => '<hr class="hr_counsel">３０．支払い方法の案内<br>お支払いについては、事前決済サービスでご案内させていただいてもよろしいでしょうか？<br>YES：後ほど、メールアドレスに決済のためのリンクをお送りさせていただきますのでそちらに従って、お支払ください。<br>NO：当日のお支払で賜りました。'
);


//rdo_cur_media_cognize
$g_ary_sort_rdo_cur_media_cognize = array(1, 2, 3, 4, 5, 6, 7, 8);
$asc = array();
$asc[1] = '検索エンジンより当店ホームページ';
$asc[2] = 'ホットペッパービューティー(WEB)';
$asc[3] = 'minimo';
$asc[4] = '看板、通りがかり';
$asc[5] = 'ちらし';
$asc[6] = 'SNS(Facebook · Instagramなど)';
$asc[7] = '知人のご紹介';
$asc[8] = 'その他';
$g_asc_term_rdo_cur_media_cognize = $asc;

//rdo_ope_request_menu
$g_ary_sort_rdo_ope_request_menu = array(1, 2, 3, 4, 5, 6, 7, 8);
$asc = array();
$asc[1] = 'カット';
$asc[2] = 'カラー※';
$asc[3] = '縮毛矯正・ストレート';
$asc[4] = 'パーマ・デジタルパーマ';
$asc[5] = '白髪染め';
$asc[6] = 'トリートメント';
$asc[7] = 'ヘッドスパ';
$asc[8] = 'その他';
$g_asc_term_rdo_ope_request_menu = $asc;

//rdo_ope_request_price
$g_ary_sort_rdo_ope_request_price = array(1, 2, 3, 4, 5, 6);
$asc = array();
$asc[1] = '～¥8,000';
$asc[2] = '～¥10,000 ';
$asc[3] = '～¥12,000 ';
$asc[4] = '～¥14,000 ';
$asc[5] = '～¥15,000 ';
$asc[6] = '～¥20,000';
$g_asc_term_rdo_ope_request_price = $asc;

//rdo_ope_request_time
$g_ary_sort_rdo_ope_request_time = array(1, 2, 3);
$asc = array();
$asc[1] = '少し余裕がある';
$asc[2] = 'できるだけ早くしてほしい';
$asc[3] = '終了希望の時間がある';
$g_asc_term_rdo_ope_request_time = $asc;

//cbx_cur_reason_change_slaon
$g_ary_sort_cbx_cur_reason_change_slaon = array(1, 2, 3, 4, 5);
$asc = array();
$asc[1] = '担当者が辞めた';
$asc[2] = '引っ越し';
$asc[3] = '店のシステムや雰囲気が悪かった';
$asc[4] = '希望や要望が伝わらなかった';
$asc[5] = 'その他';
$g_asc_term_cbx_cur_reason_change_slaon = $asc;

//cbx_pre_ope_menu
$g_ary_sort_cbx_pre_ope_menu = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
$asc = array();
$asc[1] = 'カット';
$asc[2] = 'カラー';
$asc[3] = '縮毛矯正・ストレート';
$asc[4] = 'パーマ・デジタルパーマ';
$asc[5] = '白髪染め';
$asc[6] = '黒染め';
$asc[7] = 'トリートメント';
$asc[8] = 'ヘッドスパ';
$asc[9] = 'その他';
$g_asc_term_cbx_pre_ope_menu = $asc;

//rdo_pre_ope_interval
$g_ary_sort_rdo_pre_ope_interval = array(1, 2, 3, 4, 5);
$asc = array();
$asc[1] = '約1ヶ月';
$asc[2] = '約2ヶ月';
$asc[3] = '約3ヶ月';
$asc[4] = '約4～6ヶ月';
$asc[5] = '6ヶ月以上';
$g_asc_term_rdo_pre_ope_interval = $asc;

//cbx_cur_request_tech
$g_ary_sort_cbx_cur_request_tech = array(1, 2, 3, 4, 5, 6);
$asc = array();
$asc[1] = '持ちの良さ';
$asc[2] = '似合わせカ';
$asc[3] = '施術スピード';
$asc[4] = '丁寧さ';
$asc[5] = '髪の痛み改善';
$asc[6] = 'その他';
$g_asc_term_cbx_cur_request_tech = $asc;

//cbx_cur_request_service
$g_ary_sort_cbx_cur_request_service = array(1, 2, 3, 4, 5, 6);
$asc = array();
$asc[1] = '予約の取りやすさ・営業時間';
$asc[2] = '接客態度・サロンの雰囲気';
$asc[3] = '提案、アドバイス';
$asc[4] = 'ロコミ·評判';
$asc[5] = '通いやすさ、 立地';
$asc[6] = 'その他';
$g_asc_term_cbx_cur_request_service = $asc;

//cbx_ope_request_spend
$g_ary_sort_cbx_ope_request_spend = array(1, 2, 3, 4, 5, 6);
$asc = array();
$asc[1] = 'とにかくゆっくりしたい';
$asc[2] = '楽しくお話ししたい';
$asc[3] = '喋るのは苦手';
$asc[4] = '雑誌を読みたい';
$asc[5] = '美容知識を知りたい';
$asc[6] = 'その他';
$g_asc_term_cbx_ope_request_spend = $asc;

//cbx_cur_worry_hair_quality
$g_ary_sort_cbx_cur_worry_hair_quality = array(1, 2, 3, 4, 5, 6, 7, 8);
$asc = array();
$asc[1] = '枝毛・切れ毛';
$asc[2] = 'ダメージ・パサつき';
$asc[3] = '毛先の引っ掛かり';
$asc[4] = '白髪';
$asc[5] = '広がる・ペタンコ';
$asc[6] = '量が多い・少ない';
$asc[7] = '髪が太い・細い';
$asc[8] = '髪が硬い・柔らかい';
$g_asc_term_cbx_cur_worry_hair_quality = $asc;

//cbx_cur_worry_hair_status
$g_ary_sort_cbx_cur_worry_hair_status = array(1, 2, 3, 4, 5, 6, 7, 8);
$asc = array();
$asc[1] = 'かゆみ';
$asc[2] = '乾燥';
$asc[3] = 'フケ';
$asc[4] = '脂っぽい';
$asc[5] = '抜け毛 ';
$asc[6] = '薄毛';
$asc[7] = 'におい';
$asc[8] = 'しみやすい';
$g_asc_term_cbx_cur_worry_hair_status = $asc;

//cbx_cur_picky_home_care
$g_ary_sort_cbx_cur_picky_home_care = array(1, 2, 3, 4);
$asc = array();
$asc[1] = 'シャンプー・コンディショナー';
$asc[2] = '集中トリートメント';
$asc[3] = '頭皮ケア';
$asc[4] = '美容機器（ドライヤーなど）';
$g_asc_term_cbx_cur_picky_home_care = $asc;

//rdo_ope_request_hair_style
$g_ary_sort_rdo_ope_request_hair_style = array(1, 2, 3, 4, 5, 6);
$asc = array();
$asc[1] = '長さを変えたい ';
$asc[2] = '変えたくない';
$asc[3] = '長さは変えずにイメージ・ 雰囲気を変えたい※';
$asc[4] = 'スタイル・見た目を変えたい※';
$asc[5] = 'イメチェンしたい※';
$asc[6] = '相談して決めたい';
$g_asc_term_rdo_ope_request_hair_style = $asc;

//rdo_goal_image
$g_ary_sort_rdo_goal_image = array(1, 2, 3, 4, 5, 6);
$asc = array();
$asc[1] = 'キュート';
$asc[2] = 'カジュアル';
$asc[3] = 'クール';
$asc[4] = 'エレガント';
$asc[5] = 'ナチュラル';
$asc[6] = 'わからない';
$g_asc_term_rdo_goal_image = $asc;

//rdo_goal_hair_quality
$g_ary_sort_rdo_goal_hair_quality = array(1, 2, 3, 4, 5, 6, 7, 8);
$asc = array();
$asc[1] = 'まとまり';
$asc[2] = 'ふんわり';
$asc[3] = 'しっとり';
$asc[4] = 'さらさら';
$asc[5] = 'つやつや';
$asc[6] = 'やわらか';
$asc[7] = 'うるおい';
$asc[8] = 'ハリコシ';
$g_asc_term_rdo_goal_hair_quality = $asc;

//rdo_ope_strength_shampoo
$g_ary_sort_rdo_ope_strength_shampoo = array(1, 2, 3);
$asc = array();
$asc[1] = '強めにしっかり';
$asc[2] = 'ふつう';
$asc[3] = '優しく';
$g_asc_term_rdo_ope_strength_shampoo = $asc;

//cbx_ope_help
$g_ary_sort_cbx_ope_help = array(1, 2, 3, 4);
$asc = array();
$asc[1] = '日常ケアの相談';
$asc[2] = '髪の痛みや状態を見て、おすすめのシャンプーやトリートメントなどがあれば教えて欲しい';
$asc[3] = 'サロンのシャンプーや製品に興味があるので話を聞いてみたい';
$asc[4] = '施術後のスタイリングのコツを教えて欲しい';
$g_asc_term_cbx_ope_help = $asc;

//rdo_cur_hair_color
$g_ary_sort_rdo_cur_hair_color = array(1, 2, 3, 4);
$asc = array();
$asc[1] = '黒<br><img src="img/counsel/hair_color_black.png">';
$asc[2] = '茶<br><img src="img/counsel/hair_color_brown.png">';
$asc[3] = '赤<br><img src="img/counsel/hair_color_red.png">';
$asc[4] = '黄<br><img src="img/counsel/hair_color_yellow.png">';
$g_asc_term_rdo_cur_hair_color = $asc;

//rdo_cur_hair_brightness
$g_ary_sort_rdo_cur_hair_brightness = array(1, 2, 3, 4);
$asc = array();
$asc[1] = 'とても暗い<br><img src="img/counsel/hair_brightness_1.png">';
$asc[2] = '暗い<br><img src="img/counsel/hair_brightness_2.png">';
$asc[3] = '明るい<br><img src="img/counsel/hair_brightness_3.png">';
$asc[4] = 'とても明るい<br><img src="img/counsel/hair_brightness_4.png">';
$g_asc_term_rdo_cur_hair_brightness = $asc;

//rdo_cur_hair_white
$g_ary_sort_rdo_cur_hair_white = array(1, 2, 3, 4);
$asc = array();
$asc[1] = '無し<br><img src="img/counsel/hair_white_none.png">';
$asc[2] = '少し<br><img src="img/counsel/hair_white_little.png">';
$asc[3] = 'たくさん<br><img src="img/counsel/hair_white_many.png">';
$asc[4] = 'ほとんど<br><img src="img/counsel/hair_white_almost.png">';
$g_asc_term_rdo_cur_hair_white = $asc;

//rdo_past_ope_ache
$g_ary_sort_rdo_past_ope_ache = array(1, 2, 3);
$asc = array();
$asc[1] = '染みたことはない';
$asc[2] = '染みたことがある（アレルギーはない）';
$asc[3] = '染みたことがある（アレルギーがある）';
$g_asc_term_rdo_past_ope_ache = $asc;

//rdo_cur_request_hair_color
$g_ary_sort_rdo_cur_request_hair_color = array(1, 2, 3, 4);
$asc = array();
$asc[1] = '鮮やかさ・発色';
$asc[2] = '色持ちのよさ';
$asc[3] = '頭皮や髪に優しい薬剤選定';
$asc[4] = '白髪の染まり';
$g_asc_term_rdo_cur_request_hair_color = $asc;

//カルテ用----------------------------------------------------------------------------------------------------
//sort指定順に選択肢termを表示 $g_ary_sort_(code_term),$g_asc_term_(code_term)
// []内の番号がDBに記録される
//表示順・非表示変更はsort配列にて
$g_ary_sort_gruop_karte = array(
	'ptp_hair_before' => '【Before】',
	'ptp_hair_after' => '【After】',
	'rdo_hair_damage' => '<div class="yomo">今のあなたの髪質診断</div><br>髪のダメージ',
	'rdo_head_solid' => '頭皮の硬さ',
	'rdo_hair_gloss' => '髪のツヤ',
	'tta_after_care' => '<div class="yomo">アフターケア・スタイリング方法</div>',
	'dtf_next_visit_date' => '<div class="yomo">次回ベストなご来店時期</div>',
	'dtt_next_visit_date' => '～',
	'tta_next_recommend_menu' => '<div class="yomo">オススメメニュー</div>',
	'tta_next_order_present' => '<div class="yomo">次回予約特典</div>',
);
$g_asc_side_gruop_karte = array();
$g_asc_side_gruop_karte['rdo_hair_damage']['front'] = '傷み';
$g_asc_side_gruop_karte['rdo_hair_damage']['back'] = '健康';
$g_asc_side_gruop_karte['rdo_head_solid']['front'] = '硬い';
$g_asc_side_gruop_karte['rdo_head_solid']['back'] = '柔らかい';
$g_asc_side_gruop_karte['rdo_hair_gloss']['front'] = 'パサパサ';
$g_asc_side_gruop_karte['rdo_hair_gloss']['back'] = 'ツヤツヤ';

//rdo_hair_damage
$g_ary_sort_rdo_hair_damage = array(1, 2, 3, 4, 5);
$asc = array();
$asc[1] = '<img src="photo/karte/1mini.PNG">';
$asc[2] = '<img src="photo/karte/2mini.PNG">';
$asc[3] = '<img src="photo/karte/3mini.PNG">';
$asc[4] = '<img src="photo/karte/4mini.PNG">';
$asc[5] = '<img src="photo/karte/5mini.PNG">';
$g_asc_term_rdo_hair_damage = $asc;

//rdo_head_solid
$g_ary_sort_rdo_head_solid = array(1, 2, 3, 4, 5);
$asc = array();
$asc[1] = '<img src="photo/karte/1mini.PNG">';
$asc[2] = '<img src="photo/karte/2mini.PNG">';
$asc[3] = '<img src="photo/karte/3mini.PNG">';
$asc[4] = '<img src="photo/karte/4mini.PNG">';
$asc[5] = '<img src="photo/karte/5mini.PNG">';
$g_asc_term_rdo_head_solid = $asc;

//rdo_hair_gloss
$g_ary_sort_rdo_hair_gloss = array(1, 2, 3, 4, 5);
$asc = array();
$asc[1] = '<img src="photo/karte/1mini.PNG">';
$asc[2] = '<img src="photo/karte/2mini.PNG">';
$asc[3] = '<img src="photo/karte/3mini.PNG">';
$asc[4] = '<img src="photo/karte/4mini.PNG">';
$asc[5] = '<img src="photo/karte/5mini.PNG">';
$g_asc_term_rdo_hair_gloss = $asc;

	//sort指定順に選択肢termを表示 $g_ary_sort_(code_term),$g_asc_term_(code_term)
	// []内の番号がDBに記録される
	//表示順・非表示変更はsort配列にて

/*
	//
	$g_ary_sort_=array(1,2,3,4,5,6,7);
	$asc=array();
	$asc[1]='';
	$asc[2]='';
	$asc[3]='';
	$asc[4]='';
	$asc[5]='';
	$asc[6]='';
	$asc[7]='';
	$asc[8]='';
	$g_asc_term_=$asc;
*/
