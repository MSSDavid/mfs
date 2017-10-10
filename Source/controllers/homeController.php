<?php
/**
 * This class is the Controller of the HomePage.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 10/10/2017
 * @since   0.1
 */
class homeController extends controller{

    /**
     * This function verifies if you are logged in, if so, then it shows you
     * the homepage, if not, it sends you to login page.
     */
    public function index(){
        $dados = array(
            'titulo' => 'Home'
        );
        $this->loadTemplate('home', $dados);
    }
}