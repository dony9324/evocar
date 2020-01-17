<section class="content-header">
  <h1><i class='fa  fa-cube'></i>Caja<small></small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> inicio</a></li>
    <li class="active">Caja</li>
  </ol>
</section>
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Ventas en caja</h3>

          <div class="box-tools pull-right">

            <?php $u=null;

            $u = UserData::getById($_SESSION["user_id"]);
            if($u->is_admin):?>
            <a href="./index.php?action=processbox" class="btn btn-default">Procesar Ventas <i class="fa fa-arrow-right"></i></a>
            <a href="./index.php?view=boxhistory" class="btn btn-default"><i class="fa fa-clock-o"></i> Historial</a>
          <?php endif;?>
        </div>
      </br>
      <!-- /.progress-group -->

      <!-- /.progress-group -->

    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">

        <p class="text-center">
          <strong></strong>
        </p>


        <?php $products = SellData::getSellsUnBoxed();
        if(count($products)>0){
          $total_total = 0;
          ?>

          <!-- /.box-header -->
          <div class="box-body">
            <table style="width:100%;" class="table table-condensed">
              <tbody><tr>
                <th>Ver venta</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Fecha</th>
              </tr>
              <?php foreach($products as $sell):?>
                <?php if ( ($sell->accredit)==0){ ?>
                  <tr>
                    <td style="width:130px;"><a href="index.php?view=onesell&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>

                    <?php
                    $operations = OperationData::getAllProductsBySellId($sell->id);

                    ?>

                    <?php
                    $total=0;
                    foreach($operations as $operation){
                      $product  = $operation->getProduct();
                      $total += $operation->q*$product->price_out;
                    }
                    $total_total += $total; ?>
                    <td><?php echo count($operations);?> </td>
                    <td><?php echo "<b>$ ".number_format($total,2,".",",")."</b>";?></td>
                    <td><?php echo $sell->created_at; ?></td>
                  </tr>

                <?php } endforeach; ?>
              </tbody></table>
              <?php
            }else {

              ?>
              <div class="jumbotron">
                <h2>No hay ventas</h2>
                <p>No se ha realizado ninguna venta.</p>
              </div>

            <?php } ?>

          </div>
          <!-- /.box-body -->
          <!-- /.col -->

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- ./box-body -->
      <div class="box-footer">
        <div class="row">

          <div class="description-block border-right">

            <h5 class="description-header"><?php if (isset($total_total)){echo "$ ".number_format($total_total,2,".",","); }?></h5>
            <span class="description-text">TOTAL</span>
          </div>
          <!-- /.description-block -->

          <!-- /.col -->


        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->      <!-- /.row -->
</section>
<script>
$("#nav li").removeClass("active");
$( "#box" ).last().addClass( "active" );
</script>
