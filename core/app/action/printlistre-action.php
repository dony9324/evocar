<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");
include "res/escpos-php-master/autoload.php";

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/*
	Este ejemplo imprime un
	ticket de venta desde una impresora térmica
*/


/*
  Aquí,  el nombre de mi impresora
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/



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


$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(addSpaces('Item', 20) . addSpaces('QtyxPrice', 20) . addSpaces('Tot(f)', 8) . "\n");
$printer->setEmphasis(false);
$items = [];
$items[] = [
    'name' => 'The name of the product 1 goes here',
    'qtyx_price' => '100.00',
    'total_price' => '100.00',
    'igst' => '14.00',
    'cgst' => '14.00',
    'mrp' => '14.00',
    'upr' => '14.00',
];
$items[] = [
    'name' => 'The name of the product 2 goes here',
    'qtyx_price' => '200.00',
    'total_price' => '200.00',
    'igst' => '14.00',
    'cgst' => '14.00',
    'mrp' => '14.00',
    'upr' => '14.00',
];

foreach ($items as $item) {

    //Current item ROW 1
    $name_lines = str_split($item['name'], 15);
    foreach ($name_lines as $k => $l) {
        $l = trim($l);
        $name_lines[$k] = addSpaces($l, 20);
    }

    $qtyx_price = str_split($item['qtyx_price'], 15);
    foreach ($qtyx_price as $k => $l) {
        $l = trim($l);
        $qtyx_price[$k] = addSpaces($l, 20);
    }

    $total_price = str_split($item['total_price'], 8);
    foreach ($total_price as $k => $l) {
        $l = trim($l);
        $total_price[$k] = addSpaces($l, 8);
    }

    $counter = 0;
    $temp = [];
    $temp[] = count($name_lines);
    $temp[] = count($qtyx_price);
    $temp[] = count($total_price);
    $counter = max($temp);

    for ($i = 0; $i < $counter; $i++) {
        $line = '';
        if (isset($name_lines[$i])) {
            $line .= ($name_lines[$i]);
        }
        if (isset($qtyx_price[$i])) {
            $line .= ($qtyx_price[$i]);
        }
        if (isset($total_price[$i])) {
            $line .= ($total_price[$i]);
        }
        $printer->text($line . "\n");
    }

    //Current item ROW 2
    $igst_lines = str_split($item['igst'], 15);
    foreach ($igst_lines as $k => $l) {
        $l = trim($l);
        $igst_lines[$k] = addSpaces($l, 20);
    }

    $cgst_price = str_split($item['cgst'], 28);
    foreach ($cgst_price as $k => $l) {
        $l = trim($l);
        $cgst_price[$k] = addSpaces($l, 28);
    }


    $counter = 0;
    $temp = [];
    $temp[] = count($igst_lines);
    $temp[] = count($cgst_price);
    $counter = max($temp);

    for ($i = 0; $i < $counter; $i++) {
        $line = '';
        if (isset($igst_lines[$i])) {
            $line .= ($igst_lines[$i]);
        }
        if (isset($cgst_price[$i])) {
            $line .= ($cgst_price[$i]);
        }

        $printer->text($line . "\n");
    }

    //Current item ROW 3
    $mrp_lines = str_split($item['mrp'], 15);
    foreach ($mrp_lines as $k => $l) {
        $l = trim($l);
        $mrp_lines[$k] = addSpaces($l, 20);
    }

    $upr_price = str_split($item['upr'], 28);
    foreach ($upr_price as $k => $l) {
        $l = trim($l);
        $upr_price[$k] = addSpaces($l, 28);
    }


    $counter = 0;
    $temp = [];
    $temp[] = count($mrp_lines);
    $temp[] = count($upr_price);

    $counter = max($temp);

    for ($i = 0; $i < $counter; $i++) {

        $line = '';

        if (isset($mrp_lines[$i])) {
            $line .= ($mrp_lines[$i]);
        }

        if (isset($upr_price[$i])) {
            $line .= ($upr_price[$i]);
        }

        $printer->text($line . "\n");
    }
    $printer->feed();
}





$printer->cut();
$printer->pulse();
$printer->close();

return print(json_encode($resultado));






/* mañana revisa



use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
/* Fill in your own connector here */
/*
  Aquí,  el nombre de mi impresora
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/
$nombre_impresora = "EPSON TM-T20II Receipt";
$connector = new WindowsPrintConnector("$nombre_impresora)");

/* Information for the receipt */
$infoiva= CompanyData::getById(1)->value;
$infonit= CompanyData::getById(2)->value;
$infocell= CompanyData::getById(3)->value;
$infoweb= CompanyData::getById(4)->value;
$infodire= CompanyData::getById(5)->value;
$total=0;
$total2=0;
$items = array();
$user = UserData::getById($_SESSION["user_id"]);
foreach($_SESSION["reabastecer"] as $p){
	$product = ProductData::getById($p["product_id"]);
$pt = $p["price_in"]*$p["q"];
 $total +=$pt;
    array_push($items, new item("Nombre: ".$product->name, ""),
    new item("Cantida:".$p["q"]."  Valor x 1:"."$".($p["price_out"])."  total: "."$".$pt,""), new item("===============================","=================")
    );
	}
$subtotal = new item('Base: ', number_format(($total/(($infoiva/100)+1)),2,".",","));
$tax = new item('iva'.$infoiva."%", number_format((($total/(($infoiva/100)+1))*($infoiva/100)),2,".",","));
$total3 = new item('Total', number_format ($total,2,".",","));
/* Date is kept the same for testing */
 $date = date(' Y-m-d h:i:s A');

/* Start the printer */
/*
	Intentaremos cargar e imprimir
	el logo
*/


$printer = new Printer($connector);
# Vamos a alinear al centro lo próximo que imprimamos
$printer -> setJustification(Printer::JUSTIFY_CENTER);
try{
	$logo = EscposImage::load("res/img/escpos-php.jpg", false);
    $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}

$printer -> graphics($logo);

/*
	Ahora vamos a imprimir un encabezado, Nombre de la tienda
*/

$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("Ferreteria la Bendicion.\n");
$printer -> selectPrintMode();
$printer -> text("NIT: ".$infonit.".\n");
$printer -> text("Direccion: ".$infodire.".\n");
$printer -> text("TELL: ".$infocell.".\n");
$printer -> text("Cotisacion .\n");
$printer -> setEmphasis(true);

$printer -> feed();

/* Título del recibo */
$printer -> setEmphasis(true);
$printer -> text("PRODUCTOS\n");
$printer -> setEmphasis(false);

/* Items */
	/*Alinear a la izquierda para la cantidad y el nombre*/
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
//$printer -> text(new item('', '$'));
$printer -> setEmphasis(false);
foreach ($items as $item) {
    $printer -> text($item);
}
$printer -> feed();
$printer -> setEmphasis(true);
$printer -> text($subtotal);
$printer -> setEmphasis(true);


/* Tax and total */
$printer -> text($tax);

$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text($total3);
$printer -> selectPrintMode();

/* Footer */
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Gracias por su compra\n");
$printer -> text("Atendido por: ".$user->name." ".$user->lastname."\n");
if($infoweb!=null){
	$printer -> text("web: ".$infoweb."\n");
	}
$printer -> feed(1);
$printer -> text($date . "\n");

/* Cortar el recibo y abrir el cajón de dinero.*/
//$printer -> cut();
$printer -> pulse();

$printer -> close();
	$resultado = array("estado" => "true" );
/* Un contenedor para organizar nombres de artículos y precios en columnas */
class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 0;
        $leftCols = 27;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}



*/



?>
