<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Usuarios.php';
include_once __DIR__.'/../../PHPMailer/PHPMailerAutoload.php';
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

        $result = $u->cadastrar('Samuel', 'samuel@adm.com.br', '456', '(62) 3535-3535', '(62) 98888-8888', 3, 4);
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
        $this->assertEquals(3, $result['id_estado']);
        $this->assertEquals(4, $result['id_cidade']);

        //Teste do else
        $result = $u->cadastrar('Samuel', 'adm@adm.com.br', md5('456'), '(62) 3535-3535', '(62) 98888-8888', 3, 4);
        $this->assertEquals(false, $result);
    }

    public function testEditar(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();
        $result = $u->editar(1, 'Samuel', 'samuel@adm.com.br', '456', '(62) 3535-3535', '(62) 98888-8888', 5, 6);

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
        $this->assertEquals(5, $result['id_estado']);
        $this->assertEquals(6, $result['id_cidade']);


        //Teste do else - Email já cadastrado
        $sql = "INSERT INTO usuarios (email, senha, nome, telefone, celular, id_estado, id_cidade) VALUES ('samuel@ufg.br', '123', 'Samuel', '(62) 3514-1803', '(62) 98888-7777', 5, 6)";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $u->editar(2, 'Samuel', 'samuel@adm.com.br', '456', '(62) 3535-3535', '(62) 98888-8888', 5, 6);
        $this->assertEquals(false, $result);


        //Teste do if - Senha em branco
        $result = $u->editar(1, 'Samuel', 'samuel@adm.com.br', '', '(62) 3535-3535', '(62) 98888-8888', 5, 6);
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
        $this->assertEquals(5, $result['id_estado']);
        $this->assertEquals(6, $result['id_cidade']);


        // Teste do else - Senha preenchida
        $result = $u->editar(1, 'Samuel', 'samuel@adm.com.br', '789', '(62) 3535-3535', '(62) 98888-8888', 5, 6);
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
        $this->assertEquals(5, $result['id_estado']);
        $this->assertEquals(6, $result['id_cidade']);

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
        //TESTE DO IF
        $result = $u->getDados(1, 1);
        $this->assertEquals('1', $result['id']);
        $this->assertEquals('Administrador', $result['nome']);
        $this->assertEquals('adm@adm.com.br', $result['email']);
        $this->assertEquals('(62) 3232-3232', $result['telefone']);
        $this->assertEquals('(62) 98585-8585', $result['celular']);
        $this->assertEquals(1, $result['id_estado']);
        $this->assertEquals(2, $result['id_cidade']);

        //TESTE DO ELSE
        $result = $u->getDados(2, "adm@adm.com.br");
        $this->assertEquals('1', $result['id']);
        $this->assertEquals('Administrador', $result['nome']);
        $this->assertEquals('adm@adm.com.br', $result['email']);
        $this->assertEquals('(62) 3232-3232', $result['telefone']);
        $this->assertEquals('(62) 98585-8585', $result['celular']);
        $this->assertEquals(1, $result['id_estado']);
        $this->assertEquals(2, $result['id_cidade']);
    }

    public function testRecuperarSenha(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();
        define("BASE_URL", 'http://localhost/php/Classi-o/Source');
        //TESTE DO IF
        $result = $u->recuperarSenha("adm@adm.com.br");
        $this->assertTrue($result);

        //TESTE DO ELSE
        $result = $u->recuperarSenha("adm@adm.com");
        $this->assertFalse($result);
    }

    public function testSetHashRecuperacao(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();
        $id = 1;
        $hashRecuperacao = "123456";
        $u->setHashRecuperacao($id, "123456");
        $sql = "SELECT * FROM usuarios WHERE hashRecuperacao = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($hashRecuperacao));
        $result = $sql->fetch();
        $this->assertEquals($hashRecuperacao, $result['hashRecuperacao']);
    }

    public function testGetDadosHash(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();
        $result = $u->getDadosHash("b0583adaea49e0b620f660dc2de6c40a");
        $this->assertEquals('1', $result['id']);
        $this->assertEquals('Administrador', $result['nome']);
        $this->assertEquals('adm@adm.com.br', $result['email']);
        $this->assertEquals('(62) 3232-3232', $result['telefone']);
        $this->assertEquals('(62) 98585-8585', $result['celular']);
        $this->assertEquals(1, $result['id_estado']);
        $this->assertEquals(2, $result['id_cidade']);
    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::classi-o:');
            $db->exec('CREATE TABLE `usuarios` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(150) NOT NULL, `email` varchar(150) NOT NULL, `senha` varchar(200) NOT NULL, `telefone` varchar(20) NOT NULL, `celular` varchar(20), `id_estado` int(11) NOT NULL, `id_cidade` int(11) NOT NULL, `hashRecuperacao` varchar(200)); CREATE TABLE `estados` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(50), `uf` varchar(3)); CREATE TABLE `cidades` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(200), `id_estado` INTEGER NOT NULL)');
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
