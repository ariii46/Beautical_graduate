<?php
	//サーバー環境による設定自動切り替え
	include('inc_fnc_set_env.php');
	fnc_set_env();

	include('inc_def_const.php');//定数
	include('inc_def_common.php');//グローバル変数
	include('inc_function.php');//一般関数
	include('inc_fnc_db.php');//DB用関数
?>
<?php
	//btn_param=(order_ai)-(user_ai)-(page_this)-(page_from)-(date)-(mode)
	$asc_ret=array();$debug='';//出力 初期化

	//act処理
	$act='';
	if(isSet($_POST['act'])){
		$act=$_POST['act'];
	}

	//「タイムテーブル」ページ----------------------------------------------------------------------------------
	if($act=='ready'){//ページ読み込み時
		$asc_ret=fnc_ready();

	}else if($act=='btn_search_general_timetable'){//タイムテーブル日付変更
		$asc_ret=fnc_btn_search_general_timetable();

	//「カウンセリング日時」------------------------------------------------------------------------------------
	}else if($act=='btn_edit_order_counsel_datetime'){//編集ボタン
		$asc_ret=fnc_btn_edit_order_counsel_datetime();

	}else if($act=='btn_reg_order_counsel_datetime'){//登録ボタン
		$asc_ret=fnc_btn_reg_order_counsel_datetime();

	//「カウンセリング回答」------------------------------------------------------------------------------------
	}else if($act=='set_page_show_order_counsel_result'){//カウンセリング回答：閲覧ページ設定
		$asc_ret=fnc_set_page_show_order_counsel_result();

	}else if($act=='btn_edit_order_counsel_result'){//編集ボタン
		$asc_ret=fnc_btn_edit_order_counsel_result();

	}else if($act=='btn_reg_order_counsel_result'){//登録ボタン
		$asc_ret=fnc_btn_reg_order_counsel_result();

	//「事前決済」----------------------------------------------------------------------------------------------
	}else if($act=='btn_edit_order_prepaid'){//事前決済：編集ボタン
		$asc_ret=fnc_btn_edit_order_prepaid();

	}else if($act=='btn_reg_order_prepaid'){//事前決済：登録ボタン
		$asc_ret=fnc_btn_reg_order_prepaid();

	//「施術」--------------------------------------------------------------------------------------------------
	}else if($act=='set_page_show_order_ope'){//施術：閲覧ページ設定
		$asc_ret=fnc_set_page_show_order_ope();

	}else if($act=='btn_edit_order_ope'){//施術：編集ボタン
		$asc_ret=fnc_btn_edit_order_ope();

	}else if($act=='btn_reg_order_ope'){//施術：登録ボタン
		$asc_ret=fnc_btn_reg_order_ope();

	//「カルテ」------------------------------------------------------------------------------------------------
	}else if($act=='set_page_show_order_karte'){//カルテ：閲覧ページ設定
		$asc_ret=fnc_set_page_show_order_karte();

	}else if($act=='btn_edit_order_karte'){//カルテ：編集ボタン
		$asc_ret=fnc_btn_edit_order_karte();

	}else if($act=='btn_reg_order_karte'){//カルテ：登録ボタン
		$asc_ret=fnc_btn_reg_order_karte();

	//「予約新規」----------------------------------------------------------------------------------------------
	}else if($act=='btn_add_order'){//予約追加ボタン
		$asc_ret=fnc_btn_add_order();

	}else if($act=='btn_add_order_counsel_datetime'){//カウンセリング日時 新規ボタン
		$asc_ret=fnc_btn_edit_order_counsel_datetime();

	}else if($act=='btn_add_order_counsel_result'){//カウンセリング内容 新規ボタン
		$asc_ret=fnc_btn_edit_order_counsel_result();

	}else if($act=='btn_add_order_ope'){//施術 新規ボタン
		$asc_ret=fnc_btn_edit_order_ope();

	}else if($act=='btn_add_order_karte'){//カルテ 新規ボタン
		$asc_ret=fnc_btn_edit_order_karte();

	//「顧客管理」----------------------------------------------------------------------------------------------
	}else if($act=='btn_search_user'){//検索ボタン
		$asc_ret=fnc_btn_search_user();

	}else if($act=='btn_add_user'){//新規ボタン
		$asc_ret=fnc_btn_add_user();

	}else if($act=='btn_edit_user'){//編集ボタン
		$asc_ret=fnc_btn_edit_user();

	}else if($act=='btn_reg_user'){//登録ボタン
		$asc_ret=fnc_btn_reg_user();

	//「予約/カルテ管理」---------------------------------------------------------------------------------------
	}else if($act=='btn_search_general_order'){//検索ボタン
		$asc_ret=fnc_btn_search_general_order();

	//「サロン情報」--------------------------------------------------------------------------------------------
	}else if($act=='btn_show_salon_data'){//サロン情報 閲覧ボタン
		$asc_ret=fnc_btn_show_salon_data();

	}else if($act=='btn_edit_salon_data'){//サロン情報 編集ボタン
		$asc_ret=fnc_btn_edit_salon_data();

	}else if($act=='btn_reg_salon_data'){//サロン情報 登録ボタン
		$asc_ret=fnc_btn_reg_salon_data();

	}else{
		$asc_ret['result']='NG';
		$asc_ret['msg']='<span style="color: red">想定外actエラー'.print_r($_POST,true).'</span>';
		$asc_ret['debug']=$debug;
	}

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode($asc_ret);

?>
<?php
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//ページ レディ時
	function fnc_ready(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//セッション値
		$ssn_salon_id=102;//$_SESSION['salon_id'];
		
		//21_salon_tbl情報取得
		$ary_fld=array('salon_name','salon_zoom');//SELECT取得値
		$where='salon_id=:salon_id';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['salon_id']=array('val'=>$ssn_salon_id,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('21_salon_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		$salon_name=$asc_rec['salon_name'];
		$salon_zoom=$asc_rec['salon_zoom'];

		$date_today=date('Y/m/d');//今日
		$search_tt_word='';//検索キーワード
		$page_this='div_page_timetable';//div_pageのid
		$mode='TIMETABLE';//モード=タイムテーブル
		$html=fc_make_tbody_child_tbl_order($ssn_salon_id,$page_this,$mode,$date_today,$search_tt_word);//tbl_timetableのtbody child作成

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['salon_id']=$ssn_salon_id;//サロンid
			$asc_ret['salon_name']=$salon_name;//サロン名
			$asc_ret['salon_zoom']=$salon_zoom;//サロンZoomリンク
			$asc_ret['tbody']=$html;//tbl_timetableのtbody child
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//タイムテーブル：（日付・検索キーワード）検索
	function fnc_btn_search_general_timetable(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_salon_id=$_POST['js_salon_id'];
		$tdt_timetable=$_POST['tdt_timetable'];//日付（-区切）
		$txt_search_tt_word=$_POST['txt_search_tt_word'];//検索キーワード
		
		$tdt_timetable=str_replace('-','/',$tdt_timetable);//「-」→「/」変換

		$page_this='div_page_timetable';//div_pageのid
		$mode='TIMETABLE';//モード=タイムテーブル
		$html=fc_make_tbody_child_tbl_order($js_salon_id,$page_this,$mode,$tdt_timetable,$txt_search_tt_word);//tbl_timetableのtbody child作成

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['tbody']=$html;//tbl_timetableのtbody child
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//予約/カルテ管理：（検索キーワード）検索
	function fnc_btn_search_general_order(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_salon_id=$_POST['js_salon_id'];
		$txt_date='';//日付（空欄）
		$txt_search_order=$_POST['txt_search_order'];//検索キーワード

		$page_this='div_page_manage_order';//div_pageのid
		$mode='MANAGE';//モード=管理
		$html=fc_make_tbody_child_tbl_order($js_salon_id,$page_this,$mode,$txt_date,$txt_search_order);//tbl_manage_orderのtbody child作成

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['tbody']=$html;//tbl_manage_orderのtbody child
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//タイムテーブルのtbodyタグChild生成 
	//tbl_timetableのtbody child作成
	//$a_page_this:div_pageのid
	//$a_mode:モード=TIMETABLE/MANAGE
	//$a_date:yyyy/mm/dd $a_mode=TIMETABLE時に参照 MANAGEは空欄
	function fc_make_tbody_child_tbl_order($a_salon_id,$a_page_this,$a_mode,$a_date,$a_search_order_word){
		$html='';

		//検索語句加工
		$search_order_word=$a_search_order_word;
		$search_order_word=str_replace('　','',$search_order_word);//全角スペース除去
		$search_order_word=str_replace(' ','',$search_order_word);//半角スペース除去

		//SQL文E設定
		$ary_fld=array('order_ai','order_counsel_datetime','order_visit_datetime');//SELECT取得値
		$where='order_user_ai=ANY(SELECT user_ai FROM 31_user_tbl WHERE user_flg_deleted=false AND user_salon_id=:user_salon_id)';
		if($a_date!='')$where.=' AND ((order_counsel_datetime LIKE :order_counsel_datetime) OR (order_visit_datetime LIKE :order_visit_datetime))';
		if($search_order_word!=''){//検索語句 指定あり
			$where.=' AND (order_search_term LIKE :order_search_term)';
		}

		$tale='';

		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_salon_id']=array('val'=>$a_salon_id,'type'=>PDO_INT);
		if($a_date!='')$asc_bind['order_counsel_datetime']=array('val'=>$a_date.'%','type'=>PDO_STR);//カウンセリング日
		if($a_date!='')$asc_bind['order_visit_datetime']=array('val'=>$a_date.'%','type'=>PDO_STR);//来店日
		if($search_order_word!='')$asc_bind['order_search_term']=array('val'=>'%'.$search_order_word.'%','type'=>PDO_STR);//検索語句 指定あり
		$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,$tale,$asc_bind);

		if(count($ary_fetchall)==0){//データなし
				$html.='<tr class="tr_order_ai_none">';
				$html.='<td colspan="10">予約なし</td>';
				$html.='</tr>';
		}else{//データあり
			//各レコード処理（asc[order_ai]=datetime形式 配列を生成）
			$asc_asort=array();
			foreach($ary_fetchall as $asc_rec){
				$order_ai=$asc_rec['order_ai'];
				$order_counsel_datetime=$asc_rec['order_counsel_datetime'];
				$order_visit_datetime=$asc_rec['order_visit_datetime'];
				$datetime='';
				if($a_date==''){//$a_date指定がない場合
					//カウンセリング日or来店日 直近の方を採用
					$datetime=$order_counsel_datetime;
					if(strcmp($order_visit_datetime,$datetime)>0){
						$datetime=$order_visit_datetime;
					}
				}else{//$a_date指定がある場合
					//カウンセリング日or来店日 $a_dateに該当する方を採用
					$datetime=$order_counsel_datetime;
					if(strpos($order_visit_datetime,$a_date)===0){
						$datetime=$order_visit_datetime;
					}
				}
				//
				$asc_asort[$order_ai]=$datetime;
			}
			asort($asc_asort);//値（datetime）でソート

			//各レコード処理
			foreach($asc_asort as $order_ai=>$datetime){
				$html.='<tr class="tr_order_ai_'.$order_ai.'">';
				$html.=fnc_make_tr_child_tbl_order($order_ai,$a_page_this,$a_mode,$a_date);//order_aiに対するtbl_timetable行を生成 ※$a_dateは表示制御用
				$html.='</tr>';
			}
		}
		//
		return $html;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//タイムテーブルのtrタグChild生成 ※$a_dateは表示制御用
	//order_aiに対するtbl_timetable行を生成
	//$a_page_this:div_pageのid
	//$a_mode:モード=TIMETABLE/MANAGE
	//$a_date:yyyy/mm/dd $a_mode=TIMETABLE時に参照 MANAGEは空欄
	function fnc_make_tr_child_tbl_order($a_order_ai,$a_page_this,$a_mode,$a_date){
		$html='';

		//①セル内容 初期化
		$td_order_head='';//TIMETABLE=本日の時刻/施術 MANAGE=新規予約ボタン
		$td_order_ope_menu='';//施術メニュー
		$td_order_stylist='';//担当者（counsel,ope共通）
		$td_order_counsel_datetime='';//カウンセリング日時
		$td_order_counsel_result='';//カウンセリング回答
		$td_order_prepaid='';//事前決済
		$td_order_ope='';//施術
		$td_order_karte='';//カルテ

		//41_order_tbl
		$ary_fld=array('order_user_ai','order_flg_counsel_datetime','order_counsel_datetime','order_counsel_stylist'
			,'order_flg_counsel_result','order_visit_datetime','order_flg_counsel_yet'
			,'order_flg_prepaid','order_prepaid_datetime','order_flg_prepaid_sent','order_flg_prepaid_done'
			,'order_flg_karte','order_karte_datetime','order_flg_user_filled'
			,'order_flg_ope','order_ope_stylist','order_ope_menu','order_prepaid_price');//SELECT取得値
		$where='order_ai=:order_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['order_ai']=array('val'=>$a_order_ai,'type'=>PDO_INT);//指定order_ai
		$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec_order=$ary_fetchall[0];
		foreach($ary_fld as $fld){//$asc_rec_orderを単純変数で参照できるようにする（含む$order_user_ai）
			$$fld=$asc_rec_order[$fld];
		}

		//31_user_tbl
		$ary_fld=array('user_id','user_name','user_yomi','user_hpid');//SELECT取得値
		$where='user_ai=:user_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$order_user_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec_user=$ary_fetchall[0];
		foreach($ary_fld as $fld){//$asc_rec_userを単純変数で参照できるようにする（含む$user_id）
			$$fld=$asc_rec_user[$fld];
		}

		//加工
		$date_today=date('Y/m/d');//今日
		///施術日時（$order_visit_datetime）過去判定
		$flg_past_visit_date=false;
		$order_visit_date='';///施術日（時分はない）
		$ary=explode(' ',$order_visit_datetime);//デリミタ半角空白（年月日 時分）分割
		if(count($ary)==2){
			$order_visit_date=$ary[0];
			if(strcmp($date_today,$order_visit_date)>0){//施術日が今日を過ぎた
				$flg_past_visit_date=true;
			}
		}

		//$td_order_stylist----------------------------------------------
		if(($order_counsel_stylist!='')&&($order_ope_stylist!='')){//両担当者 設定済み
			if($order_counsel_stylist==$order_ope_stylist){//担当者が同じ
				$td_order_stylist=$order_ope_stylist;//施術担当者
			}else{//担当者が異なる
				$td_order_stylist='(カ)'.$order_counsel_stylist;//カウンセリング担当者
				$td_order_stylist.='<br>(施)'.$order_ope_stylist;//施術担当者
			}
		}else if($order_counsel_stylist!=''){
			$td_order_stylist=$order_counsel_stylist;//カウンセリング担当者
		}else if($order_ope_stylist!=''){
			$td_order_stylist=$order_ope_stylist;//施術担当者
		}

		//$td_order_ope_menu---------------------------------------------
		if($order_flg_ope==true){
			$td_order_ope_menu=fnc_conv_tta_show_1row($order_ope_menu);//施術メニュー
		}

		//$td_order_counsel_result---------------------------------------
		if($order_flg_user_filled==true){//ユーザー回答済み時
			$td_order_counsel_result.='<button class="btn_show_order_counsel_result" value="'.$a_order_ai.'">';
			$td_order_counsel_result.='お客様回答済み</button>';
		}else{//ユーザー未回答時
			$td_order_counsel_result.='<button class="btn_show_order_counsel_result" value="'.$a_order_ai.'">';
			$td_order_counsel_result.='お客様未回答</button>';
		}

		//$td_order_prepaid-----------------------------------------------
		$html_btn='＋';//未作成時
		if($order_flg_prepaid==true){
			if($order_flg_prepaid_done==true){
				$html_btn='決済済み<br>'.fnc_conv_price('SHOW',$order_prepaid_price);
				
			}else if($order_flg_prepaid_sent==true){
				$html_btn='請求メール<br>送信済み';
			}
		}
		$td_order_prepaid='<button class="btn_edit_order_prepaid" value="'.$a_order_ai.'">';
		$td_order_prepaid.=$html_btn.'</button>';

		//$td_order_karte------------------------------------------------
		if($order_flg_karte==true){//登録済み時
			$html_btn='作成済み';
			$datetime=$order_karte_datetime;//カルテ登録日
			$ary=explode(' ',$datetime);//年月日と時分に分割
			if(count($ary)==2){
				$html_btn.='<br>'.$ary[0];//年月日
			}
			$td_order_karte='<button class="btn_show_order_karte" value="'.$a_order_ai.'">';
			$td_order_karte.=$html_btn.'</button>';//閲覧ボタン
		}else{//未登録時
			$td_order_karte='<button class="btn_edit_order_karte" value="'.$a_order_ai.'">';
			$td_order_karte.='＋</button>';//新規ボタン
		}

		//③$a_mode別処理
		if($a_mode=='TIMETABLE'){//モード=タイムテーブルなら---------------------------------
			//各datetime項目が本日なら、年月日は除去
			if(strpos($order_counsel_datetime,$a_date)===0){
				$order_counsel_datetime=str_replace($a_date.' ','',$order_counsel_datetime);//カウンセリング日時
			}else{
				$order_counsel_datetime=fnc_conv_datetime('BR',$order_counsel_datetime);
			}
			if(strpos($order_visit_datetime,$a_date)===0){
				$order_visit_datetime=str_replace($a_date.' ','',$order_visit_datetime);//来店日時
			}else{
				$order_visit_datetime=fnc_conv_datetime('BR',$order_visit_datetime);
			}
			if(strpos($order_prepaid_datetime,$a_date)===0){
				$order_prepaid_datetime=str_replace($a_date.' ','',$order_prepaid_datetime);//決済日時
			}else{
				$order_prepaid_datetime=fnc_conv_datetime('BR',$order_prepaid_datetime);
			}

			//$td_order_head----------------------------------------------
			//TIMETABLE=本日の時刻/施術 MANAGE=新規予約ボタン
			if(strlen($order_visit_datetime)==5){//施術が本日なら
				$td_order_head.='施術<br>'.$order_visit_datetime;
			}else if(strlen($order_counsel_datetime)==5){//カウンセリングが本日なら
				$td_order_head.='カウンセリング<br>'.$order_counsel_datetime;
			}else{
				//あり得ない
			}
			
			//$td_order_ope_menu-------------------------------------------
			//設定済み

			//$td_order_stylist--------------------------------------------
			//設定済み

			//$td_order_counsel_datetime-----------------------------------
			if(strlen($order_counsel_datetime)==5){//カウンセリングが本日なら
				//カウンセリング日時 編集ボタン
				$td_order_counsel_datetime.='<button class="btn_edit_order_counsel_datetime" value="'.$a_order_ai.'">';
				$td_order_counsel_datetime.=$order_counsel_datetime.'</button>';

				//カウンセリング スタートボタン
				$td_order_counsel_datetime.='<button class="btn_edit_order_counsel_result" value="'.$a_order_ai.'">';
				$td_order_counsel_datetime.='スタート</button>';

			}else{//カウンセリングが他日なら
				//カウンセリング日時 編集ボタン
				$td_order_counsel_datetime.='<button class="btn_edit_order_counsel_datetime" value="'.$a_order_ai.'">';
				$td_order_counsel_datetime.=$order_counsel_datetime.'</button>';
			}

			//$td_order_counsel_result-------------------------------------
			//設定済み

			//$td_order_prepaid---------------------------------------------
			//設定済み

			//$td_order_ope-------------------------------------------------
			if($order_flg_ope==true){
				$btn_html='';
				if($order_visit_datetime==''){
					$btn_html='日時未定';
				}else{
					$btn_html=$order_visit_datetime;
				}
				$td_order_ope.='<button class="btn_show_order_ope" value="'.$a_order_ai.'">';
				$td_order_ope.=$btn_html.'</button>';
			}else{//未登録時
				$td_order_ope.='<button class="btn_edit_order_ope" value="'.$a_order_ai.'">';
				$td_order_ope.='＋</button>';
			}

			//$td_order_karte-----------------------------------------------
			//設定済み

		}else if($a_mode=='MANAGE'){//モード=管理なら-----------------------------------------
			//$td_order_head----------------------------------------------
			//TIMETABLE=本日の時刻/施術 MANAGE=新規予約ボタン
			$td_order_head.='<button class="btn_add_order" value="'.$order_user_ai.'">新規</button>';

			//$td_order_counsel_datetime-------------------------------------------------
			//カウンセリング日時
			$html_btn='＋';//未登録時
			if($order_flg_counsel_datetime==true){//カウンセリング日時 登録済み時
				$html_btn=fnc_conv_datetime('BR',$order_counsel_datetime);//カウンセリング日時
			}
			$td_order_counsel_datetime=$html_btn;

			//$td_order_ope-------------------------------------------------
			if($order_flg_ope==true){
				$btn_html='';
				if($order_visit_datetime==''){
					$btn_html='日時未定';
				}else{
					$btn_html=fnc_conv_datetime('BR',$order_visit_datetime);//来店日時
				}
				$td_order_ope.='<button class="btn_show_order_ope" value="'.$a_order_ai.'">';
				$td_order_ope.=$btn_html.'</button>';
			}else{//未登録時
				$td_order_ope.='<button class="btn_edit_order_ope" value="'.$a_order_ai.'">';
				$td_order_ope.='＋</button>';
			}
		}

		//行設定--------------------------------------
		//TIMETABLE=本日の時刻/施術 MANAGE=新規予約ボタン
		$html.='<td>';
		$html.=$td_order_head;
		$html.='</td>';

		//ユーザーID/ホットペッパーID
		if($a_mode=='MANAGE'){//モード=管理なら
			$html.='<td>';
			$html.=$user_id;
			if($user_hpid!='')$html.='<br>'.$user_hpid;
			$html.='</td>';
		}

		//フリガナ/名前
		$html.='<td>';
		if($user_yomi!='')$html.=$user_yomi.'<br>';
		$html.=$user_name;
		$html.='</td>';

		//施術メニュー
		$html.='<td>';
		$html.=$td_order_ope_menu;
		$html.='</td>';

		//担当者
		$html.='<td>';
		$html.=$td_order_stylist;
		$html.='</td>';

		//カウンセリング日時
		$html.='<td>';
		$html.=$td_order_counsel_datetime;
		$html.='</td>';

		//カウンセリング回答
		$html.='<td>';
		$html.=$td_order_counsel_result;
		$html.='</td>';

		//事前決済
		$html.='<td>';
		$html.=$td_order_prepaid;
		$html.='</td>';

		//施術
		$html.='<td>';
		$html.=$td_order_ope;
		$html.='</td>';

		//カルテ
		$html.='<td>';
		$html.=$td_order_karte;
		$html.='</td>';
		//
		return $html;
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カウンセリング日時：編集ボタン
	function fnc_btn_edit_order_counsel_datetime(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規

		//41_order_tb情報取得（カウンセリング日時予約 関連）
		$ary_fld=array('order_user_ai','order_counsel_datetime','order_counsel_stylist');//SELECT取得値

		//編集用（新規時は空欄のまま）
		$tdl_order_counsel_datetime='';
		$txt_order_counsel_stylist='';
		if($js_order_ai>0){//編集時
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['order_ai']=array('val'=>$js_order_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec_order=$ary_fetchall[0];//1レコード該当前提
			$order_user_ai=$asc_rec_order['order_user_ai'];
			//
			$tdl_order_counsel_datetime=fnc_conv_datetime('SQL',$asc_rec_order['order_counsel_datetime']);
			$txt_order_counsel_stylist=$asc_rec_order['order_counsel_stylist'];

		}else{//新規時
			$order_user_ai=$js_user_ai;
		}

		//31_user_tbl情報取得（user_id,user_name）
		$ary_fld=array('user_id','user_name');//SELECT取得値
		$where='user_ai=:user_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$order_user_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		$spn_user_id=$asc_rec['user_id'];
		$spn_user_name=$asc_rec['user_name'];

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['order_user_ai']=$order_user_ai;//新規時は0→付与値、編集時は不変
			$asc_ret['spn_user_id']=$spn_user_id;
			$asc_ret['spn_user_name']=$spn_user_name;
			$asc_ret['tdl_order_counsel_datetime']=$tdl_order_counsel_datetime;
			$asc_ret['txt_order_counsel_stylist']=$txt_order_counsel_stylist;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カウンセリング日時予約：登録ボタン
	function fnc_btn_reg_order_counsel_datetime(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		$tdl_order_counsel_datetime=$_POST['tdl_order_counsel_datetime'];//予約日時(-Tフォーマット)
		$txt_order_counsel_stylist=$_POST['txt_order_counsel_stylist'];//担当者
		$id_div_page_back=$_POST['id_div_page_back'];//戻りページdivのid
		$cbx_delete_user=false;//$_POST['cbx_delete_user']=='true' ? 1:0;//削除する（'true'/'false'）→(1/0)

		//★要 入力値チェック

		//新規登録時（$js_order_ai==0 ）はorder_aiが必要なので先行してDB追加（order_user_aiのみ登録）
		if($js_order_ai==0){//新規登録時（対象予約ai=0）
			//①$js_param_order_aiより31_user_tblのuser_idとuser_salon_idを取得
			$user_id='';$user_salon_id='';
			$ary_fld=array('user_id','user_salon_id');//SELECT取得値
			$where='user_ai=:user_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			$user_id=$asc_rec['user_id'];
			$user_salon_id=$asc_rec['user_salon_id'];
			//②asc_set
			$asc_set=array();
			$asc_set['order_user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);//顧客ID
			//③DB予約追加
			$inserted_order_ai=fnc_pdo_insert('41_order_tbl',$asc_set);//$inserted_order_ai=追加されたorder_ai値
			$order_ai=$inserted_order_ai;//追加されたorder_aiで差し替え
		}else{//編集時（$js_order_ai>0）
			$order_ai=$js_order_ai;
		}

		//DB登録
		if($msg_err==''){
			$tdl_order_counsel_datetime=fnc_conv_datetime('TBL',$tdl_order_counsel_datetime);//テーブル格納用 変換
			$date_today=date('Y/m/d');//登録日・更新日
			//
			$asc_set=array();//DB登録用
			//asc_set共通項目セット
			$asc_set['order_counsel_datetime']=array('val'=>$tdl_order_counsel_datetime,'type'=>PDO_STR);//カウンセリング予約日時
			$asc_set['order_counsel_stylist']=array('val'=>$txt_order_counsel_stylist,'type'=>PDO_STR);//担当者
			//
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHERE部
			$asc_bind['order_ai']=array('val'=>$order_ai,'type'=>PDO_INT);
			if($cbx_delete_user){//削除_?時-----------------
				$asc_set['order_flg_counsel_datetime']=array('val'=>false,'type'=>PDO_INT);//「カウンセリング日時予約」が記録されたflg
				$asc_set['order_counsel_datetime']=array('val'=>'','type'=>PDO_STR);//カウンセリング予約日時
				$asc_set['order_counsel_stylist']=array('val'=>'','type'=>PDO_STR);//担当者

			}else{//編集時--------------------------------
				$asc_set['order_flg_counsel_datetime']=array('val'=>true,'type'=>PDO_INT);//「カウンセリング日時予約」が記録されたflg
			}
			fnc_pdo_update('41_order_tbl',$asc_set,$where,$asc_bind);
			fnc_set_order_search_term($order_ai);//41_order_tblのorder_search_termを設定
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['debug']=$debug;
			if($js_order_ai==0){//新規登録時（対象予約ai=0）
				$asc_ret['ope_code']='ADD';//操作コード=ADD

			}else{//編集or削除?時（対象ユーザーai>0）
				if($cbx_delete_user){//削除?時
					$asc_ret['ope_code']='DEL';//操作コード=DEL
				}else{//編集時
					$asc_ret['ope_code']='EDIT';//操作コード=EDIT
				}
			}

			//共通後処理（追加・編集・削除?）
			$asc_ret['order_ai']=$order_ai;//予約ai（追加時は付与されたorder_ai）
			
			//戻りページ対応処理
			if($id_div_page_back=='div_page_timetable'){//タイムテーブル ページ
			}else if($id_div_page_back=='div_page_add_order'){//新規予約 ページ
			 	$asc_ret['tr_child']=fnc_make_tr_child_tbl_add_order($js_user_ai,$order_ai);//user_aiに対するtbl_add_order行を生成
			}

		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カウンセリング回答：閲覧ボタン
	function fnc_set_page_show_order_counsel_result(){
		global $g_asc_sex;
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		if($js_order_ai>0){//念のため
			//41_order_tbl
			list($user_ai,$order_flg_counsel_yet,$html)=fc_make_div_child_show_counsel_result($js_order_ai);//カウンセリング回答 内容(閲覧用）

			//31_user_tbl情報取得
			$ary_fld=array('user_id','user_name','user_yomi','user_hpid','user_birthday'
				,'user_sex','user_email','user_tel');//SELECT取得値
			$where='user_ai=:user_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['user_ai']=array('val'=>$user_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			$spn_user_id=$asc_rec['user_id'];
			$spn_user_name=$asc_rec['user_name'];
			$spn_user_yomi=$asc_rec['user_yomi'];
			$spn_user_hpid=$asc_rec['user_hpid'];
			$spn_user_birthday=$asc_rec['user_birthday'];
			$spn_user_sex=$g_asc_sex[$asc_rec['user_sex']];
			$spn_user_email=$asc_rec['user_email'];
			$spn_user_tel=$asc_rec['user_tel'];
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['spn_user_id']=$spn_user_id;
			$asc_ret['spn_user_name']=$spn_user_name;
			$asc_ret['spn_user_yomi']=$spn_user_yomi;
			$asc_ret['spn_user_hpid']=$spn_user_hpid;
			$asc_ret['spn_user_birthday']=$spn_user_birthday;
			$asc_ret['spn_user_sex']=$spn_user_sex;
			$asc_ret['spn_user_email']=$spn_user_email;
			$asc_ret['spn_user_tel']=$spn_user_tel;
			$asc_ret['div_show_order_counsel_result']=$html;//カウンセリング回答 内容
			$asc_ret['order_flg_counsel_yet']=$order_flg_counsel_yet;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カウンセリング回答(閲覧用）html生成
	function fc_make_div_child_show_counsel_result($a_order_ai){
		global $g_ary_sort_gruop_counsel;
		$rnd=mt_rand(1000,9999);
		$html_order_counsel_result='';

		//41_order_tbl
		$ary_fld=array('order_user_ai','order_flg_counsel_result','order_counsel_datetime'
			,'order_counsel_stylist','order_flg_counsel_yet');
		foreach($g_ary_sort_gruop_counsel as $gruop_code=>$gruop_jpn){
			array_push($ary_fld,'order_'.$gruop_code);
		}
		$where='order_ai=:order_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['order_ai']=array('val'=>$a_order_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec_order=$ary_fetchall[0];//1レコード該当前提
		$order_user_ai=$asc_rec_order['order_user_ai'];
		$order_flg_counsel_yet=$asc_rec_order['order_flg_counsel_yet'];

		//カウンセリング回答UI表示
		foreach($g_ary_sort_gruop_counsel as $gruop_code=>$gruop_jpn){
			$html_order_counsel_result.='<span class="spn_counsel">'.$gruop_jpn.'</span>';
			$html_order_counsel_result.='<br>';
			//
			if((strpos($gruop_code,'rdo_')===0)||(strpos($gruop_code,'cbx_')===0)){//radioタグ or checkboxタグ
				$s_ary_sort='g_ary_sort_'.$gruop_code;
				global $$s_ary_sort;
				$s_asc_term='g_asc_term_'.$gruop_code;
				global $$s_asc_term;
				foreach($$s_ary_sort as $val){//$val=rdo,cbxのoption value値
					$jpn=$$s_asc_term[$val];
					//
					if(strpos($gruop_code,'rdo_')===0){//radioタグ
						if($asc_rec_order['order_'.$gruop_code]==$val){//選択されたrdoなら
							$html_order_counsel_result.=$jpn;
							$html_order_counsel_result.="\n".'<br>';
							break;//rdoは1つ選択されたらループ抜け
						}

					}else if(strpos($gruop_code,'cbx_')===0){//checkboxタグ
						if(strpos($asc_rec_order['order_'.$gruop_code],",$val,")!==false){//,で囲まれた選択コードがあるなら
							$html_order_counsel_result.=$jpn;
							$html_order_counsel_result.="\n".'<br>';
						}
					}
				}
			}else if(strpos($gruop_code,'txt_')===0){//input type=text
				$html_order_counsel_result.=$asc_rec_order['order_'.$gruop_code];
				$html_order_counsel_result.="\n".'<br>';

			}else if(strpos($gruop_code,'tta_')===0){//textarea
				$html_order_counsel_result.=$asc_rec_order['order_'.$gruop_code];
				$html_order_counsel_result.="\n".'<br>';

			}else if(strpos($gruop_code,'tac_')===0){//textarea コンサル用
				$html_order_counsel_result.=$asc_rec_order['order_'.$gruop_code];
				$html_order_counsel_result.="\n".'<br>';

			}else if(strpos($gruop_code,'ptp_')===0){//写真ピッカー
				$photo_dir='photo/order/';
				$num_photo=$asc_rec_order['order_'.$gruop_code];//写真枚数
				if($num_photo>0){
					$html_order_counsel_result.='<div>';
					for($photo_sn=1;$photo_sn<=$num_photo;$photo_sn++){
						$photo_path=$photo_dir.'p'.$a_order_ai.'_'.$gruop_code.'-'.$photo_sn.'.jpg';
						if(file_exists($photo_path)){
							$html_order_counsel_result.='<img src="'.$photo_path.'?'.$rnd.'">';
						}
					}
					$html_order_counsel_result.='</div>';
				}
			}
			$html_order_counsel_result.='<br>';
		}
		//
		return array($order_user_ai,$order_flg_counsel_yet,$html_order_counsel_result);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カウンセリング回答：編集ボタン
	function fnc_btn_edit_order_counsel_result(){
		global $g_asc_sex;
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規

		//編集用UI設定： 既に予約がある($js_order_ai>0)場合は登録値も復元 ※予約新規時は$user_ai=0が返る
		list($user_ai,$order_flg_counsel_yet,$html)=fc_make_div_child_edit_counsel_result($js_order_ai);//カウンセリング回答 内容(編集用）

		//新規予約時は$js_user_aiをuser_aiとして採用
		if($user_ai==0){//新規予約時
			$user_ai=$js_user_ai;
		}

		//31_user_tbl情報取得
		$ary_fld=array('user_id','user_name');//SELECT取得値
		$where='user_ai=:user_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$user_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		$spn_user_id=$asc_rec['user_id'];
		$spn_user_name=$asc_rec['user_name'];

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['spn_user_id']=$spn_user_id;
			$asc_ret['spn_user_name']=$spn_user_name;
			$asc_ret['div_edit_order_counsel_result']=$html;//カウンセリング回答 編集
			$asc_ret['order_flg_counsel_yet']=$order_flg_counsel_yet;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カウンセリング回答(編集用）html生成
	//$a_order_ai>0:編集 $a_order_ai=0:新規
	function fc_make_div_child_edit_counsel_result($a_order_ai){
		global $g_ary_sort_gruop_counsel;
		$rnd=mt_rand(1000,9999);
		$order_user_ai=0;
		$html_order_counsel_result='';

		//41_order_tbl
		$ary_fld=array('order_user_ai','order_flg_counsel_result','order_counsel_datetime'
			,'order_counsel_stylist','order_flg_counsel_yet');
		foreach($g_ary_sort_gruop_counsel as $gruop_code=>$gruop_jpn){
			array_push($ary_fld,'order_'.$gruop_code);
		}

		$order_flg_counsel_yet=false;
		if($a_order_ai>0){//編集時
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['order_ai']=array('val'=>$a_order_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec_order=$ary_fetchall[0];//1レコード該当前提
			$order_user_ai=$asc_rec_order['order_user_ai'];
			$order_flg_counsel_yet=$asc_rec_order['order_flg_counsel_yet'];

		}else{//新規時（空欄の$asc_rec_orderを作成）
			foreach($ary_fld as $fld){
				$asc_rec_order[$fld]='';//空欄
			}
		}

		//カウンセリング回答UI表示
		$flg_cbx_mode_del_photo=false;//cbx写真削除モードを設置したか?=false
		foreach($g_ary_sort_gruop_counsel as $gruop_code=>$gruop_jpn){
			$html_order_counsel_result.='<span class="spn_counsel">'.$gruop_jpn.'</span>';
			$html_order_counsel_result.='<br>';
			//
			if((strpos($gruop_code,'rdo_')===0)||(strpos($gruop_code,'cbx_')===0)){//radioタグ or checkboxタグ
				$s_ary_sort='g_ary_sort_'.$gruop_code;
				global $$s_ary_sort;
				$s_asc_term='g_asc_term_'.$gruop_code;
				global $$s_asc_term;
				foreach($$s_ary_sort as $val){
					$term=$$s_asc_term[$val];
					//
					if(strpos($gruop_code,'rdo_')===0){//radioタグ
						$checked='';if($asc_rec_order['order_'.$gruop_code]==$val)$checked=' CHECKED';//選択されたrdoなら
						$html_order_counsel_result.='<label>';//labelタグ
						$html_order_counsel_result.='<input type="radio" class="post_ui '.$gruop_code.'" name="rdo_'.$gruop_code.'" value="'.$val.'"'.$checked.'>';
						$html_order_counsel_result.=$term;
						$html_order_counsel_result.='</label>';
						$html_order_counsel_result.="\n".'<br>';

					}else if(strpos($gruop_code,'cbx_')===0){//checkboxタグ
						$checked='';if(strpos($asc_rec_order['order_'.$gruop_code],",$val,")!==false)$checked=' CHECKED';//選択されたcbxなら（,で囲まれた選択コードがあるなら）
						$html_order_counsel_result.='<label>';//labelタグ
						$html_order_counsel_result.='<input type="checkbox" class="post_ui '.$gruop_code.'" value="'.$val.'"'.$checked.'>';
						$html_order_counsel_result.=$term;
						$html_order_counsel_result.='</label>';
						$html_order_counsel_result.="\n".'<br>';
					}
				}
			}else if(strpos($gruop_code,'txt_')===0){//input type=text
				$html_order_counsel_result.='<input type="text" class="post_ui '.$gruop_code.'" value="'.$asc_rec_order['order_'.$gruop_code].'">';

			}else if(strpos($gruop_code,'tta_')===0){//textarea
				$html_order_counsel_result.='<textarea class="post_ui '.$gruop_code.'">'.$asc_rec_order['order_'.$gruop_code].'</textarea>';

			}else if(strpos($gruop_code,'tac_')===0){//textarea コンサル用
				$html_order_counsel_result.='<textarea class="post_ui '.$gruop_code.'">'.$asc_rec_order['order_'.$gruop_code].'</textarea>';

			}else if(strpos($gruop_code,'ptp_')===0){//写真ピッカー
				$photo_dir='photo/order/';
				$num_photo=$asc_rec_order['order_'.$gruop_code];//写真枚数

				//cbx写真削除モード 設置
				if($flg_cbx_mode_del_photo==false){
					$html_order_counsel_result.='<label><input type="checkbox" class="cbx_mode_del_photo">写真削除モード</label>';
					$flg_cbx_mode_del_photo=true;
				}

				$html_order_counsel_result.='<div class="div_photo_picker" id="'.$gruop_code.'">';//divタグ
				if($num_photo==0){
					$html_order_counsel_result.='<span>クリックして写真選択</span>';
				}else{
					for($photo_sn=1;$photo_sn<=$num_photo;$photo_sn++){
						$photo_path=$photo_dir.'p'.$a_order_ai.'_'.$gruop_code.'-'.$photo_sn.'.jpg';
						if(file_exists($photo_path)){
							$html_order_counsel_result.='<img class="img_ptp" src="'.$photo_path.'?'.$rnd.'">';
						}
					}
				}
				//
				$html_order_counsel_result.='</div>';
			}
			$html_order_counsel_result.='<br>';
		}
		//
		return array($order_user_ai,$order_flg_counsel_yet,$html_order_counsel_result);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カウンセリング回答：登録ボタン
	function fnc_btn_reg_order_counsel_result(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値①
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		$order_flg_counsel_yet=$_POST['order_flg_counsel_yet'];//一時保存状態
		$id_div_page_back=$_POST['id_div_page_back'];//戻りページdivのid
		$cbx_delete_user=false;//$_POST['cbx_delete_user']=='true' ? 1:0;//削除する（'true'/'false'）→(1/0)

		//POST値②（g_ary_sort_gruop_counsel関連）
		$asc_counsel=array();//カウンセリング回答（asc_setに引き継ぐ）
		$asc_counsel_photo=array();//カウンセリング写真（特別な処理）
		foreach($_POST as $fld=>$val){//$_POSTループ
			if(strpos($fld,'rdo_')===0){//radio（単一回答）時 
				$fld='order_'.$fld;
				$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_INT);
			}else if(strpos($fld,'cbx_')===0){//checkbox（複数回答）時 
				$fld='order_'.$fld;
				$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_STR);
			}else if(strpos($fld,'txt_')===0){//input type=text
				$fld='order_'.$fld;
				$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_STR);
			}else if(strpos($fld,'tta_')===0){//textarea
				$fld='order_'.$fld;
				$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_STR);
			}else if(strpos($fld,'tac_')===0){//textarea コンサル用
				$fld='order_'.$fld;
				$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_STR);
			}else if(strpos($fld,'ptp_')===0){//$fld=(ptp_グループ名-写真SN)
				$ary=explode('-',$fld);//「ptp_グループコード」と「写真SN」に分割
				if(count($ary)==2){
					$asc_counsel_photo[$ary[0]][$ary[1]]=$val;//[ptp_グループコード][写真SN]=BASE64 形式
				}
			}
		}

		//写真処理 $asc_counsel['order_ptp_XXXX']=枚数
		if($msg_err==''){
			foreach($asc_counsel_photo as $gruop_code=>$asc){
				$asc_counsel['order_'.$gruop_code]=array('val'=>count($asc),'type'=>PDO_INT);
				foreach($asc as $photo_sn=>$photo_base64){
					$photo_dir='photo/order/';
					fnc_make_dir($photo_dir);//ディレクトリが無ければ作成する
					$photo_path=$photo_dir.'p'.$js_order_ai.'_'.$gruop_code.'-'.$photo_sn.'.jpg';
					if(strpos($photo_base64,'data:')===0){
						$ary_photo_data=explode(',',$photo_base64);//「data:」で始まっているなら ※始まってないなら変更なしなので保存不要
						$photo_base64=$ary_photo_data[1];//「,」以降を取り出す
						file_put_contents($photo_path,base64_decode($photo_base64));
					}
				}
			}
		}

		//★要 入力値チェック

		//新規登録時（$js_order_ai==0 ）はorder_aiが必要なので先行してDB追加（order_user_aiのみ登録）
		if($js_order_ai==0){//新規登録時（対象予約ai=0）
			//①$js_param_order_aiより31_user_tblのuser_idとuser_salon_idを取得
			$user_id='';$user_salon_id='';
			$ary_fld=array('user_id','user_salon_id');//SELECT取得値
			$where='user_ai=:user_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			$user_id=$asc_rec['user_id'];
			$user_salon_id=$asc_rec['user_salon_id'];
			//②asc_set
			$asc_set=array();
			$asc_set['order_user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);//顧客ID
			//③DB予約追加
			$inserted_order_ai=fnc_pdo_insert('41_order_tbl',$asc_set);//$inserted_order_ai=追加されたorder_ai値
			$order_ai=$inserted_order_ai;//追加されたorder_aiで差し替え
		}else{//編集時（$js_order_ai>0）
			$order_ai=$js_order_ai;
		}

		//DB登録
		if($msg_err==''){
			$date_today=date('Y/m/d');//登録日・更新日
			//
			$asc_set=$asc_counsel;//DB登録用
			$asc_set['order_flg_counsel_yet']=array('val'=>$order_flg_counsel_yet,'type'=>PDO_INT);//一時保存状態
			//
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHERE部
			$asc_bind['order_ai']=array('val'=>$order_ai,'type'=>PDO_INT);
			if($cbx_delete_user){//削除_?時-----------------
				$asc_set['order_flg_counsel_result']=array('val'=>false,'type'=>PDO_INT);//「カウンセリング回答」が記録されたflg

			}else{//編集時--------------------------------
				$asc_set['order_flg_counsel_result']=array('val'=>true,'type'=>PDO_INT);//「カウンセリング回答」が記録されたflg
			}
			fnc_pdo_update('41_order_tbl',$asc_set,$where,$asc_bind);
			fnc_set_order_search_term($order_ai);//41_order_tblのorder_search_termを設定
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['debug']=$debug;
			if($js_order_ai==0){//新規登録時（対象予約ai=0）
				$asc_ret['ope_code']='ADD';//操作コード=ADD

			}else{//編集or削除?時（対象ユーザーai>0）
				$order_ai=$js_order_ai;//共通後処理用
				if($cbx_delete_user){//削除?時
					$asc_ret['ope_code']='DEL';//操作コード=DEL
				}else{//編集時
					$asc_ret['ope_code']='EDIT';//操作コード=EDIT
				}
			}
			//共通後処理（追加・編集・削除?）
			$asc_ret['order_ai']=$order_ai;//予約ai（追加時は付与されたorder_ai）

			//戻りページ対応処理
			if($id_div_page_back=='div_page_timetable'){//タイムテーブル ページ

			}else if($id_div_page_back=='div_page_add_order'){//新規予約 ページ
			 	$asc_ret['tr_child']=fnc_make_tr_child_tbl_add_order($js_user_ai,$order_ai);//user_aiに対するtbl_add_order行を生成

			}else if($id_div_page_back=='div_page_show_counsel_result'){//カウンセリング回答 閲覧ページ
			 	//NOP:BACK機能によりカウンセリング回答(閲覧用）表示
			}

		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//事前決済：編集ボタン
	function fnc_btn_edit_order_prepaid(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		//41_order_tb情報取得（事前決済 関連）
		$ary_fld=array('order_user_ai','order_ope_menu','order_prepaid_price','order_flg_prepaid_sent'
			,'order_flg_prepaid_done');//SELECT取得値

		//編集用（新規時は空欄のまま）
		$tta_order_ope_menu='';
		$txt_order_prepaid_price='';
		$cbx_order_flg_prepaid_sent=false;
		$cbx_order_flg_prepaid_done=false;
		if($js_order_ai>0){//編集時
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['order_ai']=array('val'=>$js_order_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec_order=$ary_fetchall[0];//1レコード該当前提
			$order_user_ai=$asc_rec_order['order_user_ai'];
			//
			$tta_order_ope_menu=$asc_rec_order['order_ope_menu'];
			$txt_order_prepaid_price=fnc_conv_price('TBL',$asc_rec_order['order_prepaid_price']);
			$cbx_order_flg_prepaid_sent=$asc_rec_order['order_flg_prepaid_sent'];
			$cbx_order_flg_prepaid_done=$asc_rec_order['order_flg_prepaid_done'];
		}else{//新規時
			$order_user_ai=$js_user_ai;
		}

		//31_user_tbl情報取得（user_id,user_name）
		$ary_fld=array('user_id','user_name');//SELECT取得値
		$where='user_ai=:user_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$order_user_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		$spn_user_id=$asc_rec['user_id'];
		$spn_user_name=$asc_rec['user_name'];

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['spn_user_id']=$spn_user_id;
			$asc_ret['spn_user_name']=$spn_user_name;
			$asc_ret['tta_order_ope_menu']=$tta_order_ope_menu;
			$asc_ret['txt_order_prepaid_price']=$txt_order_prepaid_price;
			$asc_ret['cbx_order_flg_prepaid_sent']=$cbx_order_flg_prepaid_sent;
			$asc_ret['cbx_order_flg_prepaid_done']=$cbx_order_flg_prepaid_done;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//事前決済：登録ボタン
	function fnc_btn_reg_order_prepaid(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		$tta_order_ope_menu=$_POST['tta_order_ope_menu'];
		$txt_order_prepaid_price=$_POST['txt_order_prepaid_price'];
		$cbx_order_flg_prepaid_sent=$_POST['cbx_order_flg_prepaid_sent'];
		$cbx_order_flg_prepaid_done=$_POST['cbx_order_flg_prepaid_done'];
		$id_div_page_back=$_POST['id_div_page_back'];//戻りページdivのid
		$cbx_delete_user=false;//$_POST['cbx_delete_user']=='true' ? 1:0;//削除する（'true'/'false'）→(1/0)

		//★要 入力値チェック

		//新規登録時（$js_order_ai==0 ）はorder_aiが必要なので先行してDB追加（order_user_aiのみ登録）
		if($js_order_ai==0){//新規登録時（対象予約ai=0）
			//①$js_param_order_aiより31_user_tblのuser_idとuser_salon_idを取得
			$user_id='';$user_salon_id='';
			$ary_fld=array('user_id','user_salon_id');//SELECT取得値
			$where='user_ai=:user_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			$user_id=$asc_rec['user_id'];
			$user_salon_id=$asc_rec['user_salon_id'];
			//②asc_set
			$asc_set=array();
			$asc_set['order_user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);//顧客ID
			//③DB予約追加
			$inserted_order_ai=fnc_pdo_insert('41_order_tbl',$asc_set);//$inserted_order_ai=追加されたorder_ai値
			$order_ai=$inserted_order_ai;//追加されたorder_aiで差し替え
		}else{//編集時（$js_order_ai>0）
			$order_ai=$js_order_ai;
		}

		//DB登録
		if($msg_err==''){
			$date_today=date('Y/m/d');//登録日・更新日
			$datetime_now=date('Y/m/d H:i');//登録日時・更新日時
			//
			$asc_set=array();//DB登録用
			//asc_set共通項目セット
			$asc_set['order_ope_menu']=array('val'=>$tta_order_ope_menu,'type'=>PDO_STR);
			$asc_set['order_prepaid_price']=array('val'=>$txt_order_prepaid_price,'type'=>PDO_INT);
			$asc_set['order_flg_prepaid_sent']=array('val'=>$cbx_order_flg_prepaid_sent,'type'=>PDO_INT);
			$asc_set['order_flg_prepaid_done']=array('val'=>$cbx_order_flg_prepaid_done,'type'=>PDO_INT);
			//
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHERE部
			$asc_bind['order_ai']=array('val'=>$order_ai,'type'=>PDO_INT);
			if($cbx_delete_user){//削除_?時-----------------
				$asc_set['order_flg_prepaid']=array('val'=>false,'type'=>PDO_INT);//「事前決済」が記録されたflg
				$asc_set['order_flg_prepaid_sent']=array('val'=>0,'type'=>PDO_INT);
				$asc_set['order_flg_prepaid_done']=array('val'=>0,'type'=>PDO_INT);

			}else{//編集時--------------------------------
				$asc_set['order_flg_prepaid']=array('val'=>true,'type'=>PDO_INT);//「カウンセリング日時予約」が記録されたflg
			}
			fnc_pdo_update('41_order_tbl',$asc_set,$where,$asc_bind);
			fnc_set_order_search_term($order_ai);//41_order_tblのorder_search_termを設定
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['debug']=$debug;
			if($js_order_ai==0){//新規登録時（対象予約ai=0）
				$asc_ret['ope_code']='ADD';//操作コード=ADD

			}else{//編集or削除?時（対象ユーザーai>0）
				$order_ai=$js_order_ai;//共通後処理用
				if($cbx_delete_user){//削除?時
					$asc_ret['ope_code']='DEL';//操作コード=DEL
				}else{//編集時
					$asc_ret['ope_code']='EDIT';//操作コード=EDIT
				}
			}

			//共通後処理（追加・編集・削除?）
			$asc_ret['order_ai']=$order_ai;//予約ai（追加時は付与されたorder_ai）
			
			//戻りページ対応処理
			if($id_div_page_back=='div_page_timetable'){//タイムテーブル ページ
			}else if($id_div_page_back=='div_page_add_order'){//新規予約 ページ
			 	$asc_ret['tr_child']=fnc_make_tr_child_tbl_add_order($js_user_ai,$order_ai);//user_aiに対するtbl_add_order行を生成
			}

		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//施術：閲覧ページ設定
	function fnc_set_page_show_order_ope(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//js_order_ai=0は新規
		if($js_order_ai>0){//念のため
			//41_order_tbl
			$ary_fld=array('order_user_ai','order_ope_stylist','order_visit_datetime','order_ope_menu'
				,'order_ope_price');//SELECT取得値
			$where='order_ai=:order_ai AND order_flg_ope=true';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['order_ai']=array('val'=>$js_order_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			//
			$order_user_ai=$asc_rec['order_user_ai'];
			$spn_order_ope_stylist=$asc_rec['order_ope_stylist'];
			$spn_order_visit_datetime=$asc_rec['order_visit_datetime'];
			$spn_order_ope_menu=$asc_rec['order_ope_menu'];
			$spn_order_ope_price=$asc_rec['order_ope_price'];

			//31_user_tbl情報取得
			$ary_fld=array('user_id','user_name');//SELECT取得値
			$where='user_ai=:user_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['user_ai']=array('val'=>$order_user_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			$spn_user_id=$asc_rec['user_id'];
			$spn_user_name=$asc_rec['user_name'];
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['spn_user_id']=$spn_user_id;
			$asc_ret['spn_user_name']=$spn_user_name;
			$asc_ret['spn_order_ope_stylist']=$spn_order_ope_stylist;
			$asc_ret['spn_order_visit_datetime']=$spn_order_visit_datetime;
			$asc_ret['spn_order_ope_menu']=$spn_order_ope_menu;
			$asc_ret['spn_order_ope_price']=$spn_order_ope_price;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//施術：編集ボタン
	function fnc_btn_edit_order_ope(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		//41_order_tb情報取得（施術 関連）
		$ary_fld=array('order_user_ai','order_counsel_stylist','order_ope_stylist','order_visit_datetime'
			,'order_ope_menu','order_ope_price');//SELECT取得値
		//編集用（新規時は空欄のまま）
		$txt_order_ope_stylist='';
		$txt_order_counsel_stylist='';
		$tdl_order_visit_datetime='';
		$tta_order_ope_menu='';
		$txt_order_ope_price='';
		if($js_order_ai>0){//編集時
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['order_ai']=array('val'=>$js_order_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec_order=$ary_fetchall[0];//1レコード該当前提
			$order_user_ai=$asc_rec_order['order_user_ai'];
			//
			$tdl_order_visit_datetime=fnc_conv_datetime('SQL',$asc_rec_order['order_visit_datetime']);
			$txt_order_counsel_stylist=$asc_rec_order['order_counsel_stylist'];
			$txt_order_ope_stylist=$asc_rec_order['order_ope_stylist'];
			$tta_order_ope_menu=$asc_rec_order['order_ope_menu'];
			$txt_order_ope_price=fnc_conv_price('TBL',$asc_rec_order['order_ope_price']);
		}else{//新規時
			$order_user_ai=$js_user_ai;
		}

		//31_user_tbl情報取得（user_id,user_name）
		$ary_fld=array('user_id','user_name');//SELECT取得値
		$where='user_ai=:user_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$order_user_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		$spn_user_id=$asc_rec['user_id'];
		$spn_user_name=$asc_rec['user_name'];
		
		//加工
		if($txt_order_ope_stylist==''){//施術担当者が空欄ならばカウンセリング担当者が初期値
			$txt_order_ope_stylist=$txt_order_counsel_stylist;
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['spn_user_id']=$spn_user_id;
			$asc_ret['spn_user_name']=$spn_user_name;
			$asc_ret['txt_order_ope_stylist']=$txt_order_ope_stylist;
			$asc_ret['tdl_order_visit_datetime']=$tdl_order_visit_datetime;
			$asc_ret['tta_order_ope_menu']=$tta_order_ope_menu;
			$asc_ret['txt_order_ope_price']=$txt_order_ope_price;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//施術：登録ボタン
	function fnc_btn_reg_order_ope(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		$txt_order_ope_stylist=$_POST['txt_order_ope_stylist'];//施術担当者
		$tdl_order_visit_datetime=$_POST['tdl_order_visit_datetime'];//予約日時(-Tフォーマット)
		$tta_order_ope_menu=$_POST['tta_order_ope_menu'];//施術メニュー
		$txt_order_ope_price=$_POST['txt_order_ope_price'];//施術金額
		$id_div_page_back=$_POST['id_div_page_back'];//戻りページdivのid
		$cbx_delete_user=false;//$_POST['cbx_delete_user']=='true' ? 1:0;//削除する（'true'/'false'）→(1/0)

		//★要 入力値チェック

		//新規登録時（$js_order_ai==0 ）はorder_aiが必要なので先行してDB追加（order_user_aiのみ登録）
		if($js_order_ai==0){//新規登録時（対象予約ai=0）
			//①$js_param_order_aiより31_user_tblのuser_idとuser_salon_idを取得
			$user_id='';$user_salon_id='';
			$ary_fld=array('user_id','user_salon_id');//SELECT取得値
			$where='user_ai=:user_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			$user_id=$asc_rec['user_id'];
			$user_salon_id=$asc_rec['user_salon_id'];
			//②asc_set補充
			$asc_set=array();
			$asc_set['order_user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);//顧客ID
			//③DB予約追加
			$inserted_order_ai=fnc_pdo_insert('41_order_tbl',$asc_set);//$inserted_order_ai=追加されたorder_ai値
			$order_ai=$inserted_order_ai;//追加されたorder_aiで差し替え
		}else{//編集時（$js_order_ai>0）
			$order_ai=$js_order_ai;
		}

		//DB登録
		if($msg_err==''){
			$tdl_order_visit_datetime=fnc_conv_datetime('TBL',$tdl_order_visit_datetime);//テーブル格納用 変換
			$date_today=date('Y/m/d');//登録日・更新日
			//
			$asc_set=array();//DB登録用
			//asc_set共通項目セット
			$asc_set['order_ope_stylist']=array('val'=>$txt_order_ope_stylist,'type'=>PDO_STR);//施術担当者
			$asc_set['order_visit_datetime']=array('val'=>$tdl_order_visit_datetime,'type'=>PDO_STR);//来店日時
			$asc_set['order_ope_menu']=array('val'=>$tta_order_ope_menu,'type'=>PDO_STR);//施術メニュー
			$asc_set['order_ope_price']=array('val'=>$txt_order_ope_price,'type'=>PDO_INT);//施術金額
			//
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHERE部
			$asc_bind['order_ai']=array('val'=>$order_ai,'type'=>PDO_INT);
			if($cbx_delete_user){//削除_?時-----------------
				$asc_set['order_flg_ope']=array('val'=>false,'type'=>PDO_INT);//「カウンセリング日時予約」が記録されたflg
				$asc_set['order_ope_stylist']=array('val'=>'','type'=>PDO_STR);//施術担当者
				$asc_set['order_visit_datetime']=array('val'=>'','type'=>PDO_STR);//カウンセリング予約日時
				$asc_set['order_ope_menu']=array('val'=>'','type'=>PDO_STR);//施術メニュー
				$asc_set['order_ope_price']=array('val'=>0,'type'=>PDO_INT);//施術金額

			}else{//編集時--------------------------------
				$asc_set['order_flg_ope']=array('val'=>true,'type'=>PDO_INT);//「施術」が記録されたflg
			}
			fnc_pdo_update('41_order_tbl',$asc_set,$where,$asc_bind);
			fnc_set_order_search_term($order_ai);//41_order_tblのorder_search_termを設定
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['debug']=$debug;
			if($js_order_ai==0){//新規登録時（対象予約ai=0）
				$asc_ret['ope_code']='ADD';//操作コード=ADD

			}else{//編集or削除?時（対象ユーザーai>0）
				$order_ai=$js_order_ai;//共通後処理用
				if($cbx_delete_user){//削除?時
					$asc_ret['ope_code']='DEL';//操作コード=DEL
				}else{//編集時
					$asc_ret['ope_code']='EDIT';//操作コード=EDIT
				}
			}

			//共通後処理（追加・編集・削除?）
			$asc_ret['order_ai']=$order_ai;//予約ai
			
			//戻りページ対応処理
			if($id_div_page_back=='div_page_timetable'){//タイムテーブル ページ
			}else if($id_div_page_back=='div_page_add_order'){//新規予約 ページ
			 	$asc_ret['tr_child']=fnc_make_tr_child_tbl_add_order($js_user_ai,$order_ai);//user_aiに対するtbl_add_order行を生成
			}

		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カルテ：閲覧ボタン☆
	function fnc_set_page_show_order_karte(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		$spn_order_visit_datetime='';
		$spn_order_ope_stylist='';
		$spn_order_ope_menu='';
		$spn_order_ope_price='';
		$spn_order_flg_karte='';
		$spn_order_karte_datetime='';
		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		if($js_order_ai>0){//念のため
			//41_order_tbl
			list($user_ai,$asc_rec_order,$html)=fc_make_div_child_show_karte($js_order_ai);//カルテ内容(閲覧用）
			$spn_order_visit_datetime=$asc_rec_order['order_visit_datetime'];
			$spn_order_ope_stylist=$asc_rec_order['order_ope_stylist'];
			$spn_order_ope_menu=$asc_rec_order['order_ope_menu'];
			$spn_order_ope_price=fnc_conv_price('SHOW',$asc_rec_order['order_ope_price']);
			$spn_order_flg_karte=$asc_rec_order['order_flg_karte'];
			$spn_order_karte_datetime=$asc_rec_order['order_karte_datetime'];

			//31_user_tbl情報取得
			$ary_fld=array('user_id','user_name');//SELECT取得値
			$where='user_ai=:user_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['user_ai']=array('val'=>$user_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			$spn_user_id=$asc_rec['user_id'];
			$spn_user_name=$asc_rec['user_name'];
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['spn_user_id']=$spn_user_id;
			$asc_ret['spn_user_name']=$spn_user_name;
			$asc_ret['spn_order_visit_datetime']=$spn_order_visit_datetime;
			$asc_ret['spn_order_ope_stylist']=$spn_order_ope_stylist;
			$asc_ret['spn_order_ope_menu']=$spn_order_ope_menu;
			$asc_ret['spn_order_ope_price']=$spn_order_ope_price;
			$asc_ret['spn_order_visit_datetime']=$spn_order_visit_datetime;
			$asc_ret['div_show_order_karte']=$html;//カルテ 内容
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カルテ：編集ボタン
	function fnc_btn_edit_order_karte(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規

		//41_order_tb情報取得（カルテ関連 $g_ary_sort_gruop_karte以外）
		$ary_fld=array('order_user_ai','order_visit_datetime','order_ope_menu','order_counsel_stylist','order_ope_stylist','order_ope_price');//SELECT取得値

		//編集用（新規時は空欄のまま）
		$tdl_order_visit_datetime='';
		$tta_order_ope_menu='';
		$txt_order_ope_stylist='';
		$txt_order_ope_price='';
		if($js_order_ai>0){//編集時
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['order_ai']=array('val'=>$js_order_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec_order=$ary_fetchall[0];//1レコード該当前提
			$order_user_ai=$asc_rec_order['order_user_ai'];
			//
			$tdl_order_visit_datetime=fnc_conv_datetime('SQL',$asc_rec_order['order_visit_datetime']);
			$tta_order_ope_menu=$asc_rec_order['order_ope_menu'];
			$order_counsel_stylist=$asc_rec_order['order_counsel_stylist'];
			$txt_order_ope_stylist=$asc_rec_order['order_ope_stylist'];
			$txt_order_ope_price=$asc_rec_order['order_ope_price'];
			
			//加工
			if($txt_order_ope_stylist=='')$txt_order_ope_stylist=$order_counsel_stylist;//施術担当者 空欄時はカウンセリング担当者がデフォルト

			//編集用UI設定： 既に予約がある($js_order_ai>0)場合は登録値も復元 ※予約新規時は$user_ai=0が返る
			list($user_ai,$html)=fc_make_div_child_edit_karte($js_order_ai);//カルテ内容(編集用）

		}else{//新規予約時は$js_user_aiをuser_aiとして採用
			$user_ai=$js_user_ai;
		}

		//31_user_tbl情報取得（user_id,user_name）
		$ary_fld=array('user_id','user_name');//SELECT取得値
		$where='user_ai=:user_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$user_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		$spn_user_id=$asc_rec['user_id'];
		$spn_user_name=$asc_rec['user_name'];

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['order_user_ai']=$user_ai;//新規時は0→付与値、編集時は不変
			$asc_ret['spn_user_id']=$spn_user_id;
			$asc_ret['spn_user_name']=$spn_user_name;
			$asc_ret['tdl_order_visit_datetime']=$tdl_order_visit_datetime;
			$asc_ret['tta_order_ope_menu']=$tta_order_ope_menu;
			$asc_ret['txt_order_ope_stylist']=$txt_order_ope_stylist;
			$asc_ret['txt_order_ope_price']=$txt_order_ope_price;
			$asc_ret['div_edit_order_karte']=$html;//カルテ内容 編集
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カルテ(閲覧用）html生成
	function fc_make_div_child_show_karte($a_order_ai){
		global $g_ary_sort_gruop_karte,$g_asc_side_gruop_karte;
		$rnd=mt_rand(1000,9999);
		$html_order_karte='';

		//41_order_tbl
		$ary_fld=array('order_user_ai','order_visit_datetime','order_ope_stylist','order_ope_menu','order_ope_price'
			,'order_flg_karte','order_karte_datetime');//SELECT取得値
		foreach($g_ary_sort_gruop_karte as $gruop_code=>$gruop_jpn){
			array_push($ary_fld,'order_karte_'.$gruop_code);
		}
		$where='order_ai=:order_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['order_ai']=array('val'=>$a_order_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec_order=$ary_fetchall[0];//1レコード該当前提
		$order_user_ai=$asc_rec_order['order_user_ai'];
		//カルテUI表示
		foreach($g_ary_sort_gruop_karte as $gruop_code=>$gruop_jpn){
			$html_order_karte.='<span class="spn_karte">'.$gruop_jpn.'</span>';
			$html_order_karte.='<br>';
			//
			if((strpos($gruop_code,'rdo_')===0)||(strpos($gruop_code,'cbx_')===0)){//radioタグ or checkboxタグ
				if(strpos($gruop_code,'rdo_')===0){//radioタグ
					$html_order_karte.='<div style="display:inline-block;width:4em;text-align:right;">';
					$html_order_karte.=$g_asc_side_gruop_karte[$gruop_code]['front'];
					$html_order_karte.='</div>';
				}
				$s_ary_sort='g_ary_sort_'.$gruop_code;
				global $$s_ary_sort;
				$s_asc_term='g_asc_term_'.$gruop_code;
				global $$s_asc_term;
				foreach($$s_ary_sort as $val){//$val=rdo,cbxのoption value値
					$jpn=$$s_asc_term[$val];
					//
					if(strpos($gruop_code,'rdo_')===0){//radioタグ
						$border='';
						if($asc_rec_order['order_karte_'.$gruop_code]==$val){//選択されたrdoなら
							$border='border:5px solid silver;';
						}
						$html_order_karte.='<div style="display:inline-block;'.$border.'">';
						$html_order_karte.=$jpn;
						$html_order_karte.="\n".'<br>';
						$html_order_karte.='</div>';

					}else if(strpos($gruop_code,'cbx_')===0){//checkboxタグ
						if(strpos($asc_rec_order['order_karte_'.$gruop_code],",$val,")!==false){//,で囲まれた選択コードがあるなら
							$html_order_karte.=$jpn;
							$html_order_karte.="\n".'<br>';
						}
					}
				}
				if(strpos($gruop_code,'rdo_')===0){//radioタグ
					$html_order_karte.=$g_asc_side_gruop_karte[$gruop_code]['back'];
				}
			}else if(strpos($gruop_code,'txt_')===0){//input type=text
				$html_order_karte.=$asc_rec_order['order_karte_'.$gruop_code];
				$html_order_karte.="\n".'<br>';

			}else if(strpos($gruop_code,'tta_')===0){//textarea
				$html_order_karte.=$asc_rec_order['order_karte_'.$gruop_code];
				$html_order_karte.="\n".'<br>';

			}else if(strpos($gruop_code,'dtf_')===0){//日付範囲（自）
				$html_order_karte.=$asc_rec_order['order_karte_'.$gruop_code];
				$html_order_karte.="\n".'<br>';

			}else if(strpos($gruop_code,'dtt_')===0){//日付範囲（至）
				$html_order_karte.=$asc_rec_order['order_karte_'.$gruop_code];
				$html_order_karte.="\n".'<br>';

			}else if(strpos($gruop_code,'ptp_')===0){//写真ピッカー
				$photo_dir='photo/order/';
				$num_photo=$asc_rec_order['order_karte_'.$gruop_code];//写真枚数
				if($num_photo>0){
					$html_order_karte.='<div>';
					for($photo_sn=1;$photo_sn<=$num_photo;$photo_sn++){
						$photo_path=$photo_dir.'p'.$a_order_ai.'_'.$gruop_code.'-'.$photo_sn.'.jpg';
						if(file_exists($photo_path)){
							$html_order_karte.='<img src="'.$photo_path.'?'.$rnd.'">';
						}
					}
					$html_order_karte.='</div>';
				}
			}
			$html_order_karte.='<br>';
		}
		//
		return array($order_user_ai,$asc_rec_order,$html_order_karte);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カルテ：登録ボタン
	function fnc_btn_reg_order_karte(){
		global $g_ary_sort_gruop_karte;
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値①
		$js_user_ai=$_POST['js_user_ai'];//js_order_ai>0時はjs_user_ai=-1
		$js_order_ai=$_POST['js_order_ai'];//a_order_ai=0は新規
		$id_div_page_back=$_POST['id_div_page_back'];//戻りページdivのid
		$cbx_delete_user=false;//$_POST['cbx_delete_user']=='true' ? 1:0;//削除する（'true'/'false'）→(1/0)

		//POST値②
		$asc_input=array();//カルテ（asc_setに引き継ぐ）
		$asc_input['order_visit_datetime']=array('val'=>fnc_conv_datetime('TBL',$_POST['tdl_order_visit_datetime']),'type'=>PDO_STR);//来店日時
		$asc_input['order_ope_menu']=array('val'=>$_POST['tta_order_ope_menu'],'type'=>PDO_STR);//メニュー内容
		$asc_input['order_ope_stylist']=array('val'=>$_POST['txt_order_ope_stylist'],'type'=>PDO_STR);//施術担当者
		$asc_input['order_ope_price']=array('val'=>fnc_conv_price('TBL',$_POST['txt_order_ope_price']),'type'=>PDO_INT);//施術金額

		//POST値③（g_ary_sort_gruop_karte関連）
		$asc_counsel=array();//カルテ（asc_setに引き継ぐ）
		$asc_counsel_photo=array();//カウンセリング写真（特別な処理）
		foreach($_POST as $fld=>$val){//$_POSTループ
			if(array_key_exists($fld,$g_ary_sort_gruop_karte)){//g_ary_sort_gruop_karteのフィールドなら
				if(strpos($fld,'rdo_')===0){//radio（単一回答）時 
					$fld='order_karte_'.$fld;
					$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_INT);
				}else if(strpos($fld,'cbx_')===0){//checkbox（複数回答）時 
					$fld='order_karte_'.$fld;
					$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_STR);
				}else if(strpos($fld,'txt_')===0){//input type=text
					$fld='order_karte_'.$fld;
					$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_STR);
				}else if(strpos($fld,'tta_')===0){//textarea
					$fld='order_karte_'.$fld;
					$asc_counsel[$fld]=array('val'=>$val,'type'=>PDO_STR);
				}else if(strpos($fld,'dtf_')===0){//日付範囲（自）
					$fld='order_karte_'.$fld;
					$asc_counsel[$fld]=array('val'=>fnc_conv_date('TBL',$val),'type'=>PDO_STR);
				}else if(strpos($fld,'dtt_')===0){//日付範囲（至）
					$fld='order_karte_'.$fld;
					$asc_counsel[$fld]=array('val'=>fnc_conv_date('TBL',$val),'type'=>PDO_STR);
				}
			}else if(strpos($fld,'ptp_')===0){//$fld=(ptp_グループ名-写真SN)
				$ary=explode('-',$fld);//「ptp_グループコード」と「写真SN」に分割
				if(count($ary)==2){
					$asc_counsel_photo[$ary[0]][$ary[1]]=$val;//[ptp_グループコード][写真SN]=BASE64 形式
				}
			}
		}
		//写真処理 $asc_counsel['order_ptp_XXXX']=枚数
		if($msg_err==''){
			foreach($asc_counsel_photo as $gruop_code=>$asc){
				$asc_counsel['order_karte_'.$gruop_code]=array('val'=>count($asc),'type'=>PDO_INT);
				foreach($asc as $photo_sn=>$photo_base64){
					$photo_dir='photo/order/';
					fnc_make_dir($photo_dir);//ディレクトリが無ければ作成する
					$photo_path=$photo_dir.'p'.$js_order_ai.'_'.$gruop_code.'-'.$photo_sn.'.jpg';
					if(strpos($photo_base64,'data:')===0){
						$ary_photo_data=explode(',',$photo_base64);//「data:」で始まっているなら ※始まってないなら変更なしなので保存不要
						$photo_base64=$ary_photo_data[1];//「,」以降を取り出す
						file_put_contents($photo_path,base64_decode($photo_base64));
					}
				}
			}
		}

		//★要 入力値チェック

		//新規登録時（$js_order_ai==0 ）はorder_aiが必要なので先行してDB追加（order_user_aiのみ登録）
		if($js_order_ai==0){//新規登録時（対象予約ai=0）
			//①$js_param_order_aiより31_user_tblのuser_idとuser_salon_idを取得
			$user_id='';$user_salon_id='';
			$ary_fld=array('user_id','user_salon_id');//SELECT取得値
			$where='user_ai=:user_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec=$ary_fetchall[0];//1レコード該当前提
			$user_id=$asc_rec['user_id'];
			$user_salon_id=$asc_rec['user_salon_id'];
			//②asc_set
			$asc_set=array();
			$asc_set['order_user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);//顧客ID
			//③DB予約追加
			$inserted_order_ai=fnc_pdo_insert('41_order_tbl',$asc_set);//$inserted_order_ai=追加されたorder_ai値
			$order_ai=$inserted_order_ai;//追加されたorder_aiで差し替え
		}else{//編集時（$js_order_ai>0）
			$order_ai=$js_order_ai;
		}

		//DB登録
		if($msg_err==''){
			$date_today=date('Y/m/d');//登録日・更新日
			//
			$asc_set=$asc_input+$asc_counsel;//DB登録用
			//
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHERE部
			$asc_bind['order_ai']=array('val'=>$order_ai,'type'=>PDO_INT);
			if($cbx_delete_user){//削除_?時-----------------
				$asc_set['order_flg_karte']=array('val'=>false,'type'=>PDO_INT);//「カルテ」が記録されたflg

			}else{//編集時--------------------------------
				$asc_set['order_flg_karte']=array('val'=>true,'type'=>PDO_INT);//「カルテ」が記録されたflg
				$asc_set['order_flg_ope']=array('val'=>true,'type'=>PDO_INT);//「カルテ」が記録されたら「施術」も登録されたことに
			}
			fnc_pdo_update('41_order_tbl',$asc_set,$where,$asc_bind);
			fnc_set_order_search_term($order_ai);//41_order_tblのorder_search_termを設定
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['debug']=$debug;
			if($js_order_ai==0){//新規登録時（対象予約ai=0）
				$asc_ret['ope_code']='ADD';//操作コード=ADD

			}else{//編集or削除?時（対象ユーザーai>0）
				$order_ai=$js_order_ai;//共通後処理用
				if($cbx_delete_user){//削除?時
					$asc_ret['ope_code']='DEL';//操作コード=DEL
				}else{//編集時
					$asc_ret['ope_code']='EDIT';//操作コード=EDIT
				}
			}
			//共通後処理（追加・編集・削除?）
			$asc_ret['order_ai']=$order_ai;//予約ai（追加時は付与されたorder_ai）

			//戻りページ対応処理
			if($id_div_page_back=='div_page_timetable'){//タイムテーブル ページ

			}else if($id_div_page_back=='div_page_add_order'){//新規予約 ページ
			 	$asc_ret['tr_child']=fnc_make_tr_child_tbl_add_order($js_user_ai,$order_ai);//user_aiに対するtbl_add_order行を生成

			}else if($id_div_page_back=='div_page_show_karte'){//カルテ 閲覧ページ
			 	//NOP:BACK機能によりカルテ(閲覧用）表示
			}

		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;

	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//カルテ(編集用）html生成
	//$a_order_ai>0:編集 $a_order_ai=0:新規
	function fc_make_div_child_edit_karte($a_order_ai){
		global $g_ary_sort_gruop_karte,$g_asc_side_gruop_karte;
		$rnd=mt_rand(1000,9999);
		$order_user_ai=0;
		$html_order_karte='';

		//41_order_tbl
		$ary_fld=array('order_user_ai','order_visit_datetime','order_ope_stylist','order_ope_menu','order_ope_price'
			,'order_flg_karte','order_karte_datetime');//SELECT取得値
		foreach($g_ary_sort_gruop_karte as $gruop_code=>$gruop_jpn){
			array_push($ary_fld,'order_karte_'.$gruop_code);
		}

		if($a_order_ai>0){//編集時
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['order_ai']=array('val'=>$a_order_ai,'type'=>PDO_INT);
			$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec_order=$ary_fetchall[0];//1レコード該当前提
			$order_user_ai=$asc_rec_order['order_user_ai'];

		}else{//新規時（空欄の$asc_rec_orderを作成）
			foreach($ary_fld as $fld){
				$asc_rec_order[$fld]='';//空欄
			}
		}

		//カルテ UI表示
		foreach($g_ary_sort_gruop_karte as $gruop_code=>$gruop_jpn){
			$html_order_karte.='<span class="spn_karte">'.$gruop_jpn.'</span>';
			$html_order_karte.='<br>';
			//
			if((strpos($gruop_code,'rdo_')===0)||(strpos($gruop_code,'cbx_')===0)){//radioタグ or checkboxタグ
				if(strpos($gruop_code,'rdo_')===0){//radioタグ
					$html_order_karte.='<div style="display:inline-block;width:4em;text-align:right;">';
					$html_order_karte.=$g_asc_side_gruop_karte[$gruop_code]['front'];
					$html_order_karte.='</div>';
				}
				$s_ary_sort='g_ary_sort_'.$gruop_code;
				global $$s_ary_sort;
				$s_asc_term='g_asc_term_'.$gruop_code;
				global $$s_asc_term;
				foreach($$s_ary_sort as $val){
					$term=$$s_asc_term[$val];
					//
					if(strpos($gruop_code,'rdo_')===0){//radioタグ
						$checked='';if($asc_rec_order['order_karte_'.$gruop_code]==$val)$checked=' CHECKED';//選択されたrdoなら
						$html_order_karte.='<div style="display:inline-block;margin:0 10px;text-align:center;">';
						$html_order_karte.='<label>';
						$html_order_karte.=$term;
						$html_order_karte.='<br>';
						$html_order_karte.='<input type="radio" class="post_ui '.$gruop_code.'" name="rdo_'.$gruop_code.'" value="'.$val.'"'.$checked.'>';
						$html_order_karte.='</label>';
						$html_order_karte.='</div>';
						$html_order_karte.="\n";

					}else if(strpos($gruop_code,'cbx_')===0){//checkboxタグ
						$checked='';if(strpos($asc_rec_order['order_karte_'.$gruop_code],",$val,")!==false)$checked=' CHECKED';//選択されたcbxなら（,で囲まれた選択コードがあるなら）
						$html_order_karte.='<label>';//labelタグ
						$html_order_karte.='<input type="checkbox" class="post_ui '.$gruop_code.'" value="'.$val.'"'.$checked.'>';
						$html_order_karte.=$term;
						$html_order_karte.='</label>';
						$html_order_karte.="\n".'<br>';
					}
				}
				if(strpos($gruop_code,'rdo_')===0){//radioタグ
					$html_order_karte.=$g_asc_side_gruop_karte[$gruop_code]['back'];
				}
			}else if(strpos($gruop_code,'txt_')===0){//input type=text
				$html_order_karte.='<input type="text" class="post_ui '.$gruop_code.'" value="'.$asc_rec_order['order_karte_'.$gruop_code].'">';

			}else if(strpos($gruop_code,'tta_')===0){//textarea
				$html_order_karte.='<textarea class="post_ui '.$gruop_code.'">'.$asc_rec_order['order_karte_'.$gruop_code].'</textarea>';

			}else if(strpos($gruop_code,'tac_')===0){//textarea コンサル用
				$html_order_karte.='<textarea class="post_ui '.$gruop_code.'">'.$asc_rec_order['order_karte_'.$gruop_code].'</textarea>';

			}else if(strpos($gruop_code,'dtf_')===0){//日付範囲（自）
				$html_order_karte.='<input class="post_ui '.$gruop_code.'"';
				$html_order_karte.=' type="date" value="'.fnc_conv_date('SQL',$asc_rec_order['order_karte_'.$gruop_code]).'">';

			}else if(strpos($gruop_code,'dtt_')===0){//日付範囲（至）
				$html_order_karte.='<input class="post_ui '.$gruop_code.'"';
				$html_order_karte.=' type="date" value="'.fnc_conv_date('SQL',$asc_rec_order['order_karte_'.$gruop_code]).'">';

			}else if(strpos($gruop_code,'ptp_')===0){//写真ピッカー
				$photo_dir='photo/order/';
				$num_photo=$asc_rec_order['order_karte_'.$gruop_code];//写真枚数

				$html_order_karte.='<div class="div_photo_picker" id="'.$gruop_code.'">';//divタグ
				if($num_photo==0){
					$html_order_karte.='<span>クリックして写真選択</span>';
				}else{
					for($photo_sn=1;$photo_sn<=$num_photo;$photo_sn++){
						$photo_path=$photo_dir.'p'.$a_order_ai.'_'.$gruop_code.'-'.$photo_sn.'.jpg';
						if(file_exists($photo_path)){
							$html_order_karte.='<img class="img_ptp" src="'.$photo_path.'?'.$rnd.'">';
						}
					}
				}
				//
				$html_order_karte.='</div>';
			}
			$html_order_karte.='<br>';
		}
		//
		return array($order_user_ai,$html_order_karte);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//予約：新規ボタン
	function fnc_btn_add_order(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//ユーザーai（>0）
		$js_order_ai=$_POST['js_order_ai'];//予約ai（=0）

		$tr_child=fnc_make_tr_child_tbl_add_order($js_user_ai,$js_order_ai);//user_aiに対するtbl_add_order行を生成

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['tr_child']=$tr_child;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//予約新規リストのtrタグChild生成
	//user_aiに対するtbl_add_order行を生成
	//$a_user_ai>0,$a_order_ai>=0（0…予約新規）
	//コール元：fnc_btn_add_order()とfnc_btn_reg_order_counsel_datetime()
	function fnc_make_tr_child_tbl_add_order($a_user_ai,$a_order_ai){
		$html='';

		//td内容 初期化
		$td_order_menu_summry='';//予約：メニュー概要
		$td_order_stylist='';//当者（counsel,opeとも）
		$td_order_counsel_datetime='';//予約：カウンセリング日時
		$td_order_counsel_result='';//予約：カウンセリング内容
		$td_order_prepaid='';//予約：事前決済
		$td_order_ope='';//予約：メニュー
		$td_order_karte='';//カルテ

		if($a_order_ai>0){//既存 予約時
			//41_order_tbl
			$ary_fld=array('order_user_ai','order_flg_counsel_datetime','order_counsel_datetime','order_counsel_stylist'
				,'order_flg_counsel_result','order_flg_counsel_yet','order_flg_ope','order_ope_stylist'
				,'order_flg_prepaid','order_prepaid_datetime','order_flg_karte','order_karte_datetime','order_flg_user_filled');//SELECT取得値
			$where='order_ai=:order_ai';
			$asc_bind=array();//WHEREのbind値
			$asc_bind['order_ai']=array('val'=>$a_order_ai,'type'=>PDO_INT);//指定order_ai
			$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
			$asc_rec_order=$ary_fetchall[0];
			$user_ai=$asc_rec_order['order_user_ai'];
		}else{//新規 予約時
			$user_ai=$a_user_ai;
		}

		//31_user_tbl
		$ary_fld=array('user_id','user_name','user_yomi','user_hpid');//SELECT取得値
		$where='user_ai=:user_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$user_ai,'type'=>PDO_INT);//指定user_ai
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		if(count($ary_fetchall)==1){//1件該当が前提
			$asc_rec_user=$ary_fetchall[0];
			
			if($a_order_ai==0){//予約新規時（オーダーai=0）
				//メニュー概要
				$td_order_menu_summry='';

				//担当者
				$td_order_stylist='';

				//カウンセリング日時
				$td_order_counsel_datetime='<button class="btn_add_order_counsel_datetime" value="'.$a_order_ai.'">';
				$td_order_counsel_datetime.='＋</button>';

				//カウンセリング内容
				$td_order_counsel_result='<button class="btn_add_order_counsel_result" value="'.$a_order_ai.'">';
				$td_order_counsel_result.='＋</button>';

				//事前決済
				$td_order_prepaid='<button class="btn_add_order_prepaid" value="'.$a_order_ai.'">';
				$td_order_prepaid.='＋</button>';

				//施術
				$td_order_ope='<button class="btn_add_order_ope" value="'.$a_order_ai.'">';
				$td_order_ope.='＋</button>';

				//カルテ
				$td_order_karte='<button class="btn_add_order_karte" value="'.$a_order_ai.'">';
				$td_order_karte.='＋</button>';

			}else{//予約既存時（オーダーai>0）
				//担当者
				if($asc_rec_order['order_flg_ope']==true){
					$td_order_stylist=$asc_rec_order['order_ope_stylist'];//施術担当者
				}else if($asc_rec_order['order_flg_counsel_datetime']==true){
					$td_order_stylist=$asc_rec_order['order_counsel_stylist'];//担当者
				}

				//カウンセリング日時
				$html_btn='＋';//未作成時
				if($asc_rec_order['order_flg_counsel_datetime']==true){//作成済み時
					$html_btn=fnc_conv_datetime('BR',$asc_rec_order['order_counsel_datetime']);//予約：カウンセリング日時
				}
				$td_order_counsel_datetime='<button class="btn_add_order_counsel_datetime" value="'.$a_order_ai.'">';
				$td_order_counsel_datetime.=$html_btn.'</button>';

				//カウンセリング内容
				if($asc_rec_order['order_flg_user_filled']==true){//ユーザー回答済み時
					$td_order_counsel_result.='<button class="btn_show_order_counsel_result" value="'.$a_order_ai.'">';
					$td_order_counsel_result.='お客様回答済み</button>';
				}else{//ユーザー未回答時
					$td_order_counsel_result.='<button class="btn_add_order_counsel_result" value="'.$a_order_ai.'">';
					$td_order_counsel_result.='お客様未回答</button>';
				}

				
				//事前決済
				$html_btn='＋';//未作成時
				if($asc_rec_order['order_flg_prepaid']==true){//作成済み時
					$html_btn='編集';
				}
				$td_order_prepaid='<button class="btn_add_order_prepaid" value="'.$a_order_ai.'">';
				$td_order_prepaid.=$html_btn.'</button>';
	
				//施術
				$html_btn='＋';//未作成時
				if($asc_rec_order['order_flg_ope']==true){//作成済み時
					$html_btn='編集';
				}
				$td_order_ope='<button class="btn_add_order_ope" value="'.$a_order_ai.'">';
				$td_order_ope.=$html_btn.'</button>';

				//カルテ
				$html_btn='＋';//未作成時
				if($asc_rec_order['order_flg_karte']==true){//作成済み時
					$html_btn='編集';
				}
				$td_order_karte='<button class="btn_add_order_karte" value="'.$a_order_ai.'">';
				$td_order_karte.=$html_btn.'</button>';
			}
			
			//
			$html.='<td>';
			$html.=$asc_rec_user['user_id'];
			if($asc_rec_user['user_hpid']!='')$html.='<br>'.$asc_rec_user['user_hpid'];
			$html.='</td>';
			//フリガナ/名前
			$html.='<td>';
			if($asc_rec_user['user_yomi']!='')$html.=$asc_rec_user['user_yomi'].'<br>';
			$html.=$asc_rec_user['user_name'];
			$html.='</td>';
			//予約：メニュー
			$html.='<td>';
			$html.=$td_order_menu_summry;
			$html.='</td>';
			//予約：担当者
			$html.='<td>';
			$html.=$td_order_stylist;
			$html.='</td>';
			//予約：カウンセリング日時
			$html.='<td>';
			$html.=$td_order_counsel_datetime;
			$html.='</td>';
			//予約：カウンセリング内容
			$html.='<td>';
			$html.=$td_order_counsel_result;
			$html.='</td>';
			//予約：事前決済
			$html.='<td>';
			$html.=$td_order_prepaid;
			$html.='</td>';
			//予約：施術
			$html.='<td>';
			$html.=$td_order_ope;
			$html.='</td>';
			//予約：カルテ
			$html.='<td>';
			$html.=$td_order_karte;
			$html.='</td>';
		}
		//
		return $html;
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//顧客管理（一覧）：検索ボタン
	function fnc_btn_search_user(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';
		//POST値
		$js_salon_id=$_POST['js_salon_id'];
		$txt_search_user=$_POST['txt_search_user'];//検索語句（ID/名前/フリガナ ※空欄で全検索）
		
		//検索語句加工
		$txt_search_user=str_replace('　','',$txt_search_user);//全角スペース除去
		$txt_search_user=str_replace(' ','',$txt_search_user);//半角スペース除去

		//SQL文設定（user_search_termに対して検索）
		$ary_fld=array('user_ai');//SELECT取得値

		$where='user_flg_deleted=false AND user_salon_id=:user_salon_id';
		if($txt_search_user!='')$where.=' AND user_search_term LIKE :user_search_term';
		
		$tale='ORDER BY user_yomi';

		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_salon_id']=array('val'=>$js_salon_id,'type'=>PDO_INT);
		if($txt_search_user!='')$asc_bind['user_search_term']=array('val'=>'%'.$txt_search_user.'%','type'=>PDO_STR);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,$tale,$asc_bind);

		//各レコード処理
		foreach($ary_fetchall as $asc_rec){
			$html.='<tr class="tr_user_ai_'.$asc_rec['user_ai'].'">';
			$html.=fnc_make_tr_child_tbl_manage_user($asc_rec['user_ai']);//user_aiに対するtbl_manage_user行を生成
			$html.='</tr>';
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['tbody']=$html;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//顧客リストのtrタグChild生成 
	//user_aiに対するtbl_manage_user行を生成
	function fnc_make_tr_child_tbl_manage_user($a_user_ai){
		global $g_asc_sex;
		$html='';
		//
		//SQL文設定（user_search_termに対して検索）
		$ary_fld=array('user_id','user_name','user_yomi','user_hpid','user_birthday'
			,'user_sex','user_email','user_tel','user_add_date','user_edit_date');//SELECT取得値

		$where='user_ai=:user_ai';

		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$a_user_ai,'type'=>PDO_INT);//指定user_ai
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		if(count($ary_fetchall)==1){//1件該当が前提
			$asc_rec=$ary_fetchall[0];
			//予約
			$html.='<td>';
			$html.='<button class="btn_add_order" value="'.$a_user_ai.'">新規</button>';
			$html.='</td>';
			//ユーザーID/ホットペッパーID
			$html.='<td>';
			$html.='<span class="spn_user_id">'.$asc_rec['user_id'].'</span>';
			if($asc_rec['user_hpid']!='')$html.='<br>'.$asc_rec['user_hpid'];
			$html.='</td>';
			//フリガナ/名前
			$html.='<td>';
			if($asc_rec['user_yomi']!='')$html.=$asc_rec['user_yomi'].'<br>';
			$html.=$asc_rec['user_name'];
			$html.='</td>';
			//性別/生年月日
			$html.='<td>';
			$html.=$g_asc_sex[$asc_rec['user_sex']];
			if($asc_rec['user_birthday']!='')$html.='<br>'.$asc_rec['user_birthday'];
			$html.='</td>';
			//電話番号/メールアドレス
			$html.='<td>';
			$html.=$asc_rec['user_tel'];
			if($asc_rec['user_email']!='')$html.='<br>'.$asc_rec['user_email'];
			$html.='</td>';
			//編集
			$html.='<td>';
			$html.='<button class="btn_edit_user" value="'.$a_user_ai.'"><i class="fas fa-edit"></i></button>';
			$html.='</td>';
			//登録日/更新日
			$html.='<td>';
			$html.=$asc_rec['user_edit_date'];
			$html.='<br>'.$asc_rec['user_add_date'];
			$html.='</td>';
		}
		//
		return $html;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//顧客管理（一覧）：新規顧客ボタン
	function fnc_btn_add_user(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_salon_id=$_POST['js_salon_id'];

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['xxx']=$html;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//顧客管理：編集ボタン
	function fnc_btn_edit_user(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//対象 ユーザーai（0…新規）

		//SQL文E設定
		$ary_fld=array('user_id','user_name','user_yomi','user_hpid','user_birthday','user_sex','user_email','user_tel');//SELECT取得値

		$where='user_ai=:user_ai';

		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['spn_user_id']=$asc_rec['user_id'];
			$asc_ret['txt_user_name']=$asc_rec['user_name'];
			$asc_ret['txt_user_yomi']=$asc_rec['user_yomi'];
			$asc_ret['txt_user_hpid']=$asc_rec['user_hpid'];
			$asc_ret['txd_user_birthday']=str_replace('/','-',$asc_rec['user_birthday']);//input=date カレンダに反応させるために「/」→「-」
			$asc_ret['rdo_edit_user_sex']=$asc_rec['user_sex'];
			$asc_ret['txt_user_email']=$asc_rec['user_email'];
			$asc_ret['txt_user_tel']=$asc_rec['user_tel'];
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//顧客管理：（新規・編集・削除）：登録ボタン
	function fnc_btn_reg_user(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_user_ai=$_POST['js_user_ai'];//対象ユーザーai（0…新規）
		$js_salon_id=$_POST['js_salon_id'];//js_user_ai>0時は-1
		$txt_user_name=$_POST['txt_user_name'];//ユーザー名前
		$txt_user_yomi=$_POST['txt_user_yomi'];//ユーザーフリガナ
		$txd_user_birthday=$_POST['txd_user_birthday'];//ユーザー生年月日
		$txt_user_email=$_POST['txt_user_email'];//ユーザーemail
		$txt_user_tel=$_POST['txt_user_tel'];//ユーザーTEL
		$txt_user_hpid=$_POST['txt_user_hpid'];//ユーザー ホットペッパーID
		$txt_user_sex=$_POST['txt_user_sex'];//ユーザー性別（女=1,男=2）
		$cbx_delete_user=$_POST['cbx_delete_user']=='true' ? 1:0;//削除する（'true'/'false'）→(1/0)

		//★要 入力値チェック

		//DB登録
		if($msg_err==''){
			$txd_user_birthday=str_replace('-','/',$txd_user_birthday);//日付の「-」→「/」変換
			$date_today=date('Y/m/d');//登録日・更新日
			//
			$asc_set=array();//DB登録用
			///共通項目セット
			$asc_set['user_name']=array('val'=>$txt_user_name,'type'=>PDO_STR);
			$asc_set['user_yomi']=array('val'=>$txt_user_yomi,'type'=>PDO_STR);
			$asc_set['user_birthday']=array('val'=>$txd_user_birthday,'type'=>PDO_STR);
			$asc_set['user_email']=array('val'=>$txt_user_email,'type'=>PDO_STR);
			$asc_set['user_tel']=array('val'=>$txt_user_tel,'type'=>PDO_STR);
			$asc_set['user_hpid']=array('val'=>$txt_user_hpid,'type'=>PDO_STR);
			$asc_set['user_sex']=array('val'=>$txt_user_sex,'type'=>PDO_INT);
			$asc_set['user_edit_date']=array('val'=>$date_today,'type'=>PDO_STR);
			///個別項目セット
			if($js_user_ai==0){//新規登録時（対象ユーザーai=0）-----------------------------------------
				$asc_set['user_id']=array('val'=>BASE_USER_ID,'type'=>PDO_INT);//ユーザーIDはBASE_USER_ID→後でMAX+1で振り直す
				$asc_set['user_pw']=array('val'=>fnc_MakeRandStr(8),'type'=>PDO_STR);//パスワード生成（英数8文字）
				$asc_set['user_salon_id']=array('val'=>$js_salon_id,'type'=>PDO_INT);
				$asc_set['user_add_date']=array('val'=>$date_today,'type'=>PDO_STR);
				$inserted_order_ai=fnc_pdo_insert('31_user_tbl',$asc_set);//DB顧客追加

				//ユーザーIDをMAX+1で振り直す
				$sql='UPDATE 31_user_tbl,';
				$sql.=' (SELECT MAX(user_id)+1 AS MAX FROM 31_user_tbl WHERE user_salon_id='.$js_salon_id.') T';
				$sql.=' SET user_id=T.MAX';
				$sql.=' WHERE  user_ai='.$inserted_order_ai;
				//$sql.=' WHERE user_id='.BASE_USER_ID.' AND user_salon_id='.$js_salon_id;
				fnc_pdo_sql($sql);//SQL実行
				
				//user_search_term設定
				$sql='UPDATE 31_user_tbl SET user_search_term=CONCAT(user_id,",",user_name,",",user_yomi) WHERE user_ai='.$inserted_order_ai;
				fnc_pdo_sql($sql);//SQL実行
				//user_search_term全角空白除去
				$sql='UPDATE 31_user_tbl SET user_search_term=REPLACE(user_search_term,"　","") WHERE user_ai='.$inserted_order_ai;
				fnc_pdo_sql($sql);//SQL実行
				//user_search_term半角空白除去
				$sql='UPDATE 31_user_tbl SET user_search_term=REPLACE(user_search_term," ","") WHERE user_ai='.$inserted_order_ai;
				fnc_pdo_sql($sql);//SQL実行

			}else{//編集or削除時（対象ユーザーai>0）-----------------------------------------------------
				$asc_set['user_search_term']=array('val'=>$js_user_ai.$txt_user_name.$txt_user_yomi,'type'=>PDO_STR);//論理削除を設定
				$where='user_ai=:user_ai';
				$asc_bind=array();//WHERE部
				$asc_bind['user_ai']=array('val'=>$js_user_ai,'type'=>PDO_INT);
				if($cbx_delete_user){//削除時-----------------
					$asc_set['user_flg_deleted']=array('val'=>1,'type'=>PDO_INT);//論理削除を設定
					fnc_pdo_update('31_user_tbl',$asc_set,$where,$asc_bind);//論理削除を実行
					//fnc_pdo_update('41_user_tbl',$asc_set,$where,$asc_bind);//★削除顧客の予約も論理削除

				}else{//編集時--------------------------------
					fnc_pdo_update('31_user_tbl',$asc_set,$where,$asc_bind);
				}
			}
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['debug']=$debug;
			if($js_user_ai==0){//新規登録時（対象ユーザーai=0）
				$asc_ret['ope_code']='ADD';//操作コード=ADD
				$asc_ret['txt_search_user']=$txt_user_name;//ユーザーIDを検索項目とする
			}else{//編集or削除時（対象ユーザーai>0）
				if($cbx_delete_user){//削除時
					$asc_ret['ope_code']='DEL';//操作コード=DEL
				}else{//編集時
					$asc_ret['ope_code']='EDIT';//操作コード=EDIT
				}
			}
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//サロン情報：閲覧ボタン（=select）
	function fnc_btn_show_salon_data(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_salon_id=$_POST['js_salon_id'];//js_order_ai>0

		//21_salon_tbl情報取得
		$ary_fld=array('salon_name','salon_addr1','salon_addr2','salon_tel','salon_email'
			,'salon_hp','salon_insta','salon_blog','salon_youtube','salon_map','salon_zoom'
			,'salon_ptp_image','salon_ptp_logo','salon_ptp_karte','salon_ptp_hp','salon_ptp_prepaid'
			,'salon_ptp_profile_change','salon_ptp_thank_you');//SELECT取得値

		$where='salon_id=:salon_id';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['salon_id']=array('val'=>$js_salon_id,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('21_salon_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		foreach($ary_fld as $fld){
			$$fld=$asc_rec[$fld];
		}

		//★入力データチェック

		if($msg_err==''){
			$asc_ret['result']='OK';
			foreach($ary_fld as $fld){//表示UI値設定
				if(strpos($fld,'salon_ptp_')===0){//ptp項目なら
					$asc_ret[str_replace('salon_ptp_','ptp_',$fld)]=$$fld;//写真枚数 「ptp_」を先頭文字とする
				}else{//ptp項目以外なら（=spn）
					$asc_ret['spn_'.$fld]=$$fld;
				}
			}
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//サロン情報：編集ボタン
	function fnc_btn_edit_salon_data(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//POST値
		$js_salon_id=$_POST['js_salon_id'];//サロンai（>0）

		//21_salon_tbl
		$ary_fld=array('salon_name','salon_addr1','salon_addr2','salon_tel','salon_email'
			,'salon_hp','salon_insta','salon_blog','salon_youtube','salon_map','salon_zoom'
			,'salon_ptp_image','salon_ptp_logo','salon_ptp_karte','salon_ptp_hp','salon_ptp_prepaid'
			,'salon_ptp_profile_change','salon_ptp_thank_you');//SELECT取得値

		$where='salon_id=:salon_id';

		$asc_bind=array();//WHEREのbind値
		$asc_bind['salon_id']=array('val'=>$js_salon_id,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('21_salon_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		if($msg_err==''){
			$asc_ret['result']='OK';
			foreach($ary_fld as $fld){//表示UI値設定
				if(strpos($fld,'salon_ptp_')===0){//ptp項目なら
					$asc_ret[str_replace('salon_ptp_','ptp_',$fld)]=$asc_rec[$fld];//写真枚数 「ptp_」を先頭文字とする
				}else{//ptp項目以外なら（=txt）
					$asc_ret['txt_'.$fld]=$asc_rec[$fld];
				}
			}
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//サロン情報：登録ボタン
	function fnc_btn_reg_salon_data(){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';

		//21_salon_tbl
		$ary_fld_txt=array('salon_name','salon_addr1','salon_addr2','salon_tel','salon_email'
			,'salon_hp','salon_insta','salon_blog','salon_youtube','salon_map','salon_zoom');
		$ary_fld_ptp=array('ptp_image','ptp_logo','ptp_karte','ptp_hp','ptp_prepaid','ptp_profile_change','ptp_thank_you');//SELECT取得値

		//POST値
		$js_salon_id=$_POST['js_salon_id'];//対象サロンid(>0)
		foreach($ary_fld_txt as $fld){//-----------------------------------------------------
			$$fld=$_POST['txt_'.$fld];
		}
		$asc_ptp=array();//[gruop_code][sn]=base64データ 形式--------------------------------
		foreach($ary_fld_ptp as $fld){
			foreach($_POST as $fld_post=>$val_post){
				if(strpos($fld_post,$fld.'-')===0){//-はgruop_codeと画像snのデリミタ
					$ary=explode('-',$fld_post);//「ptp_グループコード」と「写真SN」に分割
					$asc_ptp[$ary[0]][$ary[1]]=$val_post;//[ptp_グループコード][写真SN]=BASE64 形式
				}
			}
		}
		//★要 入力値チェック

		//写真保存処理
		if($msg_err==''){
			foreach($asc_ptp as $gruop_code=>$asc){
				foreach($asc as $photo_sn=>$photo_base64){
					$photo_dir='photo/salon/';
					fnc_make_dir($photo_dir);//ディレクトリが無ければ作成する
					$photo_path=$photo_dir.'p'.$js_salon_id.'_'.$gruop_code.'-'.$photo_sn.'.jpg';
					if(strpos($photo_base64,'data:')===0){
						$ary_photo_data=explode(',',$photo_base64);//「data:」で始まっているなら ※始まってないなら変更なしなので保存不要
						$photo_base64=$ary_photo_data[1];//「,」以降を取り出す
						file_put_contents($photo_path,base64_decode($photo_base64));
					}
				}
			}
		}

		//DB登録
		if($msg_err==''){
			$date_today=date('Y/m/d');//登録日・更新日
			//
			$asc_set=array();//DB登録用
			//フィールド ループ
			foreach($ary_fld_txt as $fld){
				$asc_set[$fld]=array('val'=>$$fld,'type'=>PDO_STR);//DB登録値セット
				$asc_ret['spn_'.$fld]=$$fld;//閲覧ページ 復元用
			}
			foreach($ary_fld_ptp as $fld){
				if(isset($asc_ptp[$fld])){//アップロード写真がある
					$asc_set['salon_'.$fld]=array('val'=>count($asc_ptp[$fld]),'type'=>PDO_INT);
					$asc_ret[$fld]=count($asc_ptp[$fld]);//閲覧ページ 復元用
				}else{//アップロード写真がない
					$asc_set['salon_'.$fld]=array('val'=>0,'type'=>PDO_INT);
					$asc_ret[$fld]=0;//閲覧ページ 復元用
					//fff写真用削除
				}
			}
			//where
			$where='salon_id=:salon_id';
			//where用bind
			$asc_bind=array();
			$asc_bind['salon_id']=array('val'=>$js_salon_id,'type'=>PDO_INT);
			fnc_pdo_update('21_salon_tbl',$asc_set,$where,$asc_bind);
		}

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//41_order_tblのorder_search_termを設定
	//order_search_term=名前+フリガナ+担当者+メニュー 名前+フリガナは31_user_tblより 担当者+メニューは41_order_tblより
	function fnc_set_order_search_term($a_order_ai){
		$order_search_term='';
		//41_order_tbl
		$ary_fld=array('order_user_ai','order_counsel_stylist','order_ope_menu','order_ope_stylist');//SELECT取得値
		$where='order_ai=:order_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['order_ai']=array('val'=>$a_order_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('41_order_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		$order_user_ai=$asc_rec['order_user_ai'];//ユーザーai
		$order_counsel_stylist=$asc_rec['order_counsel_stylist'];//担当者
		$order_ope_stylist=$asc_rec['order_ope_stylist'];//施術担当者
		$order_ope_menu=$asc_rec['order_ope_menu'];//施術メニュー

		//31_user_tbl
		$ary_fld=array('user_name','user_yomi');//SELECT取得値
		$where='user_ai=:user_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['user_ai']=array('val'=>$order_user_ai,'type'=>PDO_INT);
		$ary_fetchall=fnc_pdo_select('31_user_tbl',$ary_fld,$where,'',$asc_bind);
		$asc_rec=$ary_fetchall[0];//1レコード該当前提
		$user_name=$asc_rec['user_name'];//ユーザー名
		$user_yomi=$asc_rec['user_yomi'];//ユーザー名ヨミ
		
		//検索語句（order_search_term）登録
		$order_search_term=$user_name.','.$user_yomi.','.$order_counsel_stylist.','.$order_ope_menu.$order_ope_stylist;
		$order_search_term=str_replace(' ','',$order_search_term);//半角スペース除去
		$order_search_term=str_replace('　','',$order_search_term);//全角スペース除去
		$asc_set['order_search_term']=array('val'=>$order_search_term,'type'=>PDO_STR);
		$where='order_ai=:order_ai';
		$asc_bind=array();//WHEREのbind値
		$asc_bind['order_ai']=array('val'=>$a_order_ai,'type'=>PDO_INT);
		fnc_pdo_update('41_order_tbl',$asc_set,$where,$asc_bind);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//ディレクトリが無ければ作成する
	function fnc_make_dir($a_path_dir){
		if(file_exists($a_path_dir)==false){
			mkdir($a_path_dir,0777,true);//true:再帰作成する
			chmod($a_path_dir,0777);
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function (){
		return $;
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function (){
		$asc_ret=array();//戻り値 初期化
		//
		$msg_err='';
		$html='';
		$debug='';
		//メッセージ

		if($msg_err==''){
			$asc_ret['result']='OK';
			$asc_ret['div_TopContents']=$sql;
			$asc_ret['debug']=$debug;
		}else{
			$asc_ret['result']='NG';
			$asc_ret['msg']='<span style="color: red">'.$msg_err.'</span>';
			$asc_ret['debug']=$debug;
		}
		//
		return $asc_ret;
	}
*/
?>
