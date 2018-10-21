<?php

if(count($_POST)>0){
	$product = ProductData::getById($_POST["product_id"]);

	$product->barcode =addslashes( $_POST["barcode"]);
	$product->name =addslashes ($_POST["name"]);
	$product->price_in = $_POST["price_in"];
	$product->price_out = $_POST["price_out"];
	$product->unit = addslashes ($_POST["unit"]);

  $product->description = addslashes ($_POST["description"]);
  $product->presentation = addslashes ($_POST["presentation"]);
  $product->inventary_min = $_POST["inventary_min"];
 $category_id="NULL";
  if($_POST["category_id"]!=""){ $category_id=$_POST["category_id"];}
  $is_active=0;
  
  
  
   $product->category_id=$category_id;
   
   
   
  if(isset($_POST["is_active"])){ $is_active=1;}

  $product->is_active=$is_active;
 

	$product->user_id = $_SESSION["user_id"];
	$product->update();

	if(isset($_FILES["image"])){
		$image = new Upload($_FILES["image"]);
		if($image->uploaded){
			$image->Process("res/products/");
			if($image->processed){
				$product->image = $image->file_dst_name;
				$product->update_image();
			}
		}
	}

	setcookie("prdupd","true");
	print "<script>window.location='index.php?view=editproduct&id=$_POST[product_id]';</script>";


}


?>