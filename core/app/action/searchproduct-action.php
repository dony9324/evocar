<?php if(isset($_GET["product"]) && $_GET["product"]!=""):  //isset esta palabra es para balidar qu esten asignado valores .. ?>
	<div id="testDiv" class="box-body">
		<?php
		$products = ProductData::getLike(addslashes($_GET["product"])); //resibimos el codigo o nombre . addslashe esta es para formater la cadena i eliminar las comillas
		if(count($products)>0){
			?>
			<style>
			input[type=number]::-webkit-outer-spin-button,
			input[type=number]::-webkit-inner-spin-button {	-webkit-appearance: none;	margin: 0; text-align:center;}
			input[type=number] {-moz-appearance:textfield; text-align:center; }
			</style>
			<table style="width:100%;"  class="table table-bordered text-center">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Precio</th>
						<th >Costo</th>
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
						$q= $precio["q"];
						?>
						<?php
						///
						?>
						<tr class="<?php if($q<=$product->inventary_min && $q>0){ echo "warning"; } if(!($q<=$product->inventary_min)){echo "info";} if(!$q>0){ echo "danger"; }?>">
							<td><?php echo $product->name; ?></td>
							<td><b>$<?php if ($precio["Precio"]>0) {echo number_format(($precio["Precio"]/100), 2, ',', '.'); }else{
								echo number_format(($product->price_out/100), 2, ',', '.');}?></b></td>
							<td><b>$ <?php echo number_format(($product->price_in/100), 2, ',', '.'); ?></b></td>
							<td>	<?php echo $q; ?>	</td>
							<td style="width:250px;">
								<input type="hidden" id="id<?php echo $product->id; ?>" value="<?php echo $product->price_out; ?>">
								<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
								<div class="input-group">
									<button onClick="men1(<?php echo $product->id; ?>)" type="button" class="btn btn-warning btn-flat" style="display: block; float: left; vertical-align: middle; width: 34px;">-</button>
									<input id="<?php echo $product->id; ?>" style="width: 50px; " type="number" min="0" max="<?php echo $q; ?>" value="1" step="<php if($product->divide==1) { <?php echo ani ?> ?>" class="form-control" required name="q" <?php if($product->divide==1) { ?> onFocus="changervalor(<?php echo $product->id;?>)" <?php }else{ ?> onFocus="nochangervalor()"<?php } ?>)>
									<button onClick="mas1(<?php echo $product->id; ?>)" type="button" class="btn btn-success btn-flat" style="display: block; vertical-align: middle; width: 35px;">+</button>
									<span class="input-group-btn">
										<button  class="btn btn-success" onClick="addtocart(<?php echo $product->id; ?>)"> Agregar</button>
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
				</tbody>
				<tfoot>
					<tr>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Costo</th>
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
				<h3 class='box-title'>Productos omitidos</h3>
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
