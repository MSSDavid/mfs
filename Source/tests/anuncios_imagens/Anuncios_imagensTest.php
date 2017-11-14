<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Anuncios_imagens.php';

final class Anuncios_imagensTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::classi-o:');
            $db->exec('CREATE TABLE `anuncios` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_usuario` INTEGER NOT NULL, `titulo` varchar(150) NOT NULL, `dataPublicacao` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, `descricao` text NOT NULL, `id_categoria` int(11) NOT NULL, `preco` double NOT NULL, `estado` INTEGER NOT NULL); CREATE TABLE `anuncios_imagens` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_anuncio` INTEGER NOT NULL, `url` varchar(150) NOT NULL)');
            $this->conn =  $this->createDefaultDBConnection($db, ':classi-o:');
        }

        return $this->conn;
    }

    /**
     * @coversNothing
     */
    public function getDataSet()
    {
        return $this->createXMLDataSet(__DIR__."/Classi-O.xml");
    }
}
?>
