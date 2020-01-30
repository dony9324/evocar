
<!-- entregas -->
<div class="box box-primary">
  <div class="box-header ui-sortable-handle">
    <i class="ion ion-clipboard"></i>
    <h3 class="box-title">Defina entregas</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
    <ul class="todo-list ui-sortable">




      <?php
      $operations = OperationData::getAllProductsBySellId($_GET["id"]);
        foreach($operations as $operation){
          $product  = $operation->getProduct();
          $bodega = BodegaData::getAlloperation_id($operation->id);

        ?>
        <li>
          #<?php echo $product->id ;?>
          <input type="checkbox" value="">
          <span class="text"> <?php echo $operation->q ;?> </span> <span class="text"><?php echo $product->name ;?></span>
          <?php foreach($bodega as $bode){
            $color=AlmacenamientosData::getById($bode->almacenamiento_id);
            ?>
          <small class="label label-default <?php echo $color->color; ?>">
          <?php echo $bode->q; ?></small><?php }  ?>
          <?php
          if(isset($_COOKIE['bodega3'])) {//ELTRES HACE REFERENCIA A VENTAS
            if ($_COOKIE['bodega3']==$_GET["id"]) {
          ?>
          <div onclick="cambiar(<?php echo $operation->id; ?>)" class="tools">
          <i class="fa fa-edit"></i>
          </div>
          <?php
        }}?>
        </li>

      <?php
      }?>


    </ul>

  </div>
  <script>
  function cambiar(operation_id){
    console.log("funcion cambiar 3");
    $.get("./?action=cambiaralmacenamiento3",{id: operation_id},function(data){
      $("#cambiar").html(data);
      $('#myModal').modal('show');
    //  $("#btnnewalmacenamiento").prop('disabled', false);
    });
  }
  </script>
  <div id="cambiar"> </div>
  <!-- /.box-body -->
  <div class="box-footer clearfix no-border">
    <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
  </div>
</div>
<script>
/* The todo list plugin */
$('.todo-list').todoList({
  onCheck  : function () {
    window.console.log($(this), 'The element has been checked');
  },
  onUnCheck: function () {
    window.console.log($(this), 'The element has been unchecked');
  }
});
</script>
<?php
if(isset($_COOKIE['bodega3'])) {
  if ($_COOKIE['bodega3']==$_GET["id"]) {
?>
<script>
  alertify.error("Se ha realizado una Venta, defina de donde se entregaran los productos.");
setTimeout(function(){ console.log("segundo mensaje");
  alertify.error('Si no se define los productos serán del almacenamiento principal.');
}, 3300);
</script>
<?php
  }
}
?>
