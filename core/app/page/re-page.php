<section class="content-header">
  <h1><i class="fa  fa-tags"></i>Reabastecer Inventario<small></small></h1>
  <ol class="breadcrumb">
    <li onclick="changerview('./?page=home')" ><a href="#" id="inventaryhome"><i class="fa fa-home"></i> inicio</a></li>
    <li onclick="changerview('./?page=inventary')" class="active"><a id="inventaryinventary" href="#">Inventario</a></li>
    <li onclick="changerview('./?page=re')" class="active"><a id="inventaryre" href="#">Reabastecer</a></li>
  </ol>
</section>
   <!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box with-border">
        <div class="box-body">
  <!--busqueda de productos -->
  	     <div class="col-md-12">
           <div style="height:20px;" class="col-md-12"></div>
  		       <div class="row">
              <form id="searchp" >
  			       <div class="col-md-6">
  				      <input type="text" id="product_code" name="product" class="form-control" autocomplete="off" placeholder="Buscar producto por nombre o por codigo:">
  			       </div>
               <div class="col-md-3" hidden="on">
  			        <button type="submit" class="btn btn-info"></button><!--si quitas el submit no borra al dar enter-->
  			       </div>
              </form>
  			<div class="col-md-6" id="cantidadefectivo" hidden="on">
              <input type="hidden" id="ids" value=""/>
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
                <input type="text"  class="money form-control" id="cantidade"  placeholder="cantidad en efectivo" autocomplete="off" onKeyDown="">
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
  //jQuery.noConflict();
  ////borra al dar enter
  $(document).ready(function(){
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $("#cart").load("./?action=viewcartre")
  	$("#searchp").on("submit",function(e){
  		e.preventDefault();
  	$("#product_code").val("");
  	});
  	///cantidad por valor
  		$("#changer").on("submit",function(e){
  		e.preventDefault();
  		var elem = $('#cantidadefectivo');
  		var din = $("#cantidade").val();
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
  console.log("addtocart"+id)
  $.get("./?action=addtore",
  {
  q:$("#"+id).val(),
  product_id:id
  },function(data){
    if (data.estado == "true") {
    alertify.success('Se agregó producto correctamente');

    }else {
       alertify.error('No se pudo agregar producto');

      }
  $("#cart").load("./?action=viewcartre");
  });}

  function clearre(id) {
  console.log("clearre"+id)
  $.get("./?action=clearre",
  {
  q:$("#"+id).val(),
  product_id:id
  },function(data){
    if (data.estado == "true") {
    alertify.success('Se elimino producto correctamente');

    }else {
       alertify.error('No se pudo Eliminar producto');

      }
  $("#cart").load("./?action=viewcartre");
  });}

  </script>
  <!--mostrar Carrito de compras-->
  <script>
  function viewocartre() {
  $("#cart").load("./?action=viewcartre")
  }
  </script>
  <!--saca un pruducto del Carrito de compras-->
  <script>
  function clearcartre(id) {
  console.log("clearcartre"+id)
  $.get("./?action=clearcartre",
  {
  product_id:id
  },function(data){
  $("#cart").load("./?action=viewcartre")
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
  		elem.slideDown(200)
  		//elem.fadeOut(50)
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
  $( "#inventary" ).last().addClass( "active" );
  </script>
