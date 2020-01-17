<section class="content-header">
  <h1><i class='fa  fa-cube'></i>Caja<small></small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> inicio</a></li>
    <li class="active">Caja</li>
  </ol>
</section>
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">


          <div class="box-tools pull-right">

            <a href="./index.php?action=processbox" class="btn btn-default">Procesar Ventas <i class="fa fa-arrow-right"></i></a>

          </div>
      </br>
      <!-- /.progress-group -->

      <!-- /.progress-group -->

    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">

        <p class="text-center">
          <strong></strong>
        </p>
          <div class="box-body">
            <div class="input-group">
                      <input id="codigo" type="text" name="codigo" class="form-control" placeholder="codigo">
                      <span class="input-group-btn">
                      </span>
                      <a href="#" id="imprimirc"onclick="printoutcot()" class="btn btn-default"><i class="fa fa-clock-o"></i>imprimir</a>
            </div>
            <script>
    				//esta funcion carga el formulario para guardar un nuevo Cliente
    				function printoutcot(){
    					//estalinea es por un error de doble ventana he impide que se abra dosveces el modal

    					console.log("printoutcot");
    					$.get("./?imprimir=printcodigo",

      				{
      					q:$("#codigo").val()

      				},function(data){
      					if (data.estado == "true") {
      						alertify.success('Se actualizo cantidad correctamente');
      					}else {
      						alertify.error('No se pudo actualizar cantidad');
      					}

      				});
    				}
    				</script>

          </div>
          </div>
        </div>
      <div class="box-footer">
      <div class="row">
      </div>
        <!-- /.row -->
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->      <!-- /.row -->

<script>
$("#nav li").removeClass("active");
$( "#imprimircodigos" ).last().addClass( "active" );
</script>
