<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");
include "res/escpos-php-master/autoload.php";

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

//esta funcion añade espacios
function addSpaces($string = '', $valid_string_length = 0) {
    if (strlen($string) < $valid_string_length) {
        $spaces = $valid_string_length - strlen($string);
        for ($index1 = 1; $index1 <= $spaces; $index1++) {
            $string = $string . ' ';
        }
    }
    return $string;
}

$connector = new WindowsPrintConnector("EPSON TM-T20II Receipt");
$printer = new Printer($connector);

/* Information for the receipt */
$infoiva= CompanyData::getById(1)->value;
$infonit= CompanyData::getById(2)->value;
$infocell= CompanyData::getById(3)->value;
$infomensaje= CompanyData::getById(4)->value;
$infodire= CompanyData::getById(5)->value;
$total=0;
$total2=0;
$items = [];
$user = UserData::getById($_SESSION["user_id"]);
//alistamos los datos de pruductos
foreach($_SESSION["reabastecer"] as $p){
$product = ProductData::getById($p["product_id"]);
$pt = $p["price_in"]* $p["q"];
$total +=$pt;
$items[] = [
    'name' => $product->name,
    'q' => $p["q"],
    'prece_one' => number_format(($p["price_in"]/100), 2, ',', '.'),
    'total_price' =>number_format(($pt["price_in"]/100), 2, ',', '.'),
    'price_out' => number_format(($p["price_out"]/100), 2, ',', '.'),
];
	}
//  $subtotal = new item('Base: ', number_format(($total/(($infoiva/100)+1)),2,".",","));
//  $tax = new item('iva'.$infoiva."%", number_format((($total/(($infoiva/100)+1))*($infoiva/100)),2,".",","));
//  $total3 = new item('Total', number_format ($total,2,".",","));
  /* Date is kept the same for testing */
   $date = date(' Y-m-d h:i:s A');
   /* Start the printer */
   //$printer -> text("Lista de Reabastecimiento\n");

   //	Intentaremos cargar e imprimir el logo

   $printer->setJustification(Printer::JUSTIFY_CENTER);
   try{
   	$logo = EscposImage::load("res/img/logo.png", false);
       $printer->bitImage($logo);
   }catch(Exception $e){}//No hacemos nada si hay error
   $printer -> text("Direccion: ".$infodire.".\n");
   $printer -> text("TELL: ".$infocell.".\n");
   $printer->feed();//saltos de lines
   $printer->setPrintLeftMargin(0);
   $printer->setJustification(Printer::JUSTIFY_LEFT);
   $printer->setEmphasis(true);
   $printer->text(addSpaces('cant', 7) . addSpaces('Precio unitario', 16) . addSpaces('Precio de venta', 13) . addSpaces('Total', 15) . "\n");
   $printer->setEmphasis(false);


foreach ($items as $item) {
$printer->text(($item['name'].".\n" ) );
    //Current item ROW 1
    $q = str_split($item['q'], 6);
    foreach ($q as $k => $l) {
        $l = trim($l);
        $q[$k] = addSpaces($l, 7);
    }
    $prece_one = str_split($item['prece_one'], 12);
    foreach ($prece_one as $k => $l) {
        $l = trim($l);
        $prece_one[$k] = addSpaces($l, 13);
    }
    $price_out = str_split($item['price_out'], 12);
    foreach ($price_out as $k => $l) {
        $l = trim($l);
        $price_out[$k] = addSpaces($l, 13);
    }
    $total_price = str_split($item['total_price'], 15);
    foreach ($total_price as $k => $l) {
        $l = trim($l);
        $total_price[$k] = addSpaces($l, 15);
    }


    $counter = 0;
    $temp = [];
    $temp[] = count($q);
    $temp[] = count($prece_one);
    $temp[] = count($price_out);
    $temp[] = count($total_price);
    $counter = max($temp);

    for ($i = 0; $i < $counter; $i++) {
        $line = '';
        if (isset($q[$i])) {
            $line .= ($q[$i]);
        }
        if (isset($prece_one[$i])) {
            $line .= ($prece_one[$i]);
        }
        if (isset($price_out[$i])) {
            $line .= ($price_out[$i]);
        }
        if (isset($total_price[$i])) {
            $line .= ($total_price[$i]);
        }
        $printer->text($line . "\n");
    }

    $printer->feed();
}

$printer->text(addSpaces('', 7) . addSpaces('', 13) . addSpaces('Total:', 13) . addSpaces(number_format(($total/100), 2, ',', '.'), 15) . "\n");

$printer->cut();
$printer->pulse();
$printer->close();
return print(json_encode($resultado));
?>
