<?php

require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
?>


<h4>Registrar compra</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frmComprasProdutos">
			<label>Selecionar Fornecedor</label>
			<select class="form-control input-sm" id="fornecedorCompra" name="fornecedorCompra">
				<option value="A">Selecionar</option>
				<option value="0">Sem Fornecedor</option>
				<?php
				$sql="SELECT id_fornecedor,nome 
				from fornecedores";
				$result=mysqli_query($conexao,$sql);
				while ($fornecedor=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $fornecedor[0] ?>"><?php echo $fornecedor[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Produto</label>
			<select class="form-control input-sm" id="produtoCompra" name="produtoCompra">
				<option value="A">Selecionar</option>
				<?php
				$sql="SELECT id_produto,
				nome
				from produtos";
				$result=mysqli_query($conexao,$sql);

				while ($produto=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $produto[0] ?>"><?php echo $produto[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Descrição</label>
			<textarea readonly="" id="descricaoV" name="descricaoV" class="form-control input-sm"></textarea>
			<label>Quantidade Estoque</label>
			<input readonly="" type="text" class="form-control input-sm" id="quantidadeV" name="quantidadeV">
			<label>Preço Compra</label>
			<input readonly="" type="text" class="form-control input-sm" id="precoV" name="precoV">
			<label>Quantidade Comprada</label>
			<input type="text" class="form-control input-sm" id="quantV" name="quantV">
                        
			<p></p>
			<span class="btn btn-primary" id="btnAddCompra">Adicionar</span>
			<span class="btn btn-danger" id="btnLimparCompras">Limpar Compra</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProduto"></div>
	</div>
	<div class="col-sm-4">
		<div id="tabelaVendasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaVendasTempLoad').load("compras/tabelaComprasTemp.php");

		$('#produtoCompra').change(function(){

			$.ajax({
				type:"POST",
				data:"idproduto=" + $('#produtoCompra').val(),
				url:"../procedimentos/compras/obterDadosProdutos.php",
				success:function(r){
					dado=jQuery.parseJSON(r);

					$('#descricaoV').val(dado['descricao']);

					$('#quantidadeV').val(dado['quantidade']);
					$('#precoV').val(dado['preco_compra']);
					
					$('#imgProduto').prepend('<img class="img-thumbnail" id="imgp" src="' + dado['url'] + '" />');
					
				}
			});
		});

		$('#btnAddCompra').click(function(){
			vazios=validarFormVazio('frmComprasProdutos');

			quant = 0;
			quantidade = 0;

			quant = $('#quantV').val();
			quantidade = $('#quantidadeV').val();



			if(quant > quantidade){
				alertify.alert("Quantidade inexistente em estoque!!");
				quant = $('#quantV').val("");
				return false;
			}else{
				quantidade = $('#quantidadeV').val();
			}

			if(vazios > 0){
				alertify.alert("Preencha os Campos!!");
				return false;
			}

			dados=$('#frmComprasProdutos').serialize();
			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/compras/adicionarProdutoTemp.php",
				success:function(r){
					$('#tabelaVendasTempLoad').load("compras/tabelaComprasTemp.php");
				}
			});
		});

		$('#btnLimparCompras').click(function(){

		$.ajax({
			url:"../procedimentos/compras/limparTemp.php",
			success:function(r){
				$('#tabelaVendasTempLoad').load("compras/tabelaComprasTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">

	function editarP(dados){
		
		$.ajax({
			type:"POST",
			data:"dados=" + dados,
			url:"../procedimentos/compras/editarEstoque.php",
			success:function(r){
				
				$('#tabelaVendasTempLoad').load("compras/tabelaComprasTemp.php");
				alertify.success("Estoque Atualizado com Sucesso!!");
			}
		});
	}


	function fecharP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procedimentos/compras/fecharProduto.php",
			success:function(r){
				$('#tabelaVendasTempLoad').load("compras/tabelaComprasTemp.php");
				alertify.success("Produto Removido com Sucesso!!");
			}
		});
	}

	function criarCompra(){
		$.ajax({
			url:"../procedimentos/compras/criarCompra.php",
			success:function(r){
				
				if(r > 0){
					$('#tabelaVendasTempLoad').load("compras/tabelaComprasTemp.php");
					$('#frmComprasProdutos')[0].reset();
					alertify.alert("Compra criada com Sucesso!");
				}else if(r==0){
					alertify.alert("Não possui lista de Compras");
				}else{
					alertify.error("Compra não registrada");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteCompra').select2();
		$('#produtoCompra').select2();

	});
</script>