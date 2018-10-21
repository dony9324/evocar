<section class="content-header">
      <h1>
        Clientes
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#" onClick="changerview('./?page=home')"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#" onClick="changerview('./?page=clients')">Clientes</a></li>
       </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de Clientes</h3>
              <div class="btn-group pull-right">
	<a href="index.php?view=newclient" class="btn btn-default"><i class='fa fa-smile-o'></i> Nuevo Cliente</a>
<div class="btn-group pull-right">
  <?php $u=null;
if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
  $u = UserData::getById($_SESSION["user_id"]);
  if($u->is_admin):?>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
  
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
  <?php endif; ?>  <?php endif; ?>
</div>
</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php

		$users = PersonData::getClients();
		if(count($users)>0){
			// si hay usuarios
			?>
              <table style="width:100%;" id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Foto</th>
				  <th>Nombre completo</th>
        	       <th>DI</th>
			      <th>Direccion</th>
			 	  <th>Tel</th>
       		      <th>Tel 2</th>
     		      <th>Empresa</th>
      		      <th>Nit</th>
				  <th></th>
                </tr>
                </thead>
                <tbody>
             <?php
			foreach($users as $user){
				?>
				<tr>
                <td><?php if($user->image!=""):?><img src="res/img/<?php echo $user->image;?>" style="width:64px;"><?php endif;?></td>
                <td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->identity; ?></td>
				<td><?php echo $user->address1; ?></td>
				<td><?php echo $user->phone1; ?></td>
                <td><?php echo $user->phone2; ?></td>
                <td><?php echo $user->company; ?></td>
                <td><?php echo $user->nit; ?></td>
				<td style="width:130px;">
                <?php 
                $u=null;
if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""):
  $u = UserData::getById($_SESSION["user_id"]);?>
  <?php if($u->is_admin):?>
				<a href="index.php?view=editclient&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?action=delclient&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
				 <?php endif;?> <?php endif;?>
                </td>
				</tr>
				 <?php } ?>
            
                </tbody>
                <tfoot>
                <tr>
                  <th>Foto</th>
				  <th>Nombre completo</th>
        	       <th>DI</th>
			      <th>Direccion</th>
			 	  <th>Tel</th>
       		      <th>Tel 2</th>
     		      <th>Empresa</th>
      		      <th>Nit</th>
				  <th></th>
                </tr>
               
                </tfoot>
              </table>
              <?php

			}else{
			echo "<p class='alert alert-danger'>No hay clientes</p>";
		}

?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<script>
$("#nav li").removeClass("active"); 
$("#clients").last().addClass("active");
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
