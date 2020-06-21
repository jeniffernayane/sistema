<?php

abstract class pessoa{
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
}
?>