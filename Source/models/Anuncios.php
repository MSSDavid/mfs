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
     * @param   $id     int for the ad's ID number saved in the database.
     * @return  array containing all data retrieved.
     */
    public function getAnuncio($id){
        $array = array();
        $array['fotos'] = array();
        $sql = "SELECT 
                *, 
                (SELECT categorias.nome FROM categorias WHERE categorias.id = anuncios.id_categoria limit 1) as categoria, 
                (SELECT usuarios.nome FROM usuarios WHERE usuarios.id = anuncios.id_usuario limit 1) as nome, 
                (SELECT usuarios.email FROM usuarios WHERE usuarios.id = anuncios.id_usuario limit 1) as email, 
                (SELECT usuarios.telefone FROM usuarios WHERE usuarios.id = anuncios.id_usuario limit 1) as telefone, 
                (SELECT usuarios.celular FROM usuarios WHERE usuarios.id = anuncios.id_usuario limit 1) as celular FROM anuncios WHERE id =               ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        if($sql && count($sql)){
            $array = $sql;
            $sql = $this->db->prepare("SELECT id, url FROM anuncios_imagens WHERE id_anuncio = ?");
            $sql->execute(array($id));
            $sql = $sql->fetchAll();
            if($sql && count($sql)){
                $array['fotos'] = $sql;
            }
        }
        return $array;
    }

    /**
     * This function retrieves all data of a user's ads using his ID
     *
     * @param   $id_usuario     int for the user's ID.
     * @return  array containing all data retrieved.
     */
    public function getMeusAnuncios($id_usuario){
        $sql = "SELECT *, (SELECT anuncios_imagens.url FROM anuncios_imagens WHERE anuncios_imagens.id_anuncio = anuncios.id limit 1) as url FROM anuncios WHERE id_usuario = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_usuario));
        return $sql->fetchAll();
    }

    /**
     * This function retrieves all data from ad's database.
     *
     * @return  array containing all data retrieved.
     */
    public function getAnuncios(){
        $sql = "SELECT * FROM anuncios ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $sql = $sql->fetchAll();
        return $sql;
    }

    /**
     * This function register a new ad in database.
     *
     * @param   $id_usuario     int for the ad's id.
     * @param   $titulo         string fot the ad's title.
     * @param   $descricao      string fot the ad's description.
     * @param   $id_categoria   int for the ad's category ID.
     * @param   $preco          double for the ad's price.
     * @param   $estado         int for the ad's conservation status.
     */
    public function cadastrarAnuncio($id_usuario, $titulo, $descricao, $id_categoria, $preco, $estado){
        $sql = "INSERT INTO anuncios (id_usuario, titulo, dataPublicacao, descricao, id_categoria, preco, estado) VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?, ?, ?)";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_usuario, $titulo, $descricao, $id_categoria, $preco, $estado));
    }

    /**
     * This function edit a ad in database.
     *
     * @param   $id             int for the ad's ID number saved in the database.
     * @param   $id_usuario     int for the ad's id.
     * @param   $titulo         string fot the ad's title.
     * @param   $descricao      string fot the ad's description.
     * @param   $id_categoria   int for the ad's category ID.
     * @param   $preco          double for the ad's price.
     * @param   $estado         int for the ad's conservation status.
     */
    public function editarAnuncio($id, $id_usuario, $titulo, $descricao, $id_categoria, $preco, $estado){
        $sql = "UPDATE anuncios SET id_usuario = ?, titulo = ?, descricao = ?, id_categoria = ?, preco = ?, estado = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_usuario, $titulo, $descricao, $id_categoria, $preco, $estado, $id));
    }

    /**
     * This function delete a ad in database.
     *
     * @param   $id   int for the ad's ID number saved in the database.
     */
    public function excluir($id){
        $sql = $this->db->prepare("DELETE FROM anuncios WHERE id = ?");
        $sql->execute(array($id));
        $sql = $this->db->prepare("SELECT * FROM anuncios_imagens WHERE id = ?");
        $sql->execute(array($id));
        $sql = $sql->fetchAll();
        $a = new Anuncios_imagens();
        foreach($sql as $result){
            $a->excluirFoto($result['id']);
        }

    }
}