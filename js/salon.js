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
	
	//「タイムテーブル」ページ----------------------------------------------------------------------------------
	$('#slt_top_hamburger').change(function(e){fnc_slt_top_hamburger($(this));});//ハンバーガーメニュー選択
	$('#tdt_timetable').change(function(e){fnc_tdt_timetable($(this));});//タイムテーブル日付変更
	$('#btn_search_order').click(function(e){fnc_btn_search_order($(this));});//タイムテーブル ワード検索ボタン
	$('.btn_timetable_date').click(function(e){fnc_btn_timetable_date($(this));});//タイムテーブル日付「←」「→」ボタン

	//「カウンセリング日時」-----------------------------------------------------------------------------------
	$(document).on('click','.btn_edit_order_counsel_datetime',function(e){fnc_btn_edit_order_counsel_datetime($(this));});//カウンセリング日時予約：編集ボタン
	$('.btn_reg_order_counsel_datetime').click(function(e){fnc_btn_reg_order_counsel_datetime($(this));});//登録ボタン

	//「カウンセリング回答」-----------------------------------------------------------------------------------
	$(document).on('click','.btn_show_order_counsel_result',function(e){fnc_btn_show_order_counsel_result($(this));});//カウンセリング回答：閲覧ボタン
	$(document).on('click','.btn_edit_order_counsel_result',function(e){fnc_btn_edit_order_counsel_result($(this));});//カウンセリング回答：編集ボタン
	$('.btn_reg_order_counsel_result').click(function(e){fnc_btn_reg_order_counsel_result($(this));});//登録ボタン
	$('#ipt_choose_multi_photo').on('change', function(e){fnc_ipt_choose_multi_photo($(this));});//imgタグでファイルが選択された時

	//「事前決済」---------------------------------------------------------------------------------------------
	$(document).on('click','.btn_edit_order_prepaid',function(e){fnc_btn_edit_order_prepaid($(this));});//事前決済：編集ボタン
	$('.btn_reg_order_prepaid').click(function(e){fnc_btn_reg_order_prepaid($(this));});//事前決済：登録ボタン

	//「施術」-------------------------------------------------------------------------------------------------
	//$(document).on('click','.btn_show_order_ope',function(e){fnc_btn_show_order_ope($(this));});//施術：閲覧ボタン
	$(document).on('click','.btn_edit_order_ope',function(e){fnc_btn_edit_order_ope($(this));});//施術：編集ボタン
	$(document).on('click','.btn_reg_order_ope',function(e){fnc_btn_reg_order_ope($(this));});//施術：登録ボタン

	//「カルテ」------------------------------------------------------------------------------------------------
	$(document).on('click','.btn_show_order_karte',function(e){fnc_btn_show_order_karte($(this));});//カルテ：閲覧ボタン
	$(document).on('click','.btn_edit_order_karte',function(e){fnc_btn_edit_order_karte($(this));});//カルテ：編集ボタン
	$(document).on('click','.btn_reg_order_karte',function(e){fnc_btn_reg_order_karte($(this));});//カルテ：登録ボタン

	//「予約新規」----------------------------------------------------------------------------------------------
	$(document).on('click','.btn_add_order',function(e){fnc_btn_add_order($(this));});//予約作成ボタン
	$(document).on('click','.btn_add_order_counsel_datetime',function(e){fnc_btn_edit_order_counsel_datetime($(this));});//カウンセリング日時予約
	$(document).on('click','.btn_add_order_counsel_result',function(e){fnc_btn_edit_order_counsel_result($(this));});//カウンセリング内容
	$(document).on('click','.btn_add_order_prepaid',function(e){fnc_btn_edit_order_prepaid($(this));});//事前決済
	$(document).on('click','.btn_add_order_ope',function(e){fnc_btn_edit_order_ope($(this));});//施術
	$(document).on('click','.btn_add_order_karte',function(e){fnc_btn_edit_order_karte($(this));});//カルテ

	//「顧客管理」ページ----------------------------------------------------------------------------------------
	$('#btn_search_user').click(function(e){fnc_btn_search_user($(this));});//検索ボタン
	$('#btn_add_user').click(function(e){fnc_btn_add_user($(this));});//新規ボタン
	$(document).on('click','.btn_edit_user',function(e){fnc_btn_edit_user($(this));});//編集ボタン

	//「顧客編集」ページ----------------------------------------------------------------------------------------
	$('#btn_reg_user').click(function(e){fnc_btn_reg_user($(this));});//登録ボタン
	$('#cbx_delete_user').change(function(e){fnc_cbx_delete_user($(this));});//顧客削除チェックボックス

	//「サロン情報」ページ--------------------------------------------------------------------------------------
	$('#btn_edit_salon_data').click(function(e){fnc_btn_edit_salon_data($(this));});//編集ボタン
	$('#btn_reg_salon_data').click(function(e){fnc_btn_reg_salon_data($(this));});//登録ボタン

	//共通処理--------------------------------------------------------------------------------------------------
	$('.btn_back').click(function(e){fnc_btn_back($(this));});
	$('.btn_cancel').click(function(e){fnc_btn_cancel($(this));});//キャンセルボタン＝戻るボタン 同動作
	$('#fle_photo_picker').change(function(e){fnc_fle_photo_picker(e,$(this));});//fle_photo_pickerクリック
	$(document).on('click','.div_photo_picker',function(e){fnc_div_photo_picker($(this));});//マルチ写真枠
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
		success:function(json_data){
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
				$('#tbl_timetable').children('tbody').empty().append(json_data['tbody']);//既存のタイムテーブルクリア→新結果出力
			}else{
				alert(json_data['msg'],'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_ready()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//トップページ：ハンバーガーメニュー選択
function fnc_slt_top_hamburger(a_this){
	act=a_this.val();//top/manage_user/manage_counsel/set_salon_data
	//alert('fnc_slt_top_hamburger('+act+')');return;
	var id_div_page_next='';
	
	a_this.val('top');//select位置を先頭optionに戻す
	
	if(act=='manage_user'){//顧客管理
		fnc_btn_manage_user(this);

	}else if(act=='set_salon_data'){//サロン情報設定
		fnc_btn_show_salon_data(this);

	}else if(act=='go_square_dashboard'){//Squareダッシュボード
		window.open('https://squareup.com/login','Squareダッシュボード');

	}
}

///////////////////////////////////////////////////////////////////////////
//①ハンバーガーメニュー：顧客管理
function fnc_btn_manage_user(a_this){
	obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
	obj_div_page_next=$('#div_page_manage_user');//次ページdivのobj
	g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

	//ページ切り替え
	obj_div_page_next.css('display','block');//次ページを表示
	obj_div_page_cur.css('display','none');//現ページを非表示
}

///////////////////////////////////////////////////////////////////////////
//①ハンバーガーメニュー：サロン情報設定（＝閲覧）
function fnc_btn_show_salon_data(a_this){
	//alert('fnc_btn_show_salon_data()');return;

	var asc_post={};
	asc_post['act']='btn_show_salon_data';
	asc_post['js_salon_id']=g_salon_id;
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
//alert(print_r(json_data));return;
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
							if(val==0){//写真枚数=0
								obj_div_page_next.find('.'+fld).empty().html('なし');

							}else{//画像枚数>0
								for(photo_sn=1;photo_sn<=val;photo_sn++){//画像枚数分ループ
									gruop_code=fld.replace('ptp_','');//「'ptp_'」除去でgruop_codeとなる
									url_img='photo/salon/'+'p'+g_salon_id+'_'+gruop_code+'-'+photo_sn+'.jpg';//画像のURL
									$('<img>').attr({"src":url_img}).appendTo(obj_div_page_next.find('.ptp_'+gruop_code));//imgタグ追加＝画像の表示
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_show_salon_data()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//タイムテーブル日付変更択
function fnc_tdt_timetable(a_this){
	//alert('fnc_tdt_timetable');return;

	fnc_btn_search_general_timetable();//汎用タイムテーブル検索（日付・検索キーワード）

}

///////////////////////////////////////////////////////////////////////////
//タイムテーブル ワード検索ボタン
function fnc_btn_search_order(){
	//alert('fnc_btn_search_order()');return;

	fnc_btn_search_general_timetable();//汎用タイムテーブル検索（日付・検索キーワード）
}

///////////////////////////////////////////////////////////////////////////
//タイムテーブル日付移動「←」「→」ボタン
function fnc_btn_timetable_date(a_this){
	//alert('fnc_btn_timetable_date()');return;

	tdt_timetable=$('#tdt_timetable').val();//日付（-区切）
	day_move=parseInt(a_this.val());//「-1」or「1」
	
	ary=tdt_timetable.split('-');//年 月 日 分割
	if(ary.length==3){
		obj_date= new Date(ary[0],ary[1]-1,ary[2]);
  	obj_date.setDate(obj_date.getDate()+day_move);//日付移動
  	
  	s_date=obj_date.getFullYear()+'-'+( ("0"+(obj_date.getMonth()+1)).slice(-2))+'-'+(("0"+obj_date.getDate()).slice(-2));//sliceは2桁化

  	$('#tdt_timetable').val(s_date);//日付（-区切）
		fnc_btn_search_general_timetable();//汎用タイムテーブル検索（日付・検索キーワード）
	}
	

}

///////////////////////////////////////////////////////////////////////////
//汎用タイムテーブル検索（日付・検索キーワード）
function fnc_btn_search_general_timetable(a_this){
	//alert('fnc_btn_search_general_timetable');return;

	var asc_post={};
	asc_post['act']='btn_search_general_timetable';
	asc_post['js_salon_id']=g_salon_id;
	asc_post['tdt_timetable']=$('#tdt_timetable').val();//日付（-区切）
	asc_post['txt_search_order_word']=$('#txt_search_order_word').val();//検索キーワード
	//alert(print_r(asc_post));return;//debug

	//
	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				$('#tbl_timetable').children('tbody').empty().append(json_data['tbody']);//既存のタイムテーブルクリア→新結果出力
			}else{
				alert(json_data['msg'],'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_search_general_timetable()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//トップページ（div_page_timetable）：ハンバーガーメニュー選択→顧客選択
function fnc_slt_top_hamburger_manage_user(){

}

///////////////////////////////////////////////////////////////////////////
//②顧客管理（一覧）：検索ボタン
function fnc_btn_search_user(){
	//alert('fnc_btn_search_user()');return;

	var asc_post={};
	asc_post['act']='btn_search_user';
	asc_post['js_salon_id']=g_salon_id;
	asc_post['txt_search_user']=$('#txt_search_user').val();
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				$('#tbl_manage_user').children('tbody').empty().append(json_data['tbody']);//既存の検索結果クリア→検索結果出力
			}else{
				alert(json_data['msg'],'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_search_user()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//②顧客管理（一覧）：検索ボタン
function fnc_btn_search_user(){
	//alert('fnc_btn_search_user()');return;

	var asc_post={};
	asc_post['act']='btn_search_user';
	asc_post['js_salon_id']=g_salon_id;
	asc_post['txt_search_user']=$('#txt_search_user').val();
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				$('#tbl_manage_user').children('tbody').empty().append(json_data['tbody']);//既存の検索結果クリア→検索結果出力
			}else{
				alert(json_data['msg'],'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_search_user()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//②顧客管理（一覧）：新規顧客ボタン
function fnc_btn_add_user(){
	//alert('fnc_btn_add_user()');return;

	//ページ遷移設定（次）
	obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
	obj_div_page_next=$('#div_page_edit_user');//次ページdivのobj
	g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

	//次ページ設定
	g_user_ai=0;//ユーザーai（0…新規）
	fnc_reset_ui(obj_div_page_next);//次ページのUIパーツをリセットする
	$('#div_page_edit_user').find('.spn_ope').html('新規');//操作名
	$('#lbl_delete_user').css('display','none');//削除確認用チェックボックス 非表示
	$('#btn_reg_user').html('登録');//登録ボタン名設定

	//ページ遷移
	obj_div_page_next.css('display','block');//次ページを表示
	obj_div_page_cur.css('display','none');//現ページを非表示

}

///////////////////////////////////////////////////////////////////////////
//②顧客管理（一覧）：編集ボタン
function fnc_btn_edit_user(a_this){
	btn_user_ai=a_this.val();//ユーザーai
	//alert('fnc_btn_edit_user('+btn_user_ai+')');return;

	g_user_ai=btn_user_ai;//ユーザーai

	asc_post={};
	asc_post['act']='btn_edit_user';
	asc_post['js_user_ai']=g_user_ai;//user_ai
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_edit_user()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//②顧客管理（一覧）：[リスト行]予約新規ボタン
function fnc_btn_add_order(a_this){
	btn_user_ai=a_this.val();//ユーザーai
	//alert('fnc_btn_add_order('+btn_user_ai+')');return;

	g_user_ai=btn_user_ai;//ユーザーai
	g_order_ai=0;//予約ai(0=新規) 

	asc_post={};
	asc_post['act']='btn_add_order';
	asc_post['js_user_ai']=g_user_ai;//ユーザーai
	asc_post['js_order_ai']=g_order_ai;//予約ai(=0 新規)
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_add_order()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//③顧客管理：（新規・編集・削除）：登録ボタン
function fnc_btn_reg_user(){
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
		success:function(json_data){
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_reg_user()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//顧客管理（div_page_edit_user）：顧客削除チェックボックス
function fnc_cbx_delete_user(){
	//alert('fnc_cbx_delete_user()');return;
	
	if($('#cbx_delete_user').prop('checked')){//顧客削除チェックボックス オン
		$('#btn_reg_user').html('削除実行');
	}else{//顧客削除チェックボックス オフ
		$('#btn_reg_user').html('編集登録');
	}
}

///////////////////////////////////////////////////////////////////////////
//カウンセリング日時：編集ボタン
function fnc_btn_edit_order_counsel_datetime(a_this){
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

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_edit_order_counsel_datetime()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//カウンセリング日時予約：登録ボタン
function fnc_btn_reg_order_counsel_datetime(a_this){
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
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				//ページ遷移設定（戻る）
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
				//
				if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
					$('#btn_search_order').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）

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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_reg_user()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//①タイム テーブル：[各行]カウンセリング回答閲覧ボタン
function fnc_btn_show_order_counsel_result(a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_show_order_counsel_result(btn_order_ai='+btn_order_ai+')');return;

	g_user_ai=-1;//ユーザーai（予約aiより参照）
	g_order_ai=btn_order_ai;//予約ai

	var asc_post={};
	asc_post['act']='btn_show_order_counsel_result';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				//ページ遷移設定（次）
				obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
				obj_div_page_next=$('#div_page_show_order_counsel_result');//次ページdivのobj
				g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

				//次ページ設定
				obj_div_page_next.find('.spn_user_id').html(json_data['spn_user_id']);
				obj_div_page_next.find('.spn_user_name').html(json_data['spn_user_name']);
				obj_div_page_next.find('.spn_user_yomi').html(json_data['spn_user_yomi']);
				obj_div_page_next.find('.spn_user_hpid').html(json_data['spn_user_hpid']);
				obj_div_page_next.find('.spn_user_birthday').html(json_data['spn_user_birthday']);
				obj_div_page_next.find('.spn_user_sex').html(json_data['spn_user_sex']);
				obj_div_page_next.find('.spn_user_email').html(json_data['spn_user_email']);
				obj_div_page_next.find('.spn_user_tel').html(json_data['spn_user_tel']);
				$('#div_show_order_counsel_result').html(json_data['div_show_order_counsel_result']);//カウンセリング回答 内容
				obj_div_page_next.find('.btn_edit_order_counsel_result').val(g_order_ai);

				//ページ遷移
				obj_div_page_next.css('display','block');//次ページを表示
				obj_div_page_cur.css('display','none');//現ページを非表示
			}else{
				alert(json_data['msg']+'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_show_order_counsel_result()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//⑤カウンセリング回答：編集ボタン
function fnc_btn_edit_order_counsel_result(a_this){
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

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				//ページ遷移設定（次）
				obj_div_page_cur=$('#'+g_ary_div_page[g_ary_div_page.length-1]);//現ページdivのobj
				obj_div_page_next=$('#div_page_edit_order_counsel_result');//次ページdivのobj
				g_ary_div_page.push(obj_div_page_next.prop('id'));//ページ遷移 管理配列

				//次ページ設定
				obj_div_page_next.find('.spn_user_id').html(json_data['spn_user_id']);
				obj_div_page_next.find('.spn_user_name').html(json_data['spn_user_name']);
				$('#div_edit_order_counsel_result').html(json_data['div_edit_order_counsel_result']);//カウンセリング回答 内容

				//ページ遷移
				obj_div_page_next.css('display','block');//次ページを表示
				obj_div_page_cur.css('display','none');//現ページを非表示
			}else{
				alert(json_data['msg']+'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_edit_order_counsel_result()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//カウンセリング回答：登録ボタン
function fnc_btn_reg_order_counsel_result(a_this){
	//alert('fnc_btn_reg_order_counsel_result()');return;

	//
	var asc_post={};
	asc_post['act']='btn_reg_order_counsel_result';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	asc_post['id_div_page_back']=g_ary_div_page[g_ary_div_page.length-2];//戻りページ(2つ前)divのid

	fc_set_asc_order_counsel_result(asc_post);//指定ascにカウンセリング回答を設定
	//asc_post['cbx_delete_user']=$('#cbx_delete_user').prop('checked');//削除する('true'/'false')
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				//ページ遷移設定（戻る）
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
				//
				if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
					$('#btn_search_order').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）

				}else if(id_div_page_back=='div_page_show_order_counsel_result'){//戻りページ＝カウンセリング回答 閲覧
					$('#div_show_order_counsel_result').html(json_data['div_show_order_counsel_result']);//カウンセリング回答 内容 差し替え
					$('#btn_search_order').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）

				}else if(id_div_page_back=='div_page_add_order'){//戻りページ＝予約新規ページ ★要検証
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_reg_order_counsel_result()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
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
		}else if(ui_class.indexOf('ptp_')===0){//photo-picker時
			//fff
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//⑧事前決済：編集ボタン
function fnc_btn_edit_order_prepaid(a_this){
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

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
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
				//
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_edit_order_prepaid()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//事前決済：登録ボタン
function fnc_btn_reg_order_prepaid(a_this){
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

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				//ページ遷移設定（戻る）
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
				//
				if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
					$('#btn_search_order').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）

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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_reg_user()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//④予約/カルテ管理（新規）：[一行]施術 編集ボタン
function fnc_btn_edit_order_ope(a_this){
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

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_edit_order_ope()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//施術：登録ボタン
function fnc_btn_reg_order_ope(a_this){
	//alert('fnc_btn_reg_order_ope()');return;
	
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

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				//ページ遷移設定（戻る）
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
				//
				if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
					$('#btn_search_order').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）

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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_reg_order_ope()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//カルテ：閲覧ボタン
function fnc_btn_show_order_karte(a_this){
	btn_order_ai=a_this.val();//order_ai
	//alert('fnc_btn_show_order_karte(btn_order_ai='+btn_order_ai+')');return;

	g_user_ai=-1;//ユーザーai（予約aiより参照）
	g_order_ai=btn_order_ai;//予約ai
	transition='NEXT';//show時はNEXT、reg時はBACK

	fnc_set_page_show_order_karte(g_order_ai,g_user_ai,transition);
}

///////////////////////////////////////////////////////////////////////////
//カルテ：登録ボタン
function fnc_btn_reg_order_karte(a_this){
	//alert('fnc_btn_reg_order_ope()');return;
	var ary_fld_ptp=['ptp_karte_before','ptp_karte_after'];
	//
	var asc_post={};
	asc_post['act']='btn_reg_order_karte';
	asc_post['js_user_ai']=g_user_ai;
	asc_post['js_order_ai']=g_order_ai;
	asc_post['tdl_order_visit_datetime']=$('#div_page_edit_order_karte').find('.tdl_order_visit_datetime').val();//来店日時
	asc_post['tta_order_ope_menu']=$('#div_page_edit_order_karte').find('.tta_order_ope_menu').val();//メニュー内容
	asc_post['txt_order_ope_stylist']=$('#div_page_edit_order_karte').find('.txt_order_ope_stylist').val();//施術担当者
	asc_post['txt_order_ope_price']=$('#div_page_edit_order_karte').find('.txt_order_ope_price').val();//施術金額
	asc_post['tta_order_ope_detail']=$('#div_page_edit_order_karte').find('.tta_order_ope_detail').val();//施術詳細
	asc_post['id_div_page_back']=g_ary_div_page[g_ary_div_page.length-2];//戻りページ(2つ前)divのid
	$.each(ary_fld_ptp,//photo_picker
		function(fld,gruop_code){
			$('#div_page_edit_order_karte').find('.'+gruop_code).find('img').each(function(img_idx,img_obj){
				asc_post[gruop_code+'-'+(img_idx+1)]=$(img_obj).prop('src');
			});
		}
	);
		
	asc_post['cbx_delete_user']=$('#cbx_delete_user').prop('checked');//削除する('true'/'false')
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				transition='BACK';//show時はNEXT、reg時はBACK
				fnc_set_page_show_order_karte(g_order_ai,g_user_ai,transition);
				//戻りページ処理
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid
				//
				if(id_div_page_back=='div_page_timetable'){//戻りページ＝タイムテーブル
					$('#btn_search_order').trigger('click');//div_page_timetablの検索ボタンを押す（編集結果の反映）

				}else if(id_div_page_back=='div_page_add_order'){//戻りページ＝予約新規
					if(g_order_ai==0){//予約ai(0=新規) ならば
						g_order_ai=json_data['inserted_order_ai'];//予約ai差し替え
					}
					$('#tr_add_order').empty().append(json_data['tr_child']);//既存の状態クリア→ボタン状況出力 ※#tbl_add_orderは1行だけのため直tr指定

				}else if(id_div_page_back=='div_page_show_order_karte'){//戻りページ＝カルテ閲覧
					$('#div_show_order_karte').html(json_data['div_show_order_karte']);

				}
			}else{
				alert(json_data['msg']+'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_reg_order_karte()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}


///////////////////////////////////////////////////////////////////////////
//カルテ：閲覧ページ設定
//a_order_ai=0時はa_user_ai>0,a_order_ai>0時はa_user_ai>-1
//a_transition NEXT/BACK show時はNEXT、reg時はBACK
function 	fnc_set_page_show_order_karte(a_order_ai,a_user_ai,a_transition){
	rand=Math.ceil(Math.random()*100);
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
		success:function(json_data){
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
									$('<img>').attr({"src":url_img}).appendTo(obj_div_page_show.find('.'+gruop_code));//imgタグ追加＝画像の表示
								}
							}
						}
					}
				);
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_set_page_show_order_karte()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//カルテ：編集ボタン
function fnc_btn_edit_order_karte(a_this){
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

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
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
//alert(print_r(json_data));
				$.each(json_data,//DB値復元
					function(fld,val){
						if(fld.indexOf('spn_')==0){//spn時
							obj_div_page_next.find('.'+fld).html(val);

						}else if(fld.indexOf('txt_')==0){//spn時
							obj_div_page_next.find('.'+fld).val(val);

						}else if(fld.indexOf('txa_')==0){//spn時
							obj_div_page_next.find('.'+fld).val(val);

						}else if(fld.indexOf('tdl_')==0){//spn時
							obj_div_page_next.find('.'+fld).val(val);

						}else if(fld.indexOf('ptp_')==0){//ptp時 valは画像枚数
							obj_div_page_next.find('.'+fld).empty();
							if(val==0){//写真枚数=0
								obj_div_page_next.find('.'+fld).html('なし');

							}else{//画像枚数>0
								for(photo_sn=1;photo_sn<=val;photo_sn++){//画像枚数分ループ
									gruop_code=fld;
									url_img='photo/order/'+'p'+g_order_ai+'_'+gruop_code+'-'+photo_sn+'.jpg?'+rand;//画像のURL
									$('<img>').attr({"src":url_img}).appendTo(obj_div_page_next.find('.'+gruop_code));//imgタグ追加＝画像の表示
								}
							}
						}
					}
				);
				/*
				obj_div_page_next.find('.spn_user_id').html(json_data['spn_user_id']);//顧客ID
				obj_div_page_next.find('.spn_user_name').html(json_data['spn_user_name']);//顧客名前
				obj_div_page_next.find('.tta_order_ope_menu').val(json_data['tta_order_ope_menu']);//施術メニュー
				obj_div_page_next.find('.tdl_order_visit_datetime').val(json_data['tdl_order_visit_datetime']);//来店日時
				obj_div_page_next.find('.txt_order_ope_stylist').val(json_data['txt_order_ope_stylist']);//施術担当者
				obj_div_page_next.find('.txt_order_ope_price').val(json_data['txt_order_ope_price']);//施術金額
				obj_div_page_next.find('.tta_order_ope_detail').val(json_data['tta_order_ope_detail']);//施術詳細
				*/

				//
				obj_div_page_next.css('display','block');//次ページを表示
				obj_div_page_cur.css('display','none');//現ページを非表示
			}else{
				alert(json_data['msg']+'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_edit_order_karte()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}


///////////////////////////////////////////////////////////////////////////
//⑮サロン情報：編集ボタン
function fnc_btn_edit_salon_data(a_this){

	asc_post={};
	asc_post['act']='btn_edit_salon_data';
	asc_post['js_salon_id']=g_salon_id;
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
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
							if(val==0){//写真枚数=0
								obj_div_page_next.find('.'+fld).empty().html('なし');

							}else{//画像枚数>0
								for(photo_sn=1;photo_sn<=val;photo_sn++){//画像枚数分ループ
									gruop_code=fld.replace('ptp_','');//「'ptp_'」除去でgruop_codeとなる
									url_img='photo/salon/'+'p'+g_salon_id+'_'+gruop_code+'-'+photo_sn+'.jpg';//画像のURL
									obj_div_ptp=obj_div_page_next.find('.ptp_'+gruop_code);
									obj_div_ptp.html('');//コメント削除
									$('<img>').attr({"src":url_img}).appendTo(obj_div_ptp);//imgタグ追加＝画像の表示
								}
							}
						}
					}
				);
				$('#fnc_btn_reg_salon_data').val();//登録ボタンのvalue値=

				//ページ切り替え
				obj_div_page_next.css('display','block');//次ページを表示
				obj_div_page_cur.css('display','none');//現ページを非表示
			}else{
				alert(json_data['msg'],'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_edit_salon_data()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//⑮サロン情報：登録ボタン
function fnc_btn_reg_salon_data(a_this){
	//alert('fnc_btn_reg_salon_data()');return;

	var ary_fld_txt=['salon_name','salon_addr1','salon_addr2','salon_tel','salon_email','salon_hp','salon_insta'
		,'salon_blog','salon_fb','salon_latlng'];
	var ary_fld_ptp=['image','logo','hp','prepaid','profile_change','thank_you'];

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
			$('#div_page_edit_salon_data').find('.ptp_'+gruop_code).find('img').each(function(img_idx,img_obj){
				asc_post[gruop_code+'-'+(img_idx+1)]=$(img_obj).prop('src');
			});
		}
	);
	//alert(print_r(asc_post));return;//debug

	$.ajax({
		url:'salon_ajax.php',
		type:'POST',
		dataType:'json',
		data:asc_post,
		timeout:60000,
		cache:false,
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
				//ページ遷移設定（戻る）
				id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
				id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid

				//戻りページ復元（サロン情報 閲覧）
				$.each(json_data,
					function(fld,term){
						if(fld.indexOf('spn_')==0){//span時
							$('#'+id_div_page_back).find('.'+fld).html(term);
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
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_btn_reg_salon_data()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

///////////////////////////////////////////////////////////////////////////
//共通処理：戻るボタン
function fnc_btn_back(a_this){
	//alert('fnc_btn_back()');return;

	//ページ遷移設定（戻る）
	id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
	id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid

	$('#'+id_div_page_back).css('display','block');//戻りページを表示
	$('#'+id_div_page_cur).css('display','none');//現ページを非表示
}

///////////////////////////////////////////////////////////////////////////
//共通処理：キャンセル ボタン
function fnc_btn_cancel(a_this){
	//alert('fnc_btn_cancel()');return;

	//ページ遷移設定（戻る）
	id_div_page_cur=g_ary_div_page.pop();//現ページdivのid
	id_div_page_back=g_ary_div_page[g_ary_div_page.length-1];//戻りページdivのid

	$('#'+id_div_page_back).css('display','block');//戻りページを表示
	$('#'+id_div_page_cur).css('display','none');//現ページを非表示
}

///////////////////////////////////////////////////////////////////////////
//takken:imgタグでファイルが選択された時
function fnc_fle_photo_picker(e,a_this){
	//alert(a_this.prop('id'));return;
	//サムネイル表示
	var ctx;
	var tgt=a_this.target || window.event.srcElement,files=tgt.files;
	//if(files.length!=1) return false;//写真数は1
	
	g_obj_div_photo_picker.html('');
	for(var i=0;i<files.length;i++){
		//var file=e.originalEvent.dataTransfer.files[0];
		var file=tgt.files[i];
		pr_loadImage(file,function(img){
			var max_x=200, //リサイズ後のサイズx
			max_y=150, //リサイズ後のサイズy
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
			$('<img>').attr({"src": imgUrl,"width":new_x,"height":new_y}).appendTo(g_obj_div_photo_picker);
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
		success:function(json_data){
			if(json_data['debug']!='')alert(json_data['debug']);
			if(json_data['result']=='OK'){
			}else{
				alert(json_data['msg']+'エラー');
				//if(json_data['cause']=='TIME_OUT')window.location.href='time_out.html';
			}
		},complete:function(){
		},error:function(){
			alert('サーバーエラー：fnc_xxxxx()');
			//alert('ネット接続が不安定です。再アクセスお願いします。');
		}
	});
}

*/
