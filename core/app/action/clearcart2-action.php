<?php
if(isset($_GET["product_id"])){
	$cart2=$_SESSION["cart2"];
	if(count($cart2)==1){
	 unset($_SESSION["cart2"]);
	}else{
		$ncart2 = null;
		$nx=0;
		foreach($cart2 as $c){
			if($c["product_id"]!=$_GET["product_id"]){
				$ncart2[$nx]= $c;
			}
			$nx++;
		}
		$_SESSION["cart2"] = $ncart2;
	}

}else{
 unset($_SESSION["cart2"]);
}

print "<script>window.location='index.php?view=payment';</script>";

?>