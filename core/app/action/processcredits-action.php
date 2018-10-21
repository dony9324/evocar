<?php
$sells = SellData::getSellsUnBoxed2(); //aki obtengo todos los creitos 

if(count($sells)){ //pregunto si obtubo resultaods
	//$products = SellData::getSells();
///	$box = new BoxData();
	//$b = $box->add();
	foreach($sells as $sell){//recorro los resultados
	$q= PaymentData::getQYesF($sell->id);//otengo la deuda del credito
	if ($q == 0){ //pregunto si  la deuda del credito el 0
		 $sell-> update_accredit(); // si lo pasa a venta normal
		}
	}
	
}
Core::redir("./index.php?view=credits");
?>