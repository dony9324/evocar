<?php if(isset($_SESSION["errors"])):?>
	<h3>Errores</h3>
	<p></p>
	<table style="width:100%;" class="table table-bordered table-hover">
		<tr class="danger">
			<th>Codigo</th>
			<th>Producto</th>
			<th>Mensaje</th>
			<th> </th>
		</tr>
		<?php foreach ($_SESSION["errors"]  as $error):
			$product = ProductData::getById($error["product_id"]);
			?>
			<tr class="danger">
				<td><?php echo $product->id; ?></td>
				<td><?php echo $product->name; ?></td>
				<td><b><?php echo $error["message"]; ?></b></td>
				<th>
					<button id="faltante" class="btn btn-success" onclick="processre(<?php echo $product->id; ?>, <?php echo $error["re"] ; ?>, <?php echo $product->price_in; ?>, <?php echo $product->price_out; ?>)"> Reabastecer faltante </button>
				</th>
			</tr>
		<?php endforeach; ?>
	</table>

	<script>
	function processre(id, q, pin, pout){
		$("#faltante").prop('disabled', true);
		console.log("processre"+id+"cant: "+q)
		//alertify.success('añadiendo a la Lista Producto'+id)
		$.get("./?action=processre",
		{
			o:"one",
			price_in:pin,
			price_out:pout,
			product_q:q,
			product_id:id
		},function(data){
			if (data.estado == "true") {
				alertify.success('Se Reabasteció producto correctamente');
				//actualisar busqueda
				$.get("./?action=searchproduct",$("#searchp").serialize(),function(data){
					$("#show_search_results").html(data);
				});

			}else {
				alertify.error('No se pudo Reabastecer producto');
				$("#faltante").prop('disabled', false);
			}
			$("#cart").load("./?action=viewcart")
		});

	}
</script>
<?php
unset($_SESSION["errors"]);
endif; ?>
<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["cart"])):
	$total = 0;// total costo de todos los productos
	$total2 = 0;//esto es para el descuento salida
	$descuento = 0; // descuento hecho
		// print_r($_SESSION["cart"]); // ver que hay en esta variable texteo
	?>
	<div class="form-group col-sm-12">
		<h3>Lista de venta</h3>

		<div id="multiplicar0">
		</div>
		<button type="button" onclick="multiplicar()" class="btn btn-default"><i class="fa fa-plus"></i>Calculadora</button>
		<div id="resultado" hidden="on">

		</div>

		<div id="multiplicar" class="col-sm-4" hidden="on">
			<form id="formmultiplicar"class="form" action="#">
                    <input type="text"  class="form-control" id="inpmultiplicar" placeholder="Primer nuemero" autocomplete="off">
                    <span id="spanporcentajeiva"></span>
				</form>
    </div>

		<div id="multiplicar2" class="col-sm-4" hidden="on">
			<form id="formmultiplicar2" class="form" action="#">
				<input type="text" class="form-control" id="inpmultiplicar2" placeholder="Segundo nuemero" autocomplete="off">
				<span id="s"></span>
			</form>
		</div>

	</div>
	<script>
	function multiplicar(){
		console.log("multiplicar");
		var elem = $('#multiplicar');
		elem.fadeIn();
	//elem.hide();
		$("#inpmultiplicar").focus();
		alertify.message('Ingrese Primer dato');
	}
	$("#formmultiplicar").on("submit",function(e){
		e.preventDefault();
		var elem = $('#multiplicar');
		elem.hide();
		var elem2 = $('#multiplicar2');
		elem2.fadeIn();
		$("#inpmultiplicar2" ).focus();
		//BORRAR EL CONTENIDO DEL CAMPO
		//$("#product_code").val("");
	});
	$("#formmultiplicar2").on("submit",function(e){
		e.preventDefault();
		var dato1 = $('#inpmultiplicar').val();
		var dato2 = $('#inpmultiplicar2').val();
		var resultado = dato1 * dato2;
		$('#resultado').html("<h1>"+resultado+"</h1>");
		var elem = $('#resultado');
		elem.fadeIn();
		var elem2 = $('#multiplicar2');
		elem2.hide();
	//	$("#inpmultiplicar2" ).focus();
		//BORRAR EL CONTENIDO DEL CAMPO
		//$("#product_code").val("");
	});
	</script>
	<table style="width:100%;" class="text-center table table-bordered table-hover">
		<thead>
			<th>#</th>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Costo</th>
			<th>Precio</th>
			<th>Total</th>
			<th>Descuento</th>
			<th></th>
		</thead>
		<tbody>
			<?php $dicuento=0; foreach($_SESSION["cart"] as $p):
				$product = ProductData::getById($p["product_id"]);
				?>
				<tr style="width:11%;">
					<td style="width:auto"><?php echo $product->id; ?></td>
					<td style="width:auto"><?php echo $product->name; ?></td>
					<td  style="width:11%;" >
						<div class="input-group">
							<style>
							input[type=number]::-webkit-outer-spin-button,
							input[type=number]::-webkit-inner-spin-button {	-webkit-appearance: none;	margin: 0;}
							input[type=number] {-moz-appearance:textfield; text-align:center; }
							</style>
								<input style="min-width: 50px; -webkit-appearance: none; " class="form-control <?php if($product->divide==0) { echo 'entero'; }?>" type="<?php if($product->divide==0) { echo 'text'; }
								else{ echo "number";}?>" id="q<?php echo $p["product_id"];?>" value="<?php echo $p["q"];?>" step=" <?php  if($product->divide==1) {  echo 'ani'; }?>">
								<?php if ($product->other_presentations==1) {
									if ($product->id_group==0) {
										$other_presentations = ProductData::getById_group($p["product_id"]);
									}else {
										$other_presentations = ProductData::getById_group($product->id_group);
									}
								} ?>

                <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle"
									<?php if (isset($other_presentations)){
										echo "data-toggle='dropdown' aria-expanded='false'";
									}else {
										echo "style='cursor: default'";
									}?>
									>	<?php if($product->unit_id!=null && $product->unit_id != 0 ){
										if(isset($product->getUnit_id()->abbreviation)){

											if ($product->cantidad!=0 && $product->cantidad != 1) {
												echo "x ".$product->cantidad;
											} if ($product->getUnit_id()->abbreviation=="") {
												echo $product->getUnit_id()->name;
											}else {
												echo $product->getUnit_id()->abbreviation;
											}

										} else { echo "eliminada";}
									}else{ echo "indef"; }  ?>
											<?php if (isset($other_presentations)){
                    	echo "<span class='fa fa-caret-down'></span>";
										}?></button>
///aki
                  <ul class="dropdown-menu">
										<?php if (isset($other_presentations)){
											if ($product->id_group==0) {
												//si llego aki este producto tiene mas presentaciones y esta la presentacion principal
														foreach ( $other_presentations as $other) {
															if($other->unit_id!=null && $other->unit_id != 0 ){
																	if(isset($other->getUnit_id()->name)){
																		 echo "<li><a href='#' id='btncam".$other->id."' onclick='cambioPresentacion(".$other->id.", ".$p['q'].", ".$p['product_id'].");'>";
																if ($other->cantidad!=0 && $other->cantidad != 1) {
																	echo "x ".$other->cantidad;
																}echo $other->getUnit_id()->name." = ";
																echo $product->cantidad. $product->getUnit_id()->name."x ". $other->total_quantity;
																} else { echo "eliminada";}
															}else{ echo "indef"; }
															echo "</a></li>";
											}
										}else {
											//si llego aki este producto tiene mas presentaciones y esta NO ES la presentacion principal
												//$product = ProductData::getById($p["product_id"]);
												//$product->id_group
												$producttmp = ProductData::getById($product->id_group);
												if($producttmp->unit_id!=null && $producttmp->unit_id != 0 ){
														if(isset($producttmp->getUnit_id()->name)){
															 echo "<li><a href='#' id='btncam".$producttmp->id."' onclick='cambioPresentacion(".$producttmp->id.", ".$p['q'].", ".$p['product_id'].");'>";
													if ($producttmp->cantidad!=0 && $producttmp->cantidad != 1) {
														echo "x ".$producttmp->cantidad;
													}echo $producttmp->getUnit_id()->name;
													//echo $product->cantidad. $product->getUnit_id()->name."x ". $producttmp->total_quantity;
													} else { echo "eliminada";}
												}else{ echo "indef"; }
												echo "</a></li>";
											foreach ( $other_presentations as $other) {
												if ($other->id != $product->id) {


												if($other->unit_id!=null && $other->unit_id != 0 ){
														if(isset($other->getUnit_id()->name)){
															 echo "<li><a href='#' id='btncam".$other->id."' onclick='cambioPresentacion(".$other->id.", ".$p['q'].", ".$p['product_id'].");'>";
													if ($other->cantidad!=0 && $other->cantidad != 1) {
														echo "x ".$other->cantidad;
													}echo $other->getUnit_id()->name." = ";
													echo $product->cantidad. $producttmp->getUnit_id()->name."x ". $other->total_quantity;
													} else { echo "eliminada";}
												}else{ echo "indef"; }
												echo "</a></li>";
											}
												}
										}
										}
										unset($other_presentations); ?>
                  </ul>
                </div>
              </div>
						</td>

					<td style="width:11%;"> <?php echo number_format(($product->price_in/100), 2, ',', '.'); ?><input type="hidden" id="price_in<?php echo $p["product_id"];?>" value="<?php echo $product->price_in * $p["q"];?>">
 				</td>
					<td style="width:11%;"><input type="text" onchange="validarprice('price_out',<?php echo $p["product_id"];?>);" onkeyup="validarprice('price_out',<?php echo $p["product_id"];?>);" name="price_out<?php echo $p["product_id"];?>" required class="form-control money" id="price_out<?php echo $p["product_id"];?>" value="<?php echo $p["price_out"]; ?>" placeholder="Precio de salida" autocomplete="off" >
						<span id="spanprice_out<?php echo $p["product_id"];?>"></span></td>
						<td style="width:11%;"><b>$ <?php  $pt = $p["price_out"]*$p["q"]; $total +=$pt; $pt2 = $product->price_in*$p["q"];
						$total2 +=$pt2; echo number_format(($pt/100), 2, ',', '.'); ?></b></td>
						<td style="width:11%;"><input type="text" onchange="validarprice('descuento',<?php echo $p["product_id"];?>);" onkeyup="validarprice('descuento',<?php echo $p["product_id"];?>);" name="descuento<?php echo $p["product_id"];?>" required class="form-control money" id="descuento<?php echo $p["product_id"];?>" value="<?php $descuento += $p["descuento"]; echo $p["descuento"]; ?>" placeholder="descuento" autocomplete="off">
							<span id="spandescuento<?php echo $p["product_id"];?>"></span></td>
							<td><a<?php if (($pt - $pt2 - ($pt2*.05))<0){ } else{$dicuento+=($pt - $pt2 - ($pt2*.05));}?>
								class="btn btn-danger" onclick="clearcart(<?php echo $product->id; ?>)"><i class="glyphicon glyphicon-remove"></i></a></td>
							</tr>
							<script>

//esta funcion actualizar la cantidad en los valores de   $_SESSION["cart"] - blur = perde el focu
$("#q<?php echo $p["product_id"];?>").blur(function(){
	console.log('updatecartq');
	console.log("addtocart"+"<?php echo $p["product_id"];?>" );
	//q:($('#<?php echo $p["product_id"];?>').val())*1+1;

	console.log($("#q<?php echo $p["product_id"];?>").cleanVal() * 1);
				$.get("./?action=addtocart",
				{
					q:($("#q<?php echo $p["product_id"];?>").cleanVal() * 1)- <?php echo $p["q"];?>,
					product_id:"<?php echo $p["product_id"];?>",
				},function(data){
					if (data.estado == "true") {
						alertify.success('Se actualizo cantidad correctamente');
					}else {
						alertify.error('No se pudo actualizar cantidad');
					}
					$("#cart").load("./?action=viewcart")
				});
});

							//esta funcion actualisar los valores de  $_SESSION["reabastecer"] - blur = perde el focu

							$("#descuento<?php echo $p["product_id"];?>").blur(function(){
								console.log('updatecart');
								id = $("#descuento<?php echo $p["product_id"];?>").cleanVal() * 1;
								id2 = (<?php echo $p["q"]; ?> * $("#price_out<?php echo $p["product_id"];?>").cleanVal()) - ($("#price_in<?php echo $p["product_id"];?>").val()*1);
								console.log("id:"+id+" id2:"+id2);
								if (validate(id2,3,id,1)){
									$.get("./?action=updatecart",
									{
										descuento: $("#descuento<?php echo $p["product_id"];?>").cleanVal(),
										price_out:$("#price_out<?php echo $p["product_id"];?>").cleanVal(),
										product_id:<?php echo $p["product_id"];?>
									},function(data){
										if (data.estado == "true") {
											console.log('Se actualliso producto correctamente');
										}else {
											console.log('no se actualliso producto');
										}
										$("#cart").load("./?action=viewcart");
									});
								}else {
									alertify.error('El Descuento ecede el costo, maximo :'+id2/100);
								}
							});

							$("#price_out<?php echo $p["product_id"];?>").blur(function(){
								id = $("#price_out<?php echo $p["product_id"];?>").cleanVal() * $("#q<?php echo $p["product_id"];?>").val();
								id2 = $("#price_in<?php echo $p["product_id"];?>").val()*1;
								if (validate(id,3,id2,1)){
									console.log("id:"+id+" id2:"+id2);
									$.get("./?action=updatecart",
									{
										descuento: $("#descuento<?php echo $p["product_id"];?>").cleanVal(),
										price_out:$("#price_out<?php echo $p["product_id"];?>").cleanVal(),
										product_id:<?php echo $p["product_id"];?>
									},function(data){
										if (data.estado == "true") {
											console.log('Se actualliso producto correctamente');
										}else {
											console.log('no se actualliso producto');
										}
										$("#cart").load("./?action=viewcart");
									});
								}else {
									if (Math.floor(Math.random() * (2))==0) {
										$("#cart").load("./?action=viewcart");
									}
									alertify.error('El Precio de venta No puede ser menor al Costo');
									$("#price_out<?php echo $p["product_id"];?>").focus();
								}
							});
							</script>
						<?php endforeach;
						$infoiva= CompanyData::getById(1)->value;
						?>
						<script>
						//funcion para enmascarar http://igorescobar.github.io/jQuery-Mask-Plugin/docs.html
						jQuery(function($){
							$('.money').mask('000.000.000,00', {reverse: true});

							///aqui enmascaramos los campos que no tengan avilitado la divicion del producto para que solo admitan enteros
							$('.entero').mask('000.000');
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
						}
						function cambioPresentacion(idp, q, id){
			          nochangervalor();
			          $("#btncam"+idp).prop('disabled', true);
			          console.log("addtocart"+idp)
			          $.get("./?action=addtocart",
			          {
			            q:q,
			            product_id:idp
			          },function(data){
			            if (data.estado == "true") {
										console.log('Se agregó producto correctamente');
										console.log("clearcart"+id)
										$.get("./?action=clearcart",
										{
											product_id:id
										},function(data){
											if (data.estado == "true") {
												alertify.success('Se cambio presentacion correctamente');
											console.log('Se elimino producto correctamente');
											}else {
												console.log('No se pudo Eliminar producto');
											}
										});

			            }else {
			              alertify.error('No se pudo cambio presentacion');

			            }
			            $("#cart").load("./?action=viewcart")
			          });
			          $("#btncam"+idp).prop('disabled', false);
			        }
						</script>
					</tbody>
				</table>
				<h3>Resumen</h3>
				<table style="width:auto;" class="table table-bordered">
					<tr>
						<td class="info" style="width:150px"><p><b>SubTotal</b></p></td>
						<td class="danger"><p><b>$ <?php echo number_format(($total /100), 2, ',', '.'); ?></b></p></td>
						<td ></td>
						<td class="info"> <b>Descuento total</b> </td>
						<td class="success">  <?php echo number_format(($descuento/100), 2, ',', '.');?>
							<div class="" hidden="on">
								<input type="number" step="any" name="discount" class="form-control"  value="<?php echo $descuento;?>" id="discount" placeholder="Descuento">
							</div>
							<span id="spandescuento<?php echo $p["product_id"];?>"></span></td>
						<td ></td>
						<td class="info"><b>Total</b></td>
						<td class="danger"><p><b>$ <?php echo number_format((($total-$descuento )/100), 2, ',', '.'); ?></b></p><p id="totalletras"></p></td>
						</tr>
					</table>
					<form method="post" class="form-horizontal" name ="processsell" id="processsell" action="index.php?action=process-sell" >
						<input type="hidden" name="total" value="<?php echo $total ; ?>" class="form-control" placeholder="Total">
						<input type="hidden" name="cost" value="<?php echo $total2; ?>" class="form-control" placeholder="Total">
						<div class="form-group">
							<label  class="col-sm-2 control-label">Cliente</label>
							<div class="col-sm-5">
								<button type="button" id="btnnewclient" onclick="newclient()" class="btn btn-default"><i class="fa  fa-plus"></i> Nuevo</button>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-search"></i>Buscar Cliente</button>
								<div id="newcliente"> </div>
								<script>
								//esta funcion carga el formulario para guardar un nuevo Cliente
								function newclient(){
									//estalinea es por un error de doble ventana he impide que se abra dosveces el modal
									$("#btnnewclient").prop('disabled', true);
									console.log("nuevo Cliente")
									$.get("./?action=newclient",function(data){
										$("#newcliente").html(data);
										$('#myModal').modal('show');
										$("#btnnewclient").prop('disabled', false);
									});
								}
								</script>
							</div>
							<?php
							$clients = PersonData::getClients();
							?>
							<div class="col-sm-1">
								<label>Cliente</label>
							</div>
							<div class="col-sm-4">
								<select onchange="savedatos()" name="client_id" id="client_id" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
									<option selected="selected" value="">-- NINGUNO --</option>
									<?php foreach($clients as $client):?>
										<option value="<?php echo $client->id;?>"><?php echo $client->name." ".$client->lastname;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>


						<!--div class="form-group col-sm-6">
						<div class="col-sm-4"><label  class="col-sm-1 control-label">Descuento</label></div>
						<div class="col-sm-8">

					</div>
				</div-->
				<div id="contenedorlastname">
					<label for="lastname" class="col-sm-2 control-label">Acreditar</label>
					<div class="col-sm-4">
						<div class="switch-field" onClick="desavilita()">
							<input type="radio" id="switch_left" name="switch_2" value="0" checked/ onchange="savedatos()">
							<label for="switch_left">No</label>
							<input type="radio" id="switch_right" name="switch_2" value="1" /onchange="savedatos()">
							<label id="lswitch_right" for="switch_right">Si</label>
						</div>
						<script>
						function desavilita(){
							console.log("desabilta");
							si = $('input:radio[name=switch_2]:checked').val();
							var elem = $('.mostrar');
							var elem2 = $('.mostrar2');
							if(si==1){
								elem.fadeIn();
							  actadelanto()
								$("#money").prop('disabled', true);	//	mone.disabled = true;
							}else{
								elem.hide();
								elem2.hide();
								$("#money").prop('disabled', false);	//mone.disabled = false;
							}
						}
						</script>
					</div>
				</div>


			</div>
			<div class="mostrar form-group" hidden="on">
				<label for="adelanto" class="col-sm-2 control-label">Adelanto</label>
				<div class="col-sm-4 ">
					<div class="switch-field">
						<input type="radio" id="switch_left2" name="adelanto" value="0" checked="" onchange="actadelanto()">
						<label for="switch_left2">No</label>
						<input type="radio" id="switch_right2" name="adelanto" value="1" onchange="actadelanto()">
						<label id="lswitch_right2" for="switch_right2">Si</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div id="contenedorcantidad_adelanto" class=" mostrar2" hidden="on" >
					<label for="adelanto" class="col-sm-2 control-label">Cantidad adelanto*</label>
					<div class="col-sm-4">
						<input type="text"  onchange="validarcantidad_adelanto();" onkeyup="validarcantidad_adelanto()"  name="cantidad_adelanto" class="form-control money" id="cantidad_adelanto" placeholder="Cuantos" autocomplete="off" >
						<span id="spancantidad_adelanto"></span>
					</div>
				</div>
				<div id="contenedormoney">
					<label for="name" class="col-sm-2 control-label">Efectivo*</label>
					<div class="col-sm-4">
						<input onchange="validarmoney();" onkeyup="validarmoney();"  type="text" min="0" name="money" class="form-control money" id="money" placeholder="Efectivo" autocomplete="ÑÖcompletes">
						<span id="spanmoney"></span>
					</div>
				</div>
				<script>
				function validarmoney(){
					savedatos();
					console.log("validarmoney");
					NEMEM = $('#money').cleanVal()/100;
					nuu = numeroALetras(NEMEM, {
						plural: 'PESOS',
						singular: 'PESO',
						centPlural: 'CENTAVOS',
						centSingular: 'CENTAVO'
					});
					$("#spanmoney").html(nuu);
				}
				function validarcantidad_adelanto(){
					id2 = $('#cantidad_adelanto').cleanVal();
					id =<?php echo $total; ?>;

					if (validate(id,3,id2,1)){
						$("#contenedorcantidad_adelanto").removeClass("has-error");
						console.log("id:"+id+" id2:"+id2);
						savedatos();
					}else {
							console.log("console.error");
							alertify.error('EL adelanto supera el total de la venta');
						$("#contenedorcantidad_adelanto").addClass("has-error");
					}

					console.log("validarcantidad_adelanto");
					NEMEM = $('#cantidad_adelanto').cleanVal()/100;
					nuu = numeroALetras(NEMEM, {
						plural: 'PESOS',
						singular: 'PESO',
						centPlural: 'CENTAVOS',
						centSingular: 'CENTAVO'
					});
					$("#spancantidad_adelanto").html(nuu);
				}
				</script>


			</div>
			<script>
			function actadelanto(){
				savedatos();
				console.log("actadelanto");
				si = $('input:radio[name=adelanto]:checked').val();
				var elem = $('.mostrar2');
				if(si==1){
					elem.fadeIn();
					$("#money").prop('disabled', false);
				}else{
					elem.hide();
					$("#money").prop('disabled', true);
				}
			}
			</script>

<div class="form-group">
			<div class="col-sm-5">
				<div class="col-sm-5">
					<label class="control-label">entrega imediata</label>
				</div>
				<div class="col-sm-7">
					<div class="switch-field">
						<input type="radio" id="entrega_left" name="entrega" value="0" onchange="savedatos()">
						<label id="lentrega_left" for="entrega_left">No</label>
						<input type="radio" id="entrega_right" name="entrega" value="1" checked="" onchange="savedatos()">
						<label id="lentrega_right" for="entrega_right">Si</label>
					</div>
				</div>
			</div>

				<div class="col-sm-7">
					<button id="btnprintoutcot" class="btn btn-default pull-right" onclick="printoutcot()"><i class="fa fa-print"></i>Imprimir</button>
					<button id="btnfinventa" class="btn btn-success pull-right"><i class="glyphicon glyphicon-usd"></i> Finalizar Venta</button>

					<a onclick="clearcartotal()" href="#" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
				</div>
					</div>
					<script>
					function clearcartotal() {
						console.log("clearcartotal");
						alertify.confirm("confirmar","¿Seguro deseas cancelar venta?",
		  function(){
		    alertify.success('Ok');
				$.get("./?action=clearcart",
					{
					},function(data){
						if (data.estado == "true") {
							alertify.success('Venta cancelada');
						}else {
							alertify.error('Algo salio mal');
						}
						$("#cart").load("./?action=viewcart");
					});
		  },
		  function(){
		    alertify.error('Cancel');
		  });
					}


						</script>





				<script>
				//esta funcion carga el formulario para guardar un nuevo Cliente
				function printoutcot(){
					//estalinea es por un error de doble ventana he impide que se abra dosveces el modal
					$("#btnprintoutcot").prop('disabled', true);
					console.log("printoutcot")
					$.get("./?imprimir=printcot",function(data){
						if (data.estado == "true") {
							alertify.success('Se Imprimio correctamente');

						}else {
							alertify.error('No se pudo Imprimir ');

						}
						$("#btnprintoutcot").prop('disabled', false);
					});
				}
				</script>

			</form>
			<!-- Modal -->
			<div id="myModal2" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Buscar cliente</h4>
						</div>
						<div class="modal-body">
							<p>Buscar cliente por nombre, cedula o por codigo.</p>
							<form id="searchclients" class="" action="#" method="post">
								<div class="input-group input-group">
									<input type="text" id="cliente"  name="clients" class="form-control" autofocus="on">
									<span class="input-group-btn">
										<button type="button" id="buscar"class="btn btn-info btn-flat"><i class="glyphicon glyphicon-search"></i> Buscar Cliente</button>
									</span>
								</div>
							</form>
						</div>
						<div id="results"></div>
						<script>
						//jQuery.noConflict();

						$(document).ready(function(){
							$("#searchclients").on("submit",function(e){
								e.preventDefault();
								$.get("./?action=searchclients",$("#cliente").serialize(),function(data){
									$("#results").html(data);
								});
								$("#clients").val("");
							});

								NEMEM =<?php echo ($total-$descuento)/100;?>;
								nuu = numeroALetras(NEMEM, {
									plural: 'PESOS',
									singular: 'PESO',
									centPlural: 'CENTAVOS',
									centSingular: 'CENTAVO'
								});
								$("#totalletras").html("<b>"+nuu+"</b>");


							$("#buscar").on("click",function(e){
								e.preventDefault();
								$.get("./?action=searchclients",$("#cliente").serialize(),function(data){
									$("#results").html(data);
								});
								$("#clients").val("");
							});

							<?php 	if(isset($_COOKIE['cliente_id'])) {
								echo "elegir(".$_COOKIE['cliente_id'].");";
							}
							?>
							<?php 	if(isset($_COOKIE['acreditar']) && $_COOKIE['acreditar']==1) {
								echo "$('#lswitch_right').click();";
								echo "console.log('que passa');";
							}
							?>
							<?php 	if(isset($_COOKIE['adelanto']) && $_COOKIE['adelanto']==1) {
								echo "$('#lswitch_right2').click();";
								echo "console.log('que passa');";
							}
							?>
							<?php 	if(isset($_COOKIE['cantidad_adelanto'])) {
								echo "$('#cantidad_adelanto').val('".$_COOKIE['cantidad_adelanto']."');";
								echo "console.log('que passa');";
							}
							?>
							<?php 	if(isset($_COOKIE['efectivo'])) {
								echo "$('#money').val('".$_COOKIE['efectivo']."');";
								echo "console.log('que passa');";
							}	?>
							<?php 	if(isset($_COOKIE['entrega'])&& $_COOKIE['entrega']==0) {
									echo "$('#lentrega_left').click();";
								echo "console.log('que passa');";
							}
							?>

						});
						function savedatos(){
							console.log("savedatos");
							$.post("./?action=savedatos",
							{
								cliente_id: $("#client_id").val(),
								discount:0,
								acreditar:$('input:radio[name=switch_2]:checked').val(),
								adelanto: $('input:radio[name=adelanto]:checked').val(),
								cantidad_adelanto:$("#cantidad_adelanto").cleanVal(),
								efectivo: $("#money").cleanVal(),
								entrega: $('input:radio[name=entrega]:checked').val(),
							},function(data){
								if (data.estado == "true") {
									console.log("savedatos exito");
								}else {
									console.log("savedatos salio mal");
								}
							});
						}


						</script>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
			<!-- fin Modal -->
			<script>
			go=false;
			est=false;
			$("#processsell").submit(function(e){
				e.preventDefault();
					console.log("processsell 1");
					discount = $("#discount").val();
					money = $("#money").cleanVal();
					totalnumero = <?php echo $total ;?> ;/////problema con el timpo de numero
					cambio =   (parseFloat(money)  - (parseFloat(totalnumero) - parseFloat(discount)))/100 ;
					cliente = $("#client_id").val();
					cliente2=$('#client_id option:selected').text();
					otra = $('input:radio[name=switch_2]:checked').val();

				if(discount>(<?php echo $dicuento;?>)){
					alertify.alert('ERROR', 'No se puede efectuar la operacion. Descuento muy alto!', function(){ alertify.error('Descuento muy alto'); });
					e.preventDefault();
				}else{
					if(otra==0 ){
						if(money<(<?php echo $total ;?>-discount)){
							alertify.alert('ERROR', 'No se puede efectuar la operacion. Falta efectivo!', function(){ alertify.error('Falta efectivo'); });
							e.preventDefault();

						}else{
							nuu = numeroALetras(cambio, {
								plural: 'PESOS',
								singular: 'PESO',
								centPlural: 'CENTAVOS',
								centSingular: 'CENTAVO'
							});
							alertify.confirm('Cambio',"Cambio: $"+cambio+"\n "+nuu,
							function(){ alertify.success('Ok')
							//setTimeout(function(){ document.processsell.submit() ; }, 500);
							e.preventDefault();
							processsell();

						}

						, function(){ alertify.error('Cancelado por usuario')});
						e.preventDefault();
					}
				}else{
					if(cliente==""){
						alertify.alert('ERROR',"No se puede efectuar la operacion falta cliente ", function(){ alertify.error('Falta cliente'); });
						e.preventDefault();
					}else{
						nuu = numeroALetras(((parseFloat(totalnumero) - parseFloat(discount))/100 ), {
								plural: 'PESOS',
								singular: 'PESO',
								centPlural: 'CENTAVOS',
								centSingular: 'CENTAVO'
							});
						alertify.confirm('Acreditar', "Desea acreditar: $ <b>"+((parseFloat(totalnumero) - parseFloat(discount))/100 )+"</b> a <b>"+ cliente2+"</b><br> "+nuu,
						function(){ alertify.success('si acecto acreditar')
							e.preventDefault();

							//setTimeout(function(){ document.processsell.submit() ; }, 500);
							processsell();

								}
						, function(){ alertify.error('cancelado por usuario')});


					}
				e.preventDefault();
			}
		}});

		function processsell(){

			console.log("processsell");
            $("#btnfinventa").prop('disabled', true);
         // if (validaformulario()){
			if (true){
            console.log("si valido formulario");
            $('.money').unmask();//desnmascaran los campos
          //  id = $('#price_in').cleanVal();
          // avilitamos todos los campos
          frm = document.forms['processsell'];
          for(i=0; ele=frm.elements[i]; i++){
            ele.disabled=false;
          }
          $("#btnfinventa").prop('disabled', true);
          var parametros = new FormData($("#processsell")[0]);
          $.ajax (
            {
              data:parametros,
              url:"./?action=process-sell",
              type:"POST",
              contentType: false,
              processData: false,
              beforesend: function(){
              },
              success: function(data){
                if (data.estado == "true") {
                  alertify.success('Se procesó venta correctamente');
                  $("body").overhang({
                      type: "success",
                      duration: 1,
                      message: "Se procesó venta correctamente",
                      callback: function() {
                     //$('#myModal').modal('hide');
                      }
                  });
	//////////////////////aki se tiene que mostrar la ultima venta.
									changerview('./?action=onesell&id='+data.onesell);
				  $("#btnfinventa").prop('disabled', false);
                  //recargarclientes();
                }else {
                  $("#btnfinventa").prop('disabled', false);
                  alertify.error('No se pudo procesar venta correctamente');
                }
              }
            }
          )

          }
		};
	</script>
<?php endif; ?>
<script>
function elegir(valor){
	$("#client_id option[value="+ valor +"]").attr("selected",true);
}
</script>
