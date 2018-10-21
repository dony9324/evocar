<section class="content-header">
      <h1>
        Resumen de Venta
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Inico</a></li>
        <li>Vender</li>
                <li class="active">Resumen de Venta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
     <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de la Venta</h3>
<div class="btn-group pull-right">
<a href="res/escpos-php-master/receipt-with-logo.php?id=<?php echo $_GET["id"];?>"  class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Imprimir</a>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/onesell-word.php?id=<?php echo $_GET["id"];?>">Word 2007 (.docx)</a></li>
  </ul>
</div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>
<?php
$sell = SellData::getById($_GET["id"]);
$operations = OperationData::getAllProductsBySellId($_GET["id"]);
$total = 0;
if(isset($_COOKIE["selled"])){
	foreach ($operations as $operation) {
//		print_r($operation);
		$qx = OperationData::getQYesF($operation->product_id);
		// print "qx=$qx";
			$p = $operation->getProduct();
		if($qx==0){
			echo "<p class='alert alert-danger'>El producto <b style='text-transform:uppercase;'> $p->name</b> no tiene existencias en inventario.</p>";			
		}else if($qx<=$p->inventary_min/2){
			echo "<p class='alert alert-danger'>El producto <b style='text-transform:uppercase;'> $p->name</b> tiene muy pocas existencias en inventario.</p>";
		}else if($qx<=$p->inventary_min){
			echo "<p class='alert alert-warning'>El producto <b style='text-transform:uppercase;'> $p->name</b> tiene pocas existencias en inventario.</p>";
		}
	}
	setcookie("selled","",time()-18600);
}

?>          







<div class="col-sm-5 ">
 <table style="width:100%;" class="table table-condensed">
<?php if($sell->person_id!="" && $sell->person_id!=0):
$client = $sell->getPerson();
?>
<tr>
	<td style="width:150px;">Cliente</td>
	<td><?php echo $client->name." ".$client->lastname;?></td>
</tr>

<?php endif; ?>
<?php if($sell->user_id!=""):
$user = $sell->getUser();
?>
<tr>
	<td>Atendido por</td>
	<td><?php echo $user->name." ".$user->lastname;?></td>
</tr>
<?php endif; ?>
</table>
            
            
            
</div>            
           
            
            
            
              <table style="width:100%;" class="table table-condensed">
                <tbody><tr>
                 <th style="width: 10px">#</th>
                  <th>Nombre del Producto</th>
		<th>Codigo de barra</th>
		<th>Cantidad</th>
		<th>Precio Unitario</th>
		<th>Total</th>
                </tr>
                
               
                  <?php
	foreach($operations as $operation){
		$product  = $operation->getProduct();
?>
<tr>
	<td><?php echo $product->id ;?></td>
	<td><?php echo $product->name ;?></td>
	<td><?php echo $product->barcode ;?></td>
	<td><?php echo $operation->q ;?></td>
	
	<td>$ <?php echo ($product->price_out) ;?></td>
	<td><b>$ <?php echo ($operation->q*$product->price_out);$total+=$operation->q*$product->price_out;?></b></td>
</tr>
<?php
	}
	?>
       
              </tbody></table>

            
       
            <?php $infoiva= CompanyData::getById(1)->value; ?>
            
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    
                    <h5 class="description-header">$ <?php echo number_format($sell->discount,2,'.',','); ?></h5>
                    <span class="description-text">Descuento</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    
                    <h5 class="description-header">$ <?php echo number_format(($total/(($infoiva/100)+1)),2,'.',','); ?></h5>
                    <span class="description-text">Subtotal:</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    
                    <h5 class="description-header">$ <?php  echo number_format((($total/(($infoiva/100)+1))*($infoiva/100)),2,'.',','); ?></h5>
                    <span class="description-text">iva: <?php echo $infoiva; ?> %</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                   
                    <h5 class="description-header">$ <?php echo number_format($total-	$sell->discount,2,'.',','); ?></h5>
                    <span class="description-text">Total:</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
             <?php else:?>
	501 Internal Error
<?php endif; ?>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</div>
      <!-- Main row -->      <!-- /.row -->
     
      </section>

