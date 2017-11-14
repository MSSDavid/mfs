<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Usuarios.php';

final class UsuariosTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testLogin(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();

        $result = $u->logIn('adm@adm.com.br', '123');

        $this->assertEquals(true, $result);

        //Teste do else
        $result = $u->logIn('adm@adm.com.br', '456');
        $this->assertEquals(false, $result);
    }

    public function testCadastrar(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();

        $result = $u->cadastrar('Samuel', 'samuel@adm.com.br', '456', '(62) 3535-3535', '(62) 98888-8888');
        $this->assertEquals(true, $result);

        $sql = "SELECT * FROM usuarios ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();

        $this->assertEquals(2, $result['id']);
        $this->assertEquals('Samuel', $result['nome']);
        $this->assertEquals('samuel@adm.com.br', $result['email']);
        $this->assertEquals(md5('456'), $result['senha']);
        $this->assertEquals('(62) 3535-3535', $result['telefone']);
        $this->assertEquals('(62) 98888-8888', $result['celular']);

        //Teste do else
        $result = $u->cadastrar('Samuel', 'adm@adm.com.br', md5('456'), '(62) 3535-3535', '(62) 98888-8888');
        $this->assertEquals(false, $result);
    }

    public function testEditar(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();
        $result = $u->editar(1, 'Samuel', 'samuel@adm.com.br', '456', '(62) 3535-3535', '(62) 98888-8888');

        $this->assertEquals(true, $result);

        $sql = "SELECT * FROM usuarios ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('Samuel', $result['nome']);
        $this->assertEquals('samuel@adm.com.br', $result['email']);
        $this->assertEquals(md5('456'), $result['senha']);
        $this->assertEquals('(62) 3535-3535', $result['telefone']);
        $this->assertEquals('(62) 98888-8888', $result['celular']);


        //Teste do else - Email já cadastrado
        $sql = "INSERT INTO usuarios (email, senha, nome, telefone, celular) VALUES ('samuel@ufg.br', '123', 'Samuel', '(62) 3514-1803', '(62) 98888-7777')";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $u->editar(2, 'Samuel', 'samuel@adm.com.br', '456', '(62) 3535-3535', '(62) 98888-8888');
        $this->assertEquals(false, $result);


        //Teste do if - Senha em branco
        $result = $u->editar(1, 'Samuel', 'samuel@adm.com.br', '', '(62) 3535-3535', '(62) 98888-8888');
        $this->assertEquals(true, $result);

        $sql = "SELECT * FROM usuarios WHERE id = 1";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('Samuel', $result['nome']);
        $this->assertEquals('samuel@adm.com.br', $result['email']);
        $this->assertEquals(md5('456'), $result['senha']);
        $this->assertEquals('(62) 3535-3535', $result['telefone']);
        $this->assertEquals('(62) 98888-8888', $result['celular']);


        // Teste do else - Senha preenchida
        $result = $u->editar(1, 'Samuel', 'samuel@adm.com.br', '789', '(62) 3535-3535', '(62) 98888-8888');
        $this->assertEquals(true, $result);

        $sql = "SELECT * FROM usuarios WHERE id = 1";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('Samuel', $result['nome']);
        $this->assertEquals('samuel@adm.com.br', $result['email']);
        $this->assertEquals(md5('789'), $result['senha']);
        $this->assertEquals('(62) 3535-3535', $result['telefone']);
        $this->assertEquals('(62) 98888-8888', $result['celular']);

    }

    public function testExcluir(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();
        $id = 1;
        $u->excluir($id);
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEmpty($result);
    }

    public function testLogoff(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $_SESSION['cLogin'] = '1';
        $u = new Usuarios();
        $u->logOff();
        $this->assertEquals('', $_SESSION['cLogin']);
    }

    public function testGetDados(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();
        $result = $u->getDados(1);
        $this->assertEquals('1', $result['id']);
        $this->assertEquals('Administrador', $result['nome']);
        $this->assertEquals('adm@adm.com.br', $result['email']);
        $this->assertEquals('(62) 3232-3232', $result['telefone']);
        $this->assertEquals('(62) 98585-8585', $result['celular']);
    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::classi-o:');
            $db->exec('CREATE TABLE `usuarios` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(150) NOT NULL, `email` varchar(150) NOT NULL, `senha` varchar(200) NOT NULL, `telefone` varchar(20) NOT NULL, `celular` varchar(20))');
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
