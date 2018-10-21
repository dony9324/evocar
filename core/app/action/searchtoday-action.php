<div class="row">
		<div class="col-md-12">
		<?php if(isset($_GET["sd"]) && isset($_GET["ed"]) ):?>
<?php if($_GET["sd"]!=""&&$_GET["ed"]!=""):?>
			<?php 
			$operations = array();

			if($_GET["client_id"]==""){
			$operations = SellData::getAllByDateOp($_GET["sd"],$_GET["ed"],2);
			}
			else{
			$operations = SellData::getAllByDateBCOp($_GET["client_id"],$_GET["sd"],$_GET["ed"],2);
			} 
			 ?>
					<?php
                        $supertotal1 = 0; 	
					   	$supertotal2 = 0;
						$supertotalc = 0; 
						$supertotal2c = 0;

 $operations = SellData::getAllByDateOp($_GET["sd"],$_GET["ed"],2);
 if(count($operations)>0):?>
			 	<?php $supertotal1 = 0; 
						$supertotal2 = 0;
				foreach($operations as $ope):
                $supertotal1+= ($ope->total-$ope->discount);
				$supertotal2+= ($ope->cost);
				endforeach;
				endif;
				?>
<?php $operationsc = SellData::getAllByDateOp2($_GET["sd"],$_GET["ed"],2);
 if(count($operationsc)>0):?>
			 	<?php $supertotalc = 0; 
						$supertotal2c = 0;
				foreach($operationsc as $opec):
                $supertotalc+= ($opec->total-$opec->discount);
				$supertotal2c+= ($opec->cost);
				endforeach;
				endif;
				?>                                

  <table style="width:100%;" class="table table-bordered table-hover info">
	<thead >
		<th >Tipo</th>
        <th>ventas</th>
		<th>Costo</th>
		<th>Ganancia</th>
        <th>% de Ganancia</th>
		
	</thead>
	<tr class="success">
    	<td>Contado</td>
    	<td><b><?php echo number_format($supertotal1,2,'.',',');?></b></td>
		<td><?php echo number_format($supertotal2,2,'.',',');?></td>
		<td><?php echo number_format($supertotal1-$supertotal2,2,'.',',');?></td>
        <th><?php if($supertotal2!=0){ echo number_format(((($supertotal1-$supertotal2)*100/$supertotal2)),2,'.',',')." %";}?></th>
	</tr>
    <tr class="warning">
  		<td>Credito</td>
       	<td><b><?php echo number_format($supertotalc,2,'.',',');?></b></td>
		<td><?php echo number_format($supertotal2c,2,'.',',');?></td>
		<td><?php echo number_format($supertotalc-$supertotal2c,2,'.',',');?></td>
        <th><?php if($supertotal2c!=0){ echo number_format(((($supertotalc-$supertotal2c)*100/$supertotal2c)),2,'.',',')." %";}?></th>
	</tr>
     <tr class="info">
  		<td><b>Total</b></td>
       	<td><b><?php echo number_format($supertotalc+$supertotal1,2,'.',',');?></b></td>
		<td><?php echo number_format($supertotal2c+$supertotal2,2,'.',',');?></td>
		<td><?php echo number_format($supertotalc-$supertotal2c+($supertotal1-$supertotal2),2,'.',',');?></td>
        <th><?php if(($supertotal2c+$supertotal2)!=0){ echo number_format((($supertotalc-$supertotal2c+($supertotal1-$supertotal2))*100/($supertotal2c+$supertotal2)),2,'.',',')." %" ;}?></th>
	</tr>
</table>
<h1>Total de ventas: $ <?php echo number_format($supertotal1,2,'.',','); ?></h1>
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
	</div>
</div>