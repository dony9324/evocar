<div class="col-lg-4" onclick="changerview('./?page=inventary')">
  <a href="#">
                 <div class="box box-widget widget-user">
                <!-- Agregue el color bg al encabezado con cualquiera de los bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                  <div class="small-box">
                      <h3 class="widget-user-username">Inventario en Bodega</h3>
                    <h5 class="widget-user-desc"></h5>
                      <div class="icon">
                      <i class="fa fa-tags"></i>
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <?php
                      	$found=false;
                      $products = ProductData::getAll();
                      foreach($products as $product){
                      	$q=OperationData::getQYesF($product->id);
                      	if($q < $product->inventary_min){
                      		$found=true;
                      break;
                      	}
                      }
                      $netos = ProductData::getAll();
                      $stock=0;
                      $inventario_neto=0.0000000;
                      $k=0.00;
                      $mens2=0;
                      if(count($netos)>0){
                      foreach($netos as $neto){
                        $mens2+=1;
                      $k= OperationData::getQYesF($neto->id);
                      $inventario_neto+= $neto->price_in * $k;
                      if($k<=$neto->inventary_min){
                      	$stock+=1;
                      	}
                      }
                      }else{
                        $mens = "<h5 class='alert-danger'>No hay productos</h5>";
                      }if(count($netos)>0){$mens = number_format(($inventario_neto/100),2,'.',',');}
                      	?>
                        <h5 class="description-header"><?php echo $mens;?> </h5>
                        <span class="description-text">Total</span>
                      </div>
                    </div>
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header"><?php echo $mens2; ?></h5>
                        <span class="description-text">PRODUCTOS</span>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header"><?php echo $stock; ?></h5>
                        <span class="description-text">stock</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<!-- /.widget-user -->
</a>
</div>

          <div class="col-lg-4">
            <a href="#">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow-active">
            <div class="small-box">
                <h3 class="widget-user-username">Compras</h3>
              <h5 class="widget-user-desc"></h5>
              <?php
              $totalcompras=0;
              $valorcompras=0;
              $compras = SellData::getRes();
              $cambio=true;
              $ultimacompra="";
              if(count($compras)>0){
              foreach($compras as $compra):
              $totalcompras+=1;
              $valorcompras+= $compra->total;
              $operations = OperationData::getAllProductsBySellId($compra->id);
              if ($cambio){
                $cambio=false;
                $ultimacompra=  date("d-m-Y", strtotime($compra -> created_at));
              }
              if (!$cambio) {
                if($compra -> created_at > $ultimacompra){
                  $ultimacompra =  date("d-m-Y", strtotime($compra -> created_at));
                }
              }


            endforeach;
        }else{
              $mens3="<h5 class='alert-danger'>No hay</h5>";
          }if(count($compras)>0){ $mens3 = number_format(($valorcompras/100),2,'.',',');}
              ?>
                <div class="icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
            </div>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $mens3; ?></h5>
                    <span class="description-text">Total</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $totalcompras; ?></h5>
                    <span class="description-text">REGISTRADAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $ultimacompra; ?></h5>
                    <span class="description-text">Ultima</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
          </a>
        </div>

        <div class="col-lg-4">
          <a href="#">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green-active">
              <div class="small-box">
                  <h3 class="widget-user-username">Ventas</h3>
                <h5 class="widget-user-desc"></h5>
                <?php
                $totalventas=0;
                $valorventas=0;
                $totalcreditos=0;
                $mens4="";
                $ventas = SellData::getSells();
                if(count($ventas)>0){

                foreach($ventas as $venta):
                  if ( ($venta->accreditlast)==1){
                  $totalcreditos+=1;
                      }
                $totalventas+=1;
                $valorventas += $venta->total - $venta->discount ;

                		endforeach;
                }else{
                	    $mens4 = "<h5 class='alert-danger'>No hay ventas</h5>";
                	}if(count($ventas)>0){ $mens4 = number_format(($valorventas/100),2,'.',',');}
                ?>
                  <div class="icon">
                  <i class="fa fa-money"></i>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $mens4; ?></h5>
                    <span class="description-text">Total</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $totalventas; ?></h5>
                    <span class="description-text">registradas</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $totalcreditos; ?></h5>
                    <span class="description-text">Creditos</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
          </a>
        </div>
