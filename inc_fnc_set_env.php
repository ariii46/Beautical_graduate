<?php
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//サーバー環境設定
	function fnc_set_env(){
		include('inc_def_server.php');
		$sever_addr=$_SERVER['SERVER_ADDR'];
		$script_filename=$_SERVER['SCRIPT_FILENAME'];
		if(false!==strpos($sever_addr,SERVER_ADDR_RELEASE)){//本番機
			require_once('env/inc_def_xxx.php');

		}else if(false!==strpos($sever_addr,SERVER_ADDR_DEVELOP1)){//開発機1(beautical.sakura.ne.jp)
			if(false!==strpos($script_filename,'/dev/')){
				require_once('env/inc_def_sakura_dev.php');
			}else if(false!==strpos($script_filename,'/graduate/')){
				require_once('env/inc_def_sakura_graduate.php');
			}else if(false!==strpos($script_filename,'/gga/')){
				require_once('env/inc_def_sakura_gga.php');
			}

		}else if(false!==strpos($sever_addr,SERVER_ADDR_LOCALHOST)){//開発機localhost
			require_once('env/inc_def_localhost.php');
		}else{
			die("Err SERVER_ADDR=$sever_addr SCRIPT_FILENAME=$script_filename");
		}
	}
?>