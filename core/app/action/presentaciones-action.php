<div class="nav-tabs-custom">
  <ul class="nav nav-tabs pull-right">
    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Instrucciones</a></li>
    <li class="pull-left header active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-th"></i>Presentaciones</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1">
      <div class="botones">
        <a href="#" class="btn btn-default" onclick="newuni()"><i class="fa  fa-plus"></i> Nueva Unidad de medida</a>
        <a href="#" class="btn btn-default" onclick="newgru()"><i class="fa  fa-plus"></i> Nuevo Grupo</a>
        <a href="#" class="btn btn-default" onclick="newfra()"><i class="fa  fa-plus"></i> Nueva Fraccion</a>
        <div id="presentaciones"> </div>
      </div>

    <!--  /*  ///////////////////////         formulario oculto unidad de medida      /////////////////////////*/-->
      <div class="uniform box box-default" hidden>
        <div class="box-header with-border">
          <h3 class="box-title">Unidad de medida</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" onclick="canuni()"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
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
        <!-- /*  ///////////////////////         formulario oculto bueva fraccion      /////////////////////////*/-->
      <div class="fraform box box-default" hidden>
        <div class="box-header with-border">
          <h3 class="box-title">Nueva Fraccion</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" onclick="canuni()"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-3">
              <input type="number" id="fracioncantidad" name="cantidad" class="form-control" placeholder="Partes" autocomplete="off">
              <span id="spanfracioncantidad"></span>
            </div>
            <label class="col-sm-2 control-label">Unidad</label>
            <div class="col-sm-3">
              <select id="unit_idfra" name="selectmedida" class="form-control">
                <option value="">--Seleccione--</option>
                <?php $units = unitData::getAll(); foreach($units as $unit):?>
                  <option class="<?php switch ($unit->type) {
                    case 0: echo "text-muted"; break;
                    case 1: echo "text-aqua"; break;
                    case 2: echo "text-yellow"; break;
                    case 3: echo "text-green"; break;
                    case 4: echo "text-red"; break;
                    case 5: echo "text-light-blue"; break;
                    case 5: echo "text-light-blue"; break; default:
                  }
                  ?>" value="<?php echo $unit->id;?>"> <?php echo $unit->name;?></option>
                <?php endforeach;?>
              </select>
              <span id="spanunit_idfra"></span>
            </div>
            <div id="contenedorpricce_outf">
            <div class="col-sm-4">
            <input type="text" onchange="validarprice_outf();" onkeyup="validarprice_outf();" name="price_outf" required class="form-control money" id="price_outf" placeholder="Precio de salida">
            <span id="spanprice_outf"></span>
            </div>
            </div>

          </div>
        </div>
        <div class="box-body">
          <button class="btn btn-danger" onclick="canuni()">Cancel</button>
          <button class="btn btn-success pull-right" onclick="savfra()">retener</button>
        </div>
      </div>
  <!-- /*  ///////////////////////         formulario oculto Nuevo Grupo      /////////////////////////*/-->
      <div class="gruform box box-default" hidden>
        <div class="box-header with-border">
          <h3 class="box-title">Nuevo Grupo</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" onclick="canuni()"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-3">
              <input type="number" id="grupocantidad" name="grupocantidad" class="form-control" placeholder="Cantidad" autocomplete="off">
              <span id="spangrupocantidad"></span>
            </div>
            <label class="col-sm-2 control-label">Unidad</label>
            <div class="col-sm-3">
              <select id="unit_idgru" name="selectmedidagru" class="form-control">
                <option value="">--Seleccione--</option>
                <?php $units = unitData::getAll(); foreach($units as $unit):?>
                  <option class="<?php switch ($unit->type) {
                    case 0: echo "text-muted"; break;
                    case 1: echo "text-aqua"; break;
                    case 2: echo "text-yellow"; break;
                    case 3: echo "text-green"; break;
                    case 4: echo "text-red"; break;
                    case 5: echo "text-light-blue"; break;
                    case 5: echo "text-light-blue"; break; default:
                  }
                  ?>" value="<?php echo $unit->id;?>"> <?php echo $unit->name;?></option>
                <?php endforeach;?>
              </select>
              <span id="spanunit_idgru"></span>
            </div>

            <div id="contenedorpricce_outg">
            <div class="col-sm-4">
            <input type="text" onchange="validarprice_outg();" onkeyup="validarprice_outg();" name="price_outg" required class="form-control money" id="price_outg" placeholder="Precio de salida">
            <span id="spanprice_outg"></span>
            </div>
            </div>
              </div>
              <br>
              <div class="row">
            <div id="contenedornamegru">
            <div class="col-xs-4">
              <input id="namgru" type="text" class="form-control" placeholder="Nombre">
              <span id="spannamgru"></span>
            </div>
            </div>
            <div class="col-sm-4">
                <input type="text" required="" name="barcodegru" class="form-control" id="barcodegru" placeholder="Codigo de Barras del Producto">
                <span id="spanbarcodegru"></span>
              </div>
          </div>
        </div>
        <div class="box-body">
          <button class="btn btn-danger" onclick="canuni()">Cancel</button>
          <button class="btn btn-success pull-right" onclick="savgru()">Guardar</button>
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


$(document).ready(function()
{
  $('.money').mask('000.000.000,00', {reverse: true});
  $("#presentaciones").load("./?action=viewpresentation");
  $("#presentacionesresumen").load("./?action=viewpresentation&o=resumido");

});
function validarprice_outg(){
  NEMEM = $('#price_outg').cleanVal()/100;
  nuu = numeroALetras(NEMEM, {
    plural: '',
    singular: '',
    centPlural: 'CENTAVOS',
    centSingular: 'CENTAVO'
  });
  $("#spanprice_outg").html(nuu);
}

function validarprice_outf(){
  NEMEM = $('#price_outf').cleanVal()/100;
  nuu = numeroALetras(NEMEM, {
    plural: '',
    singular: '',
    centPlural: 'CENTAVOS',
    centSingular: 'CENTAVO'
  });
  $("#spanprice_outf").html(nuu);
}
//fomulario para los datos de nueva unidad
function newuni(){
  console.log("new Unidad");
  var elem = $('.botones');
  elem.hide();
  var elem2 = $('.uniform');
  elem2.fadeIn();
  $("#namuni").focus();
  alertify.message('Ingrese datos de Nueva Unidad de medida');
}
// cansela cancelar y ocultar formulario
function canuni() {
  console.log(" ocultar formularios");
  var elem = $('.botones');
  elem.fadeIn();
  var elem2 = $('.uniform');
  var elem3 = $('.fraform');
  var elem4 = $('.gruform');
  elem2.hide();
  elem3.hide();
  elem4.hide();
  $(".uniform button").val("");
  alertify.error('Cancelado por usuario');
}
//  ocultar formularios
//ocultar formulario depues de Guardar
function savcanuni() {
  console.log(" ocultar formularios");
  var elem = $('.botones');
  elem.fadeIn();
  var elem2 = $('.uniform');
  var elem3 = $('.fraform');
  var elem4 = $('.gruform');
  elem2.hide();
  elem3.hide();
  elem4.hide();
  $(".uniform button").val("");
}
//guardar unidad
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
//fomulario para los datos de nueva fracion
function newfra(){
  console.log("new fraccion");
  var elem = $('.botones');
  elem.hide();
  var elem2 = $('.fraform');
  elem2.fadeIn();
  $("#namuni").focus();
  alertify.message('Ingrese datos de Nueva Unidad de medida');
}
<!--añade al Carrito de compras-->

function savfra() {
  console.log("sav fra");
  //alertify.success('añadiendo a la Lista Producto'+id)
  if (validate("fracioncantidad",1,0)){
    if (validate("fracioncantidad",4,0)){
      if (validate("fracioncantidad",3,0)){
        if (validate("fracioncantidad",3,2)){
        $("#spanfracioncantidad").html("");
        if (validate("unit_idfra",1,0)){
          $("#spanunit_idfra").html("");

          if (validate("price_outf",1,0,0)){
            $("#spanprice_outf").html("");
            $("#contenedorpricce_outf").removeClass("has-error");

            id = $('#price_outf').cleanVal();
            if (validate(id,3,1,1)){
              $("#spanprice_outf").html("");
              $("#contenedorpricce_outf").removeClass("has-error")

          $.get("./?action=addfraction&o=fra",
          {
            q:$("#fracioncantidad").val(),
            unit_id: $("#unit_idfra").val(),
            price_outf:id,
          },function(data){
            if (data.estado == "true") {
              alertify.success('Se retuvo fracion correctamente');
            }else {
              alertify.error('No se pudo retener fracion');
            }
            $("#presentaciones").load("./?action=viewpresentation");
            $("#presentacionesresumen").load("./?action=viewpresentation&o=resumido");
          });
          savcanuni();
        }else {
          $("#contenedorpricce_outf").addClass("has-error")
          $("#price_outf" ).focus();
          $("#spanprice_outf").html("No puede se cero ni negativo");
          alertify.error('Complete campo obligatorios');
          return false
        }
      }else {
        $("#contenedorpricce_outf").addClass("has-error")
        $("#price_outf" ).focus();
        $("#spanprice_outf").html("Complete este campo.");
        alertify.error('Complete campo obligatorios');
        return false;
      }
        }else {
          $("#unit_idfra").focus();
          $("#spanunit_idfra").html("Complete este campo.");
          alertify.error('Complete campo obligatorio');
          console.log("no valido Unidad");
        }
      }else {
        $("#fracioncantidad").focus();
        $("#spanfracioncantidad").html("No puede ser menor a 2.");
        alertify.error('Complete campo obligatorio');
        console.log("no valido partes");
      }
      }else {
        $("#fracioncantidad").focus();
        $("#spanfracioncantidad").html("No puede ser negativo.");
        alertify.error('Complete campo obligatorio');
        console.log("no valido partes");
      }
    }else {
      $("#fracioncantidad").focus();
      $("#spanfracioncantidad").html("No puede ser cero.");
      alertify.error('Complete campo obligatorio');
      console.log("no valido partes");
    }
  }else {
    $("#fracioncantidad").focus();
    $("#spanfracioncantidad").html("Complete este campo.");
    alertify.error('Complete campo obligatorio');
    console.log("no valido partes");
  }
}

//fomulario para los datos de nuevo grupo
function newgru(){
  console.log("new grupo");
  var elem = $('.botones');
  elem.hide();
  var elem2 = $('.gruform');
  elem2.fadeIn();
  $("#namuni").focus();
  alertify.message('Ingrese datos de Nuevo Grupo');
}
function savgru() {
  console.log("sav grupo");
  //1:"no este vacio" 2:"no sea mayor" 3:"no sea menor" 4:"no sea igual"
  //5:"sea DECIMAL" 6:"no se mas largo de" 7: "no se mas corto de" 8:"sea numero" 9:"no pese mas de"
  if (validate("grupocantidad",1,0)){
      if (validate("grupocantidad",4,0)){
      if (validate("grupocantidad",3,2)){
        $("#spangrupocantidad").html("");
        if (validate("unit_idgru",1,0)){
          $("#spanunit_idgru").html("");
                    if (validate("price_outg",1,0,0)){
                      $("#spanprice_outg").html("");
                      $("#contenedorpricce_outg").removeClass("has-error");

                      id = $('#price_outg').cleanVal();
                      if (validate(id,3,1,1)){
                        $("#spanprice_outg").html("");
                        $("#contenedorpricce_outg").removeClass("has-error")
                        $.get("./?action=addfraction&o=gru",
                        {
                          price_outg:id,
                          q:$("#grupocantidad").val(),
                          unit_id: $("#unit_idgru").val(),
                        },function(data){
                          if (data.estado == "true") {
                            alertify.success('Se retuvo grupo correctamente');
                            $("#price_outg").val("");
                            $("#grupocantidad").val("");
                            $("#unit_idgru").val("");
                          }else {
                            alertify.error('No se pudo retener grupo');
                          }
                          $("#presentaciones").load("./?action=viewpresentation");
                          $("#presentacionesresumen").load("./?action=viewpresentation&o=resumido");
                        });
                        savcanuni();
                        }else {
                          $("#contenedorpricce_outg").addClass("has-error")
                          $("#price_outg" ).focus();
                          $("#spanprice_outg").html("No puede se cero ni negativo");
                          alertify.error('Complete campo obligatorios');
                          return false
                        }
                      }else {
                        $("#contenedorpricce_outg").addClass("has-error")
                        $("#price_outg" ).focus();
                        $("#spanprice_outg").html("Complete este campo.");
                        alertify.error('Complete campo obligatorios');
                        return false;
                      }
        }else {
          $("#unit_idgru").focus();
          $("#spanunit_idgru").html("Complete este campo.");
          alertify.error('Complete campo obligatorio');
          console.log("no valido Unidad");
        }

      }else {
        $("#grupocantidad").focus();
        $("#spangrupocantidad").html("No puede ser menor a 2");
        alertify.error('Complete campo obligatorio');
        console.log("no valido partes");
      }
    }else {
      $("#grupocantidad").focus();
      $("#spangrupocantidad").html("No puede ser cero.");
      alertify.error('Complete campo obligatorio');
      console.log("no valido partes");
    }
  }else {
    $("#grupocantidad").focus();
    $("#spangrupocantidad").html("Complete este campo.");
    alertify.error('Complete campo obligatorio');
    console.log("no valido partes");
  }
}
</script>
