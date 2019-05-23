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
				<th><span class="input-group-btn">
					<button id="faltante" class="btn btn-success" onclick="processre(<?php echo $product->id; ?>, <?php echo $error["re"] ; ?>, <?php echo $product->price_in; ?>, <?php echo $p["price_out"]; ?>)"> Reabastecer faltante </button>
				</span></th>
			</tr>
		<?php endforeach; ?>
	</table>

	<script>
	function processre(id, q, pin, pout){
		$("#faltante").prop('disabled', false);
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

			}
			$("#cart").load("./?action=viewcart")
		});}
	</script>
	<?php
	unset($_SESSION["errors"]);
endif; ?>
<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["cart"])):
	$total = 0;// total costo de todos los productos
	$total2 = 0;//esto es para el descuento salida
	$descuento = 0; // descuento hecho
	?>
	<h3>Lista de venta</h3>
	<table style="width:100%;" class="text-center table table-bordered table-hover">
		<thead>
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

			<tr >
				<td style="width:auto"><?php echo $product->name; ?></td>
				<td ><?php echo $p["q"]; ?></td>
				<td style="width:11%;"> <?php echo number_format(($product->price_in/100), 2, ',', '.'); ?><input type="hidden" id="price_in<?php echo $p["product_id"];?>" value="<?php echo $product->price_in * $p["q"];?>"> </td>
				<td style="width:11%;"><input type="text" onchange="validarprice('price_out',<?php echo $p["product_id"];?>);" onkeyup="validarprice('price_out',<?php echo $p["product_id"];?>);" name="price_out<?php echo $p["product_id"];?>" required class="form-control money" id="price_out<?php echo $p["product_id"];?>" value="<?php echo $p["price_out"]; ?>" placeholder="Precio de salida">
					<span id="spanprice_out<?php echo $p["product_id"];?>"></span></td>
				<td style="width:11%;"><b>$ <?php  $pt = $p["price_out"]*$p["q"]; $total +=$pt; $pt2 = $product->price_in*$p["q"];
				$total2 +=$pt2; echo number_format(($pt/100), 2, ',', '.'); ?></b></td>
				<td style="width:11%;"><input type="text" onchange="validarprice('descuento',<?php echo $p["product_id"];?>);" onkeyup="validarprice('descuento',<?php echo $p["product_id"];?>);" name="descuento<?php echo $p["product_id"];?>" required class="form-control money" id="descuento<?php echo $p["product_id"];?>" value="<?php $descuento += $p["descuento"]; echo $p["descuento"]; ?>" placeholder="descuento">
					<span id="spandescuento<?php echo $p["product_id"];?>"></span></td>
				<td><a<?php if (($pt - $pt2 - ($pt2*.05))<0){ } else{$dicuento+=($pt - $pt2 - ($pt2*.05));}?>
					class="btn btn-danger" onclick="clearcart(<?php echo $product->id; ?>)"><i class="glyphicon glyphicon-remove"></i></a></td>
				</tr>
				<script>
				//esta funcion actualisar los valores de  $_SESSION["reabastecer"] - blur = perde el focu
				$("#descuento<?php echo $p["product_id"];?>").blur(function(){
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
						id = $("#price_out<?php echo $p["product_id"];?>").cleanVal() * 1;
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
		</tbody>
		</table>
			<h3>Resumen</h3>
			<table style="width:100%;" class="table table-bordered">
				<tr>
					<td class="info" style="width:150px"><p><b>Total</b></p></td>
					<td class="danger"><p><b>$ <?php echo number_format(($total /100), 2, ',', '.'); ?></b></p></td>
					<td ></td>
					<td class="info" style="width:180px"><p><b>Descuento</b></p></td>
					<td class="success">  <?php echo number_format(($descuento/100), 2, ',', '.');?>

						<span id="spandescuento<?php echo $p["product_id"];?>"></span></td>
					<td class="danger"><p><b>$ <?php echo number_format((($total-$descuento )/100), 2, ',', '.'); ?></b></p></td>
				</tr>
			</table>
					<form method="post" class="form-horizontal" name ="processsell" id="processsell" action="index.php?action=process-sell" >
			<input type="hidden" name="total" value="<?php echo $total ; ?>" class="form-control" placeholder="Total">
			<input type="hidden" name="cost" value="<?php echo $total2; ?>" class="form-control" placeholder="Total">
			<div class="form-group">
					<label  class="col-sm-2 control-label">Cliente</label>
					<div class="col-sm-5">
						<button type="button" id="btnnewclient" onclick="newclient()" class="btn btn-default"><i class="fa  fa-plus"></i> Nuevo Cliente</button>
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
					<input type="number" step="any" name="discount" class="form-control" required value="0" id="discount" placeholder="Descuento">
				</div>
			</div-->

			<div class="form-group">
			              <div id="contenedorname">
			              <label for="name" class="col-sm-2 control-label">Efectivo*</label>
			              <div class="col-sm-4">
											<input type="text" min="0" name="money" required class="form-control money" id="money" placeholder="Efectivo">
			                <span id="spanamep"></span>
			              </div>
			            </div>
			            <div id="contenedorlastname">
			              <label for="lastname" class="col-sm-2 control-label">Tipo</label>
			              <div class="col-sm-4">
											<div class="switch-field" onClick="desavilita()">
												<input type="radio" id="switch_left" name="switch_2" value="0" checked/>
												<label for="switch_left">Contado</label>
												<input type="radio" id="switch_right" name="switch_2" value="1" />
												<label for="switch_right">Crédito</label>
											</div>
											<script>
											function desavilita(){
												console.log("desabilta");
												si = $('input:radio[name=switch_2]:checked').val();
												mone = document.getElementById("money");

												if(si==1){
													document.getElementById("money").value=0;

													mone.disabled = true;

												}else{
													mone.disabled = false;

												}
											}
											</script>
			              </div>
			              </div>
			            </div>
									<div class="form-group">
									              <label for="presentation" class="col-sm-2 col-xs-6 control-label">Adelanto</label>
									              <div class="col-sm-4 col-xs-5">
									                <div class="switch-field">
									                  <input type="radio" id="switch_left2" name="adelanto" value="0" checked="" onchange="presentaciones2()">
									                  <label for="switch_left2">No</label>
									                  <input type="radio" id="switch_right2" name="adelanto" value="1" onchange="presentaciones()">
									                  <label for="switch_right2">Si</label>
									                </div>
									              </div>
									              <div id="presentacionesresumen" class="otraspresentaciones"><!--- ver fraciones -->
									</div>
									            </div>



						<input name="is_oficial" type="hidden" value="1">
						<div class="col-sm-10">
							<a href="index.php?action=clearcart" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>

							<button class="btn btn-lg btn-success"><i class="glyphicon glyphicon-usd"></i> Finalizar Venta</button>
							<button id="btnprintoutcot" class="btn btn-lg" onclick="printoutcot()"><i class="glyphicon glyphicon-print"></i> Imprimir Cotisacion</button>
							<script>
							//esta funcion carga el formulario para guardar un nuevo Cliente
							function printoutcot(){
								//estalinea es por un error de doble ventana he impide que se abra dosveces el modal
								$("#btnprintoutcot").prop('disabled', true);
								console.log("nuevo Cliente")
								$.get("./?action=printcot",function(data){
								    if (data.estado == "true") {
								    alertify.success('Se Imprimio correctamente');

								    }else {
								       alertify.error('No se pudo Imprimir ');

								      }
								$("#btnprintoutcot").prop('disabled', false);
								});
							}
							</script>
						</div>
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
									<form id="searchclients" class="" action="index.html" method="post">


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

									$("#buscar").on("click",function(e){
										e.preventDefault();
										$.get("./?action=searchclients",$("#cliente").serialize(),function(data){
											$("#results").html(data);
										});
										$("#clients").val("");
									});

									<?php 	if(isset($_COOKIE['cliente_id'])) {
										echo "elegir(".$_COOKIE['cliente_id'].")";
									}
									 ?>
								});
								function savedatos(){
									console.log("savedatos");
									$.post("./?action=savedatos",
									{
										cliente_id: $("#client_id").val(),
										discount:$("#discount").val(),
									},function(data){
										if (data.estado == "true") {
										console.log("savedatos exito");
										}else {
										console.log("savedatos salio mal");
										}
									});
								}
								function elegir(valor){
									$("#client_id option[value="+ valor +"]").attr("selected",true);
									savedatos();
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
						discount = $("#discount").val();
						money = $("#money").val();
						cliente = $("#client_id").val();
						cliente2=$('#client_id option:selected').text();
						otra = $('input:radio[name=switch_2]:checked').val();

						//override defaults para que se ve el tema
						alertify.defaults.transition = "slide";
						alertify.defaults.theme.ok = "btn btn-info";
						alertify.defaults.theme.cancel = "btn btn-danger";
						alertify.defaults.theme.input = "form-control";


						if(discount>(<?php echo $dicuento;?>)){
							alertify.alert('ERROR', 'No se puede efectuar la operacion. Descuento muy alto!', function(){ alertify.error('Descuento muy alto'); });
							e.preventDefault();
						}else{
							if(otra==0 ){
								if(money<(<?php echo $total ;?>-discount)){
									alertify.alert('ERROR', 'No se puede efectuar la operacion. Falta efectivo!', function(){ alertify.error('Falta efectivo'); });
									e.preventDefault();

								}else{
									if(discount==""){ discount=0; }



									alertify.confirm('Cambio',"Cambio: $"+(money-(<?php echo $total ;?>-discount ) ),

									function(){ alertify.success('Ok')
									setTimeout(function(){ document.processsell.submit() ; }, 500);

								}

								, function(){ alertify.error('Cancelado por usuario')});
								e.preventDefault();
							}
						}else{
							if(cliente==""){
								alertify.alert('ERROR',"No se puede efectuar la operacion falta cliente ", function(){ alertify.error('Falta cliente'); });
								e.preventDefault();
							}else{

								alertify.confirm('Acreditar', "desea acreditar: $"+(<?php echo $total ;?>-discount )+" a "+ cliente2,
								function(){ alertify.success('si acecto acreditar')
								setTimeout(function(){ document.processsell.submit() ; }, 500);
							}
							, function(){ alertify.error('canselado por usuario')});


						}
						e.preventDefault();
					}
				}});
			</script>
		<?php endif; ?>
		<script>
		function addclient(){
			var elem = $('#page_view');
			var parametros = new FormData($("#newcliente")[0]);
			$.ajax({
				data: parametros,
				url: "./?action=addclient",
				type: "POST",
				contentType:false,
				processData:false,
				beforeSend: function(){
				},
				success: function(response){
					alertify.success(response);
				}
			});
			$('#bclose').click();
		};
		//////////////////////////////////////////////////////////////////

		function elegir(valor){
			$("#client_id option[value="+ valor +"]").attr("selected",true);

		}

	</script>
