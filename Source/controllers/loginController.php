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
        $dados = array(
            'titulo' => 'Faça o login no Classi-O'
        );
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if($u->login($email, $senha)){
                header('Location:'.BASE_URL);
            }else{
                $dados['aviso'] = '<div class="alert alert-warning">
                                        E-mail e/ou senha inválidos.
                                    </div>';
            }
        }
        $this->loadTemplate('login', $dados);
    }

    /**
     * This function shows the register page.
     * Receive the input data and use the user's register method
     */
    public function cadastrar(){
        $u = new Usuarios();
        $dados = array(
            'titulo' => 'Faça seu cadastro'
        );
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

    /**
     * This function shows the sending screen of the password recovery email
     */
    public function enviarRecuperacaoDeSenha(){
        $u = new Usuarios();
        $dados = array(
            'titulo' => 'Recupere sua senha'
        );
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            if(!empty($email)){
                if($u->recuperarSenha($email)){
                    header("Location: ".BASE_URL."/login?recuperacao=true");
                }else{
                    $dados['aviso'] = '<div class="alert alert-warning">E-mail não cadastrado.</div>';
                }
            }else{
                $dados['aviso'] = '<div class="alert alert-warning">
                    Preencha todos os campos!
                </div>';
            }
        }
        $this->loadTemplate('envioDoLinkDeRecuperacao', $dados);
    }

    /**
     * This function shows the modify screen the user's password using the code of recovery sends to user's email
     */
    public function recuperarSenha($hashRecuperacao){
        $dados = array(
            'titulo' => 'Recuperar sua senha'
        );
        $hashRecuperacao = addslashes($hashRecuperacao);
        $u = new Usuarios();
        $dados = $u->getDadosHash($hashRecuperacao);
        if(!empty($dados)){
            if(isset($_POST['senha']) && !empty($_POST['senha']) && isset($_POST['confirmaSenha']) && !empty($_POST['confirmaSenha'])){
                $senha = addslashes($_POST['senha']);
                $confirmaSenha = addslashes($_POST['confirmaSenha']);
                if($senha == $confirmaSenha){
                    $u->editar($dados['id'], $dados['nome'], $dados['email'], $senha, $dados['telefone'], $dados['celular']);
                    $u->setHashRecuperacao($dados['id'], Null);
                    $dados['aviso'] = '<div class="alert alert-success notificacao">Senha alterada com sucesso!</div>';
                    $this->loadTemplate('login', $dados);
                    exit();
                }else
                    $dados['aviso'] = '<div class="alert alert-warning">As senhas não são compatíveis.</div>';
            }
        }else{
            header("Location:".BASE_URL."/login");
        }
        $this->loadTemplate('recuperarSenha', $dados);
    }

}