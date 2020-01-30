<!-- el tres hace referrencia a una venta -->
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
        <form name="pepe" class="form-horizontal" method="post" autocomplete="off" id="actualizarbodega" role="form" >
          <div class="box-body">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

    <?php $alternar=true; foreach($bodega as $bode){
      $color=AlmacenamientosData::getById($bode->almacenamiento_id);
      if ($alternar) {
        $alternar=false;
        ?>
        <div class="form-group">
          <div id="contenedorname">
          <label for="name"  class="col-sm-2 control-label"><small class="label label-default <?php echo $color->color; ?>"> <?php echo $color->name; ?></small></label>
          <div class="col-sm-4">
            <input type="text" value="<?php echo $bode->q; ?>"  name="<?php echo $color->id; ?>"  class="form-control example" id="name<?php echo $color->id; ?>" placeholder="<?php echo $bode->q; ?>" autofocus>
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
            <input type="text" value="<?php echo $bode->q; ?>"  name="<?php echo $color->id; ?>"  class="form-control example" id="name<?php echo $color->id; ?>" placeholder="<?php echo $bode->q; ?>" autofocus>
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
                <button type="button"  class="btn btn-success" id="guardar" onclick="actualizarbodega();">Guardar</button>
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
    $('.example').mask('0#');

      function actualizarbodega(){
          console.log("actualizarbodega");
            $("#guardar").prop('disabled', true);
          if (validaformulario()){
            console.log("si valido formulario");
            $('.money').unmask();//desnmascaran los campos
          frm = document.forms['pepe'];
          for(i=0; ele=frm.elements[i]; i++){
            ele.disabled=false;
          }
          $("#guardar").prop('disabled', true);
          var parametros = new FormData($("#actualizarbodega")[0]);
          $.ajax (
            {
              data:parametros,
              url:"./?action=actualizarbodega",
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
                  setTimeout(function(){  console.log("recarga almacenamiento"); recargarentregaonesell(); },2000);

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
  frm = document.forms['pepe'];
  var maximo = 0;
    <?php foreach($bodega as $bode){
      echo "maximo = maximo + parseFloat($('#name".$bode->almacenamiento_id."').cleanVal());\n";
    }?>

    console.log("maximo: "+maximo);
if (maximo==<?php echo $operation->q ;?>) {
  return true;
}else if (maximo > <?php echo $operation->q ;?>) {

  alertify.error('No se pudo actualizar Almacenamiento, la cantidad almacenada supero lo reabastecido.');
      return false;
} else if (maximo < <?php echo $operation->q ;?>) {
  alertify.error('No se pudo actualizar Almacenamiento, la cantidad almacenada debe ser igual a lo reabastecido.');
      return false;
}

}
    </script>
