<!--- ver fraciones -->
<?php if(isset($_GET["o"]) && $_GET["o"]=="resumido"){


 if(isset($_SESSION["presentacionmain"])){
	$i= 0; foreach($_SESSION["presentacionmain"] as $m){
		$main = UnitData::getById($m["unit_id"]);
		if ($m["q"]==0 or $m["q"]=="") {
		$m["q"]=1;
		} echo "<small style='margin: 1px;' class='label  bg-blue'>".$m["q"].$main->name."</small>";

	 }
 }

 if(isset($_SESSION["fraction"])){
	 $i= 0; foreach($_SESSION["fraction"] as $p){
					$fractions = UnitData::getById($p["unit_id"]);
					echo "<small style='margin: 1px;' class='label  bg-yellow'>(".$m["q"].")/".$p["q"]."=". $fractions->name."</small>";
				///echo "(".$m["q"]." ".$main->name." / "; echo $p["q"].") = ";
			 }
}

 if(isset($_SESSION["grupo"])){
			 $i= 0; foreach($_SESSION["grupo"] as $g){
					$grupo = UnitData::getById($g["unit_id"]);
					echo "<small style='margin: 1px;' class='label  bg-green'>".$g["q"]."(".$m["q"].")=".$grupo->name."</small>";
				//	echo "1 ".$grupo->name." = ";
					// echo $g['q']." (".$m['q']." ".$main->name.")";
}}

}else{

?>
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
          } echo $m["q"];   ?></span>
						<span class="text"><?php echo $main->name; ?></span>
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
				<?php $i= 0; foreach($_SESSION["fraction"] as $p){
					$fractions = UnitData::getById($p["unit_id"]); ?>
					<li>
						<span class="text">  <?php echo "(".$m["q"]." ".$main->name." / "; echo $p["q"].") = ";?></span>
						<span class="text"><?php echo"1  ". $fractions->name." = Precio:  ". $p["price_outf"];?></span>

						<div class="tools">
					<!--		<i class="fa fa-edit"></i>
					futura modificacion
							<i class="fa fa-trash-o"></i>
						-->

							<a	class="btn btn-block btn-danger btn-xs" onclick="clearfraction(<?php echo $i; $i++; ?>)"><i class="glyphicon glyphicon-remove"></i> Eliminar</a>
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
				<?php $i= 0; foreach($_SESSION["grupo"] as $g){
					$grupo = UnitData::getById($g["unit_id"]); ?>
					<li>
						<span class="text">  <?php  echo "1 ".$grupo->name." = "; ?></span>
						<span class="text"><?php echo $g['q']." (".$m['q']." ".$main->name.") "."  =  Precio:  ". $g["price_outg"]; ?></span>
						<div class="tools">
							<a	class="btn btn-block btn-danger btn-xs" onclick="cleargrupo(<?php echo $i; $i++; ?>)"><i class="glyphicon glyphicon-remove"></i> Eliminar</a>
						</div>
					</li>
				<?php };	?>
			</ul>
		</div>
	</div>
	<script>
	function cleargrupo(id) {
	console.log("cleargrupo"+id)
	$.get("./?action=addfraction&o=cleargrupo",
	{
	idgrupo:id
	},function(data){
	  if (data.estado == "true") {
	    alertify.success('Se elimino grupo correctamente');
	    }else {
	       alertify.error('No se pudo eliminar grupo');
	      }
				$("#presentaciones").load("./?action=viewpresentation");
				$("#presentacionesresumen").load("./?action=viewpresentation&o=resumido");
	});}

	function clearfraction(id) {
	console.log("clearfraction"+id)
	$.get("./?action=addfraction&o=clearfraction",
	{
	idfraction:id
	},function(data){
		if (data.estado == "true") {
			alertify.success('Se elimino fracción correctamente');
			}else {
				 alertify.error('No se pudo eliminar fracción');
				}
				$("#presentaciones").load("./?action=viewpresentation");
				$("#presentacionesresumen").load("./?action=viewpresentation&o=resumido");
	});}
</script>
<?php }} ?>
