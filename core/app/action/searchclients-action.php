
<?php if(isset($_GET["clients"]) && $_GET["clients"]!=""):  //isset esta palabra es para balidar qu esten asignado valores .. ?>
	<?php
$clientss = PersonData::getLike($_GET["clients"]); //resibimos el codigo o nombre 
if(count($clientss)>0){
	?>
    <div class="box-body">
              <table class="table table-condensed text-center">
                <tbody><tr>
                	<th>Codigo</th>
       				<th>Nombre</th>
					<th>Cedula</th>
                  <th></th>
                </tr>
                	<?php
	 foreach($clientss as $clients):
if($clients->kind==1){
	?>            <tr>
                  <td style="width:80px;"><?php echo $clients->id; ?></td>
		<td><?php echo $clients->name; ?></td>
		<td><?php echo $clients->identity; ?></td>
		<td><form method="post" action="index.php?view=addtocart" >
		<input type="hidden" name="clients_id2" value="<?php echo $clients->id; ?>">
		<div class="input-group"><span class="input-group-btn">
		<button type="button" class="btn btn-success" onClick="elegir(<?php echo $clients->id; ?>)" data-dismiss="modal"><i class="glyphicon glyphicon-plus-sign"></i> Elegir</button>
      </span>
    </div>
	</form></td>
	</tr>
<?php } endforeach;?>
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