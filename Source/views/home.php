<script type="text/javascript">
    window.onload = function () {
        $("#precoMin").mask("#0,00", {reverse: true});
        $("#precoMax").mask("#0,00", {reverse: true});
    }
</script>
<div class="container-fluid" style="margin-top: 15px">
    <div class="jumbotron">
        <h1>Bem vindo ao Classi-O, um serviço de classificados online</h1>
        <h5>Cadastre-se gratuitamente e faça seu anúncio!</h5>
        <h5>Abaixo explore os últimos anúncios postados</h5>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h4 style="margin-bottom: 15px;">Pesquisa Avançada</h4>
            <button class="btn btn-default" id="botao-filtros" style="width: 100%;background-color: #292b2c;color: white;margin-bottom: 10px;">Filtros</button>
            <form id="form-filtros" method="GET" onsubmit="return validarFiltros(this)">
                <div class="form-group">
                    <label for="categoria">Estado</label>
                    <select name="filtros[estados]" id="estado" class="form-control">
                        <option></option>
                        <?php foreach ($estados as $estado): ?>
                            <option value="<?php echo $estado['id']?>" <?php echo($estado['id'] == $filtros['estados'])?'selected="selected"':''?>><?php echo $estado['nome']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Cidade:</label>
                    <select class="form-control" name="filtros[cidades]" id="cidade">
                        <?php if(!empty($filtros['estados'])): ?>
                            <option></option>
                            <?php foreach ($cidades as $cidade): ?>
                                <option value="<?php echo $cidade['id']?>" <?php echo($cidade['id'] == $filtros['cidades'])?'selected="selected"':''?>><?php echo $cidade['nome']?></option>
                            <?php endforeach; ?>
                        <?php elseif(empty($filtros['cidades'])): ?>
                            <option value="">Escolha um estado</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="filtros[categoria]" class="form-control">
                        <option></option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['id']?>" <?php echo($cat['id'] == $filtros['categoria'])?'selected="selected"':''?>><?php echo $cat['nome']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group" style="display: -webkit-box;">
                    <label for="precoMin">Faixa de Preço</label>
                    <br><p style="margin-bottom: 10px;float: left;line-height: 38px;margin-right: 11px;">Preço Min R$</p>
                    <input <?php if(!empty($filtros['precoMin'])) echo 'value="'.$filtros["precoMin"].'"'; ?> style="width: 100px;float: left;margin-bottom: 10px;" type="text" name="filtros[precoMin]" id="precoMin" class="form-control">
                    <br>
                    <p style="margin: 0;float: left;line-height: 38px;margin-right: 10px;">Preço Max R$</p>
                    <input <?php if(!empty($filtros['precoMax'])) echo 'value="'.$filtros["precoMax"].'"'; ?> type="text" style="width: 100px;float: left;" name="filtros[precoMax]" id="precoMax" class="form-control">
                </div>
                <div class="form-group">
                    <label for="categoria">Estado de Conservação</label>
                    <select name="filtros[estado]" class="form-control">
                        <option></option>
                        <option value="1" <?php echo($filtros['estado'] == '1')?'selected="selected"':''?>>Ruim</option>
                        <option value="2" <?php echo($filtros['estado'] == '2')?'selected="selected"':''?>>Bom</option>
                        <option value="3" <?php echo($filtros['estado'] == '3')?'selected="selected"':''?>>Ótimo</option>
                        <option value="4" <?php echo($filtros['estado'] == '4')?'selected="selected"':''?>>Novo</option>
                    </select>
                </div>
                <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
                </div>
                <div class="form-group">
                    <input id="botao-visualizar" style="cursor: pointer" type="submit" value="Filtrar" class="btn btn-info">
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <h4 style="margin-bottom: 0px;">Últimos Anúncios</h4>
            <span style="display: block; font-weight: 500;color: #555555;margin-left: 5px;font-size: 16px;margin-bottom: 15px;">Resultados: <?php echo $total_anuncios; ?></span>
            <table class="table table-striped">
                <tbody>
                <?php foreach($anuncios as $anuncio):?>
                    <tr>
                        <?php if(!empty($anuncio['url'])): ?>
                            <td><img src="<?php echo BASE_URL;?>/assets/imgs/anuncios/<?php echo $anuncio['url'] ?>" style="height: 60px"></td>
                        <?php else: ?>
                            <td><img src="<?php echo BASE_URL;?>/assets/imgs/default.png" style="height: 60px"></td>
                        <?php endif; ?>
                        <td>
                            <a href="<?php echo BASE_URL;?>/anuncios/abrir/<?php echo base64_encode(base64_encode($anuncio['id_anuncio'])) ?>"><?php echo $anuncio['titulo']?></a><br>
                            <?php echo $anuncio['categoria'] ?><br>
                            <?php echo $anuncio['nomeCidade'] ?>, <?php echo $anuncio['uf'] ?>
                        </td>
                        <td style="line-height: 55px;">R$ <?php echo str_replace("/", ",", str_replace(",", ".", str_replace(".","/", number_format($anuncio['preco'], 2)))) ?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php for($q=1; $q <= $total_paginas; $q++): ?>
                    <li class="page-item <?php echo ($p == $q)?'active':''; ?>"><a class="page-link" href="<?php echo BASE_URL;?>/home/index/<?php echo $q;if(isset($_GET['filtros'])) echo "/?".explode("?", $_SERVER['REQUEST_URI'])[1]; ?>"><?php echo $q; ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#estado').change(function(){
            if( $(this).val() ) {
                $('#cidade').hide();
                //$('.carregando').show();
                $.getJSON('<?php echo BASE_URL ?>/home/cidades/' + $(this).val(), function(j){
                    var options = '<option value=""></option>';
                    for (var i = 0; i < j.length; i++) {
                        options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
                    }
                    $('#cidade').html(options).show();
                    //$('.carregando').hide();
                });
            } else {
                $('#cidade').html('<option value="">Escolha um estado</option>');
            }
        });
    });
    $(function(){
        $('#botao-filtros').on('click', function(){
            $('#form-filtros').slideToggle();
        });
    });
</script>