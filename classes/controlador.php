<?php
require_once 'categorias.php';

interface controlador {
    public function adicionarCategoria($dados);
    public function atualizarCategoria($dados);
    public function excluirCategoria($idcategoria);   
}
