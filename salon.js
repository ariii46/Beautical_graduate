var g_salon_id=0;//サロンid
var g_salon_name='';//サロン名
var g_user_ai=0;//ユーザーai
var g_order_ai=0;//予約ai
var g_ary_div_page=[];//ページ遷移 管理配列（div_pageのid）
var g_obj_div_photo_picker;//対象 写真選択枠
$(function(){
	//ページ読み込み時
	//$(document).ready(function(){fnc_ready();});
	fnc_ready();
	
	//「タイムテーブル」----------------------------------------------------------------------------------------
	$('.btn_manage_user').click(function(e){fnc_btn_manage_user(e,$(this));});//顧客管理
	$('.btn_manage_order').click(function(e){fnc_btn_manage_order(e,$(this));});//予約/カルテ管理
	$('.btn_set_salon_data').click(function(e){fnc_btn_show_salon_data(e,$(this));});//サロン情報設定
	$('.btn_go_square_dashboard').click(function(e){fnc_btn_go_square_dashboard($(this));});//Squareダッシュボード
	$('#tdt_timetable').change(function(e){fnc_tdt_timetable(e,$(this));});//タイムテーブル：日付変更
	$('#btn_search_tt').click(function(e){fnc_btn_search_tt(e,$(this));});//タイムテーブル：検索ボタン
	$('.btn_timetable_date').click(function(e){fnc_btn_timetable_date(e,$(this));});//タイムテーブル日付「←」「→」ボタン

	//「カウンセリング日時」-----------------------------------------------------------------------------------
	$(document).on('click','.btn_edit_order_counsel_datetime',function(e){fnc_btn_edit_order_counsel_datetime(e,$(this));});//カウンセリング日時予約：編集ボタン
	$('.btn_reg_order_counsel_datetime').click(function(e){fnc_btn_reg_order_counsel_datetime(e,$(this));});//登録ボタン

	//「カウンセリング回答」-----------------------------------------------------------------------------------
	$(document).on('click','.btn_show_order_counsel_result',function(e){fnc_btn_show_order_counsel_result(e,$(this));});//カウンセリング回答：閲覧ボタン
	$(document).on('click','.btn_edit_order_counsel_result',function(e){fnc_btn_edit_order_counsel_result(e,$(this));});//カウンセリング回答：編集ボタン
	$('.btn_reg_order_counsel_result').click(function(e){fnc_btn_reg_order_counsel_result(e,$(this));});//登録ボタン

	//「事前決済」---------------------------------------------------------------------------------------------
	$(document).on('click','.btn_edit_order_prepaid',function(e){fnc_btn_edit_order_prepaid(e,$(this));});//事前決済：編集ボタン
	$('.btn_reg_order_prepaid').click(function(e){fnc_btn_reg_order_prepaid(e,$(this));});//事前決済：登録ボタン

	//「施術」-------------------------------------------------------------------------------------------------
	$(document).on('click','.btn_show_order_ope',function(e){fnc_btn_show_order_ope(e,$(this));});//施術：閲覧ボタン
	$(document).on('click','.btn_edit_order_ope',function(e){fnc_btn_edit_order_ope(e,$(this));});//施術：編集ボタン
	$(document).on('click','.btn_reg_order_ope',function(e){fnc_btn_reg_order_ope(e,$(this));});//施術：登録ボタン

	//「カルテ」------------------------------------------------------------------------------------------------
	$(document).on('click','.btn_show_order_karte',function(e){fnc_btn_show_order_karte(e,$(this));});//カルテ：閲覧ボタン
	$(document).on('click','.btn_edit_order_karte',function(e){fnc_btn_edit_order_karte(e,$(this));});//カルテ：編集ボタン
	$(document).on('click','.btn_reg_order_karte',function(e){fnc_btn_reg_order_karte(e,$(this));});//カルテ：登録ボタン

	//「予約新規」----------------------------------------------------------------------------------------------
	$(document).on('click','.btn_add_order',function(e){fnc_btn_add_order(e,$(this));});//予約作成ボタン
	$(document).on('click','.btn_add_order_counsel_datetime',function(e){fnc_btn_edit_order_counsel_datetime(e,$(this));});//カウンセリング日時予約
	$(document).on('click','.btn_add_order_counsel_result',function(e){fnc_btn_edit_order_counsel_result(e,$(this));});//カウンセリング内容
	$(document).on('click','.btn_add_order_prepaid',function(e){fnc_btn_edit_order_prepaid(e,$(this));});//事前決済
	$(document).on('click','.btn_add_order_ope',function(e){fnc_btn_edit_order_ope(e,$(this));});//施術
	$(document).on('click','.btn_add_order_karte',function(e){fnc_btn_edit_order_karte(e,$(this));});//カルテ

	//「予約/カルテ管理」---------------------------------------------------------------------------------------
	$('#btn_search_order').click(function(e){fnc_btn_search_order(e,$(this));});//検索ボタン

	//「顧客管理」ページ----------------------------------------------------------------------------------------
	$('#btn_search_user').click(function(e){fnc_btn_search_user(e,$(this));});//検索ボタン
	$('#btn_add_user').click(function(e){fnc_btn_add_user(e,$(this));});//新規ボタン
	$(document).on('click','.btn_edit_user',function(e){fnc_btn_edit_user(e,$(this));});//編集ボタン

	//「顧客編集」ページ----------------------------------------------------------------------------------------
	$('#btn_reg_user').click(function(e){fnc_btn_reg_user(e,$(this));});//登録ボタン
	$('#cbx_delete_user').change(function(e){fnc_cbx_delete_user($(this));});//顧客削除チェックボックス

	//「サロン情報」ページ--------------------------------------------------------------------------------------
	$('#btn_edit_salon_data').click(function(e){fnc_btn_edit_salon_data(e,$(this));});//編集ボタン
	$('#btn_reg_salon_data').click(function(e){fnc_btn_reg_salon_data(e,$(this));});//登録ボタン

	//共通処理--------------------------------------------------------------------------------------------------
	$('.btn_back').click(function(e){fnc_btn_back(e,$(this));});
	$('.btn_cancel').click(function(e){fnc_btn_cancel(e,$(this));});//キャンセルボタン＝戻るボタン 同動作
	$('#fle_photo_picker').change(function(e){fnc_fle_photo_picker(e,$(this));});//fle_photo_pickerクリック
	$(document).on('click','.div_photo_picker',function(e){fnc_div_photo_picker($(this));});//photo_pickerクリック
	$(document).on('click','.img_ptp',function(e){fnc_click_img_ptp(e,$(this));});//photo_picker内の写真クリック
//$(document).on('click','img',function(e){alert($(this).prop('class'));});//photo_picker内の写真クリック
	
	//検索語句Enterキーでも検索する
	$('#txt_search_tt_word').keypress(function(e){if(e.key=='Enter')fnc_btn_search_tt(e,$(this));});
	$('#txt_search_user').keypress(function(e){if(e.key=='Enter')fnc_btn_search_user(e,$(this));});
	$('#txt_search_order').keypress(function(e){if(e.key=='Enter')fnc_btn_search_order(e,$(this));});

	//continuousCalendar---------------------------------------------------------------------------------------
/*
	$("#div_page_edit_order_karte").continuousCalendar({
		weeksBefore: 10,
		lastDate: "today",
		selectToday: true,
		isRange: true
	});
*/
	$("#div_page_edit_order_karte").bind('calendarChange',function() {
		var container = $(this)
		var startTime = container.find('select[name=tripStartTime]').val()
		var endTime = container.find('select[name=tripEndTime]').val()
		var range = container.calendarRange()
		range = range.withTimes(startTime, endTime)
		container.find('.totalTimeOfTrip').text(DateFormat.formatRange(range, DateLocale.EN)).toggleClass('invalid', !range.isValid())
	});

	$("#div_page_edit_order_karte select").bind('change',function() {
		$("#div_page_edit_order_karte").trigger('calendarChange');
	});

	$("#div_page_edit_order_karte select").each(function() {
		for(i = 0; i < 24; i++) {
			$(this).append($("<option>").text(i + ":00")).append($("<option>").text(i + ":30"));
		}
	});
});

///////////////////////////////////////////////////////////////////////////
//ページ読み込み時
function fnc_ready(){
	//alert('fnc_ready()');return;

	mode_dev=$('#hdn_mode_dev').val();//開発モード(ShowAllPage/)

	if(mode_dev=='ShowAllPage'){
		return;
	}else{//通常モード
		$('.div_page').css('display','none');//全ページを非表示
		$('#div_page_timetable').css('display','block');//TOPページを表示
	}

	var asc_post={};
	asc_post['act']='ready';
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//初期化
			g_salon_id=json_data['salon_id'];//サロンid
			g_salon_name=json_data['salon_name'];//サロンid
			g_user_ai=0;//ユーザーai
			g_order_ai=0;//予約ai
			g_ary_div_page=['div_page_timetable'];//ページ遷移 管理配列 
			//
			$('#spn_salon_id').html(g_salon_id);
			$('.spn_salon_name').html(g_salon_name);
			$('#ahr_zoom').prop('href',json_data['salon_zoom']);//Zoomリンク
			$('#tbl_timetable').children('tbody').empty().append(json_data['tbody']);//既存のタイムテーブルクリア→新結果出力
		}else{
			alert(json_data['msg'],'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_ready()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//顧客管理ボタン
function fnc_btn_manage_user(e,a_this){
	//alert('fnc_btn_manage_user()');return;
	obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
	obj_div_page_next=$('#div_page_manage_user');//次ページdivのobj
	g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

	//ページ切り替え
	obj_div_page_next.css('display','block');//次ページを表示
	obj_div_page_cur.css('display','none');//現ページを非表示
}

///////////////////////////////////////////////////////////////////////////
//予約/カルテ管理 ボタン
function fnc_btn_manage_order(e,a_this){
	//alert('fnc_btn_manage_order()');return;
	obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
	obj_div_page_next=$('#div_page_manage_order');//次ページdivのobj
	g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

	//ページ切り替え
	obj_div_page_next.css('display','block');//次ページを表示
	obj_div_page_cur.css('display','none');//現ページを非表示
}

///////////////////////////////////////////////////////////////////////////
//タイムテーブル：日付変更択
function fnc_tdt_timetable(e,a_this){
	//alert('fnc_tdt_timetable');return;

	fnc_btn_search_general_timetable(e,a_this);//汎用タイムテーブル検索（日付・検索キーワード）

}

///////////////////////////////////////////////////////////////////////////
//タイムテーブル：検索ボタン
function fnc_btn_search_tt(e,a_this){
	//alert('fnc_btn_search_tt()');return;

	fnc_btn_search_general_timetable(e,a_this);//汎用タイムテーブル検索（日付・検索キーワード）
}

///////////////////////////////////////////////////////////////////////////
//タイムテーブル日付移動「←」「→」ボタン
function fnc_btn_timetable_date(e,a_this){
	//alert('fnc_btn_timetable_date()');return;

	tdt_timetable=$('#tdt_timetable').val();//日付（-区切）
	day_move=parseInt(a_this.val());//「-1」or「1」
	
	ary=tdt_timetable.split('-');//年 月 日 分割
	if(ary.length==3){
		obj_date= new Date(ary[0],ary[1]-1,ary[2]);
  	obj_date.setDate(obj_date.getDate()+day_move);//日付移動
  	
  	s_date=obj_date.getFullYear()+'-'+( ("0"+(obj_date.getMonth()+1)).slice(-2))+'-'+(("0"+obj_date.getDate()).slice(-2));//sliceは2桁化

  	$('#tdt_timetable').val(s_date);//日付（-区切）
		fnc_btn_search_general_timetable(e,a_this);//汎用タイムテーブル検索（日付・検索キーワード）
	}
	

}

///////////////////////////////////////////////////////////////////////////
//汎用タイムテーブル検索（日付・検索キーワード）
function fnc_btn_search_general_timetable(e,a_this){
	//alert('fnc_btn_search_general_timetable');return;

	var asc_post={};
	asc_post['act']='btn_search_general_timetable';
	asc_post['js_salon_id']=g_salon_id;
	asc_post['tdt_timetable']=$('#tdt_timetable').val();//日付（-区切）
	asc_post['txt_search_tt_word']=$('#txt_search_tt_word').val();//検索キーワード
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			$('#tbl_timetable').children('tbody').empty().append(json_data['tbody']);//既存のタイムテーブルクリア→新結果出力
		}else{
			alert(json_data['msg'],'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_search_general_timetable()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//トップページ（div_page_timetable）：Squareダッシュボード
function fnc_btn_go_square_dashboard(){

	window.open('https://squareup.com/login','Squareダッシュボード');

}

///////////////////////////////////////////////////////////////////////////
//予約/カルテ管理：検索ボタン
function fnc_btn_search_order(e,a_this){
	//alert('fnc_btn_search_order()');return;

	fnc_btn_search_general_order(e,a_this);//汎用予約/カルテ検索（日付・検索キーワード）
}

///////////////////////////////////////////////////////////////////////////
//汎用予約/カルテ検索（日付・検索キーワード）
function fnc_btn_search_general_order(e,a_this){
	//alert('fnc_btn_search_general_order()');return;

	var asc_post={};
	asc_post['act']='btn_search_general_order';
	asc_post['js_salon_id']=g_salon_id;
	asc_post['txt_search_order']=$('#txt_search_order').val();//検索キーワード
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			$('#tbl_manage_order').children('tbody').empty().append(json_data['tbody']);//既存のタイムテーブルクリア→新結果出力
		}else{
			alert(json_data['msg'],'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_search_general_order()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//顧客管理：検索ボタン
function fnc_btn_search_user(e,a_this){
	//alert('fnc_btn_search_user()');return;

	var asc_post={};
	asc_post['act']='btn_search_user';
	asc_post['js_salon_id']=g_salon_id;
	asc_post['txt_search_user']=$('#txt_search_user').val();
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			$('#tbl_manage_user').children('tbody').empty().append(json_data['tbody']);//既存の検索結果クリア→検索結果出力
		}else{
			alert(json_data['msg'],'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_search_user()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//顧客管理（一覧）：新規顧客ボタン
function fnc_btn_add_user(e,a_this){
	//alert('fnc_btn_add_user()');return;

	//ページ遷移設定（次）
	obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
	obj_div_page_next=$('#div_page_edit_user');//次ページdivのobj
	g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

	//次ページ設定
	g_user_ai=0;//ユーザーai（0…新規）
	fnc_reset_ui(obj_div_page_next);//次ページのUIパーツをリセットする
	$('#div_page_edit_user').find('.spn_ope').html('新規');//操作名
	$('#div_page_edit_user').find('.spn_user_id').html('―');//新規時user_idは決まっていない
	$('#lbl_delete_user').css('display','none');//削除確認用チェックボックス 非表示
	$('#btn_reg_user').html('登録');//登録ボタン名設定

	//ページ遷移
	obj_div_page_next.css('display','block');//次ページを表示
	obj_div_page_cur.css('display','none');//現ページを非表示

}

///////////////////////////////////////////////////////////////////////////
//顧客管理：編集ボタン
function fnc_btn_edit_user(e,a_this){
	btn_user_ai=a_this.val();//ユーザーai
	//alert('fnc_btn_edit_user('+btn_user_ai+')');return;

	g_user_ai=btn_user_ai;//ユーザーai

	asc_post={};
	asc_post['act']='btn_edit_user';
	asc_post['js_user_ai']=g_user_ai;//user_ai
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_edit_user');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

			//DB値復元
			$.each(json_data,
				function(fld,term){
					if((fld.indexOf('txt_')==0)||(fld.indexOf('txd_')==0)){//type=text,date時
						$('#div_page_edit_user').find('.'+fld).val(term);
					}else if(fld.indexOf('rdo_')==0){//type=radio時
						$('#div_page_edit_user').find('input[name="'+fld+'"][value="'+term+'"]').prop('checked',true);
					}else if(fld.indexOf('spn_')==0){//span時
						$('#div_page_edit_user').find('.'+fld).html(term);
					}
				}
			);
			//
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg'],'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_edit_user()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//顧客管理：予約新規ボタン
function fnc_btn_add_order(e,a_this){
	btn_user_ai=a_this.val();//ユーザーai
	//alert('fnc_btn_add_order('+btn_user_ai+')');return;

	g_user_ai=btn_user_ai;//ユーザーai
	g_order_ai=0;//予約ai(0=新規) 

	asc_post={};
	asc_post['act']='btn_add_order';
	asc_post['js_user_ai']=g_user_ai;//ユーザーai
	asc_post['js_order_ai']=g_order_ai;//予約ai(=0 新規)
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_add_order');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

			//次ページ設定
			$('#tr_add_order').empty().append(json_data['tr_child']);//既存の状態クリア→ボタン状況出力 ※#tbl_add_orderは1行だけのため直tr指定

			//ページ遷移
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示

		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_add_order()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//顧客管理：（新規・編集・削除）：登録ボタン
function fnc_btn_reg_user(e,a_this){
	//alert('fnc_btn_reg_user()');return;

	//salon_id設定
	salon_id=g_salon_id;
	if(g_user_ai>0){//既存user_aiなら
		salon_id=-1;//salon_idはuser_aiから引けるので
	}

	//
	var asc_post={};
	asc_post['act']='btn_reg_user';
	//js_user_ai>0時は-1
	asc_post['js_salon_id']=salon_id;//ユーザーai>0 時は-1
	asc_post['js_user_ai']=g_user_ai;//対象 ユーザーai（0…新規）
	asc_post['txt_user_name']=$('#div_page_edit_user').find('.txt_user_name').val();//ユーザー名前
	asc_post['txt_user_yomi']=$('#div_page_edit_user').find('.txt_user_yomi').val();//ユーザーフリガナ
	asc_post['txd_user_birthday']=$('#div_page_edit_user').find('.txd_user_birthday').val();//ユーザー生年月日
	asc_post['txt_user_email']=$('#div_page_edit_user').find('.txt_user_email').val();//ユーザーemail
	asc_post['txt_user_tel']=$('#div_page_edit_user').find('.txt_user_tel').val();//ユーザーTEL
	asc_post['txt_user_hpid']=$('#div_page_edit_user').find('.txt_user_hpid').val();//ユーザー ホットペッパーID
	asc_post['txt_user_sex']=$("input[name='rdo_edit_user_sex']:checked").val();//ユーザー性別（女=1,男=2）
	asc_post['cbx_delete_user']=$('#cbx_delete_user').prop('checked');//削除する('true'/'false')
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（戻る）
			id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
			id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid

			//
			ope_code=json_data['ope_code'];//操作コード（ADD/EDIT/DEL）
			if(ope_code=='ADD'){//顧客追加時
				$('#txt_search_user').val(json_data['txt_search_user']);//検索語句設定
			}else if(ope_code=='EDIT'){
			}else if(ope_code=='DEL'){
			}
			$('#btn_search_user').trigger('click');//div_page_manage_userの検索ボタンを押す（編集結果の反映）

			//
			$('#'+id_div_page_back).css('display','block');//戻りページを表示
			$('#'+id_div_page_cur).css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_reg_user()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//顧客管理（div_page_edit_user）：顧客削除チェックボックス
function fnc_cbx_delete_user(){
	//alert('fnc_cbx_delete_user()');return;
	
	if($('#cbx_delete_user').prop('checked')){//顧客削除チェックボックス オン
		$('#btn_reg_user').html('削除実行');
	}else{//顧客削除チェックボックス オフ
		$('#btn_reg_user').html('登録');
	}
}

///////////////////////////////////////////////////////////////////////////
//カウンセリング日時：編集ボタン
function fnc_btn_edit_order_counsel_datetime(e,a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_edit_order_counsel_datetime(order_ai='+order_ai+')');return;

	//user_ai設定
	g_order_ai=btn_order_ai;//予約ai
	if(btn_order_ai>0){//既存の予約aiなら
		g_user_ai=-1;//ユーザーai（予約aiより参照）
	}

	var asc_post={};
	asc_post['act']='btn_edit_order_counsel_datetime';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_edit_order_counsel_datetime');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

			//次ページ設定
			if(g_order_ai==0){//予約ai=0：新規
				obj_div_page_next.find('.spn_ope').html('新規');
			}else{
				obj_div_page_next.find('.spn_ope').html('編集');
			}
			//
			obj_div_page_next.find('.spn_user_id').html(json_data['spn_user_id']);//顧客ID
			obj_div_page_next.find('.spn_user_name').html(json_data['spn_user_name']);//顧客名前
			obj_div_page_next.find('.tdl_order_counsel_datetime').val(json_data['tdl_order_counsel_datetime']);//予約日時
			obj_div_page_next.find('.txt_order_counsel_stylist').val(json_data['txt_order_counsel_stylist']);//担当者
			//
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_edit_order_counsel_datetime()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//カウンセリング日時予約：登録ボタン
function fnc_btn_reg_order_counsel_datetime(e,a_this){
	//alert('fnc_btn_reg_order_counsel_datetime()');return;

	//
	var asc_post={};
	asc_post['act']='btn_reg_order_counsel_datetime';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	asc_post['tdl_order_counsel_datetime']=$('#div_page_edit_order_counsel_datetime').find('.tdl_order_counsel_datetime').val();//予約日時
	asc_post['txt_order_counsel_stylist']=$('#div_page_edit_order_counsel_datetime').find('.txt_order_counsel_stylist').val();//担当者
	asc_post['id_div_page_back']=g_ary_div_page[g_ary_div_page.length-2];//戻りページ(2つ前)divのid
	asc_post['cbx_delete_user']=$('#cbx_delete_user').prop('checked');//削除する('true'/'false')
	//alert(print_r(asc_post));//return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（戻る）
			id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
			id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
			//
			if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
				$('#btn_search_tt').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）

			}else if(id_div_page_back=='div_page_add_order'){//戻りページ＝予約新規
				if(g_order_ai==0){//予約ai(0=新規) ならば
					g_order_ai=json_data['inserted_order_ai'];//予約ai差し替え
				}
				$('#tr_add_order').empty().append(json_data['tr_child']);//既存の状態クリア→ボタン状況出力 ※#tbl_add_orderは1行だけのため直tr指定
			}
			//
			$('#'+id_div_page_back).css('display','block');//戻りページを表示
			$('#'+id_div_page_cur).css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_reg_user()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//カウンセリング回答：閲覧ボタン
function fnc_btn_show_order_counsel_result(e,a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_show_order_counsel_result(btn_order_ai='+btn_order_ai+')');return;

	g_user_ai=-1;//ユーザーai（予約aiより参照）
	g_order_ai=btn_order_ai;//予約ai
	transition='NEXT';//show時はNEXT、reg時はBACK

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	fnc_set_page_show_order_counsel_result(g_order_ai,g_user_ai,transition);
	$('#div_loading').fadeOut(500);

}

///////////////////////////////////////////////////////////////////////////
//カウンセリング回答：閲覧ページ設定
//a_order_ai=0時はa_user_ai>0,a_order_ai>0時はa_user_ai>-1
//a_transition NEXT/BACK show時はNEXT、reg時はBACK
function fnc_set_page_show_order_counsel_result(a_order_ai,a_user_ai,a_transition){
	rand=Math.ceil(Math.random()*100);//キャッシュクリア用
	//
	var asc_post={};
	asc_post['act']='set_page_show_order_counsel_result';
	asc_post['js_user_ai']=a_user_ai;
	asc_post['js_order_ai']=a_order_ai;
	//alert(print_r(asc_post));return;//debug

	//プログレスしない
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//閲覧ページ表示設定
			obj_div_page_show=$('#div_page_show_order_counsel_result');//表示設定する閲覧ページ
			$.each(json_data,//DB値復元
				function(fld,val){
					if(fld.indexOf('spn_')==0){//spn時
						obj_div_page_show.find('.'+fld).html(val);
					}
				}
			);
			$('#div_show_order_flg_counsel_yet').html(json_data['order_flg_counsel_yet']==true ? '★一時保存状態' : '');//一時保存状態
			$('#div_show_order_counsel_result').html(json_data['div_show_order_counsel_result']);//カウンセリング回答 内容
			obj_div_page_show.find('.btn_edit_order_counsel_result').val(a_order_ai);//★新規時は問題あり

			//ページ遷移
			if(a_transition=='NEXT'){//次ページに進む---------------------------------------------------
				obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
				g_ary_div_page.push(obj_div_page_show.prop('id'));//ページ遷移 管理配列
				//
				obj_div_page_show.css('display','block');//閲覧ページを表示
				obj_div_page_cur.css('display','none');//現ページを非表示

			}else if(a_transition=='BACK'){//前ページ（＝閲覧ページ）に戻る-----------------------------
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
				//
				$('#'+id_div_page_back).css('display','block');//戻りページを表示
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示
			}
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_set_page_show_order_counsel_result()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//カウンセリング回答：編集ボタン
function fnc_btn_edit_order_counsel_result(e,a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_edit_order_counsel_result(order_ai='+btn_order_ai+')');return;

	//user_ai設定
	g_order_ai=btn_order_ai;//予約ai
	if(btn_order_ai>0){//既存の予約aiなら
		g_user_ai=-1;//ユーザーai（予約aiより参照）
	}

	var asc_post={};
	asc_post['act']='btn_edit_order_counsel_result';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_edit_order_counsel_result');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

			//次ページ設定
			obj_div_page_next.find('.spn_user_id').html(json_data['spn_user_id']);
			obj_div_page_next.find('.spn_user_name').html(json_data['spn_user_name']);
			$('#order_flg_counsel_yet').prop('checked',json_data['order_flg_counsel_yet']==true);//一時保存状態
			$('#div_edit_order_counsel_result').html(json_data['div_edit_order_counsel_result']);//カウンセリング回答 内容

			//ページ遷移
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_edit_order_counsel_result()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//カウンセリング回答：登録ボタン
function fnc_btn_reg_order_counsel_result(e,a_this){
	//alert('fnc_btn_reg_order_counsel_result()');return;
	//
	id_div_page_back=g_ary_div_page[g_ary_div_page.length-2];//戻りページ(2つ前)divのid
	//
	var asc_post={};
	asc_post['act']='btn_reg_order_counsel_result';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	asc_post['id_div_page_back']=id_div_page_back;
	asc_post['order_flg_counsel_yet']=$('#order_flg_counsel_yet').prop('checked')?1:0;//cbx一時保存

	fc_set_asc_order_counsel_result(asc_post);//指定ascにカウンセリング回答を設定
	//asc_post['cbx_delete_user']=$('#cbx_delete_user').prop('checked');//削除する('true'/'false')
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//
			if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
				$('#btn_search_tt').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）
				//戻りページ処理
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				$('#'+id_div_page_back).css('display','block');//戻りページを表示（冒頭で設定済み）
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示

			}else if(id_div_page_back=='div_page_add_order'){//戻りページ＝予約新規
				if(g_order_ai==0){//予約ai(0=新規) ならば
					g_order_ai=json_data['order_ai'];//予約ai差し替え
				}
				$('#tr_add_order').empty().append(json_data['tr_child']);//既存の状態クリア→ボタン状況出力 ※#tbl_add_orderは1行だけのため直tr指定
				//戻りページ処理
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				$('#'+id_div_page_back).css('display','block');//戻りページを表示（冒頭で設定済み）
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示

			}else if(id_div_page_back=='div_page_show_order_counsel_result'){//戻りページ＝カウンセリング回答 閲覧
				transition='BACK';//show時はNEXT、reg時はBACK
				fnc_set_page_show_order_counsel_result(g_order_ai,g_user_ai,transition);//閲覧データ設定

			}
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_reg_order_counsel_result()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//指定ascにカウンセリング回答を設定（post_uiクラスを収集）
//カウンセリング回答（div_page_edit_order_counsel_result）
function fc_set_asc_order_counsel_result(a_asc_post){
	asc_post=a_asc_post;//設定結果は関数抜けた後も反映されている

	//写真----------------------------------------------------------------------------------
	//.div_photo_picker　id=gruop_code(ptp_goal_hair_style,ptp_goal_hair_color1)
	$('#div_page_edit_order_counsel_result').find('.div_photo_picker').each(function(div_idx,div_obj){
		gruop_code=$(div_obj).prop('id');//ptp_goal_hair_style,ptp_goal_hair_color1
		$(div_obj).find('img').each(function(img_idx,img_obj){
			asc_post[gruop_code+'-'+(img_idx+1)]=$(img_obj).prop('src');
		});
	});

	//チェック系（rdo,cbx）の処理-----------------------------------------------------------
	gt_cbx_id='';//GT的処理
	cbx_values='';//選択項目（,区切）
 	$('#div_page_edit_order_counsel_result').find('.post_ui:checked').each(function(idx,obj){
		ui_class=$(obj).prop('class');
		ui_class=ui_class.replace('post_ui ','');//「post_ui 」除去
		if(ui_class.indexOf('rdo_')===0){//radioボタン時
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('cbx_')===0){//checkbox時
			if(gt_cbx_id!=ui_class){//グループが変わった
				if(gt_cbx_id!=''){//gt_cbx_idが空欄でない（=設定済みcbxがある）
					asc_post[gt_cbx_id]=cbx_values+',';//設定済みcbx出力 ※末尾にも,付加
				}
				//グループ更新
				gt_cbx_id=ui_class;
				cbx_values='';
			}
			cbx_values+=','+$(obj).val();//,区切 ※先頭にも,付加
		}
	});
	
	//GT後処理(cbx)
	if(cbx_values!=''){
		asc_post[gt_cbx_id]=cbx_values+',';//設定済みcbx出力 ※末尾にも,付加
	}

	//非チェック系（input type=text,textarea）の処理-----------------------------------------------------------
 	$('#div_page_edit_order_counsel_result').find('.post_ui').each(function(idx,obj){
		ui_class=$(obj).prop('class');
		ui_class=ui_class.replace('post_ui ','');//「post_ui 」除去
		if(ui_class.indexOf('txt_')===0){//input type=text時
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('tta_')===0){//textarea時
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('tac_')===0){//textarea コンサル用 時
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('ptp_')===0){//photo-picker時
			//fff
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//事前決済：編集ボタン
function fnc_btn_edit_order_prepaid(e,a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_edit_order_prepaid(order_ai='+btn_order_ai+')');return;

	//user_ai設定
	g_order_ai=btn_order_ai;//予約ai
	if(btn_order_ai>0){//既存の予約aiなら
		g_user_ai=-1;//ユーザーai（予約aiより参照）
	}

	var asc_post={};
	asc_post['act']='btn_edit_order_prepaid';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_edit_order_prepaid');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

			//次ページ設定
			if(g_order_ai==0){//予約ai=0：新規
				obj_div_page_next.find('.spn_ope').html('新規');
			}else{
				obj_div_page_next.find('.spn_ope').html('編集');
			}
			//DB値復元
			obj_div_page_next.find('.spn_user_id').html(json_data['spn_user_id']);
			obj_div_page_next.find('.spn_user_name').html(json_data['spn_user_name']);
			obj_div_page_next.find('.tta_order_ope_menu').val(json_data['tta_order_ope_menu']);
			obj_div_page_next.find('.txt_order_prepaid_price').val(json_data['txt_order_prepaid_price']);
			obj_div_page_next.find('.cbx_order_flg_prepaid_sent').prop('checked',parseInt(json_data['cbx_order_flg_prepaid_sent']));
			obj_div_page_next.find('.cbx_order_flg_prepaid_done').prop('checked',parseInt(json_data['cbx_order_flg_prepaid_done']));

			//ページ遷移
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_edit_order_prepaid()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//事前決済：登録ボタン
function fnc_btn_reg_order_prepaid(e,a_this){
	//alert('fnc_btn_reg_order_prepaid(g_user_ai='+g_user_ai+' g_order_ai='+g_order_ai+')');return;

	//
	var asc_post={};
	asc_post['act']='btn_reg_order_prepaid';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	asc_post['tta_order_ope_menu']=$('#div_page_edit_order_prepaid').find('.tta_order_ope_menu').val();//メニュー内容
	asc_post['txt_order_prepaid_price']=$('#div_page_edit_order_prepaid').find('.txt_order_prepaid_price').val();//決済金額
	asc_post['cbx_order_flg_prepaid_sent']=$('#div_page_edit_order_prepaid').find('.cbx_order_flg_prepaid_sent').prop('checked')?1:0;//請求メール送付済み
	asc_post['cbx_order_flg_prepaid_done']=$('#div_page_edit_order_prepaid').find('.cbx_order_flg_prepaid_done').prop('checked')?1:0;//決済済み
	asc_post['id_div_page_back']=g_ary_div_page[g_ary_div_page.length-2];//戻りページ(2つ前)divのid
	//asc_post['cbx_delete_user']=$('#cbx_delete_user').prop('checked');//削除する('true'/'false')
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（戻る）
			id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
			id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
			//
			if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
				$('#btn_search_tt').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）

			}else if(id_div_page_back=='div_page_add_order'){//戻りページ＝予約新規
				if(g_order_ai==0){//予約ai(0=新規) ならば
					g_order_ai=json_data['inserted_order_ai'];//予約ai差し替え
				}
				$('#tr_add_order').empty().append(json_data['tr_child']);//既存の状態クリア→ボタン状況出力 ※#tbl_add_orderは1行だけのため直tr指定
			}
			//
			$('#'+id_div_page_back).css('display','block');//戻りページを表示
			$('#'+id_div_page_cur).css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_reg_user()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//施術：閲覧ボタン
function fnc_btn_show_order_ope(e,a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_show_order_ope(btn_order_ai='+btn_order_ai+')');return;

	g_user_ai=-1;//ユーザーai（予約aiより参照）
	g_order_ai=btn_order_ai;//予約ai
	transition='NEXT';//show時はNEXT、reg時はBACK

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	fnc_set_page_show_order_ope(g_order_ai,g_user_ai,transition);
	$('#div_loading').fadeOut(500);

}

///////////////////////////////////////////////////////////////////////////
//施術：編集ボタン
function fnc_btn_edit_order_ope(e,a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_edit_order_ope(order_ai='+btn_order_ai+')');return;

	//user_ai設定
	g_order_ai=btn_order_ai;//予約ai
	if(btn_order_ai>0){//既存の予約aiなら
		g_user_ai=-1;//ユーザーai（予約aiより参照）
	}

	var asc_post={};
	asc_post['act']='btn_edit_order_ope';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_edit_order_ope');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

			//次ページ設定
			if(g_order_ai==0){//予約ai=0：新規
				obj_div_page_next.find('.spn_ope').html('新規');
			}else{
				obj_div_page_next.find('.spn_ope').html('編集');
			}
			//
			obj_div_page_next.find('.spn_user_id').html(json_data['spn_user_id']);//顧客ID
			obj_div_page_next.find('.spn_user_name').html(json_data['spn_user_name']);//顧客名前
			obj_div_page_next.find('.txt_order_ope_stylist').val(json_data['txt_order_ope_stylist']);//施術担当者
			obj_div_page_next.find('.tdl_order_visit_datetime').val(json_data['tdl_order_visit_datetime']);//来店日時
			obj_div_page_next.find('.tta_order_ope_menu').val(json_data['tta_order_ope_menu']);//施術メニュー
			obj_div_page_next.find('.txt_order_ope_price').val(json_data['txt_order_ope_price']);//施術金額
			//
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_edit_order_ope()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		//console.log("XMLHttpRequest : " + XMLHttpRequest.status);
		//console.log("textStatus     : " + textStatus);
		//console.log("errorThrown    : " + errorThrown.message);
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//施術：登録ボタン
function fnc_btn_reg_order_ope(e,a_this){
	//alert('fnc_btn_reg_order_ope()');return;
	//
	id_div_page_back=g_ary_div_page[g_ary_div_page.length-2];//戻りページ(2つ前)divのid
	//
	var asc_post={};
	asc_post['act']='btn_reg_order_ope';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	asc_post['txt_order_ope_stylist']=$('#div_page_edit_order_ope').find('.txt_order_ope_stylist').val();//施術担当者
	asc_post['tdl_order_visit_datetime']=$('#div_page_edit_order_ope').find('.tdl_order_visit_datetime').val();//来店日時
	asc_post['tta_order_ope_menu']=$('#div_page_edit_order_ope').find('.tta_order_ope_menu').val();//メニュー内容
	asc_post['txt_order_ope_price']=$('#div_page_edit_order_ope').find('.txt_order_ope_price').val();//担当者
	asc_post['id_div_page_back']=g_ary_div_page[g_ary_div_page.length-2];//戻りページ(2つ前)divのid
	asc_post['cbx_delete_user']=$('#cbx_delete_user').prop('checked');//削除する('true'/'false')
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//
			if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
				$('#btn_search_tt').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）
				//戻りページ処理
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				$('#'+id_div_page_back).css('display','block');//戻りページを表示（冒頭で設定済み）
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示

			}else if(id_div_page_back=='div_page_add_order'){//戻りページ＝予約新規
				if(g_order_ai==0){//予約ai(0=新規) ならば
					g_order_ai=json_data['inserted_order_ai'];//予約ai差し替え
				}
				$('#tr_add_order').empty().append(json_data['tr_child']);//既存の状態クリア→ボタン状況出力 ※#tbl_add_orderは1行だけのため直tr指定
				//戻りページ処理
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				$('#'+id_div_page_back).css('display','block');//戻りページを表示（冒頭で設定済み）
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示

			}else if(id_div_page_back=='div_page_show_order_ope'){//戻りページ＝施術閲覧
				transition='BACK';//show時はNEXT、reg時はBACK
				fnc_set_page_show_order_ope(g_order_ai,g_user_ai,transition);//閲覧データ設定
			}
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_reg_order_ope()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//カルテ：閲覧ボタン
function fnc_btn_show_order_karte(e,a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_show_order_karte(btn_order_ai='+btn_order_ai+')');return;

	g_user_ai=-1;//ユーザーai（予約aiより参照）
	g_order_ai=btn_order_ai;//予約ai
	transition='NEXT';//show時はNEXT、reg時はBACK

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	fnc_set_page_show_order_karte(g_order_ai,g_user_ai,transition);
	$('#div_loading').fadeOut(500);

}

///////////////////////////////////////////////////////////////////////////
//施術：閲覧ページ設定
//a_order_ai=0時はa_user_ai>0,a_order_ai>0時はa_user_ai>-1
//a_transition NEXT/BACK show時はNEXT、reg時はBACK
function fnc_set_page_show_order_ope(a_order_ai,a_user_ai,a_transition){
	//
	var asc_post={};
	asc_post['act']='set_page_show_order_ope';
	asc_post['js_user_ai']=a_user_ai;
	asc_post['js_order_ai']=a_order_ai;
	//alert(print_r(asc_post));return;//debug

	//プログレスしない
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//閲覧ページ表示設定
			obj_div_page_show=$('#div_page_show_order_ope');//表示設定する閲覧ページ
			$.each(json_data,//DB値復元
				function(fld,val){
					if(fld.indexOf('spn_')==0){//spn時
						obj_div_page_show.find('.'+fld).html(val);
					}
				}
			);
			obj_div_page_show.find('.btn_edit_order_ope').val(a_order_ai);//★新規時は問題あり

			//ページ遷移
			if(a_transition=='NEXT'){//次ページに進む---------------------------------------------------
				obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
				g_ary_div_page.push(obj_div_page_show.prop('id'));//ページ遷移 管理配列
				//
				obj_div_page_show.css('display','block');//閲覧ページを表示
				obj_div_page_cur.css('display','none');//現ページを非表示

			}else if(a_transition=='BACK'){//前ページ（＝閲覧ページ）に戻る-----------------------------
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
				//
				$('#'+id_div_page_back).css('display','block');//戻りページを表示
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示
			}
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_set_page_show_order_ope()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}


///////////////////////////////////////////////////////////////////////////
//カルテ：閲覧ページ設定
//a_order_ai=0時はa_user_ai>0,a_order_ai>0時はa_user_ai>-1
//a_transition NEXT/BACK show時はNEXT、reg時はBACK
function fnc_set_page_show_order_karte(a_order_ai,a_user_ai,a_transition){
	rand=Math.ceil(Math.random()*100);//キャッシュクリア用
	//
	var asc_post={};
	asc_post['act']='set_page_show_order_karte';
	asc_post['js_user_ai']=a_user_ai;
	asc_post['js_order_ai']=a_order_ai;
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//閲覧ページ表示設定
			obj_div_page_show=$('#div_page_show_order_karte');//表示設定する閲覧ページ
			$.each(json_data,//DB値復元
				function(fld,val){
					if(fld.indexOf('spn_')==0){//spn時
						obj_div_page_show.find('.'+fld).html(val);

					}else if(fld.indexOf('ptp_')==0){//ptp時 valは画像枚数
						obj_div_page_show.find('.'+fld).empty();
						if(val==0){//写真枚数=0
							obj_div_page_show.find('.'+fld).html('なし');

						}else{//画像枚数>0
							for(photo_sn=1;photo_sn<=val;photo_sn++){//画像枚数分ループ
								gruop_code=fld;
								url_img='photo/order/'+'p'+a_order_ai+'_'+gruop_code+'-'+photo_sn+'.jpg?'+rand;//画像のURL
								$('<img>').prop('src',url_img).appendTo(obj_div_page_show.find('.'+gruop_code));//imgタグ追加＝画像の表示
							}
						}
					}
				}
			);
			$('#div_show_order_karte').html(json_data['div_show_order_karte']);//カルテ 内容
			obj_div_page_show.find('.btn_edit_order_karte').val(a_order_ai);//★新規時は問題あり

			//ページ遷移
			if(a_transition=='NEXT'){//次ページに進む---------------------------------------------------
				obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
				g_ary_div_page.push(obj_div_page_show.prop('id'));//ページ遷移 管理配列
				//
				obj_div_page_show.css('display','block');//閲覧ページを表示
				obj_div_page_cur.css('display','none');//現ページを非表示

			}else if(a_transition=='BACK'){//前ページ（＝閲覧ページ）に戻る-----------------------------
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
				//
				$('#'+id_div_page_back).css('display','block');//戻りページを表示
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示
			}
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_set_page_show_order_karte()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//カルテ：編集ボタン
function fnc_btn_edit_order_karte(e,a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_edit_order_karte(order_ai='+btn_order_ai+')');return;

	//user_ai設定
	g_order_ai=btn_order_ai;//予約ai
	if(btn_order_ai>0){//既存の予約aiなら
		g_user_ai=-1;//ユーザーai（予約aiより参照）
	}

	var asc_post={};
	asc_post['act']='btn_edit_order_karte';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	//alert(print_r(asc_post)+'@fnc_btn_edit_order_karte');return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_edit_order_karte');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

			//次ページ設定
			if(g_order_ai==0){//予約ai=0：新規
				obj_div_page_next.find('.spn_ope').html('新規');
			}else{
				obj_div_page_next.find('.spn_ope').html('編集');
			}
			obj_div_page_next.find('.spn_user_id').html(json_data['spn_user_id']);
			obj_div_page_next.find('.spn_user_name').html(json_data['spn_user_name']);
			obj_div_page_next.find('.tdl_order_visit_datetime').val(json_data['tdl_order_visit_datetime']);
			obj_div_page_next.find('.tta_order_ope_menu').val(json_data['tta_order_ope_menu']);
			obj_div_page_next.find('.txt_order_ope_stylist').val(json_data['txt_order_ope_stylist']);
			obj_div_page_next.find('.txt_order_ope_price').val(json_data['txt_order_ope_price']);
			$('#div_edit_order_karte').html(json_data['div_edit_order_karte']);//カルテ内容
			//
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_edit_order_karte()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//カルテ：登録ボタン
function fnc_btn_reg_order_karte(e,a_this){
	//alert('fnc_btn_reg_order_karte()');return;
	//
	id_div_page_back=g_ary_div_page[g_ary_div_page.length-2];//戻りページ(2つ前)divのid
	//
	var asc_post={};
	asc_post['act']='btn_reg_order_karte';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	asc_post['id_div_page_back']=id_div_page_back;

	asc_post['tdl_order_visit_datetime']=$('#div_page_edit_order_karte').find('.tdl_order_visit_datetime').val();//来店日時
	asc_post['tta_order_ope_menu']=$('#div_page_edit_order_karte').find('.tta_order_ope_menu').val();//メニュー内容
	asc_post['txt_order_ope_stylist']=$('#div_page_edit_order_karte').find('.txt_order_ope_stylist').val();//施術担当者
	asc_post['txt_order_ope_price']=$('#div_page_edit_order_karte').find('.txt_order_ope_price').val();//施術金額

	fc_set_asc_order_karte(asc_post);//指定ascにカルテを設定
	//asc_post['cbx_delete_user']=$('#cbx_delete_user').prop('checked');//削除する('true'/'false')
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//
			if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
				$('#btn_search_tt').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）
				//戻りページ処理
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				$('#'+id_div_page_back).css('display','block');//戻りページを表示（冒頭で設定済み）
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示

			}else if(id_div_page_back=='div_page_add_order'){//戻りページ＝予約新規
				if(g_order_ai==0){//予約ai(0=新規) ならば
					g_order_ai=json_data['order_ai'];//予約ai差し替え
				}
				$('#tr_add_order').empty().append(json_data['tr_child']);//既存の状態クリア→ボタン状況出力 ※#tbl_add_orderは1行だけのため直tr指定
				//戻りページ処理
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				$('#'+id_div_page_back).css('display','block');//戻りページを表示（冒頭で設定済み）
				$('#'+id_div_page_cur).css('display','none');//現ページを非表示

			}else if(id_div_page_back=='div_page_show_order_karte'){//戻りページ＝カルテ 閲覧
				transition='BACK';//show時はNEXT、reg時はBACK
				fnc_set_page_show_order_karte(g_order_ai,g_user_ai,transition);//閲覧データ設定

			}
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_reg_order_karte()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//サロン情報：閲覧ボタン
function fnc_btn_show_salon_data(e,a_this){
	rand=Math.ceil(Math.random()*100);//キャッシュクリア用
	//alert('fnc_btn_show_salon_data()');return;

	var asc_post={};
	asc_post['act']='btn_show_salon_data';
	asc_post['js_salon_id']=g_salon_id;
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_show_salon_data');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

			//次ページ設定
			$.each(json_data,//DB値復元
				function(fld,val){
					if(fld.indexOf('spn_')==0){//spn時
						obj_div_page_next.find('.'+fld).html(val);

					}else if(fld.indexOf('ptp_')==0){//ptp時 valは画像枚数
						obj_div_page_next.find('.'+fld).empty();
						if(val==0){//写真枚数=0
							obj_div_page_next.find('.'+fld).html('なし');

						}else{//画像枚数>0
							for(photo_sn=1;photo_sn<=val;photo_sn++){//画像枚数分ループ
								gruop_code=fld;
								url_img='photo/salon/'+'p'+g_salon_id+'_'+gruop_code+'-'+photo_sn+'.jpg?'+rand;//画像のURL
								$('<img>').prop('src',url_img).appendTo(obj_div_page_next.find('.'+gruop_code));//imgタグ追加＝画像の表示
							}
						}
					}
				}
			);

			//ページ遷移
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_show_salon_data()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//指定ascにカルテを設定（post_uiクラスを収集）
//カルテ（div_page_edit_order_karte）
function fc_set_asc_order_karte(a_asc_post){
	asc_post=a_asc_post;//設定結果は関数抜けた後も反映されている

	//写真----------------------------------------------------------------------------------
	//.div_photo_picker　id=gruop_code(ptp_goal_hair_style,ptp_goal_hair_color1)
	$('#div_page_edit_order_karte').find('.div_photo_picker').each(function(div_idx,div_obj){
		gruop_code=$(div_obj).prop('id');//ptp_goal_hair_style,ptp_goal_hair_color1
		$(div_obj).find('img').each(function(img_idx,img_obj){
			asc_post[gruop_code+'-'+(img_idx+1)]=$(img_obj).prop('src');
		});
	});

	//チェック系（rdo,cbx）の処理-----------------------------------------------------------
	gt_cbx_id='';//GT的処理
	cbx_values='';//選択項目（,区切）
 	$('#div_page_edit_order_karte').find('.post_ui:checked').each(function(idx,obj){
		ui_class=$(obj).prop('class');
		ui_class=ui_class.replace('post_ui ','');//「post_ui 」除去
		if(ui_class.indexOf('rdo_')===0){//radioボタン時
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('cbx_')===0){//checkbox時
			if(gt_cbx_id!=ui_class){//グループが変わった
				if(gt_cbx_id!=''){//gt_cbx_idが空欄でない（=設定済みcbxがある）
					asc_post[gt_cbx_id]=cbx_values+',';//設定済みcbx出力 ※末尾にも,付加
				}
				//グループ更新
				gt_cbx_id=ui_class;
				cbx_values='';
			}
			cbx_values+=','+$(obj).val();//,区切 ※先頭にも,付加
		}
	});
	
	//GT後処理(cbx)
	if(cbx_values!=''){
		asc_post[gt_cbx_id]=cbx_values+',';//設定済みcbx出力 ※末尾にも,付加
	}

	//非チェック系（input type=text,textarea）の処理-----------------------------------------------------------
 	$('#div_page_edit_order_karte').find('.post_ui').each(function(idx,obj){
		ui_class=$(obj).prop('class');
		ui_class=ui_class.replace('post_ui ','');//「post_ui 」除去
		if(ui_class.indexOf('txt_')===0){//input type=text時
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('tta_')===0){//textarea時
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('dtf_')===0){//日付範囲（自）
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('dtt_')===0){//日付範囲（至）
			asc_post[ui_class]=$(obj).val();
		}else if(ui_class.indexOf('ptp_')===0){//photo-picker時
			//fff
		}
	});
}


///////////////////////////////////////////////////////////////////////////
//サロン情報：編集ボタン
function fnc_btn_edit_salon_data(e,a_this){
	rand=Math.ceil(Math.random()*100);//キャッシュクリア用

	asc_post={};
	asc_post['act']='btn_edit_salon_data';
	asc_post['js_salon_id']=g_salon_id;
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（次）
			obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
			obj_div_page_next=$('#div_page_edit_salon_data');//次ページdivのobj
			g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列
			//DB値復元
			$.each(json_data,
				function(fld,val){
					if(fld.indexOf('txt_')==0){//type=text時
						obj_div_page_next.find('.'+fld).val(val);
						
					}else if(fld.indexOf('ptp_')==0){//ptp時 valは画像枚数
						gruop_code=fld;
						obj_div_ptp=obj_div_page_next.find('.'+gruop_code);
						if(val==0){//写真枚数=0
							obj_div_ptp.empty().html('なし');

						}else{//画像枚数>0
							obj_div_ptp.html('');//コメント削除
							for(photo_sn=1;photo_sn<=val;photo_sn++){//画像枚数分ループ
								url_img='photo/salon/'+'p'+g_salon_id+'_'+gruop_code+'-'+photo_sn+'.jpg?'+rand;//画像のURL
								$('<img>').prop({"class":"img_ptp","src":url_img}).appendTo(obj_div_ptp);//imgタグ追加＝画像の表示
							}
						}
					}
				}
			);
			$('#fnc_btn_reg_salon_data').val();//登録ボタンのvalue値=
			$('#div_page_edit_salon_data').find('.cbx_mode_del_photo').prop('checked',false);//写真削除モード=オフ

			//ページ切り替え
			obj_div_page_next.css('display','block');//次ページを表示
			obj_div_page_cur.css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg'],'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_edit_salon_data()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//サロン情報：登録ボタン
function fnc_btn_reg_salon_data(e,a_this){
	//alert('fnc_btn_reg_salon_data()');return;
	rand=Math.ceil(Math.random()*100);//キャッシュクリア用

	var ary_fld_txt=['salon_name','salon_addr1','salon_addr2','salon_tel','salon_email','salon_hp','salon_insta'
		,'salon_blog','salon_youtube','salon_map','salon_zoom'];
	var ary_fld_ptp=['ptp_image','ptp_logo','ptp_karte','ptp_hp','ptp_prepaid','ptp_profile_change','ptp_thank_you'];

	//
	var asc_post={};
	asc_post['act']='btn_reg_salon_data';
	asc_post['js_salon_id']=g_salon_id;//サロンid>0
	$.each(ary_fld_txt,//input type=text
		function(fld,term){
			asc_post['txt_'+term]=$('#div_page_edit_salon_data').find('.txt_'+term).val();
		}
	);
	$.each(ary_fld_ptp,//photo_picker
		function(fld,gruop_code){
			$('#div_page_edit_salon_data').find('.'+gruop_code).find('img').each(function(img_idx,img_obj){
				asc_post[gruop_code+'-'+(img_idx+1)]=$(img_obj).prop('src');
			});
		}
	);
	//alert(print_r(asc_post));return;//debug

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
		if(json_data['debug']!='')alert(json_data['debug']);
		if(json_data['result']=='OK'){
			//ページ遷移設定（戻る）
			id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
			id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
			obj_div_page_back=$('#'+id_div_page_back);

			//戻りページ復元（サロン情報 閲覧）
			$.each(json_data,
				function(fld,term){
					if(fld.indexOf('spn_')==0){//span時
						$('#'+id_div_page_back).find('.'+fld).html(term);
					}else if(fld.indexOf('ptp_')==0){//ptp時 valは画像枚数
						obj_div_page_back.find('.'+fld).empty();
						if(term==0){//写真枚数=0
							obj_div_page_back.find('.'+fld).html('なし');

						}else{//画像枚数>0
							for(photo_sn=1;photo_sn<=term;photo_sn++){//画像枚数分ループ
								gruop_code=fld;
								url_img='photo/salon/'+'p'+g_salon_id+'_'+gruop_code+'-'+photo_sn+'.jpg?'+rand;//画像のURL
								$('<img>').prop('src',url_img).appendTo(obj_div_page_back.find('.'+gruop_code));//imgタグ追加＝画像の表示
							}
						}
					}
				}
			);
			//
			$('.spn_salon_name').html(json_data['spn_salon_name']);//サロン名は全般的に差し替え
			$('#'+id_div_page_back).css('display','block');//戻りページを表示
			$('#'+id_div_page_cur).css('display','none');//現ページを非表示
		}else{
			alert(json_data['msg']+'エラー');
			//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
		}
	}).always(function(){
		$('#div_loading').fadeOut(500);
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
		alert('サーバーエラー：fnc_btn_reg_salon_data()');
		//alert('ネット接続が不安定です。再アクセスお願いします。');
		msg_err=fnc_elminate_err_tag(XMLHttpRequest.responseText);
		console.log(msg_err);
		alert(msg_err);
	});
}

///////////////////////////////////////////////////////////////////////////
//共通処理：戻るボタン
function fnc_btn_back(e,a_this){
	//alert('fnc_btn_back()');return;

	//ページ遷移設定（戻る）
	id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
	id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid

	if(id_div_page_back=='div_page_timetable'){//戻りページ=タイムテーブル時
		$('#btn_search_tt').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）
	}

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$('#'+id_div_page_back).css('display','block');//戻りページを表示
	$('#'+id_div_page_cur).css('display','none');//現ページを非表示
	$('#div_loading').fadeOut(500);
}

///////////////////////////////////////////////////////////////////////////
//共通処理：キャンセル ボタン
function fnc_btn_cancel(e,a_this){
	//alert('fnc_btn_cancel()');return;

	//ページ遷移設定（戻る）
	id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
	id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
	
	if(id_div_page_back=='div_page_timetable'){//戻りページ=タイムテーブル時
		$('#btn_search_tt').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）
	}

	$('#div_loading').css({'left':(e.pageX-64)+'px','top':(e.pageY-64)+'px'}).show();//プログレス
	$('#'+id_div_page_back).css('display','block');//戻りページを表示
	$('#'+id_div_page_cur).css('display','none');//現ページを非表示
	$('#div_loading').fadeOut(500);
}

///////////////////////////////////////////////////////////////////////////
//takken:imgタグでファイルが選択された時
function fnc_fle_photo_picker(e,a_this){
	//alert(a_this.prop('id'));return;
	//サムネイル表示
	var ctx;
	var tgt=a_this.target || window.event.srcElement,files=tgt.files;
	if(files.length==0) return false;//写真選択なし
	g_obj_div_photo_picker.find('span').remove();//「クリックして写真選択」除去
	for(var i=0;i<files.length;i++){
		//var file=e.originalEvent.dataTransfer.files[0];
		var file=tgt.files[i];
		pr_loadImage(file,function(img){
			var max_x=300, //リサイズ後のサイズx
			max_y=400, //リサイズ後のサイズy
			org_x=img.width,
			org_y=img.height,
			new_x,
			new_y;
			if(org_x/org_y > max_x/max_y){
				new_x = max_x;
				new_y = org_y * max_x / org_x;
			}else{
				new_x = org_x * max_y / org_y;
				new_y = max_y;
			}
			var cv = document.createElement('canvas');
			cv.width = new_x;
			cv.height = new_y;
			var ctx = cv.getContext('2d');
			ctx.drawImage(img, 0, 0, new_x, new_y);
			var imgUrl = cv.toDataURL('image/jpeg');
			$('<img>').prop({"class":"img_ptp","src": imgUrl,"width":new_x,"height":new_y}).appendTo(g_obj_div_photo_picker);
			//alert(imgUrl);
		});
	}
}

///////////////////////////////////////////////////////////////////////////
//takken
function pr_loadImage(file, callback){
	var reader = new FileReader();
	reader.onload = function(evt){
		var img = new Image();
		img.onload = function(){
			callback.call(this, img);
		};
		img.src = evt.target.result;
	};
	reader.readAsDataURL(file);
}

///////////////////////////////////////////////////////////////////////////
function fnc_div_photo_picker(a_this){
	//alert('fnc_div_photo_picker('+a_this.prop('id')+')');return;
	g_obj_div_photo_picker=a_this;//対象 写真選択枠
	$('#fle_photo_picker').trigger('click');
}

///////////////////////////////////////////////////////////////////////////
//写真削除モード時にクリックされた写真を削除
function fnc_click_img_ptp(e,a_this){
	e.stopPropagation();//img_ptpのclickイベントを親divに伝播させない
	//alert('fnc_click_img_ptp()');return;//debug
	obj_cbx_mode_del_photo=a_this.parents('.div_page').find('.cbx_mode_del_photo');//写真削除モードのobj
	if(obj_cbx_mode_del_photo.prop('checked')){
		a_this.remove();//クリックされた写真を削除する
	}
}


///////////////////////////////////////////////////////////////////////////
function print_r(a_asc){
	var ret;
	//
	ret='';
	$.each(a_asc,
		function(fld,term){
			ret+=fld+'=>'+term+' ';
		}
	);
	return ret;
}

///////////////////////////////////////////////////////////////////////////
//a_obj_div 内にあるUIパーツをリセットする
//radio,checkbox:チェック外す text,date datetime-l,textarea:空欄
function fnc_reset_ui(a_obj_div){
	//alert('fnc_reset_ui()');return;//debug

	a_obj_div.find('input[type="radio"]:checked').prop('checked',false);
	a_obj_div.find('input[type="checkbox"]:checked').prop('checked',false);
	a_obj_div.find('input[type="text"]').val('');
	a_obj_div.find('input[type="date"]').val('');
	a_obj_div.find('input[type="datetime-local"]').val('');
	a_obj_div.find('textarea').val('');

}

///////////////////////////////////////////////////////////////////////////
//phpエラーメッセージからタグ（<br />,<b>,</b>）を取り除く
function fnc_elminate_err_tag(a_err){
	s_err=a_err;
	//
	s_err=s_err.replace('<br />','');
	s_err=s_err.replace('<br />','');
	s_err=s_err.replace('<br />','');
	s_err=s_err.replace('<br />','');
	s_err=s_err.replace('<br />','');
	s_err=s_err.replace('<br />','');

	s_err=s_err.replace('</b>','');
	s_err=s_err.replace('</b>','');
	s_err=s_err.replace('</b>','');
	s_err=s_err.replace('</b>','');
	s_err=s_err.replace('</b>','');
	s_err=s_err.replace('</b>','');

	s_err=s_err.replace('<b>','');
	s_err=s_err.replace('<b>','');
	s_err=s_err.replace('<b>','');
	s_err=s_err.replace('<b>','');
	s_err=s_err.replace('<b>','');
	s_err=s_err.replace('<b>','');
	//
	return s_err;
}

/*
///////////////////////////////////////////////////////////////////////////
function (a_this){
	//alert('()');return;//debug
	var ???=a_this.val();//
}

///////////////////////////////////////////////////////////////////////////
//
function fnc_xxxx(){
	//alert('fnc_xxxx()');return;

	//
	var asc_post={};
	asc_post['act']='xxxxxx';
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
	}).done(function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
			}else{
				alert(json_data['msg']+'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
	}).always(function(){
	}).fail(function(XMLHttpRequest,textStatus,errorThrown){
			alert('サーバーエラー：fnc_xxxxx()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

*/
