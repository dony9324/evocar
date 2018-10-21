<?php $user = IvaData::getById($_GET["idc"]);?>
<div class=" ">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Categoria de I.V.A. # <?php echo $_GET["idc"]; ?></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">
      <div id="contentnamec" class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nombre*</label>
        <input type="hidden" value="<?php echo $user->id;?>"  id="idca"  >
        <div class="col-sm-10">
          <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="namec" placeholder="Nombre" autofocus autocomplete="off">
          <span class="help-block"></span>
        </div>
      </div>
      <div  id="contentporcentajec" class="form-group">
        <label class="col-sm-2 control-label">Porcentaje* </label>

        <div class="col-sm-10">
          <input type="number" name="descripcion " value="<?php echo $user->porcentage;?>" class="form-control" id="descripcionc" placeholder="Descripción " autocomplete="off">
          <span id="spanporcentaje"></span>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

      <a  class="btn btn-default" onclick="categorias()">Cancel</a>
      <a  class=" btn btn-info pull-right" onclick="updatecategoryiva()">Actualizar Categoria</a>
    </div>
    <!-- /.box-footer -->
  </form>
</div>
