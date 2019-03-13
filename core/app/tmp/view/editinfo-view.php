<?php $user = CompanyData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Informacion</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=updateinfo" role="form" >


  <div class="form-group">
    <label  class="col-lg-2 control-label">Valor*</label>
    <div class="col-md-6">
      <input type="text" name="value" value="<?php echo $user->value;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-info">Actualizar</button>
    </div>
  </div>
</form>
	</div>
</div>