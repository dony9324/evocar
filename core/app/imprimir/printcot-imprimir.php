<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");
include "res/escpos-php-master/autoload.php";
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
/* Fill in your own connector here */

try {
	// Este bloque contien el código que pretendemos ejecutar, pero que,
	// llegado el caso, podría fallar, lanzando una exxcepción.
	$connector = new WindowsPrintConnector("EPSON TM-T20II Receipt");

} catch (Exception $e) {
	// Este bloque de código sólo se ejecuta si se ha producido una
	// excepción al intentar ejecutar el bloque previo.
	$resultado = array("estado" => "false", "o" => "no se  2");
	return print(json_encode($resultado));
} finally {
	// Esta parte es opcional y, si existe, se ejecutará tanto si se ha podido efectuar
	// el proceso, como si se ha producido una excepción.
}

/* Information for the receipt */
$infoiva= CompanyData::getById(1)->value;
$infonit= CompanyData::getById(2)->value;
$infocell= CompanyData::getById(3)->value;
$mensaje= CompanyData::getById(4)->value;
$infodire= CompanyData::getById(5)->value;
$total=0;
$total2=0;
$items = array();
$user = UserData::getById($_SESSION["user_id"]);
foreach($_SESSION["cart"] as $p){
	$product = ProductData::getById($p["product_id"]);
$pt = $product->price_out*$p["q"];
 $total +=$pt;
    array_push($items, new item("Nombre: ".$product->name, ""),
    new item("Cant:".$p["q"]."  Valor x 1:"."$".($product->price_out)."  total: "."$".$pt,""), new item("===============================","=================")
    );
	}
$subtotal = new item('Base: ', number_format(($total/(($infoiva/100)+1)),2,".",","));
$tax = new item('iva'.$infoiva."%", number_format((($total/(($infoiva/100)+1))*($infoiva/100)),2,".",","));
$total3 = new item('Total', number_format ($total,2,".",","));
/* Date is kept the same for testing */
 $date = date(' Y-m-d h:i:s A');

/* Start the printer */

$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
try{
 $logo = EscposImage::load("res/img/logo.png", false);
		$printer->bitImage($logo);
}catch(Exception $e){}//No hacemos nada si hay error

$printer -> setFont(Printer::FONT_B);//texto pequeño
$printer -> text("NIT: ".$infonit.".\n");
$printer -> text("Direccion: ".$infodire.".\n");
$printer -> text("TELL: ".$infocell.".\n");
$printer -> setFont(); // Reset
$printer -> selectPrintMode(Printer::MODE_EMPHASIZED);//Modo enfatizado NEGRITA
$printer -> text("Cotizacion .\n");
  $printer -> selectPrintMode(); // Reset
$printer -> setEmphasis(true);//Modo enfatizado NEGRITA
$printer -> feed();
/* Title of receipt */
$printer -> setEmphasis(true);
$printer -> text("PRODUCTOS\n");
$printer -> setEmphasis(false);

/* Items */
$printer -> setFont(Printer::FONT_B);//texto pequeño
$printer -> setJustification(Printer::JUSTIFY_LEFT);
foreach ($items as $item) {
    $printer -> text($item);
}
$printer -> setFont(); // Reset
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
if($mensaje!=null){
	$printer -> text("web: ".$mensaje."\n");
	}

$printer -> feed(1);
$printer -> text($date . "\n");
$printer->setBarcodeHeight(80);
$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
$printer->barcode("9876");
$printer->barcode("ABC");
/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();
	$resultado = array("estado" => "true" );
/* A wrapper to do organise item names & prices into columns */
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
  		$left = str_pad($this -> name, $leftCols) ;
      $sign = ($this -> dollarSign ? '$ ' : '');
      $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
      return "$left$right\n";
    }
}
return print(json_encode($resultado));
?>
