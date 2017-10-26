<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Anuncios_imagens.php';

final class Anuncios_imagensTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testSalvarFoto(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $a = new Anuncios_imagens();
        $_POST['imagem'] = null;
        $_POST['id'] = 1;
        $_SESSION['cLogin'] = 3;

        $a->salvarFoto();

        $sql = "SELECT * FROM anuncios_imagens ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();

        $this->assertEquals(3, $result['id']);
        $this->assertEquals(1, $result['id_anuncio']);
        $this->assertEquals('imagem_anuncio', $result['url']);
    }

    public function testExcluirFoto(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $a = new Anuncios_imagens();
        $id = 1;
        $a->excluirFoto($id);
        $sql = "SELECT * FROM anuncios_imagens WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEmpty($result);

        //teste do If
        $id = 1;
        $a->excluirFoto($id);
        $sql = "SELECT * FROM anuncios_imagens WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEmpty($result);

    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::classi-o:');
            $db->exec('CREATE TABLE `anuncios` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_usuario` INTEGER NOT NULL, `titulo` varchar(150) NOT NULL, `dataPublicacao` datetime NOT NULL, `descricao` text NOT NULL, `id_categoria` int(11) NOT NULL, `preco` double NOT NULL, `estado` INTEGER NOT NULL); CREATE TABLE `anuncios_imagens` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_usuario` INTEGER NOT NULL, `url` varchar(150) NOT NULL)');
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
