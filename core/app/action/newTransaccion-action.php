<div id="myModal" class="modal fade in" role="dialog"><!--parte oscura del modal-->
  <div class="modal-dialog modal-lg"> <!-- tamaño del modal-->
    <!-- Modal content-->
    <div  class="box box-success fondo">
      <div class="box-header with-border">
        <h3 class="box-title">Nueva Transacción</h3>
        <button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
          <span>×</span></button>
        </div>
        <!-- form start -->
        <form name="pepec" class="form-horizontal" method="post" autocomplete="off"  id="addtransaccion" role="form" >
          <div class="box-body">
            <div class="form-group">

              <label for="presentation" class="col-sm-2 col-xs-6 control-label">Salida</label>
              <div class="col-sm-2 col-xs-2">
                <div id="switch" class="switch-field2" >
                  <input type="hidden" name="cuenta_id" value="<?php echo $_GET["id"]; ?>">
                  <input type="radio" id="switch_left" name="switch_2" value="0" checked="" onchange="changercolor2()" >
                  <label for="switch_left">-</label>
                  <input type="radio" id="switch_right" name="switch_2" value="1" onchange="changercolor()">
                  <label for="switch_right">+</label>
                </div>
              </div>
              <div id="contenedorefectivo">
                <label for="efectivo" class="col-sm-1 control-label">Efectivo$</label>
                <div class="col-sm-6">
                  <input type="text" id="efectivo" onchange="validarefectivo();" name="efectivo" onkeyup="validarefectivo();" required class="form-control money" placeholder="Efectivo">
                  <span id="spanefectivo"></span>
                </div>
              </div>
            </div>
            <script>
            jQuery(function($){
              $('.money').mask('000.000.000,00', {reverse: true});
            });
            function validarefectivo(){
              NEMEM = $('#efectivo').cleanVal()/100;
              nuu = numeroALetras(NEMEM, {
                plural: '',
                singular: '',
                centPlural: 'CENTAVOS',
                centSingular: 'CENTAVO'
              });
              $("#spanefectivo").html(nuu);
            }
            </script>
            <div class="form-group">
              <div id="contenedorfecha">
                <label for="price_out" class="col-sm-2 control-label">Fecha*</label>
                <div class="col-sm-4">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" id="fecha" name="fecha" class="form-control pull-right" id="datepicker">
                  </div>
                  <!-- /.input group -->
                  <span id="spanfecha"></span>
                </div>
                <label for="price_out" class="col-sm-1 control-label">Hora*</label>
                <div class="col-sm-4">
                  <div class="bootstrap-timepicker">
                    <div class="input-group">
                      <input id="hora" name="hora" type="text" class="form-control timepicker">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                    <!-- /.input group -->
                    <!-- /.form group -->
                  </div>
                  <span id="spanhora"></span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div id="contenedorpricce_out">
                <label for="acredor" class="col-sm-2 control-label">Acredor</label>
                <div class="col-sm-4">
                  <input type="text" id="acredor" name="acredor" required class="form-control"  placeholder="Acredor">
                  <span id="spanprice_out"></span>
                </div>
              </div>
              <div id="cancelar" class="mostrar" hidden="on">
                <a class="btn btn-danger col-sm-2" onclick="adeshabc()">Cancelar</a>
              </div>
            </div>

            <div id="contentcategory_id" class="form-group">
              <label class="col-sm-2 control-label">Categoria</label>
              <div class="col-sm-4">
                <select id="category_id" name="category_id" class="form-control">
                  <option value="">-- NINGUNA --</option>
                  <?php
                  $categories = CategorycData::getAll();
                  foreach($categories as $category):?>
                  <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div id="newcategory"  class="col-sm-2 ocultar">
              <a href="#" class="btn btn-default"  onClick="newcategoryc()" ><i class='fa  fa-plus'></i> Nueva Categoria</a>
            </div>
            <div id="categorias"  class="col-sm-2 ocultar">
              <a href="#" class="btn btn-default"  onClick="categoriasc()" ><i class='fa fa-th-list'></i> Opciones de categorías</a>
            </div>
            <div  class="mostrar" hidden="on">
              <a class="btn btn-success col-sm-2" onClick="savecategoryc()">Guardar </a>
              <div id="contentnuevacategoria" class="col-sm-3">
                <input type="text" class="form-control" id="nuevacategoria"  placeholder="Nombre de la Categoria" autocomplete="off">
                <span></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div id="contenedornota">
              <label for="price_out" class="col-sm-2 control-label">Nota</label>
              <div class="col-sm-9">
                <input type="text" id="nota" name="nota"  required class="form-control" placeholder="Precio de salida">
                <span id="spannota"></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
              <button type="button"  class="btn btn-success" id="guardarc" onclick="addtransaccion();">Guardar Cuenta</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="categoríasc">
</div>
<script>





function addtransaccion(){
    console.log("addtransaccion");
      $("#guardarc").prop('disabled', true);
    if (validaformulariot()){
      console.log("si valido formulario");
      $('.money').unmask();//desnmascaran los campos
    //  id = $('#price_in').cleanVal();
    // avilitamos todos los campos
    frm = document.forms['pepec'];
    for(i=0; ele=frm.elements[i]; i++){
      ele.disabled=false;
    }
    $("#guardarc").prop('disabled', true);
    var parametros = new FormData($("#addtransaccion")[0]);
    $.ajax (
      {
        data:parametros,
        url:"./?action=addtransaccion",
        type:"POST",
        contentType: false,
        processData: false,
        beforesend: function(){
        },
        success: function(data){
          if (data.estado == "true") {
            alertify.success('Se guardo Transacción correctamente');
            $("body").overhang({
                type: "success",
                duration: 1,
                message: "Se guardo Transacción correctamente",
                callback: function() {
               $('#myModal').modal('hide');
                }
            });

            setTimeout(function(){recargarcuentas();},3000);
          }else {
            $("#guardarc").prop('disabled', false);
            alertify.error('No se pudo guardar Almacenamiento');
          }
        }
      }
    )
    }else {
      $("#guardarc").prop('disabled', false);
    //alertify.error('Complete campo obligatorio');
      console.log("No valido formulario");
    }
}
function validaformulariot(){
if (validate("efectivo",1,0,0)){
  $("#spanefectivo").html("");
  $("#contenedorefectivo").removeClass("has-error")
  $("#contenedorefectivo").addClass("has-success")
}else {
$("#contenedorefectivo").removeClass("has-success")
$("#contenedorefectivo").addClass("has-error")
$("#efectivo" ).focus();
$("#spanefectivo").html("Complete este campo.");
alertify.error('Complete campo obligatorio');
return false;
}

if (validate("fecha",1,0,0)){
  $("#spanfecha").html("");
  $("#contenedorfecha").removeClass("has-error")
  $("#contenedorfecha").addClass("has-success")
}else {
$("#contenedorfecha").removeClass("has-success")
$("#contenedorfecha").addClass("has-error")
$("#fecha" ).focus();
$("#spanfecha").html("Complete este campo.");
alertify.error('Complete campo obligatorio');
return false;
}

if (validate("hora",1,0,0)){
  $("#spanhora").html("");
  $("#contenedorfecha").removeClass("has-error")
  $("#contenedorfecha").addClass("has-success")
}else {
$("#contenedorfecha").removeClass("has-success")
$("#contenedorfecha").addClass("has-error")
$("#hora" ).focus();
$("#spanhora").html("Complete este campo.");
alertify.error('Complete campo obligatorio');
return false;
}
return true;
}





















/*para dale estilo al campo tipe file*/
// avilita el formulario

function categoriasc(){
  console.log("categorias")
  alertify.genericDialog || alertify.dialog('genericDialog',function(){
    return {
      main:function(content){
        this.setContent(content);
      },
      setup:function(){
        return {
          focus:{
            element:function(){
              return this.elements.body.querySelector(this.get('selector'));
            },
            select:true
          },
          options:{
            basic:true,
            maximizable:false,
            resizable:true,
            padding:false
          }
        };
      },
      settings:{
        selector:undefined
      }
    };
  });
  //force focusing password box
  alertify.genericDialog ($('#categoríasc')[0]).set('selector', 'input[type="password"]');
  $.get("./?action=categoriesc",function(data){
    $("#categoríasc").html(data);
  });
}


function adeshabc() {
  console.log("adeshab Cancelado");
  var elem2 = $('.mostrar');
  elem2.hide();
  var elem = $('.ocultar');
  elem.fadeIn();
  $(".has-success").removeClass("has-success");
  $("#contentcategory_id").removeClass("has-error");
  $("#contentcategory_id_iva").removeClass("has-error");
  $("#contentnuevacategoria span").html("");
  $("#nuevacategoria").val("");
  $("#porcentaje").val("");
  alertify.error('Cancelado por usuario ');
}


function savecategoryc(){
  console.log("savecategoryc")
  if (validate("nuevacategoria",1,0)){
    console.log("si valido");
    $.post("./?action=addcategoryc",
    {
      name:$("#nuevacategoria").val()
    },function(data){
      if (data.estado == "true") {
        alertify.success('Se agregó categoría correctamente');
        recargarcategoriac();
        adeshabc();
      }else {
        alertify.error('No se pudo categoría producto');
      }
    });
  }else {
    $("#contentcategory_id").removeClass("has-success")
    $("#contentcategory_id").addClass("has-error")
    $("#nuevacategoria" ).focus();
    $("#contentnuevacategoria span").html("Complete este campo.");
    alertify.error('Complete campo obligatorio');
    console.log("no valido");
  }
}

function recargarcategoriac(){
  console.log("recargarcategoriac")
  $('#category_id').children('option:not(:first)').remove();
  $.get("./?action=searchallcategoryc",
  {
    name:$("#nuevacategoria").val(),
  },function(data){
    data.forEach(function(dat, index){
      $('#category_id').append('<option value="'+dat.id+'">'+dat.name+'</option>');
      $("#category_id [value="+ dat.id +"]").attr("selected",true);
    })
  });
}

function newcategoryc(){
  console.log("newcategory");
  $("#contentcategory_id").addClass("has-success");
  var elem = $('.ocultar');
  elem.hide();
  var elem2 = $('.mostrar');
  elem2.fadeIn();
  $("#nuevacategoria").removeAttr("disabled");
  $("#descriptionc").removeAttr("disabled");
  $("#nuevacategoria").focus();
  alertify.message('Ingrese nombre da la nueva categoría');
}

function editcategoryc(id) {
  console.log("editcategoryt"+id)
  alertify.genericDialog || alertify.dialog('genericDialog',function(){
    return {
      main:function(content){
        this.setContent(content);
      },
      setup:function(){
        return {
          focus:{
            element:function(){
              return this.elements.body.querySelector(this.get('selector'));
            },
            select:true
          },
          options:{
            title: false,
            basic:true,
            maximizable:false,
            resizable:false,
            padding:false
          }
        };
      },
      settings:{
        selector:undefined
      }
    };
  });
  //force focusing password box
  alertify.genericDialog ($('#categoríasc')[0]).set('selector', 'input[type="text"]');
  $.get("./?action=editcategoryc",{idc:id},function(data){
    $("#categoríasc").html(data);
    $("#namec").focus(function(){
      this.select();
    });
    $( "#namec" ).focus();
  });
}

//Timepicker
$('.timepicker').timepicker({
  showInputs: false
});
//Date picker
$('#datepicker').datepicker({
  autoclose: true
})

function changercolor(){
  console.log("remover class ClassName");
  $("#switch").removeClass("switch-field2");
  $("#switch").addClass("switch-field");
}
function changercolor2(){
  console.log("remover class ");
  $("#switch").removeClass("switch-field");
  $("#switch").addClass("switch-field2");
}
function recargarcuentas(){
  console.log("recargarcuentas");
  changerview('./?page=cuentas');
}

function updatecategoryc(){
  console.log("updatecategoryc");
  if (validate("namec",1,0)){
    console.log("si valido");
    $.post("./?action=updatecategoryc",
    {
      id:$("#idca").val(),
      name:$("#namec").val()
    },function(data){
      if (data.estado == "true") {
        alertify.success('Se actualiso categoría #'+$("#idca").val()+' correctamente');
        recargarcategoriac()
        categoriasc();
      }else {
        alertify.error('No se pudo guardar');
      }
    });
  }else {
    $("#contentnamec").addClass("has-error")
    $( "#namec" ).focus();
    $("#contentnamec span").html("Complete este campo.");
    alertify.error('Complete campo obligatorio');
    console.log("no valido");
  }
}

function addcuenta(){
  console.log("addcuenta");
  $("#guardar").prop('disabled', true);
  if (validaformulario()){
    console.log("si valido formulario");
    $('.money').unmask();//desnmascaran los campos
    //  id = $('#price_in').cleanVal();
    // avilitamos todos los campos
    frm = document.forms['pepe'];
    for(i=0; ele=frm.elements[i]; i++){
      ele.disabled=false;
    }
    $("#guardar").prop('disabled', true);
    var parametros = new FormData($("#addcuenta")[0]);
    $.ajax (
      {
        data:parametros,
        url:"./?action=addcuenta",
        type:"POST",
        contentType: false,
        processData: false,
        beforesend: function(){
        },
        success: function(data){
          if (data.estado == "true") {
            alertify.success('Se guardo Almacenamiento correctamente');
            $("body").overhang({
              type: "success",
              duration: 1,
              message: "Se guardo Almacenamiento correctamente",
              callback: function() {
                $('#myModal').modal('hide');
              }
            });

            setTimeout(function(){recargarcuentas();},3000);
          }else {
            $("#guardar").prop('disabled', false);
            alertify.error('No se pudo guardar Almacenamiento');
          }
        }
      }
    )
  }else {
    $("#guardar").prop('disabled', false);
    //alertify.error('Complete campo obligatorio');
    console.log("No valido formulario");
  }
}
function validaformulario(){
  if (validate("name",1,0,0)){
    $("#spanamep").html("");
    $("#contenedorname").removeClass("has-error")
    $("#contenedorname").addClass("has-success")
  }else {
    $("#contenedorname").removeClass("has-success")
    $("#contenedorname").addClass("has-error")
    $("#name" ).focus();
    $("#spanamep").html("Complete este campo.");
    alertify.error('Complete campo obligatorio');
    return false;
  }
  if (validate("name",6,255,0)){
    $("#spanamep").html("");
    $("#contenedorname").removeClass("has-error")
    $("#contenedorname").addClass("has-success")
  }else {
    $("#contenedorname").removeClass("has-success")
    $("#contenedorname").addClass("has-error")
    $("#name" ).focus();
    $("#spanamep").html("Nombre demasiado largo.");
    alertify.error('Nombre demasiado largo, reduzca el nombre.');
    return false
  }
  return true;
}
</script>
