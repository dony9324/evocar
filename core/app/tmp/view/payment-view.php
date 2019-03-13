
<div class="container-fluid">
 <div class="row">
	<div class="col-md-6">
	<h1>Pagos</h1>
	<p><b>Buscar Credito  codigo:</b></p>
		<form id="searchp" >
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="view" value="payment">
				<input type="number" min="0" id="product_code" name="sell" class="form-control">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
		</div>
		</form>
	</div>
    
    
    <div class="col-md-6">
	<h1>Pagos</h1>
	<p><b>Buscar Cliente nombre, cedula o por codigo :</b></p>
		<form id="searchp2">
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="view" value="payment">
				<input type="text" id="product_code2" name="clients" class="form-control">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
		</div>
		</form>
	</div>
<div id="show_search_results"></div>
<script>
//jQuery.noConflict();

$(document).ready(function(){
	$("#searchp").on("submit",function(e){
		e.preventDefault();
		
		$.get("./?action=searchpayment",$("#searchp").serialize(),function(data){
			$("#show_search_results").html(data);
		});
		$("#product_code").val("");

	});
	});

$(document).ready(function(){
    $("#product_code").keydown(function(e){
        if(e.which==17 || e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })
});
<?php $cara = isset($_SESSION["cart2"]);?>
$(document).ready(function(){
	var cara=<?php echo json_encode($cara);?>;
	
	  m4e = document.getElementById("product_code2");
	   m4e2 = document.getElementById("product_code");
	  if(cara){
	 m4e.disabled = true;
	  m4e2.disabled = true;
	 
//	document.getElementById("product_code").disabled = true;
	 // $("#client_id option[value="+ valor +"]").attr("selected",true);
	  }
   });



$(document).ready(function(){
	$("#searchp2").on("submit",function(e){
		e.preventDefault();
		
			$.get("./?action=searchclients2",$("#searchp2").serialize(),function(data){
			$("#show_search_results").html(data);
		});
		$("#product_code2").val("");

	});
	});

function elegir2(valor){
		
	
			$.get("./?action=searchpayment2",$("#ccc").serialize(),function(data){
			$("#show_search_results").html(data);
		});
}
	





</script>



<?php if(isset($_SESSION["errors"])):?>
<h2>Errores</h2>
<p></p>
<table style="width:100%;" class="table table-bordered table-hover">
<tr class="danger">
	<th>Codigo</th>
	<th>Fecha</th>
	<th>Mensaje</th>
</tr>
<?php foreach ($_SESSION["errors"]  as $error):
$credit = SellData::getById($error["sell_id"]);
?>
<tr class="danger">
	<td><?php echo $credit->id; ?></td>
	<td><?php echo $credit->created_at; ?></td>
	<td><b><?php echo $error["message"]; ?></b></td>
</tr>

<?php endforeach; ?>
</table>
<?php
unset($_SESSION["errors"]);
 endif; ?>


<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["cart2"])):?>
<script>

</script>


<h2>&nbsp;</h2>
<table style="width:100%;" class="table table-bordered table-hover">
<thead>
	<th style="width:30px;">Codigo</th>
	<th style="width:30px;">Cantidad</th>
	<th style="width:30px;">Cliente</th>
	<th style="width:100px;">Valor</th>
	<th style="width:100px;">Pagado</th>
    <th style="width:100px;">Deuda</th>
	<th style="width:100px;">Fecha de Venta</th>
	<th ></th>
</thead>
<?php foreach($_SESSION["cart2"] as $p):
$credit = SellData::getById($p["sell_id"]);
$client = PersonData::getById($credit->person_id);
$q= PaymentData::getQYesF($credit->id);
?>
<tr >
	<td><?php echo $credit->id; ?></td>
	<td ><?php $pagar= $p["q"]; echo  $p["q"]; ?></td>
<td class="<?php if(isset($client -> name) && $credit->person_id!="" ): else: echo 'danger'; endif; ?>"><?php if(isset($client -> name) && $credit->person_id!=""):
				 echo $credit->person_id ." ". $client -> name . " ".$client -> lastname ; 
				  else: echo "ERROR. El Cliente fue eliminado";
				 endif;
				 ?></td>
	<td><?php echo $credit->total; ?></td>
	<td><b>$ <?php $total3=$credit->total; echo ($credit->total - $q); ?></b></td>
    <td><b>$ <?php echo $q; ?></b></td>
	<td><b>$ <?php  echo $credit->created_at; ?>  </b></td>
	<td style="width:30px;"><a href="index.php?action=clearcart2&product_id=<?php echo $credit->id; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></td>
</tr>

<?php endforeach; ?>
</table>

<form method="post" class="form-horizontal" name="processpayment" id="processpayment" action="index.php?action=processpayment" >
<h2>Resumen</h2>
      <input type="hidden" name="sell_id" value="<?php echo $credit->id; ?>" class="form-control" placeholder="Total">
      <input type="hidden" name="payment" value="<?php echo $pagar; ?>" class="form-control" placeholder="Total">
      <input type="hidden" name="person_id" value="<?php echo $credit->person_id ; ?>" class="form-control" placeholder="Total">
      
       
<table style="width:100%;" class="table table-bordered">
<tr>
	<td class="danger"><p>Total</p></td>
	<td class="danger"><p><b>$ <?php echo number_format($pagar); ?></b></p></td>
</tr>
</table>

 <div class="form-group">
    <label  class="col-lg-1 control-label">Efectivo</label>
    <div class="col-lg-10">
      <input type="text" name="money" required class="form-control" id="money" placeholder="Efectivo">
    </div>
  </div>
 
		<a href="index.php?action=clearcart2" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
        <button class="btn btn-lg btn-success"><i class="glyphicon glyphicon-usd"></i> Finalizar Pago</button>
            
        </div>
    </div>
</div>
</form>
<script>

	$("#processpayment").submit(function(e){
		money = $("#money").val();
		//override defaults para que se ve el tema
alertify.defaults.transition = "slide";
alertify.defaults.theme.ok = "btn btn-info";
alertify.defaults.theme.cancel = "btn btn-danger";
alertify.defaults.theme.input = "form-control";
								
				if(money<(<?php echo $pagar;?>)){
					alertify.alert('ERROR', 'No se puede efectuar la operacion falta efectivo!', function(){ alertify.error('Falta efectivo'); });
					e.preventDefault();
		
				}else{
					
					alertify.confirm('Cambio',"Cambio: $"+(money-(<?php echo $pagar;?> ) ),
			
			 function(){ alertify.success('Ok')
			 setTimeout(function(){ document.processpayment.submit() ; }, 500);
			 
			  }
			 
                , function(){ alertify.error('Cancelado por usuario')});
						e.preventDefault();
						
						
					}
			});
</script>
</div>
<br><br><br><br><br>
<?php endif; ?>

</div>