<div class="container" style="margin-top: 30px;margin-bottom: 30px">
    <form method="POST" style="margin: auto;margin-top: 20px;max-width: 500px" onsubmit="return validar()">
        <h1>Cadastre-se</h1>
        <div class="form-group">
            <label for="nome"><span>*</span> Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" data-alt="Nome" data-ob="1">
        </div>
        <div class="form-group">
            <label for="email"><span>*</span> E-mail</label>
            <input type="text" name="email" id="email" class="form-control" data-alt="Email" data-ob="1">
        </div>
        <div class="form-group">
            <label for="senha"><span>*</span> Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" data-alt="Senha" data-ob="1">
        </div>
        <div class="form-group">
            <label for="estado"><span>*</span> Estado:</label>
            <select class="form-control" name="estado" id="estado" data-alt="Estado" data-ob="1">
                <option value=""></option>
                <?php foreach ($estados as $estado):?>
                    <option value="<?php echo $estado['id'] ?>"><?php echo $estado['nome'] ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="cidade"><span>*</span> Cidade:</label>
            <select class="form-control" name="cidade" id="cidade" data-alt="Cidade" data-ob="1">
                <option value="">Escolha um estado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control" data-alt="Telefone" data-ob="1">
        </div>
        <div class="form-group">
            <label for="celular"><span>*</span> Celular</label>
            <input type="text" name="celular" id="celular" class="form-control" data-alt="Celular" data-ob="0">
        </div>
        <?php
        if(!empty($aviso)){
            echo $aviso;
        }
        ?>
        <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
        </div>
        <p id="infocampos">Obs.: Campos com <label><span style="color: red;font-weight: bold">*</span></label> são de preenchimento obrigatório.</p>
        <input type="submit" value="Cadastrar" class="btn btn-md btn-primary" style="cursor: pointer" data-alt="Botão" data-ob="0">
    </form>
</div>
<script>
    window.onload = function () {
        $("#celular").mask("(00) 0000-#0000");
        $("#telefone").mask("(00) 0000-0000");
    }
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
                $('#cidade').html('<option value="">-- Escolha um estado --</option>');
            }
        });
    });
</script>