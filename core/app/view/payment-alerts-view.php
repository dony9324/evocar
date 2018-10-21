<section class="content-header">
      <h1>
        Alertas de Pagos
       </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="#">Creditos</a></li>
        <li class="active">Alertas de Pagos</li>
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
      $nohay=true;
      $total_pagado = 0;
      $total_acreditado = 0;
      $total_pagado2 = 0;
      $total_can = 0;
			$sells = SellData::getSells();
      if(count($sells)>0){
			foreach($sells as $sell){
        if ( ($sell->accredit)==1  && ($sell->created_at <= date('Y-m-d',strtotime("-1 month")))){
				$q= PaymentData::getQYesF($sell->id);
      		if ($q > 0){
            $Payments = PaymentData::getAllByProductId($sell->id);
            $masmes = true;
          //  if(count($Payments)>0 ){

              foreach($Payments  as $Payment):
               if ($Payment->created_at> date('Y-m-d',strtotime("-1 month")))
              {
              $masmes=false;
              break;
              }
              endforeach;
				//  }
          if($masmes){ //si no hay un pago con fecha mayor a hace un mes
          $nohay=false;
          $found=true;
            break;
        }
			}}}}
			?>




<?php if($found):?>
 <div class="btn-group pull-right">

  	<a href="index.php?view=payment" class="btn btn-default"><i class="fa fa-usd"></i> Nuevo Pago</a>


    <div class="btn-group pull-right">

	<?php $u=null;
if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
  $u = UserData::getById($_SESSION["user_id"]);
?>
    <?php if($u->is_admin):?>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/payment-alerts-word.php">Word 2007 (.docx)</a></li>
  </ul><?php endif;?><?php endif;?>
</div>

</div>
  <h3 class="box-title">Productos con pocas existencias</h3>
            </div>

<?php
if(count($sells)>0){
	?>

          
            <!-- /.box-header -->
            <div class="box-body">
              <table style="width:100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Ver Venta</th>
                  <th>Codigo</th>
                  <th>Cliente</th>
                  <th>Total</th>
                  <th>Total pagado</th>
                  <th>Deuda</th>
                  <th>Fecha</th>
                  <th>Ver pagos</th>

                </tr>
                </thead>
                <tbody>
                	<?php
foreach($sells as $sell):
  if ( ($sell->accredit)==1  && ($sell->created_at <= date('Y-m-d',strtotime("-1 month")))){
		$q= PaymentData::getQYesF($sell->id);
	 if ($q > 0){
     $Payments = PaymentData::getAllByProductId($sell->id);
     if(count($Payments)>0 ){
       foreach($Payments  as $Payment):
         if ($Payment->created_at> date('Y-m-d',strtotime("-1 month")))
         {
         $masmes=false;
         break;
         }
       endforeach;
       }
       if($masmes){
         $total= $sell->total-$sell->discount;
	?>
      <tr class="<?php if ($q == 0){$total_can = $total_can+1; $total_pagado2 = $total_pagado2 + $total;  echo 'success';} ?> <?php if (($total - $q)==0){ echo 'danger';} ?> <?php if (($total - $q) > 0 && ($q != 0) ) { echo 'warning';} ?>">
		<td style="width:30px;"><a href="index.php?view=onesell&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>
    <td><?php echo $sell->id; ?></td>
    <td>

<?php
$client = PersonData::getById($sell->person_id);
if(isset($client -> name) && $sell->person_id!=""):
				 echo $client -> name . " ".$client -> lastname ;
				  else: echo "ERROR. El Cliente fue eliminado";
				 endif;

?> </td>
<td>

<?php


/*foreach($operations as $operation){
  $product  = $operation->getProduct();
  $total += $operation->q*$product->price_out;
}*/ $total_acreditado = $total_acreditado + $total ;
  echo "<b>$ ".number_format($total)."</b>";

?>

  </td>
  <td><?php $total_pagado =$total_pagado +($total - $q); echo "<b>$ ".number_format($total - $q)."</b>";;?></td>
<td class="<?php if ($q == 0){ echo 'success';} ?>" ><?php if ($q == 0){ echo "<b> "."Cridito pagado"."</b> ";}else{echo "<b>$ ".number_format($q)."</b>";}?></td>
  <td><?php echo $sell->created_at; ?></td>
  <td style="width:30px;"><a href="index.php?view=onecredits&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>
	</tr>
  <?php }}} ?>

<?php
endforeach;
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Ver Venta</th>
                      <th>Codigo</th>
                      <th>Cliente</th>
              		<th>Total</th>
                      <th>Total pagado</th>
              		<th>Deuda</th>
                      <th>Fecha</th>
                       <th>Ver pagos</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            	<?php
}
endif;
if($nohay){
	?>
    <div class="jumbotron">
		<h2>No hay alertas</h2>
		<p>Por el momento no hay alertas de pagos, estas se muestran cuando los creditos tienen mas de un mes sin pagos.</p>
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
