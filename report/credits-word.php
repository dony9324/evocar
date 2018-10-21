<?php
include "../core/autoload.php";
include "../core/app/model/PersonData.php";
include "../core/app/model/UserData.php";
include "../core/app/model/SellData.php";
include "../core/app/model/OperationData.php";
include "../core/app/model/PaymentData.php";
include "../core/app/model/ProductData.php";

require_once '../res/PhpWord/Autoloader.php';
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

Autoloader::register();

$word = new  PhpOffice\PhpWord\PhpWord();


$sells = SellData::getSells();




$section1 = $word->AddSection();
$section1->addText("Creditos",array("size"=>22,"bold"=>true,"align"=>"right"));


$styleTable = array('borderSize' => 6, 'borderColor' => '888888', 'cellMargin' => 40);
$styleFirstRow = array('borderBottomColor' => '0000FF', 'bgColor' => 'AAAAAA');



$table1 = $section1->addTable("table1");
$table1->addRow();

$table1->addCell(3000)->addText("Codigo de venta");
$table1->addCell()->addText("Cliente");
$table1->addCell()->addText("Total");
$table1->addCell()->addText("pagado");
$table1->addCell()->addText("Deuda");
$table1->addCell()->addText("Fecha");

foreach($sells as $sell){
	if ( ($sell->accredit)==1){
		$q= PaymentData::getQYesF($sell->id);
		$total= $sell->total-$sell->discount; 
	
		$clients = PersonData::getClients();

foreach($clients as $client):
if ( $client->id == $sell->person_id){

$name = $client->name." ".$client->lastname;

}
endforeach;

$table1->addRow();
$table1->addCell(5000)->addText($sell->id);
$table1->addCell(2500)->addText($name);
$table1->addCell(2000)->addText($total);
$table1->addCell(2000)->addText($total - $q);
$table1->addCell(9000)->addText($q);
$table1->addCell(9000)->addText($sell->created_at);
}

}





$word->addTableStyle('table1', $styleTable);
$word->addTableStyle('table2', $styleTable,$styleFirstRow);


/// datos bancarios

$filename = "onesell-".time().".docx";
#$word->setReadDataOnly(true);
$word->save($filename,"Word2007");
//chmod($filename,0444);
header("Content-Disposition: attachment; filename='$filename'");
readfile($filename); // or echo file_get_contents($filename);
unlink($filename);  // remove temp file



?>