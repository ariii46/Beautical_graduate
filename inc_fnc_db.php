<?php
	define('PDO_INT',1);//PDO::PARAM_INT
	define('PDO_STR',2);//PDO::PARAM_STR
	//////////////////////////////////////////////////////////////////////////////////
	//DB処理
	function fnc_pdo_connect_db(){
		$dbn='mysql:dbname='.DB_NAME.';charset=utf8;port=3306;host='.DB_HOST;
		$user=DB_USER;
		$pwd=DB_PW;
		try {
			return new PDO($dbn, $user,$pwd);
		}catch (PDOException $e) {
			exit('dbError:'.$e->getMessage());
		}
	}

	//////////////////////////////////////////////////////////////////////////////////
	//SQL実行
	function fnc_pdo_sql($a_sql){
		$pdo=fnc_pdo_connect_db();//DB接続

		$stmt=$pdo->prepare($a_sql);
		$status = $stmt->execute();

		//データ登録処理後
		if($status==false) {
			// SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
			$error=$stmt->errorInfo();
			echo json_encode(["error_msg" => "{$error[2]}"]);
			exit();
		} else {
		}
		//
		//return ;
	}

	//////////////////////////////////////////////////////////////////////////////////
	//テーブル SELECT
	//戻り値:fetchAll レコード連想配列の単純配列
	//$a_ary_fld:取得項目 $a_where:WHERE文（:付き） $a_asc_bind:WHEREのbind値（:無し）
	//$a_tale:  OREDR BY,GROUP BY,LIMIT
	function fnc_pdo_select($a_tbl,$a_ary_fld,$a_where,$a_tale,$a_asc_bind){
		$ary_fetchall=array();//戻り値

		$pdo=fnc_pdo_connect_db();//DB接続

		//SQL文作成ループ
		$list_fld='';//SELECT文の取得フィールドリスト
		foreach($a_ary_fld as $fld){
			if($list_fld!='')$list_fld.=',';
			$list_fld.=$fld;
		}

		//データ登録SQL作成
		$sql='SELECT '.$list_fld.' FROM '.$a_tbl;
		if($a_where!='')$sql.=' WHERE '.$a_where;
		if($a_tale!='')$sql.=' '.$a_tale;

		//bindValueループ
		$stmt=$pdo->prepare($sql);
		foreach($a_asc_bind as $fld=>$asc){
			$stmt->bindValue(':'.$fld,$asc['val'],$asc['type']);
		}
		$status=$stmt->execute();

		//データ登録処理後
		if($status==false) {
			// SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
			$error=$stmt->errorInfo();
			pr_DebugSave('error_pdo_select',var_export($error,true)."\n".$sql."\n\n a_ary_fld=".var_export($a_ary_fld,true)."\n\n a_asc_bind=".var_export($a_asc_bind,true));
			echo json_encode(["error_msg" => "{$error[2]}"]);
			exit();
		}else{
			$ary_fetchall=$stmt->fetchAll(PDO::FETCH_ASSOC);
			//pr_DebugSave('pdoSelect',$sql."\n\n ary_fetchall=".var_export($ary_fetchall,true)."\n\n a_ary_fld=".var_export($a_ary_fld,true)."\n\n a_asc_bind=".var_export($a_asc_bind,true));
		}
		//
		return $ary_fetchall;
	}

	//////////////////////////////////////////////////////////////////////////////////
	//テーブル UPDATE ※戻り値なし
	//$a_asc_set[フィールド名]['val'],[フィールド名]['type']
	//$a_where:WHERE文（:付き） $a_asc_bind:WHEREのbind値（:無し）
	function fnc_pdo_update($a_tbl,$a_asc_set,$a_where,$a_asc_bind){
		$pdo=fnc_pdo_connect_db();//DB接続

		//SQL文作成ループ
		$list_fld='';//SELECT文の取得フィールドリスト
		foreach($a_asc_set as $fld=>$asc){
			if($list_fld!='')$list_fld.=',';
			$list_fld.=$fld.'=:'.$fld;
		}

		//データ登録SQL作成
		$sql='UPDATE '.$a_tbl;
		$sql.=' SET '.$list_fld;
		$sql.=' WHERE '.$a_where;

		$stmt=$pdo->prepare($sql);

		//bindValueループ(SET部)
		foreach($a_asc_set as $fld=>$asc){
			$stmt->bindValue(':'.$fld,$asc['val'],$asc['type']);
		}

		//bindValueループ(WHERE部)
		foreach($a_asc_bind as $fld=>$asc){
			$stmt->bindValue(':'.$fld,$asc['val'],$asc['type']);
		}
		$status=$stmt->execute();

		//データ登録処理後
		if($status==false) {
			// SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
			$error=$stmt->errorInfo();
			pr_DebugSave('error_pdo_update',var_export($error,true)."\n".$sql."\n\n a_asc_set=".var_export($a_asc_set,true)."\n\n a_asc_bind=".var_export($a_asc_bind,true));
			echo json_encode(["error_msg" => "{$error[2]}"]);
			exit();
		}else{
			//pr_DebugSave('ok_pdo_update',$sql."\n\n a_asc_set=".var_export($a_asc_set,true)."\n\n a_asc_bind=".var_export($a_asc_bind,true));
		}
	}

	//////////////////////////////////////////////////////////////////////////////////
	//テーブル INSERT
	//戻り値:LastInsertId か false
	//$a_asc_set[フィールド名]['val'],[フィールド名]['type']
	function fnc_pdo_insert($a_tbl,$a_asc_set){
		$LastInsertId=false;//戻り値
		

		//SQL文作成ループ
		$list_fld='';//INSERT文のフィールドリスト
		$list_values='';//INSERT文のVALUESリスト
		foreach($a_asc_set as $fld=>$asc){
			if($list_fld!='')$list_fld.=',';
			$list_fld.=$fld;
			//
			if($list_values!='')$list_values.=',';
			$list_values.=':'.$fld;//:はPDO用
			
		}

		//データ登録SQL作成
		$sql='INSERT INTO '.$a_tbl;
		$sql.='('.$list_fld.') VALUES('.$list_values.')';


		try{
			$pdo=fnc_pdo_connect_db();//DB接続

			//bindValueループ
			$stmt=$pdo->prepare($sql);
			foreach($a_asc_set as $fld=>$asc){
				$stmt->bindValue(':'.$fld,$asc['val'],$asc['type']);
			}
			$status=$stmt->execute();

			//データ登録処理後
			if($status==false) {
				// SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
				$error=$stmt->errorInfo();
				pr_DebugSave('error_pdo_insert',var_export($error,true)."\n".$sql."\na_asc_set=".var_export($a_asc_set,true));
				echo json_encode(["error_msg" => "{$error[2]}"]);
				exit();
			}else{
				$LastInsertId=$pdo->lastInsertId(); 
			}
		}catch (PDOException $e){
			pr_DebugSave('e_pdoInsert',$e->getMessage());
	  }
		//
		return $LastInsertId;
	}
?>
