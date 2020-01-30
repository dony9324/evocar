<div id="myModal" class="modal fade in" role="dialog"><!--parte oscura del modal-->
  <div class="modal-dialog modal-lg"> <!-- tamaño del modal-->
    <!-- Modal content-->
    <div  class="box box-success fondo">
      <div class="box-header with-border">
        <h3 class="box-title">Nueva Cuenta</h3>
        <button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
          <span>×</span></button>
        </div>
          <!-- form start -->
        <form name="pepe" class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data"  id="addcuenta" role="form" >
          <div class="box-body">
            <div class="form-group">
              <div id="contenedorname">
              <label for="name"  class="col-sm-2 control-label">Nombre*</label>
              <div class="col-sm-4">
                <input type="text"  name="name"  class="form-control" id="name" placeholder="Nombre" autofocus>
                <span id="spanamep"></span>
              </div>
            </div>
            <div id="contenedorname">
            <label for="saldo_inicial"  class="col-sm-2 control-label">Saldo inicial</label>
            <div class="col-sm-4">
              <input type="text" onchange="validasaldo();" onkeyup="validasaldo();"   name="saldo_inicial"  class="form-control money" id="saldo_inicial" placeholder="Saldo inicial" autofocus>
              <span id="spansaldo_inicial"></span>
            </div>
          </div>

            </div>
            <div class="col-sm-offset-7 col-sm-5">
              <button type="button"  class="btn btn-success" id="guardar" onclick="addcuenta();">Guardar Cuenta</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    /*para dale estilo al campo tipe file*/
    function validasaldo(){
      NEMEM = $('#saldo_inicial').cleanVal()/100;
      nuu = numeroALetras(NEMEM, {
        plural: '',
        singular: '',
        centPlural: 'CENTAVOS',
        centSingular: 'CENTAVO'
      });
      $("#spansaldo_inicial").html(nuu);
    }

    jQuery(function($){
      $('.money').mask('000.000.000,00', {reverse: true});
    });

    function recargarcuentas(){
      console.log("recargarcuentas");
      changerview('./?page=cuentas');
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
