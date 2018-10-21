<div class="row">
	<div class="col-md-12">
		<h1><i class='glyphicon glyphicon-shopping-cart'></i> Reabastecimientos</h1>
		<div class="clearfix"></div>


<?php
$products = SellData::getRes();

if(count($products)>0){
	?>
<br>
<table style="width:100%;" class="table table-bordered table-hover	">
	<thead>
		<th></th>
		<th>Producto</th>
		<th>Total</th>
		<th>Proveedor</th>
        <th>Fecha</th>
		<th></th>
	</thead>
	<?php foreach($products as $sell):?>

	<tr>
		<td style="width:30px;"><a href="index.php?view=onere&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>

		<td>

<?php
$operations = OperationData::getAllProductsBySellId($sell->id);
echo count($operations);
?>
		<td><?php echo ($sell->total);?></td>
        
		<td><?php 
		if($sell->person_id!=NULL && $sell->person_id!=0 ){
		$proveedor = PersonData::getById2($sell->person_id);
		echo $proveedor[0]->name."  ".	$proveedor[0]->lastname; 
        }?>
        </td>
        
        <td><?php echo $sell->created_at; ?></td>
		<td style="width:30px;"><a href="index.php?action=delre&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td>
	</tr>

<?php endforeach; ?>

</table>


	<?php
}else{
	?>
	<div class="jumbotron">
		<h2>No hay datos</h2>
		<p>No se ha realizado ninguna operacion.</p>
	</div>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>
<script>
$("#nav li").removeClass("active");
$( "#res" ).last().addClass( "active" );
$( "#reportes" ).last().addClass( "menu-open" );
$( "#treeview-menu" ).last().addClass( "menu-o" );
</script>