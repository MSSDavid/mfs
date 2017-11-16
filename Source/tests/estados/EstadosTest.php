<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Estados.php';
include_once __DIR__.'/../../PHPMailer/PHPMailerAutoload.php';
final class EstadosTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testGetEstados(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $e = new Estados();

        $result = $e->getEstados();
        $this->assertEquals(5, count($result));
        $this->assertEquals('Bahia', $result[0]['nome']);
        $this->assertEquals('BA', $result[0]['uf']);
        $this->assertEquals(4, $result[0]['id']);
        $this->assertEquals('Distrito Federal', $result[1]['nome']);
        $this->assertEquals('DF', $result[1]['uf']);
        $this->assertEquals(3, $result[1]['id']);
        $this->assertEquals('Goiás', $result[2]['nome']);
        $this->assertEquals('GO', $result[2]['uf']);
        $this->assertEquals(1, $result[2]['id']);
        $this->assertEquals('Rio de Janeiro', $result[3]['nome']);
        $this->assertEquals('RJ', $result[3]['uf']);
        $this->assertEquals(5, $result[3]['id']);
        $this->assertEquals('São Paulo', $result[4]['nome']);
        $this->assertEquals('SP', $result[4]['uf']);
        $this->assertEquals(2, $result[4]['id']);
    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::classi-o:');
            $db->exec('CREATE TABLE `estados` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(150) NOT NULL, `uf` varchar(3) NOT NULL)');
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
