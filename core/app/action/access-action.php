<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout
if(isset($_GET["o"])){
	if($_GET["o"]=="login"){

		if(!isset($_SESSION["user_id"])) {
			$user = $_POST['username'];
			$pass = sha1(md5($_POST['password']));
			$base = new Database();
			$con = $base->connect();
			$sql = "select * from user where username= \"".$user."\" and password= \"".$pass."\" and status=1";
			//print $sql;
			$query = $con->query($sql);
			$found = false;
			$userid = null;
			while($r = $query->fetch_array()){
				$found = true ;
				$userid = $r['id'];
			}
			header('Content-type: application/json');
			$resultado = array();
			if($found==true) {

				$_SESSION["ultimoAcceso"]=time();
				//setcookie("ultimoAcceso","true");
				setcookie("ultimoAcceso","true",(time()+4000));
				$_SESSION['user_id']=$userid ;
				$resultado = array("estado" => "true");
				return print(json_encode($resultado));

			}else {
				//setcookie("password_error","true");
				$resultado = array("estado" => "false");
				return print(json_encode($resultado));
			}
		}else{
			Core::redir("./?view=home");
		}
	}

	if(isset($_GET["o"]) && $_GET["o"]=="logout"){
		unset($_SESSION);
		session_destroy();
		Core::redir("./?view=login");
	}

	if(isset($_GET["o"]) && $_GET["o"]=="logouttime"){
		header('Content-type: application/json');
		if(isset($_COOKIE['ultimoAcceso'])){
			if(!isset($_SESSION["user_id"])) {
				$resultado = array("estado" => "true");
				return print(json_encode($resultado));
			} else {
				//sino, calculamos el tiempo transcurrido
				$fechaGuardada = $_SESSION["ultimoAcceso"];
				$ahora = time();
				$tiempo_transcurrido = $ahora-$fechaGuardada;
				//comparamos el tiempo transcurrido
				if($tiempo_transcurrido >= 6000) {
					//si pasaron 1 minutos o más
					unset($_SESSION);
					session_destroy();; // destruyo la sesión
					//Core::redir("./?view=login"); //envío al usuario a la pag. de autenticación
					//sino, actualizo la fecha de la sesión
					$resultado = array("estado" => "true");
					return print(json_encode($resultado));
				}else {
					setcookie("ultimoAcceso","true",(time()+4000));
					//	$_SESSION["ultimoAcceso"] = time();
					$resultado = array("estado" => "false");
					return print(json_encode($resultado));
				}
			}
		}else {
			unset($_SESSION);
			session_destroy();; // destruyo la sesión
			$resultado = array("estado" => "true");
			return print(json_encode($resultado));

		}}
}else {
		echo "error 403";
	}
	?>
