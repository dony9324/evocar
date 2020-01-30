<section class="content-header">
  <h1><i class='fa fa-check-square'></i>Entregas<small></small></h1>
  <ol class="breadcrumb">
    <li onclick="changerview('./?page=home')"><a href="#"><i class="fa fa-home"></i> inicio</a></li>
  <li class="active"><a href="#" onClick="changerview('./?page=entregas')">Entregas</a></li>
  </ol>
</section>
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Ventas de hoy</h3>

          <div class="box-tools pull-right">
            <button type="button" id="btnnewentrega" onclick="newentrega()" class="btn btn-default"><i class="fa  fa-plus"></i>Nueva Entrega</button>

            <?php $u=null;
            $u = UserData::getById($_SESSION["user_id"]);
            if($u->is_admin):?>
            <a href="./index.php?view=boxhistory" class="btn btn-default"><i class="fa fa-clock-o"></i> ver todas</a>
          <?php endif;?>
        </div>
          <div id="newentrega"> </div>
        <script>
        //esta funcion carga el formulario para guardar un nuevo Devolucion
        function newentrega(){
          //estalinea es por un error de doble ventana he impide que se abra dosveces el modal
          $("#btnnewentrega").prop('disabled', true);
          console.log("nueva Devolucion");
          $.get("./?action=newentrega",function(data){
            $("#newdevolucipn").html(data);
            $('#myModal').modal('show');
            $("#btnnewentrega").prop('disabled', false);
          });
        }
        </script>
      </br>
      <script>
      //esta funcion carga el formulario para guardar un nuevo Devolucion
      function newentrega(){
        //estalinea es por un error de doble ventana he impide que se abra dosveces el modal
        $("#btnnewDevolucion").prop('disabled', true);
        console.log("nueva Devolucion")
        $.get("./?action=newentrega",function(data){
          $("#newentrega").html(data);
          $('#myModal').modal('show');
          $("#btnnewclient").prop('disabled', false);
        });
      }
      </script>

    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <?php

        $products = SellData::getAllByDateOp(date("Y-m-d"),date("Y-m-d"),2);
        if(count($products)>0){
          $total_total = 0;
          ?>


            <table id="example" style="width:100%;" class="table table-condensed">
              <tbody>
              <tr>
                <th>id</th>
                <th>Ver detalles</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Fecha</th>
              </tr>
              <?php foreach($products as $sell):?>
                  <tr class="<?php if($sell->operation_type_id==1){ echo "warning"; } if($sell->operation_type_id==2){echo "info";}?>">
                    <td><?php echo $sell->id; ?></td>
                    <td style="width:130px;"><a href="index.php?view=onesell&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>

                    <?php
                    $operations = OperationData::getAllProductsBySellId($sell->id);

                    ?>

                    <?php
                    $total=0;
                    foreach($operations as $operation){
                      $product  = $operation->getProduct();
                      $total += $operation->q*$product->price_out;
                    }
                    $total_total += $total; ?>
                    <td><?php echo count($operations);?> </td>
                    <td><?php echo "<b>$ ".number_format($total,2,".",",")."</b>";?></td>
                    <td><?php echo $sell->created_at; ?></td>
                  </tr>

                <?php  endforeach; ?>
                <tr>
                  <th>id</th>
                  <th>Ver detalles</th>
                  <th>Productos</th>
                  <th>Total</th>
                  <th>Fecha</th>
                </tr>
              </tbody></table>
              <?php
            }else {

              ?>
              <div class="jumbotron">
                <h2>No hay ventas</h2>
                <p>No se ha realizado ninguna venta.</p>
              </div>

            <?php } ?>


          <!-- /.col -->

          <!-- /.col -->

        <!-- /.row -->
      </div>
      <!-- ./box-body -->
      <div class="box-footer">
        <div class="row">

          <div class="description-block border-right">

            <h5 class="description-header"><?php if (isset($total_total)){echo "$ ".number_format($total_total,2,".",","); }?></h5>
            <span class="description-text">TOTAL</span>
          </div>
          <!-- /.description-block -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->      <!-- /.row -->
</section>
<script>
$("#nav li").removeClass("active");
$( "#entregas" ).last().addClass( "active" );
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
  elem.fadeOut(50)
  $.get("./?page=re",function(data){
    $("#page_view").html(data);
    elem.fadeIn()
  });
});
</script>
