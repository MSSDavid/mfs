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
        $this->assertEquals(3, $result[0]['id']);
        $this->assertEquals('Barcos', $result[0]['nome']);
        $this->assertEquals(2, $result[1]['id']);
        $this->assertEquals('Motos', $result[1]['nome']);
        $this->assertEquals(1, $result[2]['id']);
        $this->assertEquals('Carros', $result[2]['nome']);
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
