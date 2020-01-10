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
				View::Error("


				<section class='content'>
							<div class='error-page'>
								<h2 class='headline text-yellow'> 404</h2>

								<div class='error-content'>
									<h3><i class='fa fa-warning text-yellow'></i> NO ENCONTRADO View ".$_GET['view']." !!.</h3>

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
