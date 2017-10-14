<div class="container" style="margin-top: 30px;margin-bottom: 30px">
    <form method="POST" style="margin: auto;margin-top: 20px;max-width: 450px" onsubmit="return validar()">
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
            echo "<div class='alert alert-danger'>".$aviso."</div>";
        }
        ?>
        <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
            <ul class="list-group">
                <li class="list-group-item">
                </li>
            </ul>
        </div>
        <input type="submit" value="Entrar" class="btn btn-default" style="cursor: pointer">
    </form>
</div>