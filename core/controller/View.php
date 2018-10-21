<?php
// @brief Una vista corresponde a cada componente visual dentro de un modulo.
class View {
	/**	* @brief la funcion load carga una vista correspondiente a un modulo**/
	public static function load($view){
		// Module::$module;
		if(!isset($_GET['view'])){
			include "core/app/view/".$view."-view.php";
		}else{
			if(View::isValid()){
				include "core/app/view/".$_GET['view']."-view.php";
			}else{
				View::Error("<b>404 NO ENCONTRADO</b> View <b>".$_GET['view']."</b> !! - <a href='https://www.facebook.com/dony9324' target='_blank'>Help</a>");
			}
		}
	}
	/**	* @brief valida la existencia de una vista**/
	public static function isValid(){
		$valid=false;
		if(isset($_GET["view"])){
			if(file_exists($file = "core/app/view/".$_GET['view']."-view.php")){
				$valid = true;
			}
		}
		return $valid;
	}
	public static function Error($message){
		print $message;
	}
}
?>
