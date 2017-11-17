<script type="text/javascript">
    window.onload = function () {
        $("#valor").mask("#0,00", {reverse: true});
    }
</script>
<div class="container" style="margin-top: 30px;margin-bottom: 30px">
    <h1>Cadastrar Anúncio</h1>
    <form method="POST" onsubmit="return validar(this)" style="margin-bottom: 20px;margin-top: 20px">
        <div class="form-group">
            <label for="categoria"><span>*</span> Categoria</label>
            <select name="categoria" id="categoria" class="form-control" data-ob="1" data-alt="Categoria">
                <?php
                foreach ($cats as $cat):?>
                    <option value="<?php echo $cat['id'] ?>"><?php echo $cat['nome'] ?></option>
                    <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="titulo"><span>*</span> Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" data-ob="1" data-alt="Título">
        </div>
        <div class="form-group">
            <label for="valor"><span>*</span> Preço</label>
            <input type="text" name="valor" id="valor" class="form-control" data-ob="1" data-alt="Preço">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" name="descricao" rows="5" id="descricao" data-ob="0" data-alt="Descrição"></textarea>
        </div>
        <div class="form-group">
            <label for="estado"><span>*</span> Estado de Conservação</label>
            <select name="estado" id="estado" class="form-control" data-ob="1" data-alt="Estado de Conservação">
                <option value="1">Ruim</option>
                <option value="2">Bom</option>
                <option value="3">Ótimo</option>
                <option value="4">Novo</option>
            </select>
        </div>
        <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;width: fit-content;display: none' class='alert alert-danger'></div>
        <p id="infocampos" style="margin-bottom: 0; margin-top: 20px">Obs.: Campos com <label><span style="color: red;font-weight: bold">*</span></label> são de preenchimento obrigatório.</p>
        <p style="margin-bottom: 30px;">Após cadastrar o anúncio, edite o mesmo para adicionar as fotos.</p>
        <input type="submit" class="btn btn-success" style="cursor: pointer;" value="Cadastrar">
        <a class="btn btn-secondary" style="cursor: pointer;" href="<?php echo BASE_URL;?>/anuncios">Voltar</a>
    </form>
</div>