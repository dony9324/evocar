  <?php $cuenta = CuentasData::getById($_GET["id"]);
$ingresos = 0;
$egresos = 0;
$total_saldo = 0;
  ?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Cuentas: <?php echo $cuenta->name;  ?></h3>
    <div class="btn-group pull-right">
      <button type="button" id="btnnewTransaccion " onclick="newTransaccion()" class="btn btn-default"><i class="fa  fa-plus"></i> Nueva Transaccion </button>
      <div class="btn-group pull-right">
        <?php $u=null;
        if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
          $u = UserData::getById($_SESSION["user_id"]);
          if($u->is_admin):?>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-download"></i> Descargar <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="report/Transaccion s-word.php">Word 2007 (.docx)</a></li>
          </ul>
        <?php endif; ?>  <?php endif; ?>
      </div>
    </div>
  </div>


  <script>
  //esta funcion carga el formulario para guardar un nuevo Cuenta
  function newTransaccion(){
    //estalinea es por un error de doble ventana he impide que se abra dosveces el modal
    $("#btnnewTransacción").prop('disabled', true);
    console.log("nuevo Cuenta")
    $.get("./?action=newTransaccion&id=<?php echo $_GET["id"]; ?>",function(data){
      $("#newcuenta").html(data);
      $('#myModal').modal('show');
      $("#btnnewTransacción").prop('disabled', false);
    });
  }
  </script>
  <!-- /.box-header -->
  <div class="box-body">
    <?php
    $transacciones = TransaccionesData::getAllByCuentaId($_GET["id"]);

    if(count($transacciones)>0){
      // si hay usuarios
      ?>
      <table style="width:100%;" id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Fecha</th>
            <th></th>
            <th>Saldo inicial <?php echo "<b>".$cuenta->saldo_inicial."</b>";
            $total_saldo += $cuenta->saldo_inicial;?></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($transacciones as $transaccione){
            ?>
            <tr>
              <td><?php echo $transaccione->created_at; ?></td>
              <td><?php echo $transaccione->person." / ". $transaccione->notas; ?></td>
              <td <?php if ($transaccione->type==1) {echo "class='danger'"; $egresos -= $transaccione->money; $total_saldo -= $transaccione->money; }else if ($transaccione->type==2) { echo "class='success'"; $total_saldo += $transaccione->money; $ingresos += $transaccione->money;} ?> >
                <?php
                if ($transaccione->type==1) {echo "-";}
              echo "<b>". number_format($transaccione->money/100,2,',','.')."</b>"; ?></td>
              <td style="width:130px;">
                <?php
                $u=null;
                if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
                  $u = UserData::getById($_SESSION["user_id"]);?>
                  <?php if($u->is_admin):?>
                    <a id="btneditTransacción<?php echo $transaccione->id;?>" href="#" onclick="editTransacción(<?php echo $transaccione->id;?>)" class="btn btn-warning btn-xs">Editar</a>
                    <a id="btnverTransacción<?php echo $transaccione->id;?>" href="#" onclick="verTransaccion (<?php echo $transaccione->id;?>)" class="btn btn-info btn-xs">Ver</a>
                  <?php endif;?> <?php endif;?>
                </td>
              </tr>
            <?php } ?>

          </tbody>
          <tfoot>
            <tr>
              <th>Fecha</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
        <?php
      }else{
        echo "<p class='alert alert-danger'>No hay Transacciones</p>";
      }
      ?>
    </div>
    <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"></span>
                    <h5 class="description-header">$<?php echo number_format($cuenta->saldo_inicial/100,2,',','.'); ?></h5>
                    <span class="description-text">BALANCE INICIAL</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"></span>
                    <h5 class="description-header">$<?php echo number_format($ingresos/100,2,',','.'); ?></h5>
                    <span class="description-text">TOTAL INGRESOS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"></span>
                    <h5 class="description-header">$<?php echo number_format($egresos/100,2,',','.'); ?></h5>
                    <span class="description-text">TOTAL EGRESOS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"></span>
                    <h5 class="description-header">$<?php echo number_format($total_saldo/100,2,',','.'); ?></h5>
                    <span class="description-text">TOTAL BALANCE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
    <!-- /.box-body -->
  </div>
