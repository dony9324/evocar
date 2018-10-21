<?php
if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]!=""){
		print "<script>window.location='index.php?view=home';</script>";
}
?>
<div class="row " style="  position :relative ; left: 30% ;">
    	<div class="col-sm-5 ">
          <p>&nbsp;</p>
    	<?php if(isset($_COOKIE['password_updated'])):?>
    		<div class="alert alert-success text-center">
    		<p><i class='glyphicon glyphicon-off'></i> Se ha cambiado la contraseña exitosamente !!</p>
    		<p>Pruebe iniciar sesion con su nueva contraseña.</p>
    		</div>
    	<?php setcookie("password_updated","",time()-18600);
    	 endif;
		 $base = new Database();
$con = $base->connect();
 $sql = "select * from user where status=1";
 $query = $con->query($sql);
		  ?>
              <div class="box box-solid box-info ">
                <div class="box-header with-border alert alert-info text-center">
                  <h4 class="box-title">Ingresar</h4>
               </div>
              <!-- /.box-header -->
                <div class="box-body no-padding">
                <div class="center-block">
                  <ul class="users-list clearfix">
                  <?php while($r = $query->fetch_array()){ ?>
                    <li data-toggle="modal" data-target="#myModal<?php echo $r['id'];?>">
                      <img src="res/img/<?php echo $r['image'];if($r['image']==''):echo'sin-imagen.jpg';endif;?>" alt="User Image">
                      <a class="users-list-name"><?php echo $r['name']; ?></a>
                      <span class="users-list-date"><?php echo $r['lastname']; ?></span>
                    </li>
                    <!-- Modal -->
                    <div id="myModal<?php echo $r['id'];?>" class="modal fade" role="dialog" style="vertical-align:central;">
 <div class="modal-dialog" style="width: 270px;">
<ul class="nav navbar-nav">
                   <li class="dropdown user user-menu open">
            <!-- Menu Toggle Button -->
            <ul class="dropdown-menu main-header bg-black">
              <!-- The user image in the menu -->
              <li class="user-header">
                <p>
                <small>Ingresar como:</small>
                <?php echo $r['name'];?>  <?php echo $r['lastname'];?>
                </p>
							 </br>
               <div style="width:90%;" class="lockscreen-item">

    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="res/img/<?php echo $r['image']; if($r['image']==''): echo 'sin-imagen.jpg'; endif; ?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->
    <!-- lockscreen credentials (contains the form) -->
    <form id="loginForm<?php echo $r['id'];?>" class="lockscreen-credentials" method="post" action="./?action=access&o=login" autocomplete="off">
      <div class="input-group">
        <input type="password" id="pas<?php echo $r['id'];?>" class="form-control"  placeholder="Contraseña" name="password" autofocus required>
		<input class="form-control" placeholder="Usuario" name="username" type="hidden" value="<?php echo $r['username'];?>">
        <div class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->
  </div>
              </li>
              <!-- Menu Body -->
							<div id="barra<?php echo $r['id'];?>">

							</div>
            </ul>
          </li>

        </ul>
  </div>
</div>
<script>
$(document).ready(function() {
 /*cactura el evento del formulario */
    $("#loginForm<?php echo $r['id'];?>").bind("submit", function() {
 +
        $.ajax({
			/*cacturamos el metodo*/
            type: $(this).attr("method"),
			/**/
            url: $(this).attr("action"),
            data: $(this).serialize(),
            beforeSend: function() {
                $("#barra<?php echo $r['id'];?>").html("	<div class='progress active'><div class='progress-bar progress-bar-success progress-bar-striped' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>	</div></div>");
                $("#loginForm<?php echo $r['id'];?> button[type=submit]").attr("disabled", "disabled");
							$("#loginForm<?php echo $r['id'];?> button[type=submit]").html("<i class='fa fa-ban text-muted'></i>");
            },
            success: function(response) {
                if (response.estado == "true") {
                    $("body").overhang({
                        type: "success",
												duration: 1,
                        message: "Contraseña correcta , te estamos redirigiendo...",
                        callback: function() {
                        window.location.href = "./?view=home";
                        }
                    });
                } else {
                    $("body").overhang({
                        type: "error",
                        message: "Contraseña incorrecta, intenta nuevamente!"
                    });

                }
                $("#barra<?php echo $r['id'];?>").html("");
                $("#loginForm<?php echo $r['id'];?> button[type=submit]").removeAttr("disabled");
								$("#loginForm<?php echo $r['id'];?> button[type=submit]").html("<i class='fa fa-arrow-right text-muted'></i>");
								$("#pas<?php echo $r['id'];?>").val('');
            },
            error: function() {
                $("body").overhang({
                    type: "error",
                     message: "ERROR, intenta nuevamente!"
                });
								$("#barra<?php echo $r['id'];?>").html("");
                $("#loginForm<?php echo $r['id'];?> button[type=submit]").removeAttr("disabled");
								$("#loginForm<?php echo $r['id'];?> button[type=submit]").html("<i class='fa fa-arrow-right text-muted'></i>");
								$("#pas<?php echo $r['id'];?>").val('');
            }
        });
/*cansela el envio del formulario*/
        return false;
    });
});
</script>
          <?php } ?>
                  </ul>
                  </div>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="text-center alert alert-info">
                  <h4>Pulsa sobre tu usuario</h4>
                </div>
                <!-- /.box-footer -->
              </div>
		</div>
	</div>
