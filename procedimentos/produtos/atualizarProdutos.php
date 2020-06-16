<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/produtos.php";

	$obj= new produtos();

$dados=array(
            $_POST['idProduto'],
	    $_POST['categoriaSelectU'],
	    $_POST['nomeU'],
	    $_POST['descricaoU'],
	    $_POST['quantidadeU'],
	    $_POST['precoU'],
            $_POST['preco_compraU']
			);

    echo $obj->atualizar($dados);

 ?>