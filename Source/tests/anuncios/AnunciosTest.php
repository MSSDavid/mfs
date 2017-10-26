<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Anuncios.php';

final class AnunciosTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testGetAnuncio(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $a = new Anuncios();
        $result = $a->getAnuncio(1);
        $this->assertEquals(1, $result['id']);
        $this->assertEquals(1, $result['id_usuario']);
        $this->assertEquals('Teste Titulo', $result['titulo']);
        $this->assertEquals('2017-10-25 19:30:00', $result['dataPublicacao']);
        $this->assertEquals('Descrição do Anúncio', $result['descricao']);
        $this->assertEquals('1', $result['id_categoria']);
        $this->assertEquals(100.50, $result['preco']);
        $this->assertEquals('1', $result['estado']);
    }

    public function testGetAnuncios(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $a = new Anuncios();
        $result = $a->getAnuncios();
        $this->assertEquals(1, $result['id'][2]);
        $this->assertEquals(1, $result['id_usuario'][2]);
        $this->assertEquals('Teste Titulo', $result['titulo'][2]);
        $this->assertEquals('2017-10-25 19:30:00', $result['dataPublicacao'][2]);
        $this->assertEquals('Descrição do Anúncio', $result['descricao'][2]);
        $this->assertEquals('1', $result['id_categoria'][2]);
        $this->assertEquals(100.50, $result['preco'][2]);
        $this->assertEquals('1', $result['estado'][2]);
        $this->assertEquals(2, $result['id'][1]);
        $this->assertEquals(2, $result['id_usuario'][1]);
        $this->assertEquals('Teste Titulo 2', $result['titulo'][1]);
        $this->assertEquals('2017-10-23 19:30:00', $result['dataPublicacao'][1]);
        $this->assertEquals('Descr Anc', $result['descricao'][1]);
        $this->assertEquals('3', $result['id_categoria'][1]);
        $this->assertEquals(55.12, $result['preco'][1]);
        $this->assertEquals('3', $result['estado'][1]);
    }

    public function testCadastrarAnuncio(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $a = new Anuncios();
        $_SESSION['cLogin'] = 3;

        $a->cadastrarAnuncio(3, 'Carro Automático', 'Ótimo estado de conservação', '2', 30.00, '2');

        $sql = "SELECT * FROM anuncios ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();

        $this->assertEquals(3, $result['id']);
        $this->assertEquals(3, $result['id_usuario']);
        $this->assertEquals('Carro Automático', $result['titulo']);
        $this->assertEquals('Ótimo estado de conservação', $result['descricao']);
        $this->assertEquals('2', $result['id_categoria']);
        $this->assertEquals(30.00, $result['preco']);
        $this->assertEquals('2', $result['estado']);
    }

    public function testEditarAnuncio(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $a = new Anuncios();
        $_SESSION['cLogin'] = 3;

        $a->editarAnuncio(1, 3, 'Carro Automático', 'Ótimo estado de conservação', 115.66, '2', '2');

        $sql = "SELECT * FROM anuncios WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array(1));
        $result = $sql->fetch();

        $this->assertEquals(1, $result['id']);
        $this->assertEquals(3, $result['id_usuario']);
        $this->assertEquals('Carro Automático', $result['titulo']);
        $this->assertEquals('25/10/2017 19:38:00', $result['dataPublicacao']);
        $this->assertEquals('Ótimo estado de conservação', $result['descricao']);
        $this->assertEquals('2', $result['id_categoria']);
        $this->assertEquals(115.66, $result['preco']);
        $this->assertEquals('2', $result['estado']);
    }

    public function testExcluir(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $a = new Anuncios();
        $id = 1;
        $a->excluir($id);
        $sql = "SELECT * FROM anuncios WHERE id = ?";
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
            $db->exec('CREATE TABLE `anuncios` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_usuario` INTEGER NOT NULL, `titulo` varchar(150) NOT NULL, `dataPublicacao` datetime NOT NULL, `descricao` text NOT NULL, `id_categoria` int(11) NOT NULL, `preco` double NOT NULL, `estado` INTEGER NOT NULL); CREATE TABLE `anuncios_imagens` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_anuncio` INTEGER NOT NULL, `url` varchar(150) NOT NULL)');
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
