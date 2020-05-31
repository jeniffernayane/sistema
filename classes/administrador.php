<?php

class administrador extends usuarios{
        public function registroUsuario($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$data = date('Y-m-d');

		$sql = "INSERT into usuarios (nome, user, email, senha, dataCaptura) VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$data')";

		return mysqli_query($conexao, $sql);
	}


        public function trazerId($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$senha = sha1($dados[1]);

		$sql = "SELECT id from usuarios where email='$dados[0]' and senha = '$senha' ";
		$result = mysqli_query($conexao, $sql);
		return mysqli_fetch_row($result)[0];
	}
        
}
 ?>

