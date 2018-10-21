<?php
$users = IvaData::getAll();
if(count($users)>0){
	?>
	<table class="table table-striped table-bordered">
		<div class="box-header with-border">
              <h3 class="box-title">Tipos de I.V.A.</h3>
            </div>
		<tbody><tr>
			<th style="width: 10px">#</th>
			<th>Nombre</th>
			<th>Porcentaje</th>
			<th>Acciones</th>
		</tr>
		<?php
		foreach($users as $user){
			?>
			<tr>
				<td><?php echo $user->id; ?></td>
				<td><?php echo $user->name; ?></td>
				<td><?php echo $user->porcentage; ?>%</td>
				<td><a href="#" onclick="editcategoryiva(<?php echo $user->id;?>)"class="btn btn-warning btn-xs">Editar</a> <a href="#" class="btn btn-danger btn-xs" onclick="delcategoryiva(<?php echo $user->id;?>)">Eliminar</a></td>
			</tr>

			<?php
		}?>
	</tbody></table>
<?php }else{
	echo "<p class='alert alert-danger'>No hay Categorias</p>";
}
?>
