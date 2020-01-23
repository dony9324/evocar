<div id="myModal" class="modal fade in" role="dialog"><!--parte oscura del modal-->
  <div class="modal-dialog modal-lg"> <!-- tamaño del modal-->
    <!-- Modal content-->
    <div  class="box box-success fondo">
      <div class="box-header with-border">
        <?php $bodega = BodegaData::getAlloperation_id($_GET["id"]);
        $operation = OperationData::getById($_GET["id"]);
        $product  = $operation->getProduct();?>
        <h3 class="box-title">Defina almacenamiento de: # <?php echo $product->id." ".$product->name  ; ?></h3>
        <button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
          <span>×</span></button>
        </div>
          <!-- form start -->
        <form name="pepe" class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data"  id="addalmacenamiento" role="form" >
          <div class="box-body">

    <?php $alternar=true; foreach($bodega as $bode){
      $color=AlmacenamientosData::getById($bode->almacenamiento_id);
      if ($alternar) {
        $alternar=false;
        ?>
        <div class="form-group">
          <div id="contenedorname">
          <label for="name"  class="col-sm-2 control-label"><small class="label label-default <?php echo $color->color; ?>"> <?php echo $color->name; ?></small></label>
          <div class="col-sm-4">
            <input type="text" value="<?php echo $bode->q; ?>"  name="name"  class="form-control" id="name" placeholder="<?php echo $bode->q; ?>" autofocus>
            <span id="spanamep"></span>
          </div>
        </div>
        <?php
        }else {
        $alternar=true;
        ?>
        <div id="contenedornamecorto">
          <label for="name"  class="col-sm-2 control-label"><small class="label label-default <?php echo $color->color; ?>"> <?php echo $color->name; ?></small></label>
          <div class="col-sm-4">
            <label for="name"  class="col-sm-2 control-label"><small class="label label-default <?php echo $color->color; ?>"> <?php echo $color->name; ?></small></label>
            <span id="spannamecorto"></span>
          </div>
          </div>
        </div>

        <?php
      }
      ?>
            <?php
          } if ($alternar==false) {
            echo "</div>";
          }
            ?>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-4">
                  </div>
              <div class="col-sm-offset-2 col-sm-4">
                <button type="button"  class="btn btn-success" id="guardar" onclick="addalmacenamiento();">Guardar Producto</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
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
          $("body").overhang({
              type: "error",
              message: "Imagen muy pesada, no se guardara Imagen.!"
          });
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

    function recargarAlmacenamientos(){
      console.log("recargarAlmacenamientos")
      $('#client_id').children('option:not(:first)').remove();
      $.get("./?action=searchallAlmacenamientos",
      {
        name:$("#name").val(),
      },function(data){
        data.forEach(function(dat, index){
          $('#client_id').append('<option value="'+dat.id+'">'+dat.name+' '+dat.namecorto+'</option>');
          $("#client_id [value="+ dat.id +"]").attr("selected",true);
        })
      });
    }


      function addalmacenamiento(){
          console.log("addalmacenamiento");
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
          var parametros = new FormData($("#addalmacenamiento")[0]);
          $.ajax (
            {
              data:parametros,
              url:"./?action=addalmacenamiento",
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
                  recargarAlmacenamientos();
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

    if (validate("namecorto",6,20,0)){
        $("#spannamecorto").html("");
        $("#contenedornamecorto").removeClass("has-error")
        $("#contenedornamecorto").addClass("has-success")
    }else {
      $("#contenedornamecorto").removeClass("has-success")
      $("#contenedornamecorto").addClass("has-error")
      $("#namecorto" ).focus();
      $("#spannamecorto").html("Nombre corto demasiado largo.");
      alertify.error('Nombre corto demasiado largo, reduzca el nombre.');
      return false
    }


      return true;
}
    </script>
