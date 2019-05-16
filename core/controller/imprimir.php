<?php
// @brief Un imprimir corresponde a una rutina de un modulo.
class Imprimir {
	/**	* @brief la funcion load carga una vista correspondiente a un modulo**/
	public static function load($imprimir){
		// Module::$module;
				if(!isset($_GET['imprimir'])){
			include "core/app/imprimir/".$imprimir."-imprimir.php";
		}else{
			if(imprimir::isValid()){
				include "core/app/imprimir/".$_GET['imprimir']."-imprimir.php";
			}else{
				imprimir::Error("<b>404 NO ENCONTRADO</b> imprimir <b>".$_GET['imprimir']."</b> !! - <a href='https://www.facebook.com/dony9324' target='_blank'>Help</a>");
			}
		}
	}
	/**	* @brief valida la existencia de una vista	**/
	public static function isValid(){
		$valid=false;
		if(file_exists($file = "core/app/imprimir/".$_GET['imprimir']."-imprimir.php")){
			$valid = true;
		}
		return $valid;
	}
	public static function Error($message){
		print $message;
	}
	public function execute($imprimir,$params){
		$fullpath =  "core/app/imprimir/".$imprimir."-imprimir.php";
		if(file_exists($fullpath)){
			include $fullpath;
		}else{
			assert("wtf");
		}
	}
}
?>
