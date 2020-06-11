<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>compras</title>
	<?php require_once "menu.php"; ?>
</head>
<body>

	<div class="container">
		 <h1>Registro de compras</h1>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<span class="btn btn-default" id="compraProdutosBtn">Registrar compra</span>
		 		<span class="btn btn-default" id="comprasFeitasBtn">Lista de Compras</span>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<div id="compraProdutos"></div>
		 		<div id="comprasFeitas">

		 			
<?php 

	
	//require_once "vendas/vendasRelatorios.php" 

	?>

		 		</div>
		 	</div>
		 </div>
	</div>
</body>
</html>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#compraProdutosBtn').click(function(){
				esconderSessaoCompra();
				$('#compraProdutos').load('compras/comprasDeProdutos.php');
				$('#compraProdutos').show();
			});
			$('#comprasFeitasBtn').click(function(){
				esconderSessaoCompra();
				$('#comprasFeitas').load('compras/comprasRelatorios.php');
				$('#comprasFeitas').show();
			});
		});

		function esconderSessaoCompra(){
			$('#compraProdutos').hide();
			$('#comprasFeitas').hide();
		}

	</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>