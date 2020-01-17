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
				page::Error("

				<section class='content'>
							<div class='error-page'>
								<h2 class='headline text-yellow'> 404</h2>

								<div class='error-content'>
									<h3><i class='fa fa-warning text-yellow'></i> NO ENCONTRADO page ".$_GET['page']." !!.</h3>

									<a href='https://www.facebook.com/dony9324' target='_blank'>Help</a>


								</div>
								<!-- /.error-content -->
							</div>
							<!-- /.error-page -->
						</section>");
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
