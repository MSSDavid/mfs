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
    }

    .box-minha-conta-conteudo label{
        margin: 0;
        font-weight: bold;
    }

    .box-minha-conta-conteudo p{
        margin-left: 10px;
    }
</style>
<div class="container">
    <div class="grupo-botoes" style="margin-top: 20px">
        <a class="btn btn-secondary" href="<?php echo BASE_URL?>">Voltar</a>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>/home/editarConta">Editar dados</a>
    </div>
    <div class="box-minha-conta">
        <div class="box-minha-conta-titulo">Dados Cadastrais</div>
        <div class="box-minha-conta-conteudo">
            <label>Nome</label>
            <p><?php echo $dados['nome']?></p>
            <label>E-mail</label>
            <p><?php echo $dados['email']?></p>
            <label>Estado</label>
            <p><?php echo $dados['estado']?></p>
            <label>Cidade</label>
            <p><?php echo $dados['cidade']?></p>
            <label>Telefone</label>
            <p><?php echo $dados['telefone']?></p>
            <label>Celular</label>
            <p><?php echo $dados['celular']?></p>
        </div>
    </div>
</div>