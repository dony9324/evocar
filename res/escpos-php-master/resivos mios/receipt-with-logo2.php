<?php
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;



include "../../core/autoload.php";
include "../../core/app/model/PersonData.php";
include "../../core/app/model/UserData.php";
include "../../core/app/model/SellData.php";
include "../../core/app/model/OperationData.php";

include "../../core/app/model/ProductData.php";
include "../../core/app/model/CompanyData.php";
include "../../core/app/model/PaymentData.php";





/* Fill in your own connector here */
$connector = new WindowsPrintConnector("Enviar a OneNote 2013");

/* Information for the receipt */
$infoiva= CompanyData::getById(1)->value;
$infonit= CompanyData::getById(2)->value;
$infocell= CompanyData::getById(3)->value;
$infoweb= CompanyData::getById(4)->value;
$infodire= CompanyData::getById(5)->value;

$payment= PaymentData::getById($_GET["id"]);
$sell = SellData::getById($payment->sell_id);
$client = PersonData::getById($sell->person_id);
$user = UserData::getById($payment->user_id);
$q= PaymentData::getQYesF($payment->sell_id);









$items = array();
    array_push($items, new item("Codigo de pago: ".$payment->id, "Codigo de venta: ".$payment->sell_id),
    new item("Cantidad pagada"."$".number_format($payment->payment,2,".",","), "Faltante: "."$".number_format($q,2,".",",")), new item("===============================","=================")
    );
//	$total+=$operation->q*$product->price_out;

//$subtotal = new item('Subtotal: ', number_format($total,2,".",","));
//$dis = new item('Descuento', number_format($discount,2,".",","));
//$dis2 = $discount;
//$tax = new item('iva'.$infoiva."%", number_format(($total*$infoiva/100),2,".",","));
//$total = new item('Total', number_format($total-$discount,2,".",","), true);
/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');
$date = $payment->created_at;

/* Start the printer */
$logo = EscposImage::load("resources/escpos-php.png", false);
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
//$printer -> text("Factura No. ".$sell->id.".\n");
$printer -> setEmphasis(true);
//if($sell->accreditlast==1){$printer -> text("Acreditado.\n");}
$printer -> feed();

/* Title of receipt */
$printer -> setEmphasis(true);
$printer -> text("pago de credito\n");
$printer -> setEmphasis(false);

/* Items */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
//$printer -> text(new item('', '$'));
$printer -> setEmphasis(false);
foreach ($items as $item) {
    $printer -> text($item);
}
$printer -> setEmphasis(true);
//$printer -> text($subtotal);
$printer -> setEmphasis(false);
//$printer -> feed();

/* Tax and total */
//$printer -> text($tax);
//if ($dis2<0){
//$printer -> text($dis);}
//$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
//$printer -> text($total);
//$printer -> selectPrintMode();

/* Footer */
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Gracias por sus compras\n");
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
        $rightCols = 10;
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