
<?php if(isset($_GET["clients"]) && $_GET["clients"]!=""):  //isset esta palabra es para balidar qu esten asignado valores .. ?>
	<?php
$clientss = PersonData::getLike($_GET["clients"]); //resibimos el codigo o nombre 
if(count($clientss)>0){
	?>
<h3>Resultados de la Busqueda</h3>
<table style="width:100%;"class="table table-bordered table-hover">
	<thead>
		<th>Codigo</th>
       	<th>Nombre</th>
		<th>Cedula</th>
		<th></th>
	</thead>
	<?php

	 foreach($clientss as $clients):
if($clients->kind==1):
	?>
	
	<tr>
    	<td style="width:80px;"><?php echo $clients->id; ?></td>
		<td><?php echo $clients->name; ?></td>
		<td><?php echo $clients->identity; ?></td>
		<td><form id ="ccc" >
		<input type="hidden" name="cc" value="<?php echo $clients->id; ?>">
		<div class="input-group"><span class="input-group-btn">
		<button type="button" class="btn btn-info" onClick="elegir2(<?php echo $clients->id; ?>)" ><i class="glyphicon glyphicon-plus-sign"></i> Elegir</button>
      </span>
    </div>

	</form></td>
	</tr>
    
<?php
endif;
 endforeach;?>
</table>
	<?php
}else{
	echo "<br><p class='alert alert-danger'>No se encontro el Cliente</p>";
}
?>
<hr><br>
<?php else:
?>
<?php endif; ?>