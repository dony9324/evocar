

<section class="content-header">
  <h1><i class='fa fa-files-o'></i> Almacenamientos <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="#" onClick="changerview('./?page=home')"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#" onClick="changerview('./?page=Almacenamientos')"><i class="fa fa-files-o"></i>Almacenamientos</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Almacenamientos</h3>
          <div class="btn-group pull-right">
            <button type="button" id="btnnewalmacenamiento" onclick="newalmacenamiento()" class="btn btn-default"><i class="fa  fa-plus"></i> Nuevo Almacenamiento</button>
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" disabled="true">
                <i class="fa fa-download"></i> Descargar <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="report/Almacenamientos-word.php">Word 2007 (.docx)</a></li>
              </ul>
            </div>
          </div>

        <div id="newalmacenamiento"> </div>
            <script>
            //esta funcion carga el formulario para guardar un nuevo Cliente
            function newalmacenamiento(){
              //estalinea es por un error de doble ventana he impide que se abra dosveces el modal
              $("#btnnewalmacenamiento").prop('disabled', true);
              console.log("nuevo Almacenamiento")
              $.get("./?action=newalmacenamiento",function(data){
                $("#newalmacenamiento").html(data);
                $('#myModal').modal('show');
                $("#btnnewalmacenamiento").prop('disabled', false);
              });
            }
          </script>


        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php

          //	$users = AlmacenamientosData::getAll();
          $users = AlmacenamientosData::getAll();
          if(count($users)>0){
            // si hay usuarios
            ?>
            <table style="width:100%;" id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre corto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($users as $user){
                  ?>
                  <tr>
                    <td><?php echo $user->name; ?></td>
                    <td style="width:130px;">
                      <a href="index.php?view=editAlmacenamiento&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Nombre corto</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
            <?php
          }else{
            echo "<p class='alert alert-danger'>No hay Almacenamientos</p>";
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
$("#Almacenamientos").last().addClass("active");
</script>
