<?php


if(count($_POST)>0){
  $product = new ProductData();
  $product->barcode = addslashes($_POST["barcode"]);
  $product->name = addslashes ($_POST["name"]);
  $product->price_in = $_POST["price_in"];
  $product->price_out = $_POST["price_out"];
  $product->unit = addslashes ($_POST["unit"]);
  $product->description = addslashes($_POST["description"]);
  $product->presentation = addslashes ($_POST["presentation"]);
  //$product->inventary_min = $_POST["inventary_min"];
  $category_id="NULL";
  if($_POST["category_id"]!=""){ $category_id=$_POST["category_id"];}
  $inventary_min="\"\"";
  if($_POST["inventary_min"]!=""){ $inventary_min=$_POST["inventary_min"];}

  $product->category_id=$category_id;
  $product->inventary_min=$inventary_min;
  $product->user_id = $_SESSION["user_id"];


  if(isset($_FILES["image"])){
    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("res/img/");
      if($image->processed){
        $product->image = $image->file_dst_name;
        $prod = $product->add_with_image();
      }
    }else{

  $prod= $product->add();
    }
  }
  else{
  $prod= $product->add();

  }




if($_POST["q"]!="" || $_POST["q"]!="0"){
 $op = new OperationData();
 $op->product_id = $prod[1] ;
 $op->operation_type_id=1;
 $op->q= $_POST["q"];
 $op->sell_id="NULL";
$op->is_oficial=1;
$op->add();
}

print "<script>window.location='index.php?view=inventary';</script>";


}


?>