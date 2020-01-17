
<?php if(isset($_GET["id"]) && $_GET["id"]!=""):  //isset esta palabra es para balidar qu esten asignado valores .. ?>
	<?php


$sells = SellData::getById2($_GET["id"]); //resibimos el codigo o nombre
if(count($sells)>0){
	?>
<h3>Resultados de la Busqueda</h3>
<table style="width:100%;"class="table table-bordered table-hover">
	<thead>
		<th>Codigo</th>
        <th>Cliente</th>
        <th>Fecha de venta</th>
        <th>Atendido</th>
				<th>Valor</th>
					<th></th>
			</thead>
	<?php
$sells_in_cero=0;
	 foreach($sells as $sell):
		 $q= PaymentData::getQYesF($_GET["id"]); //esta linea pregunta cuanto dinero falta por pagar
	?>
	<?php
	if($q>0):?>
		<?php $client = PersonData::getById($sell->person_id);
				$user = UserData::getById($sell->user_id);
		?>
	<tr>
		<td style="width:80px;"><?php echo $sell->id; ?></td>
		<td class="<?php if (!($sell->person_id=="" or $sell->person_id==NULL)) {

		 if(isset($client -> name) && $sell->person_id!="" ){echo "\">";}else{ echo 'danger">'; } ?>
		 <?php if(isset($client -> name) && $sell->person_id!=""){
				 echo $sell->person_id ." ". $client -> name . " ".$client -> lastname ;
			 }else{ echo "ERROR. El Cliente fue eliminado";
			 }}else {
			 	echo "\">";
			 }
				 ?></td>
        <td><?php echo $sell->created_at; ?></td>
		<td><?php echo $user -> name . " ".$user -> lastname ; ?></td>
        <td><?php  echo number_format(($sell->total/100), 2, ',', '.'); ?></td>

		<td style="width:250px;"><form method="post" action="index.php?view=addtocart2" >
		<input type="hidden" name="sell_id" value="<?php echo $sell->id; ?>">

<div class="input-group">
	     <span class="input-group-btn">
		<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-plus-sign"></i>Elegir</button>
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

}else{
	echo "<br><p class='alert alert-danger'>No se encontro Venta</p>";
}


?>
<hr><br>
<?php else:
?>
<?php endif; ?>
