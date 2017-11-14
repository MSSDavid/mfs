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
     * @param   $email    The email registered for the account.
     * @param   $senha    The current password.
     * @return  A boolean True for the correct user ID, or False for 'user not found'.
     */
    public function login($email, $senha){
        $sql = "SELECT id FROM usuarios WHERE email = ? AND senha = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email, md5($senha)));
        $sql = $sql->fetch(PDO::FETCH_ASSOC);
        if($sql && count($sql)){
            $_SESSION['cLogin'] = $sql['id'];
            return true;
        }else{
            return false;
        }
    }

    /**
     * This function register a new user in database.
     * If this email already registered returns False, else returns True.
     *
     * @param   $nome       The user's name.
     * @param   $email      The user's email.
     * @param   $senha      The user's password.
     * @param   $telefone   The user's phone.
     * @param   $celular    The user's cellphone.
     * @return  A boolean False for email alread registery, or instead True.
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
     * @param   $id         The user's ID number saved in the database.
     * @param   $nome       The user's name.
     * @param   $email      The user's email.
     * @param   $senha      The user's password.
     * @param   $telefone   The user's phone.
     * @param   $celular    The user's cellphone.
     * @return  A boolean False for email alread registery, or instead True.
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
     * @param   $id       The user's ID number saved in the database.
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

    public function recuperarSenha($email){

    }
}
?>