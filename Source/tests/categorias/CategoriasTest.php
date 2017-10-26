<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Categorias.php';

final class CategoriasTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testGetCategoria(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $c = new Categorias();
        $result = $c->getCategoria(1);
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('Carros', $result['nome']);
    }

    public function testGetCategorias(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $c = new Categorias();
        $result = $c->getCategorias();
        $this->assertEquals(3, $result['id'][1]);
        $this->assertEquals('Barcos', $result['nome'][1]);
        $this->assertEquals(2, $result['id'][2]);
        $this->assertEquals('Motos', $result['nome'][2]);
        $this->assertEquals(1, $result['id'][3]);
        $this->assertEquals('Carros', $result['nome'][3]);
    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::classi-o:');
            $db->exec('CREATE TABLE `categorias` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(150) NOT NULL)');
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
