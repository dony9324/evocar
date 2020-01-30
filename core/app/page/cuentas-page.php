<section class="content-header">
  <h1><i class="fa fa-tasks"></i>Cuentas <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="#" onClick="changerview('./?page=home')"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#" onClick="changerview('./?page=cuentas')">Cuentas</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Cuentas</h3>
          <div class="btn-group pull-right">
            <button type="button" id="btnnewcuenta" onclick="newcuenta()" class="btn btn-default"><i class="fa  fa-plus"></i> Nueva cuenta</button>
            <div class="btn-group pull-right">
              <?php $u=null;
              if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
                $u = UserData::getById($_SESSION["user_id"]);
                if($u->is_admin):?>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-download"></i> Descargar <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="report/cuentas-word.php">Word 2007 (.docx)</a></li>
                </ul>
              <?php endif; ?>  <?php endif; ?>
            </div>
          </div>
        </div>
        <div id="newcuenta"> </div>
        <script>
        //esta funcion carga el formulario para guardar un nuevo Cuenta
        function newcuenta(){
          //estalinea es por un error de doble ventana he impide que se abra dosveces el modal
          $("#btnnewcuenta").prop('disabled', true);
          console.log("nuevo Cuenta")
          $.get("./?action=newcuenta",function(data){
            $("#newcuenta").html(data);
            $('#myModal').modal('show');
            $("#btnnewcuenta").prop('disabled', false);
          });
        }
        </script>
        <!-- /.box-header -->
        <div class="box-body">
          <?php
          $users = CuentasData::getAll();
          $todos_los_ingersos=0;
          $todos_los_egresos=0;
          $todo_los_saldos=0;
          $todo_los_saldos_iniciales=0;
          if(count($users)>0){
            // si hay usuarios
            ?>
            <table style="width:100%;" id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Saldo inicial</th>
                  <th>Ingresos</th>
                  <th>Egresos</th>
                  <th>Saldo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php


                foreach($users as $user){
                  $ingresos = 0;
                  $egresos = 0;
                  $total_saldo = 0;
                  ?>
                  <tr>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo number_format($user->saldo_inicial,2,',','.'); $total_saldo += $user->saldo_inicial; $todo_los_saldos_iniciales += $user->saldo_inicial; $todo_los_saldos+= $user->saldo_inicial; ?></td>

                    <?php
                    $transacciones = TransaccionesData::getAllByCuentaId($user->id);
                    foreach($transacciones as $transaccione){
                      if ($transaccione->type==1) {
                          $todos_los_egresos -= $transaccione->money;
                         $egresos -= $transaccione->money;
                         $total_saldo -= $transaccione->money;
                         $todo_los_saldos -= $transaccione->money;
                       }else if ($transaccione->type==2) {
                          $total_saldo += $transaccione->money;
                          $ingresos += $transaccione->money;
                          $todos_los_ingersos += $transaccione->money;
                          $todo_los_saldos += $transaccione->money;
                        }
                      } ?>
                    <td <?php echo "class='success'";?>> <?php echo number_format($ingresos/100,2,',','.');?></td>
                    <td <?php echo "class='danger'";?>> <?php echo number_format($egresos/100,2,',','.');?> </td>
                    <td><?php echo number_format($total_saldo/100,2,',','.');?></td>
                    <td style="width:130px;">
                      <?php
                      $u=null;
                      if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
                        $u = UserData::getById($_SESSION["user_id"]);?>
                        <?php if($u->is_admin):?>
                          <a id="btneditcuenta<?php echo $user->id;?>" href="#" onclick="editcuenta(<?php echo $user->id;?>)" class="btn btn-warning btn-xs">Editar</a>
                          <a id="btnvercuenta<?php echo $user->id;?>" href="#" onclick="vercuenta(<?php echo $user->id;?>)" class="btn btn-info btn-xs">Ver</a>
                        <?php endif;?> <?php endif;?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Saldo inicial</th>
                    <th>Ingresos</th>
                    <th>Egresos</th>
                    <th>Saldo</th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
              <?php
            }else{
              echo "<p class='alert alert-danger'>No hay cuentas</p>";
            }
            ?>
          </div>


          <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"></span>
                    <h5 class="description-header">$<?php echo number_format($todo_los_saldos_iniciales/100,2,',','.');?></h5>
                    <span class="description-text">BALANCES INICIALES</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"></span>
                    <h5 class="description-header">$<?php echo number_format($todos_los_ingersos/100,2,',','.');?></h5>
                    <span class="description-text">TOTAL INGRESOS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"></span>
                    <h5 class="description-header">$<?php echo number_format($todos_los_egresos/100,2,',','.');?></h5>
                    <span class="description-text">TOTAL EGRESOS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"></span>
                    <h5 class="description-header">$<?php echo number_format($todo_los_saldos/100,2,',','.');?></h5>
                    <span class="description-text">TOTAL BALANCE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>



        </div>
        <?php foreach($users as $user){ ?>
            <div id="ver<?php echo $user->id;?>"></div>
        <?php } ?>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <script>
  $("#nav li").removeClass("active");
  $("#cuentas").last().addClass("active");
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
function editcuenta(id) {
  console.log("editcuenta "+id);
  $("#btneditcuenta"+id).prop('disabled', true);
  $.get("./?action=editcuenta&id="+id,function(data){
    $("#newcuenta").html(data);
    $('#myModal').modal('show');
    $("#btneditcuenta"+id).prop('disabled', false);
  });
}
function vercuenta(id) {
  console.log("vercuenta "+id);
  $("#btnvercuenta"+id).prop('disabled', true);
  $.get("./?action=vercuenta&id="+id,function(data){
    $("#ver"+id).html(data);
    //$(window).scrollTop($('#ver'+id).offset().top);
    $("html, body").delay(200).animate({
    scrollTop: $('#ver'+id).offset().top
}, 2000);
    $("#btnvercuenta"+id).prop('disabled', false);
  });
}
</script>
