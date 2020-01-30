<div id="myModal" class="modal fade in" role="dialog"><!--parte oscura del modal-->
  <div class="modal-dialog modal-lg"> <!-- tamaño del modal-->
    <!-- Modal content-->
    <div  class="box box-success fondo">
      <div class="box-header with-border">
        <h3 class="box-title">Nueva Entrega</h3>
        <button id="bclose" type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
          <span>×</span></button>
        </div>
          <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <div id="contenedorname">
              <label for="name"  class="col-sm-2 control-label">Codigo*</label>
              <div class="col-sm-4">
                <input type="number" min="0" id="inpsell" name="inpsell"  class="form-control" placeholder="Codigo de operación" autofocus="on" >
                <span id="spanamep"></span>
              </div>
            </div>


            </div>
                <div class="col-sm-offset-2 col-sm-4">
                </div>
              <div class="col-sm-offset-2 col-sm-4">
                <button type="button"  class="btn btn-success" id="guardar" onclick="buscarsell();">Buscar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>

              <div id="results">
            </div>

          </div>

      </div>
    </div>
  </div>
  <script>
      function buscarsell(){
      console.log("buscar sell");
      	var sell = $("#inpsell").val();
      console.log(sell);
      $.get("./?action=buscarsell",
      {
        id: sell
      },function(data){
        	$("#results").html(data);
      });
    }
  </script>
