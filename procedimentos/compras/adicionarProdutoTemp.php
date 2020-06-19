<?php 
	session_start();
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$idfornecedor=$_POST['fornecedorCompra'];
	$idproduto=$_POST['produtoCompra'];
	$descricao=$_POST['descricaoV'];
	$quantidade=$_POST['quantidadeV'];
	$quantV=$_POST['quantV'];
	$preco_compra=$_POST['precoV'];


	$sql="SELECT nome  
                        from fornecedores 
                        where id_fornecedor='$idfornecedor'";
            $result=mysqli_query($conexao,$sql);

            $c=mysqli_fetch_row($result);

	$nfornecedor=$c[1];

	$sql="SELECT nome 
			from produtos
			where id_produto='$idproduto'";
            $result=mysqli_query($conexao,$sql);

            $nomeproduto=mysqli_fetch_row($result)[0];

                                $produto=$idproduto."||".
				$nomeproduto."||".
				$descricao."||".
				$preco_compra."||".
				$nfornecedor."||".
				$quantidade."||".
				$quantV."||".
				$quantV * $preco_compra."||".
				$idfornecedor;

	$_SESSION['tabelaComprasTemp'][]=$produto;


	//ATUALIZAÇÃO DO ESTOQUE - (Adição)
	$quantNova = $quantidade + $quantV;
	$sqlU = "UPDATE produtos SET quantidade = '$quantNova' where id_produto = '$idproduto' ";
		mysqli_query($conexao,$sqlU);

 ?>