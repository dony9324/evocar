
<div class="btn-group pull-right">
<a href="res/escpos-php-master/receipt-with-logo2.php?id=<?php echo $_GET["id"];?>"  class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Imprimir</a>  
  
</div>
<h1>Resumen de Pago</h1>
<?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>
<?php
$payment= PaymentData::getById($_GET["id"]);
$sell = SellData::getById($payment->sell_id);
$client = PersonData::getById($sell->person_id);
$user = UserData::getById($payment->user_id);
$q= PaymentData::getQYesF($payment->sell_id);
?>

<table style="width:100%;" class="table table-bordered">

<tr>
	<td style="width:150px;">Cliente</td>
	<td class="<?php if(isset($client -> name) && $sell->person_id!="" ): else: echo 'danger'; endif; ?>"><?php if(isset($client -> name) && $sell->person_id!=""):
				 echo $sell->person_id ." ". $client -> name . " ".$client -> lastname ; 
				  else: echo "ERROR. El Cliente fue eliminado";
				 endif;
				 ?></td>
</tr>

<?php endif; ?>


<tr>
	<td>Atendido por</td>
	<td><?php echo $user->name." ".$user->lastname;?></td>
</tr>

</table>
<br><table style="width:100%;" class="table table-bordered table-hover">
	<thead>
		<th>Codigo del pago</th>
		<th>Codigo del Venta</th>
		<th>cantidad pagado</th>
        <th>Faltante por pagar</th>
		<th>Atendido por</th>
		<th>Cliente</th>

	</thead>
<tr>
	<td><?php echo $payment->id ;?></td>
	<td><?php echo $payment->sell_id ;?></td>
    <td><?php echo $payment->payment ;?></td>
    <td><?php echo $q ;?></td>
	<td><?php echo $user -> name . " ".$user -> lastname ;?></td>
	<td class="<?php if(isset($client -> name) && $sell->person_id!="" ): else: echo 'danger'; endif; ?>"><?php if(isset($client -> name) && $sell->person_id!=""):
				 echo $sell->person_id ." ". $client -> name . " ".$client -> lastname ; 
				  else: echo "ERROR. El Cliente fue eliminado";
				 endif;
				 ?></td>
    
	
</tr>

</table>

<?php unset($_SESSION["cart2"]); ?>
<br><br>
<div class="row">
<div class="col-md-4">
<table style="width:100%;" class="table table-bordered">
	
</table>
</div>
</div>

	
