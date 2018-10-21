<section class="content-header">
  <h1> <i class='fa fa-tags'></i> Inventario <small></small> </h1>
  <ol class="breadcrumb">
    <li><a><i class="fa fa-home"></i> Inicio</a></li>
    <li><a>Inventario</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Productos</h3>
          <div class="btn-group  pull-right">
            <a class="btn btn-default"><i class="fa fa-refresh"></i> Devoluciones</a>
            <a id="re" class="btn btn-default"><i class="fa fa-refresh"></i> Reabastecer</a>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-tags"></i>  Agregar Producto</button>
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-download"></i> Descargar <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu"><li><a href="report/products-word.php">Word 2007 (.docx)</a></li></ul>
            </div>
          </div>
        </div>
        <!-- Modal2 -->
        <div id="myModal" class="modal fade in" role="dialog">
          <div class="modal-dialog modal-lg"> <!-- tamaño del modal-->
            <!-- Modal content-->
            <div  class="box box-success fondo">
              <div class="box-header with-border">
                <h3 class="box-title">Nuevo Producto</h3>
                <button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                </div>
                <?php $categories = CategoryData::getAll();
                $ivas = IvaData::getAll();
                $marcas = TrademarkData::getAll();
                ?>
                <!-- form start -->
                <form name="pepe" class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data"  id="addproduct" role="form" >
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Imagen</label>
                      <div class="col-sm-4">
                        <label id="imagelabel" for="image" class="col-sm-12 btn btn-default">Seleccionar Imagen</label>
                        <input type="file" name="image" id="image" accept="image/*" >
                      </div>
                      <label for="name"  class="col-sm-2 control-label">Codigo</label>
                      <div class="col-sm-4">
                        <input type="text"  name="Codigo"  class="form-control" placeholder="Código extra">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="name"  class="col-sm-2 control-label">Nombre*</label>
                      <div class="col-sm-4">
                        <input type="text"  name="name"  class="form-control" id="name" placeholder="Nombre" autofocus>
                        <span id="spanamep"></span>
                      </div>
                      <label class="col-sm-2 control-label">Codigo de Barras</label>
                      <div class="col-sm-4">
                        <input type="text" required name="barcode"  class="form-control" id="barcode" placeholder="Codigo de Barras del Producto">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="description" class="col-sm-2 control-label">Descripcion</label>
                      <div class="col-sm-4">
                        <input name="description"  required class="form-control"  id="description" placeholder="Descripcion del Producto">
                      </div>
                      <label for="unit" class="col-sm-2 control-label">Ubicación</label>
                      <div class="col-sm-4">
                        <input type="text" name="unit" required class="form-control" id="unit" placeholder="Ubicación del Producto">
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
                      <label class="col-sm-2 control-label">Unidad de medida</label>
                      <div class="col-sm-4">
                        <select id="selectmedida" name="selectmedida" class="form-control" onChange="medida(this.value)">
                          <option value="">--Seleccione--</option>
                          <option value="0">Unidad</option>
                          <option value="1">Par</option>
                          <option value="2">Docena</option>
                          <option value="3">Caja</option>
                          <option value="4">Paquete</option>
                          <option value="5">Saco</option>
                          <option value="6">Mililitros</option>
                          <option value="7">Litro</option>
                          <option value="8">Metro cúbico</option>
                          <option value="9">Volqueta</option>
                          <option value="10">Gramo</option>
                          <option value="11">Kilogramo</option>
                          <option value="12">Tonelada</option>
                          <option value="13">Metro</option>
                          <option value="14">Centimetro</option>
                          <option value="15">Milíometro</option>
                        </select>
                      </div>
                      <div class="mostrar4" hidden="on">
                        <label id="labelmedida" class=" col-sm-2">tata</label>
                        <div class="col-sm-4">
                          <input type="number" id="cantidad" name="cantidad" class="form-control" onchange="adeshab()"  placeholder="Cantidad" autocomplete="off">
                          <span id="spanmedida"></span>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="presentation" class="col-sm-2 control-label">Otras presentaciones</label>
                      <div class="col-sm-4">
                        <div class="switch-field" onchange="presentaciones()">
                          <input type="radio" id="switch_left" name="switch_2" value="0" checked="">
                          <label for="switch_left">No</label>
                          <input type="radio" id="switch_right" name="switch_2" value="1">
                          <label for="switch_right">Si</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="price_in" class="col-sm-2 control-label">Precio de Costo</label>
                      <div class="col-sm-4">
                        <input type="number" min="0" step="any" name="price_in" required class="form-control" id="price_in" placeholder="Precio de entrada">
                      </div>
                      <label for="price_out" class="col-sm-2 control-label">Precio de Venta</label>
                      <div class="col-sm-4">
                        <input type="number" min="0" step="any"  name="price_out" required class="form-control" id="price_out" placeholder="Precio de salida">
                      </div>
                    </div>
                    <div class="form-group">
                      <p class="col-sm-4"> <input type="checkbox">Pemitir Venta fraccionada</p>
                    </div>
                    <div class="form-group">
                      <label for="q" class="col-sm-2 control-label">Inventario inicial</label>
                      <div class="col-sm-4">
                        <input type="number" min="0" step="any" name="q" required class="form-control"  id="q" placeholder="Inventario inicial" value="0">
                      </div>
                      <p class="col-sm-4"> <input type="checkbox">No controlar stock</p>
                    </div>
                    <div class="form-group">
                      <label for="inventary_min" class="col-sm-2 control-label">Minima en inventario</label>
                      <div class="col-sm-4">
                        <input type="number" min="0" step="any"  name="inventary_min" required  value="5" class="form-control" id="inventary_min" placeholder="Minima en Inventario (Default 10)" >
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-12">
                        <button type="button"  class="btn btn-success" onclick="addproduct();">Guardar Producto</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div id="categorías"></div>
          <script>
          function medida(value){
            console.log("medida "+value);
              var elem2 = $('.mostrar4');
              var mesaje = "";
              var uno = value * 1;
              switch (uno) {
                case 6:
                mesaje = "Cuantos Mililitros";
                break
                case 7:
                mesaje = "Cuantos Litros";
                break
                case 8:
                mesaje = "Cuantos Metros cúbicos";
                break
                case 10:
                mesaje = "Cuantos Gramos";
                break
                case 11:
                mesaje = "Cuantos Kilogramos";
                break
                case 12:
                mesaje = "Cuantos Tonelada";
                break
                case 13:
                mesaje = "Cuantos Metros";
                break
                case 14:
                mesaje = "Cuantos Centimetros";
                break
                case 15:
                mesaje = "Cuantos Milímetros";
                break
                default:
              }

            if (value<=5 || value==9){
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
            $.get("./?action=presentaciones",function(data){
              $("#categorías").html(data);
            });

          }
          /*para dale estilo al campo tipe file*/
          $('input[type=file]').change(function(){
            var filename = jQuery(this).val().split('\\').pop();
            var idname = jQuery(this).attr('id');
            console.log(jQuery(this));
            console.log(filename);
            console.log(idname);
            $("#imagelabel").removeClass("btn-default");
            $("#imagelabel").addClass("btn-success");
            $("#imagelabel").html("<i class='fa fa-fw fa-file-image-o'></i>"+filename);
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

          function deshab() {
            frm = document.forms['pepe'];
            for(i=0; ele=frm.elements[i]; i++)
            ele.disabled=true;
          }
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
            for(i=0; ele=frm.elements[i]; i++)//no lleva ;
            ele.disabled=false
          }

          function adeshabx() {
            console.log("adeshabx guardado");
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
            for(i=0; ele=frm.elements[i]; i++)
            ele.disabled=false;
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
          </script>

          <!-- /.box-header -->
          <div class="box-body">
            <?php

            $products = ProductData::getAll();
            if(count($products)>0){
              // si hay usuarios
              ?>
              <table style="width:100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Costo</th>
                    <th>Precio</th>
                    <th>I.V.A.</th>
                    <th>Minima</th>
                    <th>Activo</th>
                    <th>Disponible</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($products as $product){
                    $q= OperationData::getQYesF($product->id);
                    ?>
                    <tr>
                      <td><?php echo $product->id; ?></td>
                      <td><?php echo $product->barcode; ?></td>
                      <td><?php if($product->image!=""):?><img src="res/img/<?php echo $product->image;?>" style="width:64px;"><?php endif;?></td>
                      <td><?php echo $product->name; ?></td>
                      <td>$ <?php echo number_format($product->price_in,2,'.',','); ?></td>
                      <td>$ <?php echo number_format($product->price_out,2,'.',','); ?></td>
                      <td><?php if($product->category_id!=null && $product->category_id != 0 ){if(isset($product->getCategory()->name)){
                        echo $product->getCategory()->name;
                      } else { echo "eliminada";}
                    }else{ echo "General"; }  ?></td>
                    <td><?php echo $product->inventary_min; ?></td>
                    <td><?php if($product->is_active): ?><i class="fa fa-check"></i><?php endif;?></td>
                    <td><?php echo $q; ?></td>
                    <td style="width:50px;">
                      <a href="index.php?view=history&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-time"></i> Historial</a>

                      <a href="index.php?view=editproduct&id=<?php echo $product->id; ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                      <?php  $u = UserData::getById($_SESSION["user_id"]); if($u->id == 1 or $u->id ==3 ):?>
                        <a href="index.php?action=delproduct&id=<?php echo $product->id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                      <?php endif;?>
                    </td>
                  </tr>
                  <?php
                }?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Codigo</th>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Costo</th>
                  <th>Precio</th>
                  <th>I.V.A.</th>
                  <th>Minima</th>
                  <th>Activo</th>
                  <th>Disponible</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          <?php  }else{
            echo "<p class='alert alert-danger'>No hay productos</p>";
          }
          ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<script>
$("#nav li").removeClass("active");
$("#inventary").last().addClass("active");
</script>
<!-- el siguente script traduce las tablas. Opcionalmente, puede agregar complementos Slimscroll y FastClick.
Se recomiendan estos dos complementos para mejorar la experiencia de usuario -->
<script>
$(function () {
  $('#example1').DataTable({
    "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  })
})
var elem = $('#page_view');
$("#re").on("click",function(e){
  e.preventDefault();
  elem.hide(50)
  $.get("./?page=re",function(data){
    $("#page_view").html(data);
    elem.fadeIn()
  });
});
</script>
