<div class="row">
	<div class="col-md-12">

		<h1><i class='glyphicon glyphicon-book'></i> Pagos de credito Nº:<?php echo $_GET["id"];?></h1>
		<div class="clearfix"></div>


<?php
$d = SellData::getById($_GET["id"]);
$q = PaymentData::getQYesF($_GET["id"]);
$products = PaymentData::getAllByProductId($_GET["id"]);
if(count($products)>0){
$total_total = 0;
?>
<br>
<table style="width:100%;" class="table table-bordered table-hover	">
	<thead>
		<th>Total</th>
		<th>Fecha</th>
	</thead>
	<?php foreach($products as $sell):?>
 

	<tr>
		<td><?php echo $sell->payment;?></td>
		<td><?php $total_total = $total_total + $sell->payment; echo $sell->created_at; ?></td>
	</tr>

<?php  endforeach; ?>

</table>
<h1>Valor del credito: <?php echo"$ ".number_format($d->total  -	$d->discount,2,'.',','); ?></h1>
<h1>Total pagado: <?php echo "$ ".number_format($total_total,2,".",","); ?></h1>
<h1> <?php if ($q == 0){ echo "Cridito pagado";}else{echo " Deuda: $ ".number_format($q);}?> </h1>


	<?php
}else {

?>
	<div class="jumbotron">
		<h2>No hay Pagos</h2>
		<p>No se ha realizado ningun pago a este credito.</p>
	</div>

<?php } ?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>