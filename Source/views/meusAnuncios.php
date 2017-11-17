<div class="container" style="margin-top: 30px;margin-bottom: 30px">
    <h1>Meus Anúncios</h1>
    <a href="<?php echo BASE_URL;?>/anuncios/novoAnuncio" class="btn btn-success" style="margin-top:10px">Novo Anúncio</a>
    <table class="table table-striped" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Foto Principal</th>
                <th>Titulo</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($anuncios as $anuncio):?>
            <tr style="line-height: 55px">
                <?php if(!empty($anuncio['url'])): ?>
                    <td><img src="<?php echo BASE_URL;?>/assets/imgs/anuncios/<?php echo $anuncio['url'] ?>" style="height: 60px"></td>
                <?php else: ?>
                    <td><img src="<?php echo BASE_URL;?>/assets/imgs/default.png" style="height: 60px"></td>
                <?php endif; ?>
                <td><?php echo $anuncio['titulo'] ?></td>
                <td>R$ <?php echo str_replace("/", ",", str_replace(",", ".", str_replace(".","/", number_format($anuncio['preco'], 2)))) ?></td>
                <td>
                    <a class="btn btn-primary" id="botao-visualizar" href="<?php echo BASE_URL;?>/anuncios/abrir/<?php echo base64_encode(base64_encode($anuncio['id'])) ?>">Visualizar</a>
                    <a class="btn btn-info" href="<?php echo BASE_URL;?>/anuncios/editarAnuncio/<?php echo base64_encode(base64_encode($anuncio['id'])) ?>">Editar</a>
                    <button class="btn btn-danger" onclick="exAnuncio('<?php echo base64_encode(base64_encode($anuncio['id'])) ?>')">Excluir</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div id="fundo-escuro" style="display: none"></div>
<div id="confirmacao-exclusao" style="display: none">
    <p>Tem certeza que deseja excluir o anúncio?</p>
    <button class="btn btn-danger" onclick="sexcluir()">Sim</button>
    <button class="btn btn-success" onclick="nexcluir()">Não</button>
</div>
<script>
    var idAnuncio;
    function exAnuncio(id){
        $("#fundo-escuro").show();
        $("#confirmacao-exclusao").show('fast');
        idAnuncio = id;
    }
    function nexcluir() {
        $("#confirmacao-exclusao").hide('fast');
        $("#fundo-escuro").hide();
    }

    function sexcluir(){
        window.location.href = '<?php echo BASE_URL ?>/anuncios/excluirAnuncio/' + idAnuncio;
    }
</script>
