<?php if(!isset($_SESSION["user_id"])){
      Core::redir("./");
}?>

<section class="content-header">
  <h1>
  <i class="fa fa-home"></i>
    Inicio
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li onclick="changerview('./?page=home')"><a href=""><i class="fa fa-home"></i> Inicio</a></li>
  </ol>
</section>

<!-- Main content -->
<!--| aquí se muestran datos de bodga |-->
<section class="content container-fluid">
  <script>
  		$.get("./?scritp=bodegainfo",function(data){
  			$("#bodegainfo").html(data);
  		});
  </script>
<div id="bodegainfo">
</div>

<!--grafica ultimas ventas dia mes año|-->
<section class="content container-fluid">
  <script>
  		$.get("./?scritp=graficaultimasventas",function(data){
  			$("#graficaultimasventas").html(data);
  		});
  </script>
<div id="graficaultimasventas">
</div>


<!--menu de la izquierda-->
<script>
$( "#reportes" ).last().removeClass( "menu-open" );
$( "#treeview-menu" ).last().removeClass( "menu-o" );
$("#nav li").removeClass("active");
$( "#home" ).last().addClass( "active" );
</script>
