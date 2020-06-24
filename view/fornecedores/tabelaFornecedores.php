<?php 
require_once "../../classes/conexao.php";
require_once "../../classes/fornecedores.php";

$fornecedor = new fornecedores();
$result = $fornecedor->obterTodos();

?>

<div class="form-group input-group">
 <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
 <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
</div>

<script>
$('input#txt_consulta').quicksearch('table#tabela tbody tr');
</script>

<table id="tabela" class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Fornecedores</label></caption>
	<tr>
			<td>Nome</td>
	 		<td>Razão social</td>
	 		<td>Endereço</td>
	 		<td>Email</td>
	 		<td>Telefone</td>
	 		<td>CNPJ</td>
	 		<td>Editar</td>
			<td>Excluir</td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td><?php echo $mostrar[3]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[6]; ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalFornecedoresUpdate" onclick="adicionarDado('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminar('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>


<?php endWhile; ?>
</table>