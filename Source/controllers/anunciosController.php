<?php
class anunciosController extends controller{
    public function index(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL);
        }
        $a = new Anuncios();
        $dados = array(
            'titulo' => 'Meus Anúncios',
            'anuncios' => $a->getMeusAnuncios(addslashes($_SESSION['cLogin'])),
        );
        $this->loadTemplate('meusAnuncios', $dados);
    }

    public function abrir($id){
        $dados = array();
        $a = new Anuncios();
        if(isset($id) && !empty($id)){
            $id = addslashes(base64_decode(base64_decode($id)));
        }else{
            header("Location: ".BASE_URL);
        }
        $dados['info'] = $a->getAnuncio($id);
        $dados['titulo'] = 'Classi-O - '.$dados['info']['titulo'];
        $this->loadTemplate('expandirAnuncio', $dados);
    }

    public function novoAnuncio(){
        $dados = array();
        $a = new Anuncios();
        $dados['titulo'] = 'Cadastrando novo Anúncio';
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL);
        }
        if(isset($_POST['titulo']) && !empty($_POST['titulo']) && isset($_POST['categoria']) && !empty($_POST['categoria']) && isset($_POST['categoria']) && !empty($_POST['valor']) && isset($_POST['valor'])){
            $titulo = addslashes($_POST['titulo']);
            $id_categoria = addslashes($_POST['categoria']);
            $preco = str_replace(",", ".", addslashes($_POST['valor']));
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);

            $a->cadastrarAnuncio($_SESSION['cLogin'], $titulo, $descricao, $id_categoria, $preco , $estado);
            header("Location: ".BASE_URL."/anuncios");
        }
        $c = new Categorias();
        $dados['cats'] = $c->getCategorias();
        $this->loadTemplate('cadastrarAnuncio', $dados);
    }

    public function editarAnuncio($id){
        $id = base64_decode(base64_decode(addslashes($id)));
        $dados = array();
        $a = new Anuncios();
        $dados['id'] = $id;
        $dados['titulo'] = 'Editando Anúncio';
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL."/login");
        }
        if(isset($_POST['titulo']) && !empty($_POST['titulo']) && isset($_POST['valor']) && !empty($_POST['valor']) && isset($_POST['estado']) && !empty($_POST['estado'])){
            $titulo = addslashes($_POST['titulo']);
            $id_categoria = addslashes($_POST['categoria']);
            $valor = str_replace(",", ".", addslashes($_POST['valor']));
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);


            $a->editarAnuncio($id, $_SESSION['cLogin'], $titulo, $descricao, $id_categoria, $valor, $estado);
            header("Location: ".BASE_URL."/anuncios");
        }
        if(isset($id) && !empty($id)){
            $dados['info']= $a->getAnuncio($id);
        }else{
            header("Location: ".BASE_URL."/login");
        }
        $c = new Categorias();
        $dados['cats'] = $c->getCategorias();
        $this->loadTemplate('editarAnuncio', $dados);
    }

    public function salvarFoto(){
        $a = new Anuncios_imagens();
        echo $a->salvarFoto();
    }

    public function excluirFoto($id, $id_anuncio){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL."/login");
            exit;
        }
        $id = base64_decode(base64_decode(addslashes($id)));
        $a = new Anuncios_imagens();
        if(isset($id) && !empty($id)){
            $a->excluirFoto($id);
            header ("Location: ".BASE_URL."/anuncios/editarAnuncio/".$id_anuncio);
        }else{
            header("Location: ".BASE_URL."/anuncios");
        }
    }

    public function excluirAnuncio($id){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header("Location: ".BASE_URL."/login");
            exit;
        }
        $a = new Anuncios();
        if(isset($id) && !empty($id)){
            $a->excluir(base64_decode(base64_decode(addslashes($id))));
        }
        header("Location: ".BASE_URL."/anuncios");
    }
}