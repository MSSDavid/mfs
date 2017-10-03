<?php
class notfoundController extends controller{
    public function index(){
        $dados['titulo'] = "404 - Página não encontrada";
        $this->loadTemplate('404', $dados);
    }
}
?>