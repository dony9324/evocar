<section class="content">
<div class="row">
<div class="box box-info">
<div class="box-header with-border">
              <h3 class="box-title">Nuevo Cliente</h3>
            </div>

	<div class="col-md-12">

		<form class="form-horizontal" method="post" enctype="multipart/form-data"  id="addproduct" action="index.php?action=addclient" role="form" >
<div class="box-body">
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Imagen</label>
    <div class="col-md-6">
      <input type="file" name="image" id="image" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1"  class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" required name="name" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" required  name="lastname"  class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Cedula*</label>
    <div class="col-md-6">
      <input type="text" required name="identity" class="form-control" id="identity" placeholder="Cedula">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" required name="address1" class="form-control"  id="address1" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
    <div class="col-md-6">
      <input type="text" name="email1" class="form-control" id="email1" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-6">
      <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Telefono">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono 2</label>
    <div class="col-md-6">
      <input type="text" name="phone2" class="form-control" id="phone2" placeholder="Telefono 2">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Empresa</label>
    <div class="col-md-6">
      <input type="text" name="company" class="form-control" id="company" placeholder="Empresa">
    </div>
  </div>

<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nit</label>
    <div class="col-md-6">
      <input type="text" name="nit" class="form-control" id="nit" placeholder="Nit">
    </div>
  </div>

  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-info">Guardar Cliente</button>
    </div>
  </div>
</form>
</div>
	</div>
</div>
</div>
</section>
