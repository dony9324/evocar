<?php
if(count($_POST)>0){
  header('Content-type: application/json');
  $resultado = array();
  $resultado = array("estado" => "false");
  $resultado += array("id" => "");
  $product = new ProductData();

  $product->id_group = 0;
  $product->group_amount = 1;
  $product->fractions = 1;
  $product->total_quantity = 1;
  $product->extracode = addslashes($_POST["codigo"]);
  $product->name = addslashes ($_POST["name"]);
  $product->barcode = addslashes($_POST["barcode"]);
  $product->description = addslashes($_POST["description"]);
  $product->location = addslashes ($_POST["location"]);
  $product->trademark_id = $_POST["trademark"]; //Marca.
  $product->category_id=$_POST["category_id"];
  $product->type_of_iva_id=$_POST["category_id_iva"];
  $product->unit_id =$_POST["selectmedida"];
  $product->cantidad =$_POST["cantidad"];//es la cantidad de la unidad ej si la unidad es metro y el producto mide 6 metros aki se indica
  if (  $product->cantidad ==0 or   $product->cantidad =="") {
    $product->cantidad=1;
}
  $product->other_presentations=$_POST["switch_2"];//indica si tiene otras presentaciones 0 no, 1 si
  $product->price_in = $_POST["price_in"];
  $product->price_out = $_POST["price_out"];
  $product->inventary_min=$_POST["inventary_min"];
  $product->control_stock = 1;//1 es control 0 el burro suelto
  if (isset($_POST['control_stock'])){ $product->control_stock = 0;}
  $product->divide = 0;//1 es control 0 el burro suelto
  if (isset($_POST['divide'])){ $product->divide = 1;}

  $product->is_active = 1;
  $product->user_id = $_SESSION["user_id"];
  if(isset($_FILES["image"])){
    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("res/img/");
      if($image->processed){
        $product->image = $image->file_dst_name;
        $prod = $product->add();
        $resultado = array("estado" => "true" );
        $resultado += array("id" => "");
      }
    }else{
  $prod= $product->add();
  $resultado = array("estado" => "true" );
  $resultado += array("id" => "");
    }
  }else{
  $prod= $product->add();
  $resultado = array("estado" => "true" );
  $resultado += array("id" => "");
  }
if($_POST["q"]!="" && $_POST["q"]!="0"){
 $op = new OperationData();
 $op->product_id = $_SESSION["insert_id"]; ;
 $op->operation_type_id=1;
 $op->q= $_POST["q"];
 $op->change_price_out=$product->price_out;
 $op->change_price_in=$product->price_in;
 $op->sell_id="NULL";
 $op->user_id=$_SESSION["user_id"];
$op->is_oficial=1;
if ($add = $op->add()) {

}else {
  $resultado = array("estado" => "false");
  $resultado += array("id" => "");
}


  ////rigistramos el almacemaiento temporalmente se registran en la bodega principal
  $almacemaiento=AlmacenamientosData::getAll();
  $bodega = new BodegaData();
  $bodega->operation_id = $add[1];
  $bodega->q = $op->q;
  $bodega->product_id = $op->product_id;
  $bodega->operation_type_id = 1; //entrada 2 salida esta es para el calculo rapido de inventario;
  $bodega->created_at = "NOW()";
  $bodega->almacemaiento_id = 1;
  $bodega->almacenamiento_id2 = NULL;
  $bodega->type = 1;
  $bodega->user_id = $_SESSION["user_id"];
  if (count($almacemaiento)>0) {
  foreach ($almacemaiento as $key) {
   if ($key->id==1) {
     $bodega->almacemaiento_id = $key->id;
     $bodega->q = $op->q;
      $bodega->add();
   }else {
     $bodega->almacemaiento_id = $key->id;
     $bodega->q=0;
     $bodega->add();
   }
  }
  }
  $resultado = array("estado" => "true", "id" => $add[1]);
  setcookie("bodega2",$add[1],(time()+1600));///segundos
}




// las otras presentaciones
$product->id_group = $_SESSION["insert_id"];//solo esta al ingresar productos, leemos el id del ultimo registro sql
 if(isset($_SESSION["fraction"])){
    foreach($_SESSION["fraction"] as $p){
     $product->group_amount = 1;
     $product->fractions = $p["q"];//partes a dividir
     $product->total_quantity =  $product->cantidad / $product->fractions ; // la equibalencia a la unidad principal
     $product->unit_id =$p["unit_id"];//id de la undida de medida
     $product->price_in =  $product->price_in / $product->fractions;
     $product->price_out = $p["price_outf"];
     $prod= $product->add();
    // fraciones (1 Docena / 10) =  1 Unidad
	}
  }
if(isset($_SESSION["grupo"])){
		foreach($_SESSION["grupo"] as $g){
      $product->group_amount = $g["q"];//partes a multiplicar/Agrupar
      $product->fractions = 1; //partes a dividir
      $product->total_quantity =  $product->cantidad * $product->group_amount ; // la equibalencia a la unidad principal
      $product->unit_id =$g["unit_id"];//id de la undida de medida
      $product->price_in =  $product->price_in * $product->group_amount;
      $product->price_out = $g["price_outg"];
      $prod= $product->add();
      //1 Decena =  5 (1 Par)
  }
}
return print(json_encode($resultado));
}
?>
