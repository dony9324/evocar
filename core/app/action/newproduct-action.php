<div id="myModal" class="modal fade in" role="dialog"><!--parte oscura del modal-->
  <div class="modal-dialog modal-lg"> <!-- tamaño del modal-->
    <!-- Modal content-->
    <div  class="box box-success fondo">
      <div class="box-header with-border">
        <h3 class="box-title">Nuevo Producto</h3>
        <button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
          <span>×</span></button>
        </div>
        <?php $categories = CategoryData::getAll();
        $ivas = IvaData::getAll();
        $marcas = TrademarkData::getAll();
        $units = unitData::getAll();
        ?>
        <!-- form start -->
        <form name="pepe" class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data"  id="addproduct" role="form" >
          <div class="box-body">
            <div class="form-group">
              <label for="image" class="col-sm-2 control-label">Imagen</label>
              <div class="col-sm-4">
                <label  id="imagelabel" for="image" class="col-sm-12 btn btn-default">Seleccionar Imagen</label>
                <input type="file" name="image" id="image" accept="image/*" peso="">
                <span id="spanimagep"></span>
              </div>
              <div id="contenedorcodigo">
              <label for="codigo"  class="col-sm-2 control-label">Codigo</label>
              <div class="col-sm-4">
                <input type="text"  name="codigo" id="codigo" class="form-control" placeholder="Código extra">
                <span id="spancodigop"></span>
              </div>
            </div>
            </div>

            <div class="form-group">
              <div id="contenedorname">
              <label for="name"  class="col-sm-2 control-label">Nombre*</label>
              <div class="col-sm-4">
                <input type="text"  name="name"  class="form-control" id="name" placeholder="Nombre" autofocus>
                <span id="spanamep"></span>
              </div>
            </div>
            <div id="contenedorbarcode">
              <label for="barcode" class="col-sm-2 control-label">Codigo de Barras</label>
              <div class="col-sm-4">
                <input type="text" required name="barcode"  class="form-control" id="barcode" placeholder="Codigo de Barras del Producto">
                <span id="spanbarcode"></span>
              </div>
              </div>
            </div>

            <div class="form-group">
              <div id="contenedordescription">
              <label for="description" class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-4">
                <input name="description"  required class="form-control"  id="description" placeholder="Descripcion del Producto">
                <span id="spandescription"></span>
              </div>
              </div>
              <div id="contenedorlocation">
              <label for="location" class="col-sm-2 control-label">Ubicación</label>
              <div class="col-sm-4">
                <input type="text" name="location" required class="form-control" id="location" placeholder="Ubicación del Producto">
                <span id="spanlocation"></span>
              </div>
            </div>
            </div>
            <div id="bg-white1" class="">

              <div id="contentmarca" for="trademark" class="form-group">
                <label class="col-sm-2 control-label">Marca.</label>
                <div class="col-sm-4">
                  <select id="trademark" name="trademark" class="form-control">
                    <option value="">-- NINGUNA --</option>
                    <?php foreach($marcas as $marca):?>
                      <option value="<?php echo $marca->id;?>"><?php echo $marca->name;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div id="newcategoryiva" class="col-sm-2 ocultar" >

                  <a  href="#" class="btn btn-default" onClick="newmarca()"><i class='fa  fa-plus'></i> Nueva Marca </a>
                </div>
                <div id="categorias"  class="col-sm-2 ocultar">
                  <a href="#" class="btn btn-default"  onClick="marcas()" ><i class='fa fa-th-list'></i> Opciones de Marcas.</a>
                </div>
                <div id="cancelar" class="mostrar" hidden="on">
                  <label class="col-sm-5 control-label">Ingrese datos para guardar nueva Categoría.</label>
                </div>
                <div id="cancelar" class="mostrar2" hidden="on">
                  <label class="col-sm-5 control-label">Ingrese datos para guardar nuevo tipo de IVA.</label>
                </div>
                <div id="cancelar" class="mostrar3" hidden="on">
                  <label class="col-sm-5 control-label">Ingrese datos para guardar nueva Marca.</label>
                </div>
              </div>

              <div id="contentcategory_id" class="form-group">
                <label class="col-sm-2 control-label">Categoria</label>
                <div class="col-sm-4">
                  <select id="category_id" name="category_id" class="form-control">
                    <option value="">-- NINGUNA --</option>
                    <?php foreach($categories as $category):?>
                      <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div id="newcategory"  class="col-sm-2 ocultar">
                  <a href="#" class="btn btn-default"  onClick="newcategory()" ><i class='fa  fa-plus'></i> Nueva Categoria</a>
                </div>
                <div id="categorias"  class="col-sm-2 ocultar">
                  <a href="#" class="btn btn-default"  onClick="categorias()" ><i class='fa fa-th-list'></i> Opciones de categorías</a>
                </div>
                <div  class="mostrar" hidden="on">
                  <a class="btn btn-success col-sm-2" onClick="savecategory()">Guardar </a>
                  <div id="contentnuevacategoria" class="col-sm-4">
                    <input type="text" class="form-control" id="nuevacategoria"  placeholder="Nombre de la Categoria" autocomplete="off">
                    <span></span>
                  </div>
                </div>
                <div id="cantidadefectivo" class="mostrar2" hidden="on">
                  <a class="btn btn-success col-sm-2" onClick="saveiva()">Guardar </a>
                  <div id="contentnuevacategoria2" class="col-sm-4">
                    <input type="text" class="form-control" id="nuevoiva"  placeholder="Nombre del tipo de IVA" autocomplete="off">
                    <span id="spanameiva"></span>
                  </div>
                </div>
                <div id="cantidadefectivo" class="mostrar3" hidden="on">
                  <a class="btn btn-success col-sm-2" onClick="savemarca()">Guardar </a>
                  <div id="contentnuevacategoria2" class="col-sm-4">
                    <input type="text" class="form-control" id="nuevamarca"  placeholder="Nombre de Marca" autocomplete="off">
                    <span id="spanamemarca"></span>
                  </div>
                </div>
              </div>

              <div id="contentcategory_id_iva" class="form-group">
                <label class="col-sm-2 control-label">Tipo de I.V.A.</label>
                <div class="col-sm-4">
                  <select id="category_id_iva" name="category_id_iva" class="form-control">
                    <option value="">-- General --</option>
                    <?php foreach($ivas as $iva):?>
                      <option value="<?php echo $iva->id;?>"><?php echo $iva->name." ".$iva->porcentage."%"?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div id="newcategoryiva" class="col-sm-2 ocultar" >

                  <a  href="#" class="btn btn-default" onClick="newiva()"><i class='fa  fa-plus'></i> Nuevo  tipo  I.V.A </a>
                </div>
                <div id="categorias"  class="col-sm-2 ocultar">
                  <a href="#" class="btn btn-default"  onClick="categoriasiva()" ><i class='fa fa-th-list'></i> Opciones de I.V.A.</a>
                </div>
                <div id="cancelar" class="mostrar" hidden="on">
                  <a  class="btn btn-danger col-sm-2" onClick="adeshab()" >Cancelar</a>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="descriptionc"  placeholder="Descripción de la Categoria" autocomplete="off">
                  </div>
                </div>
                <div id="cancelar" class="mostrar2" hidden="on">
                  <a  class="btn btn-danger col-sm-2" onClick="adeshab()" >Cancelar</a>
                  <div class="col-sm-4">
                    <input type="number" min="0" max="50" step="1" class="form-control" id="porcentaje"  placeholder="porcentaje agregado" autocomplete="off">
                    <span id="spanporcentajeiva"></span>
                  </div>
                </div>
                <div id="cancelar" class="mostrar3" hidden="on">
                  <a  class="btn btn-danger col-sm-2" onClick="adeshab()" >Cancelar</a>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="descriptionm"  placeholder="Descripción de Marca" autocomplete="off">
                    <span id="spanporcentajeiva"></span>
                  </div>
                </div>
              </div>
            </div>
            <div id="bg-white2" class="">
              <div id="contentselectmedida" class="form-group">
                <label class="col-sm-2 control-label">Unidad de medida*</label>
                <div class="col-sm-4">
                  <select id="selectmedida" name="selectmedida" class="form-control" onChange="medida(this.value)">
                    <option value="">--Seleccione--</option>
                    <?php foreach($units as $unit):?>
                      <option class="<?php switch ($unit->type) {
                        case 0: echo "text-muted"; break;
                        case 1: echo "text-aqua"; break;
                        case 2: echo "text-yellow"; break;
                        case 3: echo "text-green"; break;
                        case 4: echo "text-red"; break;
                        case 5: echo "text-light-blue"; break; default:
                      }
                      ?>" value="<?php echo $unit->id;?>"> <?php echo $unit->name;?></option>
                    <?php endforeach;?>
                  </select>
                  <span id="spanselectmedida"></span>
                </div>
                <div class="mostrar4" hidden="on">
                  <label id="labelmedida" class=" col-sm-2">tata</label>
                  <div class="col-sm-4">
                    <input type="number" id="cantidad" name="cantidad" class="form-control" onchange="adeshabCuantos()"  placeholder="Cantidad" autocomplete="off" step="any">
                    <span id="spanmedida"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="presentation" class="col-sm-2 col-xs-6 control-label">Otras presentaciones</label>
              <div class="col-sm-4 col-xs-5">
                <div class="switch-field" >
                  <input type="radio" id="switch_left" name="switch_2" value="0" checked="" onchange="presentaciones2()" >
                  <label for="switch_left">No</label>
                  <input type="radio" id="switch_right" name="switch_2" value="1" onchange="presentaciones()">
                  <label for="switch_right">Si</label>
                </div>
              </div>
              <div id="presentacionesresumen" class="otraspresentaciones">
              </div>
            </div>
            <div class="form-group">
              <div id="contenedorpricce_in">
              <label for="price_in" class="col-sm-2 control-label">Precio de Costo*</label>
              <div class="col-sm-4">
              <input type="text" onchange="validarprice_in();" onkeyup="validarprice_in();" name="price_in" required class="form-control money" id="price_in" placeholder="Precio de entrada">
              <span id="spanprice_in"></span>
              </div>
              </div>
              <div id="contenedorpricce_out">
              <label for="price_out" class="col-sm-2 control-label">Precio de Venta*</label>
              <div class="col-sm-4">
              <input type="text" onchange="validarprice_out();" onkeyup="validarprice_out();" name="price_out" required class="form-control money" id="price_out" placeholder="Precio de salida">
              <span id="spanprice_out"></span>
              </div>
              </div>
            </div>
            <div class="form-group">
              <label for="q" class="col-sm-2 control-label">Inventario inicial*</label>
              <div class="col-sm-4">
                <input type="number" min="0" step="any" name="q" required class="form-control"  id="q" placeholder="Inventario inicial" value="0">
              </div>
              <label for="inventary_min" class="col-sm-2 control-label">Minima en inventario*</label>
              <div class="col-sm-4">
                <input type="number" min="0" step="any"  name="inventary_min" required  value="5" class="form-control" id="inventary_min" placeholder="Minima en Inventario (Default 10)" >
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-4">
                    <div class="checkbox">
                      <label>
                        <input name="control_stock" id="control_stock" onchange="alertdecontrol_stock();" type="checkbox"> No controlar stock
                          </label>
                            <label>
                        <input name="divide" id="divide" onchange="divide_stock();" type="checkbox"> Permitir fraccionar Producto
                      </label>
                    </div>
                  </div>
              <div class="col-sm-offset-2 col-sm-4">
                <button type="button"  class="btn btn-success" id="guardar" onclick="addproduct();">Guardar Producto</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    ///funcion para enmascarar http://igorescobar.github.io/jQuery-Mask-Plugin/docs.html
    jQuery(function($){
      $('.money').mask('000.000.000,00', {reverse: true});
            });
  function validarprice_out(){
    NEMEM = $('#price_out').cleanVal()/100;
    nuu = numeroALetras(NEMEM, {
      plural: '',
      singular: '',
      centPlural: 'CENTAVOS',
      centSingular: 'CENTAVO'
    });
    $("#spanprice_out").html(nuu);
  }
  function validarprice_in(){
    NEMEM = $('#price_in').cleanVal()/100;
    nuu = numeroALetras(NEMEM, {
      plural: 'PESOS',
      singular: 'PESO',
      centPlural: 'CENTAVOS',
      centSingular: 'CENTAVO'
    });
    $("#spanprice_in").html(nuu);
  }
  function medida(value){
    console.log("medida "+value);
    $('#contentselectmedida').removeClass('has-error');
    $("#spanselectmedida").html("");
    var elem2 = $('.mostrar4');
    var mesaje = "";
    var uno = value * 1;
    switch (uno) {
      <?php foreach($units as $unit):
        if ($unit->type >1) {
          echo "case ".$unit->id.": mesaje ='Cuantos ".$unit->name."'; break;";
        }else if ($unit->type ==1) {
          echo "case ".$unit->id.": mesaje ='Cuantas ".$unit->name."'; break;";
        }else{
          echo "case ".$unit->id.": mesaje ='Cuantos ".$unit->name."'; break;";
        }
        ?>
        <?php endforeach;?>
        default:
      }
      if (value<=8 && value!=2){
        elem2.hide();
        adeshabx();
      }else {
        $("#labelmedida").html(mesaje);
        alertify.success('Ingrese '+mesaje);
        deshab();//DESAVILITA EL FORMULARIO
        $("#contentselectmedida").addClass("has-success");
        $('.fondo').addClass('bg-gray-light');
        $('#bg-white2').addClass('bg-white');
        elem2.fadeIn();
        $("#cantidad").removeAttr("disabled");
        $("#selectmedida").removeAttr("disabled");
        $("#cantidad").focus();
      }
    }

    function presentaciones(){
      console.log("presentaciones")
      if (validate("selectmedida",1,0)){
        $("#spanselectmedida").html("");
        console.log("si valido selectmedida");
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
                  title: true,
                  basic:false,
                  maximizable:true,
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
        $("#selectmedida").prop('disabled', true);
        $("#cantidad").prop('disabled', true);
        alertify.genericDialog ($('#categorías')[0]).set('selector', 'input[type="password"]');
        $.get("./?action=addfraction&o=main",
        {
          q:$("#cantidad").val(),
          unit_id: $("#selectmedida").val(),
        },function(data){
          if (data.estado == "true") {
            alertify.success('Se retuvo presentacion principal.');
          }else {
            alertify.error('No se pudo retener presentacion');
          }
        });
        $.get("./?action=presentaciones",function(data){
          $("#categorías").html(data);
        });
      }else{
        $("#switch_left").prop("checked", true);
        $("#spanselectmedida").html("Complete este campo.");
        $( "#selectmedida").focus();
        $("#contentselectmedida").addClass("has-error")
        alertify.error('Complete campo obligatorio antes de definirn otras presentation');
        console.log("no valido");
      }
    }


    function desavilitamedida(){
      $.get("./?action=addfraction&o=is",
      {
        unit_id: $("#selectmedida").val(),
      },function(data){
        if (data.estado == "true") {
          $("#selectmedida").prop('disabled', false);
          $("#cantidad").prop('disabled', false);
        }else {
          $("#cantidad").prop('disabled', true);
        }
        $("#presentaciones").load("./?action=viewpresentation");
        $("#presentacionesresumen").load("./?action=viewpresentation&o=resumido");
      });
    }


    function presentaciones2(){

      console.log("presentation 2")
      alertify.confirm("Otras presentaciones","Se eliminaran las presentaciones definidas, ¿Desea continuar?",
      function(){
        borrarpresentaciones();
        alertify.message('Presentaciones Descartadas');
      },
      function(){
          $("#switch_right").prop("checked", true);
      //  document.pepe.switch_2[1].checked = true;
        presentaciones();
        alertify.error('Cancelado');
      });
    }

function borrarpresentaciones(){
  console.log("borrarpresentaciones")
    $.get("./?action=addfraction&o=borrar",
    {
      q:$("#cantidad").val(),
      unit_id: $("#selectmedida").val(),
    },function(data){
      if (data.estado == "true") {

      }else {
        alertify.error('No se pudo descartar presentacion');
      }
      $("#presentacionesresumen").load("./?action=viewpresentation&o=resumido");
      adeshabx();//avilita formulario
    });
}



    /*para dale estilo al campo tipe file*/
    $('input[type=file]').change(function(){
      var filename = jQuery(this).val().split('\\').pop();
      var idname = jQuery(this).attr('id');
      if (filename == ""){
        console.log('no hay Imagen');
      //  var idpeso = jQuery(this).attr('peso'); // esta linea en para recuperar el peso guardado en el atributo personalizado peso
      $("#imagelabel").removeClass("btn-success");
      $("#imagelabel").removeClass("btn-danger");
      $("#imagelabel").addClass("btn-default");
      $("#imagelabel").html("Seleccionar Imagen");
      $("#spanimagep").html("");
        var pesobyte = 0;
      }else {
        console.log('si hay Imagen');
        var pesobyte = jQuery(this.files[0].size);
        $('#image').attr('peso', pesobyte[0])
        //comprobamos que no pese mas de 2 MB
        if(jQuery(this).attr('peso') > 2097152) {
          $("#imagelabel").removeClass("btn-default");
          $("#imagelabel").removeClass("btn-success");
          $("#imagelabel").addClass("btn-danger");
          $("#imagelabel").html("<i class='fa fa-fw fa-file-image-o'></i>"+filename);
          console.log('Imagen muy pesada');
          $("#spanimagep").html("Imagen muy pesada, no se guardara Imagen.");
    } else {
      $("#imagelabel").removeClass("btn-default");
      $("#imagelabel").removeClass("btn-danger");
      $("#imagelabel").addClass("btn-success");
      $("#imagelabel").html("<i class='fa fa-fw fa-file-image-o'></i>"+filename);
      $("#spanimagep").html("");

    }

      }

      $('#image').attr('peso', pesobyte[0])

      console.log(jQuery(this));
      console.log(filename);
      console.log(idname);
      console.log(pesobyte);

    });

    function categorias(){
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
      alertify.genericDialog ($('#categorías')[0]).set('selector', 'input[type="password"]');
      $.get("./?action=categories",function(data){
        $("#categorías").html(data);
      });
    }
    function categoriasiva(){
      console.log("categorias iva")
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
      alertify.genericDialog ($('#categorías')[0]).set('selector', 'input[type="password"]');
      $.get("./?action=categoriesiva",function(data){
        $("#categorías").html(data);
      });
    }

    function marcas(){
      console.log("marcas")
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
      alertify.genericDialog ($('#categorías')[0]).set('selector', 'input[type="password"]');
      $.get("./?action=trademarks",function(data){
        $("#categorías").html(data);
      });
    }

    function editcategory(id) {
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
      alertify.genericDialog ($('#categorías')[0]).set('selector', 'input[type="text"]');
      $.get("./?action=editcategory",{idc:id},function(data){
        $("#categorías").html(data);
        $("#namec").focus(function(){
          this.select();
        });
        $( "#namec" ).focus();
      });
    }

    function editcategoryiva(id) {
      console.log("editcategoryt "+id+" iva")
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
      alertify.genericDialog ($('#categorías')[0]).set('selector', 'input[type="text"]');
      $.get("./?action=editcategoryiva",{idc:id},function(data){
        $("#categorías").html(data);
        $("#namec").focus(function(){
          this.select();
        });
        $( "#namec" ).focus();
      });
    }

    function editmarca(id) {
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
      alertify.genericDialog ($('#categorías')[0]).set('selector', 'input[type="text"]');
      $.get("./?action=editmarca",{idc:id},function(data){
        $("#categorías").html(data);
        $("#namec").focus(function(){
          this.select();
        });
        $( "#namec" ).focus();
      });
    }

    function updatecategory(){
      console.log("updatecategory");
      if (validate("namec",1,0)){
        console.log("si valido");
        $.post("./?action=updatecategory",
        {
          id:$("#idca").val(),
          name:$("#namec").val(),
          descripcion:$("#descripcionc").val(),
        },function(data){
          if (data.estado == "true") {
            alertify.success('Se actualiso categoría #'+$("#idca").val()+' correctamente');
            recargarcategoria()
            categorias();
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

    function updatecategoryiva(){
      console.log("updatecategory iva");
      if (validate("namec",1,0)){
        $("#contentnamec").removeClass("has-error");
        $("#contentnamec span").html("");
        console.log("si valido name");
        if (validate("descripcionc",1,0)){
          $("#contentporcentajec").removeClass("has-error");
          $("#spanporcentaje").html("");
          console.log("si valido porcentage");
          if (validate("descripcionc",2,50)){
            if (validate("descripcionc",3,0)){
              $.post("./?action=updatecategory",
              {
                id:$("#idca").val(),
                name:$("#namec").val(),
                descripcion:$("#descripcionc").val(),
              },function(data){
                if (data.estado == "true") {
                  alertify.success('Se actualiso categoría #'+$("#idca").val()+' correctamente');
                  recargarcategoria();
                  categorias();
                }else {
                  alertify.error('No se pudo guardar');
                }
              });
            }else {
              $("#contentporcentajec").addClass("has-error");
              $( "#descripcionc" ).focus();
              $("#spanporcentaje").html("No se puede poner impuesto negativo.");
              alertify.error('Ingresa un valor entre 0 y 50.');
              console.log("no valido porcentage muy bajo");
            }
          }else {
            $("#contentporcentajec").addClass("has-error");
            $( "#descripcionc" ).focus();
            $("#spanporcentaje").html("Impuesto exageradamente alto.");
            alertify.error('Ingresa un valor entre 0 y 50.');
            console.log("no valido porcentage muy alto");
          }
        }else {
          $("#contentporcentajec").addClass("has-error");
          $( "#descripcionc" ).focus();
          $("#spanporcentaje").html("Complete este campo.");
          alertify.error('Complete campo obligatorio');
          console.log("no valido porcentage");
        }
      }else {
        $("#contentnamec").addClass("has-error");
        $( "#namec" ).focus();
        $("#contentnamec span").html("Complete este campo.");
        alertify.error('Complete campo obligatorio');
        console.log("no valido");
      }
    }

    function updatemarca(){
      console.log("updatemarca");
      if (validate("namec",1,0)){
        console.log("si valido");
        $.post("./?action=updatemarca",
        {
          id:$("#idca").val(),
          name:$("#namec").val(),
          descripcion:$("#descripcionc").val(),
        },function(data){
          if (data.estado == "true") {
            alertify.success('Se actualiso Marca #'+$("#idca").val()+' correctamente');
            recargarmarca()
            marcas();
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
    function delcategory(id){
      console.log("del category "+id);
      $("body").overhang({
        type: "confirm",
        custom: true, // Establecer personalizado en verdadero
        primary: "#e74c3c", // Tu color primario personalizado
        accent: "#c0392b", // Tu color de acento personalizado
        yesMessage: "Si",
        message: "¿Desea realmente eliminar categoría # "+id+" ?",
        noColor: "#c61200",
        closeConfirm: "true",
        overlay: true,
        overlayColor: "#1B1B1B",
        callback: function (value) {
          if (value){
            console.log("respondio si");
            $.post("./?action=delcategory",
            {
              idc: id,
            },function(data){
              if (data.estado == "true") {
                alertify.success('Se eliminó categoría # '+id+' correctamente');
                recargarcategoria()
                categorias();
              }else {
                alertify.error('No se pudo eliminar categoría');
              }
            });
          }else {
            alertify.error('Eliminación Cancelado por usuario ');
            console.log("respondio no ");
          }
        }
      });
    }

    function delcategoryiva(id){
      console.log("del category "+id);
      $("body").overhang({
        type: "confirm",
        custom: true, // Establecer personalizado en verdadero
        primary: "#e74c3c", // Tu color primario personalizado
        accent: "#c0392b", // Tu color de acento personalizado
        yesMessage: "Si",
        message: "¿Desea realmente eliminar categoría de I.V.A # "+id+" ?",
        noColor: "#c61200",
        closeConfirm: "true",
        overlay: true,
        overlayColor: "#1B1B1B",
        callback: function (value) {
          if (value){
            console.log("respondio si");
            $.post("./?action=delcategoryiva",
            {
              idc: id,
            },function(data){
              if (data.estado == "true") {
                alertify.success('Se eliminó categoría de I.V.A # '+id+' correctamente');
                recargarcategoriaiva()
                categoriasiva();
              }else {
                alertify.error('No se pudo eliminar categoría');
              }
            });
          }else {
            alertify.error('Eliminación Cancelado por usuario ');
            console.log("respondio no ");
          }
        }
      });
    }

    function delmarca(id){
      console.log("del category "+id);
      $("body").overhang({
        type: "confirm",
        custom: true, // Establecer personalizado en verdadero
        primary: "#e74c3c", // Tu color primario personalizado
        accent: "#c0392b", // Tu color de acento personalizado
        yesMessage: "Si",
        message: "¿Desea realmente eliminar categoría # "+id+" ?",
        noColor: "#c61200",
        closeConfirm: "true",
        overlay: true,
        overlayColor: "#1B1B1B",
        callback: function (value) {
          if (value){
            console.log("respondio si");
            $.post("./?action=delmarca",
            {
              idc: id,
            },function(data){
              if (data.estado == "true") {
                alertify.success('Se eliminó marca # '+id+' correctamente');
                recargarmarca();
                marcas();
              }else {
                alertify.error('No se pudo eliminar marca');
              }
            });
          }else {
            alertify.error('Eliminación Cancelado por usuario ');
            console.log("respondio no ");
          }
        }
      });
    }
    //deshabitar el formulario
    function deshab() {
      frm = document.forms['pepe'];
      for(i=0; ele=frm.elements[i]; i++)
      ele.disabled=true;
    }
    // avilita el formulario
    function adeshab() {
      console.log("adeshab Cancelado");
      $('.fondo').removeClass('bg-gray-light');
      $('.bg-white').removeClass('bg-white');
      var elem2 = $('.mostrar');
      elem2.hide();
      var elem3 = $('.mostrar2');
      elem3.hide();
      var elem4 = $('.mostrar3');
      elem4.hide();
      var elem = $('.ocultar');
      elem.fadeIn();
      $(".has-success").removeClass("has-success");
      $("#contentcategory_id").removeClass("has-error");
      $("#contentcategory_id_iva").removeClass("has-error");
      $("#contentnuevacategoria span").html("");
      $("#spanameiva").html("");
      $("#spanporcentajeiva").html("");
      $("#nuevacategoria").val("");
      $("#descriptionc").val("");
      $("#porcentaje").val("");
      $("#nuevoiva").val("");

      alertify.error('Cancelado por usuario ');
      frm = document.forms['pepe'];
      for(i=0; ele=frm.elements[i]; i++){//no lleva ;
        ele.disabled=false
      }
      desavilitamedida();

    }
    //avilita el formulario y borra los mensajes de error
    function adeshabx() {
      console.log("avilita el formulario");
      $('.fondo').removeClass('bg-gray-light');
      $('.bg-white').removeClass('bg-white');
      var elem3 = $('.mostrar2');
      elem3.hide();
      var elem4 = $('.mostrar3');
      elem4.hide();
      var elem = $('.mostrar');
      elem.hide()
      var elem2 = $('.ocultar');
      elem2.fadeIn();
      frm = document.forms['pepe'];
      $("#nuevacategoria").val("");
      $("#descriptionc").val("");
      $("#porcentaje").val("");
      $("#nuevoiva").val("");
      $("#contentcategory_id").removeClass("has-success");
      $("#contentcategory_id").removeClass("has-error");
      $("#contentcategory_id_iva").removeClass("has-error");
      $("#contentcategory_id_iva").removeClass("has-success");
      $("#contentnuevacategoria span").html("");
      $("#spanameiva").html("");
      $("#spanporcentajeiva").html("");
      for(i=0; ele=frm.elements[i]; i++){
        ele.disabled=false;
      }
      desavilitamedida();
    }

    function adeshabCuantos(){
      if (validate("cantidad",1,0)){
        if (validate("cantidad",3,0)){
          if (validate("cantidad",4,0)){
            console.log("si valido todo");
            console.log("avilita formulario");
            $('.fondo').removeClass('bg-gray-light');
            $('.bg-white').removeClass('bg-white');
            $("#contentselectmedida").removeClass("has-error")
            $("#contentselectmedida").addClass("has-success")
            var elem3 = $('.mostrar2');
            elem3.hide();
            var elem4 = $('.mostrar3');
            elem4.hide();
            var elem = $('.mostrar');
            elem.hide()
            var elem2 = $('.ocultar');
            elem2.fadeIn();
            frm = document.forms['pepe'];
            $("#spanmedida").html("");
            for(i=0; ele=frm.elements[i]; i++)
            ele.disabled=false; //avilita el formulario
          }else {
            $("#contentselectmedida").removeClass("has-success")
            $("#contentselectmedida").addClass("has-error")
            $("#spanmedida").html("El valor NO debe ser igual a cero.");
            alertify.error('Complete campo obligatorio');
            console.log("no valido");
            deshab();//DESAVILITA EL FORMULARIO
            $("#contentselectmedida").addClass("has-success");
            $('.fondo').addClass('bg-gray-light');
            $('#bg-white2').addClass('bg-white');
            $("#cantidad").removeAttr("disabled");
            $("#selectmedida").removeAttr("disabled");
            $("#cantidad").focus();
          }
        }else {
          $("#contentselectmedida").removeClass("has-success")
          $("#contentselectmedida").addClass("has-error")
          $("#spanmedida").html("El valor no puede ser negativo.");
          alertify.error('Complete campo obligatorio');
          console.log("no valido es negativo");
          deshab();//DESAVILITA EL FORMULARIO
          $("#contentselectmedida").addClass("has-success");
          $('.fondo').addClass('bg-gray-light');
          $('#bg-white2').addClass('bg-white');
          $("#cantidad").removeAttr("disabled");
          $("#selectmedida").removeAttr("disabled");
          $("#cantidad").focus();
        }
      }else {
        $("#contentselectmedida").removeClass("has-success")
        $("#contentselectmedida").addClass("has-error")
        $("#spanmedida").html("Complete este campo.");
        alertify.error('Complete campo obligatorio');
        console.log("no valido");
        deshab();//DESAVILITA EL FORMULARIO
        $("#contentselectmedida").addClass("has-success");
        $('.fondo').addClass('bg-gray-light');
        $('#bg-white2').addClass('bg-white');
        $("#cantidad").removeAttr("disabled");
        $("#selectmedida").removeAttr("disabled");
        $("#cantidad").focus();
      }
    }

    function newcategory(){
      console.log("newcategory");
      deshab();//DESAVILITA EL FORMULARIO
      $("#contentcategory_id").addClass("has-success");
      $('.fondo').addClass('bg-gray-light');
      $('#bg-white1').addClass('bg-white');
      var elem = $('.ocultar');
      elem.hide();
      var elem2 = $('.mostrar');
      elem2.fadeIn();
      $("#nuevacategoria").removeAttr("disabled");
      $("#descriptionc").removeAttr("disabled");
      $("#nuevacategoria").focus();
      alertify.message('Ingrese nombre da la nueva categoría');
    }
    function newiva(){
      console.log("new iva");
      deshab();//DESAVILITA EL FORMULARIO
      $("#contentcategory_id_iva").addClass("has-success");
      $('.fondo').addClass('bg-gray-light');
      $('#bg-white1').addClass('bg-white');
      var elem = $('.ocultar');
      elem.hide();
      var elem2 = $('.mostrar2');
      elem2.fadeIn();
      $("#nuevoiva").removeAttr("disabled");
      $("#porcentaje ").removeAttr("disabled");
      $("#nuevoiva").focus();
      alertify.message('Ingrese datos de nuevo tipo de IVA');
    }
    function newmarca(){
      console.log("new marca");
      deshab();//DESAVILITA EL FORMULARIO
      $("#contentmarca").addClass("has-success");
      $('.fondo').addClass('bg-gray-light');
      $('#bg-white1').addClass('bg-white');
      var elem = $('.ocultar');
      elem.hide();
      var elem3 = $('.mostrar3');
      elem3.fadeIn();
      $("#nuevamarca").removeAttr("disabled");
      $("#descriptionm ").removeAttr("disabled");
      $("#nuevamarca").focus();
      alertify.message('Ingrese datos de marca');
    }

    function savecategory(){
      console.log("savecategory")
      if (validate("nuevacategoria",1,0)){
        console.log("si valido");
        $.post("./?action=addcategory",
        {
          name:$("#nuevacategoria").val(),
          description:$("#descriptionc").val(),
        },function(data){
          if (data.estado == "true") {
            alertify.success('Se agregó categoría correctamente');
            recargarcategoria();
            adeshabx();
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
    function saveiva(){
      console.log("save iva")
      if (validate("nuevoiva",1,0)){
        console.log("si valido name iva");
        $("#spanameiva").html("");
        if (validate("porcentaje",1,0)){
          if (validate("porcentaje",2,50)){
            if (validate("porcentaje",3,0)){
              console.log("si valido porcentaje");
              $("#spanporcentajeiva").html("");
              $.post("./?action=addiva",
              {
                name:$("#nuevoiva").val(),
                description:$("#porcentaje").val(),
              },function(data){
                if (data.estado == "true") {
                  alertify.success('Se agregó categoría correctamente');
                  recargarcategoriaiva();
                  adeshabx();
                }else {
                  alertify.error('No se pudo categoría producto');
                }
              });
            }else {
              $("#contentcategory_id_iva").removeClass("has-success")
              $("#contentcategory_id_iva").addClass("has-error")
              $("#porcentaje" ).focus();
              $("#spanporcentajeiva").html("No se puede poner impuesto negativo.");
              alertify.error('Ingrese valor más bajo.');
              console.log("Ingrese un valor entre 0 y 50");
            }
          }else {
            $("#contentcategory_id_iva").removeClass("has-success")
            $("#contentcategory_id_iva").addClass("has-error")
            $("#porcentaje" ).focus();
            $("#spanporcentajeiva").html("Impuesto exageradamente alto.");
            alertify.error('Ingrese valor más bajo.');
            console.log("Ingrese un porcentaje bajo de IVA");
          }
        }else {
          $("#contentcategory_id_iva").removeClass("has-success")
          $("#contentcategory_id_iva").addClass("has-error")
          $("#porcentaje" ).focus();
          $("#spanporcentajeiva").html("Complete este campo.");
          alertify.error('Complete campo obligatorio');
          console.log("Ingrese un porcentaje de IVA");
        }
      }else {
        $("#contentcategory_id_iva").removeClass("has-success")
        $("#contentcategory_id_iva").addClass("has-error")
        $("#contentnuevacategoria2").addClass("has-error")

        $("#nuevoiva" ).focus();
        $("#spanameiva").html("Complete este campo.");
        alertify.error('Complete campo obligatorio');
        console.log("no valido name iva");
      }
    }

    function savemarca(){
      console.log("save marca")
      if (validate("nuevamarca",1,0)){
        console.log("si valido name Marca");
        $("#spanamemarca").html("");
        $.post("./?action=addmarca",
        {
          name:$("#nuevamarca").val(),
          description:$("#descriptionm").val(),
        },function(data){
          if (data.estado == "true") {
            alertify.success('Se agregó Marca correctamente');
            recargarmarca();
            adeshabx();
          }else {
            alertify.error('No se pudo guardar maraca producto');
          }
        });
      }else {
        $("#contentmarca").removeClass("has-success")
        $("#contentmarca").addClass("has-error")
        $("#contentnuevacategoria2").addClass("has-error")

        $("#nuevamarca" ).focus();
        $("#spanamemarca").html("Complete este campo.");
        alertify.error('Complete campo obligatorio');
        console.log("no valido name marca");
      }
    }


    function recargarcategoria(){
      console.log("recargarcategoria")
      $('#category_id').children('option:not(:first)').remove();
      $.get("./?action=searchallcategory",
      {
        name:$("#nuevacategoria").val(),
      },function(data){
        data.forEach(function(dat, index){
          $('#category_id').append('<option value="'+dat.id+'">'+dat.name+'</option>');
          $("#category_id [value="+ dat.id +"]").attr("selected",true);
        })
      });
    }
    function recargarcategoriaiva(){
      console.log("recargarcategoria iva")
      $('#category_id_iva').children('option:not(:first)').remove();
      $.get("./?action=searchallcategoryiva",
      {
        name:$("#nuevoiva").val(),
      },function(data){
        data.forEach(function(dat, index){
          $('#category_id_iva').append('<option value="'+dat.id+'">'+dat.name+'  '+dat.porcentage+'%</option>');
          $("#category_id_iva [value="+ dat.id +"]").attr("selected",true);
        })
      });
    }
    function recargarmarca(){
      console.log("recargarmarca")
      $('#trademark').children('option:not(:first)').remove();
      $.get("./?action=searchallmarca",
      {
        name:$("#nuevacategoria").val(),
      },function(data){
        data.forEach(function(dat, index){
          $('#trademark').append('<option value="'+dat.id+'">'+dat.name+'</option>');
          $("#trademark [value="+ dat.id +"]").attr("selected",true);
        })
      });
    }

    function addproduct(){
          console.log("addproduct");
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
          var parametros = new FormData($("#addproduct")[0]);
          $.ajax (
            {
              data:parametros,
              url:"./?action=addproduct",
              type:"POST",
              contentType: false,
              processData: false,
              beforesend: function(){
              },
              success: function(data){
                if (data.estado == "true") {
                  alertify.success('Se guardo product correctamente');
                  $("body").overhang({
                      type: "success",
                      duration: 1,
                      message: "Se guardo product correctamente",
                      callback: function() {
                     $('#myModal').modal('hide');
                      }
                  });
                }else {
                  $("#guardar").prop('disabled', false);
                  alertify.error('No se pudo guardar producto');
                }
              }
            }
          )
          }else {
            $("#guardar").prop('disabled', false);
          //alertify.error('Complete campo obligatorio');
            console.log("No valido formulario");
          }
          $('.money').mask('000.000.000,00', {reverse: true});
    }
function validaformulario(){

  if (validate("codigo",6,255,0)){
      $("#spancodigop").html("");
      $("#contenedorcodigo").removeClass("has-error")
  }else {
    $("#contenedorcodigo").addClass("has-error")
    $("#codigo" ).focus();
    $("#spancodigop").html("Codigo demasiado largo.");
    alertify.error('Codigo demasiado largo, reduzca el Codigo.');
    return false
  }

    if (validate("name",1,10,0)){
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

    if (validate("barcode",6,255,0)){
        $("#spanbarcode").html("");
        $("#contenedorbarcode").removeClass("has-error")
    }else {
      $("#contenedorbarcode").addClass("has-error")
      $("#barcode" ).focus();
      $("#spanbarcode").html("Codigo demasiado largo.");
      alertify.error('Codigo demasiado largo, reduzca el Codigo.');
      return false
    }

    if (validate("description",6,255,0)){
        $("#spandescription").html("");
        $("#contenedordescription").removeClass("has-error")
    }else {
      $("#contenedordescription").addClass("has-error")
      $("#descripcion" ).focus();
      $("#spandescription").html("Descripcion demasiado larga.");
      alertify.error('Descripción demasiado larga, reduzca la Descripción.');
      return false
    }

    if (validate("location",6,255,0)){
        $("#spanlocation").html("");
        $("#contenedorlocation").removeClass("has-error")
    }else {
      $("#contenedorlocation").addClass("has-error")
      $("#location" ).focus();
      $("#spanlocation").html("Ubicación demasiado larga.");
      alertify.error('Ubicación demasiado larga, reduzca la Ubicación.');
      return false
    }

  if (validate("selectmedida",1,0,0)){
    $("#spanselectmedida").html("");
    $("#contentselectmedida").removeClass("has-error")
    }else {
      $("#contentselectmedida").addClass("has-error")
      $("#selectmedida" ).focus();
      $("#spanselectmedida").html("Complete este campo.");
      alertify.error('Complete campo obligatorios');
      return false
    }

    if (validate("selectmedida",1,0,0)){
      $("#spanselectmedida").html("");
      $("#contentselectmedida").removeClass("has-error")
      }else {
        $("#contentselectmedida").addClass("has-error")
        $("#selectmedida" ).focus();
        $("#spanselectmedida").html("Complete este campo.");
        alertify.error('Complete campo obligatorios');
        return false
      }

      if (validate("price_in",1,0,0)){
        $("#spanprice_in").html("");
        $("#contenedorpricce_in").removeClass("has-error")
        }else {
          $("#contenedorpricce_in").addClass("has-error")
          $("#price_in" ).focus();
          $("#spanprice_in").html("Complete este campo.");
          alertify.error('Complete campo obligatorios');
          return false
        }
        id = $('#price_in').cleanVal() *1;
        if (validate(id,3,1,1)){
          $("#spanprice_in").html("");
          $("#contenedorpricce_in").removeClass("has-error")
          }else {
            $("#contenedorpricce_in").addClass("has-error")
            $("#price_in" ).focus();
            $("#spanprice_in").html("No puede se cero ni negativo.");
            alertify.error('No puede se cero ni negativo.');
            return false
          }

        if (validate("price_out",1,0,0)){
          $("#spanprice_out").html("");
          $("#contenedorpricce_out").removeClass("has-error")
          }else {
            $("#contenedorpricce_out").addClass("has-error")
            $("#price_out" ).focus();
            $("#spanprice_out").html("Complete este campo.");
            alertify.error('Complete campo obligatorios');
            return false
          }
          id = $('#price_out').cleanVal() * 1;
          if (validate(id,3,1,1)){
            $("#spanprice_out").html("");
            $("#contenedorpricce_out").removeClass("has-error")
            }else {
              $("#contenedorpricce_out").addClass("has-error")
              $("#price_out" ).focus();
              $("#spanprice_out").html("No puede se cero ni negativo");
              alertify.error('Complete campo obligatorios');
              return false
            }
            //si no se multiplica por uno no lo detecta como numerico devido a que el campo es un campo de texto
            id = $('#price_out').cleanVal() * 1;
            id2 = $('#price_in').cleanVal() * 1;
            if (validate(id,3,id2,1)){
              $("#spanprice_out").html("");
              $("#contenedorpricce_out").removeClass("has-error")
              }else {
                $("#contenedorpricce_out").addClass("has-error")
                $("#price_out" ).focus();
                $("#spanprice_out").html("El Precio de venta No puede ser menor al Costo");
                alertify.error('Complete campo obligatorios');
                return false
              }
    return true;
}
function alertdecontrol_stock(){
  console.log("alertdecontrol_stock()");
  if ($('#control_stock').prop('checked')) {
    alertify.error('AL no  controlar stock, el sistema no tendrá en cuenta la disponibilidad del producto.');
  }else {
      alertify.success('se activo control de stock');
  }
}

function divide_stock(){
  console.log("divide_stock()");
  if ($('#divide').prop('checked')) {
    alertify.error('Permitir fraccionar se ha activado ');
  }else {
      alertify.success('Permitir fraccionar se ha desactivado ');
  }
}


    $(document).ready(function(){
      borrarpresentaciones();
    })
    </script>
