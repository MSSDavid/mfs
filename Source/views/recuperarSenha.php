<div class="container" style="margin-top: 30px;margin-bottom: 30px">
    <form method="POST" style="margin: auto;margin-top: 20px;max-width: 450px" onsubmit="return validarFormRecuperarSenha()">
        <h1>Recuperar Senha</h1>
        <div class="form-group">
            <label for="nome"><span>*</span> Nova Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" data-alt="Nova Senha" data-ob="1">
        </div>
        <div class="form-group">
            <label for="nome"><span>*</span> Repita Nova Senha</label>
            <input type="password" name="confirmaSenha" id="confirmaSenha" class="form-control" data-alt="Repita Nova Senha" data-ob="1">
        </div>
        <?php
        if(!empty($aviso)){
            echo $aviso;
        }
        ?>
        <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
            <ul class="list-group">
                <li class="list-group-item">
                </li>
            </ul>
        </div>
        <input type="submit" value="Alterar Senha" class="btn btn-primary" style="cursor: pointer">
    </form>
</div>