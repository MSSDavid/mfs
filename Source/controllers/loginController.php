<?php
/**
 * This class is the Controller of the LoginPage.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 10/10/2017
 * @since   0.1
 */
class loginController extends controller{

    /**
     * This function shows the login page.
     * Receive the input data and use the user's login method
     */
    public function index(){
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
                    header("Location: ".BASE_URL."/login");
                }else{
                    $dados['aviso'] =
                        '<div class="alert alert-warning">
                        Este usuário já existe / Dados incorretos. <a href="'.BASE_URL.'/login" class="alert-link">Faça o login agora</a>
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
     * This function use the user's logoff method and redirects to homepage
     */
    public function logoff(){
        $u = new Usuarios();
        $u->logoff($_SESSION['cLogin']);
        header("Location: ".BASE_URL);
    }


    public function recuperarSenha(){
        $u = new Usuarios();
    }

}