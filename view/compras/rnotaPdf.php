<?php 
	require_once "../../classes/conexao.php";
	require_once "../../classes/compras.php";

	$obj= new compras();


	$c= new conectar();
	$conexao=$c->conexao();
	$idcompra=$_GET['idcompra'];

 $sql="SELECT co.id_compra,
		co.dataCompra,
		co.id_fornecedor,
		pro.nome,
        pro.preco_compra,
        pro.descricao
	from compras  as co 
	inner join produtos as pro
	on co.id_produto=pro.id_produto
	and co.id_compra='$idcompra'";

        $result=mysqli_query($conexao,$sql);

	$ver=mysqli_fetch_row($result);

	$comp=$ver[0];
	$data=$ver[1];
	$idfornecedor=$ver[2];

 ?>	

 	

 	<link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.css">
 
 		<img src="../../img/six.png" width="200" height="120">
 		<br>
 		<table class="table">
 			<tr>
 				<td>Data: 
 				<?php echo date("d/m/Y", strtotime($data)) ?>
 				</td>
 			</tr>
 			<tr>
                            <td>Comprovante: <?php echo $comp ?></td>
 			</tr>
 			<tr>
                            <td>Fornecedor: <?php echo $obj->nomeFornecedor($idfornecedor); ?></td>
 			</tr>
 		</table>


 		<table class="table">
 			<tr>
 				<td>Produto</td>
 				<td>Preco Compra</td>
 				<td>Quantidade</td>
 				<td>Descricao</td>
 			</tr>

 			<?php 
 			$sql="SELECT co.id_compra,
                                            co.dataCompra,
                                            co.id_fornecedor,
                                            pro.nome,
                                            pro.preco_compra,
                                            pro.descricao,
                                            co.quantidade,
                                            co.total_compra
                                            from compras  as co 
                                            inner join produtos as pro
                                            on co.id_produto=pro.id_produto
                                            and co.id_compra='$idcompra'";

			$result=mysqli_query($conexao,$sql);
			$total=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

 			<tr>
 				<td><?php echo $mostrar[3]; ?></td>
 				<td><?php echo "R$ ".$mostrar[4].",00"; ?></td>
 				<td><?php echo $mostrar[6]; ?></td>
 				<td><?php echo $mostrar[5]; ?></td>
 			</tr>
 			<?php 
 				$total=$total + $mostrar[7];
 			endwhile;
 			 ?>
 			 <tr>
 			 	<td>Total=  <?php echo "R$ ".$total.",00"; ?></td>
 			 </tr>
 		</table>
