<?php
/**
 * This class is the Controller of Not Found Pages(404 error).
 *
 * @author  samuelrcosta
 * @version 0.1.0, 10/10/2017
 * @since   0.1
 */
class notfoundController extends controller{

    /**
     * This function shows 404 Errors when they happen.
     */
    public function index(){
        $dados['titulo'] = "404 - Página não encontrada";
        $this->loadTemplate('404', $dados);
    }
}
?>