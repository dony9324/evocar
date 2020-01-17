<section class="content-header">
	<h1> <i class='fa fa-tags'></i> Inventario <small></small> </h1>
	<ol class="breadcrumb">
		<li onclick="changerview('./?page=home')"><a href="#" id="inventaryhome"><i class="fa fa-home"></i> inicio</a>
		</li>
		<li onclick="changerview('./?page=inventary')" class="active"><a id="inventaryinventary" href="#">Inventario</a>
		</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Lista de Productos</h3>
					<div class="btn-group  pull-right">
						<a class="btn btn-default"><i class="fa fa-refresh"></i> Devoluciones</a>
						<a onclick="changerview('./?page=re')" id="re" class="btn btn-default"><i class="fa fa-refresh"></i> Reabastecer</a>
						<button type="button" id="btnnewproducto" class="btn btn-default" onclick="newproducto()"><i class="fa fa-tags"></i>Nuevo Producto</button>
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-download"></i> Descargar <span class="caret"></span>
		  					</button>

							<ul class="dropdown-menu" role="menu">
								<li><a href="report/products-word.php">Word 2007 (.docx)</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Modal2 -->
				<div id="newproducto"> </div>
				<div id="categorías"></div>
				<script>
					//esta funcion carga el formulario para guardar un nuevo producto
					function newproducto() {
						//estalinea es por un error de doble ventana he impide que se abra dosveces el modal
						$( "#btnnewproducto" ).prop( 'disabled', true );
						console.log( "nuevo producto" )
						$.get( "./?action=newproduct", function ( data ) {
							$( "#newproducto" ).html( data );
							$( '#myModal' ).modal( 'show' );
							$( "#btnnewproducto" ).prop( 'disabled', false );
						} );

					}
				</script>

				<!-- /.box-header -->
				<div class="box-body">
					<?php
					$products = ProductData::getAll();
					if ( count( $products ) > 0 ) {
						// si hay usuarios
						?>
					<table id="example1" class="table table-hover">
						<thead>
							<tr>
								<th>Id</th>
								<th>Codigo</th>
								<th>Imagen</th>
								<th>Nombre</th>
								<th>Costo</th>
								<th>Precio</th>
								<th>I.V.A.</th>
								<th>Minima</th>
								<th>Activo</th>
								<th>Disponible</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ( $products as $product ) {
								$q = OperationData::getQYesF( $product->id );
								?>
							<tr>
								<td>
									<?php echo $product->id; ?>
								</td>
								<td>
									<?php echo $product->barcode; ?>
								</td>
								<td>
									<?php if($product->image!=""):?><img src="res/img/<?php echo $product->image;?>" style="width:64px;">
									<?php endif;?>
								</td>
								<td>
									<?php echo $product->name; ?>
								</td>
								<td>$
									<?php echo number_format(($product->price_in/100),2,'.',','); ?>
								</td>
								<td>$
									<?php echo number_format(($product->price_out/100),2,'.',','); ?>
								</td>
								<td>
									<?php if($product->category_id!=null && $product->category_id != 0 ){if(isset($product->getCategory()->name)){
				  echo $product->getCategory()->name;
				} else { echo "eliminada";}
			  }else{ echo "General"; }  ?>
								</td>
								<td>
									<?php echo $product->inventary_min; ?>
								</td>
								<td>
									<?php if($product->is_active): ?><i class="fa fa-check"></i>
									<?php endif;?>
								</td>
								<td>
									<?php echo $q; ?>
								</td>
								<td style="width:50px;">
									<a href="index.php?view=history&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-time"></i> Historial</a>

									<a href="index.php?view=editproduct&id=<?php echo $product->id; ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
									<?php  $u = UserData::getById($_SESSION["user_id"]); if($u->id == 1 or $u->id ==3 ):?>
									<a href="index.php?action=delproduct&id=<?php echo $product->id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
									<a href="#" onclick="printoutcot<?php echo $product->id; ?>()" class="btn btn-xs btn-info"><i class="fa fa-print"></i></a>


									<script>
										function printoutcot<?php echo $product->id; ?>(){
											console.log("printoutcot");
										$.get("./?imprimir=printdatospro",
													{
													id:<?php echo $product->id; ?>,
													name:"<?php echo addslashes($product->name); ?>",
													q:<?php echo $q; ?>
													},function(data){
											if (data.estado == "true") {
												alertify.success('Se actualizo cantidad correctamente');
											}else {
												alertify.error('No se pudo actualizar cantidad');
											}
										});
									}
									</script>


									<?php endif;?>
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Codigo</th>
								<th>Imagen</th>
								<th>Nombre</th>
								<th>Costo</th>
								<th>Precio</th>
								<th>I.V.A.</th>
								<th>Minima</th>
								<th>Activo</th>
								<th>Disponible</th>
								<th></th>
							</tr>
						</tfoot>
					</table>
					<?php  }else{
	  echo "<p class='alert alert-danger'>No hay productos</p>";
	}
	?>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<script>
	$( "#nav li" ).removeClass( "active" );
	$( "#inventary" ).last().addClass( "active" );
</script>
<!-- el siguente script traduce las tablas. Opcionalmente, puede agregar complementos Slimscroll y FastClick.
Se recomiendan estos dos complementos para mejorar la experiencia de usuario -->
<script>
	$( function () {
		$( '#example1' ).DataTable( {
			"bJQuerryUI": true,
			"sPaginationType": "full_numbers",
			"sScrollX": "110%",
			"bScrollCollapse": true,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible en esta tabla",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		} )
	} );
</script>
