<section class="content-header">
  <h1><i class='fa fa-book'></i> Creditos </h1>
  <ol class="breadcrumb">
    <li><a href="#" onClick="changerview('./?page=home')"><i class="fa fa-home"></i> Inicio</a></li>
    <li class="active"><a href="#" onClick="changerview('./?page=home')"><i class="fa fa-home"></i> Creditos</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Creditos</h3>
          <div class="btn-group pull-right">
            <?php $u=null;
            $u = UserData::getById($_SESSION["user_id"]);
            if($u->is_admin):?>
            <a href="./index.php?action=processcredits" class="btn btn-default">Procesar creditos pagados <i class="fa fa-arrow-right"></i></a>
          <?php endif; ?>
          <button type="button" id="btnnewpayment" onclick="newpayment()" class="btn btn-default"><i class='fa fa-usd'></i> Nuevo Pago</button>
          <a href="index.php?view=payment" class="btn btn-default"><i class="fa fa-usd"></i> Nuevo Pago</a>
          <div class="btn-group pull-right">
            <?php if($u->is_admin):?>
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-download"></i> Descargar <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="report/credits-word.php">Word 2007 (.docx)</a></li>
              </ul>
            <?php endif; ?>
          </div>
        </div>

      </div>
      <div id="newpayment"> </div>
      <script>
      //esta funcion carga el formulario para guardar un nuevo Cliente
      function newpayment(){
        //estalinea es por un error de doble ventana he impide que se abra dosveces el modal
        $("#btnnewpayment").prop('disabled', true);
        console.log("nuevo Pago");
        $.get("./?action=newpayment",function(data){
          $("#newpayment").html(data);
          $('#myModal').modal('show');
          $("#btnnewpayment").prop('disabled', false);
        });
      }
      </script>
      <!-- /.box-header -->

      <div class="box-body">
        <?php            $u=null;
        if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
          $u = UserData::getById($_SESSION["user_id"]);
          $products = SellData::getSells();
          $total_pagado = 0;
          $total_acreditado = 0;
          $total_pagado2 = 0;
          $total_can = 0;
          if(count($products)>0){
            ?>
            <table style="width:100%;" id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Ver Venta</th>
                  <th>Codigo</th>
                  <th>Cliente</th>
                  <th>#</th>
                  <th>Productos</th>
                  <th>Total</th>
                  <th>Total pagado</th>
                  <th>Deuda</th>
                  <th>Fecha</th>
                  <th>Ver pagos</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($products as $sell):?>
                  <?php if ( ($sell->accredit)==1){ ?>
                    <?php $q= PaymentData::getQYesF($sell->id);
                    $total= $sell->total-$sell->discount; ?>
                    <tr class="<?php if ($q == 0){$total_can = $total_can+1; $total_pagado2 = $total_pagado2 + $total;  echo 'success';} ?> <?php if (($total - $q)==0){ echo 'danger';} ?> <?php if (($total - $q)>0 && ($q != 0) ){ echo 'warning';} ?>">



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

                      <td><?php echo $sell->person_id ?></td>
                      <td>

                        <?php
                        $operations = OperationData::getAllProductsBySellId($sell->id);
                        echo count($operations);
                        ?>
                      </td>
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
                    <td style="width:30px;"><a href="index.php?view=onecredit&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>

                  </tr>
                <?php } ?>
              <?php endforeach; ?>

            </tbody>
            <tfoot>
              <tr>
                <th>Ver Venta</th>
                <th>Codigo</th>
                <th>Cliente</th>
                <th>#</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Total pagado</th>
                <th>Deuda</th>
                <th>Fecha</th>
                <th>Ver pagos</th>
              </tr>
            </tfoot>
          </table>
          <div class="box-footer">
            <div class="row">
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 100%</span>
                  <h5 class="description-header"><?php echo "$ ".number_format($total_acreditado,2,".",","); ?></h5>
                  <span class="description-text">Total</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> <?php echo (100 * $total_pagado /$total_acreditado  ); ?>%</span>
                  <h5 class="description-header"><?php echo "$ ".number_format($total_pagado,2,".",","); ?></h5>
                  <span class="description-text">Pagado</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">

                  <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> <?php echo (100 * ($total_acreditado - $total_pagado) /$total_acreditado  ); ?>%</span>
                  <h5 class="description-header"><?php echo "$ ".number_format($total_acreditado - $total_pagado,2,".",","); ?></h5>
                  <span class="description-text">Por pagar</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block">

                  <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> <?php echo (100 * $total_pagado2 /$total_acreditado  ); ?>%</span>
                  <h5 class="description-header"><?php echo $total_can." Por: $ ".number_format($total_pagado2,2,".",","); ?></h5>
                  <span class="description-text">Pagados</span>
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <?php
        }else{
          ?>
          <div class="jumbotron">
            <h2>No hay creditos</h2>
            <p>No se ha realizado ninguna credito.</p>
          </div>
          <?php
        }

        ?>
      <?php endif;?>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->
</div>

</section>

<script>
$("#nav li").removeClass("active");
$( "#credits" ).last().addClass( "active" );
</script>
