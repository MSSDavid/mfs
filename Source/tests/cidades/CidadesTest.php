<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Cidades.php';
include_once __DIR__.'/../../PHPMailer/PHPMailerAutoload.php';
final class CidadesTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testGetCidades(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $c = new Cidades();
        $id_estado = 1;
        $result = $c->getCidades($id_estado);
        $this->assertEquals(1, $result[0]['id']);
        $this->assertEquals('Inhumas', $result[0]['nome']);
        $this->assertEquals(1, $result[0]['id_estado']);
    }


    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::classi-o:');
            $db->exec('CREATE TABLE `cidades` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(150) NOT NULL, `id_estado` INTEGER NOT NULL)');
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
