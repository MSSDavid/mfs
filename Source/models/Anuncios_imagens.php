<?php
/**
 * This class retrieves and saves image data of the ad.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 25/10/2017
 * @since   0.1
 */
class Anuncios_imagens extends model{

    /**
     * This function delete a ad image in database.
     *
     * @param   $id   The image's ID number saved in the database.
     */
    public function excluirFoto($id){
        $id_anuncio = 0;
        $sql = $this->db->prepare("SELECT * FROM anuncios_imagens WHERE id = ?");
        $sql->execute(array($id));
        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $id_anuncio = $row['id_anuncio'];
            unlink("assets/imgs/anuncios/".$row['url']);
        }
        $sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id = ?");
        $sql->execute(array($id));
    }

    /**
     * This function add a ad image in database.
     *
     * The $_POST variable sends the user's id and the image
     *
     */
    public function salvarFoto(){
        $imagem = $_POST['imagem'];
        $id = addslashes($_POST['id']);
        list($tipo, $dados) = explode(';', $imagem);
        list(, $tipo) = explode(':', $tipo);
        list(, $dados) = explode(',', $dados);
        $dados = base64_decode($dados);
        $nome = md5(time().rand(0,9999));
        $nome_bd = $nome.".jpg";
        $sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio = ?, url = ?");
        $sql->execute(array($id, $nome_bd));
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/php/Classi-O/assets/imgs/anuncios/'.$nome.'.jpg', $dados);
        echo "1";
    }
}