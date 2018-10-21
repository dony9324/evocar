<?php
// @brief Un page corresponde a una rutina de un modulo.
class Page {
	/**	* @brief la funcion load carga una vista correspondiente a un modulo**/	
	public static function load($page){
		// Module::$module;
				if(!isset($_GET['page'])){
			include "core/app/page/".$page."-page.php";
		}else{
			if(page::isValid()){
				include "core/app/page/".$_GET['page']."-page.php";				
			}else{
				page::Error("<b>404 NO ENCONTRADO</b> page <b>".$_GET['page']."</b> !! - <a href='https://www.facebook.com/dony9324' target='_blank'>Help</a>");
			}
		}
	}
	/**	* @brief valida la existencia de una vista	**/	
	public static function isValid(){
		$valid=false;
		if(file_exists($file = "core/app/page/".$_GET['page']."-page.php")){
			$valid = true;
		}
		return $valid;
	}
	public static function Error($message){
		print $message;
	}
	public function execute($page,$params){
		$fullpath =  "core/app/page/".$page."-page.php";
		if(file_exists($fullpath)){
			include $fullpath;
		}else{
			assert("wtf");
		}
	}
}
?>