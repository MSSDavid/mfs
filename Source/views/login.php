<div class="container" style="margin-top: 30px;margin-bottom: 30px">
    <form method="POST" style="margin: auto;margin-top: 20px;max-width: 450px" onsubmit="return validar()">
        <?php if(isset($_GET['recuperacao']))
            echo "<div class='alert alert-success notificacao'>
                        E-mail de recuperação enviado com sucesso!
                    </div>"
        ?>
        <h1>Fazer Login</h1>
        <div class="form-group">
            <label for="nome">E-mail</label>
            <input type="text" name="email" id="email" class="form-control" data-alt="E-mail" data-ob="1">
        </div>
        <div class="form-group">
            <label for="nome">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" data-alt="Senha" data-ob="1">
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
        <input type="submit" value="Entrar" class="btn btn-primary" style="cursor: pointer">
        <p style="margin-top: 10px">Esqueceu a senha? <a href="<?php echo BASE_URL?>/login/enviarRecuperacaoDeSenha">Clique aqui</a> para recuperá-la.</p>
    </form>
</div>