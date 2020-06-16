<?php
require_once "classes/conexao.php";
require_once "../view/menu.php";

class administrador extends usuarios{
    private $dados;
    private $id;
    
    function getDados() {
        return $this->dados;
    }
    function getId() {
        return $this->id;
    }
    function setDados($dados) {
        $this->dados = $dados;
    }
    function setId($id) {
        $this->id = $id;
    }
    
    public function GestaodeDados ($dados){
		$c = new conectar();
		$conexao=$c->conexao();
                $rows = mysqli_num_rows($sql);

		$sql = "SELECT user FROM usuarios WHERE '$dados[1]'='admin'";
		return mysqli_query($conexao, $sql);
}
  
    }
    	
 ?>