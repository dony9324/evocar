<?php if(isset($_GET["product"]) && $_GET["product"]!=""):  //isset esta palabra es para balidar qu esten asignado valores .. ?>
	<div id="testDiv" class="box-body">
		<div id="detallesproducto">

		</div>
		<?php
/*////str_split ( string $string [, int $split_length = 1 ] ) : array
string
El string de entrada.

split_length
Longitud máxima del fragmento.
ejemplo
$str = "Hello Friend";
$arr1 = str_split($str);
$arr2 = str_split($str, 3);
print_r($arr1);
print_r($arr2);
*/

		if($_GET["product"]==="  *"){ //este es para mostrar todos los productos
			$products = ProductData::getAll();
		}else {
			$products = ProductData::getLike(addslashes($_GET["product"])); //resibimos el codigo o nombre . addslashe esta es para formater la cadena i eliminar las comillas
		}
		if(count($products)>0){
			?>
			<script>
			function masdetalles(id){
			console.log("masdetalles"+id);
				//estalinea es por un error de doble ventana he impide que se abra dosveces el modal
			$(".masdetalles").prop('disabled', true);
			$.get("./?action=detallesoneproduct",
			{
			id: id
			},
			function(data){
				$("#detallesproducto").html(data);
				$('#myModaldetalles').modal('show');
				$(".masdetalles").prop('disabled', false);
			});
			}


			function newclient(){
				//estalinea es por un error de doble ventana he impide que se abra dosveces el modal
				$(".masdetalles").prop('disabled', true);
				console.log("nuevo Cliente")
				$.get("./?action=newclient",function(data){
					$("#newcliente").html(data);
					$('#myModal').modal('show');
					$("#btnnewclient").prop('disabled', false);
				});
			}
			</script>
			<style>
			input[type=number]::-webkit-outer-spin-button,
			input[type=number]::-webkit-inner-spin-button {	-webkit-appearance: none;	margin: 0; }
			input[type=number] {-moz-appearance:textfield; }
			</style>
			<table style="width:100%;"  class="table table-bordered text-center">
				<thead>
					<tr>
						<th style="width:auto;">id</th>
						<th style="width:auto;"></th>
						<th>Nombre</th>
						<th >Costo</th>
						<th>Precio</th>
						<th>Disponible</th>
						<th>Cantidad</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$productsnotq="";
					$products_in_cero=0;
					foreach($products as $product):
						$precio=OperationData::getQprice($product->id);
						// $q= $precio["q"];
							$q = OperationData::getQYesF($product->id);
						?>
						<?php
						///
						?>
						<tr class="<?php if($product->control_stock==1){ if($q<=$product->inventary_min && $q>0){ echo "warning"; } if(!($q<=$product->inventary_min)){echo "success";}  if(!$q>0){ echo "danger"; }}else { 	}?>">
								<td style="width:auto;"><?php echo $product->id; ?></td>
							<td> <button onclick="masdetalles(<?php echo $product->id; ?>)" type="button" class="masdetalles btn btn-success btn-flat" style=" vertical-align: middle; width: 35px;"><i class="fa fa-tags" ></i></button></td>
							<td>  <?php echo $product->name; ?></td>



							<td><b>$ <?php echo number_format(($product->price_in/100), 2, ',', '.'); ?></b></td>
							<td><b>$<?php if ($precio["Precio"]>0) {echo number_format(($precio["Precio"]/100), 2, ',', '.'); }else{
								echo number_format(($product->price_out/100), 2, ',', '.');}?></b></td>
							<td>	<?php echo $q; ?>	</td>
							<td style="width:250px;">
								<input type="hidden" id="id<?php echo $product->id; ?>" value="<?php echo $product->price_out; ?>">
								<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
								<div class="input-group">
									<button onClick="men1(<?php echo $product->id; ?>)" type="button" class="btn btn-warning btn-flat" style="display: block; float: left; vertical-align: middle; width: 34px;">-</button>
									<input id="<?php echo $product->id; ?>" style="width: 50px; " type="<?php if($product->divide==0) { echo 'text'; }
									else{ echo "number";}?>"  min="0" value="1" autocomplete="off"
									step=" <?php  if($product->divide==1) {  echo 'ani'; }?>"
										class="form-control <?php if($product->divide==0) { echo 'entero'; }?>" name="q"<?php if($product->divide==1) { ?> onFocus="changervalor(<?php echo $product->id;?>)" <?php }else{ ?> onFocus="nochangervalor()"<?php } ?>)>
									<button onClick="mas1(<?php echo $product->id; ?>)" type="button" class="btn btn-success btn-flat" style="display: block; vertical-align: middle; width: 35px;">+</button>
									<span class="input-group-btn">
										<button id="btnaddtocar<?php echo $product->id; ?>" class="btn btn-success" onClick="addtocart(<?php echo $product->id; ?>)"> Agregar</button>
									</span>
								</div>
							</td>
						</tr>

						<?php 	if($q>0):///
						else:
							$productsnotq = $productsnotq . "
							<tr class='danger'>
							<td>". $product->name ."</td>
							<td><b>$". number_format(($product->price_out/100), 2, ',', '.') ."</b></td>
							<td><b>$ ". number_format(($product->price_in/100), 2, ',', '.') ."</b></td>
							<td>	". $q ."	</td>
							</tr>
							";
							$products_in_cero++;
							?>
						<?php  endif; ?>
					<?php endforeach;?>
					<script>
					///aqui enmascaramos los campos que no tengan avilitado la divicion del producto para que solo admitan enteros
					$('.entero').mask('000.000');
					</script>
				</tbody>
				<tfoot>
					<tr>
						<th style="width:auto;">id</th>
						<th style="width:auto;"></th>
						<th>Nombre</th>
						<th>Costo</th>
						<th>Precio</th>
						<th>Disponible</th>
						<th>Cantidad</th>
					</tr>
				</tfoot>
			</table>
			<?php if($products_in_cero>0){ echo "<p class='alert alert-warning'>Existen <b>$products_in_cero productos</b>
				en lista, que no tienen existencias en el inventario. <a href=''data-toggle='modal' data-target='.bd-example-modal-lg'>Ver</a> </p>
				<div class='modal modal bd-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
				<div class='modal-dialog modal-lg'>
				<div class='modal-content'>
				<div class='box'id='testDiv2'>
				<div class='box-header'>
				<h3 class='box-title'>Productos sin existencias</h3>
				</div>
				<!-- /.box-header -->
				<div class='box-body no-padding'>
				<table style='width:100%;' id='example2' class='table table-bordered table-hover'>
				<thead>
				<tr>
				<th>Nombre</th>
				<th>Precio unitario</th>
				<th >Precio de Compra</th>
				<th>En inventario</th>
				</tr>
				</thead>
				<tbody>".
				$productsnotq
				."
				</tbody>
				<tfoot>
				<tr>
				<th>Nombre</th>
				<th>Precio unitario</th>
				<th>Precio de Compra</th>
				<th>En inventario</th>
				</tr>
				</tfoot>
				</table>
				</div>
				</div>
				</div> "; }?>
				<?php
			}else{
				echo "<div class='row'><p class='alert alert-danger'>No se encontró el producto, has un registro rápido y no dejes de vender</p>
				<div class='col-md-3'>
				<input type='text' name='q' class='form-control' placeholder='Nombre...'>
				</div><div class='col-md-3'>
				<input type='text' name='q' class='form-control' placeholder='Precio de venta...'>
				</div><div class='col-md-3'>
				<input type='text' name='q' class='form-control' placeholder='cantidad a vender...'>
				</div><div class='col-md-3'>
				<button type='button' class='btn btn-success'><i class='fa fa-plus'></i>Agregar</button>
				</div></div>
				";
			}
			?>
		<?php else:
			?>
		</div>

	<?php endif; ?>
	<script type="text/javascript">
	$(function(){
		$('#testDiv').slimscroll({
			size: '15px',
		});
		$('#testDiv2').slimScroll({
			position: 'left',
			height: '90%'
		});
	});
</script>
