<div id="myModaldetalles" class="modal fade in" role="dialog"><!--parte oscura del modal-->
  <div class="modal-dialog modal-lg"> <!-- tamaño del modal-->
    <!-- Modal content-->
    <div  class="box box-success fondo">
      <div class="box-header with-border">
        <?php  $product = ProductData::getById($_GET["id"]); ?>
        <h3 class="box-title">Detalles de Producto <button class="btn btn-success"><?php echo $_GET["id"];?></button></h3>

        <button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
          <span>×</span></button>
        </div>
        <?php
       $categories = CategoryData::getAll();
        $ivas = IvaData::getAll();
        $marcas = TrademarkData::getAll();
        $units = unitData::getAll();
        if($product!=null){



        ?>

        <!-- form start -->
        <form name="pepe" class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data"  id="addproduct" role="form" >
          <div class="box-body">

            <div class="form-group">
            <label for="codigo"  class="col-sm-2 control-label">Imagen</label>
            <div class="col-sm-4">
              <?php if($product->image!=""){?>
              <img style="width:60px;" src="res/img/<?php echo $product->image;?>" class="" alt="User Image">
                <?php }?>
            </div>
              <div id="contenedorcodigo">
              <label for="codigo"  class="col-sm-2 control-label">Codigo</label>
              <div class="col-sm-4">
                <input type="text"  name="codigo" value="<?php echo $product->extracode; ?>" id="codigo" class="form-control" placeholder="Código extra">
                <span id="spancodigop"></span>
              </div>
            </div>
            </div>

            <div class="form-group">
              <div id="contenedorname">
              <label for="name"  class="col-sm-2 control-label">Nombre*</label>
              <div class="col-sm-4">
                <input type="text"  name="name" value="<?php echo $product->name; ?>" class="form-control" id="name" placeholder="Nombre" autofocus>
                <span id="spanamep"></span>
              </div>
            </div>
            <div id="contenedorbarcode">
              <label for="barcode" class="col-sm-2 control-label">Codigo de Barras</label>
              <div class="col-sm-4">
                <input type="text" required name="barcode"  class="form-control" id="barcode" value="<?php echo $product->barcode; ?>" placeholder="Codigo de Barras del Producto">
                <span id="spanbarcode"></span>
              </div>
              </div>
            </div>

            <div class="form-group">
              <div id="contenedordescription">
              <label for="description" class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-4">
                <input name="description" value="<?php echo $product->description; ?>" required class="form-control"  id="description" placeholder="Descripcion del Producto">
                <span id="spandescription"></span>
              </div>
              </div>
              <div id="contenedorlocation">
              <label for="location" class="col-sm-2 control-label">Ubicación</label>
              <div class="col-sm-4">
                <input type="text" name="location" value="<?php echo $product->location; ?>" required class="form-control" id="location" placeholder="Ubicación del Producto">
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
                      <option value="<?php echo $marca->id;?>" <?php if($product->trademark_id!=null&& $product->trademark_id==$marca->id){ echo "selected";}?>><?php echo $marca->name;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <label class="col-sm-2 control-label">Categoria</label>
                <div class="col-sm-4">
                  <select id="category_id" name="category_id" class="form-control">
                    <option value="">-- NINGUNA --</option>
                    <?php foreach($categories as $category):?>
                      <option value="<?php echo $category->id;?>" <?php if($product->category_id!=null&& $product->category_id==$category->id){ echo "selected";}?>><?php echo $category->name;?></option>
                    <?php endforeach;?>
                  </select>
                </div>


              </div>

              <div id="contentcategory_id_iva" class="form-group">
                <label class="col-sm-2 control-label">Tipo de I.V.A.</label>
                <div class="col-sm-4">
                  <select id="category_id_iva" name="category_id_iva" class="form-control">
                    <option value="">-- General --</option>
                    <?php foreach($ivas as $iva):?>
                      <option value="<?php echo $iva->id;?>" <?php if($product->type_of_iva_id!=null&& $product->type_of_iva_id==$iva->id){ echo "selected";}?>><?php echo $iva->name." ".$iva->porcentage."%"?></option>
                    <?php endforeach;?>
                  </select>
                </div>


               <div id="bg-white2" class="">

              <label class="col-sm-2 control-label">Unidad de medida*</label>
                <div class="col-sm-4">
                  <select id="selectmedida" name="selectmedida" class="form-control">
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
                      ?>" value="<?php echo $unit->id;?>" <?php if($product->unit_id!=null&& $product->unit_id==$unit->id){ echo "selected";}?> > <?php echo $unit->name;?></option>
                    <?php endforeach;?>
                  </select>
                  <span id="spanselectmedida"></span>
                </div>

              </div>

            </div>
            <div class="form-group">
            <label for="cantidad" class="col-sm-2 col-xs-6 control-label">Cantidad</label>
            <div class="col-sm-4">
              <input type="number" id="cantidad" name="cantidad" class="form-control" value="<?php echo $product->cantidad; ?>"  placeholder="Cantidad" autocomplete="off" step="any">
              <span id="spanmedida"></span>
            </div>
          </div>
            <div class="form-group">
              <label for="presentation" class="col-sm-2 col-xs-6 control-label">Otras presentaciones</label>
              <div class="col-sm-4 col-xs-5">
                <div class="switch-field" >
                  <input type="radio" id="otrasleft" name="inpotras2" value="0" <?php if($product->other_presentations==0){ echo "checked='true'";}?>>
                  <label for="otrasleft">No</label>
                  <input type="radio" id="otrasright" name="inpotras2" value="1"  <?php if($product->other_presentations==1){ echo "checked='true'";}?>>
                  <label for="otrasright">Si</label>
                </div>
              </div>
              <div id="presentacionesresumen" class="otraspresentaciones">
              </div>
            </div>
            <div class="form-group">
              <div id="contenedorpricce_in">
              <label for="price_in" class="col-sm-2 control-label">Costo predefinido</label>
              <div class="col-sm-4">
              <input type="text" value="<?php echo $product->price_in; ?>" onchange="validarprice_in();" onkeyup="validarprice_in();" name="price_in" required class="form-control money" id="price_in" placeholder="Precio de entrada">
              <span id="spanprice_in"></span>
              </div>
              </div>
              <div id="contenedorpricce_out">
              <label for="price_out" class="col-sm-2 control-label">Precio predefinido</label>
              <div class="col-sm-4">
              <input type="text" value="<?php echo $product->price_out; ?>" onchange="validarprice_out();" onkeyup="validarprice_out();" name="price_out" required class="form-control money" id="price_out" placeholder="Precio de salida">
              <span id="spanprice_out"></span>
              </div>
              </div>
            </div>
            <?php $preciol=OperationData::getQprice($product->id);//si pones esta linea debajo da un error raro en vez de dar variable no definida da la linia de codigo a lla entendi la mascara deja solo la linea ?>
            <div class="form-group">
              <div id="contenedorpricce_inl">
              <label for="price_inl" class="col-sm-2 control-label">Costo según lote</label>
              <div class="col-sm-4">
              <input type="text" value="<?php echo $preciol["Costo"]; ?>" onchange="validarprice_inl();" onkeyup="validarprice_inl();" name="price_inl" required class="form-control money" id="price_inl" placeholder="Precio de entrada">
              <span id="spanprice_inl"></span>
              </div>
              </div>
              <div id="contenedorpricce_outl">
              <label for="price_outl" class="col-sm-2 control-label">Precio según lote</label>
              <div class="col-sm-4">

              <input type="text" value="<?php echo $preciol["Precio"]; ?>" onchange="validarprice_outl();" onkeyup="validarprice_outl();" name="price_outl" required class="form-control money" id="price_outl" placeholder="Precio de salida">
              <span id="spanprice_outl"></span>
              </div>
              </div>
            </div>
            <div class="form-group">
              <label for="q" class="col-sm-2 control-label">Inventario Disponible</label>
              <div class="col-sm-4">
                <input type="number" min="0" value="<?php echo $preciol["q"]; ?>" step="any" name="q" required class="form-control"  id="q" placeholder="Inventario Disponible" value="0">
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
  function validarprice_outl(){
    NEMEM = $('#price_outl').cleanVal()/100;
    nuu = numeroALetras(NEMEM, {
      plural: '',
      singular: '',
      centPlural: 'CENTAVOS',
      centSingular: 'CENTAVO'
    });
    $("#spanprice_outl").html(nuu);
  }
  function validarprice_inl(){
    NEMEM = $('#price_inl').cleanVal()/100;
    nuu = numeroALetras(NEMEM, {
      plural: 'PESOS',
      singular: 'PESO',
      centPlural: 'CENTAVOS',
      centSingular: 'CENTAVO'
    });
    $("#spanprice_inl").html(nuu);
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

    })
    </script>
  <?php   } ?>
