<?php
// @brief Un action corresponde a una rutina de un modulo.
class Action {
	/**	* @brief la funcion load carga una vista correspondiente a un modulo**/
	public static function load($action){
		// Module::$module;
				if(!isset($_GET['action'])){
			include "core/app/action/".$action."-action.php";
		}else{
			if(Action::isValid()){
				include "core/app/action/".$_GET['action']."-action.php";

			}else{
				Action::Error("<b>404 NO ENCONTRADO</b> Action <b>".$_GET['action']."</b> !! - <a href='https://www.facebook.com/dony9324' target='_blank'>Help</a>");
			}
		}
	}
	/**	* @brief valida la existencia de una vista**/
	public static function isValid(){
		$valid=false;
		if(file_exists($file = "core/app/action/".$_GET['action']."-action.php")){
			$valid = true;
		}
		return $valid;
	}
	public static function Error($message){
		print $message;
	}
	public function execute($action,$params){
		$fullpath =  "core/app/action/".$action."-action.php";
		if(file_exists($fullpath)){
			include $fullpath;
		}else{
			assert("wtf");
		}
	}
}
?>
