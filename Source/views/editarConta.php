<style>
    .box-minha-conta{
        border: 1px solid;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .box-minha-conta-titulo{
        height: 60px;
        line-height: 60px;
        padding-left: 20px;
        background-color: #292b2c;
        color: white;
    }

    .box-minha-conta-conteudo{
        padding-left: 20px;
        padding-top: 20px;
        padding-right: 40px;
    }

    .box-minha-conta-conteudo label{
        margin: 0;
        font-weight: bold;
    }

    .box-minha-conta-conteudo input{
        margin-left: 10px;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .box-minha-conta-conteudo select{
        margin-left: 10px;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    #bgbox{
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        position: fixed;
        z-index: 10;
    }

    #confirm{
        border-radius: 10px;
        position: fixed;
        left: 50%;
        top: 50%;
        width: auto;
        background-color: white;
        padding: 20px;
        transform: translate(-50%, -50%);
        z-index: 11;
    }
</style>
<div class="container">
    <div class="grupo-botoes" style="margin-top: 20px">
        <a class="btn btn-secondary" href="<?php echo BASE_URL?>/home/MinhaConta">Voltar</a>
    </div>
    <div class="box-minha-conta">
        <div class="box-minha-conta-titulo">Dados Cadastrais</div>
        <div class="box-minha-conta-conteudo">
            <form method="POST" onsubmit="return validar()">
                <label for="nome"><span style="color: red;font-weight: bold">*</span> Nome</label>
                <input class="form-control" id="nome" name="nome" data-ob="1" data-alt="Nome" value="<?php echo $dados['nome']?>">
                <label form="email"><span style="color: red;font-weight: bold">*</span> E-mail</label>
                <input class="form-control" id="email" name="email" data-ob="1" data-alt="E-mail" value="<?php echo $dados['email']?>">
                <label for="estado"><span style="color: red;font-weight: bold">*</span> Estado:</label>
                <select class="form-control" name="estado" id="estado" data-alt="Estado" data-ob="1">
                    <?php foreach ($estados as $estado):?>
                        <option <?php if($estado['id'] == $dados['id_estado']) echo 'selected' ?> value="<?php echo $estado['id'] ?>"><?php echo $estado['nome'] ?></option>
                    <?php endforeach;?>
                </select>
                <label for="cidade"><span style="color: red;font-weight: bold">*</span> Cidade:</label>
                <select class="form-control" name="cidade" id="cidade" data-alt="Cidade" data-ob="1">
                    <?php foreach ($cidades as $cidade):?>
                        <option <?php if($cidade['id'] == $dados['id_cidade']) echo 'selected' ?> value="<?php echo $cidade['id'] ?>"><?php echo $cidade['nome'] ?></option>
                    <?php endforeach;?>
                </select>
                <label for="telefone">Telefone</label>
                <input class="form-control" id="telefone" name="telefone" data-ob="0" data-alt="Telefone" value="<?php echo $dados['telefone']?>">
                <label for="celular"><span style="color: red;font-weight: bold">*</span> Celular</label>
                <input class="form-control" id="celular" name="celular" data-ob="1" data-alt="Celular" value="<?php echo $dados['celular']?>">
                <label for="senha">Senha atual</label>
                <input type="password" class="form-control" id="senha" name="senha" data-ob="0" data-alt="Senha Atual">
                <label for="NovaSenha">Nova Senha</label>
                <input type="password" class="form-control" id="NovaSenha" name="NovaSenha" data-ob="0" data-alt="Nova Senha">
                <p>Caso queira alterar a senha, basta preencher os campos Senha atual e Nova Senha.</p>
                <?php
                if(!empty($aviso)){
                    echo $aviso;
                }
                ?>
                <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;width: fit-content;display: none' class='alert alert-danger'>
                </div>
                <p id="infocampos">Obs.: Campos com <label><span style="color: red;font-weight: bold">*</span></label> são de preenchimento obrigatório.</p>
                <input type="submit" value="Salvar" style="cursor:pointer;" class="btn btn-md btn-success">
            </form>
        </div>
    </div>

    <div class="box-minha-conta">
        <div class="box-minha-conta-titulo">Zona de Risco</div>
        <div class="box-minha-conta-conteudo">
            <label>Excluir conta</label><br>
            <button class="btn btn-danger" style="cursor: pointer;margin-left: 15px;margin-bottom: 15px" id="excluir">Excluir</button>
        </div>
    </div>

    <div id="bgbox" style="display: none"></div>
    <div id="confirm" style="display: none">
        <p>Tem certeza que deseja excluir sua conta?</p>
        <span id="n" style="display: none"><?php echo $dados['id']?>></span>
        <a class="btn btn-danger" style="cursor: pointer" href="<?php echo BASE_URL ?>/home/excluirConta">Sim</a>
        <button style="cursor: pointer" class="btn btn-success" onclick="nexcluir()">Não</button>
    </div>
</div>
<script>
    window.onload = function () {
        $("#celular").mask("(00) 0000-#0000");
        $("#telefone").mask("(00) 0000-0000");
    }
    $(function () {
        $("#excluir").bind("click", function () {
            $("#bgbox").show();
            $("#confirm").show('fast');
        })
    })
    function nexcluir() {
        $("#confirm").hide('fast');
        $("#bgbox").hide();
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