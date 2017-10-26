<?php
/**
 * This class retrieves and saves data of the ad.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 25/10/2017
 * @since   0.1
 */
class Anuncios extends model{

    /**
     * This function retrieves all data from an ad, by using it's ID.
     *
     * @param   $id     The ad's ID number saved in the database.
     * @return  An array containing all data retrieved.
     */
    public function getAnuncio($id){
        $sql = "SELECT * FROM anuncios WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        return $sql;
    }

    /**
     * This function retrieves all data from ad's database.
     *
     * @return  An array containing all data retrieved.
     */
    public function getAnuncios(){
        $sql = "SELECT * FROM anuncios ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql;
    }

    /**
     * This function register a new ad in database.
     *
     * @param   $id_usuario     The ad's id.
     * @param   $titulo         The ad's title.
     * @param   $descricao      The ad's description.
     * @param   $id_categoria   The ad's category ID.
     * @param   $preco          The ad's price.
     * @param   $estado         The ad's conservation status.
     */
    public function cadastrarAnuncio($id_usuario, $titulo, $descricao, $id_categoria, $preco, $estado){
        $sql = "INSERT INTO anuncios (id_usuario, titulo, NOW(), descricao, id_categoria, preco, estado) VALUES (?, ?, ?, ?, ?, ?)";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_usuario, $titulo, $descricao, $id_categoria, $preco, $estado));
    }

    /**
     * This function edit a ad in database.
     *
     * @param   $id             The ad's ID number saved in the database.
     * @param   $id_usuario     The ad's id.
     * @param   $titulo         The ad's title.
     * @param   $descricao      The ad's description.
     * @param   $id_categoria   The ad's category ID.
     * @param   $preco          The ad's price.
     * @param   $estado         The ad's conservation status.
     */
    public function editarAnuncio($id, $id_usuario, $titulo, $descricao, $id_categoria, $preco, $estado){
        $sql = "UPDATE anuncios SET id_usuario = ?, titulo = ?, descricao = ?, id_categoria = ?, preco = ?, estado = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_usuario, $titulo, $descricao, $id_categoria, $preco, $estado, $id));
    }

    /**
     * This function delete a ad in database.
     *
     * @param   $id   The ad's ID number saved in the database.
     */
    public function excluir($id){
        $sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id_anuncios = ?");
        $sql->execute(array($id));
        $sql = $this->db->prepare("SELECT * FROM anuncios_imagens WHERE id = ?");
        $sql->execute(array($id));
        $sql = $sql->fetchAll();
        foreach($sql as $result){
            $this->excluirFoto($result['id']);
        }

    }
}