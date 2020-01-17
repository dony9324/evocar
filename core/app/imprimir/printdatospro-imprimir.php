<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");
include "res/escpos-php-master/autoload.php";
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
/*
	Este ejemplo muestra los formatos de texto que puedo usar
*/
/*
  Aquí,  el nombre de mi impresora
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/
$connector = new WindowsPrintConnector("EPSON TM-T20II Receipt");
$printer = new Printer($connector);
$codigo ="+.".$_GET["id"];
$q = $_GET["q"];
$name = $_GET["name"];
$printer -> setJustification(Printer::JUSTIFY_CENTER);
// Códigos de barras - ver barcode.php para más detalles
$printer -> setFont(Printer::FONT_A);//texto pequeño
$printer -> text("Nombre: ".$name.".\n");
$printer -> text("Disponible: ".$q.".\n");
$printer->setBarcodeHeight(80);
$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
$printer->barcode($codigo);

//$printer->feed();
$printer->cut(Printer::CUT_PARTIAL);//corte imcompleto
$printer -> close();
return print(json_encode($resultado));
?>
