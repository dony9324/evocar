<?php if(isset($_SESSION["errors2"])):?>
	<h3>Errores</h3>
	<p></p>
	<table style="width:100%;" class="table table-bordered table-hover">
		<tr class="danger">
			<th>Codigo</th>
			<th>Producto</th>
			<th>Mensaje</th>
		</tr>
		<?php foreach ($_SESSION["errors2"]  as $error):
			$product = ProductData::getById($error["product_id"]);
			?>
			<tr class="danger">
				<td><?php echo $product->id; ?></td>
				<td><?php echo $product->name; ?></td>
				<td><b><?php echo $error["message"]; ?></b></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php
	unset($_SESSION["errors2"]);
endif; ?>
<!--- Carrito de compras re :) -->
<?php if(isset($_SESSION["reabastecer"])):
	$total = 0;
	$total2 = 0;//esto es para el descuento
	?>
	<h3>Lista de Reabastecimiento</h3>
	<table style="width:100%;" class="text-center table table-bordered table-hover">
		<thead>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Precio de Costo*</th>
			<th>Precio de Venta*</th>
			<th>Total</th>
			<th ></th>
		</thead>
		<?php foreach($_SESSION["reabastecer"] as $p):
			$product = ProductData::getById($p["product_id"]);
			?>
			<form id="f<?php echo $p["product_id"];?>" name="f<?php echo $p["product_id"];?>" class="form-horizontal" method="post" autocomplete="off"  role="form" >
				<tr >
					<td style="width:auto"> <?php echo $product->name; ?></td>
					<td ><?php echo $p["q"]; ?></td>
					<td> <input type="text" onchange="validarprice('price_in',<?php echo $p["product_id"];?>);" onkeyup="validarprice('price_in',<?php echo $p["product_id"];?>);" name="price_in<?php echo $p["product_id"];?>" required class="form-control money" id="price_in<?php echo $p["product_id"];?>" value="<?php echo $p["price_in"]; ?>" placeholder="Precio de entrada">
						<span id="spanprice_in<?php echo $p["product_id"];?>"></span></td>
						<td><input type="text" onchange="validarprice('price_out',<?php echo $p["product_id"];?>);" onkeyup="validarprice('price_out',<?php echo $p["product_id"];?>);" name="price_out<?php echo $p["product_id"];?>" required class="form-control money" id="price_out<?php echo $p["product_id"];?>" value="<?php echo $p["price_out"]; ?>" placeholder="Precio de salida">
							<span id="spanprice_out<?php echo $p["product_id"];?>"></span></td>
							<td>
								<?php  $pt = $p["price_in"]* $p["q"]; $total +=$pt; $pt2 = $p["price_in"]*$p["q"];
								$total2 +=$pt2;  echo number_format(($pt/100), 2, ',', '.'); ?>
							</td>
							<td style="width:30px;"><a class="btn btn-danger" onclick="clearre(<?php echo $product->id; ?>)"><i class="glyphicon glyphicon-remove"></i></a></td>
						</tr>
					</form>
					<script>
					//esta funcion actualisar los valores de  $_SESSION["reabastecer"] - blur = perde el focu
					$("#price_in<?php echo $p["product_id"];?>").blur(function(){
						id = $("#price_out<?php echo $p["product_id"];?>").cleanVal() * 1;
						id2 = $("#price_in<?php echo $p["product_id"];?>").cleanVal() * 1;
						if (validate(id,3,id2,1)){
							$.get("./?action=updatere",
							{
								price_in: $("#price_in<?php echo $p["product_id"];?>").cleanVal(),
								price_out:$("#price_out<?php echo $p["product_id"];?>").cleanVal(),
								product_id:<?php echo $p["product_id"];?>
							},function(data){
								if (data.estado == "true") {
									console.log('Se actualliso producto correctamente');
								}else {
									console.log('no se actualliso producto');
								}
								$("#cart").load("./?action=viewcartre");
							});
						}else {
							alertify.error('El Precio de venta No puede ser menor al Costo');
						}
					});

					$("#price_out<?php echo $p["product_id"];?>").blur(function(){
						id = $("#price_out<?php echo $p["product_id"];?>").cleanVal() * 1;
						id2 = $("#price_in<?php echo $p["product_id"];?>").cleanVal() * 1;
						if (validate(id,3,id2,1)){
							$.get("./?action=updatere",
							{
								price_in: $("#price_in<?php echo $p["product_id"];?>").cleanVal(),
								price_out:$("#price_out<?php echo $p["product_id"];?>").cleanVal(),
								product_id:<?php echo $p["product_id"];?>
							},function(data){
								if (data.estado == "true") {
									console.log('Se actualliso producto correctamente');
								}else {
									console.log('no se actualliso producto');
								}
								$("#cart").load("./?action=viewcartre");
							});
						}else {
							alertify.error('El Precio de venta No puede ser menor al Costo');
						}
					});

				</script>
			<?php endforeach;
			$infoiva= CompanyData::getById(1)->value;
			?>
			<script>
			///funcion para enmascarar http://igorescobar.github.io/jQuery-Mask-Plugin/docs.html
			jQuery(function($){
				$('.money').mask('000.000.000,00', {reverse: true});
			});
			function validarprice(na,id){
				NEMEM = $('#'+na+id).cleanVal()/100;
				nuu = numeroALetras(NEMEM, {
					plural: 'PESOS',
					singular: 'PESO',
					centPlural: 'CENTAVOS',
					centSingular: 'CENTAVO'
				});
				alertify.message(nuu);
				//$("#spanprice_in"+id).html(nuu);
			}
		</script>
	</table>
	<div class="form-horizontal">
		<h3>Resumen</h3>
		<input type="hidden" name="total" value="<?php echo $total; ?>" class="form-control" placeholder="Total">
		<table style="width:100%;" class="table table-bordered">
			<tr>
				<td class="info" style="width:150px"><p><b>Total</b></p></td>
				<td class="danger"><p><b>$ <?php echo number_format(($total/100), 2, ',', '.'); ?></b></p></td>
				<td ></td>
				<!--<td class="info" style="width:180px"><p><b>Descuento</b></p></td>
				<td class="success"><input type="text" step="any" name="discount" onchange="validarprice('discount','');" onkeyup="validarprice('discount','');" class="form-control money" required="" value="" id="discount" placeholder="Descuento"></td>
			-->
		</tr>
	</table>
	<input type="hidden" name="cost" value="<?php echo $total2; ?>" class="form-control" placeholder="Total">
	<div class="form-group">
		<div class="col-lg-2">
			<label  class="col-lg-1 control-label">Proveedor</label></div>
			<div class="col-lg-10">
				<button type="button" id="btnnewp" onclick="newprovider()" class="btn btn-default"><i class="fa  fa-plus"></i> Nuevo Proveedor</button>
				<div id="newprovider"> </div>
				<script>
				//esta funcion carga el formulario para guardar un nuevo provider
				function newprovider(){
					//estalinea es por un error de doble ventana he impide que se abra dosveces el modal
					$("#btnnewp").prop('disabled', true);
					console.log("nuevo provider")
					$.get("./?action=newprovider",function(data){
						$("#newprovider").html(data);
						$('#myModal').modal('show');
						$("#btnnewp").prop('disabled', false);
					});
				}
				</script>
			</div>
	</div>
		<?php
		$clients = PersonData::getProviders();
		?>
		<div id="contenedornproveedor" class="form-group">
			<div class="col-lg-2">
				<label>Seleccionar Proveedor</label>
			</div>
			<div class="col-lg-10">
				<select name="client_id" id="client_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
					<option selected="selected" value="">-- NINGUNO --</option>
					<?php foreach($clients as $client):?>
						<option value="<?php echo $client->id;?>"><?php echo $client->name." ".$client->lastname;?></option>
					<?php endforeach;?>
				</select>
				<span id="spanproveedor"></span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-2">
				<label  class="col-lg-1 control-label">Acreditar</label>
			</div>
				<div class="col-lg-10">
					<div class="switch-field" >
						<input type="radio" id="switch_left" name="switch_2" value="0" checked/>
						<label for="switch_left">NO</label>
						<input type="radio" id="switch_right" name="switch_2" value="1" />
						<label for="switch_right">SI</label>
					</div>
				</div>
		</div>
		<input name="is_oficial" type="hidden" value="1">
		<div class="col-lg-10">
			<button class="btn btn-lg btn-danger"	onclick="clearr()" ><i class="glyphicon glyphicon-remove"></i> Cancelar </button>
					<script>
					function clearr() {
						console.log("clearr")
						$.get("./?action=clearre",
						{
						},function(data){
							if (data.estado == "true") {
								alertify.success('Reabastecer cancelado');
							}else {
								alertify.error('Algo salio mal');
							}
							$("#cart").load("./?action=viewcartre");
						});}



						</script>
						<button id="btnprocessre"  onclick="processre()" class="btn btn-lg btn-success"><i class="glyphicon glyphicon-usd"></i> Procesar Reabastecimiento</button>
						<script>
						function processre() {
							$("#btnprocessre").prop('disabled', true);
							console.log("processre")
							if (validadatos()){
								console.log("si valido formulario");
								$('.money').unmask();//desnmascaran los campos
								$.post("./?action=processre",{
									client_id: $("#client_id").val(),
									acreditar:$('input:radio[name=switch_2]:checked').val(),
									total:<?php echo $total; ?>,

								},function(data){
									id = 	data.id;
									if (data.estado == "true") {
										alertify.success('Se proceso Reabastecimiento correctamente ');
										changerview('./?page=onere&id='+ id)
									}else {
										alertify.error('Algo salio mal');
									}
								});
							}
							$("#btnprocessre").prop('disabled', false);


						}
						function validadatos(){
							if (validate("client_id",1,10,0)){
								$("#spanproveedor").html("");
								$("#contenedornproveedor").removeClass("has-error")
								$("#contenedornproveedor").addClass("has-success")
							}else {
								$("#contenedornproveedor").removeClass("has-success")
								$("#contenedornproveedor").addClass("has-error")
								$("#client_id" ).focus();
								$("#spanproveedor").html("Complete este campo.");
								alertify.error('Complete campo obligatorio');
								return false;
							}
							return true;
						}
						</script>
						<button id="btnimprimir"  onclick="imprimirlista()" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Imprimir Lista</button>
						<script>
						function imprimirlista() {
							$("#btnimprimir").prop('disabled', true);
							console.log("imprimirlista")
							$.get("./?imprimir=printlistre",
							{
							},function(data){
								if (data.estado == "true") {
									alertify.success('Imprimiendo....');
								}else {
									alertify.error('Algo salio mal');
								}
							});}
							</script>

						</div>
	</div>
<?php endif; ?>
<div id="results"></div>
<script>
	//jQuery.noConflict();
	$(document).ready(function(){
		$('.select2').select2()
	});
	function elegir(valor){
		$("#client_id option[value="+ valor +"]").attr("selected",true);
	}
</script>
