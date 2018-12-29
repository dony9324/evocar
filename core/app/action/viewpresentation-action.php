<!--- ver fraciones -->
<br>
<div class="box box-primary">
	<div class="box-header ui-sortable-handle">
		<i class="ion ion-clipboard"></i>
		<h3 class="box-title">Media principal</h3>
	</div>
	<div class="box-body">
		<ul class="todo-list ui-sortable">
			<li>
				<?php if(isset($_SESSION["presentacionmain"])){
					$i= 0; foreach($_SESSION["presentacionmain"] as $m){
						$main = UnitData::getById($m["unit_id"]); ?>
						<span class="text"> <?php if ($m["q"]==0 or $m["q"]=="") {
						$m["q"]=1;
						} echo $m["q"]; ?></span>
						<span class="text"><?php echo $main->name; ?></span>
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						</div>
					<?php };	?>
				</li>
			</ul>
		</div>
	</div>
<?php } ?>
<?php if(isset($_SESSION["fraction"])){
	?>
	<div class="box box-warning">
		<div class="box-header ui-sortable-handle">
			<i class="ion ion-clipboard"></i>
			<h3 class="box-title">fraciones</h3>
		</div>
		<div class="box-body">
			<ul class="todo-list ui-sortable">
				<li>
					<span class="text"> partes</span>
					<span class="text">Unidad de medida</span>
					<div class="tools">
						<i class="fa fa-edit"></i>
						<i class="fa fa-trash-o"></i>
						<a	class="label label-danger" onclick="clearcart(<?php echo $i; $i++; ?>)"><i class="glyphicon glyphicon-remove"></i> Eliminar</a>
					</div>
				</li>
				<?php $i= 0; foreach($_SESSION["fraction"] as $p){
					$fractions = UnitData::getById($p["unit_id"]); ?>
					<li>
						<span class="text">  <?php echo "(".$m["q"]." ".$main->name." / "; echo $p["q"].") = "; ?></span>
						<span class="text"><?php echo"1 ". $fractions->name; ?></span>
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
							<a	class="label label-danger" onclick="clearcart(<?php echo $i; $i++; ?>)"><i class="glyphicon glyphicon-remove"></i> Eliminar</a>
						</div>
					</li>
				<?php };	?>
			</ul>
		</div>
	</div>
<?php } ?>

<?php if(isset($_SESSION["grupo"])){
	?>
	<div class="box box-success">
		<div class="box-header ui-sortable-handle">
			<i class="ion ion-clipboard"></i>
			<h3 class="box-title">Grupos</h3>
		</div>
		<div class="box-body">
			<ul class="todo-list ui-sortable">
				<li>
					<span class="text"> partes</span>
					<span class="text">Unidad de medida</span>
					<div class="tools">
						<i class="fa fa-edit"></i>
						<i class="fa fa-trash-o"></i>
						<a	class="label label-danger" onclick="clearcart(<?php echo $i; $i++; ?>)"><i class="glyphicon glyphicon-remove"></i> Eliminar</a>
					</div>
				</li>
				<?php $i= 0; foreach($_SESSION["grupo"] as $g){
					$grupo = UnitData::getById($g["unit_id"]); ?>
					<li>
						<span class="text">  <?php  echo "1 ".$grupo->name." = "; ?></span>
						<span class="text"><?php echo $g['q']." (".$m['q']." ".$main->name.")"; ?></span>
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
							<a	class="label label-danger" onclick="clearcart(<?php echo $i; $i++; ?>)"><i class="glyphicon glyphicon-remove"></i> Eliminar</a>
						</div>
					</li>
				<?php };	?>
			</ul>
		</div>
	</div>
<?php } ?>
