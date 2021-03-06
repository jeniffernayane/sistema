<?php 
require_once "../../classes/conexao.php";
require_once "../../classes/compras.php";

$c= new conectar();
$conexao=$c->conexao();

$obj= new compras();

            $sql="SELECT id_compra,
				dataCompra,
				id_fornecedor 
			from compras group by id_compra";
                $result=mysqli_query($conexao,$sql); 
	?>

<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
                    <br>                   
<div class="form-group input-group">
 <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
 <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
</div>

<script>
$('input#txt_consulta').quicksearch('table#tabela tbody tr');
</script>
			<table id="tabela" class="table table-hover table-condensed table-bordered" style="text-align: center;">
				<caption><label>Compras</label></caption>
				<tr>
					<td>Código</td>
					<td>Data</td>
					<td>Fornecedor</td>
					<td>Total da Compra</td>
                                        <td>Relatório de compra</td>
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td><?php echo date("d/m/Y", strtotime($ver[1])) ?></td>
					<td>
						<?php
							if($obj->nomeFornecedor($ver[2])==" "){
								echo "S/F";
							}else{
								echo $obj->nomeFornecedor($ver[2]);
							}
						 ?>
					</td>
					<td>
						<?php 
							echo "R$ ".$obj->obterTotal($ver[0]). ",00";
						 ?>
                                            <td>
						<a href="../procedimentos/compras/notaPdf.php?idcompra=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Relatório <span class="glyphicon glyphicon-file"></span>
						</a>
					</td>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>