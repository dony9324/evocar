   <section class="content-header">
      <h1><i class="fa  fa-tags"></i>Reabastecer Inventario<small></small></h1>       
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> inicio</a></li>
        <li class="active">Inventario</li>
        <li class="active">Reabastecer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
     <div class="row">
        <div class="col-md-12">
          <div class="box">
           <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              
              <div style="height:20px;" class="col-md-12">

  </div>
            <form >
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="view" value="re">
				<input type="text" name="product" class="form-control" placeholder="Buscar producto por nombre o por codigo:">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
		</div>
		</form>


<?php if(isset($_GET["product"])):?>
	<?php
$products = ProductData::getLike($_GET["product"]);
if(count($products)>0){
	?>
<h3>Resultados de la Busqueda</h3>
            <!-- /.box-header -->
            <div class="box-body">
              <table style="width:100%;" class="table table-condensed">
                <tbody><tr>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Unidad</th>
		<th>Precio unitario</th>
		<th>En inventario</th>
		<th>Cantidad</th>
		<th style="width:100px;"></th>
                </tr>
                                    <?php
$products_in_cero=0;
	 foreach($products as $product):
$q= OperationData::getQYesF($product->id);
	?>
		<form method="post" action="index.php?action=addtore" >
	<tr class="<?php if($q<=$product->inventary_min){ echo "danger"; }?>">
		<td style="width:80px;"><?php echo $product->id; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $product->unit; ?></td>
		<td><b>$<?php echo $product->price_in; ?></b></td>
		<td>
			<?php echo $q; ?>
		</td>
		<td>
		<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
		<input type="" class="form-control" required name="q" placeholder="Cantidad de producto ..."></td>
		<td style="width:100px;">
		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Agregar</button>
		</td>
	</tr>
	</form>
	<?php endforeach;?>
  </tbody></table>
                            

	<?php
}
?>
<br><hr>
<hr><br>
<?php else:
?>

<?php endif; ?>

<?php if(isset($_SESSION["errors2"])):?>
<h2>Errores</h2>
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


<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["reabastecer"])):
$total = 0;
?>
<h2>Lista de Reabastecimiento</h2>
<table style="width:100%;" class="table table-bordered table-hover">
<thead>
	<th style="width:30px;">Codigo</th>
	<th style="width:30px;">Cantidad</th>
	<th style="width:30px;">Unidad</th>
	<th>Producto</th>
	<th style="width:30px;">Precio Unitario</th>
	<th style="width:30px;">Precio Total</th>
	<th ></th>
</thead>
<?php foreach($_SESSION["reabastecer"] as $p):
$product = ProductData::getById($p["product_id"]);
?>
<tr >
	<td><?php echo $product->id; ?></td>
	<td ><?php echo $p["q"]; ?></td>
	<td><?php echo $product->unit; ?></td>
	<td><?php echo $product->name; ?></td>
	<td><b>$ <?php echo number_format($product->price_in); ?></b></td>
	<td><b>$ <?php  $pt = $product->price_in*$p["q"]; $total +=$pt; echo number_format($pt); ?></b></td>
	<td style="width:30px;"><a href="index.php?action=clearre&product_id=<?php echo $product->id; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></td>
</tr>

<?php endforeach; ?>
</table>
<form method="post" class="form-horizontal" id="processsell" action="index.php?action=processre" >
<h2>Resumen</h2>
<div class="form-group">
    <label  class="col-lg-2 control-label">Proveedor</label>
    <div class="col-lg-10">
    <?php 
$clients = PersonData::getProviders();
    ?>
    <select name="client_id" class="form-control">
    <option value="">-- NINGUNO --</option>
    <?php foreach($clients as $client):?>
    	<option value="<?php echo $client->id;?>"><?php echo $client->name." ".$client->lastname;?></option>
    <?php endforeach;?>
    	</select>
        
        
        <a data-toggle="modal" href="remote.html" data-target="#modal">Click me</a>
    </div>
  </div>
<div class="form-group">
    
    <div class="col-lg-10">
      
    </div>
  </div>
  <div class="form-group">
    
    <div class="col-lg-10">
      <input type="hidden" name="total" class="form-control" id="total" value=" <?php echo $total; ?>">
    </div>
  </div>
  <div class="row">
<div class="col-md-6 col-md-offset-6">
<table style="width:100%;" class="table table-bordered">
<tr>
	<td><p>Subtotal</p></td>
	<td><p><b>$ <?php $infoiva= CompanyData::getById(1)->value; echo number_format($total*(100-$infoiva)/100); ?></b></p></td>
</tr>
<tr>
	<td><p>IVA</p></td>
	<td><p><b>$ <?php echo number_format($total*$infoiva/100); ?></b></p></td>
</tr>
<tr>
	<td><p>Total</p></td>
	<td><p><b>$ <?php echo number_format($total); ?></b></p></td>
</tr>

</table>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
          <input name="is_oficial" type="hidden" value="1">
        </label>
      </div>
    </div>
  </div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
		<a href="index.php?action=clearre" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
        <button class="btn btn-lg btn-info"><i class="fa fa-refresh"></i> Procesar Reabastecimiento</button>
        </label>
      </div>
    </div>
  </div>
</form>
<script>
	$("#processsell").submit(function(e){
		//money = $("#money").val();
	///	if(money<<?php //echo $total;?>){
		///	alert("No se puede efectuar la operacion");
			
			
					 setTimeout(function(){ document.processsell.submit() ; }, 500);
			
		//	e.preventDefault();
		//}else{
			go = confirm("total: $"+(<?php echo $total;?>));
			if(go){}
				else{e.preventDefault();}
	//	}
	});
</script>
</div>
</div>
<?php endif; ?>


            <!-- /.box-body -->
                <!-- /.col -->
            
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
        
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    
      <!-- /.row -->

      <!-- Main row -->      <!-- /.row -->
    </section>
    <script>
	$("#nav li").removeClass("active"); 
	 $( "#box" ).last().addClass( "active" );
            </script>
