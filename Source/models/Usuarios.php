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

        if($sql->rowCount() == 0){
            $sql = "INSERT INTO usuarios SET email = ?, senha = ?, nome = ?, telefone = ?, celular = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($email, md5($senha), $nome, $telefone, $celular));
            return true;
        }else{
            return false;
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

        if($sql->rowCount() == 0){
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
        }else{
            return false;
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
     * This function retrieves all data from an user, by using it's ID.
     *
     * @param   $id     The user's ID number saved in the database.
     * @return  An array containing all data retrieved.
     */
    public function getDados($id){
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        return $sql;
    }
}
?>