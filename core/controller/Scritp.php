<?php
// @brief Un scritp corresponde a una rutina de un modulo.
class Scritp {
	/**	* @brief la funcion load carga una vista correspondiente a un modulo**/
	public static function load($Scritp){
		// Module::$module;
				if(!isset($_GET['scritp'])){
			include "core/app/scritp/".$scritp."-scritp.php";
		}else{
			if(scritp::isValid()){
				include "core/app/scritp/".$_GET['scritp']."-scritp.php";
			}else{
				scritp::Error("<b>404 NO ENCONTRADO</b> scritp <b>".$_GET['scritp']."</b> !! - <a href='https://www.facebook.com/dony9324' target='_blank'>Help</a>");
			}
		}
	}
	/**	* @brief valida la existencia de una vista	**/
	public static function isValid(){
		$valid=false;
		if(file_exists($file = "core/app/scritp/".$_GET['scritp']."-scritp.php")){
			$valid = true;
		}
		return $valid;
	}
	public static function Error($message){
		print $message;
	}
	public function execute($scritp,$params){
		$fullpath =  "core/app/scritp/".$scritp."-scritp.php";
		if(file_exists($fullpath)){
			include $fullpath;
		}else{
			assert("wtf");
		}
	}
}
?>
