<div class="nav-tabs-custom">
  <ul class="nav nav-tabs pull-right">
    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Instrucciones</a></li>
    <li class="pull-left header active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-th"></i>Presentaciones</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1">
      <div class="botones">
        <a href="#" class="btn btn-default" onclick="newuni()"><i class="fa  fa-plus"></i> Nueva Unidad de medida</a>
        <a href="#" class="btn btn-default" onclick="newfra()"><i class="fa  fa-plus"></i> Nueva Fraccion</a>
        <a href="#" class="btn btn-default" onclick="newgru()"><i class="fa  fa-plus"></i> Nuevo Grupo</a>
      </div>
      <div class="uniform" hidden>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-4">
              <input id="namuni" type="text" class="form-control" placeholder="Nombre">
              <span id="spannamuni"></span>
            </div>
            <div class="col-xs-5">
              <input id="desuni" type="text" class="form-control" placeholder="Descripcion">
            </div>
            <div class="col-xs-3">
              <input id="abruni"type="text" class="form-control" placeholder="Abreviatura">
              <span id="spanabruni"></span>
            </div>
          </div>
        </div>
        <div class="box-body">
          <button class="btn btn-danger" onclick="canuni()">Cancel</button>
          <button class="btn btn-success pull-right" onclick="savuni()">Guardar</button>
        </div>
      </div>
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_2">
      <div class="panel box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
              Agrupar
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
          <div class="box-body">
            <p>Debes ingresar la cantidad a agrupar y nombrar una unidad de medida. Ejemplo: tenemos un producto que se vende por caja de 12 y por unidades. Entonces la cantidad a agrupar seria “12” y la unidad seria “docenas”. Otro ejemplo: si vendo galletas en paquetes de 10, pero al mismo tiempo vendo en unidades, entonces la cantidad a agrupar seria “10” y la unidad seria “paquetes”</p>
          </div>
        </div>
      </div>

      <div class="panel box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">
              Fraccionar
            </a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
          <div class="box-body">
            <p>Debes ingresar las Fracciones que contendrá tu producto, no necesariamente con la base 10,
              ya que hay fracciones de pares, docena, cientos, kilos y cualquier otra medida que pueda existir como 1/8 de galón
              o 1/4 de galón y otras medidas. Luego nombrar una unidad de medida, generalmente seria la misma de la medida principal. Ejemplo:
              tenemos un tubo de PVC que mide 6 metros entero, pero también se vende por metros; (un metro, dos metros etcétera). Entonces las fracciones seria 6
              y la unidad seria “metros”.
              Otro ejemplo
              Bolsa de cemento de 40 kilogramos, si solo se vende en unidades no es necesario fraccionarla.
              Si se vende media bolsa las fracciones serian 2 y la unidad seria bolsa.
              Si se vende por kilogramos las fracciones serian 40 y la unidad seria “kilogramos”
              Y si vende medio kilo hay dos posibilidades vender 0.5 de un kilo o fraccionar a 80. (Vender 0.5 solo se recomienda en medidas en base 10)
              Otro ejemplo: si vendo galletas en paquetes de 10, pero al mismo tiempo vendo en unidades, entonces la cantidad de Fracciones seria “10” y la unidad seria “unidades” en este caso se toma como medida principal “paquete” y se fracciona lo cual no es recomendable es mejor utilizar como unidad principal “unidades” y luego agrupar en paquetes de 10, pero si el proveedor los entrega por paquetes y no se fraccionaran las unidades, también es válido.
            </p>
          </div>
        </div>
      </div>

    </div>
    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
</div>
<script>
function newuni(){
  console.log("new Unidad");
  var elem = $('.botones');
  elem.hide();
  var elem2 = $('.uniform');
  elem2.fadeIn();
  $("#namuni").focus();
  alertify.message('Ingrese datos de Nueva Unidad de medida');
}

function canuni() {
  console.log(" Cancelado newuni");
  var elem = $('.botones');
  elem.fadeIn();
  var elem2 = $('.uniform');
  elem2.hide();
  $(".uniform button").val("");
  alertify.error('Cancelado por usuario ');
}

function savcanuni() {
  console.log(" guardado Cancelado  newuni");
  var elem = $('.botones');
  elem.fadeIn();
  var elem2 = $('.uniform');
  elem2.hide();
  $(".uniform button").val("");
}

function savuni(){
  console.log("save unidad")
  if (validate("namuni",1,0)){
    if (validate("abruni",1,0)){
    abruni
    console.log("si valido name unidad");
    $("#spanamuni").html("");

    $.post("./?action=addcategory",
    {
      name:$("#namuni").val(),
      description:$("#desuni").val(),
      abbreviation:$("#abruni").val(),
    },function(data){
      if (data.estado == "true") {
        alertify.success('Se agregó categoría correctamente');
        recargarcategoria();
      savcanuni();
      }else {
        alertify.error('No se pudo categoría producto');
      }
    });

  }else {
    $("#abruni").focus();
    $("#spanabruni").html("Complete este campo.");
    alertify.error('Complete campo obligatorio');
    console.log("no valido abruni Unidad");
  }
  }else {
    $("#namuni").focus();
    $("#spannamuni").html("Complete este campo.");
    alertify.error('Complete campo obligatorio');
    console.log("no valido name Unidad");
  }
}
</script>
