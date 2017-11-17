<script type="text/javascript">
    window.onload = function () {
        $("#valor").mask("#0,00", {reverse: true});
    }
</script>
<div class="container" style="margin-top: 30px;margin-bottom: 30px">
    <h1>Editar Anúncio</h1>
    <form method="POST" onsubmit="return validar(this)" style="margin-bottom: 20px;margin-top: 20px" role="form">
        <div class="form-group">
            <label form="categoria"><span>*</span> Categoria</label>
            <select name="categoria" id="categoria" class="form-control" data-ob="1" data-alt="Categoria">
                <?php
                foreach ($cats as $cat):?>
                    <option value="<?php echo $cat['id'] ?>" <?php echo ($info['id_categoria'] == $cat['id'])?'selected="selected"':"";?>><?php echo $cat['nome'] ?></option>
                    <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label form="titulo"><span>*</span> Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']; ?>">
        </div>
        <div class="form-group">
            <label form="titulo"><span>*</span> Preço</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?php echo str_replace(".", ",", str_replace(",", "", number_format($info['preco'], 2))); ?>" data-ob="1" data-alt="Preço">
        </div>
        <div class="form-group">
            <label form="titulo"> Descrição</label>
            <textarea class="form-control" name="descricao" rows="5" id="descricao" data-ob="0" data-alt="Descrição"><?php echo $info['descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label form="titulo"><span>*</span> Estado de Conservação</label>
            <select name="estado" id="estado" class="form-control" data-ob="1" data-alt="Estado de Conservação">
                <option value="1" <?php echo ($info['estado'] == '1')?'selected="selected"':"";?>>Ruim</option>
                <option value="2" <?php echo ($info['estado'] == '2')?'selected="selected"':"";?>>Bom</option>
                <option value="3" <?php echo ($info['estado'] == '3')?'selected="selected"':"";?>>Ótimo</option>
                <option value="4" <?php echo ($info['estado'] == '4')?'selected="selected"':"";?>>Novo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="add_foto">Enviar Fotos</label>
            <div class="progress">
                <div id="progresso" data-id="<?php echo base64_encode(base64_encode($id)); ?>" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                     aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <input style="margin-top: 10px" name="imagem" id="imagem" type="file" accept="image/*" class="form-control" multiple />
            <div class="card card-default" style="margin-top: 20px">
                <div class="card-header">Fotos do Anúncio</div>
                <div class="card-block">
                    <?php
                    if(isset($info['fotos'])){
                        foreach ($info['fotos'] as $foto):?>
                            <div class="foto-itens">
                                <img src="<?php echo BASE_URL;?>/assets/imgs/anuncios/<?php echo $foto['url']; ?>" class="img-thumbnail"><br>
                                <a href="<?php echo BASE_URL;?>/anuncios/excluirFoto/<?php echo base64_encode(base64_encode($foto['id'])); ?>/<?php echo base64_encode(base64_encode($info['id'])); ?>" class="btn btn-danger">Excluir Imagem</a>
                            </div>
                        <?php endforeach; }?>
                </div>
            </div>
        </div>
        <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;width: fit-content;display: none' class='alert alert-danger'></div>
        <p id="infocampos" style="margin-bottom: 0; margin-top: 20px">Obs.: Campos com <label><span style="color: red;font-weight: bold">*</span></label> são de preenchimento obrigatório.</p>
        <input type="submit" class="btn btn-success" style="cursor: pointer;" value="Salvar">
        <a class="btn btn-secondary" style="cursor: pointer;" href="<?php echo BASE_URL;?>/anuncios">Voltar</a>
    </form>
</div>