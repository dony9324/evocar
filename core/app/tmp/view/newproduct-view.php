    <?php
$categories = CategoryData::getAll();
    ?>
<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Producto</h1>
	<br>
		<form class="form-horizontal" method="post" enctype="multipart/form-data" id="addproduct" action="index.php?action=addproduct" role="form" >

  <div class="form-group">
    <label  class="col-lg-2 control-label">Imagen</label>
    <div class="col-md-6">
      <input type="file" name="image" id="image" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label  class="col-lg-2 control-label">Codigo de Barras*</label>
    <div class="col-md-6">
      <input type="text" name="barcode" required class="form-control" id="barcode" placeholder="Codigo de Barras del Producto">
    </div>
  </div>
  <div class="form-group">
    <label  class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre del Producto">
    </div>
  </div>
  <div class="form-group">

    <label  class="col-lg-2 control-label">Categoria*</label>

    <div class="col-md-6">

    <select name="category_id" class="form-control">
    <option value="">-- NINGUNA --</option>
    <?php foreach($categories as $category):?>
      <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
    <?php endforeach;?>
      </select>  <a href="index.php?view=newcategory" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Categoria</a>  </div>
  </div>


    <div hidden="hidden" class="col-md-6">
     <input name="description" value="0" required class="form-control"  id="description" placeholder="Descripcion del Producto">
    </div>

  <div class="form-group">
    <label  class="col-lg-2 control-label">Precio de Entrada*</label>
    <div class="col-md-6">
      <input type="number" min="0" step="any" name="price_in" required class="form-control" id="price_in" placeholder="Precio de entrada">
    </div>
  </div>
  <div class="form-group">
    <label  class="col-lg-2 control-label">Precio de Salida*</label>
    <div class="col-md-6">
      <input type="number" min="0" step="any"  name="price_out" required class="form-control" id="price_out" placeholder="Precio de salida">
    </div>
  </div>
  <div class="form-group">
    <label  class="col-lg-2 control-label">Presentacion*</label>
    <div class="col-md-6">
      <input type="text" name="presentation" required class="form-control" id="inputEmail1" placeholder="Presentacion del Producto">
    </div>
  </div>
  <div class="form-group">
    <label  class="col-lg-2 control-label">Ubicación*</label>
    <div class="col-md-6">
      <input type="text" name="unit" required class="form-control" id="unit" placeholder="Ubicación del Producto">
    </div>
  </div>


  <div class="form-group">
    <label  class="col-lg-2 control-label">Minima en inventario:</label>
    <div class="col-md-6">
      <input type="number" min="0" step="any"  name="inventary_min" required  value="5" class="form-control" id="inputEmail1" placeholder="Minima en Inventario (Default 10)" >
    </div>
  </div>

  <div class="form-group" >
    <label  class="col-lg-2 control-label">Inventario inicial:</label>
    <div class="col-md-6" >
      <input type="number" min="0" step="any" name="q" required class="form-control"  id="inputEmail1" placeholder="Inventario inicial" value="0">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-info">Agregar Producto</button>
    </div>
  </div>
</form>

	</div>
</div>

<script>
  $(document).ready(function(){
    $("#barcode").keydown(function(e){
        if(e.which==17 || e.which==74 ){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })
});

</script>
