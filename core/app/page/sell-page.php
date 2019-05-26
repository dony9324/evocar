<section class="content-header">
  <h1><i class="fa  fa-usd"></i> Vender<small></small></h1>
  <ol class="breadcrumb">
    <li onclick="changerview('./?page=home')"><a href="#"><i class="fa fa-home"></i> inicio</a></li>
    <li onclick="changerview('./?page=sell')" class="active"><a href="#"><i class="fa fa-usd"></i>Vender</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box with-border">
        <div class="box-body">
          <!--busqueda de productos -->
          <div class="col-md-12">
            <div style="height:20px;" class="col-md-12">
            </div>
            <div class="row">
              <form id="searchp" >
                <div class="col-md-6">
                  <!-- 	<input type="hidden" name="view" value="sell">  -->
                  <input type="text" id="product_code" name="product" class="form-control" autocomplete="off" placeholder="Buscar producto por nombre o por codigo:">
                </div>
                <div class="col-md-3" hidden="on">
                  <button type="submit" class="btn btn-info"></button><!--si quitas el submit no borra al dar enter-->
                </div>
              </form>
              <div class="col-md-6" id="cantidadefectivo" hidden="on">
                <input  type="hidden" id="ids" value=""/>
                <a class="btn btn-success" onClick="cangercantidad(0.5)">
                  1/2
                </a>
                <a class="btn btn-success" onClick="cangercantidad(0.25)">
                  1/4
                </a>
                <a class="btn btn-success"  onClick="cangercantidad(0.125)">
                  1/8
                </a>
                <a class="btn btn-success"  onClick="cangercantidad(0.0625)">
                  1/16
                </a>
                <div class="col-xs-4">
                  <form id="changer">
                    <input type="text" class="money form-control" id="cantidade"  placeholder="cantidad en efectivo" autocomplete="ÑÖcompletes"  onKeyDown="">
                    <div class="col-md-3" hidden="on">
                      <button type="submit" class="btn btn-info"></button><!--si quitas el submit no borra al dar enter-->
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div id="show_search_results"></div>
          </div>
          <!--busca al escribir-->
          <script>
          jQuery(function($){
            $('.money').mask('000.000.000,00', {reverse: true});
          });
          //jQuery.noConflict();
          ////borra al dar enter
          $(document).ready(function(){
            $("#cart").load("./?action=viewcart")
            $("#searchp").on("submit",function(e){
              e.preventDefault();
              $("#product_code").val("");
            });
            ///cantidad por valor
            $("#changer").on("submit",function(e){
              e.preventDefault();
              var elem = $('#cantidadefectivo');
              var din = $("#cantidade").cleanVal()*1/100;
              var val = ($('#ids').val());
              var price_out = $("#id"+val).val();
              var total = din / price_out;
              $('#' + val).val(total);

              elem.fadeOut(50)

            });
            ///busca los productos al escribir
            $("#searchp").on("keyup","#product_code",function(e){
              e.preventDefault();
              $.get("./?action=searchproduct",$("#searchp").serialize(),function(data){
                $("#show_search_results").html(data);
              });
            });
          });
        </script>
        <!--añade al Carrito de compras-->
        <script>
        function addtocart(id) {
          $("#btnaddtocar"+id).prop('disabled', true);
          console.log("addtocart"+id)
          //alertify.success('añadiendo a la Lista Producto'+id)
          $.get("./?action=addtocart",
          {
            q:$("#"+id).val(),
            product_id:id
          },function(data){
            if (data.estado == "true") {
              alertify.success('Se agregó producto correctamente');

            }else {
              alertify.error('No se pudo agregar producto');

            }
            $("#cart").load("./?action=viewcart")
          });
          $("#btnaddtocar"+id).prop('disabled', false);
        }
      </script>
      <!--mostrar Carrito de compras-->
      <script>
      function viewocart() {
        $("#cart").load("./?action=viewcart")
      }
    </script>
    <!--saca un pruducto del Carrito de compras-->
    <script>
    function clearcart(id) {
      console.log("clearcart"+id)
      $.get("./?action=clearcart",
      {
        product_id:id
      },function(data){
        if (data.estado == "true") {
          alertify.message('Se elimino producto correctamente');
        }else {
          alertify.error('No se pudo Eliminar producto');
        }
        $("#cart").load("./?action=viewcart")
      });}
    </script>
    <div id="cart"> </div>
  </div>
  <script>
  function mas1(id){
    total= ($('#' + id).val())*1+1;
    $('#' + id).val(total);
  }
  function men1(id){
    total= ($('#' + id).val())*1-1;
    $('#' + id).val(total);
  }
  function changervalor(id){
    //	var micapa = document.getElementById('cantidadefectivo');
    var elem = $('#cantidadefectivo');
    elem.fadeOut(50)
    elem.slideDown(200)
    //
    //$('#' + id).val(5);
    $('#ids').val(id);
    console.log("modificando cantidad"+id)
  }

  function nochangervalor(){
    //	var micapa = document.getElementById('cantidadefectivo');
    var elem = $('#cantidadefectivo');
    //elem.slideDown(200)
    elem.fadeOut(50)
    //$('#' + id).val(5);

    console.log(" no modificando cantidad")
  }



  function cangercantidad(idf){
    var elem = $('#cantidadefectivo');
    //elem.slideDown(500)
    elem.fadeOut(50)
    var val = ($('#ids').val());
    $('#' + val).val(idf);
  }
  function cangercantidad2(idf){
    var elem = $('#cantidadefectivo');
    //elem.slideDown(500)
    elem.fadeOut(50)
    var val = ($('#ids').val());
    $('#' + val).val(idf);
  }
</script>
</div>
</div>
</div>
</section>
<script>
$("#nav li").removeClass("active");
$( "#sell" ).last().addClass( "active" );
</script>
