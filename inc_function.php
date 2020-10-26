<?php
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//textarea表示設定 1行目のみ
	function fnc_conv_tta_show_1row($a_tta){
		$tta=$a_tta;
		//
		$ary=explode("\n",$tta);
		if(count($ary)>=2){//複数行なら
			$tta=$ary[0];//1行目だけ
		}
		//
		return $tta;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//textarea表示設定 \n→<br>
	function fnc_conv_tta_show($a_tta){
		$tta=$a_tta;
		//
		$tta=str_replace("\n",'<br>',$tta);
		//
		return $tta;
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//金額フォーマット変換
	//$a_mode:SHOW=0の場合は空欄、1以上なら桁区切りカンマ+円表示 TBL=空欄時は0
	function fnc_conv_price($a_mode,$a_price){
		$ret=mb_convert_kana($a_price,'a');
		//
		if($a_mode=='SHOW'){
			$ret='';
			if(is_numeric($a_price)){
				$price=$a_price-0;//数値化
				if($price>0){
					$ret=number_format($price).'円';
				}
			}
		}else if($a_mode=='TBL'){
			$ret='0';
			if(is_numeric($a_price)){
				$price=$a_price-0;//数値化
				$ret=$price;
			}
		}
		//
		return $ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//日付フォーマット変換
	//$a_format:SQL=yyyy-mm-dd（input=date用 変換）
	//TBL=yyyy/mm/dd（テーブル格納用 変換）
	//$a_datetime=yyyy/mm/dd または yyyy-mm-dd
	function fnc_conv_date($a_format,$a_date){
		$date=$a_date;//戻り値
		//
		if(10==strlen($date)){//文字列長=10
			$yyyy=substr($date,0,4);//年
			$mm=substr($date,5,2);//月
			$dd=substr($date,8,2);//日
			//
			if($a_format=='SQL'){
				$date=$yyyy.'-'.$mm.'-'.$dd;
			}else if($a_format=='TBL'){
				$date=$yyyy.'/'.$mm.'/'.$dd;
			}
		}
		//
		return $date;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//日時フォーマット変換
	//$a_format:SQL=yyyy-mm-ddTnhh:mm（input=datetime-l用 変換）
	//BR=yyyy/mm/dd(dd)\nhh:mm（曜日・改行用 変換）
	//TBL=yyyy/mm/dd nhh:mm（テーブル格納用 変換）
	//$a_datetime=yyyy/mm/dd hh:mm または yyyy-mm-ddTnhh:mm
	function fnc_conv_datetime($a_format,$a_datetime){
		global $g_asc_yobi;
		$datetime=$a_datetime;//戻り値
		//
		if(16==strlen($datetime)){//文字列長=16
			$yyyy=substr($datetime,0,4);//年
			$mm=substr($datetime,5,2);//月
			$dd=substr($datetime,8,2);//日
			$hh=substr($datetime,11,2);//時
			$nn=substr($datetime,14,2);//分
			$idx_yobi=date('w',strtotime($yyyy.'-'.$mm.'-'.$dd));//0～6
			$yobi=$g_asc_yobi[$idx_yobi];//日～土
			//
			if($a_format=='SQL'){
				$datetime=$yyyy.'-'.$mm.'-'.$dd.'T'.$hh.':'.$nn;
			}else if($a_format=='BR'){
				$datetime=$yyyy.'/'.$mm.'/'.$dd.'<br>('.$yobi.')'.$hh.':'.$nn;
			}else if($a_format=='TBL'){
				$datetime=$yyyy.'/'.$mm.'/'.$dd.' '.$hh.':'.$nn;
			}
		}
		//
		return $datetime;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//文字列$a_allの中に文字列$a_partが含まれるかどうか
	function fnc_IsContain($a_all,$a_part){
		$ret=false;
		if(strpos($a_all,$a_part)!==false){
			$ret=true;
		}
		return $ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//UTF8→SJIS変換して文字長を取得
	//注意：①は1文字となる
	function fnc_strlen($a_str){
		$str=$a_str;
		//
		$str=mb_convert_encoding($str,"SJIS-win","UTF-8");
		//$len=mb_strwidth($str);
		$len=strlen($str);
		//
		return $len;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//指定ディレクトリのファイル名取得
	function fnc_GetFileListInDir($a_dir){
		$ary_fn=array();//戻り値 初期化

		if($dir=opendir($a_dir)){
			while (($file = readdir($dir))!==false) {
				if ($file != "." && $file != ".."){
					array_push($ary_fn,$file);
				}
			} 
			closedir($dir);
		}
		sort($ary_fn);//ファイル名順ソート
		//
		return $ary_fn;
	}

	////////////////////////////////////////////////////////////////////////////////////
	//ランダムな文字列生成 判別しやすように 0,O,o,1,I,lは不使用
	function fnc_MakeRandStr($a_len){
		$sCharList='abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
		mt_srand();
		$str='';
		for($i=0;$i<$a_len;$i++){
			$str.= $sCharList[mt_rand(0,strlen($sCharList)-1)];
		}
		//
		return $str;
	}


	////////////////////////////////////////////////////////////////////////////////////
	//チェック：入力項目の妥当性
	//IN :field_jp:フィールド名日本語 term:項目値  flg_blank:空欄許可(false時判定無し) 
	//    max_len:最大文字長(false時判定無し) max_len:最小文字長(false時判定無し)
	//    type:NUM:自然数　FLOAT:小数　FLOAT1:小数第一　ANK:漢字(字数は半角計算)　BOOL:'T'or'F'
	//         DATE:(年/月/日 or 年-月-日) DATE-TIME-S:(年/月/日 or 年-月-日 時:分)※秒なし
	//         TEL:xxx-xxxx-xxx MAIL:メールアドレス（複数対応） LAT-LNG:緯度・経度
	//OUT:エラーメッセージ 
	function fnc_CheckInputTerm($a_field_jp,$a_term,$a_type,$a_flg_blank,$a_max_len,$a_min_len){
		$flg_ok=true;$msg_err='';//戻り値初期化
		mb_regex_encoding('UTF-8');
		$len=strlen(mb_convert_encoding($a_term,'SJIS-win','UTF-8'));//文字列長取得(全半角字数区別あり)
		if('ANK'==$a_type){//漢字の場合
			$len/=2;//2で割って全角1、半角0.5文字での文字長計算
		}
		//
		if(0==$len){
			//空欄の場合
			if($a_flg_blank==false){//空欄不許可の場合
				$flg_ok=false;
				$msg_err='<br>・「'.$a_field_jp.'」エラー<br>　入力が必要';
			}
		}else if(('NUM'==$a_type)||('FLOAT'==$a_type)||('FLOAT1'==$a_type)){//数値項目の場合-------------------------------
			if('NUM'==$a_type){//自然数形式の場合
				if(preg_match('/^[1-9][0-9]*$/u',$a_term)==false){//0以外で始まって、後は0～9の組み合わせ
					$flg_ok=false;
					$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　1以上の数値を入力して下さい<br>　入力値='.$a_term;
				}
			}else if('FLOAT'==$a_type){//小数
				if(preg_match('/^[1-9][0-9]*\.[0-9]+$/u',$a_term)==false){//0以外で始まって、後は0～9の組み合わせ＋小数点＋0～9の組み合わせ
					if(preg_match('/^[1-9][0-9]*$/u',$a_term)==false){//自然数でもない
						$flg_ok=false;
						$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　小数第一の値を要入力して下さい<br>　入力値='.$a_term;
					}
				}
			}else if('FLOAT1'==$a_type){//小数第一
				if(preg_match('/^[1-9][0-9]*\.[0-9]$/u',$a_term)==false){//0以外で始まって、後は0～9の組み合わせ＋小数点＋0～9の組み合わせ
					if(preg_match('/^[1-9][0-9]*$/u',$a_term)==false){//自然数でもない
						$flg_ok=false;
						$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　小数第一の値を入力して下さい<br>　入力値='.$a_term;
					}
				}
			}

		}else if('ANK'==$a_type){//漢字の場合
			//NOP:特にチェック無し(最大文字数チェックがある場合はまとめて後で)

		}else if('MAIL'==$a_type){//メールアドレス（複数対応）
			if(preg_match('/^[a-z0-9_,@¥.¥-]+$/u',$a_term)==false){//単なる半角英数記号のチェック
				$flg_ok=false;
				$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　入力が誤り';
			}

		}else if('BOOL'==$a_type){//'T'or'F'-----------------------------------------------------------
			if(($a_term==='T')||($a_term==='F')){
				//NOP
			}else{
				$flg_ok=false;
				$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　入力が誤り';
			}

		}else if('DATE'==$a_type){//年/月/日 or 年-月-日
			$term=$a_term;$flg_err=true;
			$term=str_replace('/','-',$term);//日付の「/」→「-」
			$ary_term=explode('-', $term);//年月日 分割
			if(Count($ary_term)==3){
				if(checkdate($ary_term[1],$ary_term[2],$ary_term[0])===true){
					$flg_err=false;
				}
			}
			if($flg_err){
				$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　日付指定が誤り ';
			}

		}else if('DATE-TIME-S'==$a_type){//年/月/日 or 年-月-日 時:分 ※秒なし
			$term=$a_term;$flg_err=true;
			//日時デリミタ(/-:)を空白に統一
			$term=str_replace('/',' ',$term);
			$term=str_replace('-',' ',$term);
			$term=str_replace(':',' ',$term);
			$ary_term=explode(' ', $term);//年月日時分 分割
			if(Count($ary_term)==5){
				if(checkdate($ary_term[1],$ary_term[2],$ary_term[0])===true){
					if(fnc_checktime($ary_term[3],$ary_term[4],'00')===true){
						$flg_err=false;
					}
				}
			}
			if($flg_err){
				$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　日時指定が誤り ';
			}

		}else if('TEL'==$a_type){//電話番号:xxx-xxx-xxx
			$term=$a_term;$flg_err=true;
			$ary_term=explode('-', $term);//「-」分割
			if(Count($ary_term)==3){
				if((preg_match('/^[0-9]*$/u',$ary_term[0]))
				&&(preg_match('/^[0-9]*$/u',$ary_term[1]))
				&&(preg_match('/^[0-9]*$/u',$ary_term[2]))){//0～9の組み合わせ
					$flg_err=false;
				}
			}
			if($flg_err){
				$msg_err.='・「'.$a_field_jp.'」エラー<br>TEL指定が誤り ';
			}

		}else if('LAT-LNG'==$a_type){//緯度・経度
			$term=$a_term;$flg_err=true;
			$ary_term=explode(',', $term);//,分割
			if(Count($ary_term)==2){
				if($ary_term[0]<$ary_term[1]){//緯度<経度 ※逆の入力を捕捉
					$flg_err=false;
				}
			}
			if($flg_err){
				$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　緯度・経度指定が誤り ';
			}

		}else{
			$flg_ok=false;
			$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　想定外タイプ('.$a_type.')';
		}
		//
		if($msg_err==''){
			if($a_max_len!==false && $len>$a_max_len){//最大文字数制限の場合
				$flg_ok=false;
				$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　字数オーバー（ 現在'.$len.'文字）';
			}else if($a_min_len!==false && $len<$a_min_len){//最小文字数制限の場合
				$flg_ok=false;
				$msg_err.='<br>・「'.$a_field_jp.'」エラー<br>　字数不足（現在'.$len.'文字）';
			}
		}
		//
		$msg_err=str_replace('<br>',"\n",$msg_err);
		return $msg_err;
	}

	//////////////////////////////////////////////////////////////////////////////////
	function fnc_checktime($hour,$min,$sec) {
		if ($hour < 0 || $hour > 23 || !fnc_isInt($hour)) {
			return false;
		}
		if ($min < 0 || $min > 59 || !fnc_isInt($min)) {
			return false;
		}
		if ($sec < 0 || $sec > 59 || !fnc_isInt($sec)) {
			return false;
		}
		 return true;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//整数判定
	function fnc_isInt($a_str){
		if(preg_match("/^[0-9]+$/",$a_str)){
		  $ret=true;//整数
		}else{
		  $ret=false;//整数ではない
		}
		//
		return $ret;
	}

	//////////////////////////////////////////////////////////////////////////////////
	//$a_tale:保存ファイル名の末尾付加文字（連番等）
	//$a_text:保存内容
	function pr_DebugSave($a_tale,$a_text){
		$dir='_debug/';//出力先フォルダ
		if(file_exists($dir)==false){
			mkdir($dir,0777,true);//true:再帰作成する
			chmod($dir,0777);
		}
		//
		file_put_contents($dir.date('His').'='.$a_tale.'.txt',$a_text);
	}
?>
