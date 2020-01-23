
<?php if(isset($_GET["cc"]) && $_GET["cc"]!=""):  //isset esta palabra es para balidar qu esten asignado valores .. ?>
	<?php


	$sells = SellData::getByperson_id($_GET["cc"]); //resibimos el codigo o nombre
	if(count($sells)>0){


		?>
		<h3>Resultados de la Busqueda</h3>
		<table style="width:100%;" class="table table-bordered table-hover">
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

				if ($sell->accredit ==1){
					$q= PaymentData::getQYesF($sell->id); //esta linea pregunta cuanto dinero falta por pagar
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
					<td><?php echo number_format(($sell->total/100),2,',','.'); ?></td>
					<td><?php echo number_format(($sell->total - $q)/100),2,',','.'; ?></td>
					<td><b>$<?php echo number_format($q,2,',','.'); ?></b></td>

					<td style="width:250px;"><form id="form<?php echo $sell->id; ?>" >
						<input type="hidden" id="sell_id<?php echo $sell->id;?>" name="sell_id" value="<?php echo $sell->id; ?>">

						<div class="input-group">
							<input id="money<?php echo $sell->id; ?>" onchange="validarmoney(<?php echo $sell->id; ?>);" onkeyup="validarmoney(<?php echo $sell->id; ?>);" type="text" class="money form-control" required name="q" placeholder="Valor ..." autocomplete="off">
							<span class="input-group-btn">
								<button type="button"  id="agregar<?php echo $sell->id; ?>"  onclick="addtocart2(<?php echo $sell->id; ?>)" class="btn btn-info"><i class="glyphicon glyphicon-plus-sign"></i>Agregar</button>
							</span>
						</div>
						<span id="spanmoney<?php echo $sell->id; ?>"></span>

					</form></td>
				</tr>
				<script>
				$('#form<?php echo $sell->id; ?>').on('submit', function(e){
				    e.preventDefault();
				    return false;
				});
				</script>
			<?php else:$sells_in_cero++;
			?>
		<?php  endif;} ?>
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

<script>
//funcion para enmascarar http://igorescobar.github.io/jQuery-Mask-Plugin/docs.html
jQuery(function($){
	$('.money').mask('000.000.000,00', {reverse: true});

	///aqui enmascaramos los campos que no tengan avilitado la divicion del producto para que solo admitan enteros
	$('.entero').mask('000.000');
});

function validarmoney(id){
	console.log("validarmoney");
	NEMEM = $('#money'+id).cleanVal()/100;
	nuu = numeroALetras(NEMEM, {
		plural: 'PESOS',
		singular: 'PESO',
		centPlural: 'CENTAVOS',
		centSingular: 'CENTAVO'
	});
	$("#spanmoney"+id).html(nuu);
}



function addtocart2(id) {
$('.money').unmask();
	$("#agregar"+id).prop('disabled', true);
	console.log("addtocart2"+id);

	$.post("./?action=addtocart2",{
		q: $("#money"+id).val(),
		sell_id: $("#sell_id"+id).val()
	},function(data){

			$("#show_search_results").html(data);
		//$("#cart").load("./?action=viewcart")
	});
	$("#agregar"+id).prop('disabled', false);
}
</script>
