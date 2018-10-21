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
					<button class="btn btn-success" onclick="processre(<?php echo $product->id; ?>, <?php echo $error["re"] ; ?>, <?php echo $product->price_in; ?>)"> Reabastecer faltante </button>
				</span></th>
			</tr>
		<?php endforeach; ?>
	</table>

	<script>
	function processre(id, q, pin){
		console.log("processre"+id+"cant: "+q)
		//alertify.success('añadiendo a la Lista Producto'+id)
		$.get("./?action=processre",
		{
			o:"one",
			price_in:pin,
			product_q:q,
			product_id:id
		},function(data){
			if (data.estado == "true") {
				alertify.success('Se Reabasteció producto correctamente');

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
	$total = 0;
	$total2 = 0;//esto es para el descuento
	?>
	<h3>Lista de venta</h3>
	<table style="width:100%;" class="text-center table table-bordered table-hover">
		<thead>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>Costo</th>
			<th>Total</th>
			<th ></th>
		</thead>
		<?php $dicuento=0; foreach($_SESSION["cart"] as $p):
			$product = ProductData::getById($p["product_id"]);
			?>
			<tr >
				<td style="width:auto"><?php echo $product->name; ?></td>
				<td ><?php echo $p["q"]; ?></td>
				<td><b>$ <?php echo $product->price_out; ?></b></td>
				<td><b>$ <?php echo $product->price_in; ?></b></td>
				<td><b>$ <?php  $pt = $product->price_out*$p["q"]; $total +=$pt; $pt2 = $product->price_in*$p["q"];
				$total2 +=$pt2; echo $pt; ?></b></td>
				<td style="width:30px;"><a<?php if (($pt - $pt2 - ($pt2*.05))<0){ } else{$dicuento+=($pt - $pt2 - ($pt2*.05));}?>
					class="btn btn-danger" onclick="clearcart(<?php echo $product->id; ?>)"><i class="glyphicon glyphicon-remove"></i> Eliminar</a></td>
				</tr>
			<?php endforeach;
			$infoiva= CompanyData::getById(1)->value;
			?>
		</table>
		<form method="post" class="form-horizontal" name ="processsell" id="processsell" action="index.php?action=process-sell" >
			<h3>Resumen</h3>
			<input type="hidden" name="total" value="<?php echo $total; ?>" class="form-control" placeholder="Total">
			<table style="width:100%;" class="table table-bordered">
				<tr>
					<td class="info" style="width:150px"><p><b>Total</b></p></td>
					<td class="danger"><p><b>$ <?php echo ($total); ?></b></p></td>
					<td ></td>
					<td class="info" style="width:180px"><p><b>Descuento maximo</b></p></td>
					<td class="success"><p><b>$ <?php echo $dicuento;  ?></b></p></td>

				</tr>

			</table>
			<input type="hidden" name="cost" value="<?php echo $total2; ?>" class="form-control" placeholder="Total">
			<div class="form-group">
				<div class="col-lg-2">
					<label  class="col-lg-1 control-label">Cliente</label></div>
					<div class="col-lg-10">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa  fa-plus"></i> Nuevo Cliente</button>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-search"></i>Buscar Cliente</button>
					</div>
				</div>
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
								<input type="text" id="cliente" name="clients" class="form-control" autofocus="on">
								<button type="button" id="buscar" class="btn btn-info"><i class="glyphicon glyphicon-search"></i> Buscar Cliente</button>
							</div>
							<div id="results"></div>
							<script>
							//jQuery.noConflict();

							$(document).ready(function(){
								$("#buscar").on("click",function(e){
									e.preventDefault();
									$.get("./?action=searchclients",$("#cliente").serialize(),function(data){
										$("#results").html(data);
									});
									$("#clients").val("");
								});
							});
							function elegir(valor){
								$("#client_id option[value="+ valor +"]").attr("selected",true);
							}
						</script>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
			<!-- fin Modal -->



			<?php
			$clients = PersonData::getClients();
			?>

			<div class="form-group col-lg-6">
				<div class="col-lg-2">
					<label>Cliente</label>
				</div>
				<div class="col-lg-10">
					<select name="client_id" id="client_id" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option selected="selected" value="">-- NINGUNO --</option>
						<?php foreach($clients as $client):?>
							<option value="<?php echo $client->id;?>"><?php echo $client->name." ".$client->lastname;?></option>
						<?php endforeach;?>

					</select>
				</div>
			</div>



			<div class="form-group col-lg-6">
				<div class="col-lg-2"><label  class="col-lg-1 control-label">Descuento</label></div>
				<div class="col-lg-10">
					<input type="number" step="any" name="discount" class="form-control" required value="0" id="discount" placeholder="Descuento">
				</div>
			</div>

			<div class="form-group col-lg-6 ">
				<div class="col-lg-2">
					<label  class="col-lg-1 control-label">Efectivo</label></div>
					<div class="col-lg-10">
						<input type="number" min="0" name="money" required class="form-control" id="money" placeholder="Efectivo">
					</div>
				</div>

				<div class="form-group col-lg-6">
					<div class="col-lg-2">
						<label  class="col-lg-1 control-label">Tipo</label></div>
						<div class="col-lg-10">
							<script>
							function desavilita(){
								si = $('input:radio[name=switch_2]:checked').val();
								mone = document.getElementById("money");
								discoun = document.getElementById("discount");
								if(si==1){
									document.getElementById("money").value=0;
									document.getElementById("discount").value=0;
									mone.disabled = true;
									discoun.disabled = true;
								}else{
									mone.disabled = false;
									discoun.disabled = false;
								}
							}
							</script>
							<div class="switch-field" onClick="desavilita()">
								<input type="radio" id="switch_left" name="switch_2" value="0" checked/>
								<label for="switch_left">Contado</label>
								<input type="radio" id="switch_medio" name="switch_2" value="1" />
								<label for="switch_medio">Crédito</label>
								<input type="radio" id="switch_right" name="switch_2" value="2" />
								<label for="switch_right">Contado</label>
							</div>
						</div></div>

						<input name="is_oficial" type="hidden" value="1">
						<div class="col-lg-10">
							<a href="index.php?action=clearcart" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
							<button class="btn btn-lg btn-default"><i class="glyphicon glyphicon-print"></i> Imprimir Cotisacion</button>
							<button class="btn btn-lg btn-success"><i class="glyphicon glyphicon-usd"></i> Finalizar Venta</button>
							<a href="res/escpos-php-master/cot.php" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Imprimir Cotisacion</a>
						</div>
					</form>
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
								if(money<(<?php echo $total;?>-discount)){
									alertify.alert('ERROR', 'No se puede efectuar la operacion. Falta efectivo!', function(){ alertify.error('Falta efectivo'); });
									e.preventDefault();

								}else{
									if(discount==""){ discount=0; }



									alertify.confirm('Cambio',"Cambio: $"+(money-(<?php echo $total;?>-discount ) ),

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

								alertify.confirm('Acreditar', "desea acreditar: $"+(<?php echo $total;?>-discount )+" a "+ cliente2,
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


		<!---newclient-->
		<!-- Modal2 -->
		<div id="myModal" class="modal fade in" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Nuevo Cliente</h3>
						<button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data"  id="newcliente" action="./?action=addclient" role="form" >
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Imagen</label>

									<div class="col-sm-10">
										<input type="file" name="image" id="image" accept="image/*" >
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1"  class="col-lg-2 control-label">Nombre</label>

									<div class="col-sm-10">
										<input type="text" required name="name"  class="form-control" id="name" placeholder="Nombre">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Apellido</label>

									<div class="col-sm-10">
										<input type="text"  name="lastname"  class="form-control" id="lastname" placeholder="Apellido">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Cedula</label>

									<div class="col-sm-10">
										<input type="text" name="identity" class="form-control" id="identity" placeholder="Cedula">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Direccion</label>

									<div class="col-sm-10">
										<input type="text" name="address1" class="form-control"  id="address1" placeholder="Direccion">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Email</label>

									<div class="col-sm-10">
										<input type="text" name="email1" class="form-control" id="email1" placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>

									<div class="col-sm-10">
										<input type="text" name="phone1" class="form-control" id="phone1" placeholder="Telefono">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Telefono 2</label>

									<div class="col-sm-10">
										<input type="text" name="phone2" class="form-control" id="phone2" placeholder="Telefono 2">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Empresa</label>

									<div class="col-sm-10">
										<input type="text" name="company" class="form-control" id="company" placeholder="Empresa">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Nit</label>

									<div class="col-sm-10">
										<input type="text" name="nit" class="form-control" id="nit" placeholder="Nit">
									</div>
								</div>
								<div class="form-group">

									<div class="col-lg-offset-2 col-lg-12">
										<button type="button"  class="btn btn-success" onclick="addclient();">Guardar Cliente</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
							<!-- /.box-body
							<div class="box-footer">
							<button type="submit" class="btn btn-default">Cancel</button>
							<button type="submit" class="btn btn-info pull-right">Sign in</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
			</div>
		</div>

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
