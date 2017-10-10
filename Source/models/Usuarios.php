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
    }

    /**
     * This function delete a user in database.
     *
     * @param   $id       The user's ID number saved in the database.
     */
    public function excluir($id){
    }

    /**
     * Function used to unregister the user in the session.
     *
     */
    public function logOff(){
    }

    /**
     * This function retrieves all data from an user, by using it's ID.
     *
     * @param   $id     The user's ID number saved in the database.
     * @return  An array containing all data retrieved.
     */
    public function getDados($id){
    }
}
?>