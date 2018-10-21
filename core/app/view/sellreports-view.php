 <section class="content-header">
      <h1>
    Reportes de Ventas
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Reportes</li>
      </ol>
    </section>
    
    
    
    
    
    
    
    
    
    
    <section class="content">
      <!-- Info boxes -->
     <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Reportes de Ventas</h3>

              <div class="box-tools pull-right">
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              
              
              
              
              
              <?php
$clients = PersonData::getClients();
?>
<section class="content">
<div class="row">
	<div class="col-md-12">
	<h1></h1>

						<form >
						<input type="hidden" name="view" value="sellreports">
<div class="row"><h3>Cliente</h3>
<div class="col-md-3">

<select name="client_id" class="form-control">
	<option value="">--  TODOS --</option>
	<?php foreach($clients as $p):?>
	<option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
	<?php endforeach; ?>
</select>

</div>
<div class="col-md-3">
<input type="date" name="sd" value="<?php if(isset($_GET["sd"])){ echo $_GET["sd"]; }?>" class="form-control">
</div>
<div class="col-md-3">
<input type="date" name="ed" value="<?php if(isset($_GET["ed"])){ echo $_GET["ed"]; }?>" class="form-control">
</div>

<div class="col-md-3">
<input type="submit" class="btn btn-success btn-block" value="Procesar">
</div>

</div>
<!--
<br>
<div class="row">
<div class="col-md-4">

<select name="mesero_id" class="form-control">
	<option value="">--  MESEROS --</option>
	<?php foreach($meseros as $p):?>
	<option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
	<?php endforeach; ?>
</select>

</div>

<div class="col-md-4">

<select name="operation_type_id" class="form-control">
	<option value="1">VENTA</option>
</select>

</div>

</div>
-->
</form>

	</div>
	</div>
<br><!--- -->
<div class="row">
	
	<div class="col-md-12">
		<?php if(isset($_GET["sd"]) && isset($_GET["ed"]) ):?>
<?php if($_GET["sd"]!=""&&$_GET["ed"]!=""):?>
			<?php 
			$operations = array();

			if($_GET["client_id"]==""){
			$operations = SellData::getAllByDateOpp($_GET["sd"],$_GET["ed"],2);
			}
			else{
			$operations = SellData::getAllByDateBCOp($_GET["client_id"],$_GET["sd"],$_GET["ed"],2);
			} 


			 ?>

			 <?php if(count($operations)>0):?>
			 	<?php $supertotal = 0; ?>
<table style="width:100%;" class="table table-bordered">
	<thead>
		<th>Id</th>
		<th>Subtotal</th>
		<th>Descuento</th>
		<th>Total</th>
		<th>Fecha</th>
	</thead>
<?php foreach($operations as $operation):?>
	<tr>
		<td><?php echo $operation->id; ?></td>
		<td>$ <?php echo number_format($operation->total,2,'.',','); ?></td>
		<td>$ <?php echo number_format($operation->discount,2,'.',','); ?></td>
		<td>$ <?php echo number_format($operation->total-$operation->discount,2,'.',','); ?></td>
		<td><?php echo $operation->created_at; ?></td>
	</tr>
<?php
$supertotal+= ($operation->total-$operation->discount);
 endforeach; ?>

</table>
<h1>Total de ventas: $ <?php echo number_format($supertotal,2,'.',','); ?></h1>

			 <?php else:
			 // si no hay operaciones
			 ?>
<script>
	$("#wellcome").hide();
</script>
<div class="jumbotron">
	<h2>No hay operaciones</h2>
	<p>El rango de fechas seleccionado no proporciono ningun resultado de operaciones.</p>
</div>

			 <?php endif; ?>
<?php else:?>
<script>
	$("#wellcome").hide();
</script>
<div class="jumbotron">
	<h2>Fecha Incorrectas</h2>
	<p>Puede ser que no selecciono un rango de fechas, o el rango seleccionado es incorrecto.</p>
</div>
<?php endif;?>

		<?php endif; ?>
	</div>
</div>


</section>
              
              
              
              
              
              
              
              
              
              
              
              
              
            </div>
            <!-- ./box-body -->
      
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->      <!-- /.row -->
    </section>