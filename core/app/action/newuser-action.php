<div id="myModal" class="modal fade in" role="dialog"><!--parte oscura del modal-->
  <div class="modal-dialog modal-lg"> <!-- tamaño del modal-->
    <!-- Modal content-->
    <div  class="box box-success fondo">
      <div class="box-header with-border">
        <h3 class="box-title">Nuevo Usuario</h3>
        <button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
          <span>×</span></button>
        </div>
          <!-- form start -->
        <form name="pepe" class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data"  id="addclient" role="form" >
          <div class="box-body">
          <div class="form-group">
              <label for="image" class="col-sm-2 control-label">Imagen</label>
              <div class="col-sm-4">
                <label  id="imagelabel" for="image" class="col-sm-12 btn btn-default">Seleccionar Imagen</label>
                <input type="file" name="image" id="image" accept="image/*" peso="">
                <span id="spanimagep"></span>
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
            <div id="contenedorlastname">
              <label for="lastname" class="col-sm-2 control-label">Apellido</label>
              <div class="col-sm-4">
                <input type="text"  name="lastname"  class="form-control" id="lastname" placeholder="Apellido">
                <span id="spanlastname"></span>
              </div>
              </div>
            </div>
            <div class="form-group">
              <div id="contenedordescription">
              <label for="description" class="col-sm-2 control-label">Documento</label>
              <div class="col-sm-4">
                <input type="text" name="identity" class="form-control" id="identity" placeholder="Cedula">
                <span id="spandescription"></span>
              </div>
              </div>
              <div id="contenedorlocation">
              <label for="location" class="col-sm-2 control-label">Nombre de usuario*</label>
              <div class="col-sm-4">
                <input type="text" name="username" class="form-control" required id="username" placeholder="Nombre de usuario">
                <span id="spanusername"></span>
              </div>
            </div>
            </div>
            <div class="form-group">
              <div id="contenedordescription">
            									<label for="email1" class="col-sm-2 control-label">Email</label>
            									<div class="col-sm-4">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email">
            									</div>
              </div>
              <div id="contenedorlocation">
            									<label for="phone1" class="col-sm-2 control-label">Telefono</label>
            									<div class="col-sm-4">
            										<input type="text" name="phone1" class="form-control" id="phone1" placeholder="Telefono">
            									</div>
            								</div>
                          </div>
            								<div class="form-group">
            									<label for="inputEmail1" class="col-sm-2 control-label">Telefono 2</label>
            									<div class="col-sm-4">
            										<input type="text" name="phone2" class="form-control" id="phone2" placeholder="Telefono 2">
            									</div>
            									<label for="inputEmail1" class="col-sm-2 control-label">Contraseña</label>
            									<div class="col-sm-4">
            										<input type="password" name="password" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
            									</div>
            								</div>
            								<div class="form-group">
            									<label for="inputEmail1" class="col-sm-2 control-label">Nit</label>
            									<div class="col-sm-4">
            										<input type="text" name="nit" class="form-control" id="nit" placeholder="Nit">
            									</div>
              <div class="col-sm-offset-2 col-sm-4">
                  </div>
              <div class="col-sm-offset-2 col-sm-4">
                <button type="button"  class="btn btn-success" id="guardar" onclick="addclient();">Guardar Producto</button>
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
          $("#spanimagep").html("Imagen muy pesada, no se guardara Imagen");
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

    function recargarclientes(){
      console.log("recargarclientes")
      $('#client_id').children('option:not(:first)').remove();
      $.get("./?action=searchallclientes",
      {
        name:$("#name").val(),
      },function(data){
        data.forEach(function(dat, index){
          $('#client_id').append('<option value="'+dat.id+'">'+dat.name+' '+dat.lastname+'</option>');
          $("#client_id [value="+ dat.id +"]").attr("selected",true);
        })
      });
    }


      function addclient(){
          console.log("addclient");
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
          var parametros = new FormData($("#addclient")[0]);
          $.ajax (
            {
              data:parametros,
              url:"./?action=addclient",
              type:"POST",
              contentType: false,
              processData: false,
              beforesend: function(){
              },
              success: function(data){
                if (data.estado == "true") {
                  alertify.success('Se guardo cliente correctamente');
                  $("body").overhang({
                      type: "success",
                      duration: 1,
                      message: "Se guardo cliente correctamente",
                      callback: function() {
                     $('#myModal').modal('hide');
                      }
                  });
                  recargarclientes();
                }else {
                  $("#guardar").prop('disabled', false);
                  alertify.error('No se pudo guardar cliente');
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
