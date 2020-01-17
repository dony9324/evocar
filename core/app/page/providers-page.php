<section class="content-header">
  <h1>
    <i class='fa fa-truck'></i> Proveedores
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Proveedores</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Proveedores</h3>
          <div class="btn-group pull-right">



				<button type="button" id="btnnewp" onclick="newprovider()" class="btn btn-default"><i class="fa  fa-plus"></i> Nuevo Proveedor</button>
		            <div class="btn-group pull-right">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-download"></i> Descargar <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="report/providers-word.php">Word 2007 (.docx)</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div id="newprovider"> </div>
        <script>
        //esta funcion carga el formulario para guardar un nuevo provider
        function newprovider(){
          //estalinea es por un error de doble ventana he impide que se abra dosveces el modal
          $("#btnnewp").prop('disabled', true);
          console.log("nuevo provider")
          $.get("./?action=newprovider",function(data){
            $("#newprovider").html(data);
            $('#myModal').modal('show');
            $("#btnnewp").prop('disabled', false);
          });
        }
        </script>
        <!-- /.box-header -->
        <div class="box-body">
          <?php

          $users = PersonData::getProviders();
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
                  <th>Email</th>
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
                    <td><?php echo $user->email1; ?></td>
                    <td><?php echo $user->phone1; ?></td>
                    <td><?php echo $user->phone2; ?></td>
                    <td><?php echo $user->company; ?></td>
                    <td><?php echo $user->nit; ?></td>
                    <td style="width:130px;">
                      <a href="index.php?view=editprovider&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
                      <a href="index.php?action=delprovider&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>

                    </td>
                  </tr>
                  <?php

                }
                ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Foto</th>
                  <th>Nombre completo</th>
                  <th>DI</th>
                  <th>Direccion</th>
                  <th>Email</th>
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
            echo "<p class='alert alert-danger'>No hay proveedores</p>";
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
$("#providers").last().addClass("active");
</script>
