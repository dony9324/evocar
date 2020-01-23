<section class="content-header">
  <h1><i class="fa  fa-tags"></i>Reabastecer Inventario<small></small></h1>
  <ol class="breadcrumb">
    <li onclick="changerview('./?page=home')"><a href="#" id="inventaryhome"><i class="fa fa-home"></i> inicio</a></li>
    <li onclick="changerview('./?page=inventary')" class="active"><a id="inventaryinventary" href="#">Inventario</a></li>
    <li onclick="changerview('./?page=re')" class="active"><a id="inventaryre" href="#">Reabastecer</a></li>
    <li onclick="changerview('./?page=onere&id=<?php echo $_GET["id"] ?>')"  class="active"><a id="Resumenre;" href="#">Resumen de Reabastecer</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
          <h3 class="box-title">Resumen de Reabastecimiento</h3>
          <div class="btn-group  pull-right">
            <div class="btn-group pull-right">
              <a class="btn btn-default"><i class="fa fa-refresh"></i> Imprimir</a>
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-download"></i> Descargar <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="report/onere-word.php?id=<?php echo $_GET["id"];?>">Word 2007 (.docx)</a></li>
              </ul>
            </div>
          </div>
          <ul class="nav nav-pills nav-stacked">
            <?php
            $sell = SellData::getById($_GET["id"]);
            $operations = OperationData::getAllProductsBySellId($_GET["id"]);
            $total = 0;
             if($sell->person_id!=""){
            $client = $sell->getPerson();
            ?>
          </br>
            <li>Proveedor: <b><?php echo $client->name." ".$client->lastname;?>              </b>
            </li>
            <?php } ?>
        <?php if($sell->user_id!=""){
          $user = $sell->getUser();
        ?>
        </br>
        <li>Generado por: <b><?php echo $user->name." ".$user->lastname;?></b>
          </li>
        <?php } ?>
          </ul>


        </div>
        <?php if(isset($_GET["id"]) && $_GET["id"]!=""){?>
        <?php
        if(isset($_COOKIE["selled"])){
        	foreach ($operations as $operation) {
        //		print_r($operation);
        		$qx = OperationData::getQYesF($operation->product_id);
        		// print "qx=$qx";
        			$p = $operation->getProduct();
        		if($qx==0){
        			echo "<p class='alert alert-danger'>El producto <b style='text-transform:uppercase;'> $p->name</b> no tiene existencias en inventario.</p>";
        		}else if($qx<=$p->inventary_min/2){
        			echo "<p class='alert alert-danger'>El producto <b style='text-transform:uppercase;'> $p->name</b> tiene muy pocas existencias en inventario.</p>";
        		}else if($qx<=$p->inventary_min){
        			echo "<p class='alert alert-warning'>El producto <b style='text-transform:uppercase;'> $p->name</b> tiene pocas existencias en inventario.</p>";
        		}
        	}
        	setcookie("selled","",time()-18600);
        }
        ?>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-hover">
                <thead>
                  <th>Nombre del Producto</th>
                  <th>Codigo</th>
              		<th>Cantidad</th>
              		<th>Precio Unitario</th>
                  <th>Precio de compra</th>
              		<th>Total</th>
                </thead>
              <tbody>
                <?php
                	foreach($operations as $operation){
                  	$product  = $operation->getProduct();
                  ?>
                  <tr>
                    <td><?php echo $product->name ;?></td>
                  	<td><?php echo $product->id ;?></td>
                  	<td><?php echo $operation->q ;?></td>
                  	<td>$ <?php echo number_format($product->price_in,2,".",",") ;?></td>
                  	<td><b>$ <?php echo number_format($operation->q*$product->price_in,2,".",",");$total+=$operation->q*$product->price_in;?></b></td>
                  </tr>
                <?php
              }?>
            </tbody>
            <tfoot>
              <tr>
                <th><h1>Total: $ <?php echo number_format($total,2,'.',','); ?></th>
              </tr>
            </tfoot>
          </table>
          <?php
        ?>
      <?php }else {?>
          501 Internal Error
        <?php } ?>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

<script>
$("#nav li").removeClass("active");
$("#inventary").last().addClass("active");
</script>


<!-- bodegas -->
<div class="box box-primary">
  <div class="box-header ui-sortable-handle">
    <i class="ion ion-clipboard"></i>
    <h3 class="box-title">Defina Almacenamientos</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
    <ul class="todo-list ui-sortable">




      <?php
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
          <div onclick="cambiar(<?php echo $operation->id; ?>)" class="tools">
          <i class="fa fa-edit"></i>
          </div>

        </li>

      <?php
      }?>


    </ul>

  </div>
  <script>
  function cambiar(operation_id){
    console.log("funcion cambiar");
    $.get("./?action=cambiaralmacenamiento",{id: operation_id},function(data){
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
if(isset($_COOKIE['bodega'])) {
  if ($_COOKIE['bodega']==$_GET["id"]) {
?>
<script>
$("body").overhang({
  type: "warn",
  message: "Se ha realizado un reabastecimiento, defina donde se almacenaran los productos.",
  duration: 3,
  overlay: true
});
setTimeout(function(){ console.log("segundo mensaje");

$("body").overhang({
  type: "warn",
  message: "Si no se define los productos serán almacenados en el almacenamiento principal.",
  duration: 3,
  overlay: true
});
}, 3300);
</script>

<?php
  }
}
?>


  </div>
      <!-- /.col -->
    </div>
      <!-- /.row -->
</section>
