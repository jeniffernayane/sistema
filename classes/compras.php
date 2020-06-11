<?php 

class compras{
	public function obterDadosProduto($idproduto){
		$c= new conectar();
		$conexao=$c->conexao();

		$sql="SELECT pro.nome,
		pro.descricao,
		pro.quantidade,
		img.url,
		pro.preco
		from produtos as pro 
		inner join imagens as img
		on pro.id_imagem=img.id_imagem 
		and pro.id_produto='$idproduto'";
		$result=mysqli_query($conexao,$sql);

		$ver=mysqli_fetch_row($result);



		$d=explode('/', $ver[3]);

		$img=$d[1].'/'.$d[2].'/'.$d[3];

		$dados=array(
			'nome' => $ver[0],
			'descricao' => $ver[1],
			'quantidade' => $ver[2],
			'url' => $img,
			'preco' => $ver[4]
		);		
		return $dados;
	}

	public function criarCompra(){
		$c= new conectar();
		$conexao=$c->conexao();

		$data=date('Y-m-d');
		$dados=$_SESSION['tabelaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i < count($dados) ; $i++) { 
			$d=explode("||", $dados[$i]);

			$sql="INSERT into compras (id_compra,
							id_fornecedor,
                                                        id_produto,
							id_usuario,
							preco,
							quantidade,
							total_venda,
							dataCompra)
							values ('$idcompra',
									'$d[8]',
									'$d[0]',
									'$idusuario',
									'$d[3]',
									'$d[6]',
									'$d[7]',
									'$data')";




			
			$r=$r + $result=mysqli_query($conexao,$sql);



		}

		return $r;
	}

	public function nomeFornecedor($idFornecedor){
		$c= new conectar();
		$conexao=$c->conexao();


		 $sql="SELECT nome 
                                 from fornecedores 
                                 where id_fornecedor='$idFornecedor'";
		$result=mysqli_query($conexao,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[1]." ".$ver[0];
	}

	public function obterTotal($idcompra){
		$c= new conectar();
		$conexao=$c->conexao();


		$sql="SELECT total_compra 
				from compras 
				where id_compra='$idcompra'";
		$result=mysqli_query($conexao,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}
}

?>