<?php


/*include "core/app/model/PersonData.php";
include "core/app/model/UserData.php";
include "core/app/model/SellData.php";
include "core/app/model/OperationData.php";

include "core/app/model/ProductData.php";
include "core/app/model/CompanyData.php";
/* Fill in your own connector here */

/* Information for the receipt */

$products = ProductData::getAll();

$infoiva= CompanyData::getById(1)->value;
$infonit= CompanyData::getById(2)->value;
$infocell= CompanyData::getById(3)->value;
$infoweb= CompanyData::getById(4)->value;
$infodire= CompanyData::getById(5)->value;
$stock=0;
$total2=0;
$items = array();

$user = UserData::getById($_SESSION["user_id"]);

foreach($products as $product){
	
	$q=OperationData::getQYesF($product->id);
    if($q<=$product->inventary_min){
		$stock+=1;
    array_push($items, new item("Nombre: ".$product->name,""), new item("Dispobible:".$q."  Minima:".($product->inventary_min). "  costo:"."$".$product->price_in), new item("===============================","=================")
    );
	}
	}
/* libreria deden ir debajo del uso de la clases de los modelo o da error */
	
	require "res/escpos-php-master/autoload.php";
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$connector = new WindowsPrintConnector("Canon MG2400 series Printer");
	
	
	
	
/* Date is kept the same for testing */
 $date = date(' Y-m-d h:i:s A');


/* Start the printer */
$logo = EscposImage::load("res/img/escpos-php.png", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);

/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("Ferreteria la Bendicion.\n");
$printer -> selectPrintMode();
$printer -> text("NIT: ".$infonit.".\n");
$printer -> text("Direccion: ".$infodire.".\n");
$printer -> text("TELL: ".$infocell.".\n");
$printer -> text("ALERTAS DE INVENTARIO.\n");
$printer -> setEmphasis(true);

$printer -> feed();

/* Title of receipt */
$printer -> setEmphasis(true);
$printer -> text("PRODUCTOS\n");
$printer -> setEmphasis(false);

/* Items */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
//$printer -> text(new item('', '$'));
$printer -> setEmphasis(false);
foreach ($items as $item) {
    $printer -> text($item);
}
$printer -> feed();
$printer -> setEmphasis(true);
$printer -> text("total productos: ".$stock);
$printer -> setEmphasis(true);


/* Tax and total */

$printer -> selectPrintMode();

/* Footer */
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_CENTER);

$printer -> text("Usuario: ".$user->name." ".$user->lastname."\n");
if($infoweb!=null){
	$printer -> text("web: ".$infoweb."\n");
	}
$printer -> feed(1);
$printer -> text($date . "\n");

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();

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
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;
        
        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
?>
<script>
	window.history.back();
</script>