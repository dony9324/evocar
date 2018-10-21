<section class="content-header">
      <h1>
        Alertas de Inventio
       </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="#">Inventio</a></li>
        <li class="active">Alertas de Inventio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box">
            <div class="box-header">
            <?php
  			$un=true;
			$found=false;
			$products = ProductData::getAll();
			foreach($products as $product){
				$q=OperationData::getQYesF($product->id);
				if($q<=$product->inventary_min){
					$found=true;
				break;

				}
			}
			?>




<?php if($found):?>
<div class="btn-group pull-right">
<?php $u=null;
if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
  $u = UserData::getById($_SESSION["user_id"]);
  if($u->is_admin):?>
  <a style="margin: 1px" href="?action=productstock" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Imprimir Lista</a>
  <button style="margin: 1px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
    <ul class="dropdown-menu" role="menu">
    <li><a href="report/alerts-word.php">Word 2007 (.docx)</a></li>
  </ul><?php endif;?><?php endif;?>
</div>


<?php
if(count($products)>0){
	?>

            <h3 class="box-title">Productos con pocas existencias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table style="width:100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Codigo de barrar</th>
                  <th>Nombre del producto)</th>
                  <th>En Stock</th>
                  <th>Estasdo</th>

                </tr>
                </thead>
                <tbody>
                	<?php
foreach($products as $product):
	$q=OperationData::getQYesF($product->id);
	?>
	<?php if($q<=$product->inventary_min):

	?>
      <tr class="<?php if($q==0){ echo "danger"; }else if($q<=$product->inventary_min/2){ echo "warning"; } else if($q<=$product->inventary_min){ echo "info"; } ?>">
		<td><?php echo $product->id; ?></td>
        <td><?php echo $product->barcode; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $q; ?></td>
		<td>
		<?php if($q==0){ echo "<span class='label label-danger'>No hay existencias.</span>";}else if($q<=$product->inventary_min/2){ echo "<span class='label label-danger'>Muy pocas existencias.</span>";} else if($q<=$product->inventary_min){ echo "<span class='label label-warning'>pocas existencias.</span>";} ?>
		</td>
	</tr>
<?php endif;?>
<?php
endforeach;
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Codigo</th>
                  <th>Codigo de barrar</th>
                  <th>Nombre del producto)</th>
                  <th>En Stock</th>
                  <th>Estasdo</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            	<?php
}else{
	?>
    <div class="jumbotron">
		<h2>No hay alertas</h2>
		<p>Por el momento no hay alertas de inventario, estas se muestran cuando el inventario ha alcanzado el nivel minimo.</p>
	</div>
	<?php
}
endif;
if( !$found){
	?>
	<div class="jumbotron">
		<h2>No hay alertas</h2>
		<p>Por el momento no hay alertas de inventario, estas se muestran cuando el inventario ha alcanzado el nivel minimo.</p>
	</div>
	<?php

	}

?>
</div>

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
