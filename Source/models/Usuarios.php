<?php
/**
 * This class retrieves and saves data of the user.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 10/10/2017
 * @since   0.1
 */

class Usuarios extends model{

    /**
     * This function verify if the input is valid for any account registered.
     * If valid returns True, otherwise return False for false.
     *
     * @param   $email    string for the email registered for the account.
     * @param   $senha    string for the current password.
     * @return  boolean True for the correct user ID, or False for 'user not found'.
     */
    public function login($email, $senha){
        $sql = "SELECT id FROM usuarios WHERE email = ? AND senha = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email, md5($senha)));
        $sql = $sql->fetch(PDO::FETCH_ASSOC);
        if($sql && count($sql)){
            $_SESSION['cLogin'] = $sql['id'];
            return True;
        }else{
            return False;
        }
    }

    /**
     * This function register a new user in database.
     * If this email already registered returns False, else returns True.
     *
     * @param   $nome       string for the user's name.
     * @param   $email      string for the user's email.
     * @param   $senha      string for the user's password.
     * @param   $telefone   string for the user's phone.
     * @param   $celular    string for the user's cellphone.
     * @return  boolean False for email alread registery, or instead True.
     */
    public function cadastrar($nome, $email, $senha, $telefone, $celular){
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email));
        $sql = $sql->fetchAll();
        if($sql && count($sql)){
            return false;
        }else{
            $sql = "INSERT INTO usuarios (email, senha, nome, telefone, celular) VALUES (?, ?, ?, ?, ?)";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($email, md5($senha), $nome, $telefone, $celular));
            return true;
        }
    }

    /**
     * This function edit a user in database.
     * If this email already registered returns False, else returns True.
     *
     * @param   $id         int for the user's ID number saved in the database.
     * @param   $nome       string for the user's name.
     * @param   $email      string for the user's email.
     * @param   $senha      string for the user's password.
     * @param   $telefone   string for the user's phone.
     * @param   $celular    string for the user's cellphone.
     * @return  boolean False for email alread registery, or instead True.
     */
    public function editar($id, $nome, $email, $senha, $telefone, $celular){
        $sql = "SELECT * FROM usuarios WHERE email = ? AND id != ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email, $id));
        $sql = $sql->fetchAll();
        if($sql && count($sql)){
            return false;
        }else{
            if(empty($senha)){
                $sql = "UPDATE usuarios SET email = ?, nome = ?, telefone = ?, celular = ? WHERE id = ?";
                $sql = $this->db->prepare($sql);
                $sql->execute(array($email, $nome, $telefone, $celular, $id));
                return true;
            }else{
                $sql = "UPDATE usuarios SET email = ?, senha = ?, nome = ?, telefone = ?, celular = ? WHERE id = ?";
                $sql = $this->db->prepare($sql);
                $sql->execute(array($email, md5($senha), $nome, $telefone, $celular, $id));
                return true;
            }
        }
    }

    /**
     * This function delete a user in database.
     *
     * @param   $id       int for the user's ID number saved in the database.
     */
    public function excluir($id){
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
    }

    /**
     * Function used to unregister the user in the session.
     *
     */
    public function logOff(){
        $_SESSION['cLogin'] = "";
    }

    /**
     * This function retrieves all data from an user, by using it's ID or it's Email.
     *
     * @param   $tipo           int for the type of search, 1 to ID and 2 to Email
     * @param   $idOrEmail     string user's ID number or Email saved in the database.
     * @return  array containing all data retrieved.
     */
    public function getDados($tipo, $idOremail){
        if($tipo == 1){
            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($idOremail));
            $sql = $sql->fetch();
            return $sql;
        }else{
            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($idOremail));
            $sql = $sql->fetch();
            return $sql;
        }
    }

    /**
     * This function changes the recuperation code of the user's password using his ID
     *
     * @param   $id                 int for the user's ID.
     * @param   $hashRecuperacao    string for the user's password recuperation code.
     */
    public function setHashRecuperacao($id, $hashRecuperacao){
        $sql = "UPDATE usuarios SET hashRecuperacao = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($hashRecuperacao, $id));
    }

    /**
     * This function changes the recuperation code of the user's password using his ID
     *
     * @param   $hashRecuperacao    string for the user's password recuperation code.
     * @return  array containing all data retrieved.
     */
    public function getDadosHash($hashRecuperacao){
        $sql = "SELECT * FROM usuarios WHERE hashRecuperacao = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($hashRecuperacao));
        $sql = $sql->fetch();
        return $sql;
    }

    /**
     * This function sends a password recovery link to the user using your email.
     *
     * @param   $email   string for the user's email.
     * @return  boolean true if the email exists in database or false if not.
     */
    public function recuperarSenha($email){
        $dados = $this->getDados(2, $email);
        if(!empty($dados)){
            $hashRecuperacao = md5(time().rand(0,9999));
            $u = new Usuarios();
            $u->setHashRecuperacao($dados['id'], $hashRecuperacao);
            $assunto = "Classi-O - Recuperar Senha";
            $mensagem = "
                <html xmlns=\"http://www.w3.org/1999/xhtml\">
                    <head>
                        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
                        <title>".$assunto."</title>
                    </head>
                    <body paddingwidth=\"0\" paddingheight=\"0\" bgcolor=\"#d1d3d4\" style=\"padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;\" offset=\"0\" toppadding=\"0\" leftpadding=\"0\">
                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                            <tbody>
                                <tr>
                                    <td>Olá ".$dados['nome']."</td>
                                </tr>
                                <tr>
                                    <td>Recebemos sua solicitação de alteração de senha</td>
                                </tr>
                                <tr>
                                    <td>Para alterar sua senha <a href='".BASE_URL."/login/recuperarSenha/".$hashRecuperacao."'>clique aqui</a></td>
                                </tr>
                                <tr>
                                    <td>     </td>
                                </tr>
                                <tr>
                                    <td>Caso não seja você que tenha feito essa solicitação, apenas ignore esse e-mail.</td>
                                </tr>
                                <tr>
                                    <td>     </td>
                                </tr>
                                <tr>
                                    <td>Caso não consiga abrir o link, copie o endereço abaixo e cole no navegador:</td>
                                </tr>
                                <tr>
                                    <td>".BASE_URL."/login/recuperarSenha/".$hashRecuperacao."</td>
                                </tr>
                                <tr>
                                    <td>     </td>
                                </tr>
                                <tr>
                                    <td>     </td>
                                </tr>
                                <tr>
                                    <td>     </td>
                                </tr>
                                <tr>
                                    <td>Atenciosamente,</td>
                                </tr>
                                <tr>
                                    <td>Equipe Classi-O</td>
                                </tr>
                                <tr>
                                    <td>Universidade Federal de Goiás</td>
                                </tr>
                            </tbody>
                        </table>
                    </body>
                </html>";
            $mail= new PhpMailer;
            $mail->IsSMTP();
            $mail->Host = $this->MailHost;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = $this->MailPort;
            $mail->SMTPAuth = true;
            $mail->CharSet = "UTF-8";
            $mail->Username = $this->MailUsername;
            $mail->Password = $this->MailPassword;
            $mail->isHTML(true);
            $mail->SetFrom($this->MailUsername,$this->MailName);
            $mail->Subject = $assunto;
            $mail->AltBody='To view the message, please use an HTML compatible email viewer!';
            $mail->MsgHTML($mensagem);
            $mail->Body = $mensagem;
            $mail->AddAddress($dados['email'], $dados['nome']);
            $mail->send();
            return True;
        }else{
            return False;
        }
    }
}
?>