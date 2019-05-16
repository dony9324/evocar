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


$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);

$printer->text(addSpaces('Item', 20) . addSpaces('cant', 5) .addSpaces('precio', 12) . addSpaces('Total', 11) . "\n");
$printer->setEmphasis(false);
$items = [];
$items[] = [
    'name' => 'El nombre del producto 1 va aquí.',
    'qtyx_price' => '100',
    'total_price' => '1000',
    'igst' => '14.00',
    'cgst' => '14.00',
    'mrp' => '14.00',
    'upr' => '14.00',
];
$items[] = [
    'name' => 'El nombre del producto 1 va aquí.',
    'qtyx_price' => '200',
    'total_price' => '200.00',
    'igst' => '14.00',
    'cgst' => '14.00',
    'mrp' => '14.00',
    'upr' => '14.00',
];

foreach ($items as $item) {
    //Current item ROW 1
    $name_lines = str_split($item['name'], 18);
    foreach ($name_lines as $k => $l) {
        $l = trim($l);
        $name_lines[$k] = addSpaces($l, 20);
    }

    $qtyx_price = str_split($item['qtyx_price'], 4);
    foreach ($qtyx_price as $k => $l) {
        $l = trim($l);
        $qtyx_price[$k] = addSpaces($l, 5);
    }
    $total_price = str_split($item['total_price'], 11);
    foreach ($total_price as $k => $l) {
        $l = trim($l);
        $total_price[$k] = addSpaces($l, 12);
    }
    $igst = str_split($item['igst'], 11);
    foreach ($igst as $k => $l) {
        $l = trim($l);
        $igst[$k] = addSpaces($l, 11);
    }
    $counter = 0;
    $temp = [];
    $temp[] = count($name_lines);
    $temp[] = count($qtyx_price);
    $temp[] = count($total_price);
    $temp[] = count($igst);
    $counter = max($temp);
//aque organisamos las lineas
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
        if (isset($igst[$i])) {
            $line .= ($igst[$i]);
        }
        $printer->text($line . "\n");
    }

    //Current item ROW 2
    $igst_lines = str_split($item['igst'], 18);
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
    $printer->feed();
}





$printer->cut();
$printer->pulse();
$printer->close();

/*
  $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);//MODO DOBLE ANCHO
  $printer -> text("TEXTO mas ancho.\n");
  $printer -> selectPrintMode();
  $printer -> selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);//MODO DOBLE ALTO
  $printer -> text("TEXTO mas ALTO.\n");
  $printer -> selectPrintMode();
  $printer -> selectPrintMode(Printer::MODE_UNDERLINE);//MODO BAJO sutrallado
  $printer -> text("MODO BAJO subrrallado.\n");
  $printer -> selectPrintMode();
  $printer -> setFont(Printer::FONT_A);
  $printer -> text("texto pequeño letra A LALALALA-LÁ\n");
  $printer -> setFont(Printer::FONT_B);
  $printer -> text("TEXTO MAS PEQUEÑO pequeño letra B\n");
  $printer -> setFont(); // Reset
  $printer -> text("LETRA DESPUES DE Reset\n");
  $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);//Modo enfatizado NEGRITA
  $printer -> text("TEXTO negrita");
  $printer -> selectPrintMode(); // Reset
  $printer -> text("\n");
  $printer -> setFont(); // Reset
  $printer->setJustification(Printer::JUSTIFY_CENTER);//Vamos a alinear al centro lo próximo que imprimamos
  $printer -> text("TEXTO centrado\n");
  $printer->setJustification(Printer::JUSTIFY_LEFT);//Vamos a alinear ala derecha lo próximo que imprimamos
  $printer -> text("Texto ala izquierda\n");
  $printer->setJustification(Printer::JUSTIFY_RIGHT);//Vamos a alinear ala derecha lo próximo que imprimamos
  $printer->text("Texto ala derecha\n");
  $printer->feed();//saltos de lines

//	Intentaremos cargar e imprimir el logo

  $printer->feed();//saltos de lines
$printer->setJustification(Printer::JUSTIFY_CENTER);

try{
	$logo = EscposImage::load("res/img/logo.png", false);
    $printer->bitImage($logo);
}catch(Exception $e){//No hacemos nada si hay error}
  $printer->feed();//saltos de lines
// Text of various (in-proportion) sizes
$printer -> setTextSize(1, 2);
$printer -> text("TEXTO DE OTRO TAMAÑO 1 - 8\n");

// Códigos de barras - ver barcode.php para más detalles
$printer->setBarcodeHeight(80);
$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
$printer->barcode("9876");
$printer->feed();
$printer->cut(Printer::CUT_PARTIAL);//corte imcompleto
$printer -> cut(); //cortar papel
$printer -> close();
*/
return print(json_encode($resultado));
?>
