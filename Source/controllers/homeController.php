<?php
/**
 * This class is the Controller of the HomePage.
 *
 * @author  samuelrcosta
 * @version 1.2.0, 10/10/2017
 * @since   0.1
 */
class homeController extends controller{

    /**
     * This function shows the homepage.
     *
     * @param   $p  int for the page number
     */
    public function index($p = 1){
        $a = new Anuncios();
        $c = new Categorias();
        $e = new Estados();
        $cid = new Cidades();
        $filtros = array(
            'categoria' => '',
            'precoMin' => '',
            'precoMax' => '',
            'estado' => '',
            'estados' => '',
            'cidades' => ''
        );
        if(isset($_GET['filtros'])){
            $filtros = $_GET['filtros'];
        }
        $max_pagina = 20;
        $total_paginas = ceil($a->getTotalAnuncios($filtros)/$max_pagina);
        $anuncios = $a->getUltimosAnuncios($p, $max_pagina, $filtros);
        $categorias = $c->getCategorias();
        $dados = array(
            'titulo' => 'Classi-O',
            'categorias' => $categorias,
            'estados' => $e->getEstados(),
            'total_paginas' => $total_paginas,
            'anuncios' => $anuncios,
            'filtros' => $filtros,
            'p' => $p,
        );
        if(!empty($filtros['estados'])){
            $dados['cidades'] = $cid->getCidades($filtros['estados']);
        }
        $this->loadTemplate('home', $dados);
    }

    /**
     * This function checks if the user if logged in, if so shows the user data page.
     */
    public function MinhaConta(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL);
        }
        $u = new Usuarios();
        $dadosUsuario = $u->getDados(1, $_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Minha Conta',
            'dados' => $dadosUsuario
        );
        $this->loadTemplate('MinhaConta', $dados);
    }

    /**
     * This function checks if the user if logged in, if so shows the user data editing page.
     * Receive the input data and use the user's edit method
     */
    public function editarConta(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL);
        }
        $u = new Usuarios();
        $e = new Estados();
        $c = new Cidades();
        $dadosUsuario = $u->getDados(1, $_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Minha Conta',
            'dados' => $dadosUsuario,
            'estados' => $e->getEstados(),
            'cidades' => $c->getCidades($dadosUsuario['id_estado']),
        );
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $novaSenha = addslashes($_POST['NovaSenha']);
            $telefone = addslashes($_POST['telefone']);
            $celular = addslashes($_POST['celular']);
            $id_estado = addslashes($_POST['estado']);
            $id_cidade = addslashes($_POST['cidade']);

            if(!empty($nome) && !empty($email)){
                if($senha != "" && $novaSenha != ""){
                    if($u->login($email, $senha)){
                        if($u->editar($_SESSION['cLogin'], $nome, $email, $novaSenha, $telefone, $celular, $id_estado, $id_cidade)){
                            header("Location: ".BASE_URL."/home/MinhaConta");
                        }else{
                            $dados['aviso'] =
                                '<div class="alert alert-warning">
                                    Este email já existe.
                                </div>';
                        }
                    }else{
                        $dados['aviso'] =
                            '<div class="alert alert-warning">
                                Senha Incorreta.
                            </div>';
                    }
                }else{
                    if($u->editar($_SESSION['cLogin'], $nome, $email, $senha, $telefone, $celular, $id_estado, $id_cidade)){
                        header("Location: ".BASE_URL."/home/MinhaConta");
                    }else{
                        $dados['aviso'] =
                            '<div class="alert alert-warning">
                                    Este email já existe.
                             </div>';
                    }
                }
            }else{
                $dados['aviso'] =
                    '<div class="alert alert-warning">
                    Preencha todos os campos!
                </div>';
            }
        }
        $this->loadTemplate('editarConta', $dados);
    }

    /**
     * This function retrieves citys of the selected state
     */
    public function cidades($id_estado){
        $c = new Cidades();
        $lista = $c->getCidades(addslashes($id_estado));
        echo( json_encode( $lista ) );
    }

    /**
     * This function use the user's delete method and redirects to homepage
     */
    public function excluirConta(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL);
        }
        $u = new Usuarios();
        $u->excluir($_SESSION['cLogin']);
        $u->logOff($_SESSION['cLogin']);
        header("Location: ".BASE_URL."/home");
    }
}