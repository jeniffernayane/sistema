<?php 

class usuarios{
    private $dados;
    
    function getDados() {
        return $this->dados;
    }
    function setDados($dados) {
        $this->dados = $dados;
    }  
    
    public function login($dados){
                $c = new conectar();
		$conexao=$c->conexao();

		$senha = sha1($dados[1]);

		$_SESSION['usuario'] = $dados[0];
		$_SESSION['iduser'] = self::trazerId($dados);

		$sql = "SELECT * from usuarios where email = '$dados[0]' and senha = '$senha' ";

		$result = mysqli_query($conexao, $sql);

		//echo $sql;

		if(mysqli_num_rows($result) > 0){
			return 1;
		}else{
			return 0;
		}


	}
}

 ?>