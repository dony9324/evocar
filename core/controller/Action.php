<?php
// @brief  Un action corresponde a una rutina de un modulo.
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
				Action::Error("
				<section class='content'>
							<div class='error-page'>
								<h2 class='headline text-yellow'> 404</h2>

								<div class='error-content'>
									<h3><i class='fa fa-warning text-yellow'></i> NO ENCONTRADO action ".$_GET['action']." !!.</h3>

									<a href='https://www.facebook.com/dony9324' target='_blank'>Help</a>


								</div>
								<!-- /.error-content -->
							</div>
							<!-- /.error-page -->
						</section>");
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
