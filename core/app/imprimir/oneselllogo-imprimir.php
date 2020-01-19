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
$infoweb= CompanyData::getById(4)->value;
$infodire= CompanyData::getById(5)->value;

$sell = SellData::getById($_GET["id"]);
$operations = OperationData::getAllProductsBySellId($_GET["id"]);
$discount = $sell-> discount;
if($sell->person_id!=null){ $client = $sell->getPerson();}
$user = $sell->getUser();
$total=0;

$items = array();

foreach($operations as $operation){
	$product = $operation->getProduct();



    array_push($items, new item("Nombre: ".$product->name," "),
    new item("Cantida:".$operation->q . " Valor x 1:"."$".$product->price_out. " total:"."$".$operation->q*$product->price_out,""), new item("===============================","=================")
    );
	$total+=$operation->q*$product->price_out;
	}
$subtotal = new item('Base: ', number_format(($total/(($infoiva/100)+1)),2,".",","));
$dis = new item('Descuento', number_format($discount,2,".",","));
$dis2 = $discount;
$tax = new item('iva'.$infoiva."%", number_format((($total/(($infoiva/100)+1))*($infoiva/100)),2,".",","));
$total = new item('Total', number_format($total-$discount,2,".",","), true);
/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');
$date = $sell->created_at;

/* Start the printer */

$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
try{
 $logo = EscposImage::load("res/img/logo.png", false);
		$printer->bitImage($logo);
		//$printer -> graphics($logo);
}catch(Exception $e){}//No hacemos nada si hay error


/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("Ferreteria la Bendicion.\n");
$printer -> selectPrintMode();
$printer -> text("NIT: ".$infonit.".\n");
$printer -> text("Direccion: ".$infodire.".\n");
$printer -> text("TELL: ".$infocell.".\n");
$printer -> text("Factura No. ".$sell->id.".\n");
$printer -> setEmphasis(true);
if($sell->accreditlast==1){$printer -> text("Acreditado.\n");}
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
$printer -> text($subtotal);
$printer -> setEmphasis(true);


/* Tax and total */
$printer -> text($tax);
if ($dis2<0){
$printer -> text($dis);}
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text($total);
$printer -> selectPrintMode();

/* Footer */
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Gracias por su compra\n");
if($sell->person_id!=null){
	$printer -> text("Cliente: ".$client->name." ".$client->lastname."\n");
	}


$printer -> text("Atendido por: ".$user->name." ".$user->lastname."\n");
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
return print(json_encode($resultado));
?>
<script>
	//window.history.back();
</script>
