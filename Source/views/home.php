<div class="container-fluid" style="margin-top: 15px">
    <div class="row">
        <div class="col-sm-3">
            <h4>Pesquisa Avançada</h4>
            <form method="GET">
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
                <div class="form-group">
                    <label for="categoria">Preço</label>
                    <select name="filtros[preço]" class="form-control">
                        <option></option>
                        <option value="0.00-50.00" <?php echo($filtros['preço'] == '0.00-50.00')?'selected="selected"':''?>>R$ 0,00 - R$ 50,00</option>
                        <option value="51.00-250.00" <?php echo($filtros['preço'] == '51.00-250.00')?'selected="selected"':''?>>R$ 51,00 - R$ 250,00</option>
                        <option value="251.00-500.00" <?php echo($filtros['preço'] == '251.00-500.00')?'selected="selected"':''?>>R$ 251,00 - R$ 500,00</option>
                        <option value="501.00-1000.00" <?php echo($filtros['preço'] == '501.00-1000.00')?'selected="selected"':''?>>R$ 501,00 - R$ 1.000,00</option>
                        <option value="1001.00-5000.00" <?php echo($filtros['preço'] == '1001.00-5000.00')?'selected="selected"':''?>>R$ 1.001,00 - R$ 5.000,00</option>
                        <option value="5001.00-10000.00" <?php echo($filtros['preço'] == '5001.00-10000.00')?'selected="selected"':''?>>R$ 5.001,00 - R$ 10.000,00</option>
                        <option value="10001.00-20000.00" <?php echo($filtros['preço'] == '10001.00-20000.00')?'selected="selected"':''?>>R$ 1.001,00 - R$ 20.000,00</option>
                    </select>
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
                <div class="form-group">
                    <input style="cursor: pointer" type="submit" value="Filtrar" class="btn btn-info">
                </div>
            </form>
        </div>
        <div class="col-sm-9">
            <h4>Últimos Anúncios</h4>
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
                            <a href="<?php echo BASE_URL;?>/home/abrir/<?php echo base64_encode(base64_encode($anuncio['id'])) ?>"><?php echo $anuncio['titulo']?></a><br>
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
</script>