<?php
if(!isset($_SESSION["user_id"])){
  if(isset($_GET["view"]) && $_GET["view"]!=""){
    Core::redir("./");
  }
}
$us = CompanyData::getById(6);
$skin = $us->value;
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>evocar FB</title>
  <!-- jQuery 3 -->
  <script src = "res/jquery.min.js"> </script>
  <!-- Dile al navegador que responda al ancho de la pantalla -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="res/<?php echo $skin ; ?>/bootstrap/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="res/<?php echo $skin ; ?>/font-awesome/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="res/<?php echo $skin ; ?>/Ionicons/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="res/<?php echo $skin ; ?>/AdminLTE.css">
  <!-- AdminLTE Skins. este archivo tiene los colores de menu es nesesario poner la clse skin al body. -->
  <link rel="stylesheet" href="res/<?php echo $skin ; ?>/skin.css">
  <link rel="stylesheet" href="res/select2.min.css">
  <link rel="stylesheet" href="res/overhang.min.css">
  <link rel="stylesheet" href="res/<?php echo $skin ; ?>/dataTables.bootstrap.min.css">
  <link rel="shortcut icon" href="res/img/favicon.ico" type="image/x-icon">
  <!-- añadir alertas con alertifyjs -->
  <link href="res/alertifyjs/css/alertify.css" rel="stylesheet">
  <link href="res/alertifyjs/css/themes/bootstrap.css"rel="stylesheet">
  <script src="res/alertifyjs/alertify.js"></script>
</head>

<body class="hold-transition skin <?php if(!isset($_SESSION["user_id"])):?> sidebar-collapse<?php else: echo "sidebar-mini"; endif; ?>">
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="./" class="logo">
        <span class="logo-mini"><b>E</b>FB</span>
        <span class="logo-lg"><b>Evocar</b>FB</span>
      </a>
      <!-- barra de arriba -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <?php
        if(isset($_SESSION["user_id"])):
          $u = UserData::getById($_SESSION["user_id"]);
          ?>
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <?php
              $netos = ProductData::getAll();
              $stock=0;
              $spent=0;
              $k=0.00;
              if(count($netos)>0){
                foreach($netos as $neto){
                  $k= OperationData::getQYesF($neto->id);
                  if(($k== 0.00)):
                    $spent+=1;
                  endif;
                  if($k <= ($neto->inventary_min)){
                    $stock+=1;
                  }
                }
              }
              ?>
              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-<?php if($spent>0){ echo "danger"; }else { echo "warning";} ?>"><?php echo $stock; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Tienes <?php echo $stock; ?> notificaciones de inventario</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-battery-quarter text-yellow"></i> <?php echo $stock-$spent; ?> productos con pocas existencias.
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-battery-empty text-red"></i> <?php echo $spent; ?> productos agotados.
                        </a>
                      </li>
                      <!-- end notification -->
                      <li class="text-center text-aqua"><a  href="index.php?view=inventory-alerts">Mas detalle</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <!-- Tasks Menu -->
              <?php

              $sells = SellData::getSells();
              $total_pagado = 0;
              $total_acreditado = 0;
              $total_pagado2 = 0;
              $total_can = 0;
              $notcol=false;
              $silll=true;
              $credits=0;
              $credits2=0;
              if(count($sells)>0){
                foreach($sells as $sell):
                  if ( ($sell->accredit)==1  && ($sell->created_at <= date('Y-m-d',strtotime("-1 month")))){
                    $q= PaymentData::getQYesF($sell->id);
                    $masmes = true;
                    if($q!=0){
                      $credits2+=1;
                      $notcol=true;
                    }
                    if ($q > 0){
                      $Payments = PaymentData::getAllByProductId($sell->id);
                      if(count($Payments)>0 ){
                        foreach($Payments  as $Payment):
                          if ($Payment->created_at> date('Y-m-d',strtotime("-1 month")))
                          {
                            $masmes=false;
                            break;
                          }
                        endforeach;
                      }
                      if($masmes){
                        $credits+=1;
                        $silll=false;
                      }}
                    }
                  endforeach;
                }
                ?>
                <li class="dropdown tasks-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-<?php if($notcol){echo "danger";}else{echo "warning";} ?>"><?php echo $credits; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header"><?php if($silll){echo "No hay Alertas de creditos";}else{ echo "tienes ".$credits." notificaciones de pagos";} ?></li>
                    <li>
                      <!-- Inner menu: contains the tasks -->
                      <ul class="menu">
                        <li><!-- Task item -->
                          <a href="#">
                            <!-- Task title and progress text -->
                            <?php if($silll){echo "No hay Alertas de creditos";}else{ echo "tienes ".$credits." notificaciones de pagos";} ?>

                          </a>
                        </li>
                        <!-- end task item -->
                        <li class="text-center text-aqua"><a  href="index.php?view=payment-alerts">Mas detalle</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="res/img/<?php echo $u->image; ?>" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs"><?php echo $u->name." ".$u->lastname; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                      <img src="res/img/<?php echo $u->image; ?>" class="img-circle" alt="User Image">
                      <p>
                        <?php echo $u->name." ".$u->lastname; ?>
                        <small><?php if ( $u->is_admin) { echo 'Administrador.'; }?></small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                          <i class="fa fa-fw fa-user"></i>Perfil
                        </button>
                      </div>
                      <div class="pull-right">
                        <a href="./?action=access&o=logout" class="btn btn-default btn-flat"> <i class="fa fa-fw fa-power-off"></i>Salir</a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!-- Control Sidebar Toggle Button
                <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->

          </ul>
        </div>
      <?php endif; ?>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul id="nav" class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li id="home" class="active1"><a href="index.php?view=home"><i class="fa fa-home"></i><span>Inicio</span></a></li>
        <li id="sell"><a href="index.php?view=sell"><i class="fa fa-usd"></i><span>Vender</span></a></li>
        <li id="box"><a href="index.php?view=box"><i class="fa fa-cube"></i><span>Caja</span></a></li>
        <li id="credits"><a href="index.php?view=credits"><i class="fa fa-book"></i><span>Creditos</span></a></li>
        <li id="clients"><a href="index.php?view=clients"><i class="fa fa-smile-o"></i><span>Clientes</span></a></li>
        <?php if(isset($_SESSION["user_id"])):  if($u->is_admin):?>
          <li id="providers"><a href="index.php?view=providers"><i class="fa fa-truck"></i><span>Proveedores</span></a></li>
          <li id="inventary"><a href="index.php?view=inventary"><i class="fa fa-tags"></i><span>Inventario</span></a></li>
          <li id="res"><a href="index.php?view=res  view=sells"><i class="fa fa-th-list"></i> Compras y Ventas</a></li>
          <li id=""><a href="#"><i class="fa fa-exchange"></i> Devoluciones</a></li>


          <li id="reportes" class="treeview">
            <a href="#"><i class="fa fa-caret-square-o-down"></i> <span>Estadísticas</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul id="treeview-menu" class="treeview-menu">
              <li id="res"><a href="index.php?view=res  view=sells"><i class="fa fa-th-list"></i> Compras y Ventas</a></li>
            </ul>
          </li>
          <li id="users"><a href="index.php?view=users&o=all"><i class="fa fa-users"></i><span>Usuarios</span></a></li>
          <li id="settings"><a href="index.php?view=settings"><i class="fa fa-cogs"></i><span>Configuracion</span></a></li>
        <?php endif;?><?php endif;?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) MODAL DEL PERFIL-->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Widget: user widget style 1 -->
          <?php if(isset($_SESSION["user_id"])): ?>
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-black" style="height: 120px;">
                <h3 class="widget-user-username"><?php echo $u->name." ".$u->lastname; ?></h3>
                <h5 class="widget-user-desc"><?php if ( $u->is_admin) { echo 'Administrador.'; }?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="res/img/<?php echo $u->image; ?>" alt="User-Avatar">
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="row">
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-9">
                    <form class="form-horizontal" method="post" action="index.php?view=updateuser" role="form" >
                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
                        <div class="col-md-6">
                          <input type="text" name="name" value="<?php echo $u->name;?>" class="form-control" id="nameuser" placeholder="Nombre">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
                        <div class="col-md-6">
                          <input type="text" name="lastname" value="<?php echo $u->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Usuario*</label>
                        <div class="col-md-6">
                          <input type="text" name="username" value="<?php echo $u->username;?>" class="form-control" required id="username" placeholder="Nombre de usuario">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
                        <div class="col-md-6">
                          <a class="btn btn-info" href="index.php?view=configuration">Cambiar</a>
                          <input type="hidden" name="password" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label" >Esta activo</label>
                        <div class="col-md-6">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="is_active" <?php if($u->status){ echo "checked";}?>>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label" >Es administrador</label>
                        <div class="col-md-6">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="is_admin" <?php if($u->is_admin){ echo "checked";}?>>
                            </label>
                          </div>
                        </div>
                      </div>
                      <p class="alert alert-info">* Campos obligatorios</p>
                      <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                          <input type="hidden" name="user_id" value="<?php echo $u->id;?>">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-info">Actualizar Usuario</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.row -->
            </div>
          <?php endif;?>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <!-- /.modal -->
    <div id="page_view">
      <?php
      View::load("login");
      ?>
    </div>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.7 -->
<script src="res/<?php echo $skin ; ?>/bootstrap/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="res/<?php echo $skin ; ?>/adminlte.min.js"></script>
<!-- DataTables -->
<script src="res/<?php echo $skin ; ?>/jquery.dataTables.min.js"></script>
<script src="res/<?php echo $skin ; ?>/dataTables.bootstrap.min.js"></script>
<script src="res/<?php echo $skin ; ?>/Chart.js/Chart.js"></script>
<script src = "res/jquery-ui.min.js"> </script>
<!-- slimscroll -->
<script src = "res/jquery.slimscroll.min.js"> </script>
<script src = "res/select2.full.min.js"> </script>
<script src = "res/overhang.min.js"> </script>


<!--este script hace ajax en el menu de la izquierda -->
<script>
function changerview(ruta){
  console.log("changerview"+ruta)
  elem.hide()
  $.get(ruta,function(data){
    $("#page_view").html(data);
    elem.fadeIn()
  });
}
function validate(id,tipo,m){
  console.log("validate "+id+"que"+tipo);
  total= $('#' + id).val();
  $('#' + id).val(total);
  switch (tipo) {
    case 1:
    if (total == "") {
      return false;
    }else {
      return true;
    }
    break
    case 2:
    if (total > m ) {
      return false;
    }else {
      return true;
    }
    break
    case 3:
    if (total < m ) {
      return false;
    }else {
      return true;
    }
    break
    default:
    document.write("Ese día no existe")
  }
}

$(document).ready(function(){
  var elem = $('#page_view');
  $("#home").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=home",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#sell").on("click",function(e){
    e.preventDefault();
    elem.hide();//ocultar elemento
    $.get("./?page=sell",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
      document.getElementById("product_code").focus();
    });
  });

  $("#box").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=box",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#credits").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=credits",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#clients").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=clients",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#providers").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=providers",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#inventary").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=inventary",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#sells").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=sells",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#reports").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=reports",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#res").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=res",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#users").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=users&o=all",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

  $("#settings").on("click",function(e){
    e.preventDefault();
    elem.hide()
    $.get("./?page=settings",function(data){
      $("#page_view").html(data);
      elem.fadeIn()
    });
  });

});
</script>
<?php
if(isset($_SESSION["user_id"])){ ?>

  <script>
  /////////revisa la secion al cargar la pagina/////////
  $.get("./?action=access&o=logouttime",function(response) {
    if (response.estado == "true") {
      $("body").overhang({
        type: "info",
        message: "Se agotó el tiempo de esta sesión , te estamos redirigiendo...",
        callback: function() {
          window.location.href = "./?view=login";
        }
      });
    } else {
      alertify.success('Bienvenido a Evocar');

    }
  })
  ////////////////////////////revisa la secion cada 30 segundos/////////////////////////////
  $(document).ready(function(){
    var myVar;
    myVar = setInterval(alertFunc, 30000000);
    function alertFunc() {
      $.get("./?action=access&o=logouttime",function(response) {
        if (response.estado == "true") {
          $("body").overhang({
            type: "info",
            message: "Se agotó el tiempo de esta sesión , te estamos redirigiendo...",
            callback: function() {
              window.location.href = "./?view=login";
            }
          });
        }
      })
    }
  });
</script>
<?php } ?>
</body>
</html>