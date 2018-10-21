<section class="content-header">
  <h1>
  <i class="fa fa-home"></i>
    Inicio
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-home"></i> Inicio</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

<!--| aquí se muestran datos de bodga |-->
<div class="col-lg-4">
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
                        }if(count($netos)>0){$mens = number_format($inventario_neto,2,'.',',');}
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
</div>
          <div class="col-lg-4">
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
          }if(count($compras)>0){ $mens3 = number_format($valorcompras,2,'.',',');}
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
        </div>

        <div class="col-lg-4">
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
                	}if(count($ventas)>0){ $mens4 = number_format($valorventas,2,'.',',');}
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
        </div>


<!--menu de la izquierda-->
<script>

$( "#reportes" ).last().removeClass( "menu-open" );
$( "#treeview-menu" ).last().removeClass( "menu-o" );
$("#nav li").removeClass("active"); 
$( "#home" ).last().addClass( "active" );
//grafica
$(document).ready(function(){ today()});
</script>
<?php
/////////datos de la grafica///////////
$primer_dia = time();
$ultimo_dia = time();
while(date("w",$primer_dia)!=1){
$primer_dia -= 3600;
}
while(date("w",$ultimo_dia)!=0){
$ultimo_dia += 3600;
}
$fecha = new DateTime();
$fecha->modify('first day of this month'); //primer dia del mes

///////////////////////////datos de la tabla abajo de la grafica
	$totalventashoy = 0; 
	$costosventashoy = 0;
	$totalventaschoy = 0; 

	$totalventassemana = 0; 
	$costosventassemana = 0;
	$totalventascsemana = 0;
	
	$totalventasmes = 0; 
	$costosventasmes = 0;
	$totalventascmes = 0;
	
	$totalventasaño = 0; 
	$costosventasaño = 0;
	$totalventascaño = 0;

///////////////////////////////datos de hoy////////////////////////////////////////
$sellday = array();
$hora = array();
 for($j=0; $j < 24; $j++)
    {
       $hora[$j] = 0;
	 
    }

  $sellday = SellData::getAllByDateOp(date("Y-m-d"),date("Y-m-d"),2);

  foreach($sellday as $sellday2):
  
    $totalventashoy+= ($sellday2->total-$sellday2->discount);///////////////////////////datos de la tabla abajo de la grafica
	$costosventashoy+= ($sellday2->cost);///////////////////////////datos de la tabla abajo de la grafica
	
  if( $sellday2 -> created_at < date("Y-m-d 01:00:00")) {
 	$hora[0]  += $sellday2->total - $sellday2->discount;
  }else{
	  if( $sellday2 -> created_at < date("Y-m-d 02:00:00")) {
 		$hora[1]  +=  $sellday2->total - $sellday2->discount;
	   }else{
	  	 if( $sellday2 -> created_at < date("Y-m-d 03:00:00")) {
 			$hora[2]  +=  $sellday2->total - $sellday2->discount;
	  	   }else{
	 		 if( $sellday2 -> created_at < date("Y-m-d 04:00:00")) {
 				$hora[3]  +=  $sellday2->total - $sellday2->discount;
	  
	 	      }else{
	 			 if( $sellday2 -> created_at < date("Y-m-d 05:00:00")) {
 					$hora[4]  +=  $sellday2->total - $sellday2->discount;
	  
	 			 }else{
	 				 if( $sellday2 -> created_at < date("Y-m-d 06:00:00")) {
 						$hora[5]  +=  $sellday2->total - $sellday2->discount;
	  
	 				 }else{
	 				 	if( $sellday2 -> created_at < date("Y-m-d 07:00:00")) {
 							$hora[6]  +=  $sellday2->total - $sellday2->discount;
	  
	 					 }else{
	 						 if( $sellday2 -> created_at < date("Y-m-d 08:00:00")) {
 								$hora[7]  +=  $sellday2->total - $sellday2->discount;
	  
	 						 }else{
	 							 if( $sellday2 -> created_at < date("Y-m-d 09:00:00")) {
 									$hora[8]  +=  $sellday2->total - $sellday2->discount;
	  
	 							 }else{
	 								 if( $sellday2 -> created_at < date("Y-m-d 10:00:00")) {
 										$hora[9]  +=  $sellday2->total - $sellday2->discount;
	  
	 								 }else{
	 									 if( $sellday2 -> created_at < date("Y-m-d 11:00:00")) {
 											$hora[10]  +=  $sellday2->total - $sellday2->discount;
	  
	 									 }else{
	 										 if( $sellday2 -> created_at < date("Y-m-d 12:00:00")) {
 												$hora[11]  +=  $sellday2->total - $sellday2->discount;
	  
	 										 }else{
	 											 if( $sellday2 -> created_at < date("Y-m-d 13:00:00")) {
 													$hora[12]  +=  $sellday2->total - $sellday2->discount;
	  
	 											 }else{
	 												 if( $sellday2 -> created_at < date("Y-m-d 14:00:00")) {
 														$hora[13]  +=  $sellday2->total - $sellday2->discount;
	  
	 												 }else{
	 													 if( $sellday2 -> created_at < date("Y-m-d 15:00:00")) {
 															$hora[14]  +=  $sellday2->total - $sellday2->discount;
	  
	 													 }else{
	 														 if( $sellday2 -> created_at < date("Y-m-d 16:00:00")) {
 																$hora[15]  +=  $sellday2->total - $sellday2->discount;
	  
	 													 	}else{
	 														 	if( $sellday2 -> created_at < date("Y-m-d 17:00:00")) {
 																	$hora[16]  +=  $sellday2->total - $sellday2->discount;
	  					 										}else{
	 														 		if( $sellday2 -> created_at < date("Y-m-d 18:00:00")) {
 																		$hora[17]  +=  $sellday2->total - $sellday2->discount;
	  					 											}else{
	 														 			if( $sellday2 -> created_at < date("Y-m-d 19:00:00")) {
 																			$hora[18]  +=  $sellday2->total - $sellday2->discount;
	  					 												}else{
	 														 				if( $sellday2 -> created_at < date("Y-m-d 20:00:00")) {
 																				$hora[19]  +=  $sellday2->total - $sellday2->discount;
	  					 													}else{
	 														 					if( $sellday2 -> created_at < date("Y-m-d 21:00:00")) {
 																					$hora[20]  +=  $sellday2->total - $sellday2->discount;
	  					 														}else{
	 														 						if( $sellday2 -> created_at < date("Y-m-d 22:00:00")) {
 																						$hora[21]  +=  $sellday2->total - $sellday2->discount;
	  					 															}else{
	 														 							if( $sellday2 -> created_at < date("Y-m-d 23:00:00")) {
 																							$hora[22]  +=  $sellday2->total - $sellday2->discount;
	  					 																}else{
	 														 							if( $sellday2 -> created_at < date("Y-m-d 23:59:59")) {
 																							$hora[23]  +=  $sellday2->total - $sellday2->discount;
	  					 																}
   																					 }   																					 }
   																				 }
   																			 }
   																		 }
   																	 }
   																 }
   														 }
   													 }
   												 }
   											 }
   										 }
   									 }
   								  }
   							  }
   						   }
   						}
   					 }
   				 }
    		  }
		   }
       } 
 }
  
  
  endforeach;
  
  
  
  /////////////////////////valores semana////////////////////////////////////////
  
  
  
  $sellweek = array();
$dia = array();
 for($j=0; $j < 7; $j++)
    {
       $dia[$j] = 0;
    }
	
  $sellweek = SellData::getAllByDateOp(date('Y-m-d',$primer_dia),date("Y-m-d"),2);
  foreach($sellweek as $sellweek2):
  if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+1*24*3600)) {
 	$dia[0]  +=  $sellweek2->total - $sellweek2->discount;
  }else{
	  if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+2*24*3600)) {
 		$dia[1]  +=  $sellweek2->total - $sellweek2->discount;
	   }else{
	  	 if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+3*24*3600)) {
 			$dia[2]  +=  $sellweek2->total - $sellweek2->discount;
	  	   }else{
	 		 if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+4*24*3600)) {
 				$dia[3]  +=  $sellweek2->total - $sellweek2->discount;
	  
	 	      }else{
	 			 if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+5*24*3600)) {
 					$dia[4]  +=  $sellweek2->total - $sellweek2->discount;
	  
	 			 }else{
	 				 if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+6*24*3600)) {
 						$dia[5]  +=  $sellweek2->total - $sellweek2->discount;
	  
	 				 }else{
	 				 	if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+7*24*3600)) {
 							$dia[6]  +=  $sellweek2->total - $sellweek2->discount;
	  
	 					 }
   					 }
   				 }
    		  }
		   }
       } 
 }
endforeach;
/////////////////////////////////este mes///////////////////////////////////////////// 
 $sellmonth = array();
$dia2 = array();
 for($j=0; $j < 31; $j++)
    {
       $dia2[$j] = 0;
    }
//$mon = _data_first_month_day() ; 
//	echo "<br> estassaaa: ". $fecha->format('Y-m-d') . "<br>";
//	$mon=$fecha;
//$mon ->modify('+1 day');
//echo date('Y-m-d',$mon);
//echo "<br> ya: ". date('Y-m-d',$mon+1*24*3600) . "<br>";

$mon= strtotime($fecha->format('Y-m-d'));///linea importante
  $sellmonth = SellData::getAllByDateOp(date($fecha->format('Y-m-d')),date("Y-m-d"),2);

  foreach($sellmonth as $sellmonth2):
  if( $sellmonth2 -> created_at < date('Y-m-d',$mon+1*24*3600)) {
 	$dia2[0]  +=  $sellmonth2->total - $sellmonth2->discount;
  }else{
	  if( $sellmonth2 -> created_at < date('Y-m-d',$mon+2*24*3600)) {
 		$dia2[1]  +=  $sellmonth2->total - $sellmonth2->discount;
	   }else{
	  	 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+3*24*3600)){
 			$dia2[2]  +=  $sellmonth2->total - $sellmonth2->discount;
	  	   }else{
	 		 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+4*24*3600)) {
 				$dia2[3]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 	      }else{
	 			 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+5*24*3600)){
 					$dia2[4]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 			 }else{
	 				 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+6*24*3600)) {
 						$dia2[5]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 				 }else{
	 				 	if( $sellmonth2 -> created_at < date('Y-m-d',$mon+7*24*3600)) {
 							$dia2[6]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 					 }else{
	 						 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+8*24*3600)){
 								$dia2[7]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 						 }else{
	 							 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+9*24*3600)){
 									$dia2[8]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 							 }else{
	 								 if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+10*24*3600)){
 										$dia2[9]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 								 }else{
	 									 if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+11*24*3600)){
 											$dia2[10]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 									 }else{
	 										 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+12*24*3600)) {
 												$dia2[11]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 										 }else{
	 											 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+13*24*3600)) {
 													$dia2[12]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 											 }else{
	 												 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+14*24*3600)) {
 														$dia2[13]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 												 }else{
	 													 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+15*24*3600)){
 															$dia2[14]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 													 }else{
	 														 if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+16*24*3600)){
 																$dia2[15]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 													 	}else{
	 														 	if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+17*24*3600)){
 																	$dia2[16]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 										}else{
	 														 		if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+18*24*3600)){
 																		$dia2[17]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 											}else{
	 														 			if( $sellmonth2 -> created_at < date('Y-m-d',$mon+19*24*3600)){
 																			$dia2[18]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 												}else{
	 														 				if( $sellmonth2 -> created_at < date('Y-m-d',$mon+20*24*3600)) {
 																				$dia2[19]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 													}else{
	 														 					if( $sellmonth2 -> created_at < date('Y-m-d',$mon+21*24*3600)){
 																					$dia2[20]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 														}else{
	 														 						if( $sellmonth2 -> created_at < date('Y-m-d',$mon+22*24*3600)) {
 																						$dia2[21]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 															}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+23*24*3600)){
 																							$dia2[22]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+24*24*3600)){
 																							$dia2[23]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+25*24*3600)){
 																							$dia2[24]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+26*24*3600)){
 																							$dia2[25]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+27*24*3600)){
 																							$dia2[26]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+28*24*3600)){
 																							$dia2[27]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+29*24*3600)){
 																							$dia2[28]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+30*24*3600)){
 																							$dia2[29]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+31*24*3600)){
 																							$dia2[30]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}
   																					 }

   																					 }

   																					 }

   																					 }

   																					 }

   																					 }

   																					 }

   																					 }

   																					 }
   																				 }
   																			 }
   																		 }
   																	 }
   																 }
   														 }
   													 }
   												 }
   											 }
   										 }
   									 }
   								  }
   							  }
   						   }
   						}
   					 }
   				 }
    		  }
		   }
       } 
 }
  
  
  endforeach;
  
  
 
 ////////////////////////////////////////este año///////////////////////////////////////////////
 
 $sellyear = array();
$mes = array();
 for($j=0; $j < 12; $j++)
    {
       $mes[$j] = 0;
    }
//echo date("Y-01-01")."este añor";
//echo date("Y-01-01", strtotime("+1 year"));  
  $sellyear = SellData::getAllByDateOp(date("Y-01-01"),date("Y-m-d 23:59:59"),2);
 // echo date("Y-m-d"); 
  foreach($sellyear as $sellyear2):
  if( $sellyear2 -> created_at < date("Y-02-01")) {
 	$mes[0]  +=  $sellyear2->total - $sellyear2->discount;
  }else{
	  if( $sellyear2 -> created_at < date("Y-03-01")) {
 		$mes[1]  +=  $sellyear2->total - $sellyear2->discount;
	   }else{
	  	 if( $sellyear2 -> created_at < date("Y-04-01")) {
 			$mes[2]  +=  $sellyear2->total - $sellyear2->discount;
	  	   }else{
	 		 if( $sellyear2 -> created_at < date("Y-05-01")) {
 				$mes[3]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 	      }else{
	 			 if( $sellyear2 -> created_at < date("Y-06-01")) {
 					$mes[4]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 			 }else{
	 				 if( $sellyear2 -> created_at < date("Y-07-01")) {
 						$mes[5]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 				 }else{
	 				 	if( $sellyear2 -> created_at < date("Y-08-01")) {
 							$mes[6]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 					 }else{
	 						 if( $sellyear2 -> created_at < date("Y-09-01")) {
 								$mes[7]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 						 }else{
	 							 if( $sellyear2 -> created_at < date("Y-10-01")) {
 									$mes[8]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 							 }else{
	 								 if( $sellyear2 -> created_at < date("Y-11-01")) {
 										$mes[9]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 								 }else{
	 									 if( $sellyear2 -> created_at < date("Y-12-01")) {
 											$mes[10]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 									 }else{
	 										 if( $sellyear2 -> created_at < date("Y-01-01", strtotime("+1 year"))) {
 												$mes[11]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 									 }
   									 }
   								  }
   							  }
   						   }
   						}
   					 }
   				 }
    		  }
		   }
       } 
    }
  endforeach;
///////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////datos de credito///////////////////////////////////////
////////////////////////////////////////datos de hoy///////////////////////////////////////////
$sellday = array();
$horac = array();
 for($j=0; $j < 24; $j++)
    {
       $horac[$j] = 0;
	     }
  $sellday = SellData::getAllByDateOp2(date("Y-m-d 00:00:00"),date("Y-m-d 23:59:59"),2);
  foreach($sellday as $sellday2):
                  $totalventaschoy+= ($sellday2->total-$sellday2->discount);
				$costosventashoy+= ($sellday2->cost);
  if( $sellday2 -> created_at < date("Y-m-d 01:00:00")) {
 	$horac[0]  +=  90+ $sellday2->total - $sellday2->discount;
  }else{
	  if( $sellday2 -> created_at < date("Y-m-d 02:00:00")) {
 		$horac[1]  +=  $sellday2->total - $sellday2->discount;
	   }else{
	  	 if( $sellday2 -> created_at < date("Y-m-d 03:00:00")) {
 			$horac[2]  +=  $sellday2->total - $sellday2->discount;
	  	   }else{
	 		 if( $sellday2 -> created_at < date("Y-m-d 04:00:00")) {
 				$horac[3]  +=  $sellday2->total - $sellday2->discount;
	  
	 	      }else{
	 			 if( $sellday2 -> created_at < date("Y-m-d 05:00:00")) {
 					$horac[4]  +=  $sellday2->total - $sellday2->discount;
	  
	 			 }else{
	 				 if( $sellday2 -> created_at < date("Y-m-d 06:00:00")) {
 						$horac[5]  +=  $sellday2->total - $sellday2->discount;
	  
	 				 }else{
	 				 	if( $sellday2 -> created_at < date("Y-m-d 07:00:00")) {
 							$horac[6]  +=  $sellday2->total - $sellday2->discount;
	  
	 					 }else{
	 						 if( $sellday2 -> created_at < date("Y-m-d 08:00:00")) {
 								$horac[7]  +=  $sellday2->total - $sellday2->discount;
	  
	 						 }else{
	 							 if( $sellday2 -> created_at < date("Y-m-d 09:00:00")) {
 									$horac[8]  +=  $sellday2->total - $sellday2->discount;
	  
	 							 }else{
	 								 if( $sellday2 -> created_at < date("Y-m-d 10:00:00")) {
 										$horac[9]  +=  $sellday2->total - $sellday2->discount;
	  
	 								 }else{
	 									 if( $sellday2 -> created_at < date("Y-m-d 11:00:00")) {
 											$horac[10]  +=  $sellday2->total - $sellday2->discount;
	  
	 									 }else{
	 										 if( $sellday2 -> created_at < date("Y-m-d 12:00:00")) {
 												$horac[11]  +=  $sellday2->total - $sellday2->discount;
	  
	 										 }else{
	 											 if( $sellday2 -> created_at < date("Y-m-d 13:00:00")) {
 													$horac[12]  +=  $sellday2->total - $sellday2->discount;
	  
	 											 }else{
	 												 if( $sellday2 -> created_at < date("Y-m-d 14:00:00")) {
 														$horac[13]  +=  $sellday2->total - $sellday2->discount;
	  
	 												 }else{
	 													 if( $sellday2 -> created_at < date("Y-m-d 15:00:00")) {
 															$horac[14]  +=  $sellday2->total - $sellday2->discount;
	  
	 													 }else{
	 														 if( $sellday2 -> created_at < date("Y-m-d 16:00:00")) {
 																$horac[15]  +=  $sellday2->total - $sellday2->discount;
	  
	 													 	}else{
	 														 	if( $sellday2 -> created_at < date("Y-m-d 17:00:00")) {
 																	$horac[16]  +=  $sellday2->total - $sellday2->discount;
	  					 										}else{
	 														 		if( $sellday2 -> created_at < date("Y-m-d 18:00:00")) {
 																		$horac[17]  +=  $sellday2->total - $sellday2->discount;
	  					 											}else{
	 														 			if( $sellday2 -> created_at < date("Y-m-d 19:00:00")) {
 																			$horac[18]  +=  $sellday2->total - $sellday2->discount;
	  					 												}else{
	 														 				if( $sellday2 -> created_at < date("Y-m-d 20:00:00")) {
 																				$horac[19]  +=  $sellday2->total - $sellday2->discount;
	  					 													}else{
	 														 					if( $sellday2 -> created_at < date("Y-m-d 21:00:00")) {
 																					$horac[20]  +=  $sellday2->total - $sellday2->discount;
	  					 														}else{
	 														 						if( $sellday2 -> created_at < date("Y-m-d 22:00:00")) {
 																						$horac[21]  +=  $sellday2->total - $sellday2->discount;
	  					 															}else{
	 														 							if( $sellday2 -> created_at < date("Y-m-d 23:00:00")) {
 																							$horac[22]  +=  $sellday2->total - $sellday2->discount;
	  					 																}else{
	 														 							if( $sellday2 -> created_at < date("Y-m-d 23:59:59")) {
 																							$horac[23]  +=  $sellday2->total - $sellday2->discount;
	  					 																}
   																					 }
   																					 }
   																				 }
   																			 }
   																		 }
   																	 }
   																 }
   														 }
   													 }
   												 }
   											 }
   										 }
   									 }
   								  }
   							  }
   						   }
   						}
   					 }
   				 }
    		  }
		   }
       } 
 }
 endforeach;
 /////////////////////////valores semana////////////////////////////////////////
 $sellweek = array();
$diac = array();
 for($j=0; $j < 7; $j++)
    {
       $diac[$j] = 0;
    }
	
  $sellweek = SellData::getAllByDateOp2(date('Y-m-d',$primer_dia),date("Y-m-d"),2);
 
  foreach($sellweek as $sellweek2):
  if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+1*24*3600)) {
 	$diac[0]  +=  $sellweek2->total - $sellweek2->discount;
  }else{
	  if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+2*24*3600)) {
 		$diac[1]  +=  $sellweek2->total - $sellweek2->discount;
	   }else{
	  	 if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+3*24*3600)) {
 			$diac[2]  +=  $sellweek2->total - $sellweek2->discount;
	  	   }else{
	 		 if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+4*24*3600)) {
 				$diac[3]  +=  $sellweek2->total - $sellweek2->discount;
	  
	 	      }else{
	 			 if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+5*24*3600)) {
 					$diac[4]  +=  $sellweek2->total - $sellweek2->discount;
	  
	 			 }else{
	 				 if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+6*24*3600)) {
 						$diac[5]  +=  $sellweek2->total - $sellweek2->discount;
	  
	 				 }else{
	 				 	if( $sellweek2 -> created_at < date('Y-m-d',$primer_dia+7*24*3600)) {
 							$diac[6]  +=  $sellweek2->total - $sellweek2->discount;
	  
	 					 }
   					 }
   				 }
    		  }
		   }
       } 
 }
  
  
  endforeach;
  
/////////////////////////////////este mes///////////////////////////////////////////// 
 $sellmonth = array();
$dia2c = array();
 for($j=0; $j < 31; $j++)
    {
       $dia2c[$j] = 0;
    }
	
	
//$mon = _data_first_month_day() ; 
//	echo "<br> estassaaa: ". $fecha->format('Y-m-d') . "<br>";
//	$mon=$fecha;
	//$mon ->modify('+1 day');

//echo date('Y-m-d',$mon);
//echo "<br> ya: ". date('Y-m-d',$mon+1*24*3600) . "<br>";

$mon= strtotime($fecha->format('Y-m-d')); //linea importante
  $sellmonth = SellData::getAllByDateOp2(date($fecha->format('Y-m-d')),date("Y-m-d"),2);

  foreach($sellmonth as $sellmonth2):

  if( $sellmonth2 -> created_at < date('Y-m-d',$mon+1*24*3600)) {
 	$dia2c[0]  +=  $sellmonth2->total - $sellmonth2->discount;
  }else{
	  if( $sellmonth2 -> created_at < date('Y-m-d',$mon+2*24*3600)) {
 		$dia2c[1]  +=  $sellmonth2->total - $sellmonth2->discount;
	   }else{
	  	 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+3*24*3600)){
 			$dia2c[2]  +=  $sellmonth2->total - $sellmonth2->discount;
	  	   }else{
	 		 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+4*24*3600)) {
 				$dia2c[3]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 	      }else{
	 			 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+5*24*3600)){
 					$dia2c[4]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 			 }else{
	 				 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+6*24*3600)) {
 						$dia2c[5]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 				 }else{
	 				 	if( $sellmonth2 -> created_at < date('Y-m-d',$mon+7*24*3600)) {
 							$dia2c[6]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 					 }else{
	 						 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+8*24*3600)){
 								$dia2c[7]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 						 }else{
	 							 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+9*24*3600)){
 									$dia2c[8]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 							 }else{
	 								 if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+10*24*3600)){
 										$dia2c[9]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 								 }else{
	 									 if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+11*24*3600)){
 											$dia2c[10]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 									 }else{
	 										 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+12*24*3600)) {
 												$dia2c[11]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 										 }else{
	 											 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+13*24*3600)) {
 													$dia2c[12]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 											 }else{
	 												 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+14*24*3600)) {
 														$dia2c[13]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 												 }else{
	 													 if( $sellmonth2 -> created_at < date('Y-m-d',$mon+15*24*3600)){
 															$dia2c[14]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 													 }else{
	 														 if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+16*24*3600)){
 																$dia2c[15]  +=  $sellmonth2->total - $sellmonth2->discount;
	  
	 													 	}else{
	 														 	if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+17*24*3600)){
 																	$dia2c[16]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 										}else{
	 														 		if( $sellmonth2 -> created_at <  date('Y-m-d',$mon+18*24*3600)){
 																		$dia2c[17]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 											}else{
	 														 			if( $sellmonth2 -> created_at < date('Y-m-d',$mon+19*24*3600)){
 																			$dia2c[18]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 												}else{
	 														 				if( $sellmonth2 -> created_at < date('Y-m-d',$mon+20*24*3600)) {
 																				$dia2c[19]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 													}else{
	 														 					if( $sellmonth2 -> created_at < date('Y-m-d',$mon+21*24*3600)){
 																					$dia2c[20]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 														}else{
	 														 						if( $sellmonth2 -> created_at < date('Y-m-d',$mon+22*24*3600)) {
 																						$dia2c[21]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 															}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+23*24*3600)){
 																							$dia2c[22]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+24*24*3600)){
 																							$dia2c[23]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+25*24*3600)){
 																							$dia2c[24]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+26*24*3600)){
 																							$dia2c[25]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+27*24*3600)){
 																							$dia2c[26]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+28*24*3600)){
 																							$dia2c[27]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+29*24*3600)){
 																							$dia2c[28]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+30*24*3600)){
 																							$dia2c[29]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}else{
	 														 							if( $sellmonth2 -> created_at < date('Y-m-d',$mon+31*24*3600)){

 																							$dia2c[30]  +=  $sellmonth2->total - $sellmonth2->discount;
	  					 																}
   																					 }

   																					 }

   																					 }

   																					 }

   																					 }

   																					 }

   																					 }

   																					 }

   																					 }
   																				 }
   																			 }
   																		 }
   																	 }
   																 }
   														 }
   													 }
   												 }
   											 }
   										 }
   									 }
   								  }
   							  }
   						   }
   						}
   					 }
   				 }
    		  }
		   }
       } 
 }
  
  
  endforeach;
  
  
 
 ////////////////////////////////////////este año///////////////////////////////////////////////
 
 $sellyear = array();
$mesc = array();
 for($j=0; $j < 12; $j++)
    {
       $mesc[$j] = 0;
    }

  $sellyear = SellData::getAllByDateOp2(date("Y-01-01"),date("Y-m-d 23:59:59"),2);
  foreach($sellyear as $sellyear2):
  if( $sellyear2 -> created_at < date("Y-02-01")) {
 	$mesc[0]  +=  $sellyear2->total - $sellyear2->discount;
  }else{
	  if( $sellyear2 -> created_at < date("Y-03-01")) {
 		$mesc[1]  +=  $sellyear2->total - $sellyear2->discount;
	   }else{
	  	 if( $sellyear2 -> created_at < date("Y-04-01")) {
 			$mesc[2]  +=  $sellyear2->total - $sellyear2->discount;
	  	   }else{
	 		 if( $sellyear2 -> created_at < date("Y-05-01")) {
 				$mesc[3]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 	      }else{
	 			 if( $sellyear2 -> created_at < date("Y-06-01")) {
 					$mesc[4]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 			 }else{
	 				 if( $sellyear2 -> created_at < date("Y-07-01")) {
 						$mesc[5]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 				 }else{
	 				 	if( $sellyear2 -> created_at < date("Y-08-01")) {
 							$mesc[6]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 					 }else{
	 						 if( $sellyear2 -> created_at < date("Y-09-01")) {
 								$mesc[7]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 						 }else{
	 							 if( $sellyear2 -> created_at < date("Y-10-01")) {
 									$mesc[8]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 							 }else{
	 								 if( $sellyear2 -> created_at < date("Y-11-01")) {
 										$mesc[9]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 								 }else{
	 									 if( $sellyear2 -> created_at < date("Y-12-01")) {
 											$mesc[10]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 									 }else{
	 										 if( $sellyear2 -> created_at < date("Y-01-01", strtotime("+1 year"))) {
 												$mesc[11]  +=  $sellyear2->total - $sellyear2->discount;
	  
	 									 }
   									 }
   								  }
   							  }
   						   }
   						}
   					 }
   				 }
    		  }
		   }
       } 
    }
  
  
  endforeach;
   ///////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
?>



<!-- grafia-->

<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
 <div class="col-sm-2">
              <h3 class="box-title">Ultimas ventas</h3>
</div>
<div class="row">
 <div class="col-sm-8">
 <div class="col-sm-3">
            <button style=" min-width:100px; " type="button" class="btn btn-block btn-default btn-flat" onClick="today()">Hoy</button>
 </div>
 <div class="col-sm-3">
               <button style=" min-width:100px; " type="button" class="btn btn-block btn-default btn-flat" onClick="this_week()">Esta semana</button>
 </div>
 <div class="col-sm-3">
              <button style=" min-width:100px; "type="button" class="btn btn-block btn-default btn-flat" onClick="this_month()">Este mes</button>
 </div>
 <div class="col-sm-3">
              <button style=" min-width:100px; " type="button" class="btn btn-block btn-default btn-flat" onClick="this_year()">Este año</button>
 </div>

</div>
</div>
</div>
<!-- /.box-header -->
            <div class="box-body" style="">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>
                <div class="chart">
					<canvas id="barChart" style="height:230px"></canvas>
				</div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Resumen de ventas</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Ventas</span> 
                    <span class="progress-number"><b></b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Costos</span>
                    <span class="progress-number"><b>310</b>/400</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Utilidad</span>
                    <span class="progress-number"><b>480</b>/800</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 20%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">acreditado</span>
                    <span class="progress-number"><b>250</b>/500</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
           </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
</section>



<script>
dias=[0,31,29,31,30,31,30,31,31,30,31,30,31]; 
function saber(mes,anio){ 
ultimo=0; 
if (mes==2){ 
fecha=new Date(anio,1,29) 
vermes=fecha.getMonth(); 
if((vermes+1)!=mes){ultimo=28} 
} 
if(ultimo==0){ultimo=dias[mes]} 
return ultimo; 
}  


  function today() {
	/*  Aquí crearemos algunos gráficos usando ChartJS   */
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
 	var barChartData = {
      labels  : ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php echo json_encode($horac);?>
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(00,166,90,1)',
          strokeColor         : 'rgba(00,166,90,1)',
          pointColor          : '#00a65a',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?php echo json_encode($hora);?>
        }
      ]
    }
   
 //   barChartData.datasets[1].strokeColor = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }
    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  }
  
  function this_week() {
	/*  Aquí crearemos algunos gráficos usando ChartJS   */
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
 	var barChartData = {
      labels  : ["lunes", "martes", "miércoles", "jueves", "viernes", "sábado", "domingo"],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php echo json_encode($diac);?>
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(00,166,90,1)',
          strokeColor         : 'rgba(00,166,90,1)',
          pointColor          : '#00a65a',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?php echo json_encode($dia);?>
        }
      ]
    }
   
 //   barChartData.datasets[1].strokeColor = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }
    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  }
  
   function this_month() {
	 
	   switch (saber(new Date().getMonth()+1,new Date().getFullYear()) ) {
    case 28:
        daylabels = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23","24", "25", "26", "27", "28"];
        break;
    case 29:
        daylabels = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23","24", "25", "26", "27", "28", "29"];
        break;
    case 30:
        daylabels = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23","24", "25", "26", "27", "28", "29", "30"];
        break;
    case 31:
        daylabels = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23","24", "25", "26", "27", "28", "29", "30", "31"];
}

	   
	/*  Aquí crearemos algunos gráficos usando ChartJS   */
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
 	var barChartData = {
      labels  : daylabels,
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php echo json_encode($dia2c);?>
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(00,166,90,1)',
          strokeColor         : 'rgba(00,166,90,1)',
          pointColor          : '#00a65a',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?php echo json_encode($dia2);?>
        }
      ]
    }
   
 //   barChartData.datasets[1].strokeColor = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }
    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  }
  
   function this_year() {
	   
	/*  Aquí crearemos algunos gráficos usando ChartJS   */
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
 	var barChartData = {
      labels  : ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php echo json_encode($mesc);?>
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(00,166,90,1)',
          strokeColor         : 'rgba(00,166,90,1)',
          pointColor          : '#00a65a',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?php echo json_encode($mes);?>
        }
      ]
    }
   
 //   barChartData.datasets[1].strokeColor = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }
    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  }
</script>
