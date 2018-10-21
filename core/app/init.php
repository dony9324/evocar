<?php
/// si no existe el parametro page ni el action recarge la pagina sino lea el page o el action sin cambiar la vista.
// print_r($_GET);
if(!isset($_GET["page"]) && !isset($_GET["action"])){
//	Bootload::load("default");
	Module::loadLayout("index");
}else if(isset($_GET["page"])){
	$_SESSION["ultimoAcceso"] = time();///esta linea es para que se reinicie el contador de secion cada vez que se solisite un page
	Page::load($_GET["page"]);
}else if(isset($_GET["action"])){
	if($_GET["action"]!="access"){
	$_SESSION["ultimoAcceso"] = time();///esta linea es para que se reinicie el contador de secion cada vez que se solisite un action
}
	Action::load($_GET["action"]);
}
?>
