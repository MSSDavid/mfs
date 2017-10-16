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
     * This function shows the homepage.
     */
    public function index(){
        $dados = array(
            'titulo' => 'Classi-O'
        );
        $this->loadTemplate('home', $dados);
    }

    /**
     * This function shows the register page.
     * Receive the input data and use the user's register method
     */
    public function cadastrar(){
        $u = new Usuarios();
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $telefone = addslashes($_POST['telefone']);
            $celular = addslashes($_POST['celular']);

            if(!empty($nome) && !empty($email) && !empty($senha)){
                if($u->cadastrar($nome, $email, $senha, $telefone, $celular)){
                    header("Location: ".BASE_URL."/home/login");
                }else{
                    $dados['aviso'] =
                        '<div class="alert alert-warning">
                        Este usuário já existe / Dados incorretos. <a href="'.BASE_URL.'/home/login" class="alert-link">Faça o login agora</a>
                    </div>';
                }
            }else{
                $dados['aviso'] =
                    '<div class="alert alert-warning">
                    Preencha todos os campos!
                </div>';
            }
        }
        $dados = array(
            'titulo' => 'Faça seu cadastro'
        );
        $this->loadTemplate('cadastrar', $dados);
    }

    /**
     * This function shows the login page.
     * Receive the input data and use the user's login method
     */
    public function login(){
        $u = new Usuarios();
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if($u->login($email, $senha)){
                header('Location:'.BASE_URL);
            }else{
                $dados['aviso'] = 'Usuário e/ou senha inválidos.';
            }
        }
        $dados = array(
            'titulo' => 'Faça o login no Classi-O'
        );
        $this->loadTemplate('login', $dados);
    }

    /**
     * This function use the user's logoff method and redirects to homepage
     */
    public function logoff(){
        $u = new Usuarios();
        $u->logoff($_SESSION['cLogin']);
        header("Location: ".BASE_URL);
    }

    /**
     * This function checks if the user if logged in, if so shows the user data page.
     */
    public function MinhaConta(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL);
        }
        $u = new Usuarios();
        $dadosUsuario = $u->getDados($_SESSION['cLogin']);
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
        $dadosUsuario = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Minha Conta',
            'dados' => $dadosUsuario
        );
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $novaSenha = addslashes($_POST['NovaSenha']);
            $telefone = addslashes($_POST['telefone']);
            $celular = addslashes($_POST['celular']);

            if(!empty($nome) && !empty($email)){
                if($senha != "" && $novaSenha != ""){
                    if($u->login($email, $senha)){
                        if($u->editar($_SESSION['cLogin'], $nome, $email, $novaSenha, $telefone, $celular)){
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
                    if($u->editar($_SESSION['cLogin'], $nome, $email, $senha, $telefone, $celular)){
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