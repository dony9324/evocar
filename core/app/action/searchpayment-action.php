
<?php if(isset($_GET["sell"]) && $_GET["sell"]!=""):  //isset esta palabra es para balidar qu esten asignado valores .. ?>
	<?php
	
	
$sells = SellData::getById2($_GET["sell"]); //resibimos el codigo o nombre 
if(count($sells)>0){
	
	if ($sells[0]->accredit ==1){
	?>
<h3>Resultados de la Busqueda</h3>
<table style="width:100%;"class="table table-bordered table-hover">
	<thead>
		<th>Codigo</th>
        <th>Cliente</th>
        <th>Fecha de venta</th>
        <th>Atendido</th>
		<th>Valor</th>
		<th>Pagado</th>
		<th>Deuda</th>
		<th>Valor a pagar</th>
	</thead>
	<?php
$sells_in_cero=0;
	 foreach($sells as $sell):
$q= PaymentData::getQYesF($_GET["sell"]); //esta linea pregunta cuanto dinero falta por pagar
	?>
	<?php 
	if($q>0):?>
		<?php $client = PersonData::getById($sell->person_id);
				$user = UserData::getById($sell->user_id);
		?>
	<tr>
		<td style="width:80px;"><?php echo $sell->id; ?></td>
		<td class="<?php if(isset($client -> name) && $sell->person_id!="" ): else: echo 'danger'; endif; ?>"><?php if(isset($client -> name) && $sell->person_id!=""):
				 echo $sell->person_id ." ". $client -> name . " ".$client -> lastname ; 
				  else: echo "ERROR. El Cliente fue eliminado";
				 endif;
				 ?></td>
        <td><?php echo $sell->created_at; ?></td>
		<td><?php echo $sell->user_id." ". $user -> name . " ".$user -> lastname ; ?></td>
        <td><?php echo $sell->total; ?></td>
        <td><?php echo ($sell->total - $q); ?></td>
		<td><b>$<?php echo $q; ?></b></td>
		
		<td style="width:250px;"><form method="post" action="index.php?view=addtocart2" >
		<input type="hidden" name="sell_id" value="<?php echo $sell->id; ?>">

<div class="input-group">
		<input type="" class="form-control" required name="q" placeholder="Valor ...">
      <span class="input-group-btn">
		<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-plus-sign"></i>Agregar</button>
      </span>
    </div>


		</form></td>
	</tr>
	
<?php else:$sells_in_cero++;
?>
<?php  endif; ?>
	<?php endforeach;?>
</table>
<?php if($sells_in_cero>0){ echo "<p class='alert alert-success'>Se omitieron <b>$sells_in_cero creditos </b> que no tienen deuda. <a href='index.php?view=credits'>Ir a Creditos</a></p>"; }?>

	<?php 
	}else{echo "<br><p class='alert alert-info'>Esta venta no fue acreditada</p>";}
}else{
	echo "<br><p class='alert alert-danger'>No se encontro Venta</p>";
}


?>
<hr><br>
<?php else:
?>
<?php endif; ?>