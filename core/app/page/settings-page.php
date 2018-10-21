    <section class="content-header">
      <h1>
      <i class="fa fa-cogs"></i>
        Configuracion
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Configuracion</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
     <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Configuracion</h3>

              <div class="box-tools pull-right">
               
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            <?php

$configurations = CompanyData::getAll();

?>

<?php if(count($configurations)>0):?>

<table style="width:100%;" class="table table-bordered">
<thead>
	<th>Clave</th>
	<th>Valor</th>
    <th></th>
</thead>
<?php foreach($configurations as $conf):?>
<tr>
	<td><?php echo $conf->name;?></td>
	<td><?php echo $conf->value;?>	</td>
    <th><a href="index.php?view=editinfo&id=<?php echo $conf->id; ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a></th>
</tr>
<?php endforeach;?>
</table>

<?php endif; ?>
            
            
              <!-- /.col --><!-- /.col -->
              
              
           
            </div>
            <!-- ./box-body -->
            
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
$( "#settings" ).last().addClass( "active" );
</script>