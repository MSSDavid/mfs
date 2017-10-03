<?php
class homeController extends controller{
    public function index(){
        $dados = array(
            'titulo' => 'Home'
        );
        $this->loadTemplate('home', $dados);
    }
}